<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

//Carregando as variaveis de ambiente no projeto.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Inicializando o ORM
$oConfig = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../../src'],
    isDevMode: true,
);

//Inicializando a conexão ORM
$oConnection = DriverManager::getConnection([
    'driver'   => $_ENV['DB_DRIVER'],
    'host'     => $_ENV['DB_HOST'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname'   => $_ENV['DB_NAME'],
], $oConfig);

//Instância do Gerenciador ORM
$entityManager = new EntityManager($oConnection, $oConfig);
