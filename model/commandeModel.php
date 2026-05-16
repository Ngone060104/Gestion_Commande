<?php
require_once(ROOT."db/db.php");

function findAllCommandes(){
    $sql = "SELECT * FROM commande";
    return executeSelect($sql);
}
function saveCommande($date_commande,$libelle,$montant_total,$statut,$id_client){
    $sql = "INSERT INTO commande(date_commande, libelle, montant_total, statut, id_client) VALUES(?, ?, ?, ?, ?)";
    return executeUpdate($sql, [$date_commande, $libelle, $montant_total, $statut, $id_client]); 
}
function findCommandeById($id){
    $pdo=getPDO();
    $stmt=$pdo -> prepare("SELECT c.* , cl.nom AS nom_client , cl.prenom AS prenom_client FROM commande c LEFT JOIN client cl ON c.id_client = cl.id_client WHERE c.id_commande = ?");
    $stmt->execute([$id]);
    return $stmt -> fetch();
}
function updateCommande($id, $date_commande, $id_produit, $id_client){
    $sql = "UPDATE commande SET date_commande = ?, id_produit = ?, id_client = ? WHERE id_commande = ?";
    return executeUpdate($sql, [$date_commande, $id_produit, $id_client, $id]);
}
function deleteCommande($id){
    $sql = "DELETE FROM commande WHERE id_commande = ?";
    return executeDelete($sql, [$id]);
}

function findCommandeDetailsById($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT c.*, p.libelle AS nom_produit, p.stock AS stock_produit, p.prix AS prix_produit, cl.nom AS nom_client, cl.prenom AS prenom_client FROM commande c JOIN produit p ON c.id_produit = p.id_produit JOIN client cl ON c.id_client = cl.id_client WHERE c.id_commande = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}