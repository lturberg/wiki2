<?php 

class Mot {
    //Attributs privés
    private int $id;
    private string $libelle;
    private string $definition;
    private string $dateCreation;
    private Theme $theme;
    

    public function __construct(int $id, string $libelle, string $definition, string $dateCrea, Theme $theme){
        $this ->id =$id;
        $this ->libelle = $libelle;
        $this ->definition = $definition;
        $this ->dateCreation = $dateCrea;
        $this->theme = $theme;
        
    }

    public function getId(){
        return $this->id;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function getDefinition(){
        return $this->definition;
    }

    public function getDateCreation(){
        return $this->dateCreation;
    }
    
    public function getTheme(){
        return $this->theme;
    }
}