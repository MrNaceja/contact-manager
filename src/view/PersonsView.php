<?php $this->layout('LayoutView', ['title' => $title]) ?>
<section class="px-6">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Consulta de Pessoas</h1>
    <main class="h-[calc(100vh-8rem)] overflow-auto">
        <ul role="list" class="divide-y divide-gray-100 pr-6">
            <?php foreach ($persons as $person) : ?>
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-md font-semibold leading-6 text-gray-900"><?= $person['name'] ?></p>
                            <p class="mt-1 truncate text-sm leading-5 text-gray-500"></p><?= $person['cpf'] ?></p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <button class="text-red-500 bg-red-100 h-10 w-10 rounded-md"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-green-500 bg-green-100 h-10 w-10 rounded-md"><i class="fa-solid fa-pen-to-square"></i></button>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </main>
</section>