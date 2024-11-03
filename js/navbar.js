document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
        link.addEventListener('click', function() {
            // Quitar la clase active de todos los enlaces
            links.forEach(l => l.classList.remove('active'));
            // Añadir la clase active al enlace que fue clicado
            this.classList.add('active');
        });
    });
});