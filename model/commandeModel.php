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
    $sql = "SELECT c.*, cl.nom AS nom_client, cl.prenom AS prenom_client FROM commande c LEFT JOIN client cl ON c.id_client = cl.id_client WHERE c.id_commande = ?";    
    return executeSelect($sql, [$id], true);
}

function getCommandeById($id){
    $sql = "SELECT * FROM commande WHERE id_commande = ?";
    return executeSelect($sql, [$id], true);
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
    $sql  = "SELECT c.*,  pc.quantite AS quantite_achetee, p.libelle, p.stock, p.prix, cl.nom AS nom_client, cl.prenom AS prenom_client 
            FROM commande c 
            JOIN produit_commande pc ON c.id_commande = pc.id_commande 
            JOIN produit p ON pc.id_produit = p.id_produit 
            JOIN client cl ON c.id_client = cl.id_client 
            WHERE c.id_commande = ?";
    return executeSelect($sql, [$id]);
}

// Recherche un client par son téléphone
function findClientByTel($tel) {
    $sql = "SELECT * FROM client WHERE telephone = ?";
    return executeSelect($sql, [$tel], true);
}
// Recherche un produit par sa référence
function findProduitByRef($ref) {
    $sql = "SELECT * FROM produit WHERE ref = ?";
    return executeSelect($sql, [$ref], true);
}


// creer la commande avec statut non soldé
function creerCommandeNonSoldee($id_client) {
       $pdo = getPDO();
    // Utilisation de votre statut exact : 'non soldé'
    $sql = "INSERT INTO commande (date_commande, libelle, montant_total, statut, id_client) 
            VALUES (NOW(), 'Nouvelle commande', 0, 'non soldé', ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_client]);
    return $pdo->lastInsertId();
}
// D. Récupérer la commande active (celle qui est 'non soldé')
function getCommandeActive() {
    $sql = "SELECT * FROM commande WHERE statut = 'non soldé' LIMIT 1";
    return executeSelect($sql, [], true);
}
// E. Insérer un produit dans votre table de liaison 'produit_commande'
function ajouterProduitACommande($id_Commande, $id_produit, $quantite, $prix_vente) {
    $sql = "INSERT INTO produit_commande (id_commande, id_produit, quantite, prix_vente) VALUES (?, ?, ?, ?)";
    return executeUpdate($sql, [$id_Commande, $id_produit, $quantite, $prix_vente]);   
}

// F. Récupérer le panier depuis votre table 'produit_commande'
function getLignesPanier($id_commande) {
    $sql = "SELECT pc.*, p.libelle, pc.prix_vente AS prix_vente FROM produit_commande pc 
            JOIN produit p ON pc.id_produit = p.id_produit 
            WHERE pc.id_commande = ?";
    return executeSelect($sql, [$id_commande]);
}

// G. Clôture de la commande : passage au statut 'soldé' et baisse dynamique du stock

function validerCommandeDefinitif($id_commande, $total, $libelleCommande) {
    // 1. Mise à jour du statut de la commande en 'soldé'
    $sql1 = "UPDATE commande SET statut = 'soldé', montant_total = ?, libelle = ? WHERE id_commande = ?";
    executeUpdate($sql1, [$total, $libelleCommande, $id_commande]);

    // 2. Décrémentation dynamique des stocks 
    $lignes = getLignesPanier($id_commande);
    foreach($lignes as $ligne) {
        $sql2 = "UPDATE produit SET stock = stock - ? WHERE id_produit = ?";
        executeUpdate($sql2, [$ligne['quantite'], $ligne['id_produit']]);
    }
}

function supprimerProduitDuPanier($idCommande, $idProduit) {
    $sql = "DELETE FROM produit_commande WHERE id_commande = ? AND id_produit = ?";
    return executeUpdate($sql, [$idCommande, $idProduit]);
}

function findCommandesByClientId($idClient) {
    $sql = "SELECT * FROM commande WHERE id_client = ?";
    return executeSelect($sql, [$idClient]);
}
function findArticlesByCommandeId($idCommande) {
    $sql = "SELECT p.libelle AS nom_produit, pc.quantite, pc.prix_vente 
            FROM produit_commande pc 
            JOIN produit p ON pc.id_produit = p.id_produit 
            WHERE pc.id_commande = ?";
    return executeSelect($sql, [$idCommande]);      
}