<div class="max-w-4xl mx-auto">
    <!-- Entête de la page -->
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-800">Mon Profil</h1>
        <p class="text-sm text-gray-500 mt-1">Consultez et modifiez vos informations personnelles</p>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="<?= WEBROOT ?>" method="POST" class="p-8" novalidate>

            <!-- Vos inputs cachés pour guider le routeur -->
            <input type="hidden" name="controller" value="client">
            <input type="hidden" name="action" value="updateProfile">

            <!-- Message de succès après modification -->
            <?php if (isset($_SESSION['success_profile'])): ?>
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-lg mb-6 text-sm font-medium flex items-center gap-2">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    <span><?= $_SESSION['success_profile'];
                            unset($_SESSION['success_profile']); ?></span>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" id="prenom"
                        value="<?= htmlspecialchars($client['prenom'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition font-medium text-gray-700">
                </div>

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" id="nom"
                        value="<?= htmlspecialchars($client['nom'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition font-medium text-gray-700">
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email</label>
                    <input type="text" name="email" id="email"
                        value="<?= htmlspecialchars($client['email'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-700">
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="telephone"
                        value="<?= htmlspecialchars($client['telephone'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-700">
                </div>

                <!-- Adresse -->
                <div>
                    <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Résidentielle</label>
                    <input type="text" name="adresse" id="adresse"
                        value="<?= htmlspecialchars($client['adresse'] ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-700">
                </div>
            </div>

            <!-- Bouton de validation -->
            <div class="mt-10 flex items-center justify-end">
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-1">
                    Mettre à jour mes informations
                </button>
            </div>
        </form>
    </div>
</div>