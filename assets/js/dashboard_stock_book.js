const searchInput = document.getElementById('title');
const searchForm = document.getElementById('search-form');
const responseDiv = document.createElement('div');
responseDiv.id = 'listBook';
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
                listBook.textContent = book.title + ', par ' + book.author;
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
const confirmDeleteModal = document.getElementById('modal-delete-copy'); 

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
        this.style.visibility = 'hidden';
        validateBtn.classList.remove('hidden');
        const modal2 = document.getElementById("modal-delete-copy");
        const overlay2 = document.createElement("div");
        overlay.id = "modal-overlay2";
        document.body.appendChild(overlay);

        validateBtn.addEventListener('click', function(){
            window.location.reload();
        })

        // suppression de la copie (appelle la fonction deleteCopy())
        deleteBtn.addEventListener('click', function(){
            confirmDeleteModal.style.display = 'block';
            modal2.classList.add("active");
            overlay2.classList.add("active");
            const confirmDeleteBtn = document.getElementById('confirm-delete');
            
            confirmDeleteBtn.addEventListener('click', () => deleteCopy(idCopy));
            const closeModalBtn = document.getElementById("cancel2");

            const closeModal2 = () => {
                modal2.classList.remove("active");
                overlay2.classList.remove("active");
            };
        
            closeModalBtn.addEventListener("click", closeModal2);
            overlay.addEventListener("click", closeModal2);

        })


        // update état 

        const stateInputArray = document.querySelectorAll('[name="state"]');
        

        stateInputArray.forEach(btn => {
            btn.addEventListener('change', function(){
                const state = btn.value;
                validateBtn.addEventListener('click', () => updateCopy(idCopy, state))
            })
        })

    })
})


function deleteCopy(id){
    fetch(`/delete-book-copy/${id}`)
    .then(response => response.json())
    .then(data => {
        if(data){
        //recharger la page après la suppression
            window.location.reload();
        }
    })
}


function updateCopy(id, state){
    fetch('/update-state', {
        method: 'POST',
        body: JSON.stringify({id_copy: id, state: state})
    })
    .then(response => response.json())
    .then(data => {
        if(data){
        //recharger la page après la suppression
            window.location.reload();
        }
    })

}


// AJOUTER DES EXEMPLAIRES

const addCopiesBtn = document.getElementById('add-copies-btn');
const addCopiesModal = document.getElementById('modal-add-copies');
const submitNewCopies = document.getElementById('add-new-copies');
const overlay = document.createElement("div");

    overlay.id = "modal-overlay";
    document.body.appendChild(overlay);

if(addCopiesBtn){
    addCopiesBtn.addEventListener('click', function(){
    if(addCopiesModal.style.display ==='none'){

        addCopiesModal.style.display = 'block';
        addCopiesModal.classList.add("active");
        overlay.classList.add("active");
        const idBook = submitNewCopies.value;
        submitNewCopies.addEventListener('click', () => addNewCopies(idBook));

    } else{
        addCopiesModal.style.display ='none'
    }}
)}

function addNewCopies(id){
    const value = document.getElementById('add-copies').value;

    fetch('/add-copies', {
        method: 'POST',
        body: JSON.stringify({copy_number: value, id_book: id})
    })
    .then(response => response.json())
    .then(data => {
        if(data){
            window.location.reload();
        }
    })
}

const cancel = document.getElementById('cancel');

cancel.addEventListener(('click'), function(){
    addCopiesModal.style.display = 'none';
    addCopiesModal.classList.remove("active");
    overlay.classList.remove("active");
})


