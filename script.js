// Toggle the mobile menu
const menuButton = document.getElementById("menuButton");
const mobileMenu = document.getElementById("mobileMenu");
const coursesButton = document.getElementById("coursesButton");
const coursesMenu = document.getElementById("coursesMenu");

menuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
  coursesMenu.classList.add("hidden");
});

coursesButton.addEventListener("click", () => {
  coursesMenu.classList.toggle("hidden");
});
