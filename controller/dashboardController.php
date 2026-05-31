<?php
require_once(ROOT . "model/dashboardModel.php");

function indexAction() {
    // Sécurité : Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header("Location: " . path("auth", "login"));
        exit(); 
    }

    $user = $_SESSION['user'];
    $stats = [];

    if ($user['role'] === 'admin') {
        // Statistiques globales pour l'Admin
        $stats['case1_titre'] = "Total Clients";
        $stats['case1_valeur'] = countAllClients();
        $stats['case1_icone'] = "fas fa-users text-blue-500 bg-blue-50";

        $stats['case2_titre'] = "Commandes Validées";
        $stats['case2_valeur'] = countAllCommandes();
        $stats['case2_icone'] = "fas fa-shopping-basket text-emerald-500 bg-emerald-50";

        $stats['case3_titre'] = "Chiffre d'Affaires";
        $stats['case3_valeur'] = number_format(getChiffreAffaires(), 0, ',', ' ') . " FCFA";
        $stats['case3_icone'] = "fas fa-wallet text-amber-500 bg-amber-50";
    } else {
        // Statistiques personnalisées pour le Client
        $stats['case1_titre'] = "Mes Commandes";
        $stats['case1_valeur'] = countClientCommandes($user['id_client']);
        $stats['case1_icone'] = "fas fa-box text-purple-500 bg-purple-50";

        $stats['case2_titre'] = "Total Dépensé";
        $stats['case2_valeur'] = number_format(getClientMontantTotal($user['id_client']), 0, ',', ' ') . " FCFA";
        $stats['case2_icone'] = "fas fa-coins text-emerald-500 bg-emerald-50";

        $stats['case3_titre'] = "Mon Statut Compte";
        $stats['case3_valeur'] = "Client Privilège";
        $stats['case3_icone'] = "fas fa-award text-blue-500 bg-blue-50";
    }

    // Chargement de la vue dashboard
    loadView("dashboard/index", [
        "stats" => $stats,
        "user" => $user
    ]);
}

function dashboardAction() {
    // On redirige immédiatement vers votre fonction existante
    indexAction(); 
}