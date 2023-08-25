<div class="fixed inset-0 bg-gray-500 bg-opacity-75 grid place-items-center invisible backdrop-blur-sm" id="modal_overlay">
    <div class="relative overflow-hidden rounded-lg bg-white text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg invisible" id="modal_box">
        <div id="modal_lock" class="bg-gray-100 text-gray-700 h-full w-full absolute inset-0 flex flex-col items-center justify-center gap-5 opacity-85 invisible">
            <i class="fa-solid fa-spinner fa-2x animate-spin"></i>
            <p class="text-gray-500 text-sm">Carregando, por favor aguarde.</p>
        </div>
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="w-full flex flex-col space-y-5">
                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Dados da Pessoa</h3>
                <form class="space-y-3 w-full">
                    <div>
                        <label for="name" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">Nome</label>
                        <input id="name" name="name" type="text" required class="block w-full p-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div>
                        <label for="cpf" class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium leading-6 text-gray-900">CPF</label>
                        <input id="cpf" name="cpf" type="text" required maxlength="14" class="block w-full p-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button 
                type="button"
                data-modal-confirm-trigger 
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Confirmar</button>
            <button type="button" data-modal-close-trigger class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
        </div>
    </div>
</div>