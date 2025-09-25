/**
 * Admin Panel Enhancements
 * Modern interactions and animations for better UX
 */

document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations to cards
    function addCardAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        const cards = document.querySelectorAll('.panel, .dash-box, .list-group');
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    }

    // Add table row click effects - DISABLED
    function enhanceTableInteractions() {
        // Table interactions disabled per user request
        return;
    }

    // Add confirmation dialogs for dangerous actions
    function addConfirmationDialogs() {
        const dangerButtons = document.querySelectorAll('a[href*="delete-article.php"], a[href*="delete-category.php"], a[href*="remove-bookmark.php"], .btn-danger[href*="delete"], button[type="submit"][value*="delete"]');
        dangerButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Only prevent default and show confirmation for actual delete actions
                const href = this.href || this.closest('form').action;
                const isDeleteAction = href && (href.includes('delete-') || href.includes('remove-') || this.classList.contains('btn-danger'));
                
                if (!isDeleteAction) {
                    return; // Don't show confirmation for non-delete actions
                }
                
                e.preventDefault();
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (this.tagName === 'A') {
                                window.location.href = href;
                            } else {
                                this.closest('form').submit();
                            }
                        }
                    });
                } else {
                    if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                        if (this.tagName === 'A') {
                            window.location.href = href;
                        } else {
                            this.closest('form').submit();
                        }
                    }
                }
            });
        });
    }

    // Add smooth scrolling to top

    // Add form validation feedback
    function enhanceFormValidation() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.style.borderColor = '#dc3545';
                        this.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                    } else {
                        this.style.borderColor = '#28a745';
                        this.style.boxShadow = '0 0 0 4px rgba(40, 167, 69, 0.1)';
                    }
                });

                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary-color)';
                    this.style.boxShadow = '0 0 0 4px rgba(199, 39, 39, 0.1)';
                });
            });
        });
    }

    // Initialize all enhancements
    addCardAnimations();
    enhanceTableInteractions();
    addConfirmationDialogs();
    enhanceFormValidation();

    // Add some CSS for new features
    const style = document.createElement('style');
    style.textContent = `
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }
        
        .active-row {
            background: #f8f9fa !important;
            border-left: 4px solid var(--primary-color) !important;
        }
        
        .glyphicon-spin {
            animation: spin 1s infinite linear;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .modern-swal {
            border-radius: 15px !important;
        }
        
        .form-control:invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }
        
        .form-control:valid {
            border-color: #28a745;
        }
    `;
    document.head.appendChild(style);
    
    // Fix dropdown positioning to ensure it breaks out of container
    function fixDropdownPositioning() {
        // Wait for Bootstrap dropdown to initialize
        setTimeout(() => {
            const dropdowns = document.querySelectorAll('.navbar-nav .dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                if (toggle && menu) {
                    toggle.addEventListener('click', function(e) {
                        // Ensure dropdown menu is positioned correctly
                        setTimeout(() => {
                            if (dropdown.classList.contains('open')) {
                                // Get toggle position
                                const toggleRect = toggle.getBoundingClientRect();
                                const navbar = document.querySelector('.navbar');
                                const navbarHeight = navbar ? navbar.offsetHeight : 70;
                                
                                // Position dropdown menu
                                menu.style.position = 'fixed';
                                menu.style.top = (toggleRect.bottom + 5) + 'px';
                                menu.style.right = (window.innerWidth - toggleRect.right) + 'px';
                                menu.style.left = 'auto';
                                menu.style.zIndex = '10001';
                            }
                        }, 10);
                    });
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    const menus = document.querySelectorAll('.dropdown-menu');
                    menus.forEach(menu => {
                        menu.style.position = '';
                        menu.style.top = '';
                        menu.style.right = '';
                        menu.style.left = '';
                    });
                }
            });
            
        }, 100);
    }
    
    // Initialize dropdown positioning fix
    fixDropdownPositioning();
});