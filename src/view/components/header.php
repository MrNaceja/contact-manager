<?php

use App\Controller\RouteController;

const BG_ACTIVE   = "bg-gradient-to-br from-indigo-500 to-indigo-800 text-white";
const BG_INACTIVE = "text-gray-300 hover:bg-zinc-700 hover:text-white";

?>

<header class="bg-zinc-900 sticky top-0 left-0 right-0">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="<?= parseUrlRoute('/') ?>"         
                           class="<?= RouteController::isRoute('/') ? BG_ACTIVE : BG_INACTIVE ?> rounded-md px-3 py-2 text-sm font-medium"
                        >Boas vindas</a>
                        <a href="<?= parseUrlRoute('/pessoas') ?>"  
                           class="<?= RouteController::isRoute('/pessoas') ? BG_ACTIVE : BG_INACTIVE ?> rounded-md px-3 py-2 text-sm font-medium"
                        >Pessoas</a>
                        <a href="<?= parseUrlRoute('/contatos') ?>" 
                           class="<?= RouteController::isRoute('/contatos') ? BG_ACTIVE : BG_INACTIVE ?> rounded-md px-3 py-2 text-sm font-medium"
                        >Contatos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>