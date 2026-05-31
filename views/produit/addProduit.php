<div class="max-w-4xl mx-auto">
    <!-- Entête avec bouton retour -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Ajouter un nouveau produit</h1>
        <a href="<?= path('produit', 'index') ?>" class="text-gray-600 hover:text-gray-900 flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="<?= WEBROOT ?>" method="POST" class="p-8">

            <input type="hidden" name="controller" value="produit">
            <input type="hidden" name="action" value="addProduit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- libelle -->
                <div>
                    <label for="ref" class="block text-sm font-semibold text-gray-700 mb-2">Référence</label>
                    <input type="text" name="ref" id="ref"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: REF-001" value="<?= htmlspecialchars($_POST['ref'] ?? '') ?>">
                    <?php if (isset($erreurs['ref'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['ref'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="libelle" class="block text-sm font-semibold text-gray-700 mb-2">Libellé</label>
                    <input type="text" name="libelle" id="libelle"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Ordinateur portable" value="<?= htmlspecialchars($_POST['libelle'] ?? '') ?>">
                    <?php if (isset($erreurs['libelle'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['libelle'] ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <input type="text" name="description" id="description"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Sac à dos ergonomique" value="<?= htmlspecialchars($_POST['description'] ?? '') ?>">
                    <?php if (isset($erreurs['description'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['description'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- prix -->
                <div>
                    <label for="prix" class="block text-sm font-semibold text-gray-700 mb-2">Prix</label>
                    <input type="number" name="prix" id="prix"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: 499.99" value="<?= htmlspecialchars($_POST['prix'] ?? '') ?>">
                    <?php if (isset($erreurs['prix'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['prix'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- stock -->
                <div class="md:col-span-2">
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: 50" value="<?= htmlspecialchars($_POST['stock'] ?? '') ?>">
                    <?php if (isset($erreurs['stock'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['stock'] ?></p>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Boutons d'action -->
            <div class="mt-10 flex items-center justify-end space-x-4">
                <a href="<?= path('produit', 'index') ?>" class="px-6 py-3 text-gray-600 font-medium hover:bg-gray-50 rounded-xl transition">
                    Annuler
                </a>
                <button type="submit" name="ajouter" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-1">
                    Enregistrer le produit
                </button>
            </div>
        </form>
    </div>
</div>