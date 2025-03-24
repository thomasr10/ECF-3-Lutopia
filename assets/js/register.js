const childSection = document.getElementById('child-section');
const addChild = document.getElementById('add-child');
let count = 2;

// juste pour rajouter les input pour ajouter un enfant

addChild.addEventListener('click', function(){

    addChild.style.display = (count >= 4) ? 'none' : '';
    
    //Création des éléments HTML
    const div = document.createElement('div');
    const label = document.createElement('label');
    const input = document.createElement('input');
    const labelAge = document.createElement('label');
    const inputAge = document.createElement('input');

    //Ajout du contenu dans les éléments
    label.textContent = "Enfant " + count + " ";
    label.setAttribute("for", "child-" + count);
    input.type = "text";
    input.setAttribute("required", true)
    input.minLength = 2;
    input.name = "child-name[]";
    input.id = "child-" + count;
    input.placeholder = "Prénom de l'enfant";

    labelAge.textContent = " Date de naissance ";
    labelAge.setAttribute("for", "birth-" + count);
    inputAge.type = "date";
    inputAge.setAttribute("required", true)
    inputAge.name = "child-birth[]";
    inputAge.id = "birth-" + count;

    //Ajout des éléments en HTML
    childSection.append(div);
    div.append(label);
    div.append(input);
    div.append(labelAge);
    div.append(inputAge);
    count ++;
})