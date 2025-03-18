const searchBar = document.getElementById('query');
const searchContainer = document.getElementById('search-container');
const responseDiv = document.createElement('div');

searchBar.addEventListener('input', function(){
    const search = searchBar.value;
    responseDiv.textContent = "";
    if(search.length >= 3){
        fetch('/search-book', {
            method: "POST",
            body: JSON.stringify(search),
        })
        .then(response => response.json())
        .then(data => {
            const list = document.createElement('ul');
            data.forEach(book => {
                console.log(book)
                const listBook = document.createElement('li');
                const linkBook = document.createElement('a');
                linkBook.setAttribute('href', '/book/' + book.id_book);
                listBook.append(linkBook);

                linkBook.textContent = book.title + ', par ' + book.author ;
                list.append(listBook);
                responseDiv.append(list);
                searchContainer.append(responseDiv);
            })
            
        })
    }
})