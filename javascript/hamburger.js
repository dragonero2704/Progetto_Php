let hamburger = document.getElementById('hamburger');
let menu = document.getElementById('menu');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('reverse');
    hamburger.classList.toggle('active');

    menu.classList.toggle('active');
})