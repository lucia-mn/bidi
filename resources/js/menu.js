document.addEventListener('DOMContentLoaded', () => {
    const boton = document.getElementById('menuToggle');
    const menu = document.querySelector('.botones-header');

    if (!boton || !menu) return;

    boton.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
});