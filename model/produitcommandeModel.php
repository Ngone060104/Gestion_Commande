<?php
require_once(ROOT."db/db.php");

function findAllProduitcommande(){
    $sql = "SELECT * FROM produit_commande";
    return executeSelect($sql);
}
function saveProduitcommande( $id_commande,$id_produit, $quantite,$prix_vente){
$sql ="INSERT INTO produit_commande(id_commande, id_produit, quantite, prix_vente) VALUES (?, ?, ?, ?)";
return executeUpdate($sql, [$id_commande,$id_produit, $quantite,$prix_vente]);
}