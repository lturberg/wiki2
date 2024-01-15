<?php


class Theme {
    //Attribut privée
    private int $id;
    private string $libelle;
    
    //Constructeur
    public function __construct(int $id, string $libelle) 
    {
        $this->id = $id;
        $this->libelle = $libelle;
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getLibelle(){
        return $this->libelle;
    }
}
