<?php
    if(isset($_SESSION['login'])){
        include './vue/vueEntete.php';
        include './vue/vueModif.php';
        include './vue/vuePied.php';
    }