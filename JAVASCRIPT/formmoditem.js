/* jslint browser: true */
/*eslint-disable*/
/*global document: false */
/*global window */

/*pagina modifica videogioco*/

function loadMod() {
    "use strict";
    if (document.getElementById("ConfirmButtonMod") === null) {
        return;
    }
    document.getElementById("ConfirmButtonMod").disabled = true;
}

function controlButtonMod() {
    "use strict";
    var titolo = document.getElementById("VideogameName").value, immagine = document.getElementById("VideogameImage").files, data = document.getElementById("VideogameExitDate").value, genere = document.getElementById("VideogameKind").value, descrizione = document.getElementById("VideogameDescription").value, checkxbox360 = document.getElementById("ItemXbox360").checked, xbox360 = document.getElementById("QXbox360").value, checkxboxone = document.getElementById("ItemXboxOne").checked, xboxone = document.getElementById("QXboxOne").value, checkwii = document.getElementById("ItemWii").checked, wii = document.getElementById("QWii").value, checkwiiu = document.getElementById("ItemWiiU").checked, wiiu = document.getElementById("QWiiU").value, Switch = document.getElementById("QSwitchN").value, checkswitch = document.getElementById("ItemSwitchN").checked, checkplay3 = document.getElementById("ItemPlayStation3").checked, play3 = document.getElementById("QPlayStation3").value, checkplay4 = document.getElementById("ItemPlayStation4").checked, play4 = document.getElementById("QPlayStation4").value;
    if (titolo !== "" && data !== "" && immagine.length === 1 && genere !== "" && descrizione !== "") {
        if ((checkxbox360 === true && ((xbox360 !== "0" && xbox360 !== ""))) || (checkxboxone === true && (xboxone !== "0" && xboxone !== "")) || (checkwii === true && (wii !== "0" && wii !== "")) || (checkwiiu === true && (wiiu !== "0" && wiiu !== "")) || (checkswitch === true && (Switch !== "0" && Switch !== "")) || (checkplay3 === true && (play3 !== "0" && play3 !== "")) || (checkplay4 === true && (play4 !== "0" && play4 !== ""))) {
            return false;
        }
    }
    return true;
}

function control2ButtonMod() {
    "use strict";
    var titolo = document.getElementById("VideogameName").value, immagine = document.getElementById("VideogameImage").files, data = document.getElementById("VideogameExitDate").value, genere = document.getElementById("VideogameKind").value, descrizione = document.getElementById("VideogameDescription").value, xbox360 = document.getElementById("QXbox360").value, xboxone = document.getElementById("QXboxOne").value, wii = document.getElementById("QWii").value, wiiu = document.getElementById("QWiiU").value, Switch = document.getElementById("QSwitchN").value, play3 = document.getElementById("QPlayStation3").value, play4 = document.getElementById("QPlayStation4").value, xold = document.getElementById("X360Old"), xoneold = document.getElementById("XOneOld"), wiiold = document.getElementById("WOld"), wiiuold = document.getElementById("WUOld"), switchold = document.getElementById("SwOld"), play3old = document.getElementById("P3Old"), play4old = document.getElementById("P4Old"), x360c, xonec, wiic, wiiuc, switchc, play3c, play4c, valorex360, valorexone, valorewii, valorewiiu, valoreswitch, valoreplay3, valoreplay4;
    if (titolo !== "" && data !== "" && immagine.length === 1 && genere !== "" && descrizione !== "") {
        if (xold === null) {
            x360c = controlButtonMod();
        } else {
            valorex360 = 999 - xold.value;
            if (xbox360 < 0 || xbox360 === "" || xbox360 > valorex360 || xbox360 === 0) {
                x360c = false;
            } else {
                x360c = true;
            }
        }
        if (xoneold === null) {
            xonec = controlButtonMod();
        } else {
            valorexone = 999 - xoneold.value;
            if (xboxone < 0 || xboxone === "" || xboxone > valorexone || xboxone === 0) {
                xonec = false;
            } else {
                xonec = true;
            }
        }
        if (wiiold === null) {
            wiic = controlButtonMod();
        } else {
            valorewii = 999 - wiiold.value;
            if (wii < 0 || wii === "" || wii > valorewii || wii === 0) {
                wiic = false;
            } else {
                wiic = true;
            }
        }
        if (wiiuold === null) {
            wiiuc = controlButtonMod();
        } else {
            valorewiiu = 999 - wiiuold.value;
            if (wiiu < 0 || wiiu === "" || wiiu > valorewiiu || wiiu === 0) {
                wiiuc = false;
            } else {
                wiiuc = true;
            }
        }
        if (switchold === null) {
            switchc = controlButtonMod();
        } else {
            valoreswitch = 999 - switchold.value;
            if (Switch < 0 || Switch === "" || Switch > valoreswitch || Switch === 0) {
                switchc = false;
            } else {
                switchc = true;
            }
        }
        if (play3old === null) {
            play3c = controlButtonMod();
        } else {
            valoreplay3 = 999 - play3old.value;
            if (play3 < 0 || play3 === "" || play3 > valoreplay3 || play3 === 0) {
                play3c = false;
            } else {
                play3c = true;
            }
        }
        if (play4old === null) {
            play4c = controlButtonMod();
        } else {
            valoreplay4 = 999 - play4old.value;
            if (play4 < 0 || play4 === "" || play4 > valoreplay4 || play4 === 0) {
                play4c = false;
            } else {
                play4c = true;
            }
        }
        if (x360c && xonec && wiic && wiiuc && switchc && play3c && play4c) {
            return false;
        } else {
            return true;
        }
    }
}

