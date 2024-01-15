<?php
include_once "$racine/modele/ModeleThemeDAO.php";
include_once "$racine/modele/ModeleMotDAO.php";

$lesThemes = ModeleThemeDAO::getAllTheme();

if(isset($_POST['Rechercher2'])&& $_POST['Rechercher2']){
    
 $theme =filter_input(INPUT_POST, "theme");
 //var_dump($theme);
 $lesMots = ModeleMotDAO::getMotbyTheme($theme);
}
//Entete
include "$racine/vue/vueEntete.php";


include "$racine/vue/vueTheme.php";

//Vue pied de page
include "$racine/vue/vuePied.php";