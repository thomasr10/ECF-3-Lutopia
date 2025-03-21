const deleteChildBtnArray = document.querySelectorAll('.delete-child-btn');
const deleteChildModal = document.getElementById('delete-child-modal');
const confirmDeleteBtn = document.getElementById('confirm-delete-child');


// DELETE CHIL

deleteChildBtnArray.forEach(btn => {
    btn.addEventListener('click', function(){
        deleteChildModal.style.display = 'block';
        confirmDeleteBtn.addEventListener('click', () => deleteChild(btn.value))
    })
})

function deleteChild(idChild){
    fetch('/delete-child', {
        method: 'POST',
        body: JSON.stringify(idChild)
    })
    .then(response => response.json())
    .then(data => {
        if(data){
            window.location.reload();
        }
    })
}


// ADD CHILD

const addChildBtn = document.getElementById('add-child-btn');
const newChildDiv = document.getElementById('add-child');

addChildBtn.addEventListener('click', function(){

    addChildBtn.style.display = 'none';

    // label nom
    const nameLabel = document.createElement('label');
    nameLabel.textContent = 'Prénom de l\'enfant';
    nameLabel.setAttribute('for', 'new-child-name');

    // input nom
    const inputName = document.createElement('input');
    inputName.setAttribute('name', 'new-child-name');
    inputName.setAttribute('id', 'new-child-name');
    inputName.type = 'text';
    inputName.setAttribute('required', true);

    // label date
    const dateLabel = document.createElement('label');
    dateLabel.textContent = 'Date de naissance'
    dateLabel.setAttribute('for', 'new-child-date');

    // input date
    const inputDate = document.createElement('input');
    inputDate.setAttribute('name', 'new-child-date');
    inputDate.setAttribute('id', 'new-child-date');
    inputDate.type = 'date';
    inputDate.setAttribute('required', true);

    newChildDiv.append(nameLabel)
    newChildDiv.append(inputName)
    newChildDiv.append(dateLabel);
    newChildDiv.append(inputDate);
})