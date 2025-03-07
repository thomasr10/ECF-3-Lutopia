const authorInput = document.getElementById('author'); 
const illustratorInput = document.getElementById('illustrator');
const authorSection = document.getElementById('author-section'); // div de l'input author
const illustratorSection = document.getElementById('illustrator-section'); // div de l'input illustrator
const responseDiv = document.createElement('div'); // div des réponses

// SECTION AUTEUR

authorInput.addEventListener('input', function(){

    responseDiv.textContent = "";
    const search = authorInput.value;

    if(search.length >= 3){
        fetch('/dashboard-search-author', {
            method: "POST",
            body: JSON.stringify(search),
        })
        .then(response => response.json())
        .then(data => {
            const list = document.createElement('ul');
            responseDiv.append(list);
            if(data.length > 0){
                data.forEach(author => {
                    const listAuthor = document.createElement('li');
                    listAuthor.textContent = author.first_name + ' ' + author.last_name;
                    list.append(listAuthor);
                    authorSection.append(responseDiv);
                    // cursor pointer au hover || LES FRONT VOUS POURREZ METTRE LE CURSOR POINTER DANS UNE CLASS QD VOUS FERE LE STYLE
                    listAuthor.addEventListener('mouseover', function(){
                        this.style.cursor = "pointer";
                    })

                    listAuthor.addEventListener('click', function(){
                        authorInput.value = this.textContent;
                        const authorId = document.createElement('input');
                        authorId.type = 'hidden';
                        authorId.setAttribute('value', author.id_author);
                        authorId.setAttribute('name', 'id_author');
                        authorSection.append(authorId); // récupère l'id author pour le futur insert
                        responseDiv.textContent = "";
                    })
                    
                })
            } else {
                responseDiv.textContent = "Auteur introuvable";
                authorSection.append(responseDiv);
            }
            
        })
    }
})


// SECTION ILLUSTRATEUR

illustratorInput.addEventListener('input', function(){
    responseDiv.textContent = "";
    const searchIllustrator = illustratorInput.value;

    if(searchIllustrator.length > 3){
        fetch('/dashboard-search-illustrator', {
            method: 'POST',
            body: JSON.stringify(searchIllustrator),            
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const list = document.createElement('ul');
            responseDiv.append(list);

            if(data.length > 0){
                data.forEach(illustrator => {
                    const listIllustrator = document.createElement('li');
                    list.append(listIllustrator);
                    listIllustrator.textContent = illustrator.first_name + ' ' + illustrator.last_name;
                    illustratorSection.append(responseDiv);
                    
                    listIllustrator.addEventListener('mouseover', function(){
                        listIllustrator.style.cursor = 'pointer';
                    })

                    listIllustrator.addEventListener('click', function(){
                        illustratorInput.value = this.textContent;
                        const illustratorId = document.createElement('input');
                        illustratorSection.append(illustratorId)
                        illustratorId.setAttribute('id', illustrator.id_illustrator);
                        illustratorId.setAttribute('name', 'id_illustrator');
                        illustratorId.type = 'hidden';
                        responseDiv.textContent = "";
                    })
                })
            } else {
                responseDiv.textContent = "Illustrateur introuvable";
                illustratorSection.append(responseDiv);
            }
        })
    }
})