function controlTitleMod() {
    "use strict";
    var avviso, titolo = document.getElementById("VideogameName").value;
    if (titolo === "") {
        avviso = "Compila questo campo";
        document.getElementById("AvvisoVideogameTitleMod").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoVideogameTitleMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    }
}

function controlDateMod() {
    "use strict";
    var avviso, data = document.getElementById("VideogameExitDate").value;
    if (data === "") {
        avviso = "Inserisci una data";
        document.getElementById("AvvisoDateMod").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDateMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    }
}

function controlKindMod() {
    "use strict";
    var avviso, genere = document.getElementById("VideogameKind").value;
    if (genere === "") {
        avviso = "Completa questo campo";
        document.getElementById("AvvisoKindMod").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoKindMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    }
}

function controlDescriptionMod() {
    "use strict";
    var avviso, descrizione = document.getElementById("VideogameDescription").value;
    if (descrizione === "") {
        avviso = "Inserisci una descrizione";
        document.getElementById("AvvisoDescriptionMod").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoDescriptionMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    }
}

function controlPriceMod() {
    "use strict";
    var avviso, prezzo = document.getElementById("VideogamePrice").value;
    if (prezzo < "0") {
        avviso = "Controlla di aver inserito correttamente il prezzo";
        document.getElementById("AvvisoPriceMod").innerHTML = avviso;
    } else {
        document.getElementById("AvvisoPriceMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    }
}

function controlXbox360Mod() {
    "use strict";
    var valore, avviso, xbox360 = document.getElementById("QXbox360").value, checkbox = document.getElementById("ItemXbox360").checked, xold = document.getElementById("X360Old");
    if (xold === null) {
        if ((checkbox === true && xbox360 < 0) || (checkbox === true && xbox360 === "") || (checkbox === true && xbox360 > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoXbox360Mod").innerHTML = avviso;
        } else {
            if (checkbox === false && xbox360 !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoXbox360Mod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoXbox360Mod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - xold.value;
        if (xbox360 < 0 || xbox360 === "" || xbox360 > valore || xbox360 === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoXbox360Mod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoXbox360Mod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }
}

function controlCheckXbox360Mod() {
    "use strict";
    var xbox360 = document.getElementById("QXbox360").value, checkbox = document.getElementById("ItemXbox360").checked;
    if (checkbox === true && xbox360 !== "" && xbox360 < 999 && xbox360 > 0) {
        document.getElementById("AvvisoXbox360Mod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoXbox360Mod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlXboxOneMod() {
    "use strict";
    var valore, avviso, xboxOne = document.getElementById("QXboxOne").value, checkbox = document.getElementById("ItemXboxOne").checked, xoneold = document.getElementById("XOneOld");
    if (xoneold === null) {
        if ((checkbox === true && xboxOne < 0) || (checkbox === true && xboxOne === "") || (checkbox === true && xboxOne > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoXboxOneMod").innerHTML = avviso;
        } else {
            if (checkbox === false && xboxOne !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoXboxOneMod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoXboxOneMod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - xoneold.value;
        if (xboxOne < 0 || xboxOne === "" || xboxOne > valore || xboxOne === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoXboxOneMod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoXboxOneMod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }
}

function controlCheckXboxOneMod() {
    "use strict";
    var xboxOne = document.getElementById("QXboxOne").value, checkbox = document.getElementById("ItemXboxOne").checked;
    if (checkbox === true && xboxOne !== "" && xboxOne > 0 && xboxOne < 999) {
        document.getElementById("AvvisoXboxOneMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoXboxOneMod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlWiiMod() {
    "use strict";
    var valore, avviso, Wii = document.getElementById("QWii").value, checkbox = document.getElementById("ItemWii").checked, wiiold = document.getElementById("WOld");
    if (wiiold === null) {
        if ((checkbox === true && Wii < 0) || (checkbox === true && Wii === "") || (checkbox === true && Wii > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoWiiMod").innerHTML = avviso;
        } else {
            if (checkbox === false && Wii !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoWiiMod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoWiiMod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - wiiold.value;
        if (Wii < 0 || Wii === "" || Wii > valore || Wii === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoWiiMod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoWiiMod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }
}

function controlCheckWiiMod() {
    "use strict";
    var Wii = document.getElementById("QWii").value, checkbox = document.getElementById("ItemWii").checked;
    if (checkbox === true && Wii !== "" && Wii < 999 && Wii > 0) {
        document.getElementById("AvvisoWiiMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoWiiMod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}


function controlWiiUMod() {
    "use strict";
    var valore, avviso, WiiU = document.getElementById("QWiiU").value, checkbox = document.getElementById("ItemWiiU").checked, wiiuold = document.getElementById("WUOld");
    if (wiiuold === null) {
        if ((checkbox === true && WiiU < 0) || (checkbox === true && WiiU === "") || (checkbox === true && WiiU > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoWiiUMod").innerHTML = avviso;
        } else {
            if (checkbox === false && WiiU !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoWiiUMod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoWiiUMod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - wiiuold.value;
        if (WiiU < 0 || WiiU === "" || WiiU > valore || WiiU === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoWiiUMod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoWiiUMod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }

}

function controlCheckWiiUMod() {
    "use strict";
    var WiiU = document.getElementById("QWiiU").value, checkbox = document.getElementById("ItemWiiU").checked;
    if (checkbox === true && WiiU !== "" && WiiU < 999 && WiiU > 0) {
        document.getElementById("AvvisoWiiUMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoWiiUMod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlSwitchMod() {
    "use strict";
    var valore, avviso, Switch = document.getElementById("QSwitchN").value, checkbox = document.getElementById("ItemSwitchN").checked, switchold = document.getElementById("SwOld");
    if (switchold === null) {
        if ((checkbox === true && Switch < 0) || (checkbox === true && Switch === "") || (checkbox === true && Switch > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoSwitchMod").innerHTML = avviso;
        } else {
            if (checkbox === false && Switch !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoSwitchMod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoSwitchMod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - switchold.value;
        if (Switch < 0 || Switch === "" || Switch > valore || Switch === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoSwitchMod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoSwitchMod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }

}

function controlCheckSwitchMod() {
    "use strict";
    var Switch = document.getElementById("QSwitchN").value, checkbox = document.getElementById("ItemSwitchN").checked;
    if (checkbox === true && Switch !== "" && Switch < 999 && Switch > 0) {
        document.getElementById("AvvisoSwitchMod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoSwitchMod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlPlay3Mod() {
    "use strict";
    var valore, avviso, Play3 = document.getElementById("QPlayStation3").value, checkbox = document.getElementById("ItemPlayStation3").checked, play3old = document.getElementById("P3Old");
    if (play3old === null) {
        if ((checkbox === true && Play3 < 0) || (checkbox === true && Play3 === "") || (checkbox === true && Play3 > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoPlay3Mod").innerHTML = avviso;
        } else {
            if (checkbox === false && Play3 !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoPlay3Mod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoPlay3Mod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - play3old.value;
        if (Play3 < 0 || Play3 === "" || Play3 > valore || Play3 === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoPlay3Mod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoPlay3Mod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }

}

function controlCheckPlay3Mod() {
    "use strict";
    var Play3 = document.getElementById("QPlayStation3").value, checkbox = document.getElementById("ItemPlayStation3").checked;
    if (checkbox === true && Play3 !== "" && Play3 < 999 && Play3 > 0) {
        document.getElementById("AvvisoPlay3Mod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoPlay3Mod").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}

function controlPlay4Mod() {
    "use strict";
    var valore, avviso, Play4 = document.getElementById("QPlayStation4").value, checkbox = document.getElementById("ItemPlayStation4").checked, play4old = document.getElementById("P4Old");
    if (play4old === null) {
        if ((checkbox === true && Play4 < 0) || (checkbox === true && Play4 === "") || (checkbox === true && Play4 > 999)) {
            avviso = "Aggiungi un valore compreso tra 1 a 999";
            document.getElementById("AvvisoPlay4Mod").innerHTML = avviso;
        } else {
            if (checkbox === false && Play4 !== "0") {
                avviso = "Spunta la casellina";
                document.getElementById("AvvisoPlay4Mod").innerHTML = avviso;
            } else {
                document.getElementById("AvvisoPlay4Mod").innerHTML = "";
                document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
            }
        }
    } else {
        valore = 999 - play4old.value;
        if (Play4 < 0 || Play4 === "" || Play4 > valore || Play4 === 0) {
            avviso = "Aggiungi un valore compreso tra 1 e " + valore + "!";
            document.getElementById("AvvisoPlay4Mod").innerHTML = avviso;
        } else {
            document.getElementById("AvvisoPlay4Mod").innerHTML = "";
            document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
        }
    }

}

function controlCheckPlay4Mod() {
    "use strict";
    var Play4 = document.getElementById("QPlayStation4").value, checkbox = document.getElementById("ItemPlayStation4").checked;
    if (checkbox === true && Play4 !== "0") {
        document.getElementById("AvvisoPlay4Mod").innerHTML = "";
        document.getElementById("ConfirmButtonMod").disabled = control2ButtonMod();
    } else {
        document.getElementById("AvvisoPlay4").innerHTML = "Aggiungi un valore compreso tra 1 e 999";
    }
}
