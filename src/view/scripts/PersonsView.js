const init = () => {
    addListenerDeleteRecords('Exluir a pessoa selecionada?')
    const inputSearch = document.querySelector('[role="search"] input')
    const buttonSearch = document.querySelector('[role="search"] a')
    buttonSearch.addEventListener('click', e => {
        e.preventDefault()
        const personNameSearched = inputSearch.value
        if (personNameSearched.length == 0) {
            return;
        }
        window.location.href = (new URL('pessoas/pessoa/' + personNameSearched, window.location.origin)).href;
    }) 
}

window.onload = init