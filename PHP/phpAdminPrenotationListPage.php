<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');
include('phpAssemblyCentralBody.php');
include('phpAssemblyPageOutPhpPrincipal.php');

include('phpConnectionDatabase.php');


$principalPage = '';
$listPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == "modificapren" && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $idPrenotation = '';
            if(isset($_POST["numprenotazione"])) $idPrenotation = $_POST["numprenotazione"];
            $sendStart = '';
            if(isset($_POST["startpr"])) $sendStart = $_POST["startpr"];
            $sendFinish = '';
            if(isset($_POST["finishpr"])) $sendFinish = $_POST["finishpr"];

            $listPage = file_get_contents('../HTML/AdminPrenotationListPage.html');
            $query_prenotation = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE id = '$idPrenotation'";

            $requestPrenotation = $connectionDatabase -> query($query_prenotation);

            if($requestPrenotation) {

                $resultPrenotation = $requestPrenotation -> fetch_assoc();

                if($resultPrenotation != NULL) {

                    $linkComeBack = '';

                    if(!isset($_SESSION["url"])) {

                        $linkComeBack = 'phpPrincipal.php';
                        $listPage = str_replace('$LISTPAGECOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="13">Torna alla homepage</a>', $listPage);

                    } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "") {

                        $linkComeBack = $_SESSION["url"];
                        $listPage = str_replace('$LISTPAGECOMEBACK$', '<a class="BackPage" title="Questo link torna indietro alla pagina precedente" href="' . $linkComeBack . '" tabindex="13">Torna indietro</a>', $listPage);

                    } else {

                        $linkComeBack = 'phpPrincipal.php';
                        $listPage = str_replace('$LISTPAGECOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="13">Torna alla homepage</a>', $listPage);

                    }

                    $listPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '', $listPage);
                    $listPage = str_replace('$LISTPAGEAUTOINCREMENTALCODE$', '<p>Numero della prenotazione: ' . $idPrenotation . '</p>', $listPage);
                    $listPage = str_replace('$LISTPAGEHIDDENCODE$', '<input type="hidden" name="listPageHiddenCode" value="' . $idPrenotation . '"/>
                    <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                    <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $listPage);
                    $listPage = str_replace('$VALUELISTPAGEUSERNAME$', $resultPrenotation['utente'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGEVIDEOGAMECODE$', $resultPrenotation['videogioco'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGEVIDEOGAMENAME$', $resultPrenotation['nome_videogioco'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGECONSOLE$', $resultPrenotation['console'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGEPRENOTATIONDATE$', $resultPrenotation['data_prenotazione'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGEPICKUPDATE$', $resultPrenotation['data_ritiro'], $listPage);
                    $listPage = str_replace('$VALUELISTPAGEDELIVERDATE$', $resultPrenotation['data_restituzione'], $listPage);

                    $listPageTotalCost = 0;

                    if($resultPrenotation['data_ritiro'] && $resultPrenotation['data_restituzione'] && $resultPrenotation['data_ritiro'] == $resultPrenotation['data_restituzione']) {

                        $listPageTotalCost = $resultPrenotation['prezzo_noleggio'];

                    } elseif($resultPrenotation['data_ritiro'] && $resultPrenotation['data_restituzione']) {

                        $listPageTotalCost = $resultPrenotation['prezzo_noleggio'] * intval((strtotime($resultPrenotation['data_restituzione']) - strtotime($resultPrenotation['data_ritiro']))/86400);

                    } elseif($resultPrenotation['data_ritiro'] && !$resultPrenotation['data_restituzione']) {

                        $listPageTotalCost = $resultPrenotation['prezzo_noleggio'] * intval((time() - strtotime($resultPrenotation['data_ritiro']))/86400);

                    } else {

                        $listPageTotalCost = 0;

                    }

                    $listPage = str_replace('$VALUELISTPAGETOTALCOST$', $listPageTotalCost, $listPage);

                } else {

                    $listPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $listPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $listPage;

        }

    }

} else {

    $listPage = file_get_contents("../HTML/errorpage404.html");

}

mysqli_close($connectionDatabase);

assemblyPageOutPhpPrincipal($principalPage, $listPage);

echo $principalPage;

?>
