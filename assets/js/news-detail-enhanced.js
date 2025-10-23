// Enhanced News Detail Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    initSmoothScrolling();
    // Back to top button
    initBackToTop();
    // Sidebar drag functionality
    initSidebarDrag();
    // Initialize Read-Aloud (TTS) - Fixed to not destroy HTML
    initArticleTTS();
    // Initialize Focus Mode
    initFocusMode();
    // Initialize Reading Progress
    initReadingProgress();
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

// ==========================
// Reading Progress
// ==========================
function initReadingProgress() {
    const bar = document.getElementById('readingProgress');
    const article = document.querySelector('.article');
    if (!bar || !article) return;

    function onScroll() {
        const rect = article.getBoundingClientRect();
        const total = article.scrollHeight - window.innerHeight;
        const scrolled = Math.min(Math.max(window.scrollY - (article.offsetTop || 0), 0), total);
        const pct = total > 0 ? (scrolled / total) * 100 : 0;
        bar.style.width = pct + '%';
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    onScroll();
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

// ==========================
// Read-Aloud (TTS) Feature
// ==========================
// Read-Aloud (Text-to-Speech) - Fixed to preserve HTML formatting
// ==========================
function initArticleTTS() {
    if (!('speechSynthesis' in window)) {
        return; // TTS not supported
    }

    const contentContainer = document.querySelector('.article-content .content-body');
    const toggleBtn = document.getElementById('ttsToggle');
    const icon = document.getElementById('ttsIcon');
    const voiceSelect = document.getElementById('ttsVoice');
    const rateSelect = document.getElementById('ttsRate');

    if (!contentContainer || !toggleBtn || !voiceSelect || !rateSelect) {
        return;
    }

    // Get text for TTS WITHOUT modifying HTML structure
    const plain = contentContainer.innerText.trim();
    const sentences = plain
        .split(/([.!?])\s+/)
        .reduce((acc, part, idx, arr) => {
            if (idx % 2 === 0) {
                const nextPunct = arr[idx + 1] || '';
                const sentence = (part + nextPunct).trim();
                if (sentence.length > 0) acc.push(sentence);
            }
            return acc;
        }, []);

    // Speech state
    let currentIndex = 0;
    let isPlaying = false;
    let voices = [];

    function populateVoices() {
        voices = window.speechSynthesis.getVoices();
        voiceSelect.innerHTML = '';
        voices.forEach((v, i) => {
            const opt = document.createElement('option');
            opt.value = i;
            opt.textContent = `${v.name} (${v.lang})${v.default ? ' - default' : ''}`;
            voiceSelect.appendChild(opt);
        });
        // Prefer Indonesian or English
        const preferred = voices.findIndex(v => /^id/i.test(v.lang))
            ?? voices.findIndex(v => /^en/i.test(v.lang));
        if (preferred >= 0) voiceSelect.value = preferred;
    }

    populateVoices();
    window.speechSynthesis.onvoiceschanged = function() {
        const prev = voiceSelect.value;
        populateVoices();
        if ([...voiceSelect.options].some(o => o.value === prev)) {
            voiceSelect.value = prev;
        }
    };

    function speakSentence(index) {
        if (index < 0 || index >= sentences.length) {
            stopTTS();
            return;
        }
        
        // Simple visual indicator without modifying HTML
        contentContainer.style.backgroundColor = '#fff9e6';
        
        const utter = new SpeechSynthesisUtterance(sentences[index]);
        const rate = parseFloat(rateSelect.value || '1');
        utter.rate = rate;
        const v = voices[parseInt(voiceSelect.value, 10)];
        if (v) utter.voice = v;

        utter.onend = () => {
            contentContainer.style.backgroundColor = '';
            if (!isPlaying) return;
            currentIndex += 1;
            if (currentIndex < sentences.length) {
                speakSentence(currentIndex);
            } else {
                stopTTS();
            }
        };

        window.speechSynthesis.speak(utter);
    }

    function playTTS() {
        if (isPlaying) return;
        isPlaying = true;
        icon.classList.remove('fa-play');
        icon.classList.add('fa-pause');
        speakSentence(currentIndex);
        showToast('Reading started', 'success');
    }

    function pauseTTS() {
        isPlaying = false;
        window.speechSynthesis.cancel();
        icon.classList.remove('fa-pause');
        icon.classList.add('fa-play');
        showToast('Paused', 'info');
    }

    function stopTTS() {
        isPlaying = false;
        window.speechSynthesis.cancel();
        icon.classList.remove('fa-pause');
        icon.classList.add('fa-play');
        currentIndex = 0;
        contentContainer.style.backgroundColor = '';
    }

    // Toggle play/pause
    toggleBtn.addEventListener('click', function() {
        if (!isPlaying) {
            playTTS();
        } else {
            pauseTTS();
        }
    });

    // Live apply dropdown changes
    voiceSelect.addEventListener('change', function(){
        if (isPlaying) {
            window.speechSynthesis.cancel();
            speakSentence(currentIndex);
        }
    });
    rateSelect.addEventListener('change', function(){
        if (isPlaying) {
            window.speechSynthesis.cancel();
            speakSentence(currentIndex);
        }
    });
}

// ==========================
// Focus Mode
// ==========================
function initFocusMode() {
    const btn = document.getElementById('focusToggle');
    const pageContainer = document.querySelector('.page-container');
    if (!btn || !pageContainer) return;

    // initialize state
    btn.setAttribute('aria-pressed', 'false');

    btn.addEventListener('click', function() {
        document.body.classList.toggle('focus-mode');
        const isOn = document.body.classList.contains('focus-mode');
        showToast(isOn ? 'Focus Mode On' : 'Focus Mode Off', 'info');

        // reflect state on button (icon, label, aria)
        btn.setAttribute('aria-pressed', isOn ? 'true' : 'false');
        const icon = btn.querySelector('i');
        const label = btn.querySelector('span');
        if (icon) {
            icon.className = isOn ? 'fas fa-eye' : 'fas fa-eye-slash';
        }
        if (label) {
            label.textContent = isOn ? 'Exit Focus' : 'Focus Mode';
        }
    });
    // Keyboard shortcut: F toggles focus
    document.addEventListener('keydown', function(e){
        if (e.key && e.key.toLowerCase() === 'f' && !e.ctrlKey && !e.metaKey && !e.altKey) {
            btn.click();
        }
    });
}

// Removed follow category feature per cleanup