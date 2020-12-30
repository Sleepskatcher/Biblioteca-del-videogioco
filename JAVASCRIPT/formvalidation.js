/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window */

//pagina login
function loadLogin() {
    "use strict";
    document.getElementById("ConfirmButton").disabled = true;
}

function validateFormUsername() {
    "use strict";
    var text, username = document.getElementById("UsernameLogin").value;
    if (username === "") {
        text = "Completa questo campo";
    }
    document.getElementById("AvvisoUs").innerHTML = text;
    if (username !== "") {
        document.getElementById("AvvisoUs").innerHTML = "";
        if (document.getElementById("PasswordLogin").value !== "") {
            if (document.getElementById("PasswordLogin").value.length >= 5) {
                document.getElementById("ConfirmButton").disabled = false;
            }
        }
    }
}

function validateFormPassword() {
    "use strict";
    var avviso, password = document.getElementById("PasswordLogin").value, lunghezza = document.getElementById("PasswordLogin").value.length;
    if (password === "") {
        avviso = "Completa questo campo";
    }
    document.getElementById("AvvisoPw").innerHTML = avviso;
    if (password !== "") {
        if (lunghezza < 5) {
            avviso = "Password troppo corta";
            document.getElementById("AvvisoPw").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoPw").innerHTML = "";
            if (document.getElementById("UsernameLogin").value !== "") {
                document.getElementById("ConfirmButton").disabled = false;
            }
        }
    }
}

//pagina registrazione
function loadRegistration() {
    "use strict";
    document.getElementById("ConfirmButtonR").disabled = true;
}

function controlButtonReg() {
    "use strict";
    var name = document.getElementById("name").value, surname = document.getElementById("surname").value, username = document.getElementById("username").value, password = document.getElementById("password").value, passlungh = document.getElementById("password").value.length, passconf = document.getElementById("passwordconfirmed").value, email = document.getElementById("email").value, mailmatch = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if (name !== "" && surname !== "" && username !== "" && email !== "" && mailmatch.test(email) === true && password !== "" && passlungh >= 5 && passconf !== "" && password === passconf) {
        return false;
    }
    return true;
}

function validateFormName() {
    "use strict";
    var text, name = document.getElementById("name").value;
    if (name === "") {
        text = "Completa questo campo";
    }
    document.getElementById("Avvisonome").innerHTML = text;
    if (name !== "") {
        document.getElementById("Avvisonome").innerHTML = "";
        document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
    }
}

function validateFormSurname() {
    "use strict";
    var text, surname = document.getElementById("surname").value;
    if (surname === "") {
        text = "Completa questo campo";
    }
    document.getElementById("Avvisocognome").innerHTML = text;
    if (surname !== "") {
        document.getElementById("Avvisocognome").innerHTML = "";
        document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
    }
}

function validateFormUsernameReg() {
    "use strict";
    var text, username = document.getElementById("username").value;
    if (username === "") {
        text = "Completa questo campo";
    }
    document.getElementById("Avvisousername").innerHTML = text;
    if (username !== "") {
        document.getElementById("Avvisousername").innerHTML = "";
        document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
    }
}

function validateFormPasswordReg() {
    "use strict";
    var avviso, password = document.getElementById("password").value, lunghezza = document.getElementById("password").value.length;
    if (password === "") {
        avviso = "Completa questo campo";
    }
    document.getElementById("Avvisopass").innerHTML = avviso;
    if (password !== "") {
        if (lunghezza < 5) {
            avviso = "Password troppo corta";
            document.getElementById("Avvisopass").innerHTML = avviso;
        } else {
            document.getElementById("Avvisopass").innerHTML = "";
            document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
        }
    }
}

function validateFormConfPassword() {
    "use strict";
    var avviso, password = document.getElementById("passwordconfirmed").value;
    if (password === "") {
        avviso = "Completa questo campo";
        document.getElementById("Avvisoconfermapass").innerHTML = avviso;
    }
    if (password !== "") {
        if (password !== document.getElementById("password").value) {
            avviso = "Le password non combaciano";
            document.getElementById("Avvisoconfermapass").innerHTML = avviso;
        } else {
            document.getElementById("Avvisoconfermapass").innerHTML = "";
            document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
        }
    }
}

