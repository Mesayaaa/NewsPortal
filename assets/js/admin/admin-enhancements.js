/**
 * Admin Panel Enhancements
 * Modern interactions and animations for better UX
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Add loading states to buttons
    function addLoadingState() {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            if (button.type === 'submit' || button.classList.contains('btn-primary')) {
                button.addEventListener('click', function(e) {
                    if (!button.classList.contains('loading')) {
                        button.classList.add('loading');
                        const originalText = button.innerHTML;
                        button.innerHTML = '<i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Processing...';
                        
                        // Reset after 3 seconds (form submission should handle this)
                        setTimeout(() => {
                            button.classList.remove('loading');
                            button.innerHTML = originalText;
                        }, 3000);
                    }
                });
            }
        });
    }

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
                        customClass: {
                            popup: 'modern-swal',
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary'
                        }
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
    function addScrollToTop() {
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '<i class="glyphicon glyphicon-chevron-up"></i>';
        scrollBtn.className = 'scroll-to-top';
        scrollBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(199, 39, 39, 0.3);
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 1000;
            font-size: 18px;
        `;

        document.body.appendChild(scrollBtn);

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.style.opacity = '1';
                scrollBtn.style.transform = 'translateY(0)';
            } else {
                scrollBtn.style.opacity = '0';
                scrollBtn.style.transform = 'translateY(20px)';
            }
        });

        scrollBtn.addEventListener('mouseenter', () => {
            scrollBtn.style.transform = 'translateY(-3px) scale(1.1)';
            scrollBtn.style.boxShadow = '0 8px 25px rgba(199, 39, 39, 0.4)';
        });

        scrollBtn.addEventListener('mouseleave', () => {
            scrollBtn.style.transform = window.pageYOffset > 300 ? 'translateY(0) scale(1)' : 'translateY(20px) scale(1)';
            scrollBtn.style.boxShadow = '0 4px 15px rgba(199, 39, 39, 0.3)';
        });
    }

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
    addLoadingState();
    addCardAnimations();
    enhanceTableInteractions();
    addConfirmationDialogs();
    addScrollToTop();
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