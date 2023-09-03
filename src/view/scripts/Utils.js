const CONTACT_TYPE_TELEFONE = 1
const CONTACT_TYPE_EMAIL    = 2;

const maskCpf = (changeTextEvent) => {
    const inputDOM = changeTextEvent.target
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

const maskTelefone = (changeTextEvent) => {
    const inputDOM = changeTextEvent.target
    const value = inputDOM.value.replace(/\D/g, ''); // Remove não dígitos
    if (value.length > 0) {
        const match = value.match(/^(\d{2})(\d{4,5})(\d{0,4})$/);
        inputDOM.value = match ? `(${match[1]}) ${match[2]} - ${match[3]}` : value;
    } else {
        inputDOM.value = '';
    }
}

const addListenerDeleteRecords = (messageAlert) => {
    Array.from(document.querySelectorAll('[role="record_actions"] a:nth-child(3)')).map(btnDel => {
        btnDel.addEventListener('click', e => {
            e.preventDefault()
            swal({
                title: messageAlert,
                icon: 'warning',
                dangerMode: true,
                buttons: {
                    yes: {
                        value: true,
                        text: "Sim, Remover",
                        className: "bg-gradient-to-br from-red-500 to-red-600",
                    },
                    cancel: {
                        value:false,
                        visible: true,
                        text: 'Não, cancelar',
                    }
                }
            }).then((remove) => {
                if (remove) {
                    window.location.href = btnDel.getAttribute('href');
                }
                swal.close()
            });
        })
    })
}