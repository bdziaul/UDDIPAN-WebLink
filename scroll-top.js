// scroll-top.js - UDDIPAN Weblink Scroll to Top
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        
        if (!scrollToTopBtn) {
            console.warn('⚠️ Scroll to Top button not found!');
            return;
        }
        
        // Add show/hide class instead of inline style
        scrollToTopBtn.classList.add('scroll-btn');
        
        // Show/Hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });
        
        // Smooth scroll to top when clicked
        scrollToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Check for smooth scrolling support
            if ('scrollBehavior' in document.documentElement.style) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } else {
                // Fallback for older browsers
                smoothScrollTop();
            }
        });
        
        // Smooth scroll fallback
        function smoothScrollTop() {
            const duration = 500; // ms
            const start = window.pageYOffset;
            const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();
            
            function scroll() {
                const now = 'now' in window.performance ? performance.now() : new Date().getTime();
                const time = Math.min(1, ((now - startTime) / duration));
                const ease = easeInOutQuad(time);
                window.scrollTo(0, start * (1 - ease));
                
                if (time < 1) {
                    requestAnimationFrame(scroll);
                }
            }
            
            function easeInOutQuad(t) {
                return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
            }
            
            requestAnimationFrame(scroll);
        }
        
        // Keyboard shortcut (Alt + Up Arrow)
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 'ArrowUp') {
                e.preventDefault();
                scrollToTopBtn.click();
            }
        });
        
        // Progress indicator in button
        function updateScrollProgress() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            
            // Optional: Add progress ring or percentage
            if (scrollToTopBtn.querySelector('.scroll-progress')) {
                scrollToTopBtn.querySelector('.scroll-progress').style.width = scrolled + '%';
            }
        }
        
        window.addEventListener('scroll', updateScrollProgress);
        
        console.log('✅ Scroll to Top functionality loaded');
    });
})();