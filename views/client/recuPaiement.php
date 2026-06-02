<div class="max-w-3xl mx-auto px-4 py-8 print:py-0 print:px-0">

    <!-- Boutons d'actions (Masqués lors de l'impression) -->
    <div class="mb-8 flex items-center justify-between print:hidden">
        <a href="<?= path('client', 'profile') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
            <i class="fas fa-arrow-left text-xs"></i> Retour au profil
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-950 hover:bg-gray-800 text-white text-xs font-bold rounded-xl shadow-sm transition">
            <i class="fas fa-print"></i> Imprimer le reçu
        </button>
    </div>

    <!-- Conteneur du Reçu -->
    <div class="bg-white rounded-3xl border border-gray-100 p-8 md:p-12 shadow-sm print:border-0 print:shadow-none relative overflow-hidden">

        <!-- Filigrane de succès de paiement -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/40 rounded-bl-full flex items-start justify-end p-6 text-emerald-500 print:hidden">
            <i class="fas fa-check-circle text-2xl"></i>
        </div>

        <!-- En-tête de la facture -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-6 border-b border-gray-100 pb-8 mb-8">
            <div>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">REÇU DE PAIEMENT</h1>
                <p class="text-xs text-emerald-600 font-bold tracking-wide uppercase mt-1">Paiement Validé</p>
                <p class="text-sm font-mono font-bold text-gray-400 mt-4">N° #<?= htmlspecialchars($commande['numero_commande'] ?? $commande['id_commande']) ?></p>
            </div>
            <div class="sm:text-right text-sm text-gray-500 space-y-1">
                <p class="font-bold text-gray-800 text-base">G-Commande Store</p>
                <p>Dakar, Sénégal</p>
                <p>contact@gcommande.sn</p>
            </div>
        </div>

        <!-- Informations Client & Date -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 p-6 rounded-2xl border border-gray-50 mb-8">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-1">Destinataire</span>
                <p class="text-sm font-bold text-gray-800"><?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></p>
                <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($commande['adresse'] ?? 'Adresse de livraison non spécifiée') ?></p>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($commande['telephone'] ?? '') ?></p>
            </div>
            <div class="md:text-right flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-1">Date de paiement</span>
                    <p class="text-sm font-semibold text-gray-700"><?= date('d/m/Y ', strtotime($commande['date_commande'] ?? 'now')) ?></p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-1">Méthode</span>
                    <p class="text-xs font-bold text-gray-700 uppercase bg-white border border-gray-100 px-2 py-1 rounded-md inline-block">Solde / En ligne</p>
                </div>
            </div>
        </div>

        <!-- Tableau des Articles -->
        <div class="space-y-4">
            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block px-2">Détails des articles</span>

            <div class="border border-gray-100 rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                            <th class="py-3 px-4">Désignation</th>
                            <th class="py-3 px-4 text-center">Qté</th>
                            <th class="py-3 px-4 text-right">Prix Unitaire</th>
                            <th class="py-3 px-4 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                        <?php if (!empty($articles)): ?>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <!-- p.libelle AS nom_produit -->
                                    <td class="py-4 px-4 font-bold text-gray-800"><?= htmlspecialchars($article['nom_produit']) ?></td>

                                    <!-- pc.quantite -->
                                    <td class="py-4 px-4 text-center text-gray-500"><?= $article['quantite'] ?></td>

                                    <!-- pc.prix_vente -->
                                    <td class="py-4 px-4 text-right"><?= number_format($article['prix_vente'], 0, ',', ' ') ?> FCFA</td>

                                    <!-- Calcul automatique du sous-total de la ligne -->
                                    <td class="py-4 px-4 text-right font-bold text-gray-900"><?= number_format($article['prix_vente'] * $article['quantite'], 0, ',', ' ') ?> FCFA</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Total -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-end">
            <div class="w-full sm:w-64 space-y-2 text-sm text-gray-500 font-medium">
                <div class="flex justify-between px-2">
                    <span>Sous-total</span>
                    <span class="text-gray-800"><?= number_format($commande['montant_total'] ?? 0, 0, ',', ' ') ?> FCFA</span>
                </div>
                <div class="flex justify-between px-2">
                    <span>Frais de livraison</span>
                    <span class="text-gray-800">0 FCFA</span>
                </div>
                <div class="flex justify-between bg-gray-950 text-white rounded-xl p-4 font-bold text-base mt-4 shadow-sm">
                    <span>Montant payé</span>
                    <span><?= number_format($commande['montant_total'] ?? 0, 0, ',', ' ') ?> FCFA</span>
                </div>
            </div>
        </div>

        <!-- Pied de page du reçu -->
        <div class="mt-12 text-center text-[11px] text-gray-400 font-medium tracking-wide border-t border-gray-50 pt-6">
            <p>Merci pour votre confiance et votre achat !</p>
            <p class="mt-1">Ce document fait office de preuve d'achat et de paiement.</p>
        </div>

    </div>
</div>