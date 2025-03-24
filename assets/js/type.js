const typeRadio = document.getElementsByName('type');
const getPageAge = document.getElementById('page_age');
const category = document.getElementsByName('category');
const card = document.getElementsByClassName('card');

let containerArticle = document.getElementById('containerArticle');

//reservation 

const buttonBorrowSelect  = document.querySelectorAll('.button_borrow');
const selectChild = document.getElementById('select-child');
const childOption = document.querySelectorAll('.child');
const buttonReserv = document.querySelector('.onebook-reserver');
const ageArray = [];
const idArray = [];

childOption.forEach(age => {
    let split = age.value.split('-');
    ageArray.push(split[0]);
    idArray.push(split[1]);
});


buttonBorrowSelect.forEach(element => {
    element.addEventListener('click', function listener1(){
            reservationBook(element.value, idArray[0]);
    });
});



showReservation(idArray[0]);

function reservationBook(book, id){     //verification reservation 
    fetch(`/${book}/${id}`)
    .then(response => response.json())
    .then(data => {
        if(data == 'ok'){
            alert('Votre réservation à été prise en compte');
            showReservation(id);
        } else if(data == 'max'){
            alert('Vous avez atteint la limite de 3 réservations');
        } else if(data == 'already'){
            alert('Vous avez déjà réservé cet ouvrage');
        } else {
            console.log('erreur de reservation');
        }
    });
}


function showReservation(id){
    const resBox = document.querySelector('.reservation');
    removeElementByClass('padding-element2');       //suppression de l'affichage de chaque reservation en fonction de l'enfant choisi
    fetch(`/${id}`)
    .then(response => response.json())
    .then(data => { 
        if(data == "Aucune réservation"){
            console.log("Aucune réservation")
        } else {
            data.forEach(element => {   //création de chaque carte réservation avec l'arborescence css



                const divPadding = document.createElement('div');
                const divMiniBook = document.createElement('div');
                const divMiniBookTitle = document.createElement('div');
                const imgMiniBook = document.createElement('img');

                const alink = document.createElement('a');
                const aButton = document.createElement('a');
                const xIcon = document.createElement('img');

                divPadding.setAttribute("class", "padding-element2");
                divMiniBook.setAttribute("class", "mini-book");
                divMiniBookTitle.setAttribute("class", "mini-book-title");
                imgMiniBook.setAttribute("class", "mini-book-img");
                imgMiniBook.setAttribute("src", element.img_src);
                imgMiniBook.setAttribute("alt", "miniature du livre");


                alink.innerHTML = element.title;
                xIcon.setAttribute('id', 'close-button');
                xIcon.setAttribute('src', '../../uploads/autres/iconX.svg');
                xIcon.setAttribute('class', 'close-x-icon');
                xIcon.setAttribute('alt', 'icone fermeture');
                xIcon.setAttribute('value', element.id_reservation);

                xIcon.addEventListener("click", () =>{  
                    removeReservation(element.id_reservation, id);
                });

                
                resBox.append(divPadding);       
                divPadding.append(divMiniBook);
                divMiniBook.append(imgMiniBook);
                divMiniBook.append(divMiniBookTitle);
                divMiniBookTitle.append(alink);
                divMiniBookTitle.append(aButton);
                aButton.append(xIcon);
            });
            
            const aBack = document.createElement('a'); // a link pour le retour a la homepage
            aBack.setAttribute("href", "/");
            aBack.innerHTML = "Changer d'enfant";

            resBox.append(aBack); 

        }
    });
}

function removeElementByClass(className){       //class qui permet de boucler boucler et supprimer chaque element ayant un classname donner
    let elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function removeReservation(id_reservation, id){     //suppresion d'une réservation avec la croix dans l'affichage puis rechargement des réservations
    fetch(`/remove/${id_reservation}`)
    .then(response => response.json())
    .then(data => {  
        showReservation(id);
    });
}



let typeId;
let pageAge = getPageAge.value;
let categoryId = 0;



function showTypeBook(age, type, categoryId){   //fonction qui affiche les livres en fonction du type de livre, de la categorie, et de l'age
    containerArticle.innerHTML = '';   //vider le container à chaque appel de fonction pour pouvoir l'afficher en fonction des filtres 
    fetch(`/type/${age}/${type}/${categoryId}`) //fetch de la route avec toute les variables
    .then(response => response.json())
    .then(data => {
        if(data == "Aucun livre trouvé pour se type"){  //condition pour le renvoie du json encode si aucun livre ne correspond au filtre
            let noFound = document.createElement('h2');
            containerArticle.append(noFound);
            noFound.append('Aucun livre trouvé pour se type');
        } else {      // sinon affichage puis creation des elements pour chaque livre qui match ses filtres
            data.forEach(book => {
                let bookArticle = document.createElement('article');
                let title = document.createElement('p')
                let imgContainer = document.createElement('img');
                let authorContainer = document.createElement('p');
                let illustrator = document.createElement('p');
                let edition = document.createElement('p');
                let buttonPink = document.createElement("button");
                let buttonBorrow = document.createElement("button");





                containerArticle.append(bookArticle);                
                imgContainer.setAttribute('src', book.img);
                bookArticle.append(imgContainer);
                bookArticle.append(title);
                bookArticle.classList.add('card');
                bookArticle.append(buttonPink);
                buttonPink.classList.add("button_pink");
                buttonPink.addEventListener('click', (e) => {   
                    document.location.href = "/book/" + book.id_book;   //add event listener pour la redirection vers chaque page de livre
                });
                buttonPink.setAttribute("value", book.id_book);
                buttonPink.textContent = "Voir la fiche";
                bookArticle.append(buttonBorrow);
                buttonBorrow.classList.add("button_borrow");
                buttonBorrow.setAttribute("value", book.id_book);
                buttonBorrow.textContent = "Réserver";

                title.append(book.title);
                authorContainer.append("écrit par " + book.author);
                illustrator.append("illustrée par " + book.illustrator);
                edition.append("illustrée par " + book.editor);

                buttonBorrow.addEventListener('click', function listener1(){
                    reservationBook(buttonBorrow.value, idArray[0]);    //add event listener pour réserver un livre par rapport à l'enfant selectionner
                });



                
            });
        }
       
    })
}

for (let items of category) {       //appel de la fonction type book à chaque changement dans le select category
    items.addEventListener("change", (e)=>{
        categoryId = items.value;
        if(typeId == undefined){    //reglage d'un problème sur le fetch pour une category par défaut
            typeId = 0;
        }
        showTypeBook(pageAge, typeId, categoryId);  
    });
}



typeRadio.forEach(element => {  //appel de la fonction type book à chaque changement dans le input radio type
    element.addEventListener("change", (e)=>{
        typeId = element.id;
        showTypeBook(pageAge, typeId, categoryId);
    });
});


