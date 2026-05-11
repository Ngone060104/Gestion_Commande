<?php
// echo "<pre>";
// var_dump($_SERVER);
// echo "</pre>";
define("WEBROOT","http://localhost:8002/");
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

require_once(ROOT."views/header.php");
require_once(ROOT."core/route.php");

// On récupère le nom du contrôleur (par défaut 'etudiant')
$ctrl=$_REQUEST["controller"]??"client";
// On appelle la fonction de routage définie ailleurs
dispatch($ctrl);
require_once(ROOT."views/footer.php");

