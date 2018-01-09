<?php

/*
*   Fonction de récupération de catégorie par ID
*/

function getCategory($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/categories/".$id;
    $result = get($url);
    return render('categories/category.html.php','dashboard.html.php',array("category"=>$result));
};

/*
*   Fonction de suppression de catégorie par ID
*/

function deleteCategory($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/categories/delete/".$id;
    $result = delete($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories');
        die();
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories');
        die();
    }
};

/*
*   Fonction de récupération de toutes les catégories
*/

function allCategories(){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/categories";
    $result = get($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('categories/categories.html.php','dashboard.html.php',array("categories"=>$result));
    }else{
        return render('categories/categories.html.php','dashboard.html.php',array("categories"=>$result));

    }
};

/*
*   Fonction d'ajout de catégorie
*/

function addCategory(){
    if(isset($_POST['name'])){
        $post = $_POST;
        unset($post["action"]);
        $result = post('http://localhost:8080/WebServicesProjet/api/rest/categories/add', $post);
        if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
            flash("error","inconnu");
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories/add');
            die();
        }else {
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories/'.json_decode($result)->id);
            die();
        }
    }else{
        return render('categories/category.html.php','dashboard.html.php',array("category"=>""));
    }
};

/*
*   Fonction de modification de catégorie par ID
*/

function updateCategory($id){
    $post = $_POST;
    unset($post["action"]);
    $post["id"] = $id;
    $result = post('http://localhost:8080/WebServicesProjet/api/rest/categories/update/'.$id, $post);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories/'.$id);
        die();
    }else {
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/categories/'.$id);
        die();
    }
};