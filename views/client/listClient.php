<?php
// Configuration de la connexion
$host = 'localhost';
$db   = 'nom_de_votre_base';
$user = 'root';
$pass = ''; // Votre mot de passe MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des clients
$stmt = $pdo->query("SELECT id_client, nom, prénom, email, téléphone, adresse FROM client");
$clients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commandes - Clients</title>
    <!-- Intégration de Tailwind CSS -->
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Liste des Clients</h1>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Ajouter un client
            </button>
        </div>

        <!-- Tableau Tailwind -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white text-left text-xs uppercase font-semibold">
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Client</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Téléphone</th>
                        <th class="px-5 py-3">Adresse</th>
                        <th class="px-5 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($clients as $client): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4 text-sm font-medium text-gray-900">
                            #<?= $client['id_client'] ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 font-bold">
                            <?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($client['email']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($client['téléphone']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            <?= htmlspecialchars($client['adresse']) ?>
                        </td>
                        <td class="px-5 py-4 text-sm text-center">
                            <button class="text-blue-600 hover:text-blue-900 mr-3">Modifier</button>
                            <button class="text-red-600 hover:text-red-900">Supprimer</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
