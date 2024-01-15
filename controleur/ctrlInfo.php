<?php
    if(isset($_SESSION['login'])){
        
        include "$racine/vue/vueEntete.php";
        include "$racine/vue/vueInfo.php";
        include "$racine/vue/vuePied.php";
    }