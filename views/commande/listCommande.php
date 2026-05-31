<div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Liste des Commandes</h1>
           <?php if (isAdmin()): ?>
        <!-- Votre bouton avec votre méthode d'input hidden préférée s'il y a lieu -->
        <a href="<?= path('commande', 'addCommande') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Ajouter une commande
        </a>
    <?php endif; ?>
        </div>

        <!-- Tableau Tailwind -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-xs uppercase font-semibold">
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Date de commande</th>
                        <th class="px-5 py-3">Libelle</th>
                        <th class="px-5 py-3">Montant total</th>
                        <th class="px-5 py-3">Statut</th>
                        <th class="px-5 py-3">Client</th>
                        <th class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($commandes as $cmd): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $cmd['id_commande'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($cmd['date_commande']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($cmd['libelle']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($cmd['montant_total']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($cmd['statut']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($cmd['id_client']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-center">
                            <a href="<?= path('commande', 'voireCommande') ?>&id=<?=$cmd["id_commande"]?>" class="text-red-600 hover:text-red-900">details</a>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
