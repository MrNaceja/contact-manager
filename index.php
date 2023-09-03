<?php

require __DIR__.'/src/config/bootstrap.php';

use Bramus\Router\Router;

use App\Controller\WelcomeController;
use App\Controller\PersonController;
use App\Controller\ContactController;

// Definindo as rotas do app
$router = new Router();
$router->get('/', WelcomeController::class.'@index');

//Rotas relacionadas à pessoas
$router->get('/pessoas'                     , PersonController::class .'@index');
$router->get('/pessoas/pessoa/{personName}' , PersonController::class .'@search');
$router->get('/pessoas/cadastro'            , PersonController::class .'@formCreate');
$router->get('/pessoas/detalhes/{id}'       , PersonController::class .'@formShow');
$router->get('/pessoas/atualizacao/{id}'    , PersonController::class .'@formUpdate');
    $router->post('/pessoas/cadastro'        , PersonController::class .'@create');
    $router->post('/pessoas/atualizacao/{id}', PersonController::class .'@update');
    $router->get('/pessoas/deletar/{id}'     , PersonController::class .'@delete');

//Rotas relacionadas à contatos
$router->get('/contatos'                 , ContactController::class .'@index');
$router->get('/contatos/cadastro'        , ContactController::class .'@formCreate');
$router->get('/contatos/detalhes/{id}'   , ContactController::class .'@formShow');
$router->get('/contatos/atualizacao/{id}', ContactController::class .'@formUpdate');
    $router->post('/contatos/cadastro'        , ContactController::class .'@create');
    $router->post('/contatos/atualizacao/{id}', ContactController::class .'@update');
    $router->get('/contatos/deletar/{id}'     , ContactController::class .'@delete');

// Rota padrão "Não encontrado (404)"
$router->set404(WelcomeController::class . '@handlePageNotFound');
$router->run();