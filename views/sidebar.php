<div class="hidden lg:flex flex-col w-64 bg-gray-900 shadow-xl">
    <div class="flex items-center justify-center h-20 bg-gray-800">
        <h1 class="text-white text-xl font-bold uppercase tracking-wider">
            <i class="fas fa-box-open mr-2 text-blue-400"></i>GESTION CMD
        </h1>
    </div>
    
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="<?= WEBROOT ?>?controller=dashboard" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
            <i class="fas fa-home w-8"></i>
            <span>Accueil</span>
        </a>

        <a href="<?= WEBROOT ?>?controller=client&action=index" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
            <i class="fas fa-users w-8"></i>
            <span>Clients</span>
        </a>

        <a href="<?= WEBROOT ?>?controller=produit&action=index" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
            <i class="fas fa-tags w-8"></i>
            <span>Produits</span>
        </a>

        <a href="<?= WEBROOT ?>?controller=commande" class="flex items-center px-4 py-3 text-gray-300 hover:bg-blue-600 hover:text-white rounded-lg transition-all">
            <i class="fas fa-shopping-cart w-8"></i>
            <span>Commandes</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-800">
        <a href="#" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900/20 rounded-lg">
            <i class="fas fa-sign-out-alt w-8"></i>
            <span>Déconnexion</span>
        </a>
    </div>
</div>
