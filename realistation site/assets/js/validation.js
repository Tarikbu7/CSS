document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form[data-validate]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const requiredFields = form.querySelectorAll('[required]');
            for (const field of requiredFields) {
                if (field.value.trim() === '') {
                    alert('Veuillez remplir tous les champs obligatoires.');
                    field.focus();
                    event.preventDefault();
                    return;
                }
            }

            const email = form.querySelector('input[type="email"]');
            if (email && !email.value.includes('@')) {
                alert('Veuillez entrer un email valide.');
                email.focus();
                event.preventDefault();
            }
        });
    });
});
