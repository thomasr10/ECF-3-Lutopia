const form = document.getElementById('form');
const authorInput = document.getElementById('author');
const illustratorInput = document.getElementById('illustrator');

authorInput.addEventListener('input', function(){
    if(authorInput.value.length >= 4){

        const formData = new FormData(form);
        fetch('/dashboard-search-author', {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
        })
    }
})
