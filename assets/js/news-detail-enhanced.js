// Enhanced News Detail Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    initSmoothScrolling();
    
    // Share functionality
    initShareFunctionality();
    
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
function initShareFunctionality() {
    // Create share modal HTML
    const shareModal = document.createElement('div');
    shareModal.id = 'shareModal';
    shareModal.className = 'share-modal';
    shareModal.innerHTML = `
        <div class="share-modal-content">
            <h3 style="margin-bottom: 1rem; color: var(--black-color);">Share This Article</h3>
            <div class="share-buttons">
                <a href="#" class="share-btn facebook" data-platform="facebook">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>
                <a href="#" class="share-btn twitter" data-platform="twitter">
                    <i class="fab fa-twitter"></i>
                    Twitter
                </a>
                <a href="#" class="share-btn whatsapp" data-platform="whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>
                <a href="#" class="share-btn linkedin" data-platform="linkedin">
                    <i class="fab fa-linkedin-in"></i>
                    LinkedIn
                </a>
            </div>
            <button onclick="copyToClipboard()" style="margin-top: 1rem; padding: 0.5rem 1rem; background: var(--dark-color); color: white; border: none; border-radius: 6px; cursor: pointer;">
                <i class="fas fa-copy"></i> Copy Link
            </button>
            <button onclick="closeShareModal()" style="margin-top: 1rem; margin-left: 0.5rem; padding: 0.5rem 1rem; background: var(--light-color); color: var(--black-color); border: none; border-radius: 6px; cursor: pointer;">
                Close
            </button>
        </div>
    `;
    
    document.body.appendChild(shareModal);
    
    // Add event listeners to share buttons
    shareModal.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.dataset.platform;
            shareToSocialMedia(platform);
        });
    });
}

function shareArticle() {
    const modal = document.getElementById('shareModal');
    if (modal) {
        modal.style.display = 'block';
    }
}

function closeShareModal() {
    const modal = document.getElementById('shareModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function shareToSocialMedia(platform) {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.querySelector('.article-heading').textContent);
    const description = encodeURIComponent(document.querySelector('.content-body').textContent.substring(0, 150) + '...');
    
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${title}%20${url}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
            break;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

function copyToClipboard() {
    const url = window.location.href;
    
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            showToast('Link copied to clipboard!', 'success');
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showToast('Link copied to clipboard!', 'success');
    }
    
    closeShareModal();
}

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
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to share
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        shareArticle();
    }
    
    // ESC to close modals
    if (e.key === 'Escape') {
        closeShareModal();
    }
});

// Click outside modal to close
window.addEventListener('click', function(e) {
    const shareModal = document.getElementById('shareModal');
    if (e.target === shareModal) {
        closeShareModal();
    }
});

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