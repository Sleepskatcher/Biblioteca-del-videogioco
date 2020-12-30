<?php

function assemblyHeader(&$header) {

    if(empty($_GET)) {

        $header = str_replace('$LOGOHOMEPAGEANDTITLE$', '<div id="LogoTitle">
        <img src="../IMMAGINI/logopiccolo.png" alt="Logo biblioteca del videogioco"/>
        <p>Biblioteca del videogioco</p>
        </div>', $header);

    } else {

        $header = str_replace('$LOGOHOMEPAGEANDTITLE$', '<div id="LogoTitle">
        <a class="SiteTitle" href="phpPrincipal.php" tabindex="1" title="Link alla home"><img src="../IMMAGINI/logopiccolo.png" alt="Logo biblioteca del videogioco"/></a>
        <p>Biblioteca del videogioco</p>
        </div>', $header);

    }

    if(!isset($_SESSION["username"])) {

        $header = str_replace('$ACCEDI$', '<a id="LoginLink" title="Link per accedere" href="../PHP/phpLoginPage.php" tabindex="2">Accedi</a>', $header);
        $header = str_replace('$REGISTRATI$', '<a id="RegLink" title="Link per registrarsi" href="../PHP/phpRegistrationPage.php" tabindex="3">Registrati</a>', $header);
        $header = str_replace('$GENERALHEADERHIDDEN$', '<input type="hidden" name="searchstart" value="0"/>
        <input type="hidden" name="searchfinish" value="20"/>', $header);
        $header = str_replace('$PLACEHOLDERSEARCH$', 'ricerca videogioco', $header);

    } else {

        $replaceAccedi = $_SESSION["username"];
        $header = str_replace('$ACCEDI$', '<a id="LoginLink" title="Link per pagina utente" href="../PHP/phpUserPage.php" tabindex="2">' . $replaceAccedi . '</a>', $header);
        $header = str_replace('$REGISTRATI$', '<a id="RegLink" title="Link per sloggarsi" href="../PHP/phpLogOut.php" tabindex="3">Esci</a>', $header);
        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            if(isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot') {

                $header = str_replace('$GENERALHEADERHIDDEN$', '<input type="hidden" name="menu" value="elencoprenotazionitot"/>
                <input type="hidden" name="searchstart" value="0"/>
                <input type="hidden" name="searchfinish" value="20"/>', $header);
                $header = str_replace('$PLACEHOLDERSEARCH$', 'ricerca prenotazioni', $header);

            } else {

                $header = str_replace('$GENERALHEADERHIDDEN$', '<input type="hidden" name="searchstart" value="0"/>
                <input type="hidden" name="searchfinish" value="20"/>', $header);
                $header = str_replace('$PLACEHOLDERSEARCH$', 'ricerca videogioco', $header);

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            $header = str_replace('$GENERALHEADERHIDDEN$', '<input type="hidden" name="searchstart" value="0"/>
            <input type="hidden" name="searchfinish" value="20"/>', $header);
            $header = str_replace('$PLACEHOLDERSEARCH$', 'ricerca videogioco', $header);

        } else {

            $header = str_replace('$GENERALHEADERHIDDEN$', '<input type="hidden" name="searchstart" value="0"/>
            <input type="hidden" name="searchfinish" value="20"/>', $header);
            $header = str_replace('$PLACEHOLDERSEARCH$', 'ricerca videogioco', $header);

        }

    }

}

?>
