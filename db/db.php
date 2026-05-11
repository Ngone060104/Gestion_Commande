<?php
// Configuration de la connexion

function getPDO(){
    // static permet de garder la variable en mémoire entre plusieurs appels
    static $pdo = null; 

    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=127.0.0.1;dbname=estioncommande;charset=utf8;port=3306",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch(PDOException $e) {
            die("Erreur PDO : " . $e->getMessage());
        }
    }
    return $pdo;
}

?>