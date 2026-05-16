<?php
require_once(ROOT."db/db.php");

function findAllProduit(){
    $sql = "SELECT * FROM produit";
    return executeSelect($sql);
}
function saveProduit($ref,$libelle, $description ,$prix, $stock){
    $sql= "INSERT INTO produit(ref,libelle,description,prix,stock)VALUES(?, ?, ?, ?, ?)";
    return executeUpdate($sql, [$ref,$libelle, $description ,$prix, $stock]);
}
function findProduitById($id){
    $pdo=getPDO();
    $stmt=$pdo -> prepare("SELECT* FROM produit WHERE id_produit = ?");
    $stmt->execute([$id]);
    return $stmt -> fetch();
}
function updateProduit($id, $ref, $libelle, $description, $prix, $stock){
    $sql = "UPDATE produit SET ref = ?, libelle = ?, description = ?, prix = ?, stock = ? WHERE id_produit = ?";
    return executeUpdate($sql,[$ref, $libelle, $description, $prix, $stock, $id]);
}
function deleteProduit($id){
    $sql = "DELETE FROM produit WHERE id_produit = ?";
    return executeDelete($sql, [$id]);
}