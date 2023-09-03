<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://kit.fontawesome.com/dbe0b3e2fa.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="./../../tailwind.config.js"></script>
        <title><?= $title ?></title>
    </head>
    <body class="font-app antialised overflow-hidden">
        <?php $noHeader = $noHeader ?? false ?>
        <?= !$noHeader && $this->insert('components/header') ?>
            <section class="h-full mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <?= $this->section('content') ?>
            </section>
        <?= $this->insert('components/message') ?>
        <?= $this->section('scripts') ?>
    </body>
</html>