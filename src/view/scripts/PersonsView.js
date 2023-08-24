const PersonsView = (function () {
    const createNewPerson = () => {
        try {
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
                    Modal.close()
                    Message.info(res.message)
                }
            })
            .catch(error => Message.error(error))
        } catch (e) {
            return Message.error(e.message)
        }
    }
    return {
        create: createNewPerson   
    }
}())