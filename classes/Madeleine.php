<?php

    class Madeleine{
        private int $id;
        private string $libelle;
        private string $image;

        public function __construct(int $id, string $libelle, string $img){
            $this->id = $id;
            $this->libelle = $libelle;
            $this->image = $img;
        } 

        public function getId(){
            return $this->id;
        }

        public function getLibelle(){
            return $this->libelle;
        }

        public function getImage(){
            return $this->image;
        }
    }