function validateFormemail() {
    "use strict";
    var avviso, email = document.getElementById("email").value, matchemail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if (email === "") {
        avviso = "Completa questo campo";
    }
    document.getElementById("Avvisoemail").innerHTML = avviso;
    if (email !== "") {
        if (matchemail.test(email) === false) {
            avviso = "Email inserita non valida";
            document.getElementById("Avvisoemail").innerHTML = avviso;
        } else {
            document.getElementById("Avvisoemail").innerHTML = "";
            document.getElementById("ConfirmButtonR").disabled = controlButtonReg();
        }
    }
}

//pagina dell'utente

function loadUser() {
    "use strict";
    document.getElementById("ConfirmButtonUserPage").disabled = true;
}

function buttoncontroluser() {
    "use strict";
    var password = document.getElementById("AccountChangePassword").value, confpassword = document.getElementById("AccountConfirmChangePassword").value, email = document.getElementById("AccountChangeEmail").value, match = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if (password !== "" && password >= 5 && confpassword !== "" && confpassword === password && match.test(email) === true) {
        return false;
    }
    return true;
}

function validateFormutentepass() {
    "use strict";
    var avviso, control = document.getElementById("AccountPassword").value, password = document.getElementById("AccountChangePassword").value;
    if (password === "" || password === control) {
        avviso = "Completa correttamente questo campo";
    }
    document.getElementById("AvvisoChangePassword").innerHTML = avviso;
    if (password !== "" && password !== control) {
        if (password.length < 5) {
            avviso = "Password troppo corta";
            document.getElementById("AvvisoChangePassword").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoChangePassword").innerHTML = "";
            document.getElementById("ConfirmButtonUserPage").disabled = buttoncontroluser();
        }
    }
}

function confirmChangePass() {
    "use strict";
    var avviso, confpassword = document.getElementById("AccountConfirmChangePassword").value, passcontrol = document.getElementById("AccountChangePassword").value;
    if (confpassword === "") {
        avviso = "Completa questo campo";
        document.getElementById("AvvisoControlPass").innerHTML = avviso;
    }
    if (confpassword !== "") {
        if (confpassword !== passcontrol) {
            avviso = "Le password non combaciano";
            document.getElementById("AvvisoControlPass").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoControlPass").innerHTML = "";
            document.getElementById("ConfirmButtonUserPage").disabled = buttoncontroluser();
        }
    }
}

function controlChangeemail() {
    "use strict";
    var avviso, control = document.getElementById("AccountEmail").value, email = document.getElementById("AccountChangeEmail").value, match = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
    if (email === "" || email === control) {
        avviso = "Completa correttamente questo campo";
        document.getElementById("AvvisoChangemail").innerHTML = avviso;
    }
    if (email !== "" && email !== control) {
        if (match.test(email) === false) {
            avviso = "Email inserita non valida";
            document.getElementById("AvvisoChangemail").innerHTML = avviso;
        } else {            document.getElementById("AvvisoChangemail").innerHTML = "";            document.getElementById("ConfirmButtonUserPage").disabled = buttoncontroluser();
               }
    }
}

/*pagina modifica prenotazione*/

function loadPr() {
    "use strict";
    if (document.getElementById("ButtonDate") === null) {
        return;
    }
    document.getElementById("ButtonDate").disabled = true;
}

function controlDatePr() {
    "use strict";
    var avviso, data = document.getElementById("ListPagePickUpDate").value;
    if (data === "") {
        avviso = "Completa questo campo";
        document.getElementById("AvvisoDatePr").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDatePr").innerHTML = "";
        document.getElementById("ButtonDate").disabled = false;
    }
}

function controlDateDv() {
    "use strict";
    var avviso, data = document.getElementById("ListPageDeliverDate").value;
    if (data === "") {
        avviso = "Completa questo campo";
        document.getElementById("AvvisoDateDv").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDateDv").innerHTML = "";
        if (document.getElementById("ListPagePickUpDate").value === "") {
            document.getElementById("ButtonDate").disabled = false;
        }
    }
}
