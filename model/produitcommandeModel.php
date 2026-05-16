<?php
require_once(ROOT."db/db.php");

function findAllProduitcommande(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM produit_commande");
    return $stmt->fetchAll();
}
function saveProduitcommande( $id_commande,$id_produit, $quantite,$prix_vente){

    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO produit_commande(id_commande, id_produit, quantite, prix_vente) VALUES (?, ?, ?, ?)");
    // Exécution avec les valeurs
   return $stmt->execute([$id_commande,$id_produit, $quantite,$prix_vente]);
}