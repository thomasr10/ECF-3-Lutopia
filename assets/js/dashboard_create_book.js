const authorInput = document.getElementById('author'); 
const illustratorInput = document.getElementById('illustrator');
const authorSection = document.getElementById('author-section'); // div de l'input author
const illustratorSection = document.getElementById('illustrator-section'); // div de l'input illustrator
const responseDiv = document.createElement('div'); // div des réponses

// SECTION AUTEUR

authorInput.addEventListener('input', function(){

    responseDiv.textContent = "";
    const search = authorInput.value;

    if(search.length >= 3){
        fetch('/dashboard-search-author', {
            method: "POST",
            body: JSON.stringify(search),
        })
        .then(response => response.json())
        .then(data => {
            const list = document.createElement('ul');
            responseDiv.append(list);
            if(data.length > 0){
                data.forEach(author => {
                    const listAuthor = document.createElement('li');
                    listAuthor.textContent = author.first_name + ' ' + author.last_name;
                    list.append(listAuthor);
                    authorSection.append(responseDiv);
                    // cursor pointer au hover || LES FRONT VOUS POURREZ METTRE LE CURSOR POINTER DANS UNE CLASS QD VOUS FERE LE STYLE
                    listAuthor.addEventListener('mouseover', function(){
                        this.style.cursor = "pointer";
                    })

                    listAuthor.addEventListener('click', function(){
                        authorInput.value = this.textContent;
                        const authorId = document.createElement('input');
                        authorId.type = 'hidden';
                        authorId.setAttribute('value', author.id_author);
                        authorId.setAttribute('name', 'id_author');
                        authorSection.append(authorId); // récupère l'id author pour le futur insert
                        responseDiv.textContent = "";
                    })
                    
                })
            } else {
                responseDiv.textContent = "Auteur introuvable";
                authorSection.append(responseDiv);
            }
            
        })
    }
})


// SECTION ILLUSTRATEUR

illustratorInput.addEventListener('input', function(){
    responseDiv.textContent = "";
    const searchIllustrator = illustratorInput.value;

    if(searchIllustrator.length >= 3){
        fetch('/dashboard-search-illustrator', {
            method: 'POST',
            body: JSON.stringify(searchIllustrator),            
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const list = document.createElement('ul');
            responseDiv.append(list);

            if(data.length > 0){
                data.forEach(illustrator => {
                    const listIllustrator = document.createElement('li');
                    list.append(listIllustrator);
                    listIllustrator.textContent = illustrator.first_name + ' ' + illustrator.last_name;
                    illustratorSection.append(responseDiv);
                    
                    listIllustrator.addEventListener('mouseover', function(){
                        listIllustrator.style.cursor = 'pointer';
                    })

                    listIllustrator.addEventListener('click', function(){
                        illustratorInput.value = this.textContent;
                        const illustratorId = document.createElement('input');
                        illustratorSection.append(illustratorId)
                        illustratorId.setAttribute('value', illustrator.id_illustrator);
                        illustratorId.setAttribute('name', 'id_illustrator');
                        illustratorId.type = 'hidden';
                        responseDiv.textContent = "";
                    })
                })
            } else {
                responseDiv.textContent = "Illustrateur introuvable";
                illustratorSection.append(responseDiv);
            }
        })
    }
})


// section catégories

// récupérer les 3 select
const category = document.getElementById('category'); 
const category2 = document.getElementById('category-2');
const category3 = document.getElementById('category-3');

// création d'un tableau avec les options du select
const arrayOptions = Array.from(category.options);
const arrayOptions2 = Array.from(category2.options);
const arrayOptions3 = Array.from(category3.options);

// rendre disabled les select 2 et 3 quand le 1 n'est pas utilisé
if (category.value === "") {
    category2.setAttribute('disabled', true);
    category3.setAttribute('disabled', true);
}

// rendre utilisable le select 2 quand une catégorie est choisie dans le 1er select
category.addEventListener('change', function () {
    category2.removeAttribute('disabled');
    updateOptions();
});

// pareil avec le 3eme
category2.addEventListener('change', function () {
    category3.removeAttribute('disabled');
    updateOptions();
});

category3.addEventListener('change', function () {
    updateOptions();
});

