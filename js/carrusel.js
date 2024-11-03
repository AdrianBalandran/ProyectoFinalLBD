var carousel = document.getElementById('carouselExample'); // Cambia 'carouselExample' por el id de tu carrusel

// Iniciar el carrusel
var bootstrapCarousel = new bootstrap.Carousel(carousel, {
    interval: 8000, // Cambia cada 8 segundos
    wrap: true
});