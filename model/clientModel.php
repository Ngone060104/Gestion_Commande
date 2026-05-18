<?php
require_once(ROOT."db/db.php");

function findAllClients(){
    $sql = "SELECT * FROM client";
    return executeSelect($sql);
}
function saveClient($nom, $prenom, $email, $telephone, $adresse){
    $sql = "INSERT INTO client(nom,prenom,email,telephone,adresse)VALUES(?, ?, ?, ?, ?)";
    return executeUpdate($sql,[$nom, $prenom, $email, $telephone, $adresse]);
}
function findClientById($id){
    $sql = "SELECT* FROM client WHERE id_client = ?";
    return executeSelect($sql, [$id], true);
}
function updateClient($id, $nom, $prenom, $email, $telephone, $adresse){
    $sql = "UPDATE client SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ? WHERE id_client = ?";
    return executeUpdate($sql, [$nom, $prenom, $email, $telephone, $adresse, $id]);
}
function deleteClient($id){
    $sql = "DELETE FROM client WHERE id_client = ?";
    return executeDelete($sql, [$id]);

}
