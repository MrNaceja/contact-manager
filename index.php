<?php

require __DIR__.'/src/config/bootstrap.php';

use Bramus\Router\Router;

use App\Controller\WelcomeController;
use App\Controller\PersonController;
use App\Controller\ContactController;

$router = new Router();
$router->get('/', WelcomeController::class.'@index');

$router->get('/pessoas'                 , PersonController::class .'@index');
$router->get('/pessoas/cadastro'        , PersonController::class .'@formCreate');
$router->get('/pessoas/detalhes/{id}'   , PersonController::class .'@formShow');
$router->get('/pessoas/atualizacao/{id}', PersonController::class .'@formUpdate');
    $router->post('/pessoas/cadastro'        , PersonController::class .'@create');
    $router->post('/pessoas/atualizacao/{id}', PersonController::class .'@update');
    $router->get('/pessoas/deletar/{id}'     , PersonController::class .'@delete');

$router->get('/contatos', ContactController::class.'@index');


$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo 'Página não encontrada :(';
    exit();
});
$router->run();