<?= $this->layout('LayoutView', ['title' => $title]) ?>
<section class="px-6 flex flex-col gap-4">
    <div class="flex flex-row justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Consulta de Pessoas</h1>
        <div class="flex gap-3 items-center">
            <a href="<?= parseUrlRoute('/pessoas') ?>" title="Recarregar a consulta"><i class="fa-solid fa-arrows-rotate text-indigo-500"></i></a>
            <div role="search" class="flex">
                <input type="text" name="personName" placeholder="Buscar pessoa..." class="outline-0 bg-gray-100 p-2">
                <a href="<?= toRoute('/pessoa') ?>" class="bg-gradient-to-br from-indigo-500 to-indigo-800 text-white py-3 px-4 rounded-md"><i class="fas fa-search"></i></a>
            </div>
            <a href="<?= parseUrlRoute('pessoas/cadastro') ?>" class="p-3 bg-gradient-to-br from-indigo-500 to-indigo-800 text-white rounded-md cursor-pointer">Nova pessoa</a>
        </div>
    </div>
    <main class="h-[calc(100vh-10rem)] overflow-auto bg-white shadow-2xl p-2 rounded-lg">
        <?php if (!empty($persons)) : ?>
            <ul role="list" class="divide-y divide-gray-100">
                <?php foreach ($persons as $person
                    /** @var $person Person */
                ) : ?>
                    <li role="record" class="flex justify-between gap-x-6 p-3 hover:bg-gray-100 cursor-pointer rounded-md">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-md font-semibold leading-6 text-gray-900"><?= $person->getName() ?></p>
                                <p class="mt-1 truncate text-sm leading-5 text-gray-500"></p><?= $person->getCpf() ?></p>
                            </div>
                        </div>
                        <div role="record_actions" class="flex gap-5">
                            <a href="<?= parseUrlRoute("pessoas/detalhes/{$person->getId()}") ?>" class="text-sky-500 bg-sky-100 h-10 w-10 rounded-md hover:text-white hover:bg-sky-500 grid place-items-center">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= parseUrlRoute("pessoas/atualizacao/{$person->getId()}") ?>" class="text-green-500 bg-green-100 h-10 w-10 rounded-md hover:text-white hover:bg-green-500 grid place-items-center">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="<?= parseUrlRoute("pessoas/deletar/{$person->getId()}") ?>" class="text-red-500 bg-red-100 h-10 w-10 rounded-md hover:text-white hover:bg-red-500 grid place-items-center">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php else : ?>
            <div class="m-auto h-full w-full grid place-items-center">
                <h1 class="text-2xl text-gray-500">Não há pessoas para listar</h1>
            </div>
        <?php endif ?>
    </main>
</section>
<?php $this->start('scripts') ?>
<script src="../../src/view/scripts/Utils.js"></script>
<script src="../../src/view/scripts/PersonsView.js"></script>
<?php $this->end() ?>