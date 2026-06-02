<div class="max-w-4xl mx-auto">
    <!-- Entête avec bouton retour -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Modifier client</h1>
        <a href="<?= path('client', 'index') ?>" class="text-gray-600 hover:text-gray-900 flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="<?= path('client', 'editProfil', ['id' => $client['id_client']]) ?>" method="POST" class="p-8" enctype="multipart/form-data">
            
            <!-- <input type="hidden" name="controller" value="client">
            <input type="hidden" name="action" value="updateClient"> -->
           
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= ($client["nom"])?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Diop">
                </div>

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= ($client["prenom"])?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Moussa">
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email</label>
                    <input type="email" name="email" id="email" value="<?= ($client["email"])?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="exemple@mail.com">
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" value="<?= ($client["telephone"])?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="+221 ...">
                </div>

                <!-- Adresse -->
                <div>
                    <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Résidentielle</label>
                    <input type="text" name="adresse" id="adresse" value="<?= ($client["adresse"])?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Ex: Plateau, Dakar">
                </div>

                <!-- Photo de profil -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Photo de Profil</label>
                    <input type="file" name="photo" id="photo"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-10 flex items-center justify-end space-x-4">
               <a href="<?= path('client', 'index') ?>" class="px-6 py-3 text-gray-600 font-medium hover:bg-gray-50 rounded-xl transition">
                    Annuler
                </a>
                <button type="submit" name="ajouter" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-1">
                    Modifier le client
                </button>
            </div>
        </form>
    </div>
</div>