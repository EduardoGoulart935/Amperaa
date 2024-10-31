<?php

//AUTOLOAD DO COMPOSER
require_once('../vendor/autoload.php');

//DEPENDENCIAS 
use Google\Client as GoogleClient;
use \App\Session\User as SessionUser;
//VALIDAÇÃO PRINCIPAL DO COOKIE

// VERFICA OS CAMPOS OBRIGATÓRIO
if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])){
    header("Location: /Ampera/login");
    exit;
}

//COOKIE CSRF
$cookie = $_COOKIE['g_csrf_token'] ?? '';

//VERIFICA O VALOR DO COOKIE E DO POST PARA O CSRF

if($_POST['g_csrf_token'] != $cookie){
    header("Location: login");
    exit;
}

//VALIDAÇÃO SECUNDARIA

$client = new GoogleClient(['client_id' => '893505429066-khcu5lbc7bdj7uc0moae5hn2m2bckjql.apps.googleusercontent.com']); 

//OBTEM OS DADOS DO USUÁRIO COM BASE NO JWT
$payload = $client->verifyIdToken($_POST['credential']);

//VERIFICA SE OS DADOS DO PAYLOAD
if (isset($payload['email'])) {
    SessionUser::login($payload['name'],$payload['email']);
    header("Location: /Ampera/menu");
    exit;
} 

//PROBLEMAS AO CONSULTAR A API
die('Problemas ao consultar API');