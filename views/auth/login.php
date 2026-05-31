<div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-8">
        <div class="inline-flex p-3 bg-blue-50 text-blue-600 rounded-xl mb-3">
            <i class="fas fa-box-open text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Application Gestion CMD</h1>
        <p class="text-sm text-gray-400 mt-1">Connectez-vous pour accéder à votre espace</p>
    </div>

    <!-- Alerte d'erreur globale -->
    <?php if (isset($erreurs['global'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <span><?= $erreurs['global'] ?></span>
        </div>
    <?php endif; ?>

    <form action="<?= path('auth', 'login') ?>" method="POST" class="space-y-5" novalidate>
        
        <!-- Identifiant / Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse Email</label>
            <input type="text" name="email" id="email" 
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                placeholder="admin@mail.com ou client@mail.com"
                class="w-full px-4 py-3 rounded-xl border <?= isset($erreurs['email']) ? 'border-red-400 focus:ring-red-200' : 'border-gray-200 focus:border-blue-500' ?> focus:ring-4 outline-none transition text-gray-700">
            <?php if (isset($erreurs['email'])): ?>
                <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['email'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
            <input type="password" name="password" id="password" 
                class="w-full px-4 py-3 rounded-xl border <?= isset($erreurs['password']) ? 'border-red-400 focus:ring-red-200' : 'border-gray-200 focus:border-blue-500' ?> focus:ring-4 outline-none transition text-gray-700"
                placeholder="••••••••">
            <?php if (isset($erreurs['password'])): ?>
                <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle mr-1"></i><?= $erreurs['password'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Bouton Se connecter -->
        <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5 active:translate-y-0">
            Se connecter
        </button>
    </form>
</div>
