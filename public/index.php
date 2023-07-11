<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

$rotas = require __DIR__ . '/../config/routes.php';
$caminho = $_SERVER['PATH_INFO'];

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaLogin = stripos($caminho, 'login');

if (!isset($_SESSION['logado']) && $ehRotaLogin === false) {
    header('Location: /login');
    exit;
}

$psr17factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17factory,
    $psr17factory,
    $psr17factory,
    $psr17factory
);

$request = $creator->fromGlobals();
$nomeControlador = $rotas[$caminho];

$container = require __DIR__ . "/../config/dependencies.php";

//Se uma variavel contem uma string com valor identico ao de uma classe, podemos instanciar uma classe
// usando o valor dessa variavel.
$controlador = $container->get($nomeControlador);
$response = $controlador->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();