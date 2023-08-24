<?php

require __DIR__.'/src/config/bootstrap.php';

use Bramus\Router\Router;

use App\Controller\WelcomeController;
use App\Controller\PersonController;
use App\Controller\ContactController;

$router = new Router();
$router->get('/'        , WelcomeController::class.'@index');
$router->get('/pessoas' , PersonController::class .'@index');
    $router->post('/pessoas', PersonController::class .'@create');
$router->get('/contatos', ContactController::class.'@index');
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo 'Página não encontrada :(';
    exit();
});
$router->run();