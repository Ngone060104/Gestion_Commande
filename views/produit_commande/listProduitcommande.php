<div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Liste des Produits Commandés</h1>
            <a href="<?= WEBROOT ?>?controller=produit&action=addProduit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Ajouter un produit
            </a>
        </div>

        <!-- Tableau Tailwind -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-xs uppercase font-semibold">
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">ID Commande</th>
                        <th class="px-5 py-3">ID Produit</th>
                        <th class="px-5 py-3">Quantité</th>
                        <th class="px-5 py-3">Prix de Vente</th>
                        <th class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($produitcommandes as $pcmd): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $pcmd['id_pc'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $pcmd['id_commande'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $pcmd['id_produit'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($pcmd['quantite']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($pcmd['prix_vente']) ?>
                        </td>
                         <td class="px-5 py-4 text-sm text-center">
                            <a href ="<?= WEBROOT ?>?controller=produitcommande&action=updateProduitcommande&id=<?=$pcmd["id_pc"]?>" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                            <a href="<?= WEBROOT ?>?controller=produitcommande&action=deleteProduitcommande&id=<?=$pcmd["id_pc"]?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit commandé ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
