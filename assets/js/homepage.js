const selectChild = document.getElementById('select-child');
let booksContainer = document.getElementById('booksContainer');
const childOption = document.querySelectorAll('.child')
const buttonBorrow = document.querySelectorAll('.button_borrow');
// afficher les nouveautés en fonction de l'age de l'enfant séléctionné

function displayNewBooks(age) {
    let currentAge = age.value;
    let splitAge = currentAge.split('-');
    fetch(`/home-category-age/${splitAge[0]}`)
    .then(response => response.json())
    .then(data => {
        let bookArticle = document.createElement('div');
        bookArticle.className = 'images';
        data.forEach(book => {
            let imgContainer = document.createElement('img');
            imgContainer.className = 'image';
            imgContainer.setAttribute('src', book.img);

            let authorContainer = document.createElement('span');

            bookArticle.append(imgContainer);
            bookArticle.append(authorContainer);
            booksContainer = document.getElementById('bookContainer');
            booksContainer.append(bookArticle);

            //à enlever c juste pour pas que l'image soit BALEZE
            imgContainer.style.width = 200 + 'px'

            
         })
    })
}


if(selectChild !== null){
    
    displayNewBooks(selectChild);
    selectChild.addEventListener('change', function() {
        sectionContainer.innerHTML = "";
        displayNewBooks(selectChild);
    });

    selectChild.addEventListener('change', function(event) {
        const selectedAge = event.target.value;
        const newSplit = selectedAge.split('-');
        const newAgeArray = newSplit[0];
        const newId = newSplit[1]; 
        
        const newArray = [newAgeArray, ...ageArray.filter(age => age !== newAgeArray)]
        const newIdArray = [newId, ...idArray.filter(age => age !== newId)];


        sectionContainer.innerHTML = "";
        sendChildValue(newArray, newIdArray[0]);
    });

    const ageArray = [];
    const idArray = [];

    childOption.forEach(age => {
        let split = age.value.split('-');
        ageArray.push(split[0]);
        idArray.push(split[1]);
    });

    sendChildValue(ageArray, idArray[0]);
    
    document.getElementById('nextButton').addEventListener('click', next);
    document.getElementById('prevButton').addEventListener('click', prev);

}



let index = 0;

function initCarousel() {
    const imagesContainer = document.querySelector('.images');
    imagesContainer.innerHTML = ''; // Réinitialise le conteneur avant d'ajouter de nouvelles images
}

function showImage() {
    const imagesContainer = document.querySelector('.images');
    const totalImages = document.querySelectorAll('.image').length;
    
    // Calcul dynamique de la largeur pour adapter au nombre d'images
    imagesContainer.style.transform = `translateX(${-index * 100 / totalImages}%)`; 
}

function next() {
    const totalImages = document.querySelectorAll('.image').length;
    
    if (index < totalImages - 1) { 
        index++;
        showImage();
    }
}

function prev() {
    if (index > 0) {
        index--;
        showImage();
    }
}













// Debut menu burger-------------------------------------------------------
const menuToggle = document.querySelector('.menu-toggle');
const navbar = document.querySelector('.navbar');
menuToggle.addEventListener("click", () => {
    if (navbar.style.left === "0%") {
      gsap.to(navbar, { left: "-80%", duration: 0.5, scale: 0 }); // Ferme le menu
    } else {
      gsap.to(navbar, {
        left: "0%",
        duration: 0.5,
        scale: 1, // Ouvre le menu avec une échelle de 1
        ease: "back.out", // Effet de rebond
      });
    }
});

// Fin menu burger-------------------------------------------------------
// afficher des propositions de livres





const sectionContainer = document.getElementById('section-connected');

