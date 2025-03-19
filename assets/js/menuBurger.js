const menuToggle = document.querySelector('.menu-toggle');
const navbar = document.querySelector('.navbar');

menuToggle.addEventListener("click", () => {
    if (navbar.style.left === "0%") {
      gsap.to(navbar, { left: "-80%", duration: 0.5, scale: 1 }); // Ferme le menu
    
    } else {
      gsap.to(navbar, {
        left: "0%",
        duration: 0.5,
        scale: 1, // Ouvre le menu avec une échelle de 1
        ease: "back.out", // Effet de rebond
      });
    
    }
});