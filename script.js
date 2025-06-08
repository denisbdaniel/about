// Slide Animation for Header; don't ask me anything -- I hate this.
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}

// Get the menu icon and header links elements

function toggleMenu() {
  var links = document.querySelector(".links");
  links.classList.toggle("active");
}

function sendLetter() {
  var name = document.getElementById("name").value;
  var message = document.getElementById("message").value;

  // Encode the subject and body for the mailto link
  var subject = "Letter from " + name;
  var body = message;

  // Construct the mailto link with the encoded subject and body
  var mailtoLink =
    "mailto:devotedentity@gmail.com" +
    "?subject=" +
    encodeURIComponent(subject) +
    "&body=" +
    encodeURIComponent(body);

  // Open the default email client with the mailto link
  window.location.href = mailtoLink;
}
function toggleDarkMode() {
  var body = document.body;
  body.classList.toggle("dark-mode");
}

function scrollDown() {
  // Adjust the number below to control how far the page scrolls down
  const scrollAmount = 1000; // Change this value based on your needs

  window.scrollBy({
    top: scrollAmount,
    behavior: "smooth",
  });
}
