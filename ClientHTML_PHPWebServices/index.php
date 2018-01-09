<?php

require_once('lib/limonade.php');

/*
*   Fonction de configuration
*/

function configure()
{
    option('session', 'AmenoBook');
}

layout('layout/default.html.php');

dispatch('/', 'main_page');

dispatch('/login', 'login');
dispatch_post('/login', 'login');
dispatch('/register', 'register');
dispatch_post('/register', 'register');
dispatch_get('/disconnect', 'disconnect');

dispatch('/dashboard', 'dashboard');

dispatch('/categories', 'allCategories'); //ok
dispatch_get('/categories/add', 'addCategory');
dispatch_post('/categories/add', 'addCategory');
dispatch_post('/categories/update/:id', 'updateCategory');
dispatch_get('/categories/delete/:id', 'deleteCategory');
dispatch_get('/categories/:id','getCategory');

dispatch('/books', 'allBooks');
dispatch_post('/books/add', 'addBook');
dispatch_get('/books/add', 'addBook');
dispatch_post('/books/update/:id', 'updateBook');
dispatch_get('/books/delete/:id', 'deleteBook');
dispatch_get('/books/:id','getBook');
dispatch_get('/categories/:id/books','getBookByCat');

dispatch('/authors', 'allAuthors'); //ok
dispatch_post('/authors/add', 'addAuthor');
dispatch_get('/authors/add', 'addAuthor');
dispatch_post('/authors/update/:id', 'updateAuthor');
dispatch_get('/authors/delete/:id', 'deleteAuthor');
dispatch_get('/authors/:id','getAuthor');

dispatch('/loans', 'allLoans');
dispatch_post('/loans/add', 'addLoan');
dispatch_get('/loans/add', 'addLoan');
dispatch_post('/loans/update/:id', 'updateLoan');
dispatch_get('/loans/delete/:id', 'deleteLoan');
dispatch_get('/:id/loans','getLoansByUser');
dispatch_get('/loans/:id','getLoan');

dispatch('/users', 'allUsers');
dispatch_post('/users/add', 'addUser');
dispatch_get('/users/add', 'addUser');
dispatch_post('/users/update/:id', 'updateUser');
dispatch_get('/users/delete/:id', 'deleteUser');
dispatch_get('/:id','getProfile');



run();