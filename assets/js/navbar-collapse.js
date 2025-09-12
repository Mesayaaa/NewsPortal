// Clean Navbar Toggle - No Over Engineering
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('nav-menu');
  
  if (hamburger && navMenu) {
    // Toggle menu on click
    hamburger.onclick = function() {
      hamburger.classList.toggle('active');
      navMenu.classList.toggle('active');
    };
    
    // Close menu when clicking nav links on mobile
    navMenu.onclick = function() {
      if (window.innerWidth <= 768) {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
      }
    };
  } else {
    console.error('Hamburger or nav-menu element not found');
  }
});
