<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commandes</title>
    <!-- Script Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lien FontAwesome complet pour charger vos icônes -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">

    <!-- ========================================== -->
    <!-- 1. BARRE LATÉRALE NOIRE À GAUCHE           -->
    <!-- ========================================== -->
    <div class="hidden lg:flex flex-col w-64 bg-gray-900 shadow-xl">
        <div class="flex items-center justify-center h-20 bg-gray-800">
            <h1 class="text-white text-xl font-bold uppercase tracking-wider">
                <i class="fas fa-box-open mr-2 text-blue-400"></i>GESTION CMD
            </h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="<?= path('dashboard', 'index') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                <i class="fas fa-home w-8"></i><span>Accueil</span>
            </a>

            <!-- SEUL L'ADMIN voit l'onglet général des Clients et des Produits -->
            <?php if (isAdmin()): ?>
                <a href="<?= path('client', 'index') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                    <i class="fas fa-users w-8"></i><span>Clients</span>
                </a>
                <a href="<?= path('produit', 'index') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                    <i class="fas fa-tags w-8"></i><span>Produits</span>
                </a>
            <?php endif; ?>

            <!-- Tout le monde voit l'onglet commandes (filtré par le contrôleur) -->
            <a href="<?= path('commande', 'index') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                <i class="fas fa-shopping-cart w-8"></i><span>Commandes</span>
            </a>

            <!-- LE CLIENT voit son propre onglet Profil -->
            <?php if (isClient()): ?>
                <a href="<?= path('client', 'profile') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
                    <i class="fas fa-user w-8"></i><span>Mon Profil</span>
                </a>
            <?php endif; ?>
        </nav>


        <div class="p-4 border-t border-gray-800">
            <a href="<?= path('auth', 'logout') ?>" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900/20 rounded-lg">
                <i class="fas fa-sign-out-alt w-8"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2. CONTENU PRINCIPAL À DROITE              -->
    <!-- ========================================== -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Header blanc -->
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

        <!-- Zone d'affichage de vos listes/formulaires -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <!-- Injection de la vue dynamique -->
            <?= $content ?>
        </main>
    </div>
</body>

</html>