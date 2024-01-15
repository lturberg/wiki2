<?php 

    include "$racine/modele/ModeleUserDAO.php";

   


    $login = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
    $psw = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    
    $verif = ModeleUserDAO::verif($login,$psw);

    if($verif){
        $_SESSION['login'] = $login;
        header("Location: ./?action=defaut");
    }else{
        header("Location: ./?action=login&error=true");
    }

        

    