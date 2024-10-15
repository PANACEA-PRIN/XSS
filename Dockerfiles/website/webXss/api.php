<?php
// api.php

// Funzione per gestire la richiesta della pagina home
function getHomePage($params) {
    // Disponi i parametri per essere utilizzati in home.php
    $_GET = $params;
    include 'home.php';
}

// Funzione per gestire altre richieste API (aggiungi qui le tue funzioni)
function getPosts() {
    include 'get_posts.php';
}

function createPost() {
    include 'upload_posts.php';
}

function clearPost() {
    include 'clear_posts.php';
}

function login() {
    include 'login.html';
}

function login_form() {
    include 'login_form.php';
}

function getAccount() {
    include 'account.php';
}

function accountinfo() {
    include 'accountinfo.php';
}

// Router semplice per determinare quale funzione chiamare in base all'endpoint richiesto
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query_string = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$query_params = [];

if ($query_string) {
    parse_str($query_string, $query_params);
}

// Parsing dell'URI per determinare l'azione da eseguire
switch ($request_uri) {
    case '/home':
        getHomePage($query_params); // Pass the correct variable here
        break;
    case '/login':
        login();
        break;
    case '/account':
        getAccount();
        break;
    case '/info':
        accountinfo();
        break;
    case '/api/loginform':
        login_form();
        break;
    case '/api/clearposts':
        clearPost();
        break;
    case '/api/getposts':
        getPosts();
        break;
    case '/api/createpost':
        createPost();
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
        break;
}
?>
