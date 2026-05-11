<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commandes</title>
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cloudflare.com">
</head>
<body class="bg-gray-100 flex h-screen">
    
    <!-- On inclut la sidebar ici pour qu'elle soit sur toutes les pages -->
    <?php require_once(ROOT."views/sidebar.php"); ?>

    <!-- Contenu principal à droite -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Top Header -->
        <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 border-gray-200">
            <div class="flex items-center">
                <button class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h2 class="text-xl font-semibold text-gray-800 ml-4">Tableau de Bord</h2>
            </div>

            <div class="flex items-center">
                <div class="relative">
                    <button class="flex items-center text-gray-700 hover:text-blue-600">
                        <span class="mr-2">Administrateur</span>
                        <img class="h-8 w-8 rounded-full border-2 border-blue-500" src="https://ui-avatars.com" alt="Avatar">
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content (Le contenu dynamique s'affichera ici) -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
