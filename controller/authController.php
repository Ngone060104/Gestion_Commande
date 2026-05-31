<?php
require_once(ROOT . "model/clientModel.php");

function loginAction() {
    $erreurs = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validations des champs vides via vos fonctions habituelles
        isEmpty('email', $email, $erreurs, "L'adresse email est obligatoire.");
        isEmpty('password', $password, $erreurs, "Le mot de passe est obligatoire.");

        if (validate($erreurs)) {
            // Vérification en Base de Données
            $user = findClientByEmailAndPassword($email, $password);

            if ($user) {
                // Ouverture de la session globale
                $_SESSION['user'] = $user;
                
                // Redirection vers le tableau de bord principal
                header("Location: " . path("dashboard", "index"));
                exit();
            } else {
                $erreurs['global'] = "Identifiants incorrects ou utilisateur introuvable.";
            }
        }
    }

    // On charge la vue de connexion. On utilise un layout vide "blank" 
    // pour éviter d'afficher la Sidebar noire sur la page de login !
    loadView("auth/login", ["erreurs" => $erreurs], "blank");
}

function logoutAction() {
    // Destruction complète de la session
    unset($_SESSION['user']);
    session_destroy();
    
    header("Location: " . path("auth", "login"));
    exit();
}

function authAction() {
    // On redirige vers votre formulaire de connexion
    loginAction(); 
}