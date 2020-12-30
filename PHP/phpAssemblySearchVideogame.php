<?php

function assemblySearchVideogame(&$centralBody) {

    if(!isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"])) {

        $centralBody = file_get_contents('../HTML/ListElementPage.html');

        include('phpConnectionDatabase.php');
        $search = '';
        if(isset($_GET["search"])) $search = $_GET["search"];
        $searchStart = '';
        if(isset($_GET["searchstart"])) $searchStart = $_GET["searchstart"];
        $searchFinish = '';
        if(isset($_GET["searchfinish"])) $searchFinish = $_GET["searchfinish"];
        $boolWhileFetch = false;

        $totalSearchVideogame = '';

        $query_searchVideogame = '';

        if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) {

            $query_searchVideogame = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE videogioco.nome LIKE '%$search%' AND disponibili.copie <> '0' ORDER BY disponibili.console, videogioco.nome";

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $query_searchVideogame = "SELECT disponibili.console, videogioco.nome, videogioco.codice FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE videogioco.nome LIKE '%$search%' ORDER BY disponibili.console, videogioco.nome";

        } else {

            $query_searchVideogame = '';

        }

        $requestSearchVideogame = $connectionDatabase -> query($query_searchVideogame);

        $resultSearchVideogame = NULL;

        if($requestSearchVideogame) {

            $requestSearchVideogame -> data_seek($searchStart);

            while(($resultSearchVideogame = $requestSearchVideogame -> fetch_assoc()) && $searchStart < $searchFinish) {

                $boolWhileFetch = true;
                $templateSearchVideogame = file_get_contents('../HTML/TemplateListElement.html');

                $replaceConsole = $resultSearchVideogame['console'];
                $replaceName = $resultSearchVideogame['nome'];
                $replaceCode = $resultSearchVideogame['codice'];
                $templateSearchVideogame = str_replace('$CONSOLE$', $resultSearchVideogame['console'], $templateSearchVideogame);

                $templateSearchVideogame = str_replace('$NAMEVIDEOGAME$', '<a title="Questo link porta al videogioco selezionato" href="phpPrincipal.php?search=' . $search . '&amp;tipeOfConsole=' . $replaceConsole . '&amp;code=' . $replaceCode . '">' . $replaceName . '</a>', $templateSearchVideogame);

                $totalSearchVideogame = $totalSearchVideogame . $templateSearchVideogame;

                $searchStart = $searchStart + 1;

            }

            if($resultSearchVideogame == NULL) $searchStart = $searchStart + 1;
            else $searchStart;

            mysqli_close($connectionDatabase);

            if($boolWhileFetch) {

                $prevSearchStart = $_GET["searchstart"] - ($_GET["searchfinish"] - $_GET["searchstart"]);
                $prevSearchFinish = $_GET["searchstart"];

                $numberPage = $_GET["searchfinish"]/($_GET["searchfinish"] - $_GET["searchstart"]);

                $centralBody = str_replace('$NUMBERPAGE$', '<class="NumberPage" p>Pagina ' . $numberPage . '</p>', $centralBody);

                $centralBody = str_replace('$ELEMENTS$', $totalSearchVideogame, $centralBody);

                if($_GET["searchstart"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGE$', '', $centralBody);
                else $centralBody = str_replace('$LINKPREVIOUSPAGE$', '<a class="MovePagePrec" href="phpPrincipal.php?searchstart=' . $prevSearchStart . '&searchfinish=' . $prevSearchFinish . '&search=' . $search . '">Pagina precedente</a>', $centralBody);

                $nextSearchStart = $_GET["searchfinish"];
                $nextSearchFinish = $_GET["searchfinish"] + ($_GET["searchfinish"] - $_GET["searchstart"]);

                if($searchStart != $searchFinish || $resultSearchVideogame == NULL) $centralBody = str_replace('$LINKNEXTPAGE$', '', $centralBody);
                else $centralBody = str_replace('$LINKNEXTPAGE$', '<a class="MovePageSucc" href="phpPrincipal.php?searchstart=' . $nextSearchStart . '&searchfinish=' . $nextSearchFinish . '&search=' . $search . '">Pagina successiva</a>', $centralBody);

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
