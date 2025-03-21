gsap.utils.toArray(".flip-contain").forEach(function (card) {
  gsap.set(card, {
    transformStyle: "preserve-3d",
    transformPerspective: 1000,
  });
  const q = gsap.utils.selector(card);
  const front = q(".flip-front");
  const back = q(".flip-back");

  gsap.set(back, { rotationY: -180 });

  const tl = gsap
    .timeline({ paused: true })
    .to(front, { duration: 1, rotationY: 180 })
    .to(back, { duration: 1, rotationY: 0 }, 0)
    .to(card, { z: 50 }, 0)
    .to(card, { z: 0 }, 0.5);
  card.addEventListener("mouseenter", function () {
    tl.play();
  });
  card.addEventListener("mouseleave", function () {
    tl.reverse();
  });
});
