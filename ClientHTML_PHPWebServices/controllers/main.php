<?php

/*
*   Fonction d'affichage de la main page
*/

function main_page(){
    if(!isset($_SESSION['isConnected']) || $_SESSION['isConnected']!=true){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/login');
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/dashboard');
    }
}