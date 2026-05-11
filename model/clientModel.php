<?php
require_once(ROOT."db/db.php");

function findAllClients(){
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM client");
    return $stmt->fetchAll();
}