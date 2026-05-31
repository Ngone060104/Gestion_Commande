<?php
require_once(ROOT . "model/commandeModel.php");
require_once(ROOT . "model/clientModel.php");

// function commandeAction()
// {
//     $commandes = findAllCommandes();
//     // require_once(ROOT. "views/commande/listCommande.php");
//     loadView("commande/listCommande", ["commandes" => $commandes]);
// }

function commandeAction() {
    if (isAdmin()) {
        // L'admin voit TOUTES les commandes
        $commandes = findAllCommandes(); 
    } else {
        // Le client voit UNIQUEMENT ses propres commandes
        $idClientConnecte = $_SESSION['user']['id_client'];
        $commandes = findCommandesByClientId($idClientConnecte); 
    }
    
    loadView("commande/listCommande", ["commandes" => $commandes]);
}

function addCommandeAction()
{


 if (!isAdmin()) {
        header("Location: " . path("commande", "index"));
        exit();
    }
    // Initialisation obligatoire de TOUTES les variables pour la vue
    $nom = "";
    $prenom = "";
    $libelle = "";
    $prix = "";
    $stock = "";
    $id_produit_cache = "";
    $tel_saisi = "";
    $ref_saisie = "";
    $client_existe = false;
    $produit_existe = false;

    // Initialisation du tableau pour capturer les erreurs de recherche
    $erreurs = [];
    // 1. PRIORITÉ 1 : Si l'utilisateur clique explicitement sur "Rechercher"
    if (isset($_POST['btn_chercher_client'])) {
        $tel_saisi = trim($_POST['tel']);
        // Validation basique : si le champ téléphone est vide
        isEmpty('tel', $tel_saisi, $erreurs, "Veuillez saisir un numéro de téléphone.");
        if (!isset($erreurs['tel']) && !isPhoneNumber($tel_saisi)) {
            $erreurs['tel'] = "Numéro sénégalais invalide. Saisissez 9 chiffres commençant par 77, 78, 76, 75 ou 70.";
        }

         // Si le numéro est saisi dans un bon format, on cherche en BDD
        if (!isset($erreurs['tel'])) {
            $client = findClientByTel($tel_saisi);
            if ($client) {
                $nom = $client['nom'];
                $prenom = $client['prenom'];
                $client_existe = true;

                // On vérifie s'il a déjà une commande non soldée, sinon on lui en crée une dédiée
                $commandeActuelle = getCommandeActive();
                if (!$commandeActuelle) {
                    creerCommandeNonSoldee($client['id_client']);
                }
            }
        else {
            $erreurs['tel'] = "Aucun client trouvé avec ce numéro de téléphone.";
        }
        }
    }
    // // 2. PRIORITÉ 2 : Si on clique sur un autre bouton (ex: Vérifier Réf), on maintient le client grâce au formulaire unique
    // unset($commandeActuelle);
    // $commandeActuelle = getCommandeActive();

    
    // 2. PRIORITÉ 2 : On ne recharge la commande en cours que si on ne vient pas de faire une recherche de client
    if (!isset($_POST['btn_chercher_client'])) {
        $commandeActuelle = getCommandeActive();

        if ($commandeActuelle) {
            $client = findClientById($commandeActuelle['id_client']);
            if ($client) {
                $nom = $client['nom'];
                $prenom = $client['prenom'];
                $tel_saisi = $client['telephone'];
                $client_existe = true;
            }
        }
    } else {
        // CORRECTION : Si on vient de chercher un numéro de téléphone...
        if ($client_existe) {
            // Si le client existe, on charge sa commande active
            $commandeActuelle = getCommandeActive(); 
        } else {
            // Si le client n'existe pas, la commande actuelle DOIT être nulle pour vider l'écran
            $commandeActuelle = null; 
        }
    }

    // 3. CLIC : Recherche du produit (Bouton OK n°2 / Vérifier Réf)
    if (isset($_POST['btn_chercher_produit'])) {
        $ref_saisie = $_POST['ref'];
          isEmpty('ref', $ref_saisie, $erreurs, "Veuillez saisir une référence produit.");
           if (!isset($erreurs['ref']) && !isReference($ref_saisie)) {
            $erreurs['ref'] = "La référence n'est pas valide.";
        }

         if (!isset($erreurs['ref'])) {
        $produit = findProduitByRef($ref_saisie);
        if ($produit) {
            $libelle = $produit['libelle'];
            $prix = $produit['prix'];
            $stock = $produit['stock'];
            $id_produit_cache = $produit['id_produit'];
            $produit_existe = true;
        }
    
        else {
               // AJOUT : Le produit n'existe pas
            $erreurs['ref'] = "Aucun produit trouvé avec cette référence.";
        }
         }
    }

    // ... (Reste de la fonction inchangé pour l'ajout au panier, la suppression et la validation)


    // 5. CLIC : Ajouter au panier
    if (isset($_POST['btn_ajouter_panier'])) {
        $qteSaisie = (int)$_POST['qte_saisie'];
        $stockDispo = (int)$_POST['stock_actuel'];
        $idProd = $_POST['id_produit_actuel'];
        $prixProd = $_POST['prix_actuel'];

        if ($qteSaisie <= $stockDispo && $commandeActuelle) {
            ajouterProduitACommande($commandeActuelle['id_commande'], $idProd, $qteSaisie, $prixProd);
            header("Location: " . path("commande", "addCommande"));
            exit();
        }
    }

    // 6. CLIC : Supprimer une ligne
    if (isset($_POST['btn_supprimer_ligne'])) {
        $idProdASupprimer = $_POST['id_produit_supprimer'];
        if ($commandeActuelle) {
            supprimerProduitDuPanier($commandeActuelle['id_commande'], $idProdASupprimer);
            header("Location: " . path("commande", "addCommande"));
            exit();
        }
    }

    // 7. CLIC : Enregistrer final
    if (isset($_POST['btn_enregistrer'])) {
        if ($commandeActuelle) {
            $lignes = getLignesPanier($commandeActuelle['id_commande']);
            $totalGeneral = 0;
            foreach ($lignes as $l) {
                $totalGeneral += ($l['quantite'] * $l['prix_vente']);
            }
            $libelleFinal = "Commande Client N°" . $commandeActuelle['id_client'];
            validerCommandeDefinitif($commandeActuelle['id_commande'], $totalGeneral, $libelleFinal);

            header("Location: " . path("commande", "index"));
            exit();
        }
    }

    // 8. Récupération des lignes pour le tableau (Correction avec vos vraies colonnes de BDD)
    $lignesPanierHTML = [];
    $totalAffichage = 0;
    if ($commandeActuelle) {
        $lignesPanierHTML = getLignesPanier($commandeActuelle['id_commande']);
        foreach ($lignesPanierHTML as $l) {
            // Utilisation des vrais index de votre table produit_commande
            $totalAffichage += ($l['quantite'] * $l['prix_vente']);
        }
    }

    loadView("commande/addCommande", [
        "nom" => $nom,
        "prenom" => $prenom,
        "libelle" => $libelle,
        "prix" => $prix,
        "stock" => $stock,
        "id_produit_cache" => $id_produit_cache,
        "tel_saisi" => $tel_saisi,
        "ref_saisie" => $ref_saisie,
        "client_existe" => $client_existe,
        "produit_existe" => $produit_existe,
        "commandeActuelle" => $commandeActuelle,
        "lignesPanierHTML" => $lignesPanierHTML,
        "totalAffichage" => $totalAffichage,
         "erreurs" => $erreurs 
    ]);
}

