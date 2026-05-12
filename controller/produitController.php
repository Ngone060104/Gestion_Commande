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
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        if(saveProduit($libelle, $prix, $stock)){
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
        if(updateProduit($id, $_POST['libelle'],$_POST['prix'],$_POST['stock'])){
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
