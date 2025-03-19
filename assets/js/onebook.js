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

buttonReserv.addEventListener('click', () => {
    reservationBook(buttonReserv.value, idArray[0]);
}, {once: true});


selectChild.addEventListener('change', function(event) {
    
    const selectedAge = event.target.value;
    const newSplit = selectedAge.split('-');
    const newAgeArray = newSplit[0];
    const newId = newSplit[1]; 
    
    const newArray = [newAgeArray, ...ageArray.filter(age => age !== newAgeArray)]
    const newIdArray = [newId, ...idArray.filter(age => age !== newId)];

    console.log(newArray);
    console.log(newIdArray);

    showReservation(newIdArray[0]);
    buttonReserv.addEventListener('click', () => {
        reservationBook(buttonReserv.value, newIdArray[0]);
    }, {once: true});
    
});

showReservation(idArray[0]);

function reservationBook(book, id){     //verification reservation 
    fetch(`/${book}/${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data == 'ok'){
            alert('Votre réservation à été prise en compte');
            showReservation(id);
            console.log('reservation ok');
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
                xIcon.setAttribute('src', '../uploads/autres/iconX.svg');
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
        }
    });
}

function removeElementByClass(className){
    let elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function removeReservation(id_reservation, id){
    fetch(`/remove/${id_reservation}`)
    .then(response => response.json())
    .then(data => {  
        showReservation(id);
    });
}