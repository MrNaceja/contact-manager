# Contact Manager

## Requisitos para rodar o projeto
> Ter instalado o composer
> Ter instalado o PHP v8.2
> Ter instalado Xampp

## 1. Baixar ou clonar o projeto, conforme configurações do XAMPP, é sugerido colocar a pasta em htdocs

## 2. Rodar o comando ``composer install``
## 3. Em vendor/bin/doctrine cole o comando ``php 
    use Doctrine\ORM\Tools\Console\ConsoleRunner;
    use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

    require __DIR__ . '../../../src/config/bootstrap.php';

    ConsoleRunner::run(
        new SingleManagerProvider($entityManager)
    );
``

## 4. No Xampp, iniciar o servidor apache e também os serviços MySql
## 5. Rodar o comando ``php vendor/bin/doctrine orm:schema-tool:create``
## 6. Por fim, no navegador, abrir ``localhost``, a página já deve estar em funcionamento.