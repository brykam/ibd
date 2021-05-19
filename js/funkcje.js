const dodajDoKoszyka = async (e) => {
    const a = e.target.closest('a.aDodajDoKoszyka')

    if (a) {
        e.preventDefault()
        const href = a.getAttribute('href')
        const response = await fetch(href, {method: 'POST'})
        const txt = await response.text()

        if (txt === 'ok') {
            const wKoszyku = document.querySelector('#wKoszyku')
            wKoszyku.innerHTML = parseInt(wKoszyku.innerHTML) + 1
            a.outerHTML = '<i class="fas fa-check text-success"></i>'
        } else {
            alert('Wystąpił błąd: ' + txt);
        }
    }
}

document.body.onload = () => {
    const ksiazki = document.querySelector('#ksiazki')
    if (ksiazki) {
        ksiazki.addEventListener('click', dodajDoKoszyka)
    }
}