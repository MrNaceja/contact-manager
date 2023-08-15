<?php

require __DIR__.'/src/config/bootstrap.php';

use App\Controller\RouteController as Router;

use App\Controller\WelcomeController;
use App\Controller\PersonController;
use App\Controller\ContactController;

Router::get('/'       , WelcomeController::class);
Router::get('/pessoas' , PersonController::class);
Router::get('/contatos', ContactController::class);

Router::listen();