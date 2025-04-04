const searchInput = document.getElementById('title');
const searchForm = document.getElementById('search-form');
const responseDiv = document.createElement('div');
responseDiv.id = 'listBook';
const bookDatas = document.getElementById('book-datas'); // pour mettre l'input caché avec l'id du livre récupéré en grâce au fetch
searchForm.append(responseDiv);


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



// MODIFIER LIVRE

const modalBook = document.getElementById('modal-modify-book');
const modifyInput = document.getElementById('modify-input');
if(modifyInput){
modifyInput.addEventListener('click', function(){

    modalBook.style.display = 'block';
  
})}

//Close Button

const cancel = document.getElementById('cancel');
if(cancel){
cancel.addEventListener('click', function(){
    modalBook.style.display = 'none';
})}

//modalModel

if (modalBook) {
    document.addEventListener("DOMContentLoaded", () => {
    //modifier l'id en fonction du besoin modalModel- what you want
    const modal = document.getElementById("modal-modify-book");
    const overlay = document.createElement("div");
    overlay.id = "modal-overlay";
    document.body.appendChild(overlay);
    // mettre un Id modify-input au button que l'on doit cliquer pour faire apparaitre l'overlay
    const openModalBtn = document.getElementById("modify-input");
    const closeModalBtn = document.getElementById("cancel");

    // Ouvrir le modal
    openModalBtn.addEventListener("click", () => {
        modal.classList.add("active");
        overlay.classList.add("active");
    });

    // Fermer le modal
    const closeModal = () => {
        modal.classList.remove("active");
        overlay.classList.remove("active");
    };

    closeModalBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
})};
//..............................................................
