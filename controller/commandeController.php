<?php
require_once(ROOT."model/commandeModel.php");
require_once(ROOT."model/clientModel.php");

function commandeAction(){
    $commandes = findAllCommandes();
    require_once(ROOT. "views/commande/listCommande.php");
}

function addCommandeAction(){
    // Initialisation obligatoire de TOUTES les variables pour la vue
    $nom = ""; $prenom = ""; $libelle = ""; $prix = ""; $stock = ""; $id_produit_cache = "";
    $tel_saisi = ""; $ref_saisie = "";
    $client_existe = false; $produit_existe = false;
   
    // 1. ANCRE DE PERSISTENCE : On recharge le client en priorité s'il est présent dans le formulaire global
    if (!empty($_POST['tel'])) {
        $tel_saisi = $_POST['tel'];
        $client = findClientByTel($tel_saisi);
        if ($client) {
            $nom = $client['nom'];
            $prenom = $client['prenom'];
            $client_existe = true; // Garde les champs client remplis et débloque le reste
        }
    }

    // 2. Récupération de la commande active "non soldé"
    $commandeActuelle = getCommandeActive();
    
    // Si une commande existe mais que le POST était vide, on récupère le client par la BDD
    if ($commandeActuelle && !$client_existe) {
        $client = findClientById($commandeActuelle['id_client']);
        if ($client) {
            $nom = $client['nom'];
            $prenom = $client['prenom'];
            $tel_saisi = $client['telephone'];
            $client_existe = true;
        }
    }

    // 3. CLIC : Recherche du client (Bouton OK n°1 / Rechercher)
    if (isset($_POST['btn_chercher_client'])) {
        $tel_saisi = $_POST['tel'];
        $client = findClientByTel($tel_saisi);
        if ($client) {
            $nom = $client['nom']; 
            $prenom = $client['prenom'];
            $client_existe = true;
            
            if (!$commandeActuelle) {
                creerCommandeNonSoldee($client['id_client']);
                $commandeActuelle = getCommandeActive();
            }
        }
    }

    // 4. CLIC : Recherche du produit (Bouton OK n°2 / Vérifier Réf)
    if (isset($_POST['btn_chercher_produit'])) {
        $ref_saisie = $_POST['ref'];
        $produit = findProduitByRef($ref_saisie);
        if ($produit) {
            $libelle = $produit['libelle']; 
            $prix = $produit['prix']; 
            $stock = $produit['stock'];
            $id_produit_cache = $produit['id_produit'];
            $produit_existe = true;
        }
    }

    // 5. CLIC : Ajouter au panier
    if (isset($_POST['btn_ajouter_panier'])) {
        $qteSaisie = (int)$_POST['qte_saisie'];
        $stockDispo = (int)$_POST['stock_actuel'];
        $idProd = $_POST['id_produit_actuel'];
        $prixProd = $_POST['prix_actuel'];

        if ($qteSaisie <= $stockDispo && $commandeActuelle) {
            ajouterProduitACommande($commandeActuelle['id_commande'], $idProd, $qteSaisie, $prixProd);
            header("Location: ".WEBROOT."?controller=commande&action=addCommande");
            exit();
        }
    }

    // 6. CLIC : Supprimer une ligne
    if (isset($_POST['btn_supprimer_ligne'])) {
        $idProdASupprimer = $_POST['id_produit_supprimer'];
        if ($commandeActuelle) {
            supprimerProduitDuPanier($commandeActuelle['id_commande'], $idProdASupprimer);
            header("Location: ".WEBROOT."?controller=commande&action=addCommande");
            exit();
        }
    }

    // 7. CLIC : Enregistrer final
    if (isset($_POST['btn_enregistrer'])) {
        if ($commandeActuelle) {
            $lignes = getLignesPanier($commandeActuelle['id_commande']);
            $totalGeneral = 0;
            foreach($lignes as $l) { 
                $totalGeneral += ($l['quantite'] * $l['prix_vente']); 
            }
            $libelleFinal = "Commande Client N°" . $commandeActuelle['id_client'];
            validerCommandeDefinitif($commandeActuelle['id_commande'], $totalGeneral, $libelleFinal);
            
            header("Location: ".WEBROOT."?controller=commande");
            exit();
        }
    }

    // 8. Récupération des lignes pour le tableau (Correction avec vos vraies colonnes de BDD)
     $lignesPanierHTML = []; 
    $totalAffichage = 0;
    if ($commandeActuelle) {
        $lignesPanierHTML = getLignesPanier($commandeActuelle['id_commande']);
        foreach($lignesPanierHTML as $l) {
            // Utilisation des vrais index de votre table produit_commande
            $totalAffichage += ($l['quantite'] * $l['prix_vente']);
        }
    }

    require_once(ROOT. "views/commande/addCommande.php");
}

function VoireCommandeAction(){
    $id = $_REQUEST["id"] ?? null;
    $commande = findCommandeById($id);
    $commandeDetails = findCommandeDetailsById($id);
    require_once(ROOT. "views/commande/voireCommande.php");
}

function indexAction(){
    commandeAction();
}

