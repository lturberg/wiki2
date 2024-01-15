<?php

class User{

    //Attributs privés
    private $username;
    private $h_password;
    private $mail;
    private $name;
    private $firstname;
    

    //Constructeur
    //public function __construct(string $usrn, string $pswrd, string $email, string $name, string $firstname){
    public function __construct(string $usrn, string $pswrd){
        $this->username = $usrn;
        $this->h_password = $pswrd;
        /*$this->mail = $email;
        $this->name = $name;
        $this->firstname = $firstname;*/
    }

    //Accesseurs
    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->h_password;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getName(){
        return $this->name;
    }

    public function getFirstname(){
        return $this->firstname;
    }

}

