<?php

use App\Utils\Enum\EnumActions;
use App\Utils\Enum\EnumTypeContact;

$action = $action ?? EnumActions::ACTION_CREATE;

?>
<?= $this->layout('LayoutView', ['title' => $title]) ?>
<a href="/pessoas" class="mb-2 bg-gradient-to-br from-indigo-500 to-indigo-800 rounded-full text-white p-2 h-10 w-10 grid place-items-center cursor-pointer" title="Voltar"><i class="fa-solid fa-arrow-left"></i></a>
<main class="h-[calc(100vh-10rem)] overflow-auto bg-white shadow-2xl p-2  rounded-lg">
    <div class="flex min-h-full flex-col justify-center px-3 py-8 lg:px-8 space-y-3">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm space-y-2">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"><?= $actionTitle ?></h2>
        </div>
        <form class="space-y-6 mx-auto justify-center w-2/3" method="POST">
            <input type="hidden" name="id" value="<?= isset($person) ? $person->getId() : '' ?>">
            <div class="space-y-2 w-2/3">
                <label for="email" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Nome</label>
                <input <?= $action == EnumActions::ACTION_SHOW ? 'disabled' : '' ?> value="<?= isset($person) ? $person->getName() : '' ?>" id="name" name="name" type="text" required class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            <div class="space-y-2 w-1/2">
                <label for="cpf" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">CPF</label>
                <input <?= $action == EnumActions::ACTION_SHOW ? 'disabled' : '' ?> value="<?= isset($person) ? $person->getCpf() : '' ?>" id="cpf" name="cpf" type="text" required maxlength="14" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            <fieldset class="border-2 p-3 rounded-md">
                <legend class="px-2">Contatos</legend>
                <ul role="grid_contact" class="space-y-3 <?= $action == EnumActions::ACTION_SHOW ? 'disabled pointer-events-none' : '' ?>">
                    <?php if (isset($person)): ?>
                        <?php foreach ($person->getContacts() as $i => $contact) : ?>
                            <li class="flex gap-3 justify-between" role="contact">
                                <div class="relative h-10 w-56">
                                    <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal  text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-pink-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-pink-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-pink-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        Tipo
                                    </label>
                                    <select name="contacts[type][]" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-red-500 cursor-pointer focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                        <?php foreach (EnumTypeContact::values() as $descriptionType => $type) : ?>
                                            <option value="<?= $type ?>" <?= $contact->getType() == $type ? 'selected' : '' ?>><?= $descriptionType ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <input type="<?= $action == EnumActions::ACTION_CREATE ? 'email' : 'text' ?>" name="contacts[description][]" placeholder="Descrição" class="px-2 outline-0 bg-gray-100 w-full" value="<?= $contact->getDescription() ?>">
                                <div class="flex gap-3">
                                    <button type="button" role="add_contact" class="p-2 bg-gray-200 text-gray-400 text-lg h-10 w-10 rounded-full">+</button>
                                    <button type="button" role="remove_contact" class="p-2 bg-gray-200 text-gray-400 text-lg h-10 w-10 rounded-full">-</button>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php if($action != EnumActions::ACTION_SHOW): ?>
                        <li class="flex gap-3 justify-between" role="contact" id="default_line">
                            <div class="relative h-10 w-60">
                                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal  text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-pink-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-pink-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-pink-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Tipo
                                </label>
                                <select name="contacts[type][]" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                    <?php foreach (EnumTypeContact::values() as $descriptionType => $type) : ?>
                                        <option value="<?= $type ?>"><?= $descriptionType ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <input type="email" name="contacts[description][]" placeholder="Descrição" class="px-3 outline-0 bg-gray-100 w-full">
                            <div class="flex gap-3">
                                <button type="button" role="add_contact" class="p-2 bg-gray-200 text-gray-400 text-lg h-10 w-10 rounded-full">+</button>
                                <button type="button" role="remove_contact" class="p-2 bg-gray-200 text-gray-400 text-lg h-10 w-10 rounded-full">-</button>
                            </div>
                        </li>
                    <?php endif ?>
                </ul>
            </fieldset>
            <?php if ($action != EnumActions::ACTION_SHOW) : ?>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirmar</button>
            <?php endif ?>
        </form>
    </div>
</main>
<?php $this->start('scripts') ?>
<script src="../../src/view/scripts/PersonView.js"></script>
<?php $this->end() ?>