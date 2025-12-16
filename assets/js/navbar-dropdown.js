// Navbar Dropdown Toggle Handler - Left-aligned only
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    const dropdowns = document.querySelectorAll('.dropdown');
    const isDesktop = window.innerWidth > 768;
    
    // Toggle dropdown on click (for mobile and keyboard users)
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            if (!isDesktop) {
                e.preventDefault();
                const dropdown = toggle.closest('.dropdown');
                dropdown.classList.toggle('active');
            }
        });
        
        // Add keyboard support (Enter/Space)
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle.click();
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }
    });
    
    // Prevent dropdown from closing when clicking inside the menu
    dropdowns.forEach(function(dropdown) {
        const menu = dropdown.querySelector('.dropdown-menu');
        if (menu) {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
});