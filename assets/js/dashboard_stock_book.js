const searchInput = document.getElementById('title');
const searchForm = document.getElementById('search-form');
const responseDiv = document.createElement('div');
const bookDatas = document.getElementById('book-datas'); // pour mettre l'input caché avec l'id du livre récupéré en grâce au fetch
searchForm.append(responseDiv);


//search bar

searchInput.addEventListener('input', function(){
    const search = searchInput.value;
    responseDiv.textContent = '';
    if(search.length >= 3){
        fetch('/search-book', {
            method: 'POST',
            body: JSON.stringify(search)
        })
        .then(response => response.json())
        .then(data => {
            const list = document.createElement('ul');
            responseDiv.append(list);

            data.forEach(book => {
                const listBook = document.createElement('li');
                listBook.textContent = book.title;
                listBook.setAttribute('id', book.id_book);
                list.append(listBook);

                // cursor pointer sur le titre du livre
                listBook.addEventListener('mouseover', function(){
                    listBook.style.cursor = 'pointer';
                })

                listBook.addEventListener('click', function(){
                    responseDiv.textContent = '';
                    searchInput.value = this.textContent;

                    // Création d'un input caché pour envoyer l'id du livre au controller
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('hidden', true);
                    hiddenInput.setAttribute('name', 'id_book');
                    hiddenInput.setAttribute('value', book.id_book);
                    bookDatas.append(hiddenInput);
                })
            })
        })
    }
})


const modifyBtnArray = document.querySelectorAll('.modify-btn');
const confirmDeleteModal = document.querySelector('.modal'); 

modifyBtnArray.forEach(btn => {
    btn.addEventListener('click', function(){
        const idCopy = this.value;
        const divParent = this.parentElement;
        const select = divParent.querySelector('select[name="state"]');
        const deleteBtn = divParent.querySelector('.delete-btn');
        const validateBtn = divParent.querySelector('.validate-btn');

        // faire apparaitre le select + bouton valider
        select.removeAttribute('disabled');
        deleteBtn.removeAttribute('disabled');
        this.style.display = 'none';
        validateBtn.classList.remove('hidden');


        deleteBtn.addEventListener('click', function(){
            confirmDeleteModal.style.display = 'block';
            const confirmDeleteBtn = document.getElementById('confirm-delete');

            confirmDeleteBtn.addEventListener('click', function(){
                fetch(`/delete-book-copy/${idCopy}`)
                .then(response => response.json())
                .then(data => {
                    if(data){
                        //recharger la page après la suppression
                        window.location.reload();
                    }
                })
            })
        })

    })
})


// CHANGER L'ETAT DES EXEMPLAIRES

const stateInputArray = document.querySelectorAll('[name="state"]');
