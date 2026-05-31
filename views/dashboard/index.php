<div class="max-w-6xl mx-auto">
    <!-- Message de bienvenue chaleureux -->
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-800">Ravi de vous revoir, <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?> !</h1>
        <p class="text-sm text-gray-500 mt-1">Voici le résumé de l'activité sur votre espace de gestion (Espace <?= ucfirst($user['role']) ?>)</p>
    </div>

    <!-- Grille des statistiques Tailwind -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Carte 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider"><?= $stats['case1_titre'] ?></p>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['case1_valeur'] ?></p>
            </div>
            <!-- CORRECTION : w-16 h-16, text-xl et gestion dynamique de la couleur de fond -->
            <div class="rounded-xl text-xl flex items-center justify-center w-16 h-16 <?= $user['role'] === 'admin' ? 'bg-blue-50 text-blue-500' : 'bg-purple-50 text-purple-500' ?>">
                <i class="<?= $stats['case1_icone'] ?>"></i>
            </div>
        </div>

        <!-- Carte 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider"><?= $stats['case2_titre'] ?></p>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['case2_valeur'] ?></p>
            </div>
            <!-- CORRECTION : w-16 h-16, text-xl et couleur émeraude -->
            <div class="rounded-xl text-xl flex items-center justify-center w-16 h-16 bg-emerald-50 text-emerald-500">
                <i class="<?= $stats['case2_icone'] ?>"></i>
            </div>
        </div>

        <!-- Carte 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider"><?= $stats['case3_titre'] ?></p>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['case3_valeur'] ?></p>
            </div>
            <!-- CORRECTION : w-16 h-16, text-xl et couleur ambre/bleu -->
            <div class="rounded-xl text-xl flex items-center justify-center w-16 h-16 <?= $user['role'] === 'admin' ? 'bg-amber-50 text-amber-500' : 'bg-blue-50 text-blue-500' ?>">
                <i class="<?= $stats['case3_icone'] ?>"></i>
            </div>
        </div>

    </div>


    <!-- Section information additionnelle sous les cartes -->
    <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Accès Rapide</h3>
        <p class="text-sm text-gray-500 mb-4">Utilisez la barre latérale gauche pour naviguer dans vos modules de gestion.</p>
        <div class="flex gap-4">
            <a href="<?= path('commande', 'index') ?>" class="px-4 py-2 bg-gray-800 text-white font-medium rounded-lg text-sm hover:bg-gray-700 transition">
                Voir les commandes
            </a>
            <?php if ($user['role'] === 'client'): ?>
                <a href="<?= path('client', 'profile') ?>" class="px-4 py-2 border border-gray-300 text-gray-600 font-medium rounded-lg text-sm hover:bg-gray-50 transition">
                    Mon profil
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>