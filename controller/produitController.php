<?php
require_once(ROOT."model/produitModel.php");
// echo "test controller";
function produitAction(){
    $produits = findAllProduit();
    // echo "<pre>";
    // var_dump($produits);
    // echo "</pre>";
    require_once(ROOT. "views/produit/listProduit.php");
}

function addProduitAction(){
    if(isset($_POST['ajouter'])){
        $ref = $_POST['ref'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        if(saveProduit($ref, $libelle, $description, $prix, $stock)){
            header("Location:".WEBROOT."?controller=produit");
            exit();
        }else{
            echo "Erreur lors de l'ajout du produit.";
        }
    }
    require_once(ROOT. "views/produit/addProduit.php");
}
function updateProduitAction(){
    $id = $_REQUEST["id"] ?? null;
    if($_SERVER["REQUEST_METHOD"]=== "POST"){
        $ref = $_POST['ref'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        if(updateProduit($id, $ref, $libelle, $description, $prix, $stock)){
            header("Location:".WEBROOT."?controller=produit");
            exit();
        }
    }
    $produit = findProduitById($id);
    require_once (ROOT. "views/produit/updateProduit.php");
}
function deleteProduitAction(){
    $id = $_REQUEST["id"] ?? null;
    if($id){
        deleteProduit($id);
    }
    header("Location:".WEBROOT."?controller=produit");
    exit();
}
function indexAction(){
    produitAction();
}
?>
