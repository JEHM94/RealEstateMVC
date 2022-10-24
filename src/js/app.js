document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', responsiveNavigation);

    // Show inputs with radio button
    const contactMethod = document.querySelectorAll('input[name="contact[contact]"]');
    contactMethod.forEach(input => input.addEventListener('click', showContactMethod));
}

function showContactMethod(e) {
    const contactDiv = document.querySelector('#contact');

    if (e.target.value === 'Telefono') {

        contactDiv.innerHTML = `
        <label for="inputPhone">Ingrese su Número Telefónico</label>
        <input id="inputPhone" type="tel" placeholder="+581234567" name="contact[phone]">
        
        <p>El día:</p>
        <label for="inputDate">Fecha</label>
        <input id="inputDate" type="date" name="contact[date]">

        <p>A las:</p>
        <label for="inputTime">Hora</label>
        <input id="inputTime" type="time" min="09:00" max="18:00" name="contact[time]">
        
        `;
    } else {
        contactDiv.innerHTML = `
        <label for="inputEmail">E-mail</label>
        <input id="inputEmail" type="email" placeholder="correo@email.com" name="contact[email]" required>
        `;
    }
}

function responsiveNavigation() {
    const navigation = document.querySelector('.navigation');
    const right = document.querySelector('.right');

    navigation.classList.toggle('show');
    right.classList.toggle('show');
}

function darkMode() {
    const buttonDarkMode = document.querySelector('.dark-mode-btn');
    const darkModePreference = window.matchMedia('(prefers-color-scheme: dark)');

    darkModePreference.addEventListener('change', setDarkModePreference(darkModePreference.matches));

    setDarkModePreference(darkModePreference.matches)

    function setDarkModePreference(isSystemDark) {
        if (isSystemDark) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    }

    buttonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark');
    });
}