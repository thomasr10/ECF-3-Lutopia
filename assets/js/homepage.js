const selectChild = document.getElementById('select-child');
let booksContainer = document.getElementById('booksContainer');
const childOption = document.querySelectorAll('.child')
const buttonBorrow = document.querySelectorAll('.button_borrow');
const sliderContainer = document.getElementById('bookContainer');



// afficher les nouveautés en fonction de l'age de l'enfant séléctionné

function displayNewBooks(age) {
    let currentAge = age.value;
    let splitAge = currentAge.split('-');
    fetch(`/home-category-age/${splitAge[0]}`)
    .then(response => response.json())
    .then(data => {
        let bookArticle = document.createElement('div');
        bookArticle.className = 'images';
        data.forEach(book => {
            let imgContainer = document.createElement('img');
            imgContainer.className = 'image';
            imgContainer.setAttribute('src', book.img);

            let authorContainer = document.createElement('span');

            bookArticle.append(imgContainer);
            bookArticle.append(authorContainer);
            booksContainer = document.getElementById('bookContainer');
            booksContainer.append(bookArticle);

            //à enlever c juste pour pas que l'image soit BALEZE
            imgContainer.style.width = 200 + 'px'

            
         })
    })
}


if(selectChild !== null){
    
    displayNewBooks(selectChild);
    selectChild.addEventListener('change', function() {
        sectionContainer.innerHTML = "";
        booksContainer.innerHTML = "";
        displayNewBooks(selectChild);
    });

    selectChild.addEventListener('change', function(event) {
        const selectedAge = event.target.value;
        const newSplit = selectedAge.split('-');
        const newAgeArray = newSplit[0];
        const newId = newSplit[1]; 
        
        const newArray = [newAgeArray, ...ageArray.filter(age => age !== newAgeArray)]
        const newIdArray = [newId, ...idArray.filter(age => age !== newId)];


        sectionContainer.innerHTML = "";
        showReservation(newIdArray[0]);
        sendChildValue(newArray, newIdArray[0]);
    });

    const ageArray = [];
    const idArray = [];

    childOption.forEach(age => {
        let split = age.value.split('-');
        ageArray.push(split[0]);
        idArray.push(split[1]);
    });
    showReservation(idArray[0]);

    sendChildValue(ageArray, idArray[0]);
    
    document.getElementById('nextButton').addEventListener('click', next);
    document.getElementById('prevButton').addEventListener('click', prev);

}





let index = 0;

function initCarousel() {
    const imagesContainer = document.querySelector('.images');
    imagesContainer.innerHTML = ''; // Réinitialise le conteneur avant d'ajouter de nouvelles images
}

function showImage() {
    const imagesContainer = document.querySelector('.images');
    const totalImages = document.querySelectorAll('.image').length;
    
    // Calcul dynamique de la largeur pour adapter au nombre d'images
    imagesContainer.style.transform = `translateX(${-index * 100 / totalImages}%)`; 
}

function next() {
    const totalImages = document.querySelectorAll('.image').length;
    
    if (index < totalImages - 1) { 
        index++;
        showImage();
    }
}

function prev() {
    if (index > 0) {
        index--;
        showImage();
    }
}













// Debut menu burger-------------------------------------------------------
// const menuToggle = document.querySelector('.menu-toggle');
// const navbar = document.querySelector('.navbar');

// menuToggle.addEventListener("click", () => {
//     if (navbar.style.left === "0%") {
//       gsap.to(navbar, { left: "-80%", duration: 0.5, scale: 1 }); // Ferme le menu
    
//     } else {
//       gsap.to(navbar, {
//         left: "0%",
//         duration: 0.5,
//         scale: 1, // Ouvre le menu avec une échelle de 1
//         ease: "back.out", // Effet de rebond
//       });
    
//     }
// });

// Fin menu burger-------------------------------------------------------
// afficher des propositions de livres





const sectionContainer = document.getElementById('section-connected');

