const selectChild = document.getElementById('select-child');
let bookContainer = document.getElementById('book-container');
const childOption = document.querySelectorAll('.child')
const sectionContainer = document.getElementById('section-container');

// afficher les nouveautés en fonction de l'age de l'enfant séléctionné

function displayNewBooks(age) {
    let currentAge = age.value;
    
    fetch(`/home-category-age/${currentAge}`)
    .then(response => response.json())
    .then(data => {
        data.forEach(book => {
            let bookArticle = document.createElement('div');
            bookArticle.className = 'images';

            let imgContainer = document.createElement('img');
            imgContainer.className = 'image';
            imgContainer.setAttribute('src', book.img);

            let authorContainer = document.createElement('span');

            bookArticle.append(imgContainer);
            bookArticle.append(authorContainer);
            bookContainer = document.getElementById('bookContainer');
            bookContainer.append(bookArticle);

            //à enlever c juste pour pas que l'image soit BALEZE
            imgContainer.style.width = 200 + 'px'

            
        });
    })
}

displayNewBooks(selectChild);

selectChild.addEventListener('change', function() {
    bookContainer.innerHTML = "";
    displayNewBooks(selectChild);
});

let index = 0;

function showImage() {
    const images = document.querySelector('.images');
    images.style.transform = `translateX(${-index * 100 / 4}%)`; 
}

function next() {
    const totalImages = document.querySelectorAll('.image').length;
    if (index < totalImages - 1) { 
        index++;
    showImage();
}}

function prev() {
    const totalImages = document.querySelectorAll('.image').length;
    if (index > 0) {
        index--;
    }
    showImage();
}
document.getElementById('nextButton').addEventListener('click', next);
document.getElementById('prevButton').addEventListener('click', prev);



// afficher des propositions de livres



const ageArray = [];
childOption.forEach(age => {
    ageArray.push(age.value);
});




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
                console.log(i)
                console.log(chunks[i][j])
                const bookArticle = document.createElement('article');
                rowContainers[i].append(bookArticle);
                const bookImg = document.createElement('img');
                const bookTitle = document.createElement('p');
                bookImg.setAttribute('src', chunks[i][j].img)
                bookTitle.textContent = chunks[i][j].title;
                const descLink = document.createElement('a'); //ajouter le lien
                const borrowLink = document.createElement('a');
                const linkDiv1 = document.createElement('div');
                const linkDiv2 = document.createElement('div');
                linkDiv1.classList.add("div-link");
                linkDiv2.classList.add("div-link");
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
}

sendChildValue(ageArray);

selectChild.addEventListener('change', function(event) {
    const selectedAge = event.target.value;
    const newArray = [selectedAge, ...ageArray.filter(age => age !== selectedAge)]
    sectionContainer.innerHTML = "";
    sendChildValue(newArray);
});