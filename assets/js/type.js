const typeRadio = document.getElementsByName('type');
const getPageAge = document.getElementById('page_age');
const category = document.getElementsByTagName('select');

let containerArticle = document.getElementById('containerArticle');

// console.log(getPageAge.value); debug

let typeId;
let pageAge = getPageAge.value;
let categoryId = 0;
// console.log(typeRadio); debug



function showTypeBook(age, type, categoryId){
    containerArticle.innerHTML = '';
    console.log(age);
    console.log(type);
    console.log(categoryId);
    fetch(`/type/${age}/${type}/${categoryId}`)
    .then(response => response.json())
    .then(data => {
        // console.log(data); debug
        if(data == "Aucun livre trouvé pour se type"){
            let noFound = document.createElement('h2');
            containerArticle.append(noFound);
            noFound.append('Aucun livre trouvé pour se type');
        } else {
            data.forEach(book => {
                let bookArticle = document.createElement('article');
                let title = document.createElement('h2')
                let imgContainer = document.createElement('img');
                let authorContainer = document.createElement('p');
                let illustrator = document.createElement('p');
                let edition = document.createElement('p');



                containerArticle.append(bookArticle);
                imgContainer.setAttribute('src', book.img);
                bookArticle.append(imgContainer);
                bookArticle.append(title);
                bookArticle.append(authorContainer);
                bookArticle.append(illustrator);
                bookArticle.append(edition);
                

                title.append(book.title);
                authorContainer.append("écrit par " + book.author);
                illustrator.append("illustrée par " + book.illustrator);
                edition.append("illustrée par " + book.editor);

                //à enlever c juste pour pas que l'image soit BALEZE
                imgContainer.style.width = 200 + 'px'

                
            });
        }
    })
}

for (let items of category) {
    items.addEventListener("change", (e)=>{
        console.log(items.value);
        categoryId = items.value;
        if(typeId == undefined){
            typeId = 0;
        }
        showTypeBook(pageAge, typeId, categoryId);
    });
}



typeRadio.forEach(element => {
    element.addEventListener("change", (e)=>{
        // console.log(element.id);
        // console.log(typeId);     debug
        // console.log(pageAge);
        typeId = element.id;
        showTypeBook(pageAge, typeId, categoryId);
    });
});