function sendChildValue(array, id){


    fetch('/home-section', {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ages: array}),
    })
    .then(response => response.json())
    .then(arrayObj => {

        let arrayId = [];
        for(let i = 0; i < arrayObj.length; i++){
             arrayId.push(arrayObj[i].id_age);
        }
        uniqueId = Array.from(new Set(arrayId));

        for(let i = 0; i < uniqueId.length; i ++){
            let div = document.createElement('div');
            div.setAttribute('id', `div-${i}`);
            div.classList.add('row-container');
            div.classList.add('booksContainer');
            sectionContainer.append(div);
        }

        const rowContainers = document.querySelectorAll('.row-container');
        const chunks = [];
        const chunkSize = 4;
        for(let i = 0; i < arrayObj.length; i += chunkSize){
            chunks.push(arrayObj.slice(i, i+ chunkSize));
        }
        for(let i = 0; i < chunks.length; i++){
            for(let j = 0; j < chunks[i].length; j++){
                const bookArticle = document.createElement('article');
                bookArticle.classList.add('card');
                rowContainers[i].append(bookArticle);
                const bookImg = document.createElement('img');
                const bookTitle = document.createElement('p');
                bookImg.setAttribute('src', chunks[i][j].img)
                bookTitle.textContent = chunks[i][j].title;
                const descLink = document.createElement('a'); //ajouter le lien
                const borrowLink = document.createElement('button');
                const linkDiv1 = document.createElement('div');
                const linkDiv2 = document.createElement('div');
                descLink.classList.add("button_pink");
                borrowLink.classList.add("button_borrow");
                linkDiv1.append(descLink);
                linkDiv2.append(borrowLink);
                descLink.setAttribute('href', '#');
                borrowLink.setAttribute('type', 'button');
                borrowLink.setAttribute('value', chunks[i][j].id_book);
                
                
                borrowLink.addEventListener("click", () =>{
                         reservationBook(borrowLink.value, id);
                         const valider = document.createElement('p');
                         valider.textContent = 'Réservation prise en compte';
                         bookArticle.append(valider)
                         linkDiv2.innerHTML = "";
                });                                                                    // generer les boutons reserver
                console.log(borrowLink.value)
                descLink.textContent = "Voir la fiche";
                borrowLink.textContent = "Réserver";

                bookArticle.append(bookImg);
                bookArticle.append(bookTitle);
                bookArticle.append(linkDiv1);
                bookArticle.append(linkDiv2);

            }
            
        }
    })
  
    };

    
    function reservationBook(book, id){
        fetch(`/${book}/${id}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data == 'ok'){
                console.log('reservation ok');
            } else {
                console.log('erreur de reservation');
            }
        });
    }


document.addEventListener("DOMContentLoaded", function() {
    gsap.registerPlugin(Flip);
    const containers = document.querySelectorAll('.containerAll');

    containers.forEach(container => {
        // Groupe 1 (ex : container_0)
        const img2 = container.querySelector('.img2');
        const img3 = container.querySelector('.img3');
        const img4 = container.querySelector('.img4');
        const img5 = container.querySelector('.img5');

        if (img2 && img3 && img4 && img5) {
            let hasFlipped1 = false; // Pour éviter de refaire l'animation

            function handleMouseOverGroup1() {
                img3.style.opacity = "1";
                if (!hasFlipped1) {
                    gsap.to(img4, { x: 280, duration: 1.5 });
                    gsap.to(img5, { x: -280, duration: 1.5 });
                }
            }

            function handleMouseOutGroup1() {
                img3.style.opacity = "0";
                if (!hasFlipped1) {
                    gsap.to(img4, { x: 0, duration: 3.5 });
                    gsap.to(img5, { x: 0, duration: 3.5 });
                    hasFlipped1 = true;
                }
            }

            img2.addEventListener("mouseover", handleMouseOverGroup1);
            img2.addEventListener("mouseout", handleMouseOutGroup1);
        }

        // Groupe 2 (ex : container_2)
        const img7 = container.querySelector('.img7');
        const img8 = container.querySelector('.img8');
        const img9 = container.querySelector('.img9');
        const img10 = container.querySelector('.img10');

        if (img7 && img8 && img9 && img10) {
            let hasFlipped2 = false; // Pour éviter de refaire l'animation

            function handleMouseOverGroup2() {
                img8.style.opacity = "1";
                if (!hasFlipped2) {
                    gsap.to(img9, { y: 90, duration: 1.5 });
                    gsap.to(img10, { y: -70, duration: 1.5 });
                }
            }

            function handleMouseOutGroup2() {
                img8.style.opacity = "0";
                if (!hasFlipped2) {
                    gsap.to(img9, { y: 0, duration: 3.5 });
                    gsap.to(img10, { y: 0, duration: 3.5 });
                    hasFlipped2 = true;
                }
            }

            img7.addEventListener("mouseover", handleMouseOverGroup2);
            img7.addEventListener("mouseout", handleMouseOutGroup2);
        }
        // Groupe 3 container_4

        const img12 = container.querySelector('.img12');
        const img13 = container.querySelector('.img13');
        const img14 = container.querySelector('.img14');
        const img15 = container.querySelector('.img15');
        console.log("Groupe 3 éléments :", { img12, img13, img14, img15 });

        if (img12 && img13 && img14 && img15) {
            let hasFlipped3 = false;
        
            function handleMouseOverGroup3() {
                img13.style.opacity = "1";
                if (!hasFlipped3) {
                    gsap.to(img14, { y: -100, duration: 1.5 });
                    gsap.to(img15, { y: 70, duration: 1.5 });
                }
            }
            function handleMouseOutGroup3() {
                img13.style.opacity = "0";
                if (!hasFlipped3) {
                    gsap.to(img14, { y: 0, duration: 3.5 });
                    gsap.to(img15, { y: 0, duration: 3.5 });
                    hasFlipped3 = true;
                }
            }
            img12.addEventListener("mouseover", handleMouseOverGroup3);
            img12.addEventListener("mouseout", handleMouseOutGroup3);
}});
});
