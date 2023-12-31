<?= $this->layout('LayoutView', ['title' => $title]) ?>

<section class="px-6 flex flex-col gap-4">
    <div class="flex flex-row justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Consulta de Contatos</h1>
        <a href="<?= toRoute('/cadastro') ?>" class="p-2 bg-gradient-to-br from-indigo-500 to-indigo-800 text-white rounded-md cursor-pointer">Nova contato</a>
    </div>
    <main class="h-[calc(100vh-10rem)] overflow-auto bg-white shadow-2xl p-2 rounded-lg">
        <?php if (!empty($contacts)) : ?>
            <ul role="list" class="divide-y divide-gray-100">
                <?php foreach ($contacts as $contact /** @var $contact Contact */) : ?>
                    <li role="record" class="flex justify-between gap-x-6 p-3 hover:bg-gray-100 cursor-pointer rounded-md">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                               <div class="flex gap-1">
                                    <p class="text-md font-semibold leading-6 text-gray-900"><?= $contact->getType(true) ?></p>
                                    <p class="truncate text-sm leading-5 text-gray-500"></p><?= $contact->getDescription() ?></p>
                                </div>
                                <span class="text-xs bg-gradient-to-br from-indigo-400 to-indigo-900 p-1 text-white rounded-md"><?= $contact->getPerson()->getName() ?></span>
                            </div>
                        </div>
                        <div role="record_actions" class="flex gap-5">
                            <a href="<?= toRoute("/detalhes/{$contact->getId()}") ?>" class="text-sky-500 bg-sky-100 h-10 w-10 rounded-md hover:text-white hover:bg-sky-500 grid place-items-center">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= toRoute("/atualizacao/{$contact->getId()}") ?>" class="text-green-500 bg-green-100 h-10 w-10 rounded-md hover:text-white hover:bg-green-500 grid place-items-center">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="<?= toRoute("/deletar/{$contact->getId()}") ?>" class="text-red-500 bg-red-100 h-10 w-10 rounded-md hover:text-white hover:bg-red-500 grid place-items-center">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php else : ?>
            <div class="m-auto h-full w-full grid place-items-center">
                <h1 class="text-2xl text-gray-500">Não há contatos para listar</h1>
            </div>
        <?php endif ?>
    </main>
</section>
<?php $this->start('scripts') ?>
    <script src="../../src/view/scripts/Utils.js"></script>
    <script>
        addListenerDeleteRecords('Exluir o contato selecionado?')
    </script>
<?php $this->end() ?>