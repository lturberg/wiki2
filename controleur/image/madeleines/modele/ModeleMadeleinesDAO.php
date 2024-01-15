<?php
include_once "$racine/classes/Madeleine.php";
    require_once("Connexion.php");


    class ModeleMadeleinesDAO{
   
        private static $lesMadeleines;


        public static function getMadeleines(){
            $sql = "SELECT madeleine.* FROM madeleine ORDER by madeleine.id ASC";
            $req = Connexion :: getInstance()->prepare($sql);
            $req-> execute();
            $curseur = $req->fetchall();

            foreach($curseur as $ligne)
            {       
                $uneMadeleine = new Madeleine($ligne['id'],$ligne['libelle'],$ligne['image']); 
                $resultat[] = $uneMadeleine;
            }
                return $resultat;            

        }

        public static function getMadeleineById($id){
            self::$lesMadeleines = self:: getMadeleines();
            $uneMadeleines = null;
            foreach(self::$lesMadeleines as $unObj){
                if($unObj ->getId() == $id){
                    $uneMadeleine = $unObj;
                }
            }
            return $uneMadeleine;
        }        

    }