<?php

/*
*   Fonction de récupération de loan par ID
*/

function getLoan($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/loans/".$id;
    $url1 = "http://localhost:8080/WebServicesProjet/api/rest/books/";
    $url2 = "http://localhost:8080/WebServicesProjet/api/rest/users/";
    $result = get($url);
    $users = get($url2);
    $books = get($url1);
    return render('loans/loan.html.php','dashboard.html.php',array("loan"=>$result,"users"=>$users,"books"=>$books));
};

/*
*   Fonction de récupération de loan par user
*/

function getLoansByUser($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/loans";

    $result = get($url);

    $save = array();
    foreach (json_decode($result) as $loan){
        if($loan->user->id == $id){
            array_push($save,$loan);
        }
    }
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('loans/loans.html.php','dashboard.html.php',array("loans"=>json_encode($save)));
    }else{
        return render('loans/loans.html.php','dashboard.html.php',array("loans"=>json_encode($save)));

    }
};

/*
*   Fonction de suppression de loan
*/

function deleteLoan($id){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/loans/delete/".$id;
    $result = delete($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans');
        die();
    }else{
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans');
        die();
    }
};

/*
*   Fonction de récupération de tous les loans
*/

function allLoans(){
    $url = "http://localhost:8080/WebServicesProjet/api/rest/loans";

    $result = get($url);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        return render('loans/loans.html.php','dashboard.html.php',array("loans"=>$result));
    }else{
        return render('loans/loans.html.php','dashboard.html.php',array("loans"=>$result));

    }
};

/*
*   Fonction d'ajout de loan
*/

function addLoan(){
    if(isset($_POST['duration'])){
        $post = $_POST;
        unset($post["action"]);
        $result = post('http://localhost:8080/WebServicesProjet/api/rest/loans/add', $post);
        if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
            flash("error","inconnu");
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans/add');
            die();
        }else {
            header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans/'.json_decode($result)->id);
            die();
        }
    }else{
        $url1 = "http://localhost:8080/WebServicesProjet/api/rest/books/";
        $url2 = "http://localhost:8080/WebServicesProjet/api/rest/users/";
        $users = get($url2);
        $books = get($url1);
        return render('loans/loan.html.php','dashboard.html.php',array("loan"=>"","users"=>$users,"books"=>$books));
    }
};

/*
*   Fonction de modification de loan
*/

function updateLoan($id){
    $post = $_POST;
    unset($post["action"]);
    $post["id"] = $id;
    $result = post('http://localhost:8080/WebServicesProjet/api/rest/loans/update/'.$id, $post);
    if(intval($result) != 200 && intval($result)<=503 && intval($result)>=400){
        flash("error","inconnu");
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans/'.$id);
        die();
    }else {
        header("Location: ".$_SERVER['HTTP_ORIGIN'].$_SERVER['PHP_SELF'].'?/loans/'.$id);
        die();
    }
};