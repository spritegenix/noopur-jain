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
// ---------------------------------------------------- //
function scrollWithOffset(event) {
  event.preventDefault(); // Prevent default anchor behavior
  const targetId = event.currentTarget.getAttribute("href"); // Get target id from href
  const targetElement = document.querySelector(targetId); // Get the target element

  if (targetElement) {
    const offsetPosition =
      targetElement.getBoundingClientRect().top + window.scrollY - 150;

    window.scrollTo({
      top: offsetPosition,
      behavior: "smooth",
    });
  }
}

// Image Modal
function openModal(image) {
  const modal = document.getElementById("imageModal");
  const modalImage = document.getElementById("modalImage");
  modalImage.src = image.src; // Set the image source in the modal
  modal.classList.remove("hidden"); // Show the modal
}

function closeModal() {
  const modal = document.getElementById("imageModal");
  modal.classList.add("hidden"); // Hide the modal
}

// Contact Modal
function contactModal1() {
  const modal = document.getElementById("contactModal1");
  modal.classList.remove("hidden");
}

function contactCloseModal1() {
  const modal = document.getElementById("contactModal1");
  modal.classList.add("hidden");
}
// Contact Modal
function contactModal2() {
  const modal = document.getElementById("contactModal2");
  modal.classList.remove("hidden");
}

function contactCloseModal2() {
  const modal = document.getElementById("contactModal2");
  modal.classList.add("hidden");
}

// Start Modal
function startModal() {
  const modal = document.getElementById("startModal");
  modal.classList.remove("hidden");
}

function startCloseModal() {
  const modal = document.getElementById("startModal");
  modal.classList.add("hidden");
}

// Automatically open the modal on page load
document.addEventListener("DOMContentLoaded", () => {
  startModal();
});
