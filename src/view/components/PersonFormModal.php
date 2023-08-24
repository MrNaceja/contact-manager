<div class="fixed inset-0 bg-gray-500 bg-opacity-75 grid place-items-center invisible opacity-0 transition-opacity duration-500 backdrop-blur-sm" id="modal_overlay">
    <div class="overflow-hidden rounded-lg bg-white text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg invisible opacity-0 transition-opacity duration-100" id="modal_box">
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
                onClick="PersonsView.create()" 
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Confirmar</button>
            <button type="button" data-close-modal-trigger class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
        </div>
    </div>
</div>