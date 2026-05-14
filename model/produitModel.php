<?php
require_once(ROOT."db/db.php");

function findAllProduit(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM produit");
    return $stmt->fetchAll();
}
function saveProduit($ref,$libelle, $description ,$prix, $stock){
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO produit(ref,libelle,description,prix,stock)VALUES(?, ?, ?, ?, ?)");
    // Exécution avec les valeurs
   return $stmt->execute([$ref,$libelle, $description ,$prix, $stock]);
}
function findProduitById($id){
    $pdo=getPDO();
    $stmt=$pdo -> prepare("SELECT* FROM produit WHERE id_produit = ?");
    $stmt->execute([$id]);
    return $stmt -> fetch();
}
function updateProduit($id, $ref, $libelle, $description, $prix, $stock){
    $pdo = getPDO();
    $stmt= $pdo -> prepare("UPDATE produit SET ref = ?, libelle = ?, description = ?, prix = ?, stock = ? WHERE id_produit = ?");
    return $stmt -> execute([$ref, $libelle, $description, $prix, $stock, $id]);
}
function deleteProduit($id){
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM produit WHERE id_produit = ?");
    return $stmt->execute([$id]);
}