<?php

    include "./modele/ModeleUserDAO.php";

    $login = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
    $pass1 = filter_input(INPUT_POST,"new_password",FILTER_SANITIZE_SPECIAL_CHARS);
    $passVerif = filter_input(INPUT_POST,"password_Verif",FILTER_SANITIZE_SPECIAL_CHARS);


    if($pass1 == $passVerif && $login == $_SESSION['login']){
        ModeleUserDAO::updatePassword($pass1);
        header("Location: ./?action=mesInfos");
        echo "Mot de passe modifié avec succès !";
    }
    else{
        header("Location: ./?action=modifInfo&citron=jaune");
        echo "Une erreur est survenu";
    }