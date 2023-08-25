const PersonsView = (function () {

    Modal.onOpen(async ({ action , recordId: personId }) => {
        if (action === Modal.ACTION_CREATE) {
            return
        }
        const res = await fetch(`${window.location.href}/${personId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: personId
        })
        .then(res => res.json())
        const person = res.data
        if (person) {
            Modal.setData({id: person, name: 'Teste', cpf: 'xxxxxxx'})
        }
    })

    Modal.onConfirm(async (action) => {
        switch (action) {
            case Modal.ACTION_CREATE:
                return createNewPerson()
            case Modal.ACTION_UPDATE:
                return updatePerson()
            case Modal.ACTION_SHOW:
            default:
        }
    })

    const addPersonOnList = (person) => {
        const listPersonsDOM = document.querySelector('ul[role=list]')
        const personDOM = document.createElement('li')
        personDOM.innerHTML = `
            <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-md font-semibold leading-6 text-gray-900">${person.name}</p>
                    <p class="mt-1 truncate text-sm leading-5 text-gray-500">${person.cpf}</p>
                </div>
            </div>
            <div class="flex gap-5">
                <a class="text-red-500 bg-red-100 h-10 w-10 rounded-md hover:text-white hover:bg-red-500 grid place-items-center"><i class="fa-solid fa-trash"></i></a>
                <a class="text-green-500 bg-green-100 h-10 w-10 rounded-md hover:text-white hover:bg-green-500 grid place-items-center" data-open-modal-trigger><i class="fa-solid fa-pen-to-square"></i></a>
            </div>
        `
        personDOM.classList.add('flex', 'justify-between', 'gap-x-6', 'p-3', 'hover:bg-gray-100', 'cursor-pointer', 'rounded-md')
        listPersonsDOM.appendChild(personDOM)
    }

    const createNewPerson = () => {
        const person = Modal.getData()
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(person)
        })
        .then(res => res.json())
        .then(res => {
            if (res && res.data) {
                const createdPerson = res.data;
                addPersonOnList(createdPerson)
                Modal.close()
                Message.info(res.message)
            }
        })
        .catch(error => Message.error(error))
    }
}())