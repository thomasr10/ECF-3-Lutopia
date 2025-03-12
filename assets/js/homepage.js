const selectChild = document.getElementById('select-child');
let booksContainer = document.getElementById('booksContainer');
const childOption = document.querySelectorAll('.child')
// afficher les nouveautés en fonction de l'age de l'enfant séléctionné

function displayNewBooks(age) {
    let currentAge = age.value;

    fetch(`/home-category-age/${currentAge}`)
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
/*if(selectChild !== null){
    
    displayNewBooks(selectChild);
    selectChild.addEventListener('change', function() {
        sectionContainer.innerHTML = "";
        displayNewBooks(selectChild);
    });

}*/


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

/*document.getElementById('nextButton').addEventListener('click', next);
document.getElementById('prevButton').addEventListener('click', prev);*/












// Debut menu burger-------------------------------------------------------
const menuToggle = document.querySelector('.menu-toggle');
const navbar = document.querySelector('.navbar');
const nav = document.querySelector('.nav');

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
// console.log(navbar);
// menuToggle.addEventListener('click', () => {
//   navbar.classList.toggle('active');
// });

// Fin menu burger-------------------------------------------------------
// afficher des propositions de livres



const ageArray = [];
childOption.forEach(age => {
    ageArray.push(age.value);
});



const sectionContainer = document.getElementById('section-connected');

function sendChildValue(array){

    console.log(array)
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
                const borrowLink = document.createElement('a');
                const linkDiv1 = document.createElement('div');
                const linkDiv2 = document.createElement('div');
                descLink.classList.add("button_pink");
                borrowLink.classList.add("button_borrow");
                linkDiv1.append(descLink);
                linkDiv2.append(borrowLink);
                descLink.setAttribute('href', '#');
                borrowLink.setAttribute('href', '#');
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


sendChildValue(ageArray);

/*selectChild.addEventListener('change', function(event) {
    const selectedAge = event.target.value;
    const newArray = [selectedAge, ...ageArray.filter(age => age !== selectedAge)]
    sectionContainer.innerHTML = "";
    sendChildValue(newArray);
});*/

//Animations Cube"


document.addEventListener("DOMContentLoaded", function() {
    gsap.registerPlugin(Flip);

    const img2 = document.getElementsByClassName('img2')[0];
    const img3 = document.getElementsByClassName('img3')[0];
    const img4 = document.getElementsByClassName('img4')[0];
    const img5 = document.getElementsByClassName('img5')[0];
    const img6 = document.getElementsByClassName('img6')[0];
    const img7 = document.getElementsByClassName('img7')[0];
    const img8 = document.getElementsByClassName('img8')[0];
    const img9 = document.getElementsByClassName('img9')[0];
    const img10 = document.getElementsByClassName('img10')[0];

    let hasFlipped1 = false; // Booléen pour le premier groupe (1-5)
    let hasFlipped2 = false; // Booléen pour le deuxième groupe (6-10)

    function handleMouseOverGroup1() {
        img3.style.opacity = "1";
        if (!hasFlipped1) {
            swapImagesGroup1();  // Exécute Flip une seule fois pour le groupe 1
        }
    }

    function handleMouseOutGroup1() {
        img3.style.opacity = "0";
        if (!hasFlipped1) {
            resetImagesGroup1();  // Remet les images à leur place pour le groupe 1
            hasFlipped1 = true;   // Désactive Flip pour le groupe 1
        }
    }

    function handleMouseOverGroup2() {
        img8.style.opacity = "1";
        if (!hasFlipped2) {
            swapImagesGroup2();  // Exécute Flip une seule fois pour le groupe 2
        }
    }

    function handleMouseOutGroup2() {
        img8.style.opacity = "0";
        if (!hasFlipped2) {
            resetImagesGroup2();  // Remet les images à leur place pour le groupe 2
            hasFlipped2 = true;   // Désactive Flip pour le groupe 2
        }
    }

    // Animations pour le premier groupe (img4 et img5)
    function swapImagesGroup1() {
        gsap.to(img4, { x: 280, duration: 1.5 });
        gsap.to(img5, { x: -280, duration: 1.5 });
    }

    function resetImagesGroup1() {
        gsap.to(img4, { x: 0, duration: 3.5 });
        gsap.to(img5, { x: 0, duration: 3.5 });
    }

    // Animations pour le deuxième groupe (img9 et img10)
    function swapImagesGroup2() {
        gsap.to(img9, { y: 90, duration: 1.5 });
        gsap.to(img10, { y: -70, duration: 1.5 });
    }

    function resetImagesGroup2() {
        gsap.to(img9, { y: 0, duration: 3.5 });
        gsap.to(img10, { y: 0, duration: 3.5 });
    }

    img2.addEventListener("mouseover", handleMouseOverGroup1);
    img2.addEventListener("mouseout", handleMouseOutGroup1);
    img7.addEventListener("mouseover", handleMouseOverGroup2);
    img7.addEventListener("mouseout", handleMouseOutGroup2);
});