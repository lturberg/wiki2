<?php


//Intégration des modèles
include_once "$racine\modele\ModeleMotDAO.php";
include_once "$racine\classes\Mot.php";


$mot =  filter_input(INPUT_POST, "mot") ;
$mot = strtoupper($mot);
//$unMot = New Mot(432,'ALGORITHME','Naturel-Artificiel','2017-03-07 09:50:42');
$unMot = ModeleMotDAO::getMotbyLibelle($mot);

if($unMot != null){
    $estTrouve = true;
            
    $idMot = $unMot->getId() ;
    $lesPhotos = ModeleMotDAO::getPhoto($idMot);
    $libelle = $unMot->getLibelle();
}
else{
    $estTrouve = false;
}

//Entete
include "$racine/vue/vueEntete.php";


include "$racine/vue/vueAffichage.php";

//Vue pied de page
include "$racine/vue/vuePied.php";
