/**
 * Table Scroll Indicator Manager
 * Manages horizontal scroll indicators for tables with overflow content
 */

class TableScrollIndicator {
    constructor() {
        this.indicators = new Map();
        this.isFirstInteraction = true;
        this.resizeTimeout = null;
        this.init();
        this.setupResizeListener();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupIndicators());
        } else {
            this.setupIndicators();
        }

        // Handle window resize
        window.addEventListener('resize', () => this.handleResize());
    }

    setupIndicators() {
        // Find all table containers that need scroll indicators
        const tableContainers = document.querySelectorAll('.table-responsive-custom, .table-responsive');
        
        tableContainers.forEach(container => {
            this.createIndicatorForTable(container);
        });
    }

    createIndicatorForTable(container) {
        const tableId = container.id || `table-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
        container.id = tableId;

        // Create wrapper if not exists
        if (!container.parentElement.classList.contains('scroll-indicator-container')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'scroll-indicator-container';
            container.parentElement.insertBefore(wrapper, container);
            wrapper.appendChild(container);
        }

        const wrapper = container.parentElement;

        // Create scroll hint (disabled per user request)
        const scrollHint = document.createElement('div');
        scrollHint.className = 'scroll-hint';
        scrollHint.style.display = 'none'; // Always hidden
        wrapper.insertBefore(scrollHint, container);

        // Create shadow indicators
        const shadowRight = document.createElement('div');
        shadowRight.className = 'scroll-shadow-right';
        container.appendChild(shadowRight);

        const shadowLeft = document.createElement('div');
        shadowLeft.className = 'scroll-shadow-left';
        container.appendChild(shadowLeft);

        // Create enhanced arrow indicators
        const arrowRight = document.createElement('div');
        arrowRight.className = 'scroll-arrow scroll-arrow-right';
        arrowRight.innerHTML = '▶'; // Use solid triangle arrow for perfect centering
        arrowRight.setAttribute('role', 'button');
        arrowRight.setAttribute('aria-label', 'Scroll table right to see more columns');
        arrowRight.setAttribute('tabindex', '0');
        arrowRight.setAttribute('title', 'Scroll right');
        
        // Add enhanced interactions
        arrowRight.addEventListener('click', (e) => {
            e.preventDefault();
            this.scrollTable(container, 'right');
            this.addClickFeedback(arrowRight);
        });
        
        arrowRight.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.scrollTable(container, 'right');
                this.addClickFeedback(arrowRight);
            }
        });
        
        container.appendChild(arrowRight);

        const arrowLeft = document.createElement('div');
        arrowLeft.className = 'scroll-arrow scroll-arrow-left';
        arrowLeft.innerHTML = '◀'; // Use solid triangle arrow for perfect centering
        arrowLeft.setAttribute('role', 'button');
        arrowLeft.setAttribute('aria-label', 'Scroll table left to see previous columns');
        arrowLeft.setAttribute('tabindex', '0');
        arrowLeft.setAttribute('title', 'Scroll left');
        
        // Add enhanced interactions
        arrowLeft.addEventListener('click', (e) => {
            e.preventDefault();
            this.scrollTable(container, 'left');
            this.addClickFeedback(arrowLeft);
        });
        
        arrowLeft.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.scrollTable(container, 'left');
                this.addClickFeedback(arrowLeft);
            }
        });
        
        container.appendChild(arrowLeft);

        // Store indicator elements
        this.indicators.set(tableId, {
            container,
            wrapper,
            scrollHint,
            shadowRight,
            shadowLeft,
            arrowRight,
            arrowLeft
        });

        // Add scroll listener
        container.addEventListener('scroll', () => this.handleScroll(tableId));

        // Initial check
        this.updateIndicators(tableId);
    }

    handleScroll(tableId) {
        // Debounce scroll events
        if (this.scrollTimeout) {
            clearTimeout(this.scrollTimeout);
        }
        
        this.scrollTimeout = setTimeout(() => {
            this.updateIndicators(tableId);
        }, 10);
    }

    updateIndicators(tableId) {
        const indicators = this.indicators.get(tableId);
        if (!indicators) return;

        const { container, scrollHint, shadowRight, shadowLeft, arrowRight, arrowLeft } = indicators;
        
        const scrollLeft = container.scrollLeft;
        const scrollWidth = container.scrollWidth;
        const clientWidth = container.clientWidth;
        const maxScrollLeft = scrollWidth - clientWidth;

        // Check if scrolling is needed
        const needsScroll = scrollWidth > clientWidth;

        if (!needsScroll) {
            // Hide all indicators if no scrolling needed
            shadowRight.classList.remove('show');
            shadowLeft.classList.remove('show');
            arrowRight.classList.remove('show');
            arrowLeft.classList.remove('show');
            return;
        }

        // Scroll hint disabled per user request - only shadows and arrows remain

        // Show arrows only on desktop (>1024px) - per user request
        const isDesktop = window.innerWidth > 1024;
        
        if (isDesktop) {
            // Show only arrows - shadows disabled per user request
            if (scrollLeft < maxScrollLeft - 10) { // Improved 10px threshold
                // shadowRight.classList.add('show'); // DISABLED
                arrowRight.classList.add('show');
            } else {
                // shadowRight.classList.remove('show'); // DISABLED
                arrowRight.classList.remove('show');
            }

            // Show only left arrows - shadows disabled per user request
            if (scrollLeft > 10) { // Improved 10px threshold
                // shadowLeft.classList.add('show'); // DISABLED
                arrowLeft.classList.add('show');
            } else {
                // shadowLeft.classList.remove('show'); // DISABLED
                arrowLeft.classList.remove('show');
            }
        } else {
            // Hide all arrows on mobile/tablet
            arrowRight.classList.remove('show');
            arrowLeft.classList.remove('show');
        }
    }

    scrollTable(container, direction) {
        const scrollAmount = container.clientWidth * 0.75; // Smooth scroll 75% of visible width
        const currentScroll = container.scrollLeft;
        
        let targetScroll;
        if (direction === 'right') {
            targetScroll = currentScroll + scrollAmount;
        } else {
            targetScroll = Math.max(0, currentScroll - scrollAmount);
        }

        // Enhanced smooth scroll with timing
        container.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });

        // Update indicators after scroll animation
        setTimeout(() => {
            this.updateScrollIndicators(container);
        }, 300);
    }

    addClickFeedback(element) {
        // Add visual feedback while preserving positioning
        element.style.transform = 'translateY(-50%) scale(1.05)';
        element.style.transition = 'all 0.15s cubic-bezier(0.4, 0, 0.2, 1)';
        
        // Add temporary active state
        element.classList.add('clicked');
        
        setTimeout(() => {
            element.style.transform = 'translateY(-50%) scale(1)';
            element.classList.remove('clicked');
        }, 150);
    }

    setupResizeListener() {
        // Listen for window resize to handle responsive behavior
        window.addEventListener('resize', () => this.handleResize(), { passive: true });
    }

    handleResize() {
        // Debounce resize events
        if (this.resizeTimeout) {
            clearTimeout(this.resizeTimeout);
        }
        
        this.resizeTimeout = setTimeout(() => {
            this.indicators.forEach((_, tableId) => {
                this.updateIndicators(tableId);
            });
        }, 250);
    }    // Public method to manually refresh indicators
    refresh() {
        this.indicators.forEach((_, tableId) => {
            this.updateIndicators(tableId);
        });
    }

    // Public method to add indicator to a specific table
    addToTable(selector) {
        const container = document.querySelector(selector);
        if (container && !this.indicators.has(container.id)) {
            this.createIndicatorForTable(container);
        }
    }
}

// Initialize scroll indicators when script loads
window.tableScrollIndicator = new TableScrollIndicator();

// Expose refresh method globally for manual refresh if needed
window.refreshTableScrollIndicators = () => {
    if (window.tableScrollIndicator) {
        window.tableScrollIndicator.refresh();
    }
};