<?php 

enum EnumModalActions {
    const ACTION_CREATE = 1;
    const ACTION_UPDATE = 2;
    const ACTION_SHOW   = 3;
}

?>

<?= $this->layout('LayoutView', ['title' => $title]) ?>
<section class="px-6 flex flex-col gap-4">
    <div class="flex flex-row justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Consulta de Pessoas</h1>
        <button 
            type="button" 
            class="p-2 bg-gradient-to-br from-indigo-500 to-indigo-800 text-white rounded-md cursor-pointer" data-modal-open-trigger data-modal-action="<?= EnumModalActions::ACTION_CREATE ?>">Nova pessoa</button>
    </div>
    <main class="h-[calc(100vh-10rem)] overflow-auto bg-white shadow-2xl p-2 rounded-lg">
        <ul role="list" class="divide-y divide-gray-100">
            <?php foreach ($persons as $person /** @var $person Person */) : ?>
                <li class="flex justify-between gap-x-6 p-3 hover:bg-gray-100 cursor-pointer rounded-md" data-modal-record-id="<?= $person->getId() ?>" data-modal-action="<?= EnumModalActions::ACTION_SHOW ?>" data-modal-open-trigger>
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-md font-semibold leading-6 text-gray-900"><?= $person->getName() ?></p>
                            <p class="mt-1 truncate text-sm leading-5 text-gray-500"></p><?= $person->getCpf() ?></p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <a class="text-red-500 bg-red-100 h-10 w-10 rounded-md hover:text-white hover:bg-red-500 grid place-items-center"><i class="fa-solid fa-trash"></i></a>
                        <a data-modal-open-trigger data-modal-record-id="<?= $person->getId() ?>" data-modal-action="<?= EnumModalActions::ACTION_UPDATE ?>"
                            class="text-green-500 bg-green-100 h-10 w-10 rounded-md hover:text-white hover:bg-green-500 grid place-items-center"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </main>
</section>
<?= $this->insert('components/PersonFormModal') ?>
<?php $this->push('scripts') ?>
    <script src="src/view/scripts/Modal.js"></script>
    <script src="src/view/scripts/PersonsView.js"></script>
<?php $this->end() ?>