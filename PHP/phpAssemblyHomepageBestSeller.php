<?php

function assemblyHomepageBestSeller(&$centralBody) {

    if(!isset($_GET["menu"]) && !isset($_GET["search"]) && empty($_GET)) {

        $centralBody = file_get_contents('../HTML/HomepageBestSeller.html');

        include('phpConnectionDatabase.php');

        $query_randBestSeller = "SELECT disponibili.console, videogioco.nome, videogioco.codice, videogioco.copertina FROM disponibili INNER JOIN videogioco ON disponibili.videogioco = videogioco.codice WHERE copie <> '0' AND bestseller = '1' ORDER BY RAND() LIMIT 6";

        $requestRandBestSeller = $connectionDatabase -> query($query_randBestSeller);
        $resultRandBestSeller = '';

        if($requestRandBestSeller) {

            $cont = 1;

            $tabindex = 10;

            while($resultRandBestSeller = $requestRandBestSeller -> fetch_assoc()) {


                 $templateBestSeller = '<a title="Link per il bestseller ' . strip_tags($resultRandBestSeller['nome']) . ' per ' . $resultRandBestSeller['console'] . '" href="phpPrincipal.php?tipeOfConsole=' . $resultRandBestSeller['console'] . '&amp;code=' . $resultRandBestSeller['codice'] . '" tabindex="' . $tabindex . '">' . $resultRandBestSeller['nome'] . ' per ' . $resultRandBestSeller['console'] . '
                 <img alt="Immagine bestseller" src="../COPERTINE_VIDEOGIOCHI/'. $resultRandBestSeller['copertina'] . '"/></a>';

                $centralBody = str_replace('$BESTSELLER' . $cont . '$', $templateBestSeller, $centralBody);

                $cont = $cont + 1;

                $tabindex = $tabindex + 1;

            }

            while($cont < 7) {

                $templateBestSeller = '';

                $centralBody = str_replace('$BESTSELLER' . $cont . '$', $templateBestSeller, $centralBody);

                $cont = $cont + 1;

            }

        } else {

            $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

        }

    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }

}

?>
