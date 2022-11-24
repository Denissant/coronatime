const burgerButton = document.getElementById('burger-button');
const burgerMenu = document.getElementById('burger-menu');
const burgerWrapper = document.getElementById('burger-wrapper');

burgerButton.addEventListener('click', () => {
    if (burgerMenu.classList.contains('invisible')) {
        burgerMenu.classList.remove('invisible', 'opacity-0', 'scale-0');
    } else {
        burgerMenu.classList.add('invisible', 'opacity-0', 'scale-0');
    }
});

window.addEventListener('click', e => {
    if (!burgerWrapper.contains(e.target)) {
        burgerMenu.classList.add('invisible', 'opacity-0', 'scale-0');
    }
});
