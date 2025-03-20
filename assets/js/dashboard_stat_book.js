// Cellules sommaires du tableau
const borrowCell = document.querySelector('.statbook-borrow');
const arrayCells = document.querySelectorAll('.dash-statbook-cellule');
const subTitle = document.getElementById('sub-title');

const titleArrayCells = document.querySelectorAll('.title-cell');
const idArrayCells = document.querySelectorAll('.id-cell');
const authorArrayCells = document.querySelectorAll('.author-cell');
const ageArrayCells = document.querySelectorAll('.age-cell');
const typeArrayCells = document.querySelectorAll('.type-cell');
const countArrayCells = document.querySelectorAll('.count-cell');

const selectYear = document.getElementById('year');
// pour que requete order by asc si 0 et desc si 1
let countClick = 0;

// pour éviter d'avoir l event quand recherche par titre
if(borrowCell){

    borrowCell.addEventListener('click', function(){
        if(selectYear.value == 0){
            if(countClick === 0){

                fetch('/stat-books/borrow-sortZ-A')
                .then(response => response.json())
                .then(data => {
                    data.forEach((book, index) => {
                        
                        titleArrayCells[index].textContent = book.title;
                        idArrayCells[index].textContent = book.id_book;
                        authorArrayCells[index].textContent = book.author;
                        ageArrayCells[index].textContent = book.from + '-' + book.to;
                        typeArrayCells[index].textContent = book.type_name;
                        countArrayCells[index].textContent = book.count_borrow;
                    })
    
                    borrowCell.textContent = 'Emprunts ↑'
                    subTitle. textContent = 'Les 20 livres les moins empruntés'
                    countClick ++;
                })
    
            } else{
                window.location.reload();
            }
        } else {
            alert('f')
        }
    })   
}



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


// SELECT


selectYear.addEventListener('change', function(){
    const value = selectYear.value;
    // pour réinitialiser la valeur à chaque changement 
    countClick = 0;

    if(value == 0){
        // reset pour avoir toute les années
        window.location.reload();
    } else {
        
        fetch('/stat-book-top/select-year', {
            method:'POST',
            body: JSON.stringify(value)
        })
        .then(response => response.json())
        .then(data => {
            if(data.length > 0){
                data.forEach((book, index) => {
                    
                    titleArrayCells[index].textContent = book.title;
                    idArrayCells[index].textContent = book.id_book;
                    authorArrayCells[index].textContent = book.author;
                    ageArrayCells[index].textContent = book.from + '-' + book.to;
                    typeArrayCells[index].textContent = book.type_name;
                    countArrayCells[index].textContent = book.count_borrow;
                })       
            } else if (data.push('Aucun livre trouvé')){
                data.forEach((message, index) => {
                    arrayCells.forEach(cell => {
                        cell.textContent = '';
                    })
                    titleArrayCells[index] . textContent = message
                })
            }    
        })
    }
})