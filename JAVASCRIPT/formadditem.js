/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window */
//pagina inserimento videogioco

function loadInsert() {
    "use strict";
    if (document.getElementById("ConfirmButtonI") === null) {
        return;
    }
    document.getElementById("ConfirmButtonI").disabled = true;
}

function controlButtonAdd() {
    "use strict";
    var titolo = document.getElementById("VideogameNameA").value, immagine = document.getElementById("VideogameImageA").files, data = document.getElementById("VideogameExitDateA").value, genere = document.getElementById("VideogameKindA").value, descrizione = document.getElementById("VideogameDescriptionA").value, checkxbox360 = document.getElementById("ItemXbox360A").checked, xbox360 = document.getElementById("QXbox360A").value, checkxboxone = document.getElementById("ItemXboxOneA").checked, xboxone = document.getElementById("QXboxOneA").value, checkwii = document.getElementById("ItemWiiA").checked, wii = document.getElementById("QWiiA").value, checkwiiu = document.getElementById("ItemWiiUA").checked, wiiu = document.getElementById("QWiiUA").value, Switch = document.getElementById("QSwitchNA").value, checkswitch = document.getElementById("ItemSwitchNA").checked, checkplay3 = document.getElementById("ItemPlayStation3A").checked, play3 = document.getElementById("QPlayStation3A").value, checkplay4 = document.getElementById("ItemPlayStation4A").checked, play4 = document.getElementById("QPlayStation4A").value;
    if (titolo !== "" && data !== "" && immagine.length === 1 && genere !== "" && descrizione !== "") {
        if ((checkxbox360 === true && (xbox360 !== "0" && xbox360 !== "")) || (checkxboxone === true && (xboxone !== "0" && xboxone !== "")) || (checkwii === true && (wii !== "0" && wii !== "")) || (checkwiiu === true && (wiiu !== "0" && wiiu !== "")) || (checkswitch === true && (Switch !== "0" && Switch !== "")) || (checkplay3 === true && (play3 !== "0" && play3 !== "")) || (checkplay4 === true && (play4 !== "0" && play4 !== ""))) {
            return false;
        }
    }
    return true;
}

