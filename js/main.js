window.addEventListener("scroll", () => {
  const nav = document.querySelector(".glass-nav");
  nav.style.background =
    window.scrollY > 40 ? "rgba(15,23,42,.95)" : "rgba(15,23,42,.75)";
});
    