function VoireCommandeAction()
{
    // $id = $_GET["id"] ?? null;
    // $commande = findCommandeById($id);
    // $commandeDetails = findCommandeDetailsById($id);
    // require_once(ROOT. "views/commande/voireCommande.php");

    // 1. On récupère l'ID uniquement depuis l'URL (GET) et on force un entier
    $id = isset($_GET["id"]) ? (int)$_GET["id"] : null;

    // 2. Si pas d'ID, on redirige vers la liste des commandes
    if (!$id) {
        header("Location: " . path("commande", "index"));
        exit();
    }

    // 3. Récupération des données
    $commande = findCommandeById($id);

    // 4. Si la commande n'existe pas en BDD, on redirige aussi
    if (!$commande) {
        header("Location: " . path("commande", "index"));
        exit();
    }
     // SÉCURITÉ CLIENT : Un client ne peut pas voir les détails de la commande d'un autre client
     if (isClient() && $commande['id_client'] !== $_SESSION['user']['id_client']) {
        header("Location: " . path("commande", "index"));
        exit();
    }

    $commandeDetails = findCommandeDetailsById($id);

    // 5. Inclusion de la vue
    loadView("commande/voireCommande", ["commande" => $commande, "commandeDetails" => $commandeDetails]);
}

function indexAction()
{
    commandeAction();
}

// Sécurité globale : Si pas connecté, redirection vers la page de connexion
if (!isConnected()) {
    header("Location: " . path("auth", "login"));
    exit();
}

    