<?php
require_once(ROOT."db/db.php");

function findAllClients(){
    $sql = "SELECT * FROM client WHERE role = 'client'";
    return executeSelect($sql);
}

function saveClient($nom, $prenom, $email, $telephone, $adresse,$photo){
    $sql = "INSERT INTO client(nom,prenom,email,telephone,adresse,photo)VALUES(?, ?, ?, ?, ?, ?)";
    return executeUpdate($sql,[$nom, $prenom, $email, $telephone, $adresse, $photo]);
}
function findClientById($id){
    $sql = "SELECT* FROM client WHERE id_client = ?";
    return executeSelect($sql, [$id], true);
}
function updateClient($id, $nom, $prenom, $email, $telephone, $adresse,$photo){
    $sql = "UPDATE client SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, photo = ? WHERE id_client = ?";
    return executeUpdate($sql, [$nom, $prenom, $email, $telephone, $adresse, $photo, $id]);
}
function deleteClient($id){
    $sql = "DELETE FROM client WHERE id_client = ?";
    return executeDelete($sql, [$id]);

}
function findClientByEmailAndPassword(string $email, string $password) {
    // Requête sécurisée préparée
    $sql = "SELECT * FROM client WHERE email = ? AND mot_de_passe = ?";
    return executeSelect($sql, [$email, $password], true);
}