function updateOptions() {
    //récupérer la valeur de chaque select
    let category1Value = category.value;
    let category2Value = category2.value;
    let category3Value = category3.value;

    // rendre disabled les option qui sont séléctionnées dans les autres select
    arrayOptions2.forEach(option => {
        if (option.value === category1Value || option.value === category3Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });

    // rendre disabled les option qui sont séléctionnées dans les autres select
    arrayOptions3.forEach(option => {
        if (option.value === category1Value || option.value === category2Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });

    // rendre disabled les option qui sont séléctionnées dans les autres select
    arrayOptions.forEach(option => {
        if (option.value === category2Value || option.value === category3Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });
    
    // Vide le select 3 + le rend disabled si la valeur du select 2 est vide #malin
    if (category2.value === "") {
        category3.setAttribute('disabled', true);
        category3.value = "";
    }
}



// POUR LE FRONT : Il y a la class modal dans le scss à modifier/ il faudrait ajouter une petite croix pour pouvoir fermer le modal


// AJOUTER UN AUTEUR

const openModalAuthor = document.getElementById('author-btn'); // button "Ajouter un auteur"
const modalAuthor = document.getElementById('modal-author'); // modal contenant le form

// champs du form + input submit 
const authorFirstNameInput = document.getElementById('author-first-name'); 
const authorLastNameInput = document.getElementById('author-last-name');
const addAuthorInput = document.getElementById('add-author');



openModalAuthor.addEventListener('click', function(){ //Ouvrir le modal contenant le form
    modalAuthor.style.display = 'block';
    addAuthorInput.addEventListener('click', addAuthor);
})


function addAuthor(event){
    event.preventDefault() // évite le rechargement de page
    let firstName = authorFirstNameInput.value.trim(); // récupérer le prénom et nom
    let lastName = authorLastNameInput.value.trim();

    fetch('/dashboard/add-author', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({"first-name": firstName, "last-name": lastName}) // envoie des données au controller
    })
    .then(response => response.json())
    .then(data => {
        if(data){ // Vider les input + cacher le modal si insertion réussie
            authorFirstNameInput.value = "";
            authorLastNameInput.value = "";
            modalAuthor.style.display = 'none';
        } else {
            // Affiche un message d'erreur en cas de probleme à l'insertion. (le code est parfait c'est pas nécessaire mais bon)
            const messageContainer = document.createElement('p');
            const errorMessage = "Problème survenu lors de l'ajout de l'auteur(ice).";
            messageContainer.append(errorMessage);
            modalAuthor.style.display = "block";
            modalAuthor.append(messageContainer)
        }
    })
}



// AJOUTER UN ILLUSTRATEUR => MEME FONCTIONNEMENT QUE POUR L'AUTEUR ;)

const openIllustratorModal = document.getElementById('illustrator-btn');
const modalIllustrator = document.getElementById('modal-illustrator');

const illustratorFirstNameInput = document.getElementById('illustrator-first-name');
const illustratorLastNameInput = document.getElementById('illustrator-last-name');
const addIllustratorInput = document.getElementById('add-illustrator');


openIllustratorModal.addEventListener('click', function(){
    modalIllustrator.style.display = 'block';
    addIllustratorInput.addEventListener('click', addIllustrator);
});


function addIllustrator(event){
    let firstName = illustratorFirstNameInput.value.trim();
    let lastName = illustratorLastNameInput.value.trim();

    event.preventDefault();

    fetch('/dashboard/add-illustrator', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({"first-name": firstName, "last-name": lastName})
    })
    .then(response => response.json())
    .then(data => {
        if(data){
            illustratorFirstNameInput.value = "";
            illustratorLastNameInput.value = "";
            modalIllustrator.style.display = 'none';
        } else {
            const messageContainer = document.createElement('p');
            const errorMessage = "Problème survenu lors de l'ajout de l'illustrateur(ice).";
            messageContainer.append(errorMessage);
            modalIllustrator.style.display = "block";
            modalIllustrator.append(messageContainer)
        }
    })
}













































































// DEBUT MODAL BOOK ILLUSTRATOR
const modalBook = document.getElementById('modal-illustrator');
if (modalBook) {
    document.addEventListener("DOMContentLoaded", () => {
    //modifier l'id en fonction du besoin modalModel- what you want
    const modal = document.getElementById("modal-illustrator");
    const overlay = document.createElement("div");
    overlay.id = "modal-overlay";
    document.body.appendChild(overlay);
    // mettre un Id modify-input au button que l'on doit cliquer pour faire apparaitre l'overlay
    const openModalBtn = document.getElementById("illustrator-btn");

//modalModel
const modalBook = document.getElementById('modal-author')

if (modalBook) {
    document.addEventListener("DOMContentLoaded", () => {
    //modifier l'id en fonction du besoin modalModel- what you want
    const modal = document.getElementById('modal-author');
    const overlay = document.getElementById("modal-overlay");
    overlay.id = "modal-overlay";
    document.body.appendChild(overlay);
    // mettre un Id modify-input au button que l'on doit cliquer pour faire apparaitre l'overlay
    const openModalBtn = document.getElementById("author-btn");

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

// FIN MODAL BOOK ILLUSTRATOR

