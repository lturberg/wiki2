<?php
    if(isset($_SESSION['login'])){ 
        include "$racine/vue/vueEntete.php";
        include "$racine/vue/vueRechercheMot.php";
        include_once('vue/vuePied.php');
    }
// Utiliser la classe Routeur pour obtenir le contrôleur
$action = isset($_GET['action']) ? $_GET['action'] : 'defaut';
$controleur = Routeur::getControleur($action);

// Inclure le contrôleur
include_once($controleur);

include_once("$racine/vue/vueEntete.php");


include_once("$racine/vue/vueRechercheMot.php");

//Vue pied de page
include_once("$racine/vue/vuePied.php");
?>