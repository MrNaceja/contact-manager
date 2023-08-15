<?php

require_once "vendor/autoload.php";
require_once __DIR__.'../../utils/functions.php';

use App\Utils\Enum\EnumTypeContact;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

//Carregando as variaveis de ambiente no projeto.
$oDotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$oDotenv->load();

//Inicializando o ORM
$oConfig = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../../src/model'],
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

//Definindo os tipos personalizados de enum no banco de dados
Type::addType('typeContact', EnumTypeContact::class);

//Instância do Gerenciador ORM
$entityManager = new EntityManager($oConnection, $oConfig);
