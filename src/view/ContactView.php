<?php

use App\Utils\Enum\EnumActions;
use App\Utils\Enum\EnumTypeContact;

$action = $action ?? EnumActions::ACTION_CREATE;

?>
<?= $this->layout('LayoutView', ['title' => $title]) ?>
<a href="/contatos" class="bg-gradient-to-br from-indigo-500 to-indigo-800 rounded-full text-white p-2 h-10 w-10 grid place-items-center cursor-pointer" title="Voltar"><i class="fa-solid fa-arrow-left"></i></a>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"><?= $actionTitle ?></h2>
    </div>
    <form class="space-y-6 w-1/2 mx-auto <?= $action == EnumActions::ACTION_SHOW ? 'disabled pointer-events-none' : '' ?>" method="POST">
        <input type="hidden" name="id" value="<?= isset($contact) ? $contact->getId() : '' ?>">
        <div class="grid grid-cols-4 w-full gap-2">
            <div class="relative h-10 w-full col-span-2">
                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal  text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-pink-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-pink-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-pink-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Tipo
                </label>
                <select name="type" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 cursor-pointer focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                    <?php foreach (EnumTypeContact::values() as $descriptionType => $type) : ?>
                        <option value="<?= $type ?>" <?= (isset($contact) && $contact->getType() == $type) ? 'selected' : '' ?>><?= $descriptionType ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="relative h-10 w-full col-span-2">
                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal  text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-pink-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-pink-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-pink-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                    Pessoa
                </label>
                <select required name="personId" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 cursor-pointer focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                    <?php if ($action == EnumActions::ACTION_SHOW): ?>
                        <option selected value="<?= $contact->getPerson()->getId() ?>"><?= $contact->getPerson()->getName() ?></option>
                    <?php else: ?>
                        <option selected value="" disabled>Selecione uma pessoa</option>
                        <?php foreach ($persons as $person) : ?>
                            <option value="<?= $person->getId() ?>" <?= $action == EnumActions::ACTION_UPDATE && $contact->getPerson()->getId() == $person->getId() ? 'selected' : '' ?>><?= $person->getName() ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="space-y-2 col-span-4">
                <label for="description" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                <input <?= $action == EnumActions::ACTION_SHOW ? 'disabled' : '' ?> value="<?= isset($contact) ? $contact->getDescription() : '' ?>" id="description" name="description" type="text" required maxlength="30" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <?php if ($action != EnumActions::ACTION_SHOW) : ?>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirmar</button>
        <?php endif ?>
    </form>
</div>

<?php $this->start('scripts') ?>
    <script src="../../src/view/scripts/Utils.js"></script>
    <script src="../../src/view/scripts/ContactView.js"></script>
<?php $this->end() ?>