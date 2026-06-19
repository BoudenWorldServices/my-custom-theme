document.addEventListener('DOMContentLoaded', function () {
    var header = document.querySelector('header');
    var toggle = document.querySelector('[data-mobile-menu-toggle]');
    var menu = document.querySelector('[data-mobile-menu]');
    var lastScrollY = window.scrollY || 0;
    var ticking = false;
    var scrollThreshold = 8;

    function isMenuOpen() {
        return !!menu && !menu.classList.contains('hidden');
    }

    function showHeader() {
        if (!header) return;
        header.classList.remove('-translate-y-full');
    }

    function hideHeader() {
        if (!header) return;
        header.classList.add('-translate-y-full');
    }

    function handleHeaderOnScroll() {
        var currentY = window.scrollY || 0;
        var delta = currentY - lastScrollY;

        // Always show near top and while mobile menu is open.
        if (currentY <= 12 || isMenuOpen()) {
            showHeader();
        } else if (Math.abs(delta) > scrollThreshold) {
            if (delta > 0) {
                hideHeader();
            } else {
                showHeader();
            }
        }

        lastScrollY = currentY;
        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (ticking) return;
        ticking = true;
        window.requestAnimationFrame(handleHeaderOnScroll);
    }, { passive: true });

    // Initialize visible state.
    showHeader();

    function closeMenu() {
        if (!menu || !toggle) return;
        menu.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
        showHeader();
    }

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var isOpen = !menu.classList.contains('hidden');
            if (isOpen) {
                closeMenu();
            } else {
                menu.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
                showHeader();
            }
        });

        menu.querySelectorAll('[data-mobile-menu-link]').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });
    }

    document.querySelectorAll('[data-dropdown]').forEach(function (dropdown) {
        var panel = dropdown.querySelector('[data-dropdown-menu]');
        var chevron = dropdown.querySelector('[data-dropdown-chevron]');
        if (!panel) return;

        dropdown.addEventListener('mouseenter', function () {
            panel.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
        });
        dropdown.addEventListener('mouseleave', function () {
            panel.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        });
    });
});
