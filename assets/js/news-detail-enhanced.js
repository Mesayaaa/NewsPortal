// Enhanced News Detail Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    initSmoothScrolling();
    // Back to top button
    initBackToTop();
    // Sidebar drag functionality
    initSidebarDrag();
});

// Smooth scrolling for internal links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Share functionality
// ...existing code...

// Enhanced back to top functionality
function initBackToTop() {
    const backToTopBtn = document.querySelector('.topNavBtn');
    
    if (backToTopBtn) {
        // Show/hide based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
                backToTopBtn.style.opacity = '1';
            } else {
                backToTopBtn.style.opacity = '0';
                setTimeout(() => {
                    if (window.pageYOffset <= 300) {
                        backToTopBtn.style.display = 'none';
                    }
                }, 300);
            }
        });
        
        // Smooth scroll to top
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

// Toast notification function
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#27ae60' : '#3498db'};
        color: white;
        border-radius: 8px;
        z-index: 3000;
        font-family: var(--ff-nunito);
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    // Slide in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Keyboard shortcuts
// ...existing code...

// Click outside modal to close
// ...existing code...

// Performance optimizations
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Lazy load sidebar content for better performance
function initLazyLoadSidebar() {
    const sidebarCards = document.querySelectorAll('.enhanced-sidebar-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('loaded');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });
    
    sidebarCards.forEach(card => {
        observer.observe(card);
    });
}

// Initialize lazy loading
document.addEventListener('DOMContentLoaded', initLazyLoadSidebar);

// Add accessibility improvements
function initAccessibility() {
    // Add skip links for screen readers
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.textContent = 'Skip to main content';
    skipLink.className = 'skip-link';
    skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: var(--primary-color);
        color: white;
        padding: 8px;
        text-decoration: none;
        border-radius: 4px;
        z-index: 1000;
        transition: top 0.3s;
    `;
    
    skipLink.addEventListener('focus', function() {
        this.style.top = '6px';
    });
    
    skipLink.addEventListener('blur', function() {
        this.style.top = '-40px';
    });
    
    document.body.insertBefore(skipLink, document.body.firstChild);
    
    // Add main content ID
    const mainContent = document.querySelector('.article');
    if (mainContent) {
        mainContent.id = 'main-content';
    }
    
    // Add aria labels to buttons
    const shareBtn = document.querySelector('.btn-share');
    if (shareBtn) {
        shareBtn.setAttribute('aria-label', 'Share this article');
    }
    
    const bookmarkBtn = document.querySelector('.btn-bookmark');
    if (bookmarkBtn) {
        const isBookmarked = bookmarkBtn.classList.contains('bookmarked');
        bookmarkBtn.setAttribute('aria-label', isBookmarked ? 'Remove from bookmarks' : 'Add to bookmarks');
    }
    
    const downloadBtn = document.querySelector('.btn-download');
    if (downloadBtn) {
        downloadBtn.setAttribute('aria-label', 'Download article as PDF');
    }
}

// Initialize accessibility
document.addEventListener('DOMContentLoaded', initAccessibility);

// Sidebar drag functionality
function initSidebarDrag() {
    const sidebarContents = document.querySelectorAll('.sidebar-content');
    
    sidebarContents.forEach(content => {
        let isDragging = false;
        let startY = 0;
        let scrollTop = 0;
        
        // Check if content overflows (needs scrolling)
        function checkOverflow() {
            if (content.scrollHeight > content.clientHeight) {
                content.classList.add('draggable');
                
                // Mouse events
                content.addEventListener('mousedown', startDrag);
                content.addEventListener('mousemove', drag);
                content.addEventListener('mouseup', stopDrag);
                content.addEventListener('mouseleave', stopDrag);
                
                // Touch events for mobile
                content.addEventListener('touchstart', startDragTouch, {passive: false});
                content.addEventListener('touchmove', dragTouch, {passive: false});
                content.addEventListener('touchend', stopDrag);
            } else {
                content.classList.remove('draggable');
            }
        }
        
        // Initial check
        checkOverflow();
        
        // Re-check on window resize
        window.addEventListener('resize', checkOverflow);
        
        function startDrag(e) {
            // Don't start drag if clicking on a link
            if (e.target.tagName === 'A' || e.target.closest('a')) {
                return;
            }
            
            isDragging = true;
            content.classList.add('dragging');
            startY = e.pageY - content.offsetTop;
            scrollTop = content.scrollTop;
            e.preventDefault();
        }
        
        function startDragTouch(e) {
            // Don't start drag if touching a link
            if (e.target.tagName === 'A' || e.target.closest('a')) {
                return;
            }
            
            isDragging = true;
            content.classList.add('dragging');
            const touch = e.touches[0];
            startY = touch.pageY - content.offsetTop;
            scrollTop = content.scrollTop;
            e.preventDefault();
        }
        
        function drag(e) {
            if (!isDragging) return;
            e.preventDefault();
            
            const y = e.pageY - content.offsetTop;
            const walk = (y - startY) * 2; // Scroll speed multiplier
            content.scrollTop = scrollTop - walk;
        }
        
        function dragTouch(e) {
            if (!isDragging) return;
            e.preventDefault();
            
            const touch = e.touches[0];
            const y = touch.pageY - content.offsetTop;
            const walk = (y - startY) * 2; // Scroll speed multiplier
            content.scrollTop = scrollTop - walk;
        }
        
        function stopDrag() {
            isDragging = false;
            content.classList.remove('dragging');
        }
    });
}