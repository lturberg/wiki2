<?php 
//Affichage de la page de login si une session est deja lancé
    if(!isset($_SESSION['login'])){
        include "$racine/vue/vueEntete.php";
        include "$racine/vue/vueLogin.php";
        include "$racine/vue/vuePied.php";
    }else{  //Sinon deconnexion de l'utilisateur
        unset($_SESSION['login']);
        session_destroy();
        $action = "defaut";
        header('Location: ./?action=defaut');
    }