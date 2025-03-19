// Cellules sommaires du tableau
const borrowCell = document.querySelector('.statbook-borrow');
const arrayCells = document.querySelectorAll('.dash-statbook-cellule');

const titleArrayCells = document.querySelectorAll('.title-cell');
const idArrayCells = document.querySelectorAll('.id-cell');
const authorArrayCells = document.querySelectorAll('.author-cell');
const ageArrayCells = document.querySelectorAll('.age-cell');
const typeArrayCells = document.querySelectorAll('.type-cell');
const countArrayCells = document.querySelectorAll('.count-cell');

let countClick = 0;

borrowCell.addEventListener('click', function(){
    if(countClick === 0){

        fetch('/stat-books/borrow-sortZ-A')
        .then(response => response.json())
        .then(data => {
            data.forEach((book, index) => {
                console.log(book)
                titleArrayCells[index].textContent = book.title;
                idArrayCells[index].textContent = book.id_book;
                authorArrayCells[index].textContent = book.author;
                ageArrayCells[index].textContent = book.from + '-' + book.to;
                typeArrayCells[index].textContent = book.type_name;
                countArrayCells[index].textContent = book.count_borrow;
            })

            borrowCell.textContent = 'Emprunts ↑'
            countClick ++;
        })

    } else {
        window.location.reload();
    }
})


// SEARCH BOOK INPUT


const searchInput = document.getElementById('search');
const responseDiv = document.createElement('div');
const formDiv = document.getElementById('form-container');

searchInput.addEventListener('input', function(){
    responseDiv.textContent = "";
    let search = searchInput.value;
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
                listBook.textContent = book.title;
                list.append(listBook);
                formDiv.append(responseDiv);

                listBook.addEventListener('mouseover', function(){
                    listBook.style.cursor = 'pointer';
                })
                listBook.addEventListener('click', function(){
                    responseDiv.textContent = '';
                    searchInput.value = this.textContent;
                })
            })
        })

    }
})


