<?php

//Inclut les modèles nécessaires
include_once "$racine/modele/ModeleMotDAO.php";
include_once "$racine/classes/Mot.php";

       
//Récupération du numéro d'objet saisi dans le textBox en POST
$mot = filter_input(INPUT_POST, "mot", FILTER_SANITIZE_STRING);

if ($mot != null){
    // On demande au modèle de récupérer les données nécessaires à l'affichage
    $unMot = ModeleMotDAO::getMotbyLibelle(strtoupper($mot));
    
    if($unMot != null)
    {
        $idMot = $unMot->getId() ;
        $lesPhotos = ModeleMotDAO::getPhoto($idMot);
        $libelle = $unMot->getLibelle();
    }      
    var_dump($unMot);
}        




// appel du script de vue qui permet de gerer l'affichage des donnees

//Entete
include "$racine/vue/vueEntete.php";

include "$racine/vue/vueAccueil.php";
//Pied


//VueRechercheObjet
//unMot = New Mot(432,'ALGORITHME','Naturel-Artificiel','2017-03-07 09:50:42');

  

//Vue pied de page
include "$racine/vue/vuePied.php";

