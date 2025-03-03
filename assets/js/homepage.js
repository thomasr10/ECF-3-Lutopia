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
            let imgContainer = document.createElement('img');
            let authorContainer = document.createElement('span');



            bookContainer.append(bookArticle);
            imgContainer.setAttribute('src', book.img);
            bookArticle.append(imgContainer);
            authorContainer.append(book.author);
            bookContainer.append(authorContainer);

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