function sendChildValue(array, id){
    fetch('/home-section', {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ages: array}),
    })
    .then(response => response.json())
    .then(arrayObj => {

        let arrayId = [];
        for(let i = 0; i < arrayObj.length; i++){
             arrayId.push(arrayObj[i].id_age);
        }
        uniqueId = Array.from(new Set(arrayId));

        for(let i = 0; i < uniqueId.length; i ++){
            console.log(array[i]);
            const divCube = document.createElement('div');
            divCube.setAttribute('id', `cube-${i}`);
            let div = document.createElement('div');
            div.setAttribute('id', `div-${i}`);
            div.classList.add('row-container');
            div.classList.add('booksContainer');
            sectionContainer.append(divCube);
            let numeroDe;
            switch (array[i]) {         // séléction des dé en fonction de l'age de l'enfant
                case "0":
                    numeroDe = 1;
                    break;
                case "1":
                    numeroDe = 1;
                    break;
                case "2":
                    numeroDe = 1;
                    break;
                case "3":
                    numeroDe = 2;
                    break;
                case "4":
                    numeroDe = 2;
                    break;
                case "5":
                    numeroDe = 3;
                    break;
                case "6":
                    numeroDe = 3;
                    break;
                case "7":
                    numeroDe = 4;
                    break;
                case "8":
                    numeroDe = 4;
                    break;
                case "9":
                    numeroDe = 5;
                    break;
                case "10":
                    numeroDe = 5;
                    break;
            
            }
            switch (numeroDe) {
                case 1:
                    const include1 = `<div id="container_0" class="containerAll">
                                            <div class="cubesGsap">
                                            <img src="uploads/autres/age_0_1.webp" class="square img4">
                                            </div>
                                            <div class="images">
                                            <img src="uploads/autres/age_0_2.webp" class="img1"alt="">
                                            <img src="uploads/autres/age_0_3.webp" class="img2" alt="" >
                                            <img src="uploads/autres/age_0_4.webp" class="img3"alt="">
                                            </div>
                                            <div class="cubesGsap">      
                                            <img src="uploads/autres/age_0_5.webp" class="square img5">
                                            </div>
                                        </div>`;
                    divCube.innerHTML = include1;
                    const age0_2 = document.querySelector('.img2');
                    age0_2.addEventListener('click', function(){document.location.href = "/age/1";});
                    break;
                case 2:
                    const include2 = `<div id="container_2" class="containerAll">
                                            <div class="images">
                                            <img src="uploads/autres/age_2_3.webp" class="img6"alt="">
                                            <img src="uploads/autres/age_2_4.webp" class="img7" alt="" >
                                            <img src="uploads/autres/age_2_5.png" class="img8"alt="">
                                            </div>
                                            <div class="cubesGsap">
                                            <img src="uploads/autres/age_2_1.webp" class="square img9">    
                                            <img src="uploads/autres/age_2_2.webp" class="square img10">
                                            </div>
                                        </div>`;
                    divCube.innerHTML = include2;
                    const age2_4 = document.querySelector('.img7');
                    age2_4.addEventListener('click', function(){document.location.href = "/age/2";});
                    break;
                case 3:
                    const include3 = `<div id="container_4" class="containerAll">
                                        <div class="cubesGsap">
                                                <img src="uploads/autres/age_4_4.webp" class="square img14">
                                                </div>
                                                <div class="images">
                                                <img src="uploads/autres/age_4_1.webp" class="img11" alt="">
                                                <img src="uploads/autres/age_4_2.webp" class="img12" alt="" >
                                                <img src="uploads/autres/age_4_3.webp" class="img13" alt="">
                                                </div>
                                                <div class="cubesGsap">      
                                                <img src="uploads/autres/age_4_5.webp" class="square img15">
                                                </div>
                                        </div>`;
                    divCube.innerHTML = include3;
                    const age4_6 = document.querySelector('.img12');
                    age4_6.addEventListener('click', function(){document.location.href = "/age/3";});
                    break;
                case 4:
                    const include4 = `<div id="container_6" class="containerAll">
                                            <div class="cubesGsap">
                                            <img src="uploads/autres/age_6_5.webp" class="square img19">
                                            </div>
                                            <div class="images">
                                            <img src="uploads/autres/age_6_1.webp" class="img16" alt="">
                                            <img src="uploads/autres/age_6_2.webp" class="img17" alt="" >
                                            <img src="uploads/autres/age_6_4.webp" class="img18" alt="">
                                            </div>
                                            <div class="cubesGsap">      
                                            <img src="uploads/autres/age_6_6.webp" class="square img20">
                                            <img src="uploads/autres/age_6_7.webp" class="square img20b">
                                            </div>
                                    </div>`;
                    divCube.innerHTML = include4;
                    const age6_8 = document.querySelector('.img17');
                    age6_8.addEventListener('click', function(){document.location.href = "/age/4";});
                    break;
                case 5:
                    const include5 = `<div id="container_8" class="containerAll">
                                    <div class="cubesGsap">
                                            <img src="uploads/autres/age_8_4.webp" class="square img24">
                                            <img src="uploads/autres/age_8_4.webp" class="square img24b">
                                            </div>
                                            <div class="images">
                                            <img src="uploads/autres/age_8_1.webp" class="img21"alt="">
                                            <img src="uploads/autres/age_8_2.webp" class="img22" alt="" >
                                            <img src="uploads/autres/age_8_3.webp" class="img23"alt="">
                                            </div>
                                            <div class="cubesGsap">      
                                            <img src="uploads/autres/age_8_5.webp" class="square img25">
                                            <img src="uploads/autres/age_8_5.webp" class="square img25b">
                                            </div>
                                    </div>`;
                    divCube.innerHTML = include5;
                    const age8_10 = document.querySelector('.img22');
                    age8_10.addEventListener('click', function(){document.location.href = "/age/5";});
                    break;
            }

            divCube.append(div);
            
        }

        const rowContainers = document.querySelectorAll('.row-container');
        const chunks = [];
        const chunkSize = 4;
        for(let i = 0; i < arrayObj.length; i += chunkSize){
            chunks.push(arrayObj.slice(i, i+ chunkSize));
        }
        for(let i = 0; i < chunks.length; i++){
            for(let j = 0; j < chunks[i].length; j++){
                const bookArticle = document.createElement('article');
                
                

                bookArticle.classList.add('card');
                rowContainers[i].append(bookArticle);
                const bookImg = document.createElement('img');
                const bookTitle = document.createElement('p');
                bookImg.setAttribute('src', chunks[i][j].img);
                

                bookTitle.textContent = chunks[i][j].title;
                const descLink = document.createElement('a'); //ajouter le lien
                const borrowLink = document.createElement('button');
                const linkDiv1 = document.createElement('div');
                const linkDiv2 = document.createElement('div');
                descLink.classList.add("button_pink");
                borrowLink.classList.add("button_borrow");
                linkDiv1.append(descLink);
                linkDiv2.append(borrowLink);
                descLink.setAttribute('href', '/book/'+ chunks[i][j].id_book);
                borrowLink.setAttribute('type', 'button');
                borrowLink.setAttribute('value', chunks[i][j].id_book);
                
                
                borrowLink.addEventListener("click", () =>{         // generer les requetes pour les boutons reserver
                    reservationBook(borrowLink.value, id);
                });                                                                    
                descLink.textContent = "Voir la fiche";
                borrowLink.textContent = "Réserver";
                
                bookArticle.append(bookImg );
                
                bookArticle.append(bookTitle);
                bookArticle.append(linkDiv1);
                bookArticle.append(linkDiv2);

            }
            
        }
    })
  
    };

    
    function reservationBook(book, id){     //verification reservation 
        fetch(`/${book}/${id}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data == 'ok'){
                alert('Votre réservation à été prise en compte');
                showReservation(id);
                console.log('reservation ok');
            } else if(data == 'max'){
                alert('Vous avez atteint la limite de 3 réservations');
            } else if(data == 'already'){
                alert('Vous avez déjà réservé cet ouvrage');
            } else {
                console.log('erreur de reservation');
            }
        });
    }


    function showReservation(id){
        const resBox = document.querySelector('.reservation');
        removeElementByClass('padding-element2');       //suppression de l'affichage de chaque reservation en fonction de l'enfant choisi
        fetch(`/${id}`)
        .then(response => response.json())
        .then(data => { 
            if(data == "Aucune réservation"){
                console.log("Aucune réservation")
            } else {
                data.forEach(element => {   //création de chaque carte réservation avec l'arborescence css
                    const divPadding = document.createElement('div');
                    const divMiniBook = document.createElement('div');
                    const divMiniBookTitle = document.createElement('div');
                    const imgMiniBook = document.createElement('img');
                    const alink = document.createElement('a');
                    const aButton = document.createElement('a');
                    const xIcon = document.createElement('img');

                    
                    divPadding.setAttribute("class", "padding-element2");
                    divMiniBook.setAttribute("class", "mini-book");
                    divMiniBookTitle.setAttribute("class", "mini-book-title");
                    imgMiniBook.setAttribute("class", "mini-book-img");
                    imgMiniBook.setAttribute("src", element.img_src);
                    imgMiniBook.setAttribute("alt", "miniature du livre");


                    alink.innerHTML = element.title;
                    xIcon.setAttribute('id', 'close-button');
                    xIcon.setAttribute('src', 'uploads/autres/iconX.svg');
                    xIcon.setAttribute('class', 'close-x-icon');
                    xIcon.setAttribute('alt', 'icone fermeture');
                    xIcon.setAttribute('value', element.id_reservation);

                    xIcon.addEventListener("click", () =>{  
                        removeReservation(element.id_reservation, id);
                    });


                    resBox.append(divPadding);
                    divPadding.append(divMiniBook);
                    divMiniBook.append(imgMiniBook);
                    divMiniBook.append(divMiniBookTitle);
                    divMiniBookTitle.append(alink);
                    divMiniBookTitle.append(aButton);
                    aButton.append(xIcon);
                });
            }
        });
    }

    function removeElementByClass(className){
        let elements = document.getElementsByClassName(className);
        while(elements.length > 0){
            elements[0].parentNode.removeChild(elements[0]);
        }
    }

    function removeReservation(id_reservation, id){
        fetch(`/remove/${id_reservation}`)
        .then(response => response.json())
        .then(data => {  
            showReservation(id);
        });
    }

if( selectChild == null){

    //Redirection page age

    const age0_2 = document.querySelector('.img2');
    const age2_4 = document.querySelector('.img7');
    const age4_6 = document.querySelector('.img12');
    const age6_8 = document.querySelector('.img17');
    const age8_10 = document.querySelector('.img22');

    age0_2.addEventListener('click', function(){document.location.href = "/age/1";});
    age2_4.addEventListener('click', function(){document.location.href = "/age/2";});
    age4_6.addEventListener('click', function(){document.location.href = "/age/3";});
    age6_8.addEventListener('click', function(){document.location.href = "/age/4";});
    age8_10.addEventListener('click', function(){document.location.href = "/age/5";});

    document.addEventListener("DOMContentLoaded", function() {
        gsap.registerPlugin(Flip);
        const containers = document.querySelectorAll('.containerAll');

        containers.forEach(container => {
            // Groupe 1 (ex : container_0)
            const img2 = container.querySelector('.img2');
            const img3 = container.querySelector('.img3');
            const img4 = container.querySelector('.img4');
            const img5 = container.querySelector('.img5');

            if (img2 && img3 && img4 && img5) {
                let hasFlipped1 = false; // Pour éviter de refaire l'animation

                function handleMouseOverGroup1() {
                    img3.style.opacity = "1";
                    if (!hasFlipped1) {
                        gsap.to(img4, { x: 280, duration: 1.5 });
                        gsap.to(img5, { x: -280, duration: 1.5 });
                    }
                }

                function handleMouseOutGroup1() {
                    img3.style.opacity = "0";
                    if (!hasFlipped1) {
                        gsap.to(img4, { x: 0, duration: 3.5 });
                        gsap.to(img5, { x: 0, duration: 3.5 });
                        hasFlipped1 = true;
                    }
                }

                img2.addEventListener("mouseover", handleMouseOverGroup1);
                img2.addEventListener("mouseout", handleMouseOutGroup1);
            }

            // Groupe 2 (ex : container_2)
            const img7 = container.querySelector('.img7');
            const img8 = container.querySelector('.img8');
            const img9 = container.querySelector('.img9');
            const img10 = container.querySelector('.img10');

            if (img7 && img8 && img9 && img10) {
                let hasFlipped2 = false; // Pour éviter de refaire l'animation

                function handleMouseOverGroup2() {
                    img8.style.opacity = "1";
                    if (!hasFlipped2) {
                        gsap.to(img9, { y: 90, duration: 1.5 });
                        gsap.to(img10, { y: -70, duration: 1.5 });
                    }
                }

                function handleMouseOutGroup2() {
                    img8.style.opacity = "0";
                    if (!hasFlipped2) {
                        gsap.to(img9, { y: 0, duration: 3.5 });
                        gsap.to(img10, { y: 0, duration: 3.5 });
                        hasFlipped2 = true;
                    }
                }

                img7.addEventListener("mouseover", handleMouseOverGroup2);
                img7.addEventListener("mouseout", handleMouseOutGroup2);
            }
            // Groupe 3 container_4

            const img12 = container.querySelector('.img12');
            const img13 = container.querySelector('.img13');
            const img14 = container.querySelector('.img14');
            const img15 = container.querySelector('.img15');
            //console.log("Groupe 3 éléments :", { img12, img13, img14, img15 });

            if (img12 && img13 && img14 && img15) {
                let hasFlipped3 = false;
            
                function handleMouseOverGroup3() {
                    img13.style.opacity = "1";
                    if (!hasFlipped3) {
                        gsap.to(img14, { y: -100, duration: 1.5 });
                        gsap.to(img15, { y: 70, duration: 1.5 });
                    }
                }
                function handleMouseOutGroup3() {
                    img13.style.opacity = "0";
                    if (!hasFlipped3) {
                        gsap.to(img14, { y: 0, duration: 3.5 });
                        gsap.to(img15, { y: 0, duration: 3.5 });
                        hasFlipped3 = true;
                    }
                }
                img12.addEventListener("mouseover", handleMouseOverGroup3);
                img12.addEventListener("mouseout", handleMouseOutGroup3);
            }
                //Groupe 4 container_6

            const img17 = container.querySelector('.img17');
            const img18 = container.querySelector('.img18');
            const img19 = container.querySelector('.img19');
            const img20 = container.querySelector('.img20');
            const img20b = container.querySelector('.img20b');

            if (img17 && img18 && img19 && img20 && img20b) {
                let hasFlipped4 = false;
            
                function handleMouseOverGroup4() {
                    img18.style.opacity = "1";
                    if (!hasFlipped4) {
                        let tl = gsap.timeline({ defaults: { duration: 1.3, ease: "power2.inOut" } });

            tl.to(img20, { x: -50 }) // img20 va à gauche
            .to(img20b, { x: 50 }, "-=1.2") // img21 va à droite (léger chevauchement)
            .to(img20, { y: -60 }) // img20 monte
            .to(img20b, { y: 70 }, "-=1.2") // img21 descend
            .to(img20, { x: 5 }) // img20 retourne vers la droite
            .to(img20b, { x: -10 }, "-=1.2"); // img21 va légèrement à gauche
        
                    }
                }
                function handleMouseOutGroup4() {
                    img18.style.opacity = "0";
                    if (!hasFlipped4) {
                        gsap.to(img20, { x: 0, duration: 1 });
                        gsap.to(img20b, { x: 3, duration: 1 });
                        hasFlipped4 = true;
                    }
                }
                img17.addEventListener("mouseover", handleMouseOverGroup4);
                img17.addEventListener("mouseout", handleMouseOutGroup4);
            }
        
            //Groupe 5 container_8
            const img21 = container.querySelector('.img21');
            const img22 = container.querySelector('.img22');
            const img23 = container.querySelector('.img23');
            const img24 = container.querySelector('.img24');
            const img24b = container.querySelector('.img24b');
            const img25 = container.querySelector('.img25');
            const img25b = container.querySelector('.img25b');

            if (img21 && img22 && img23 && img24 && img24b && img25 && img25b) {
                let hasFlipped5 = false;
            
                function handleMouseOverGroup5() {
                    img23.style.opacity = "1";
                    if (!hasFlipped5) {
                        gsap.to([img24,img24b,img25,img25b], { 
                            rotation: 360, // Rotation complète
                            transformOrigin: "center center", // Rotation autour de son centre
                            duration: 1.5, 
                            ease: "power2.inOut" 
                        });
                    }
                }
            
                function handleMouseOutGroup5() {
                    img23.style.opacity = "0";
                    gsap.to([img24,img24b,img25,img25b], { 
                        rotation: 0, // Retour à l'état initial
                        duration: 1.5, 
                        ease: "power2.inOut"  
                    });
                    hasFlipped5 = true;
                }
                img22.addEventListener("mouseover", handleMouseOverGroup5);
                img22.addEventListener("mouseout", handleMouseOutGroup5);

            }
    })});
}
