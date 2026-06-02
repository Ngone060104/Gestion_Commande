<?php
// define("WEBROOT","http://localhost:8005/");
// define("ROOT", (substr($_SERVER['DOCUMENT_ROOT'] ,0, -6)));
define("WEBROOT","https://gestioncommande.alwaysdata.net/");
define("ROOT", dirname(__DIR__) . "/");
require_once(ROOT."env.prod.php");
require_once(ROOT."env.dev.php");
require_once(ROOT."db/db.php");
require_once(ROOT."core/route.php");
require_once(ROOT."db/helpers.php");
require_once(ROOT."db/validator.php");

// 1. On récupère l'URL nettoyée transmise par le .htaccess, par défaut "dashboard"
$urlString = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard';
// 2. On découpe l'URL par les slashes "/" (Ex: "client/addClient" -> ["client", "addClient"])
$urlParams = explode('/', $urlString);
// 3. Le premier paramètre est le contrôleur
$ctrl = !empty($urlParams[0]) ? $urlParams[0] : 'dashboard';

// On récupère le nom du contrôleur (par défaut 'client')
// $ctrl=$_REQUEST["controller"]??"dashboard";
// On appelle la fonction de routage définie ailleurs
// echo "test index";


// 4. SÉCURITÉ : Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user']) && $ctrl !== 'auth') {
    // Note : Il faudra aussi modifier votre fonction path() pour générer des URL propres (ex: /auth/login)
    header("Location: " . WEBROOT . "auth/login");
    exit();
    }
    dispatch($ctrl);
    
    // Si l'utilisateur n'est pas connecté et qu'il ne demande pas explicitement à aller sur le contrôleur d'authentification
    // if (!isset($_SESSION['user']) && ($_REQUEST['controller'] ?? '') !== 'auth') {
        //     header("Location: " . path("auth", "login"));
//     exit();
// }


