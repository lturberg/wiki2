<?php

include_once "$racine/modele/ModeleMadeleinesDAO.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

if($id != null){
    $unObjet = ModeleMadeleinesDAO::getMadeleineById($id);
}

include "$racine/vue/vueEntete.php";

if($unObjet != null){
    include "$racine/vue/vueDetailMadeleine.php";
}
else{
    include "$racine/vue/vueAccueil.php";
}

include "$racine/vue/vuePied.php";