function registerFormValidation() {
    const email = document.getElementById("email");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const rep_password = document.getElementById("password-rep");

    const emailAlert = document.getElementById('emailAlert');
    const usernameAlert = document.getElementById("usernameAlert");
    const passwordAlert = document.getElementById("passwordAlert");
    const passwordRepAlert = document.getElementById("passwordRepAlert");

    if (username.value === "") {
        usernameAlert.innerText = "Please enter your username";
        username.focus();
        return false;

    } else {
        usernameAlert.innerText = "";
    }

    if (email.value === "") {
        emailAlert.innerText = "Please enter your email address";
        email.focus();
        return false;

    } else {
        emailAlert.innerText = "";
    }


    if (password.value === "") {
        passwordAlert.innerText = "Please enter your password";
        password.focus();
        return false;
    } else {
        passwordAlert.innerText = "";
    }

    if (password.value.length < 6) {
        passwordAlert.innerText = "Your password must be more than 6 character";
        password.focus();
        return false;
    } else {
        passwordAlert.innerText = "";
    }

    if (rep_password.value === "" || rep_password.value !== password.value) {
        passwordRepAlert.innerText = "Your passwords not match!";
        rep_password.focus();
        return false;
    } else {
        passwordRepAlert.innerText = "";
    }

    return true;
}

function loginFormValidation() {
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    const usernameAlert = document.getElementById("usernameAlert");
    const passwordAlert = document.getElementById("passwordAlert");

    if (username.value === "") {
        usernameAlert.innerText = "Please enter your username";
        username.focus();
        return false;

    } else {
        usernameAlert.innerText = "";
    }


    if (password.value === "") {
        passwordAlert.innerText = "Please enter your password";
        password.focus();
        return false;
    } else {
        passwordAlert.innerText = "";
    }

    return true;
}


