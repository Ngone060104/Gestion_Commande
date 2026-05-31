<?php
define("WEBROOT","http://localhost:8005/");
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

require_once(ROOT."db/db.php");
require_once(ROOT."core/route.php");
require_once(ROOT."db/helpers.php");
require_once(ROOT."db/validator.php");


// On récupère le nom du contrôleur (par défaut 'client')
$ctrl=$_REQUEST["controller"]??"dashboard";
// On appelle la fonction de routage définie ailleurs
dispatch($ctrl);
// echo "test index";

// Dans public/index.php

// Si l'utilisateur n'est pas connecté et qu'il ne demande pas explicitement à aller sur le contrôleur d'authentification
if (!isset($_SESSION['user']) && ($_REQUEST['controller'] ?? '') !== 'auth') {
    header("Location: " . path("auth", "login"));
    exit();
}


