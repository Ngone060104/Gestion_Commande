<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Message de succès après modification -->
    <?php if (isset($_SESSION['success_profile'])): ?>
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl mb-8 text-sm font-medium flex items-center gap-3 animate-fade-in shadow-sm">
            <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100 flex-shrink-0"></span>
            <span><?= $_SESSION['success_profile'];
                    unset($_SESSION['success_profile']); ?></span>
        </div>
    <?php endif; ?>

    <!-- Layout principal asymétrique -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Colonne Gauche : Carte d'identité client -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm text-center relative overflow-hidden h-full flex flex-col justify-between">
                <!-- Décor de fond subtil -->
                <div class="absolute top-0 inset-x-0 h-24 bg-gradient-to-b from-blue-50/40 to-transparent pointer-events-none"></div>

                <div class="relative pt-4">
                    <!-- Conteneur Photo de Profil -->
                    <div class="relative w-32 h-32 mx-auto mb-6 group">
                        <div class="absolute inset-0 bg-blue-100 rounded-3xl rotate-6 scale-95 opacity-50 group-hover:rotate-12 transition duration-300"></div>
                        <img src="<?= (!empty($client['photo']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $client['photo']))
                                        ? htmlspecialchars($client['photo'])
                                        : (!empty($client['photo']) ? WEBROOT . 'uploads/' . htmlspecialchars($client['photo']) : 'https://unsplash.com') ?>"
                            alt="Photo de profil"
                            class="absolute inset-0 w-full h-full rounded-3xl object-cover border-4 border-white shadow-md relative z-10 transition duration-300 group-hover:scale-[1.02]">

                    </div>

                    <!-- Identité -->
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight">
                        <?= htmlspecialchars(($client['prenom'] ?? '') . ' ' . ($client['nom'] ?? '')) ?>
                    </h2>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 rounded-full text-xs font-bold text-blue-600 tracking-wide mt-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        Client Membre
                    </div>
                </div>

                <!-- Informations rapides de bas de carte -->
                <div class="mt-8 pt-6 border-t border-gray-100 text-left space-y-4">
                    <div class="flex items-center gap-3 text-sm text-gray-500">
                        <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                            <i class="far fa-envelope text-xs"></i>
                        </div>
                        <span class="truncate"><?= htmlspecialchars($client['email'] ?? 'Non renseigné') ?></span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-500">
                        <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                            <i class="far fa-user text-xs"></i>
                        </div>
                        <span>ID Client : <span class="font-mono font-bold text-gray-700">#<?= $client['id_client'] ?? '0000' ?></span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne Droite : Informations détaillées -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm h-full flex flex-col justify-between">
                <div>
                    <!-- Entête du bloc d'informations -->
                    <div class="flex items-center justify-between border-b border-gray-100 pb-5 mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 tracking-tight">Informations Personnelles</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Données de facturation et de livraison</p>
                        </div>
                        <span class="w-10 h-10 rounded-2xl bg-blue-50/50 flex items-center justify-center text-blue-500">
                            <i class="fas fa-shield-alt text-sm"></i>
                        </span>
                    </div>

                    <!-- Grille des informations textuelles épurées -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Prénom -->
                        <div class="space-y-1">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Prénom</span>
                            <p class="text-base font-semibold text-gray-700"><?= htmlspecialchars($client['prenom'] ?? '—') ?></p>
                        </div>

                        <!-- Nom -->
                        <div class="space-y-1">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Nom de famille</span>
                            <p class="text-base font-semibold text-gray-700"><?= htmlspecialchars($client['nom'] ?? '—') ?></p>
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2 space-y-1 pt-2 border-t border-gray-50">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Adresse Email</span>
                            <p class="text-base font-semibold text-gray-700"><?= htmlspecialchars($client['email'] ?? '—') ?></p>
                        </div>

                        <!-- Téléphone -->
                        <div class="space-y-1 pt-2 border-t border-gray-50">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Numéro de Téléphone</span>
                            <p class="text-base font-semibold text-gray-700"><?= htmlspecialchars($client['telephone'] ?? '—') ?></p>
                        </div>

                        <!-- Adresse -->
                        <div class="space-y-1 pt-2 border-t border-gray-50">
                            <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">Adresse Résidentielle</span>
                            <p class="text-base font-semibold text-gray-700"><?= htmlspecialchars($client['adresse'] ?? '—') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'action épuré et moderne -->
                <div class="mt-12 flex justify-end">
                    <a href="<?= path('client', 'editProfil') ?>"
                        class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold rounded-2xl transition duration-200 shadow-sm">
                        <i class="fas fa-pen text-xs text-gray-400"></i>
                        Modifier le profil
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>


    <!-- NOUVELLE SECTION : Historique des Commandes & Bouton Reçu -->
    <div class="mt-12 bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 pb-5 mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Mes Achats & Commandes</h3>
                <p class="text-xs text-gray-400 mt-0.5">Consultez l'historique et téléchargez vos reçus de paiement</p>
            </div>
            <span class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i class="fas fa-shopping-basket text-sm"></i>
            </span>
        </div>

        <!-- Vérification si le client possède des commandes rattachées -->
        <?php if (!empty($commandes)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="text-[11px] font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100">
                            <th class="pb-3 pl-2">N° Commande</th>
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Montant Total</th>
                            <th class="pb-3 text-center">Statut</th>
                            <th class="pb-3 text-right pr-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                        <?php foreach ($commandes as $commande): ?>
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 pl-2 font-mono font-bold text-gray-900">#<?= htmlspecialchars($commande['numero_commande'] ?? $commande['id_commande'] ?? $commande['id']) ?></td>
                                <td class="py-4 text-gray-500"><?= date('d/m/Y', strtotime($commande['date_commande'])) ?></td>
                                <td class="py-4 font-bold text-gray-800"><?= number_format($commande['montant_total'], 0, ',', ' ') ?> FCFA</td>
                                <td class="py-4 text-center">
                                    <?php 
                                    $badgeColor = "bg-amber-50 text-amber-700 border-amber-100";
                                    if (strtolower($commande['statut'] ?? '') === 'validée') {
                                        $badgeColor = "bg-emerald-50 text-emerald-700 border-emerald-100";
                                    } elseif (strtolower($commande['statut'] ?? '') === 'annulée') {
                                        $badgeColor = "bg-red-50 text-red-700 border-red-100";
                                    }
                                    ?>
                                    <span class="px-2 py-1 text-xs font-bold uppercase rounded-full border <?= $badgeColor ?>">
                                        <?= htmlspecialchars($commande['statut'] ?? '—') ?>
                                    </span>
                                </td>
                                <td class="py-4 text-right pr-2">
                                    <a href="<?= path('client', 'recuPaiement', ['id' => $commande['id_commande']]) ?>" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold rounded-md transition duration-200">
                                        <i class="fas fa-receipt text-xs"></i>
                                        Reçu
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-sm text-gray-500">Vous n'avez pas encore passé de commandes.</p>
            </div>
        <?php endif; ?>
    </div>