<?php

function assemblyCentralBody(&$centralBody) {

    if(isset($_GET["menu"]) && $_GET["menu"] != 'elencoprenotazionitot' && $_GET["menu"] != 'prenotazioni' && ($_GET["menu"] == 'catalogo' || $_GET["menu"] == 'chisiamo' || $_GET["menu"] == 'dovesiamo' || $_GET["menu"] == 'comefunzionanoleggio' || $_GET["menu"] == 'inserimentovid') && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

        if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) {

            if(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo') {

                $centralBody = file_get_contents('../HTML/SubMenuGeneralMenu.html');

            } elseif(isset($_GET["menu"]) && $_GET["menu"] == 'chisiamo') {

                $centralBody = file_get_contents('../HTML/SubGeneralMenuChiSiamo.html');

            } elseif(isset($_GET["menu"]) && $_GET["menu"] == 'comefunzionanoleggio') {

                $centralBody = file_get_contents('../HTML/SubGeneralMenuComeFunzionaIlNoleggio.html');

            } else {

                $centralBody = file_get_contents('../HTML/errorpage404.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            if(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo') {

                $centralBody = file_get_contents('../HTML/SubMenuGeneralMenu.html');

            } else {

                $centralBody = file_get_contents('../HTML/errorpage404.html');

            }

        } else {

            $centralBody = file_get_contents('../HTML/errorpage404.html');

        }


    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }

};

?>
