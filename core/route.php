<?php
function dispatch($controllerName) {
    // On construit dynamiquement le chemin du contrôleur
    $controllerFile = ROOT . "controller/" . $controllerName . "Controller.php";

    if (file_exists($controllerFile)) {
        require_once($controllerFile);
        $action = $controllerName . "Action"; 
        if (function_exists($action)) {
            $action();
        }
    } else {
        die("Erreur : Le contrôleur '{$controllerName}' n'existe pas.");
    }
}
