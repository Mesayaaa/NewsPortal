// Navbar Dropdown Toggle - Desktop Only
document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown toggles
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            // Desktop only - no mobile responsiveness
            // Dropdowns work on hover on desktop, click handling removed
        });
    });
    
    // Close dropdowns when clicking outside - desktop only
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }
    });
    
    // Desktop only - no resize handling needed
});