document.addEventListener("DOMContentLoaded", function() {
    eventListeners();
    darkMode();  
}); // When the document is loaded the function a function will start

function darkMode() {
    const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    // console.log(prefersDarkMode.matches);

    if(prefersDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode")
    };

    prefersDarkMode.addEventListener("change", function() {
        if(prefersDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode")
        };
    });

    const darkModeButton = document.querySelector(".dark-mode-button");

    darkModeButton.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
    });
};

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", responsiveNavigation);

    //Shows aditional fields

    const contactMethod = document.querySelectorAll('input[name="contact[contact]"]');

    contactMethod.forEach(input => input.addEventListener("click", showContactMethods));
}; // The function waits for an event, in this case a click in the object that has the selected class

function responsiveNavigation() {
    const navigation = document.querySelector(".navigation");
    navigation.classList.toggle("show");

    // if(navigation.classList.contains("show")) {
    //     navigation.classList.remove("show");
    // } else {
    //     navigation.classList.add("show");
    // }; This is the same as the toggle
};

function showContactMethods(e) {
    const contactDiv = document.querySelector("#contact");

    if(e.target.value === "phone") {
        contactDiv.innerHTML = `
            <label for="phone">Phone Number:</label>
            <input type="tel" placeholder="Your Phone Number" id="phone" name="contact[phone]">

            <p>Please chose a date and time to be contacted</p>

            <label for="date">Date:</label>
            <input type="date" id="date" name="contact[date]">

            <label for="time">Time:</label>
            <input type="time" id="time" name="contact[time]">
        `
    } else {
        contactDiv.innerHTML = `
            <label for="email">E-mail:</label>
            <input type="email" placeholder="Your E-mail" id="email" name="contact[email]">
        `
    };
}