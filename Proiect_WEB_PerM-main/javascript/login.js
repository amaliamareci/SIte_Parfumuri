function setFormMessage(formElement, type, message) {
    const messageElement = formElement.querySelector(".form__message");

    messageElement.textContent = message;
    messageElement.classList.remove("form__message--success", "form__message--error");
    messageElement.classList.add(`form__message--${type}`);
}

function setInputError(inputElement, message) {
    inputElement.classList.add("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;
}

function clearInputError(inputElement) {
    inputElement.classList.remove("form__input--error");
    inputElement.parentElement.querySelector(".form__input-error-message").textContent = "";
}

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");
    const resetPasswordForm = document.querySelector("#change_password");
    const logged = document.getElementById("loggedUserInfo");

    if(localStorage.getItem('token') != '') {
        console.log('logat');
        loginForm.classList.add("form--hidden");
        resetPasswordForm.classList.add("form--hidden");
        createAccountForm.classList.add("form--hidden");
        logged.classList.remove("form--hidden");
        document.getElementById("loggedUser__info").innerHTML = "Esti logat ca: " + localStorage.getItem('user');
        document.getElementById("logout_button").addEventListener("click", e => {
            e.preventDefault();
            localStorage.setItem('user', '');
            localStorage.setItem('token', '');
            loginForm.classList.remove("form--hidden");
            logged.classList.add("form--hidden");
        })
    } else {
        console.log('nelogat');
    }

    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        resetPasswordForm.classList.add("form--hidden");
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
        logged.classList.add("form--hidden");
    });

    document.querySelector("#linkLogin").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        resetPasswordForm.classList.add("form--hidden");
        createAccountForm.classList.add("form--hidden");
        logged.classList.add("form--hidden");
    });

    document.querySelector("#linkLoginFromChangePass").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        resetPasswordForm.classList.add("form--hidden");
        createAccountForm.classList.add("form--hidden");
        logged.classList.add("form--hidden");
    });

    document.querySelector("#changePassLink").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.add("form--hidden");
        resetPasswordForm.classList.remove("form--hidden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();

        var user = document.getElementById("user").value;
        var pass = document.getElementById("pass").value;

        let formData = new FormData();
        formData.append('username', user);
        formData.append('password', pass);

        localStorage.setItem('user', user);

        const Url = "https://web-perm.herokuapp.com/api/v1/pages/login.php";

        const params = {
            body: formData,
            method: "POST"
        }

        fetch(Url, params)
            .then(function (data) {
                return data.text();
            }).then(function (res) {
                localStorage.setItem('token', res);
                if (res == '') {
                    setFormMessage(loginForm, "error", "Username sau parola incorecte!");
                } else {
                    setFormMessage(loginForm, "success", "Logare cu succes!");
                }
            });
    });

    createAccountForm.addEventListener("submit", e => {
        e.preventDefault();

        var user = document.getElementById("signupUsername").value;
        var email = document.getElementById("signupEmail").value;
        var pass = document.getElementById("signupPassword").value;
        var passConfirm = document.getElementById("signupConfirmPassword").value;
        var firstname = document.getElementById("signupFirstName").value;
        var lastname = document.getElementById("signupLastName").value;
        var gender;
        if (document.querySelectorAll('input[name="signupGender"]')[0].checked)
            gender = 'femeie';
        else if (!document.querySelectorAll('input[name="signupGender"]')[0].checked)
            gender = 'barbat';
        var address = document.getElementById("signupAddress").value;
        var birthday = document.getElementById("signupBirthday").value;

        if (pass != passConfirm)
            setFormMessage(createAccountForm, "error", "Parolele nu coincid!");
        else {
            const Url = "https://web-perm.herokuapp.com/api/v1/pages/register.php";
            const Data = {
                username: user,
                password: pass,
                email: email,
                firstname: firstname,
                lastname: lastname,
                gender: gender,
                address: address,
                birthday: birthday
            }

            const params = {
                headers: {
                    "content-type": "application/json; charset=UTF-8"
                },
                body: JSON.stringify(Data),
                method: "PUT"
            }

            fetch(Url, params)
                .then(function (data) {
                    return data.json();
                }).then(function (res) {
                    setFormMessage(createAccountForm, "success", "Ai fost inregistrat!");
                }).catch((error) => {
                    setFormMessage(createAccountForm, "error", "Username-ul exista deja!");
                });
        }
    }
    )
    
    resetPasswordForm.addEventListener("submit", e => {
        e.preventDefault();

        var user = document.getElementById("changeUser").value;
        var password_old = document.getElementById("pass_old").value;
        var password_new = document.getElementById("pass_new").value;

        if (password_old == password_new)
            setFormMessage(resetPasswordForm, "error", "Parola veche este aceeasi cu cea noua!!");
        else {
            const Url = "https://web-perm.herokuapp.com/api/v1/pages/register.php";
            const Data = {
                username: user,
                password_old: password_old,
                password_new: password_new
            }

            const params = {
                headers: {
                    "content-type": "application/json; charset=UTF-8"
                },
                body: JSON.stringify(Data),
                method: "PATCH"
            }

            fetch(Url, params)
                .then(function (data) {
                    return data.json();
                }).then(function (res) {
                    setFormMessage(resetPasswordForm, "success", "Parola schimbata!");
                }).catch((error) => {
                    setFormMessage(resetPasswordForm, "error", "Parola nu poate fi schimbata!");
                });
        }
    }
    )

    document.querySelectorAll(".form__input").forEach(inputElement => {
        inputElement.addEventListener("blur", e => {
            if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 5) {
                setInputError(inputElement, "Username must be at least 5 characters in length");
            }
        });

        inputElement.addEventListener("input", e => {
            clearInputError(inputElement);
        });
    });
});