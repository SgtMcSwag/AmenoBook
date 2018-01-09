<?php

/*
*   Fonction d'affichage du dashboard
*/

function dashboard(){
    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected']==true){
        return render('dash.html.php','dashboard.html.php');
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/login');
    }
}