<?php
//verifier champs vides
function isEmpty(string $key, ?string $value, array &$errors, string $msg = "Ce champ est obligatoire"): void {
    if ($value === null || empty(trim($value))) {
        $errors[$key] = $msg;
    }
}
// numero senegalais
function isPhoneNumber(string $value): bool {
      // Supprime les espaces inutiles en début et fin de chaîne
    $cleanValue = trim($value);
    
    // REGEX SÉNÉGAL : 
    // ^(77|78|76|75|70) -> Doit impérativement commencer par un de ces préfixes
    // [0-9]{7}$         -> Suivi de exactement 7 chiffres de 0 à 9
    $pattern = "/^(77|78|76|75|70)[0-9]{7}$/";
    
    return (bool) preg_match($pattern, $cleanValue);
}

// 4. Vérifie l'adresse Email avec une Regex (Plus stricte que filter_var)
function isMailRegex(string $value): bool {
    // Motif standard pour valider la structure texte@domaine.extension
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return (bool) preg_match($pattern, trim($value));
}


// 5. Vérifie une Référence Produit (Ex: REF-005, REF123)
function isReference(string $value): bool {
    // Motif : Commence par "REF" (insensible à la casse), suivi optionnellement d'un tiret, puis de chiffres
    return (bool) preg_match("/^ref-?[0-9]+/i", trim($value));
}

// 6. Indique si le tableau d'erreurs est vide (Inchangé)
function validate(array $errors): bool {
    return count($errors) === 0;
}

function isPrice(string $value): bool {
    // Vérifie si la valeur est un nombre positif (entier ou décimal)
    return (bool) preg_match("/^\d+(\.\d{1,2})?$/", trim($value));
}


