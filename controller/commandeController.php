<?php
require_once(ROOT."model/commandeModel.php");
// echo "test controller";
function commandeAction(){
    $commandes = findAllCommandes();
    // echo "<pre>";
    // var_dump($commandes);
    // echo "</pre>";
    require_once(ROOT. "views/commande/listCommande.php");
}

function addCommandeAction(){
    if(isset($_POST['ajouter'])){
        $date = $_POST['date_commande'];
        $id_produit = $_POST['id_produit'];
        $id_client = $_POST['id_client'];

        if(saveCommande($date, $id_produit, $id_client)){
            header("Location:".WEBROOT."?controller=commande");
            exit();
        }else{
            echo "Erreur lors de l'ajout de la commande.";
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