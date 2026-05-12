<?php
require_once(ROOT."db/db.php");

function findAllCommandes(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM commande");
    return $stmt->fetchAll();
}
function saveCommande($date_commande, $id_produit,$id_client){
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO commande(date_commande, id_produit, id_client) VALUES(?, ?, ?, ?)");
    // Exécution avec les valeurs
    return $stmt->execute([$date_commande, $id_produit, $id_client]);
         // L'ID de la dernière ligne insérée     
}
function findCommandeById($id){
    $pdo=getPDO();
    $stmt=$pdo -> prepare("SELECT c.* , cl.nom AS nom_client , cl.prenom AS prenom_client FROM commande c LEFT JOIN client cl ON c.id_client = cl.id_client WHERE c.id_commande = ?");
    $stmt->execute([$id]);
    return $stmt -> fetch();
}
function updateCommande($id, $date_commande, $id_produit, $id_client){
    $pdo = getPDO();
    $stmt= $pdo -> prepare("UPDATE commande SET date_commande = ?, id_produit = ?, id_client = ? WHERE id_commande = ?");
    return $stmt -> execute([$date_commande, $id_produit, $id_client, $id]);
}
function deleteCommande($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM commande WHERE id_commande = ?");
    return $stmt->execute([$id]);
}

function findCommandeDetailsById($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT c.*, p.libelle AS nom_produit, p.stock AS stock_produit, p.prix AS prix_produit, cl.nom AS nom_client, cl.prenom AS prenom_client FROM commande c JOIN produit p ON c.id_produit = p.id_produit JOIN client cl ON c.id_client = cl.id_client WHERE c.id_commande = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}