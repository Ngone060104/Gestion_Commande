<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border">
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Détails Commande #<?= $commande['id_commande'] ?></h1>
            <p class="text-gray-500">Date : <?= $commande['date_commande'] ?></p>
        </div>
        <div class="text-right">
            <p class="font-semibold text-gray-700">Client :</p>
            <p class="text-blue-600 font-bold"><?= $commande['prenom_client'] . ' ' . $commande['nom_client'] ?></p>
        </div>
    </div>

    <table class="w-full mb-8">
        <thead>
            <tr class="text-left border-b bg-gray-50 text-gray-600 uppercase text-xs">
                <th class="py-3 px-4">Produit</th>
                <th class="py-3 px-4 text-center">Quantité</th>
                <th class="py-3 px-4 text-right">Prix Unitaire</th>
                <th class="py-3 px-4 text-right">Total</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php $totalGeneral = 0; ?>
            <?php foreach ($commandeDetails as $cmd): ?>
                <?php
                // Remplacer 'stock' par le vrai nom du champ quantité dans votre BDD (ex: 'quantite')
                $quantiteCommandee = $cmd['quantite_achetee'];
                $totalLigne = $quantiteCommandee * $cmd['prix'];
                $totalGeneral += $totalLigne;
                ?>
                <tr>
                    <td class="py-4 px-4 font-medium"><?= $cmd['libelle'] ?></td>
                    <td class="py-4 px-4 text-center"><?= $quantiteCommandee ?></td>
                    <td class="py-4 px-4 text-right"><?= number_format($cmd['prix'], 0, ',', ' ') ?> FCFA</td>
                    <td class="py-4 px-4 text-right font-bold"><?= number_format($totalLigne, 0, ',', ' ') ?> FCFA</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="flex justify-end">
        <div class="bg-gray-800 text-white p-4 rounded-xl w-64 text-right">
            <p class="text-gray-400 text-sm">Montant Total à régler</p>
            <p class="text-2xl font-bold"><?= number_format($totalGeneral, 0, ',', ' ') ?> FCFA</p>
        </div>
    </div>
    <div class="flex justify-between items-center mt-6">
    <!-- Bouton Retour à la liste -->
    <a href="<?= path('commande', 'index') ?>" 
       class="text-gray-600 hover:text-gray-900 flex items-center gap-2 font-medium transition">
        ← Retour aux commandes
    </a>
</div>
</div>