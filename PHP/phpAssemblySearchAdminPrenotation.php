<?php

function assemblySearchAdminPrenotation(&$centralBody) {


    if((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6)) {

        if(!isset($_SESSION["username"])) {

            $centralBody = file_get_contents('../HTML/errorpage404.html');

        } else {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $centralBody = file_get_contents('../HTML/AdminPrenotationList.html');

                include('phpConnectionDatabase.php');
                $search = '';
                if(isset($_GET["search"])) $search = $_GET["search"];
                $searchStart = '';
                if(isset($_GET["searchstart"])) $searchStart = $_GET["searchstart"];
                $searchFinish = '';
                if(isset($_GET["searchfinish"])) $searchFinish = $_GET["searchfinish"];
                $boolWhileFetch = false;

                $totalSearchPrenotation = '';

                $query_searchPrenotation = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE prenotazione.utente = '$search' ORDER BY prenotazione.id DESC";

                $requestSearchPrenotation = $connectionDatabase -> query($query_searchPrenotation);

                $resultSearchPrenotation = NULL;

                if($requestSearchPrenotation) {

                    $requestSearchPrenotation -> data_seek($searchStart);

                    while(($resultSearchPrenotation = $requestSearchPrenotation -> fetch_assoc()) && $searchStart < $searchFinish) {

                        $boolWhileFetch = true;
                        $templateSearchPrenotation = file_get_contents('../HTML/TemplateListPrenotation.html');

                        $replacePrenotationNumber = $resultSearchPrenotation['id'];

                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONUMBER$', $replacePrenotationNumber, $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONUSERNAME$', $resultSearchPrenotation['utente'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONVIDEOGAMECODE$', $resultSearchPrenotation['videogioco'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONVIDEOGAMENAME$', $resultSearchPrenotation['nome_videogioco'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONCONSOLE$', $resultSearchPrenotation['console'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONDATE$', $resultSearchPrenotation['data_prenotazione'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPICKUPDATE$', $resultSearchPrenotation['data_ritiro'], $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONDELIVERDATE$', $resultSearchPrenotation['data_restituzione'], $templateSearchPrenotation);

                        $totalCost = 0;
                        if($resultSearchPrenotation['data_ritiro'] && $resultSearchPrenotation['data_restituzione'] && $resultSearchPrenotation['data_ritiro'] == $resultSearchPrenotation['data_restituzione']) {

                            $totalCost = $resultSearchPrenotation['prezzo_noleggio'];

                        } elseif($resultSearchPrenotation['data_ritiro'] && $resultSearchPrenotation['data_restituzione']) {

                            $totalCost = $resultSearchPrenotation['prezzo_noleggio'] * intval((strtotime($resultSearchPrenotation['data_restituzione']) - strtotime($resultSearchPrenotation['data_ritiro']))/86400);

                        } elseif($resultSearchPrenotation['data_ritiro'] && !$resultSearchPrenotation['data_restituzione']) {

                            $totalCost = $resultSearchPrenotation['prezzo_noleggio'] * intval((time() - strtotime($resultSearchPrenotation['data_ritiro']))/86400);

                        } else {

                            $totalCost = 0;

                        }


                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONTOTALCOST$', $totalCost, $templateSearchPrenotation);

                        $formModify= '';
                        $formDelete = '';

                        if($resultSearchPrenotation['data_ritiro'] == NULL && $resultSearchPrenotation['data_restituzione'] == NULL) {

                            $formModify = '<form action="phpAdminPrenotationListPage.php" method="post">
                            <fieldset>
                            <legend>Bottone modifica</legend>
                            $REPLACEHIDDENMODIFYCODE$
                            <button type="submit">Modifica</button>
                            </fieldset>
                            </form>';
                            $formDelete = '<form action="phpAdminPrenotationListPageDelete.php" method="post">
                            <fieldset>
                            <legend>Bottone elimina</legend>
                            $REPLACEHIDDENDELETECODE$
                            <button type="submit">Elimina</button>
                            </fieldset>
                            </form>';

                            $formModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>', $formModify);
                            $formDelete = str_replace('$REPLACEHIDDENDELETECODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>
                            <input type="hidden" name="tipeOfConsole" value="' . $resultSearchPrenotation['console'] . '"/>
                            <input type="hidden" name="code" value="' . $resultSearchPrenotation['videogioco'] . '"/>', $formDelete);

                        } else {

                            $formModify = '<form action="phpAdminPrenotationListPage.php" method="post">
                            <fieldset>
                            <legend>Bottone modifica</legend>
                            $REPLACEHIDDENMODIFYCODE$
                            <button type="submit">Modifica</button>
                            </fieldset>
                            </form>';

                            $formDelete = '<form action="" method="post">
                            <fieldset>
                            <legend>Bottone elimina</legend>
                            $REPLACEHIDDENDELETECODE$
                            <button type="submit" disabled="disabled">Non cliccabile</button>
                            </fieldset>
                            </form>';

                            $formModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>', $formModify);
                            $formDelete = str_replace('$REPLACEHIDDENDELETECODE$', '', $formDelete);

                        }

                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMMODIFY$', $formModify, $templateSearchPrenotation);
                        $templateSearchPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMDELETE$', $formDelete, $templateSearchPrenotation);

                        $totalSearchPrenotation = $totalSearchPrenotation . $templateSearchPrenotation;

                        $searchStart = $searchStart + 1;

                    }

                    if($resultSearchPrenotation == NULL) $searchStart = $searchStart + 1;
                    else $searchStart;

                    mysqli_close($connectionDatabase);

                    if($boolWhileFetch) {

                        if(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'yes') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione eliminata con successo!</p>', $centralBody);

                        } elseif(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'no') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione non eliminata, problema con il <span xml:lang="en" lang="en">database</span>!</p>', $centralBody);

                        } else {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '', $centralBody);

                        }

                        $prevSearchStart = $_GET["searchstart"] - ($_GET["searchfinish"] - $_GET["searchstart"]);
                        $prevSearchFinish = $_GET["searchstart"];

                        $numberPage = $_GET["searchfinish"]/($_GET["searchfinish"] - $_GET["searchstart"]);

                        $centralBody = str_replace('$PRENOTATIONUMBERPAGE$', '<p class="NumberPage">Pagina ' . $numberPage . '</p>', $centralBody);

                        $centralBody = str_replace('$PRENOTATIONLIST$', $totalSearchPrenotation, $centralBody);

                        if($_GET["searchstart"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '<a class="MovePagePrec" title="Questo link porta alla pagina precedente" href="phpPrincipal.php?menu=elencoprenotazionitot&searchstart=' . $prevSearchStart . '&searchfinish=' . $prevSearchFinish . '&search=' . $search . '">Pagina precedente</a>', $centralBody);

                        $nextSearchStart = $_GET["searchfinish"];
                        $nextSearchFinish = $_GET["searchfinish"] + ($_GET["searchfinish"] - $_GET["searchstart"]);

                        if($searchStart != $searchFinish || $resultSearchPrenotation == NULL) $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '<a class="MovePageSucc" title="Questo link porta alla pagina successiva" href="phpPrincipal.php?menu=elencoprenotazionitot&searchstart=' . $nextSearchStart . '&searchfinish=' . $nextSearchFinish . '&search=' . $search . '">Pagina successiva</a>', $centralBody);

                    } else {

                        $centralBody = '<p>Non sono state trovate prenotazioni per questo utente</p>';

                    }

                } else {

                    $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                $centralBody = file_get_contents('../HTML/errorpage404.html');

            } else {

                $centralBody = file_get_contents('../HTML/errorpage404.html');

            }

        }

    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }

}

?>
