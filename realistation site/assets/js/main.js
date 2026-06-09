document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('[data-menu-toggle]');
    const navLinks = document.querySelector('[data-nav-links]');
    if (menuButton && navLinks) {
        menuButton.addEventListener('click', () => navLinks.classList.toggle('open'));
    }

    document.querySelectorAll('[data-close-alert]').forEach((button) => {
        button.addEventListener('click', () => button.closest('[data-alert]').remove());
    });

    document.querySelectorAll('[data-confirm]').forEach((link) => {
        link.addEventListener('click', (event) => {
            if (!confirm(link.dataset.confirm || 'Confirmer cette action ?')) {
                event.preventDefault();
            }
        });
    });
});
