const selectChild = document.getElementById('select-child');
const firstSelectedAge = selectChild.value;
console.log(firstSelectedAge);

//fetch

selectChild.addEventListener('change', function(){
    
    const currentAge = selectChild.value;
    console.log(currentAge)
    fetch('lutopia/home-age-category' + currentAge, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data)
    console.log(data)

})