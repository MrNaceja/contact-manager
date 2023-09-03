var default_grid_line_contact;

const addContactLineGrid = () => {
    const grid = document.querySelector('[role="grid_contact"]')
    const newLineContact = default_grid_line_contact.cloneNode(true)
    addListenersOnContactGridLine(newLineContact)
    grid.append(newLineContact)  
}

const removeContactLineGrid = (lineDOM) => {
    const grid = document.querySelector('[role="grid_contact"]')
    if (grid.childElementCount == 1) { //Ao menos uma linha do grid deve existir
        return;
    }
    grid.removeChild(lineDOM)
}

const addListenersOnContactGridLine = (...lines) => {
    lines.map(lineDOM => {
        lineDOM.querySelector('[role="add_contact"]').addEventListener('click', addContactLineGrid)
        lineDOM.querySelector('[role="remove_contact"]').addEventListener('click', e => removeContactLineGrid(e.target.closest('li')))
        lineDOM.querySelector('[name="contacts[type][]"]').addEventListener('change', e => {
            const type = parseInt(e.target.value)
            const descriptionDOM = lineDOM.querySelector('[name="contacts[description][]"]');
            descriptionDOM.value = ''
            switch (type) {
                case CONTACT_TYPE_TELEFONE:
                    descriptionDOM.type = 'text'
                    descriptionDOM.setAttribute('maxLength', 17)
                    descriptionDOM.addEventListener('input', maskTelefone)
                break
                case CONTACT_TYPE_EMAIL:
                default:
                    descriptionDOM.type = 'email'
                    descriptionDOM.setAttribute('maxLength', 30)
                    descriptionDOM.removeEventListener('input', maskTelefone)
            }
        })
    })
}

const init = () => {
    document.querySelector('#cpf').addEventListener('input', maskCpf)  
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
    default_grid_line_contact = document.querySelector('#default_line[role="contact"]').cloneNode(true)
    addListenersOnContactGridLine(...document.querySelectorAll('[role="contact"]'))
}

window.onload = init

