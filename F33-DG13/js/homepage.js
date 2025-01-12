var slideIndex = 1;
var slides = document.getElementsByClassName("mySlides");
showSlides(slideIndex); // Show the initial slide

// Next/previous controls
function plusSlides(n) {
  clearInterval(slideInterval); // Clear the existing slide interval
  slideIndex += n;
  if (slideIndex > slides.length) { slideIndex = 1; } // Wrap back to the first slide if the end is passed
  else if (slideIndex < 1) { slideIndex = slides.length; } // Wrap to the last slide if the beginning is passed
  showSlides(slideIndex);
  slideInterval = setInterval(automaticSlide, 5000); // Restart the slide interval
}

function setCurrentSlide(n) {
  clearInterval(slideInterval); // Clear the existing slide interval
  slideIndex = n; // Directly set the slideIndex to the desired slide
  if (slideIndex > slides.length) { slideIndex = 1; } // Wrap back to the first slide if the end is passed
  else if (slideIndex < 1) { slideIndex = slides.length; } // Wrap to the last slide if the beginning is passed
  showSlides(slideIndex);
  slideInterval = setInterval(automaticSlide, 5000); // Restart the slide interval
}

function showSlides(n) {
  if (slides.length === 0) { return; } // Exit the function if there are no slides
  var i;
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[n-1].style.display = "block";  
}

// Call this function to go to the next slide every 8 seconds
function automaticSlide() {
  plusSlides(1);
}

// Start the automatic slideshow
var slideInterval = setInterval(automaticSlide, 5000);
