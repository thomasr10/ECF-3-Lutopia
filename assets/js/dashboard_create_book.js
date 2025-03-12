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

    if(searchIllustrator.length >= 3){
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
                        illustratorId.setAttribute('value', illustrator.id_illustrator);
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


// section catégories

const category = document.getElementById('category');
const category2 = document.getElementById('category-2');
const category3 = document.getElementById('category-3');

const arrayOptions = Array.from(category.options);
const arrayOptions2 = Array.from(category2.options);
const arrayOptions3 = Array.from(category3.options);

if (category.value === "") {
    category2.setAttribute('disabled', true);
    category3.setAttribute('disabled', true);
}

category.addEventListener('change', function () {
    category2.removeAttribute('disabled');
    updateOptions();
});

category2.addEventListener('change', function () {
    category3.removeAttribute('disabled');
    updateOptions();
});

category3.addEventListener('change', function () {
    updateOptions();
});

function updateOptions() {
    let category1Value = category.value;
    let category2Value = category2.value;
    let category3Value = category3.value;

    arrayOptions2.forEach(option => {
        if (option.value === category1Value || option.value === category3Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });

    arrayOptions3.forEach(option => {
        if (option.value === category1Value || option.value === category2Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });

    arrayOptions.forEach(option => {
        if (option.value === category2Value || option.value === category3Value) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });

    if (category2.value === "") {
        category3.setAttribute('disabled', true);
        category3.value = "";
    }
}



// AJOUTER UN AUTEUR/ ILLUSTRATEUR

const addAuthorBtn = document.getElementById('author-btn');
const modal = document.getElementById('modal');
const addForm = document.getElementById('add');
const firstNameInput = document.getElementById('first-name');
const lastNameInput = document.getElementById('last-name');
const submitBtn = document.getElementById('submit-btn');



addAuthorBtn.addEventListener('click', function(event){
    modal.style.display = 'block';
    const modalTitle = document.getElementById('modal-title');
    modalTitle.textContent = 'Ajouter un(e) auteur(ice) !';

    submitBtn.addEventListener('click', function(){
        event.preventDefault();
        let firstName = firstNameInput.value;
        let lastName = lastNameInput.value;

        fetch('/dashboard/add-author', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({"first-name": firstName, "last-name": lastName})
        })
        .then(response => response.json())
        .then(data => {
            if(data){
                modal.style.display = 'none';
            }
        })
    })
})



