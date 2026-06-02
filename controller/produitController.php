<?php
require_once(ROOT."model/produitModel.php");
// echo "test controller";
function produitAction(){
    $produits = findAllProduit();
    // echo "<pre>";
    // var_dump($produits);
    // echo "</pre>";
    loadView("produit/listProduit",["produits"=>$produits]);
}

function addProduitAction(){
    $errors = [];
    if(isset($_POST['ajouter'])){
        isEmpty('ref', $_POST['ref'] ?? null, $errors, "La référence est obligatoire.");
        isEmpty('libelle', $_POST['libelle'] ?? null, $errors, "Le libellé est obligatoire.");
        isEmpty('description', $_POST['description'] ?? null, $errors, "La description est obligatoire.");
        isEmpty('prix', $_POST['prix'] ?? null, $errors, "Le prix est obligatoire.");
        isEmpty('stock', $_POST['stock'] ?? null, $errors, "Le stock est obligatoire.");
        $ref = $_POST['ref'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        if (!isset($errors['ref']) && !isReference($_POST['ref'])) {
            $errors['ref'] = "La référence n'est pas valide.";
        }
        if (!isset($errors['prix']) && !isPrice($_POST['prix'])) {
            $errors['prix'] = "Le prix doit être un nombre positif.";
        }
      if (validate($errors)) {
        if(saveProduit($ref, $libelle, $description, $prix, $stock)){
            header("Location:".path("produit", "index"));
            exit();
        }else{
            $errors['global'] = "Erreur lors de l'ajout du produit";
        }
    }
    }
    // require_once(ROOT. "views/produit/addProduit.php");
    loadView("produit/addProduit", ["erreurs" => $errors]);
}function updateProduitAction(){
    // Récupération de l'ID injecté par le dispatch dans $_GET['id'] ou envoyé en POST
    $id = $_POST['id'] ?? $_GET['id'] ?? null;

    if (!$id) {
        header("Location: " . path("produit", "index"));
        exit();
    }

    $errors = [];
    // Récupération du produit pour alimenter le formulaire
    $produit = findProduitById($id); 

    // Traitement uniquement lors de la soumission du formulaire (POST)
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $ref = $_POST['ref'] ?? null;
        $libelle = $_POST['libelle'] ?? null;
        $description = $_POST['description'] ?? null;
        $prix = $_POST['prix'] ?? null;
        $stock = $_POST['stock'] ?? null;

        isEmpty('ref', $ref, $errors, "La référence est obligatoire.");
        isEmpty('libelle', $libelle, $errors, "Le libellé est obligatoire.");
        isEmpty('prix', $prix, $errors, "Le prix est obligatoire.");
        isEmpty('stock', $stock, $errors, "Le stock est obligatoire.");

        if (validate($errors)) {
            // Appel de votre fonction SQL de mise à jour
            $success = updateProduit($id, $ref, $libelle, $description, $prix, $stock);

            if ($success) {
                $_SESSION['success_produit'] = "Produit mis à jour avec succès !";
                header("Location: " . path("produit", "index"));
                exit();
            }
        }
    }

    // CORRECT : Placé en dehors du bloc POST pour s'afficher correctement lors du chargement initial (GET)
    loadView("produit/updateProduit", [
        "produit" => $produit, 
        "erreurs" => $errors
    ]);
}


function deleteProduitAction(){
    $id = $_REQUEST["id"] ?? null;
    if($id){
        deleteProduit($id);
    }
    header("Location:".path("produit", "index"));
    exit();
}
function indexAction(){
    produitAction();
}
?>
