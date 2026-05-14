<div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Liste des Produits</h1>
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
                        <th class="px-5 py-3">REF</th>
                        <th class="px-5 py-3">libelle</th>
                        <th class="px-5 py-3">description</th>
                        <th class="px-5 py-3">prix</th>
                        <th class="px-5 py-3">stock</th>
                        <th class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($produits as $pr): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $pr['id_produit'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $pr['ref'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($pr['libelle']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($pr['description']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($pr['prix']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($pr['stock']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-center">
                            <a href ="<?= WEBROOT ?>?controller=produit&action=updateProduit&id=<?=$pr["id_produit"]?>" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                            <a href="<?= WEBROOT ?>?controller=produit&action=deleteProduit&id=<?=$pr["id_produit"]?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
