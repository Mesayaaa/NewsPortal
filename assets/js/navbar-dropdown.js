// Navbar Dropdown Toggle
document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown toggles
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            // Only prevent default on mobile (when screen width is <= 968px)
            if (window.innerWidth <= 968) {
                e.preventDefault();
                
                // Get the parent dropdown
                const dropdown = this.closest('.dropdown');
                
                // Close other dropdowns
                document.querySelectorAll('.dropdown').forEach(function(item) {
                    if (item !== dropdown) {
                        item.classList.remove('active');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('active');
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 968) {
            // Remove active class from all dropdowns on desktop
            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }
    });
});