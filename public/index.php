<?php
define("WEBROOT","http://localhost:8002/");
define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));

require_once(ROOT."db/db.php");
require_once(ROOT."core/route.php");
require_once(ROOT."views/header.php");
// require_once(ROOT."db/helpers.php");


// On récupère le nom du contrôleur (par défaut 'client')
$ctrl=$_REQUEST["controller"]??"client";
// On appelle la fonction de routage définie ailleurs
dispatch($ctrl);
// echo "test index";


