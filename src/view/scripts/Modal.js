const Modal = (function () {
    const overlayDOM = document.querySelector('#modal_overlay');
    const boxDOM     = document.querySelector('#modal_box');
    const formDOM    = document.querySelector('form');
    const lockDOM    = document.querySelector('#modal_lock')

    var handleOpenModal    = ({action, recordId}) => new Promise( res => res())
    var handleConfirmModal = (action)             => new Promise(res => res())

    const ACTION_CREATE = 1, ACTION_UPDATE = 2, ACTION_SHOW = 3;

    var modalCurrentAction = ACTION_CREATE
    var modalRecordId      = false

    const toggleShow = (...elements) => {
        elements.map(element => {
            element.classList.replace('invisible', 'visible');
            // element.classList.replace('opacity-0', 'opacity-100');
        })
    }

    const toggleHide = (...elements) => {
        elements.map(element => {
            element.classList.replace('visible', 'invisible');
            // element.classList.replace('opacity-100', 'opacity-0');
        })
    }

    const lockModal = () => {
        toggleShow(lockDOM)
    }

    const unlockModal = () => {
        toggleHide(lockDOM)
    }

    const showModal = () => {
        lockModal()
        toggleShow(overlayDOM, boxDOM)
        handleOpenModal({action: modalCurrentAction, recordId: modalRecordId})
        .then(unlockModal)
        .catch(e => {
            Message.error(e.message)
            closeModal()
        })
    }

    const confirmModal = () => {
        if (!formDOM.checkValidity()) {
            formDOM.reportValidity();
            return Message.error('Um ou mais campos obrigatórios não foram preenchidos')
        }
        lockModal()
        handleConfirmModal()
        .then(closeModal)
        .catch(e => {
            Message.error(e.message)
            unlockModal()
        })
    }

    const closeModal = () => {
        toggleHide(overlayDOM, boxDOM)
        unlockModal()
        formDOM.reset()
    }

    formDOM.addEventListener('submit', e => e.preventDefault())
    overlayDOM.addEventListener('click', e => {
        if (e.target === e.currentTarget) {
            closeModal()
        }
    })

    const openTriggers    = document.querySelectorAll('[data-modal-open-trigger]')
    const closeTriggers   = document.querySelectorAll('[data-modal-close-trigger]')
    const confirmTriggers = document.querySelectorAll('[data-modal-confirm-trigger]')

    if (closeTriggers) {
        closeTriggers.forEach(trigger => trigger.addEventListener('click', closeModal))
    }
    if (confirmTriggers) {
        confirmTriggers.forEach(trigger => trigger.addEventListener('click', confirmModal))
    }
    if (openTriggers) {
        openTriggers.forEach(trigger => trigger.addEventListener('click', (e) => {
            e.stopPropagation()
            modalRecordId      = parseInt(trigger.getAttribute('data-modal-record-id'))
            modalCurrentAction = parseInt(trigger.getAttribute('data-modal-action'))
            if (!modalCurrentAction) {
                return Message.info('Ação inválida')
            }
            if ([ACTION_UPDATE, ACTION_SHOW].includes(modalCurrentAction)) {
                if (!modalRecordId) {
                    return Message.info('ID inválido')
                }
            }
            showModal()
        }))
    }

    const extractFormData = () => {
        const form = new FormData(formDOM)
        const data = new Object()
        form.forEach((value, key) => {
            data[key] = value
        });
        return data;
    }

    const populateFormData = (data) => {
        Array.from(formDOM.elements).map(input => {
            if (data[input.name]) {
                input.value = data[input.name]
            }
        })
    }

    return {
        open : showModal,
        close: closeModal,
        getData: extractFormData,
        setData: populateFormData,
        confirm: confirmModal,
        onOpen: handleOpen => handleOpenModal = handleOpen,
        onConfirm: handleConfirm => handleConfirmModal = handleConfirm,

        ACTION_CREATE,
        ACTION_UPDATE,
        ACTION_SHOW
    }
}())