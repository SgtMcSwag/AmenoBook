<?php

/*
*   Fonction de récupération de'un auteur par ID
*/

function getAuthor($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/authors/".$id;
    $result = get($url);
    return render('authors/author.html.php','dashboard.html.php',array("author"=>$result));
};

/*
*   Fonction de suppression d'un auteur par ID
*/

function deleteAuthor($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/authors/delete/".$id;
    $result = delete($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors');
        die();
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors');
        die();
    }

};

/*
*   Fonction de récupération de tous les auteurs
*/

function allAuthors(){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/authors";
    $result = get($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('authors/authors.html.php','dashboard.html.php',array("authors"=>$result));
    }else{
        return render('authors/authors.html.php','dashboard.html.php',array("authors"=>$result));

    }

};

/*
*   Fonction d'ajout d'un auteur
*/

function addAuthor(){
    if(isset($_POST['firstname'])){
        $post = $_POST;
        unset($post["action"]);
        $result = post('http://localhost:8080/WebServicesProjet/api/rest/authors/add', $post);
        if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
            flash("error","inconnu");
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors/add');
            die();
        }else {
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors/'.json_decode($result)->id);
            die();
        }
    }else{
        return render('authors/author.html.php','dashboard.html.php',array("author"=>""));
    }

};

/*
*   Fonction de modification d'un auteur par ID
*/

function updateAuthor($id){
    $post = $_POST;
    unset($post["action"]);
    $post["id"] = $id;
    $result = post('http://localhost:8080/WebServicesProjet/api/rest/authors/update/'.$id, $post);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors/'.$id);
        die();
    }else {
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/authors/'.$id);
        die();
    }
};