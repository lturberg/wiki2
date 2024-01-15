<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure tout ce qui est nécessaire, comme les modèles, les bibliothèques, etc.
// Inclure la classe Routeur
require_once('routeur.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement spécifique à l'action flashCode
    // Vous pouvez récupérer les données du formulaire ici

    // Exemple : récupérer la valeur d'un champ avec le nom "code"
    $code = isset($_POST['code']) ? $_POST['code'] : '';

    // Effectuer le traitement nécessaire avec les données du formulaire

    // Redirection vers vueFlashCode.php après le traitement
    header("Location: vue/vueFlashCode.php");
    exit();
}

// Afficher le formulaire
include_once('vue/vueEntete.php');
include_once('vue/vueFlashCode.php');
include_once('vue/vuePied.php');
// Utiliser la classe Routeur pour obtenir le contrôleur
$action = isset($_GET['action']) ? $_GET['action'] : 'defaut';
$controleur = Routeur::getControleur($action);

// Inclure le contrôleur
include_once($controleur);
?>
