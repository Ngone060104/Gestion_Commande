<?php
require_once(ROOT."db/db.php");

function findAllProduit(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM produit");
    return $stmt->fetchAll();
}
function saveProduit($libelle, $prix, $stock){
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO produit(libelle,prix,stock)VALUES(?, ?, ?)");
    // Exécution avec les valeurs
   return $stmt->execute([$libelle, $prix, $stock]);
         // L'ID de la dernière ligne insérée     
}
function findProduitById($id){
    $pdo=getPDO();
    $stmt=$pdo -> prepare("SELECT* FROM produit WHERE id_produit = ?");
    $stmt->execute([$id]);
    return $stmt -> fetch();
}
function updateProduit($id, $libelle, $prix, $stock){
    $pdo = getPDO();
    $stmt= $pdo -> prepare("UPDATE produit SET libelle = ?, prix = ?, stock = ? WHERE id_produit = ?");
    return $stmt -> execute([$libelle, $prix, $stock,$id,]);
}
function deleteProduit($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM produit WHERE id_produit = ?");
    return $stmt->execute([$id]);
}