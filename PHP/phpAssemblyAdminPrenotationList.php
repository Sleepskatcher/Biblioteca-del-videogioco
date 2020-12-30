<?php

function assemblyAdminPrenotationList(&$centralBody) {

    if((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && count($_GET) < 4) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 5)) {

        if(!isset($_SESSION["username"])) {

            $centralBody = file_get_contents('../HTML/errorpage404.html');

        } else {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $centralBody = file_get_contents('../HTML/AdminPrenotationList.html');

                $startPr = '';
                if(isset($_GET["startpr"])) $startPr = $_GET["startpr"];
                $finishPr = '';
                if(isset($_GET["finishpr"])) $finishPr = $_GET["finishpr"];
                $boolWhileAdminFetch = false;

                $sendStart = $startPr;
                $sendFinish = $finishPr;

                $prenotationNumber = '';


                include('phpConnectionDatabase.php');
                $totalPrenotationList = '';

                $query_listPrenotation = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice ORDER BY prenotazione.id DESC";
                $requestListPrenotation = $connectionDatabase -> query($query_listPrenotation);

                $resultListPrenotation = NULL;

                if($requestListPrenotation) {

                    $requestListPrenotation -> data_seek($startPr);

                    $_SESSION["numele"] = 0;

                    $tabindex = 13;

                    while(($resultListPrenotation = $requestListPrenotation -> fetch_assoc()) && $startPr < $finishPr) {

                        $boolWhileAdminFetch = true;
                        $templateListPrenotation = file_get_contents('../HTML/TemplateListPrenotation.html');

                        $replacePrenotationNumber = $resultListPrenotation['id'];

                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONUMBER$', $replacePrenotationNumber, $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONUSERNAME$', $resultListPrenotation['utente'], $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONVIDEOGAMECODE$', $resultListPrenotation['videogioco'] . ' - ' . $resultListPrenotation['nome_videogioco'], $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONCONSOLE$', $resultListPrenotation['console'], $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONDATE$', $resultListPrenotation['data_prenotazione'], $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPICKUPDATE$', $resultListPrenotation['data_ritiro'], $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONDELIVERDATE$', $resultListPrenotation['data_restituzione'], $templateListPrenotation);

                        $totalCost = 0;
                        if($resultListPrenotation['data_ritiro'] && $resultListPrenotation['data_restituzione'] && $resultListPrenotation['data_ritiro'] == $resultListPrenotation['data_restituzione']) {

                            $totalCost = $resultListPrenotation['prezzo_noleggio'];

                        } elseif($resultListPrenotation['data_ritiro'] && $resultListPrenotation['data_restituzione']) {

                            $totalCost = $resultListPrenotation['prezzo_noleggio'] * intval((strtotime($resultListPrenotation['data_restituzione']) - strtotime($resultListPrenotation['data_ritiro']))/86400);

                        } elseif($resultListPrenotation['data_ritiro'] && !$resultListPrenotation['data_restituzione']) {

                            $totalCost = $resultListPrenotation['prezzo_noleggio'] * intval((time() - strtotime($resultListPrenotation['data_ritiro']))/86400);

                        } else {

                            $totalCost = 0;

                        }

                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONTOTALCOST$', $totalCost, $templateListPrenotation);

                        $formModify = '';
                        $formDelete = '';

                        if($resultListPrenotation['data_ritiro'] == NULL && $resultListPrenotation['data_restituzione'] == NULL) {

                            $formModify = '<form action="phpAdminPrenotationListPage.php?menu=modificapren" method="post">
                            <fieldset>
                            <legend>Bottone modifica</legend>
                            $REPLACEHIDDENMODIFYCODE$
                            <button type="submit" tabindex="' . $tabindex . '">Modifica</button>
                            </fieldset>
                            </form>';

                            $tabindex = $tabindex + 1;

                            $formDelete = '<form action="phpAdminPrenotationListPageDelete.php" method="post">
                            <fieldset>
                            <legend>Bottone elimina</legend>
                            $REPLACEHIDDENDELETECODE$
                            <button type="submit" tabindex="' . $tabindex . '">Elimina</button>
                            </fieldset>
                            </form>';

                            $tabindex = $tabindex + 1;

                            $formModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>
                            <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                            <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $formModify);

                            $formDelete = str_replace('$REPLACEHIDDENDELETECODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>
                            <input type="hidden" name="tipeOfConsole" value="' . $resultListPrenotation['console'] . '"/>
                            <input type="hidden" name="code" value="' . $resultListPrenotation['videogioco'] . '"/>', $formDelete);

                        } else {

                            $formModify = '<form action="phpAdminPrenotationListPage.php?menu=modificapren" method="post">
                            <fieldset>
                            <legend>Bottone modifica</legend>
                            $REPLACEHIDDENMODIFYCODE$
                            <button type="submit" tabindex="' . $tabindex . '">Modifica</button>
                            </fieldset>
                            </form>';

                            $tabindex = $tabindex + 1;

                            $formDelete = '<form action="" method="post">
                            <fieldset>
                            <legend>Bottone elimina</legend>
                            $REPLACEHIDDENDELETECODE$
                            <button type="submit" disabled="disabled">Non cliccabile</button>
                            </fieldset>
                            </form>';

                            $formModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replacePrenotationNumber . '"/>
                            <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                            <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $formModify);

                            $formDelete = str_replace('$REPLACEHIDDENDELETECODE$', '', $formDelete);

                        }

                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMMODIFY$', $formModify, $templateListPrenotation);
                        $templateListPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMDELETE$', $formDelete, $templateListPrenotation);


                        $totalPrenotationList = $totalPrenotationList . $templateListPrenotation;

                        $startPr = $startPr + 1;

                        $_SESSION["numele"] = $_SESSION["numele"] + 1;

                    }

                    if($resultListPrenotation == NULL) $startPr = $startPr + 1;
                    else $startPr;

                    mysqli_close($connectionDatabase);

                    if($boolWhileAdminFetch) {

                        if(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'yes') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione eliminata con successo!</p>', $centralBody);

                        } elseif(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'no') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione non eliminata, problema con il <span xml:lang="en" lang="en">database</span>!</p>', $centralBody);

                        } else {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '', $centralBody);

                        }


                        $prevStartPr = $_GET["startpr"] - ($_GET["finishpr"] - $_GET["startpr"]);
                        $prevFinishPr = $_GET["startpr"];

                        $numberPage = $_GET["finishpr"]/($_GET["finishpr"] - $_GET["startpr"]);

                        $centralBody = str_replace('$PRENOTATIONUMBERPAGE$', '<p class="NumberPage">Pagina ' . $numberPage . '</p>', $centralBody);

                        $centralBody = str_replace('$PRENOTATIONLIST$', $totalPrenotationList, $centralBody);

                        if($_GET["startpr"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '<a class="MovePagePrec" title="Questo link porta alla pagina precedente" href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=' . $prevStartPr . '&amp;finishpr=' . $prevFinishPr . '" tabindex="36">Pagina precedente</a>', $centralBody);

                        $nextStartPr = $_GET["finishpr"];
                        $nextFinishPr = $_GET["finishpr"] + ($_GET["finishpr"] - $_GET["startpr"]);

                        if($startPr != $finishPr || $resultListPrenotation == NULL) $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '<a class="MovePageSucc" title="Questo link porta alla pagina successiva" href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=' . $nextStartPr . '&amp;finishpr=' . $nextFinishPr . '" tabindex="37">Pagina successiva</a>', $centralBody);

                    } else {

                        $centralBody = '<p>Non sono state trovate prenotazioni. È tempo di magra...</p>';

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
