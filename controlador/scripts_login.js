const logregBox = document.querySelector('.logreg-box');
const logingLink = document.querySelector('.login-link');
const registrarLink = document.querySelector('.registrar-link');

registrarLink.addEventListener('click', () => {
            logregBox.classList.add('active');
} );

logingLink.addEventListener('click', () => {
    logregBox.classList.remove('active');
} );