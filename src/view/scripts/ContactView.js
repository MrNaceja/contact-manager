const init = () => {
    document.querySelector('[name="type"]').addEventListener('change', e => {
        const type = parseInt(e.target.value)
        const descriptionDOM = document.querySelector('[name="description"]');
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

    document.querySelector('form').addEventListener('submit', e => {
        const typeSelected = parseInt(e.target.elements.type.value)
        const description = e.target.elements.description.value
        if (typeSelected == CONTACT_TYPE_TELEFONE &&  description.length < 17) {
            swal({
                title: 'Campo Telefone inválido',
                icon: 'error',
                button: {
                    text: "Entendi",
                    value: true,
                    visible: true,
                    className: "bg-gradient-to-br from-indigo-500 to-indigo-800",
                    closeModal: true,
                }
            }).then(() => document.querySelector('[name="description"]').focus());
            e.preventDefault();
        }
    })    
}
window.onload = init