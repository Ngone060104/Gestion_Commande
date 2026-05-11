<?php
require_once(ROOT."db/db.php");

function findAllClients(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM client");
    return $stmt->fetchAll();
}
function saveClient($nom, $prenom, $email, $telephone, $adresse){
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO client(nom,prenom,email,telephone,adresse)VALUES(?, ?, ?, ?, ?)");
    // Exécution avec les valeurs
   return $stmt->execute([$nom, $prenom, $email, $telephone, $adresse]);
         // L'ID de la dernière ligne insérée     
}