function controlTitle() {
    "use strict";
    var avviso, titolo = document.getElementById("VideogameNameA").value;
    if (titolo === "") {
        avviso = "Compila questo campo";
        document.getElementById("AvvisoVideogameTitle").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoVideogameTitle").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function avvisoclickImage() {
    "use strict";
    var avviso;
    avviso = "Inserisci l'immagine";
    document.getElementById("AvvisoImage").innerHTML = avviso;
}

function controlImage() {
    "use strict";
    var avviso, immagine = document.getElementById("VideogameImageA").files;
    if (immagine.length !== 1) {
        avviso = "Inserisci l'immagine";
        document.getElementById("AvvisoImage").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoImage").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function controlDate() {
    "use strict";
    var avviso, data = document.getElementById("VideogameExitDateA").value;
    if (data === "") {
        avviso = "Inserisci una data";
        document.getElementById("AvvisoDate").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDate").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function controlKind() {
    "use strict";
    var avviso, genere = document.getElementById("VideogameKindA").value;
    if (genere === "") {
        avviso = "Completa questo campo";
        document.getElementById("AvvisoKind").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoKind").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function controlDescription() {
    "use strict";
    var avviso, descrizione = document.getElementById("VideogameDescriptionA").value;
    if (descrizione === "") {
        avviso = "Inserisci una descrizione";
        document.getElementById("AvvisoDescription").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDescription").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function controlPrice() {
    "use strict";
    var avviso, prezzo = document.getElementById("VideogamePriceA").value;
    if (prezzo < "0") {
        avviso = "Controlla di aver inserito correttamente il prezzo";
        document.getElementById("AvvisoPrice").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoPrice").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    }
}

function controlXbox360() {
    "use strict";
    var avviso, xbox360 = document.getElementById("QXbox360A").value, checkbox = document.getElementById("ItemXbox360A").checked;
    if ((checkbox === true && xbox360 < 0) || (checkbox === true && xbox360 === "") || (checkbox === true && xbox360 > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoXbox360").innerHTML = avviso;
    } else {
        if (checkbox === false && xbox360 !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoXbox360").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoXbox360").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckXbox360() {
    "use strict";
    var xbox360 = document.getElementById("QXbox360A").value, checkbox = document.getElementById("ItemXbox360A").checked;
    if (checkbox === true && xbox360 !== "" && xbox360 < 999 && xbox360 > 0) {
        document.getElementById("AvvisoXbox360").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoXbox360").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlXboxOne() {
    "use strict";
    var avviso, xboxOne = document.getElementById("QXboxOneA").value, checkbox = document.getElementById("ItemXboxOneA").checked;
    if ((checkbox === true && xboxOne < 0) || (checkbox === true && xboxOne === "") || (checkbox === true && xboxOne > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoXboxOne").innerHTML = avviso;
    } else {
        if (checkbox === false && xboxOne !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoXboxOne").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoXboxOne").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckXboxOne() {
    "use strict";
    var xboxOne = document.getElementById("QXboxOneA").value, checkbox = document.getElementById("ItemXboxOneA").checked;
    if (checkbox === true && xboxOne !== "" && xboxOne > 0 && xboxOne < 999) {
        document.getElementById("AvvisoXboxOne").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoXboxOne").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlWii() {
    "use strict";
    var avviso, Wii = document.getElementById("QWiiA").value, checkbox = document.getElementById("ItemWiiA").checked;
    if ((checkbox === true && Wii < 0) || (checkbox === true && Wii === "") || (checkbox === true && Wii > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoWii").innerHTML = avviso;
    } else {
        if (checkbox === false && Wii !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoWii").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoWii").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckWii() {
    "use strict";
    var Wii = document.getElementById("QWiiA").value, checkbox = document.getElementById("ItemWiiA").checked;
    if (checkbox === true && Wii !== "" && Wii < 999 && Wii > 0) {
        document.getElementById("AvvisoWii").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoWii").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}


function controlWiiU() {
    "use strict";
    var avviso, WiiU = document.getElementById("QWiiUA").value, checkbox = document.getElementById("ItemWiiUA").checked;
    if ((checkbox === true && WiiU < 0) || (checkbox === true && WiiU === "") || (checkbox === true && WiiU > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoWiiU").innerHTML = avviso;
    } else {
        if (checkbox === false && WiiU !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoWiiU").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoWiiU").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckWiiU() {
    "use strict";
    var WiiU = document.getElementById("QWiiUA").value, checkbox = document.getElementById("ItemWiiUA").checked;
    if (checkbox === true && WiiU !== "" && WiiU < 999 && WiiU > 0) {
        document.getElementById("AvvisoWiiU").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoWiiU").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlSwitch() {
    "use strict";
    var avviso, Switch = document.getElementById("QSwitchNA").value, checkbox = document.getElementById("ItemSwitchNA").checked;
    if ((checkbox === true && Switch < 0) || (checkbox === true && Switch === "") || (checkbox === true && Switch > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoSwitch").innerHTML = avviso;
    } else {
        if (checkbox === false && Switch !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoSwitch").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoSwitch").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckSwitch() {
    "use strict";
    var Switch = document.getElementById("QSwitchNA").value, checkbox = document.getElementById("ItemSwitchNA").checked;
    if (checkbox === true && Switch !== "" && Switch < 999 && Switch > 0) {
        document.getElementById("AvvisoSwitchN").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoSwitchN").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlPlay3() {
    "use strict";
    var avviso, Play3 = document.getElementById("QPlayStation3A").value, checkbox = document.getElementById("ItemPlayStation3A").checked;
    if ((checkbox === true && Play3 < 0) || (checkbox === true && Play3 === "") || (checkbox === true && Play3 > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoPlay3").innerHTML = avviso;
    } else {
        if (checkbox === false && Play3 !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoPlay3").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoPlay3").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckPlay3() {
    "use strict";
    var Play3 = document.getElementById("QPlayStation3A").value, checkbox = document.getElementById("ItemPlayStation3A").checked;
    if (checkbox === true && Play3 !== "" && Play3 < 999 && Play3 > 0) {
        document.getElementById("AvvisoPlay3").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoPlay3").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlPlay4() {
    "use strict";
    var avviso, Play4 = document.getElementById("QPlayStation4A").value, checkbox = document.getElementById("ItemPlayStation4A").checked;
    if ((checkbox === true && Play4 < 0) || (checkbox === true && Play4 === "") || (checkbox === true && Play4 > 999)) {
        avviso = "Aggiungi un valore compreso tra 1 a 999";
        document.getElementById("AvvisoPlay4").innerHTML = avviso;
    } else {
        if (checkbox === false && Play4 !== "0") {
            avviso = "Spunta la casellina";
            document.getElementById("AvvisoPlay4").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoPlay4").innerHTML = "";
            document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
        }
    }
}

function controlCheckPlay4() {
    "use strict";
    var Play4 = document.getElementById("QPlayStation4A").value, checkbox = document.getElementById("ItemPlayStation4A").checked;
    if (checkbox === true && Play4 !== "0") {
        document.getElementById("AvvisoPlay4").innerHTML = "";
        document.getElementById("ConfirmButtonI").disabled = controlButtonAdd();
    } else {
        document.getElementById("AvvisoPlay4").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}
