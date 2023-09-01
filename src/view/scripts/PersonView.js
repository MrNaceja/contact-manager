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

const CONTACT_TYPE_TELEFONE = 1
const CONTACT_TYPE_EMAIL = 2;

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

const maskCpf = (event) => {
    const inputDOM = event.target
    var value = inputDOM.value.replace(/\D/g, ''); // Remove caracteres não numéricos
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
    inputDOM.value = value;
}
const maskTelefone = (event) => {
    const inputDOM = event.target;
    const value = inputDOM.value.replace(/\D/g, ''); // Remove não dígitos
    if (value.length > 0) {
        const match = value.match(/^(\d{2})(\d{4,5})(\d{0,4})$/);
        inputDOM.value = match ? `(${match[1]}) ${match[2]} - ${match[3]}` : value;
    } else {
        inputDOM.value = '';
    }
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

