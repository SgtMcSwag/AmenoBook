<?php

/*
*   Fonction de récupération d'un livre par ID
*/

function getBook($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/books/".$id;
    $url1 = "http://localhost:8080/WebServicesProjet/api/rest/categories/";
    $result = get($url);
    $cat = get($url1);
    return render('books/book.html.php','dashboard.html.php',array("book"=>$result, "categories"=>$cat));
};

/*
*   Fonction de récupération des livres par catégorie
*/

function getBookByCat($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/books";
    $result = get($url);
    $save = array();
    foreach (json_decode($result) as $book){
        if(isset($book->category) && $book->category->id == $id){
            array_push($save,$book);
        }
    }
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('books/books.html.php','dashboard.html.php',array("books"=>json_encode($save)));
    }else{
        return render('books/books.html.php','dashboard.html.php',array("books"=>json_encode($save)));

    }
};

/*
*   Fonction de suppression de livre par ID
*/

function deleteBook($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/books/delete/".$id;
    $result = delete($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books');
        die();
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books');
        die();
    }
};

/*
*   Fonction de récupération de tous les livres
*/

function allBooks(){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/books";
    $result = get($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('books/books.html.php','dashboard.html.php',array("books"=>$result));
    }else{
        return render('books/books.html.php','dashboard.html.php',array("books"=>$result));

    }
};

/*
*   Fonction d'ajout de livre'
*/

function addBook(){
    if(isset($_POST['isbn'])){
        $post = $_POST;
        unset($post["action"]);
        $result = post('http://localhost:8080/WebServicesProjet/api/rest/books/add', $post);
        if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
            flash("error","inconnu");
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books/add');
            die();
        }else {
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books/'.json_decode($result)->id);
            die();
        }
    }else{
        $url1 = "http://localhost:8080/WebServicesProjet/api/rest/categories/";
        $result = get($url1);
        return render('books/book.html.php','dashboard.html.php',array("book"=>"","categories"=>$result));
    }
};

/*
*   Fonction de modification de livre par ID
*/

function updateBook($id){
    $post = $_POST;
    unset($post["action"]);
    $post["id"] = $id;
    $result = post('http://localhost:8080/WebServicesProjet/api/rest/books/update/'.$id, $post);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books/'.$id);
        die();
    }else {
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/books/'.$id);
        die();
    }
};