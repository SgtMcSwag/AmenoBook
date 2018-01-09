<?php
 
/*
*   Fonction de récupération de profil par ID
*/

function getProfile($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/".$id;
    $result = get($url);
    return render('users/user.html.php','dashboard.html.php',array("user"=>$result));
};

/*
*   Fonction de suppression de user par ID
*/

function deleteUser($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/users/delete/".$id;
    $result = delete($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/users');
        die();
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/users');
        die();
    }
};

/*
*   Fonction de récupération de tous les users
*/

function allUsers(){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/users";
    $result = get($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('users/users.html.php','dashboard.html.php',array("users"=>$result));
    }else{
        return render('users/users.html.php','dashboard.html.php',array("users"=>$result));

    }
};

/*
*   Fonction d'ajout d'un user
*/

function addUser(){
    if(isset($_POST['firstName'])){
        $post = $_POST;
        unset($post["action"]);
        $result = post('http://localhost:8080/WebServicesProjet/api/rest/users/add', $post);
        if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
            flash("error","inconnu");
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/users/add');
            die();
        }else {
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/users/'.json_decode($result)->id);
            die();
        }
    }else{
        return render('users/user.html.php','dashboard.html.php',array("user"=>""));
    }
};

/*
*   Fonction de modification d'un user par ID
*/

function updateUser($id){
    $post = $_POST;
    unset($post["action"]);
    $post["id"] = $id;
    $result = post('http://localhost:8080/WebServicesProjet/api/rest/users/update/'.$id, $post);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/'.$id);
        die();
    }else {
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/'.$id);
        die();
    }
};