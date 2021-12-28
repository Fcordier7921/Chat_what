const burger = document.querySelector('.burger');
const login = document.querySelector('.login');
const buger = document.querySelector('.burger');

burger.addEventListener('click', () => {

    if (login.classList.contains('loginActive')) {
        login.classList.remove('loginActive');
        buger.classList.remove('active');

    } else {
        login.classList.add('loginActive');
        buger.classList.add('active');
    }
})