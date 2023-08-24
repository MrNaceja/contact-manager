const Message = (function () {

    const createMessageDOM = () => {
        const box              = document.createElement('div'),
              title            = document.createElement('h4'),
              message          = document.createElement('p'),
              icon             = document.createElement('i'),
              contentContainer = document.createElement('div');
        box.classList.add('flex', 'gap-5', 'shadow-md', 'rounded-lg', 'h-max', 'p-3', 'w-max', 'fixed', 'bottom-10', 'left-2/4', '-translate-x-2/4', 'items-center', 'opacity-0', 'transition-opacity', 'ease-in-out')
        title.classList.add('text-gray', 'font-bold')
        message.classList.add('text-ellipsis', 'overflow-hidden', 'text-sm', 'text-gray-500')
        icon.classList.add('fa-solid', 'fa-2x')
        contentContainer.append(title, message)
        box.append(icon, contentContainer)
        return { box, title, message, icon }
    }

    const getStyledInfoMessage = () => {
        const messageDOM = createMessageDOM()
        messageDOM.icon.classList.add('fa-circle-info', 'text-sky-500')
        messageDOM.title.classList.replace('text-gray', 'text-sky-500')
        messageDOM.message.classList.replace('text-gray-500', 'text-sky-400')
        messageDOM.box.classList.add('bg-sky-100')
        return messageDOM
    }

    const getStyledErrorMessage = () => {
        const messageDOM = createMessageDOM()
        messageDOM.icon.classList.add('fa-triangle-exclamation', 'text-red-500')
        messageDOM.title.classList.replace('text-gray', 'text-red-500')
        messageDOM.message.classList.replace('text-gray-500', 'text-red-400')
        messageDOM.box.classList.add('bg-red-100')
        return messageDOM
    }

    const showInfo = message => {
        showMessage(
            getStyledInfoMessage(),
            'Informação',
            message
        )
    }
    const showError = message => {
        showMessage(
            getStyledErrorMessage(),
            'Erro',
            message
        )
    }

    const showMessage = (messageDOM, title, message) => {
        messageDOM.title.innerText   = title
        messageDOM.message.innerText = message
        messageDOM.box.classList.replace('invisible', 'visible');
        messageDOM.box.classList.replace('opacity-0', 'opacity-100');
        document.body.appendChild(messageDOM.box)
        setTimeout(() => closeMessage(messageDOM.box), 4000);
    }

    const closeMessage = boxMessageDOM => {
        boxMessageDOM.classList.replace('visible', 'invisible');
        boxMessageDOM.classList.replace('opacity-100', 'opacity-0');
        setTimeout(() => document.body.removeChild(boxMessageDOM), 1000)
    }

    return {
        info: showInfo,
        error: showError
    }
}())