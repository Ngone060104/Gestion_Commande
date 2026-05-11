<?php
require_once(ROOT."model/clientModel.php");
// echo "test controller";
function clientAction(){
    $clients = findAllClients();
    // echo "<pre>";
    // var_dump($clients);
    // echo "</pre>";
    require_once(ROOT. "views/client/listClient.php");
}
function addClientAction(){
    if(isset($_POST['ajouter'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];

        if(saveClient($nom, $prenom, $email, $telephone, $adresse)){
            header("Location:".WEBROOT."?controller=client");
            exit();
        }else{
            echo "Erreur lors de l'ajout du client.";
        }
    }
    require_once(ROOT. "views/client/addClient.php");
}