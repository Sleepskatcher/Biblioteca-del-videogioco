<?php

function assemblyLateralSubMenuConsoleWithDatabase(&$centralBody) {

    if(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && $_GET["start"] != '' && isset($_GET["finish"]) && $_GET["finish"] != '') {

        $centralBody = file_get_contents('../HTML/ListElementPage.html');

        $start = '';
        if(isset($_GET["start"])) $start = $_GET["start"];
        $finish = '';
        if(isset($_GET["finish"])) $finish = $_GET["finish"];
        $boolWhileFetch = false;
        $consoleName = '';
        $radioName = '';

        include('phpConnectionDatabase.php');
        $totalTemplateListElement = '';

        $query_console = '';

        if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) {

            if($_GET["console"] == 'microsoft') {

                if(!isset($_GET["radioXbox"])) {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'Xbox360' OR disponibili.console = 'XboxOne') AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'Xbox360') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Xbox360' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioXbox=Xbox360';

                } elseif(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'XboxOne') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'XboxOne' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioXbox=XboxOne';

                } else {

                    $query_console;

                }

                $consoleName = 'microsoft';

            } elseif($_GET["console"] == 'nintendo') {

                if(!isset($_GET["radioNintendo"])) {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'Wii' OR disponibili.console = 'WiiU' OR disponibili.console = 'Switch') AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Wii') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Wii' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioNintendo=Wii';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'WiiU') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'WiiU' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioNintendo=WiiU';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Switch') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Switch' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioNintendo=Switch';

                } else {

                    $query_console;

                }

                $consoleName = 'nintendo';

            } elseif($_GET["console"] == 'sony') {

                if(!isset($_GET["radioSony"])) {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'PlayStation3' OR disponibili.console = 'PlayStation4') AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation3') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'PlayStation3' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioSony=PlayStation3';

                } elseif(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation4') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'PlayStation4' AND disponibili.copie <> '0' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&radioSony=PlayStation4';

                } else {

                    $query_console;

                }

                $consoleName = 'sony';

            } else {

                $query_console = '';
                $consoleName = '';
                $radioName = '';

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            if($_GET["console"] == 'microsoft') {

                if(!isset($_GET["radioXbox"])) {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'Xbox360' OR disponibili.console = 'XboxOne') ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'Xbox360') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Xbox360' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioXbox=Xbox360';

                } elseif(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'XboxOne') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'XboxOne' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioXbox=XboxOne';

                } else {

                    $query_console;

                }

                $consoleName = 'microsoft';

            } elseif($_GET["console"] == 'nintendo') {

                if(!isset($_GET["radioNintendo"])) {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'Wii' OR disponibili.console = 'Wiiu' OR disponibili.console = 'Switch') ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Wii') {

                    $query_console = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Wii' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioNintendo=Wii';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'WiiU') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Wiiu' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioNintendo=WiiU';

                } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Switch') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'Switch' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioNintendo=Switch';

                } else {

                    $query_console;

                }

                $consoleName = 'nintendo';

            } elseif($_GET["console"] == 'sony') {

                if(!isset($_GET["radioSony"])) {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE (disponibili.console = 'PlayStation3' OR disponibili.console = 'PlayStation4') ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '';

                } elseif(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation3') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'PlayStation3' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioSony=PlayStation3';

                } elseif(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation4') {

                    $query_console = "SELECT disponibili.console, disponibili.copie, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE disponibili.console = 'PlayStation4' ORDER BY videogioco.nome, disponibili.console";
                    $radioName = '&amp;radioSony=PlayStation4';

                } else {

                    $query_console;

                }

                $consoleName = 'sony';

            } else {

                $query_console = '';
                $consoleName = '';
                $radioName = '';

            }

        }


        $requestConsole = $connectionDatabase -> query($query_console);

        $resultConsole = NULL;


        if($requestConsole) {

            $requestConsole -> data_seek($start);

            while(($resultConsole = $requestConsole -> fetch_assoc()) && $start < $finish) {

                $tabindex = 19;
                $boolWhileFetch = true;
                $templateListElement = file_get_contents('../HTML/TemplateListElement.html');

                $replaceConsole = $resultConsole['console'];
                $replaceName = $resultConsole['nome'];
                $saveCode = $resultConsole['codice'];
                $templateListElement = str_replace('$CONSOLE$', $replaceConsole, $templateListElement);
                $templateListElement = str_replace('$NAMEVIDEOGAME$', '<a title="Questo link porta al videogioco selezionato" href="phpPrincipal.php?menu=catalogo&amp;console=' . $consoleName . $radioName . '&amp;tipeOfConsole=' . $replaceConsole . '&amp;code=' . $saveCode . '" tabindex="' . $tabindex . '">' . $replaceName . '</a>' , $templateListElement);

                $totalTemplateListElement = $totalTemplateListElement . $templateListElement;

                $start = $start + 1;
                $tabindex = $tabindex + 1;

            }

            if($resultConsole == NULL) $start = $start + 1;
            else $start;

            mysqli_close($connectionDatabase);

            if($boolWhileFetch) {

                $prevStart = $_GET["start"] - ($_GET["finish"] - $_GET["start"]);
                $prevFinish = $_GET["start"];

                $numberPage = $_GET["finish"]/($_GET["finish"] - $_GET["start"]);

                $centralBody = str_replace('$NUMBERPAGE$', '<p class="NumberPage">Pagina ' . $numberPage . '</p>', $centralBody);

                $centralBody = str_replace('$ELEMENTS$', $totalTemplateListElement, $centralBody);

                if($_GET["start"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGE$', '', $centralBody);
                else $centralBody = str_replace('$LINKPREVIOUSPAGE$', '<a class="MovePagePrec" href="phpPrincipal.php?menu=catalogo&amp;console=' . $consoleName . $radioName . '&amp;start=' . $prevStart . '&amp;finish=' . $prevFinish . '" tabindex="40">Pagina precedente</a>', $centralBody);

                $nextStart = $_GET["finish"];
                $nextFinish = $_GET["finish"] + ($_GET["finish"] - $_GET["start"]);

                if($start != $finish || $resultConsole == NULL) $centralBody = str_replace('$LINKNEXTPAGE$', '', $centralBody);
                else $centralBody = str_replace('$LINKNEXTPAGE$', '<a class="MovePageSucc" href="phpPrincipal.php?menu=catalogo&amp;console=' . $consoleName . $radioName . '&amp;start=' . $nextStart . '&amp;finish=' . $nextFinish . '" tabindex="41">Pagina successiva</a>', $centralBody);

            } else {

                $centralBody = '<p>Non sono stati trovati elementi all\'interno del catalogo. Effettuare un\'altra ricerca</p>';

            }

        } else {

            $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

        }

    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }


}



?>
