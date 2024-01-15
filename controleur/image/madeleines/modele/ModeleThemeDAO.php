<?php

/**
 * Description of ModeleTypeObjetDAO
 *
 * @author Ordi-herve
 */
    include_once "$racine/classes/Theme.php";
    require_once("Connexion.php");

class ModeleThemeDAO {
    
    public static function getAllTheme(){
        $req = Connexion::getInstance()->query("SELECT * FROM theme order by 2" );
        
        $req->execute();
        $curseur = $req->fetchall();
       
        foreach($curseur as $ligne){
            $unTheme = new Theme($ligne['id'],$ligne['libelle']);
            $resultat[] = $unTheme;
            
        }
        
        return $resultat;
    }
        
        
    
    public static function findById($code){
        try {
            $req = Connexion::getInstance()->prepare("SELECT * FROM Theme WHERE code = :code");
            $req->bindValue(':code', $code, PDO::PARAM_STR);
            $req->execute();

            //une seule ligne de résultat traitée comme s'il y en avait plusieurs (pour harmoniser la vue résultat)
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                $unTheme = new Theme($ligne['code'], $ligne['libelle']);
            }            
            return $unTheme;

        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
        public static function getThemeById($id)
        {
            $resultat = null;

            $sql = "SELECT * FROM theme WHERE id = :id";

            try {
                $req = Connexion::getInstance()->prepare($sql);
                $req->bindValue(':id', $id);
                $req->execute();
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
                $resultat = new Theme($ligne['id'], $ligne['libelle']);
            }
            catch(PDOException $e) {
                print "Erreur !: " . $e->getMessage();
                die();
            }
        
            return $resultat;    
        }  
            
}
