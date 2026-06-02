<?php
// function dispatch($controllerName) {
//     // On construit dynamiquement le chemin du contrôleur
//     $controllerFile = ROOT . "controller/" . $controllerName . "Controller.php";

//     if (file_exists($controllerFile)) {
//         require_once($controllerFile);
//         $action = $_REQUEST['action'] ?? $controllerName;
//         $functionName = $action . "Action";  
//         if (function_exists($functionName)) {
//             $functionName();
//         } else {
//             die("Erreur : La fonction '{$functionName}' n'existe pas dans le contrôleur.");
//         }
//     } else {
//         die("Erreur : Le contrôleur '{$controllerName}' n'existe pas.");
//     }
// } 

function dispatch($controllerName) {
    // 1. On récupère l'URL brute pour extraire l'action
    $urlString = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
    $urlParams = explode('/', $urlString);
    
    // 2. L'action est le deuxième paramètre dans l'URL (ex: client/addClient -> addClient)
    // Si le deuxième paramètre est vide, l'action prend par défaut le nom du contrôleur
    $action = isset($urlParams[1]) && !empty($urlParams[1]) ? $urlParams[1] : $controllerName;

     // [NOUVEAU] 2.5. Si un troisième paramètre existe dans l'URL (ex: client/updateClient/12 -> 12)
    // On le stocke dans $_GET et $_REQUEST pour que vos contrôleurs puissent le lire via $_REQUEST['id']
    if (isset($urlParams[2]) && !empty($urlParams[2])) {
        $_GET['id'] = $urlParams[2];
        $_REQUEST['id'] = $urlParams[2];
    }

    // 3. On construit dynamiquement le chemin du contrôleur
    $controllerFile = ROOT . "controller/" . $controllerName . "Controller.php";

    if (file_exists($controllerFile)) {
        require_once($controllerFile);
        
        $functionName = $action . "Action";  
        if (function_exists($functionName)) {
            $functionName();
        } else {
            die("Erreur : La fonction '{$functionName}' n'existe pas dans le contrôleur.");
        }
    } else {
        die("Erreur : Le contrôleur '{$controllerName}' n'existe pas.");
    }
}