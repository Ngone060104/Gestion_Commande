<?php
require_once(ROOT."model/clientModel.php");
// echo "test controller";
function clientAction(){
    $clients = findAllClients();
    // $total_client = countTable("client");
    // echo "<pre>";
    // var_dump($clients);
    // echo "</pre>";
    // require_once(ROOT. "views/client/listClient.php");
    loadView("client/listClient",["clients"=>$clients]);
    // loadView("client/listClient",["client"=>$clients,"total_client"=>$total_client]);
}
// gerer validation champs
function addClientAction(){
    $errors = [];
    if(isset($_POST['ajouter'])){
          // 1. Validation des champs obligatoires (Vérification si vide)
        isEmpty('nom', $_POST['nom'] ?? null, $errors, "Le nom de famille est obligatoire.");
        isEmpty('prenom', $_POST['prenom'] ?? null, $errors, "Le prénom est obligatoire.");
        isEmpty('email', $_POST['email'] ?? null, $errors, "L'adresse email est obligatoire.");
        isEmpty('telephone', $_POST['telephone'] ?? null, $errors, "Le numéro de téléphone est obligatoire.");
        isEmpty('adresse', $_POST['adresse'] ?? null, $errors, "L'adresse est obligatoire.");
      

         // Nom de l'image par défaut si l'utilisateur n'envoie rien
        $photoName = "default.png";
         // 2. Traitement du fichier Uploadé s'il n'y a pas d'erreur de texte
        if (!isset($errors['email']) && !isMailRegex($_POST['email'])) {
            $errors['email'] = "L'adresse email saisie n'est pas valide (Ex: client@mail.com).";
        }

         if (!isset($errors['telephone']) && !isPhoneNumber($_POST['telephone'])) {
            $errors['telephone'] = "Numéro sénégalais invalide. Saisissez 9 chiffres commençant par 77, 78, 76, 75 ou 70.";
        }
          if (validate($errors)) {
            
            // Vérification si le fichier a été envoyé et s'il n'y a pas d'erreur de taille
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Extensions autorisées
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Génération d'un nom unique pour éviter d'écraser une autre image
                    $photoName = trim($_POST['telephone']) . "_" . time() . "." . $fileExtension;
                    
                    // Chemin de destination dans le dossier public/uploads/
                    $uploadFileDir = ROOT . "public/uploads/";
                    
                    // Créer le dossier s'il n'existe pas
                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0777, true);
                    }

                    $dest_path = $uploadFileDir . $photoName;

                    // Déplacement du fichier temporaire vers son dossier définitif
                    if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                        $errors['photo'] = "Erreur lors du déplacement de l'image.";
                    }
                } else {
                    $errors['photo'] = "Format invalide. Autorisés : JPG, JPEG, PNG, WEBP.";
                }
            } else {
                // Détection de la cause de l'échec de l'upload
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_NO_FILE) {
                    $errors['photo'] = "Veuillez sélectionner une image de profil.";
                } else {
                    $errors['photo'] = "Le fichier est trop lourd. Choisissez une image de moins de 2 Mo.";
                }
            }
        }
         // 3. Traitement final si le tableau d'erreurs est totalement vide
        if (validate($errors)) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $photo = $photoName; // Inclure le nom de la photo dans les données à enregistrer

        if(saveClient($nom, $prenom, $email, $telephone, $adresse, $photo)){
            header("Location:".path("client", "index"));
            exit();
        }else{
            $errors['global'] = "Erreur lors de l'ajout du client.";
        }
        }
    }
    // require_once(ROOT. "views/client/addClient.php");
    loadView("client/addClient", ["erreurs" => $errors]);
}

function updateClientAction(){
    $id = $_REQUEST["id"] ?? null;
    if($_SERVER["REQUEST_METHOD"]=== "POST"){
        if(updateClient($id, $_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['telephone'],$_POST['adresse'])){
            header("Location:".path("client", "index"));
            exit();
        }
    }
    $client = findClientById($id);
    loadView("client/updateClient", ["client" => $client]);
}
function deleteClientAction(){
    $id = $_REQUEST["id"] ?? null;
    if($id){
        deleteClient($id);
    }
    header("Location:".path("client", "index"));
    exit();
}
function indexAction(){
    clientAction();
}

function profileAction() {
    // Si l'admin clique, il doit passer un ID. Si c'est le client, on prend son ID de session.
    $idClient = isClient() ? $_SESSION['user']['id_client'] : ($_GET['id'] ?? null);
    
    if (!$idClient) {
        header("Location: " . path("dashboard", "index"));
        exit();
    }
    
    $client = findClientById($idClient);
    loadView("client/profile", ["client" => $client]);
}

function updateProfileAction() {
    $idClient = isClient() ? $_SESSION['user']['id_client'] : ($_POST['id'] ?? null);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [];
        
        // Vos fonctions de validation par Regex
        isEmpty('nom', $_POST['nom'], $errors);
        isEmpty('prenom', $_POST['prenom'], $errors);
        isEmpty('telephone', $_POST['telephone'], $errors);
        
        if (validate($errors)) {
            $success = updateClient($idClient, $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['adresse']);
            if ($success) {
                // Si c'est le client lui-même, on met à jour ses données en session pour l'affichage du Header
                if (isClient()) {
                    $_SESSION['user']['nom'] = $_POST['nom'];
                    $_SESSION['user']['prenom'] = $_POST['prenom'];
                }
                header("Location: " . path("client", "profile"));
                exit();
            }
        }
    }
}