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
  setTimeout(showSlides, 5000); // Change image every 5 seconds, oh god
}

const form = document.querySelector('form');

form.addEventListener('submit', (event) => {
  event.preventDefault();
  const email = form.querySelector('input[type="email"]').value;
  alert(`Thanks for subscribing with email: ${email}`);
  form.reset();
});




