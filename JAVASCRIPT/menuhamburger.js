/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window: false */

function Hamburger() {
    "use strict";
    var i = 0, elements = document.getElementsByClassName("hamburger"), ul = document.getElementById("PrincipalMenu");
    for (i = 0; i < elements.length; i = i + 1) {
        if (elements[i].style.display === "none" || elements[i].style.display === "") {
            elements[i].style.display = "grid";
            ul.style.display = "grid";
        } else {
            elements[i].style.display = "none";
            ul.style.display = "grid";
        }
    }
}

function closeHamburger() {
    "use strict";
    var i = 0, elements = document.getElementsByClassName("hamburger"), ul = document.getElementById("PrincipalMenu");
    for (i = 0; i < elements.length; i = i + 1) {
        if (elements[i].style.display === "grid") {
            elements[i].style.display = "none";
            ul.style.display = "none";
        }
    }
}

window.onresize = function () {
    "use strict";
    var m = 0, l = 0, element = document.getElementsByClassName("hamburger"), ul = document.getElementById("PrincipalMenu");
    if (window.innerWidth <= 600) {
        for (l = 0; l < element.length; l = l + 1) {
            element[l].style.display = "none";
            ul.style.display = "none";
        }
    } else {
        for (m = 0; m < element.length; m = m + 1) {
            element[m].style.display = "inline";
            ul.style.display = "inline";
        }
    }
};

//la prima funzione serve per far apparire e sparire il menu quando si clicca sull'immagine dell'hamburger. Dalla riga 15 in poi c'é il controllo delle dimensioni dello schermo per non far andare in conflitto il css del menú ad hamburger con il css del dekstop
//la riga quattro serve per evitare di usare variabili non dichiarate, cosí si ha codice piú pulito
