<!-- 1. FORMULAIRE UNIQUE OUVERT AU TOUT DÉBUT -->
<form method="POST" action="" class="max-w-5xl mx-auto p-6 bg-gray-50 min-h-screen">

    <!-- TITRE DE LA PAGE -->
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Commandes</h1>
        <p class="text-sm text-gray-500 mt-1">Formulaire d'ajout d'une nouvelle commande client</p>
    </div>

    <!-- SECTION 1 : RECHERCHE CLIENT -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center space-x-2 mb-4 border-b border-gray-100 pb-2">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-700">Informations Client</h2>
        </div>

        <div class="space-y-4">
            <div class="flex flex-col md:flex-row md:items-end gap-4">
                <div class="flex-1 max-w-md">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Numéro de Téléphone</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" name="tel" value="<?php echo htmlspecialchars($tel_saisi ?? ''); ?>"
                            class="block w-full rounded-lg border-gray-300 pr-10 focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50 p-2.5 border" placeholder="Ex: 77XXXXXXX">

                        <?php if (isset($erreurs['tel'])): ?>
                            <p class="text-red-500 text-xs mt-1 font-medium">
                                <i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['tel'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" name="btn_chercher_client"
                    class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-150">
                    Rechercher
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nom du Client</label>
                    <input type="text" value="<?php echo htmlspecialchars($nom ?? ''); ?>" readonly
                        class="block w-full rounded-lg border-gray-200 bg-gray-100 text-gray-600 sm:text-sm p-2.5 border cursor-not-allowed font-medium">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Prénom du Client</label>
                    <input type="text" value="<?php echo htmlspecialchars($prenom ?? ''); ?>" readonly
                        class="block w-full rounded-lg border-gray-200 bg-gray-100 text-gray-600 sm:text-sm p-2.5 border cursor-not-allowed font-medium">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2 : RECHERCHE PRODUIT ET QUANTITÉ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 <?php echo !$client_existe ? 'opacity-40 transition-opacity duration-200' : ''; ?>">
        <div class="flex items-center space-x-2 mb-4 border-b border-gray-100 pb-2">
            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-700">Sélection des Produits</h2>
        </div>

        <fieldset <?php echo !$client_existe ? 'disabled' : ''; ?> class="space-y-4">

            <!-- Champ caché obligatoire pour conserver le téléphone du client dans le POST général -->
            <input type="hidden" name="tel" value="<?php echo htmlspecialchars($tel_saisi ?? ''); ?>">

            <div class="flex flex-col md:flex-row md:items-end gap-4">
                <div class="flex-1 max-w-md">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Référence Article</label>
                    <input type="text" name="ref" value="<?php echo htmlspecialchars($ref_saisie ?? ''); ?>"
                        class="block w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm bg-gray-50 p-2.5 border" placeholder="Ex: REF-001" <?php echo !$client_existe ? 'disabled' : ''; ?>>

                    <?php if (isset($erreurs['ref'])): ?>
                        <p class="text-red-500 text-xs mt-1 font-medium">
                            <i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['ref'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="btn_chercher_produit" <?php echo !$client_existe ? 'disabled' : ''; ?>
                    class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition-colors duration-150 disabled:bg-gray-300 disabled:cursor-not-allowed">
                    Vérifier Réf
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Désignation / Libellé</label>
                    <input type="text" value="<?php echo htmlspecialchars($libelle ?? ''); ?>" readonly
                        class="block w-full rounded-lg border-gray-200 bg-gray-100 text-gray-600 sm:text-sm p-2.5 border cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Prix Unitaire</label>
                    <input type="text" value="<?php echo !empty($prix) ? htmlspecialchars($prix) . ' F' : ''; ?>" readonly
                        class="block w-full rounded-lg border-gray-200 bg-gray-100 text-gray-600 sm:text-sm p-2.5 border cursor-not-allowed font-semibold text-emerald-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Quantité Disponible (Stock)</label>
                    <input type="text" value="<?php echo htmlspecialchars($stock ?? ''); ?>" readonly
                        class="block w-full rounded-lg border-gray-200 bg-gray-100 text-gray-600 sm:text-sm p-2.5 border cursor-not-allowed font-medium">
                </div>
            </div>

            <!-- Paramètres cachés pour le panier -->
            <input type="hidden" name="id_produit_actuel" value="<?php echo $id_produit_cache; ?>">
            <input type="hidden" name="stock_actuel" value="<?php echo $stock; ?>">
            <input type="hidden" name="prix_actuel" value="<?php echo $prix; ?>">

            <div class="flex flex-col md:flex-row md:items-end gap-4 border-t border-gray-100 pt-4 mt-2">
                <div class="w-full md:w-44">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Quantité à commander</label>
                    <input type="number" name="qte_saisie" min="1" <?php echo !$produit_existe ? 'disabled' : ''; ?>
                        class="block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm bg-gray-50 p-2.5 border disabled:bg-gray-100 disabled:cursor-not-allowed">
                </div>
                <button type="submit" name="btn_ajouter_panier" <?php echo !$produit_existe ? 'disabled' : ''; ?>
                    class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors duration-150 disabled:bg-gray-300 disabled:cursor-not-allowed w-full md:w-auto">
                    Ajouter au Panier
                </button>
            </div>

        </fieldset>
    </div>

    <!-- SECTION 3 : TABLEAU DU PANIER ET VALIDATION FINALE -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center space-x-2 mb-4 border-b border-gray-100 pb-2">
            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-700">Panier Actuel</h2>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 mb-6">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500 tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">Libellé</th>
                        <th class="px-6 py-3.5">Prix Unit</th>
                        <th class="px-6 py-3.5 text-center">Quantité</th>
                        <th class="px-6 py-3.5 text-right">Total Ligne</th>
                        <th class="px-6 py-3.5 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    <?php if (empty($lignesPanierHTML)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium bg-gray-50/50">
                                Aucun article dans le panier pour le moment
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($lignesPanierHTML as $ligne): ?>
                            <tr class="hover:bg-gray-50/70 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo htmlspecialchars($ligne['libelle']); ?></td>
                                <td class="px-6 py-4 text-gray-500"><?php echo number_format($ligne['prix_vente'], 0, ',', ' '); ?> F</td>
                                <td class="px-6 py-4 text-center font-medium"><?php echo $ligne['quantite']; ?></td>
                                <td class="px-6 py-4 text-right font-semibold text-gray-900"><?php echo number_format($ligne['quantite'] * $ligne['prix_vente'], 0, ',', ' '); ?> F</td>
                                <td class="px-6 py-4 text-center">
                                    <input type="hidden" name="id_produit_supprimer" value="<?php echo $ligne['id_produit']; ?>">
                                    <button type="submit" name="btn_supprimer_ligne"
                                        class="text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-md transition-colors duration-150">
                                        Retirer
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- BLOC DE FACTURATION ET VALIDATION FINAL -->
        <div class="flex flex-col sm:flex-row items-center justify-between border-t border-gray-100 pt-6 gap-4 bg-gray-50 p-4 rounded-xl border">
            <div>
                <span class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Montant global à régler</span>
                <p class="text-3xl font-black text-gray-800 mt-0.5"><?php echo number_format($totalAffichage, 0, ',', ' '); ?> <span class="text-xl font-bold text-blue-600">FCFA</span></p>
            </div>

            <button type="submit" name="btn_enregistrer" <?php echo empty($lignesPanierHTML) ? 'disabled' : ''; ?>
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-base font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md hover:shadow-lg transition-all duration-150 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Valider l'Enregistrement
            </button>
        </div>
    </div>
</form> <!-- 2. FERMETURE DU FORMULAIRE UNIQUE TOUT EN BAS -->