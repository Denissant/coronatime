const SUCCESS_CLASSES = ['border-brand-green', 'focus:border-brand-green', 'focus:outline-brand-lightgreen'];

const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const repeatPasswordInput = document.getElementById('password_confirmation');

if (usernameInput && emailInput) {
    usernameInput.addEventListener('input', () => validateInput(usernameInput, longerThanThree));
    emailInput.addEventListener('input', () => validateInput(emailInput, isEmail));
}
passwordInput.addEventListener('input', () => validateInput(passwordInput, longerThanThree));
repeatPasswordInput.addEventListener('input', () => validateInput(repeatPasswordInput, matchesPassword));

function validateInput(inputElement, validationCallback) {
    const successMark = inputElement.parentElement.querySelector('img');

    if (validationCallback(inputElement.value)) {
        successMark.hidden = false;
        inputElement.classList.add(...SUCCESS_CLASSES);
    } else {
        successMark.hidden = true;
        inputElement.classList.remove(...SUCCESS_CLASSES);
    }
}

const longerThanThree = value => value.length > 2;
const isEmail = value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
const matchesPassword = value => passwordInput.value === value;
