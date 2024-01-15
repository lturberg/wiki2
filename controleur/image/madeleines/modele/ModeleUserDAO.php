<?php

    include_once "$racine/classes/User.php";
    require_once "Connexion.php";


    class ModeleUserDAO{

        //Variable contenant tous les utilisateurs
        private static $allUsers;
        private static $enc_Key = "594fa9977cbcf4a8c25e0436f4fe2bbd7f17c79b0a9ca007b2cf949deac1f039";
        private static $cipher_Method = "AES-128-CBC";
        private static $result = array();
        //Initialisation cryptage données

        

        //Méthodes permettant de lire tous les utilisateurs
        private static function readAll(){
            self::$allUsers = self::loadUsers();
            return self::$allUsers;
        }

        
        //Permet de charger les utilisateurs
        public static function loadUsers(){

            //$result = new ArrayObject(array());
            


            try{

                //Initialisation et éxécution de la requête SQL
                $query = Connexion::getInstance()->prepare('SELECT * FROM users ORDER BY 1');
                $query->execute();
                $allRows = $query -> fetchAll();


                //Traitement de chaque lignes de résultats
                foreach($allRows as $row) {
                    
                    
                    //Recuperation donnée crypté du mail
                    $footprint_m = $row['username'];                    

                    //Recuperation donnée crypté du nom                  
                    $footprint_n = $row['password'];
                    var_dump($footprint_m);
                    //$mail = self::decryptData($footprint_m);
                    $mail = $footprint_m;
                    $name = self::decryptData($footprint_n);
                    //Création des objets user
                    $user = new User($row['username'], $row['password']);
                    array_push(self::$result,$user);
                    
                }
                return self::$result;

            }
            //Gestion des erreurs
            catch(PDOException $e){
                print "Erreur !: " . $e->getMessage();
                die();
            }
        }


        public static function updateUserData(string $fstname, string $name, string $mail)
        {
            $username = $_SESSION['login'];
            $en_name = self::encryptData($name);

            $en_mail = self::encryptData($mail);

            $query = Connexion::getInstance()->prepare('UPDATE users SET firstname = :frstname,  h_name = :name, h_mail = :mail WHERE username= :username');
            $query->bindValue(":username", $username,PDO::PARAM_STR);
            $query->bindValue(":frstname",$fstname,PDO::PARAM_STR);
            $query->bindValue(":name",$en_name,PDO::PARAM_STR);
            $query->bindValue(":mail",$en_mail,PDO::PARAM_STR);

            $query->execute();
        }


        public static function updatePassword(string $newPass)
        {
            $username = $_SESSION['login'];

            $h_newPass = password_hash($newPass,PASSWORD_DEFAULT);

            $query = Connexion::getInstance()->prepare('UPDATE users SET h_password = :newPass WHERE username = :usrn');
            $query->bindValue(":newPass",$h_newPass,PDO::PARAM_STR);
            $query->bindValue(":usrn",$username,PDO::PARAM_STR);

            $query->execute();

        }
        private static function encryptData(string $dataToEncrypt)
        {
            // Spécifiez la méthode de chiffrement
            $cipher = self::$cipher_Method;
        
            // Génère un vecteur d'initialisation (IV) aléatoire
            $iv = openssl_random_pseudo_bytes(16);
        
            // Chiffre les données
            $ciphertext_raw = openssl_encrypt($dataToEncrypt, $cipher, self::$enc_Key, OPENSSL_RAW_DATA, $iv);
        
            // Génère un HMAC (code d'authentification de message basé sur le hachage) pour l'intégrité
            $hmac = hash_hmac('sha256', $ciphertext_raw, self::$enc_Key, true);
        
            // Combine IV, HMAC et ciphertext, puis encode le résultat en base64
            $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
        
            return $ciphertext;
        }
        

        private static function decryptData(string $dataToDecrypt)
        {            
            $c = base64_decode($dataToDecrypt);
            $ivlen = openssl_cipher_iv_length($cipher = self::$cipher_Method);
            $iv = substr($c,0,$ivlen);
            $hmac = substr($c,$ivlen, $sha2len = 32);
            $ciphertext_raw = substr($c,$ivlen+$sha2len);
            $original_text = openssl_decrypt($ciphertext_raw,$cipher,self::$enc_Key,$option=OPENSSL_RAW_DATA,$iv);
            $calcmac = hash_hmac('sha256',$ciphertext_raw,self::$enc_Key,$as_binary=true);
            
            if(hash_equals($hmac,$calcmac)){
                $decrypted = $original_text;
            }else{
                $decrypted = "Confidential";
            }

            return $decrypted;
        }

        

        public static function verif($login, $passwrd){
            self::readAll();
            $verif = false;
            foreach(self::$allUsers as $u){
                if($u->getUsername() == $login){
                    $verif = password_verify($passwrd,$u->getPassword());
                }
            }
            
            return $verif;
        }

        public static function getUser($login){
            self::readAll();
            if($_SESSION['login'] == $login){
                foreach(self::$allUsers as $u){
                    if($u->getUsername() == $login){
                        return $u;
                    }
                }
            }else{
                return null;
            }
        }

    }