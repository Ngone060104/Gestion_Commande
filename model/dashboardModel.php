<?php

// Fonctions pour l'ADMINISTRATEUR
function countAllClients() {
    $sql = "SELECT COUNT(*) AS total FROM client WHERE role = 'client'";
    $res = executeSelect($sql, [], true);
    return $res['total'] ?? 0;
}

function countAllCommandes() {
    $sql = "SELECT COUNT(*) AS total FROM commande WHERE statut = 'soldé'";
    $res = executeSelect($sql, [], true);
    return $res['total'] ?? 0;
}

function getChiffreAffaires() {
    $sql = "SELECT SUM(montant_total) AS total FROM commande WHERE statut = 'soldé'";
    $res = executeSelect($sql, [], true);
    return $res['total'] ?? 0;
}

// Fonctions pour le CLIENT connecté
function countClientCommandes($idClient) {
    $sql = "SELECT COUNT(*) AS total FROM commande WHERE id_client = ?";
    $res = executeSelect($sql, [$idClient], true);
    return $res['total'] ?? 0;
}

function getClientMontantTotal($idClient) {
    $sql = "SELECT SUM(montant_total) AS total FROM commande WHERE id_client = ? AND statut = 'soldé'";
    $res = executeSelect($sql, [$idClient], true);
    return $res['total'] ?? 0;
}
