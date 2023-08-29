<?php

use App\Utils\Enum\EnumActions;

$action = $action ?? EnumActions::ACTION_CREATE;

?>
<?= $this->layout('LayoutView', ['title' => $title]) ?>
<a href="/pessoas" class="bg-gradient-to-br from-indigo-500 to-indigo-800 rounded-full text-white p-2 h-10 w-10 grid place-items-center cursor-pointer" title="Voltar"><i class="fa-solid fa-arrow-left"></i></a>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"><?= $actionTitle ?></h2>
    </div>
    <form class="space-y-6 w-1/2 mx-auto" method="POST">
        <input type="hidden" name="id" value="<?= isset($person) ? $person->getId() : '' ?>">
        <div class="space-y-2">
            <label for="email" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Nome</label>
            <input <?= $action == EnumActions::ACTION_SHOW ? 'disabled' : '' ?> value="<?= isset($person) ? $person->getName() : '' ?>" id="name" name="name" type="text" required class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        <div class="space-y-2">
            <label for="cpf" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">CPF</label>
            <input <?= $action == EnumActions::ACTION_SHOW ? 'disabled' : '' ?> value="<?= isset($person) ? $person->getCpf() : '' ?>" id="cpf" name="cpf" type="text" required maxlength="14" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        <?php if ($action != EnumActions::ACTION_SHOW) : ?>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirmar</button>
        <?php endif ?>
    </form>
</div>

<?php $this->start('scripts') ?>
<script>
    document.querySelector('form').addEventListener('submit', e => {
        if (e.target.elements.cpf.value.length < 14) {
            swal({
                title: 'Campo CPF inválido',
                icon: 'error',
                button: {
                    text: "Entendi",
                    value: true,
                    visible: true,
                    className: "bg-gradient-to-br from-indigo-500 to-indigo-800",
                    closeModal: true,
                }
            }).then(() => document.querySelector('#cpf').focus());
            e.preventDefault();
        }
    })
    document.querySelector('#cpf').addEventListener('input', e => { maskCpf(e.target) })

    const maskCpf = (inputEl) => {
        value = inputEl.value.replace(/\D/g, ''); // Remove caracteres não numéricos
        if (value.length > 11) {
            value = value.substring(0, 11); // Limita a 11 dígitos
        }
        if (value.length > 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Aplica a máscara
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3'); // Aplica a máscara parcial
        } else if (value.length > 3) {
            value = value.replace(/(\d{3})(\d{3})/, '$1.$2'); // Aplica a máscara parcial
        }
        inputEl.value = value;
    }

</script>
<?php $this->end() ?>