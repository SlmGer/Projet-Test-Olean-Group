const container = document.getElementById('container');
const loginButton = document.getElementById('login');
const signupButton = document.getElementById('signup');

signupButton.addEventListener('click', () => {
    container.classList.add('panel-active');
})

loginButton.addEventListener('click', () => {
    container.classList.remove('panel-active');
})