const Modal = (function () {
    const overlayDOM = document.querySelector('#modal_overlay');
    const boxDOM     = document.querySelector('#modal_box');
    const formDOM    = document.querySelector('form');

    const showModal = () => {
        overlayDOM.classList.replace('invisible', 'visible');
        overlayDOM.classList.replace('opacity-0', 'opacity-100');
        boxDOM.classList.replace('invisible', 'visible');
        boxDOM.classList.replace('opacity-0', 'opacity-100');
    }

    const closeModal = () => {
        overlayDOM.classList.replace('visible', 'invisible');
        overlayDOM.classList.replace('opacity-100', 'opacity-0');
        boxDOM.classList.replace('visible', 'invisible');
        boxDOM.classList.replace('opacity-100', 'opacity-0');
    }

    const closeTriggers = document.querySelectorAll('[data-close-modal-trigger]');
    const openTriggers  = document.querySelectorAll('[data-open-modal-trigger]');

    formDOM.addEventListener('submit', e => e.preventDefault())
    overlayDOM.addEventListener('click', e => {
        if (e.target === e.currentTarget) {
            closeModal()
        }
    })

    if (closeTriggers) {
        closeTriggers.forEach(trigger => trigger.addEventListener('click', closeModal))
    }
    if (openTriggers) {
        openTriggers.forEach(trigger => trigger.addEventListener('click', showModal))
    }

    const extractFormData = () => {
        if (!formDOM.checkValidity()) {
            formDOM.reportValidity();
            throw Error('Um ou mais campos obrigatórios não foram preenchidos, verifique...')
        }
        const form = new FormData(formDOM)
        const data = new Object()
        form.forEach((value, key) => {
            data[key] = value
        });
        return data;
    }

    return {
        open : showModal,
        close: closeModal,
        getData: extractFormData
    }
}())