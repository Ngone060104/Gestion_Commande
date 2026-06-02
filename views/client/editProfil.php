<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Lien de retour rapide -->
    <div class="mb-6">
        <a href="<?= path('client', 'profil') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
            <i class="fas fa-arrow-left text-xs"></i> Retour au profil
        </a>
    </div>

    <!-- Layout principal asymétrique -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Formulaire Global -->
        <form action="<?= path('client', 'editProfil') ?>" method="POST" enctype="multipart/form-data" class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-3 gap-8" novalidate>
            <!-- Routeur MVC caché -->
            <!-- <input type="hidden" name="controller" value="client"> -->
            <input type="hidden" name="id" value="<?= $client['id_client'] ?? $client['id'] ?? '' ?>">

            <!-- Colonne Gauche : Modification Photo -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm text-center relative overflow-hidden h-full flex flex-col justify-between">
                    <div class="absolute top-0 inset-x-0 h-24 bg-gradient-to-b from-blue-50/40 to-transparent pointer-events-none"></div>

                    <div class="relative pt-4">
                        <!-- Conteneur Photo avec Zone d'upload interactive -->
                        <div class="relative w-32 h-32 mx-auto mb-6 group cursor-pointer">
                            <div class="absolute inset-0 bg-blue-100 rounded-3xl rotate-6 scale-95 opacity-50 group-hover:rotate-12 transition duration-300"></div>

                            <!-- Image actuelle ou par défaut -->
                            <img id="avatar-preview"
                                src="<?= (!empty($client['photo'])) ? htmlspecialchars($client['photo']) : 'https://unsplash.com' ?>"
                                alt="Photo de profil"
                                class="absolute inset-0 w-full h-full rounded-3xl object-cover border-4 border-white shadow-md relative z-10">

                            <!-- Overlay au survol pour changer la photo -->
                            <label for="photo" class="absolute inset-0 z-20 bg-black/40 rounded-3xl flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition duration-200 cursor-pointer border-4 border-transparent">
                                <i class="fas fa-camera text-lg mb-1"></i>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Changer</span>
                            </label>

                            <!-- Input File masqué -->
                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                        </div>

                        <h2 class="text-xl font-black text-gray-800 tracking-tight">Modifier ma photo</h2>
                        <p class="text-xs text-gray-400 mt-1">Fichiers acceptés : JPG, PNG (Max 2 Mo)</p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 text-left">
                        <p class="text-xs text-gray-400 text-center leading-relaxed">
                            La mise à jour de votre photo sera visible immédiatement après la validation du formulaire.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Colonne Droite : Formulaire de saisie -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm h-full flex flex-col justify-between">
                    <div>
                        <!-- Entête du formulaire -->
                        <div class="flex items-center justify-between border-b border-gray-100 pb-5 mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Modifier mes informations</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Mettez à jour vos coordonnées personnelles</p>
                            </div>
                        </div>

                        <!-- Grille des Inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Prénom -->
                            <div class="flex flex-col gap-2">
                                <label for="prenom" class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($client['prenom'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 focus:bg-white rounded-xl border border-transparent focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition text-sm font-semibold text-gray-700">
                            </div>

                            <!-- Nom -->
                            <div class="flex flex-col gap-2">
                                <label for="nom" class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Nom de famille</label>
                                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($client['nom'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 focus:bg-white rounded-xl border border-transparent focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition text-sm font-semibold text-gray-700">
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2 flex flex-col gap-2">
                                <label for="email" class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Adresse Email</label>
                                <input type="email" name="email" id="email" value="<?= htmlspecialchars($client['email'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 focus:bg-white rounded-xl border border-transparent focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition text-sm font-semibold text-gray-700">
                            </div>

                            <!-- Téléphone -->
                            <div class="flex flex-col gap-2">
                                <label for="telephone" class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Numéro de Téléphone</label>
                                <input type="text" name="telephone" id="telephone" value="<?= htmlspecialchars($client['telephone'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 focus:bg-white rounded-xl border border-transparent focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition text-sm font-semibold text-gray-700">
                            </div>

                            <!-- Adresse -->
                            <div class="flex flex-col gap-2">
                                <label for="adresse" class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Adresse Résidentielle</label>
                                <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($client['adresse'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 focus:bg-white rounded-xl border border-transparent focus:border-blue-500 focus:ring-4 focus:ring-blue-50/50 outline-none transition text-sm font-semibold text-gray-700">
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'actions -->
                    <div class="mt-12 flex items-center justify-end gap-4 border-t border-gray-50 pt-6">
                        <a href="<?= isClient() ? path('client', 'profile') : path('client', 'index') ?>"
                            class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-bold rounded-2xl transition duration-200">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-6 py-3.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold rounded-2xl transition duration-200 shadow-sm">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    // Code JavaScript pour prévisualiser instantanément la photo choisie par le client
    document.getElementById('photo').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>