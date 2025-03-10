const selectChild = document.getElementById('select-child');
let bookContainer = document.getElementById('book-container');
const childOption = document.querySelectorAll('.child')


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
    console.log(bookContainer.innerHTML);
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












// Debut menu burger-------------------------------------------------------
const menuToggle = document.querySelector('.menu-toggle');
const navbar = document.querySelector('.navbar');
console.log(menuToggle);
menuToggle.addEventListener('click', () => {
    alert('ok')
  navbar.classList.toggle('active');
});

// Fin menu burger-------------------------------------------------------