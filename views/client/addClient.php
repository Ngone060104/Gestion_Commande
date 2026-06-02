<div class="max-w-4xl mx-auto">
    <!-- Entête avec bouton retour -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Ajouter un nouveau client</h1>
        <a href="<?= path('client', 'index') ?>" class="text-gray-600 hover:text-gray-900 flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="<?= path('client', 'addClient') ?>" method="POST" enctype="multipart/form-data" class="p-8" novalidate>

            <!-- <input type="hidden" name="controller" value="client">
            <input type="hidden" name="action" value="addClient"> -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Diop">
                    <?php if (isset($erreurs['nom'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['nom'] ?></p>
                    <?php endif; ?>

                </div>

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Moussa">
                    <?php if (isset($erreurs['prenom'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['prenom'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email</label>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="exemple@mail.com">
                    <?php if (isset($erreurs['email'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['email'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="+221 ...">
                    <?php if (isset($erreurs['telephone'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['telephone'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Adresse -->
                <div>
                    <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Résidentielle</label>
                    <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Plateau, Dakar">
                    <?php if (isset($erreurs['adresse'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['adresse'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- 2. NOUVEAU CHAMP : Upload de la Photo -->
                <div>
                    <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Photo de profil</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 outline-none transition cursor-pointer">
                    <?php if (isset($erreurs['photo'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['photo'] ?></p>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Boutons d'action -->
            <div class="mt-10 flex items-center justify-end space-x-4">
                <a href="<?= path('client', 'index') ?>" class="px-6 py-3 text-gray-600 font-medium hover:bg-gray-50 rounded-xl transition">
                    Annuler
                </a>
                <button type="submit" name="ajouter" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-1">
                    Enregistrer le client
                </button>
            </div>
        </form>
    </div>
</div>