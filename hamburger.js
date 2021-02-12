let show = true;

const menuSection = document.querySelector(".direita")
const menuToggle = menuSection.querySelector(".hamburger")

menuToggle.addEventListener("click", () => {

    document.body.style.overflow = show ? "hidden" : "initial"

    menuSection.classList.toggle("on", show)
    show = !show;
})