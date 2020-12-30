<?php

function assemblyPrenotation(&$centralBody) {

    if((isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && count($_GET) < 5 && !isset($_GET["console"]) && !isset($_GET["search"])) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["code"]) && count($_GET) < 7) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && isset($_GET["code"]) && count($_GET) < 8)) {


        $pStart = '';
        if(isset($_GET["pstart"])) $pStart = $_GET["pstart"];
        $pFinish = '';
        if(isset($_GET["pfinish"])) $pFinish = $_GET["pfinish"];
        $boolWhileIsFetch = false;

        $sendStart = $pStart;
        $sendFinish = $pFinish;

        if(!isset($_SESSION["username"])) {

            $centralBody = file_get_contents('../HTML/errorpage404.html');

        } else {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                if(isset($_GET["fromVideogame"]) && $_GET["fromVideogame"] == 'yes') {

                    $centralBody = file_get_contents('../HTML/AdminPrenotationList.html');

                    include('phpConnectionDatabase.php');
                    $tipeOfConsole = '';
                    if(isset($_GET["tipeOfConsole"])) $tipeOfConsole = $_GET["tipeOfConsole"];
                    $code = '';
                    if(isset($_GET["code"])) $code = $_GET["code"];

                    $adminTotalPrenotationPage = '';

                    $query_adminPrenotation = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE prenotazione.videogioco = '$code' AND prenotazione.console = '$tipeOfConsole' AND prenotazione.data_restituzione IS NULL ORDER BY prenotazione.id DESC";

                    $requestAdminPrenotation = $connectionDatabase -> query($query_adminPrenotation);
                    $resultAdminPrenotation = NULL;

                    if($requestAdminPrenotation) {

                        $requestAdminPrenotation -> data_seek($pStart);

                        $tabindex = 13;

                        while(($resultAdminPrenotation = $requestAdminPrenotation -> fetch_assoc()) && $pStart < $pFinish) {

                            $boolWhileIsFetch = true;

                            $templateAdminPrenotation = file_get_contents('../HTML/TemplateListPrenotation.html');

                            $replaceAdminNumber = $resultAdminPrenotation['id'];

                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONUMBER$', $replaceAdminNumber, $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONUSERNAME$', $resultAdminPrenotation['utente'], $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONVIDEOGAMECODE$', $resultAdminPrenotation['videogioco'] . ' - ' . $resultAdminPrenotation['nome_videogioco'], $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONCONSOLE$', $resultAdminPrenotation['console'], $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONDATE$', $resultAdminPrenotation['data_prenotazione'], $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPICKUPDATE$', $resultAdminPrenotation['data_ritiro'], $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONDELIVERDATE$', $resultAdminPrenotation['data_restituzione'], $templateAdminPrenotation);

                            $totalCost = 0;
                            if($resultAdminPrenotation['data_ritiro'] && $resultAdminPrenotation['data_restituzione'] && $resultAdminPrenotation['data_ritiro'] == $resultAdminPrenotation['data_restituzione']) {

                                $totalCost = $resultAdminPrenotation['prezzo_noleggio'];

                            } elseif($resultAdminPrenotation['data_ritiro'] && $resultAdminPrenotation['data_restituzione']) {

                                $totalCost = $resultAdminPrenotation['prezzo_noleggio'] * intval((strtotime($resultAdminPrenotation['data_restituzione']) - strtotime($resultAdminPrenotation['data_ritiro']))/86400);

                            } elseif($resultAdminPrenotation['data_ritiro'] && !$resultAdminPrenotation['data_restituzione']) {

                                $totalCost = $resultAdminPrenotation['prezzo_noleggio'] * intval((time() - strtotime($resultAdminPrenotation['data_ritiro']))/86400);

                            } else {

                                $totalCost = 0;

                            }

                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONTOTALCOST$', $totalCost, $templateAdminPrenotation);

                            $formAdminModify = '';
                            $formAdminDelete = '';

                            if($resultAdminPrenotation['data_ritiro'] == NULL && $resultAdminPrenotation['data_restituzione'] == NULL) {

                                $formAdminModify = '<form action="phpAdminPrenotationListPage.php?menu=modificapren" method="post">
                                <fieldset>
                                <legend>Bottone modifica</legend>
                                $REPLACEHIDDENMODIFYCODE$
                                <button type="submit" tabindex="' . $tabindex . '">Modifica</button>
                                </fieldset>
                                </form>';

                                $tabindex = $tabindex + 1;

                                $formAdminDelete = '<form action="phpAdminPrenotationListPageDelete.php" method="post">
                                <fieldset>
                                <legend>Bottone elimina</legend>
                                $REPLACEHIDDENDELETECODE$
                                <button type="submit" tabindex="' . $tabindex . '">Elimina</button>
                                </fieldset>
                                </form>';

                                $tabindex = $tabindex + 1;

                                $formAdminModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replaceAdminNumber . '"/>
                                <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                                <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $formAdminModify);

                                $formAdminDelete = str_replace('$REPLACEHIDDENDELETECODE$', '<input type="hidden" name="numprenotazione" value="' . $replaceAdminNumber . '"/>
                                <input type="hidden" name="tipeOfConsole" value="' . $resultAdminPrenotation['console'] . '"/>
                                <input type="hidden" name="code" value="' . $resultAdminPrenotation['videogioco'] . '"/>
                                ', $formAdminDelete);

                            } else {

                                $formAdminModify = '<form action="phpAdminPrenotationListPage.php?menu=modificapren" method="post">
                                <fieldset>
                                <legend>Bottone modifica</legend>
                                $REPLACEHIDDENMODIFYCODE$
                                <button type="submit" tabindex="' . $tabindex . '">Modifica</button>
                                </fieldset>
                                </form>';

                                $tabindex = $tabindex + 1;

                                $formAdminDelete = '<form action="" method="post">
                                <fieldset>
                                <legend>Bottone elimina</legend>
                                $REPLACEHIDDENDELETECODE$
                                <button type="submit" disabled="disabled">Elimina</button>
                                </fieldset>
                                </form>';

                                $formAdminModify = str_replace('$REPLACEHIDDENMODIFYCODE$', '<input type="hidden" name="numprenotazione" value="' . $replaceAdminNumber . '"/>
                                <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                                <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $formAdminModify);
                                $formAdminDelete = str_replace('$REPLACEHIDDENDELETECODE$', '', $formAdminDelete);

                            }

                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMMODIFY$', $formAdminModify, $templateAdminPrenotation);
                            $templateAdminPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMDELETE$', $formAdminDelete, $templateAdminPrenotation);


                            $adminTotalPrenotationPage = $adminTotalPrenotationPage . $templateAdminPrenotation;

                            $pStart = $pStart + 1;

                        }

                        if($resultAdminPrenotation == NULL) $pStart = $pStart + 1;
                        else $pStart;

                        mysqli_close($connectionDatabase);

                        if($boolWhileIsFetch) {

                            if(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'yes') {

                                $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione eliminata con successo!</p>', $centralBody);

                            } elseif(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'no') {

                                $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione non eliminata, problema con il <span xml:lang="en" lang="en">database</span>!</p>', $centralBody);

                            } else {

                                $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '', $centralBody);

                            }

                            $prevPStart = $_GET["pstart"] - ($_GET["pfinish"] - $_GET["pstart"]);
                            $prevPFinish = $_GET["pstart"];

                            $numberPage = $_GET["pfinish"]/($_GET["pfinish"] - $_GET["pstart"]);

                            $centralBody = str_replace('$PRENOTATIONUMBERPAGE$', '<p class="NumberPage">Pagina ' . $numberPage . '</p>', $centralBody);

                            $centralBody = str_replace('$PRENOTATIONLIST$', $adminTotalPrenotationPage, $centralBody);

                            if($_GET["pstart"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '', $centralBody);
                            else $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '<a class="MovePagePrec" title="Questo link porta alla pagina precedente" href="phpPrincipal.php?menu=prenotazioni&amp;tipeOfConsole=' . $tipeOfConsole . '&amp;code=' . $code . '&amp;fromVideogame=yes&amp;pstart=' . $prevPStart . '&amp;pfinish=' . $prevPFinish . '">Pagina precedente</a>', $centralBody);

                            $nextPStart = $_GET["pfinish"];
                            $nextPFinish = $_GET["pfinish"] + ($_GET["pfinish"] - $_GET["pstart"]);

                            if($pStart != $pFinish || $resultUserPrenotation == NULL) $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '', $centralBody);
                            else $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '<a class="MovePageSucc" title="Questo link porta alla pagina successiva" href="phpPrincipal.php?menu=prenotazioni&amp;tipeOfConsole=' . $tipeOfConsole . '&amp;code=' . $code . '&fromVideogame=yes&amp;pstart=' . $nextPStart . '&amp;pfinish=' . $nextPFinish . '">Pagina successiva</a>', $centralBody);

                        } else {

                            $centralBody = '<p>Non sono state trovate prenotazioni per questo videogioco</p>';

                        }


                    } else {

                        $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                } else {

                    $centralBody = '<p>Effettua una ricerca nome del videogioco</p>';

                }

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                $centralBody = file_get_contents('../HTML/UserPrenotationList.html');

                include('phpConnectionDatabase.php');
                $username = $_SESSION["username"];
                $userTotalPrenotationPage = '';

                $query_userPrenotation = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE prenotazione.utente = '$username' ORDER BY prenotazione.id DESC";

                $requestUserPrenotation = $connectionDatabase -> query($query_userPrenotation);
                $resultUserPrenotation = NULL;

                if($requestUserPrenotation) {

                    $requestUserPrenotation -> data_seek($pStart);
                    $tabindex = 13;

                    while(($resultUserPrenotation = $requestUserPrenotation -> fetch_assoc()) && $pStart < $pFinish) {

                        $boolWhileIsFetch = true;

                        $templateUserPrenotation = file_get_contents('../HTML/TemplateUserPrenotation.html');

                        $replaceUserNumber = $resultUserPrenotation['id'];

                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONUMBER$', $replaceUserNumber, $templateUserPrenotation);
                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONVIDEOGAMECODE$', $resultUserPrenotation['videogioco'] . ' - ' . $resultUserPrenotation['nome_videogioco'], $templateUserPrenotation);
                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONCONSOLE$', $resultUserPrenotation['console'], $templateUserPrenotation);
                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPRENOTATIONDATE$', $resultUserPrenotation['data_prenotazione'], $templateUserPrenotation);
                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONPICKUPDATE$', $resultUserPrenotation['data_ritiro'], $templateUserPrenotation);
                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONDELIVERDATE$', $resultUserPrenotation['data_restituzione'], $templateUserPrenotation);

                        $totalCost = 0;
                        if($resultUserPrenotation['data_ritiro'] && $resultUserPrenotation['data_restituzione'] && $resultUserPrenotation['data_ritiro'] == $resultUserPrenotation['data_restituzione']) {

                            $totalCost = $resultUserPrenotation['prezzo_noleggio'];

                        } elseif($resultUserPrenotation['data_ritiro'] && $resultUserPrenotation['data_restituzione']) {

                            $totalCost = $resultUserPrenotation['prezzo_noleggio'] * intval((strtotime($resultUserPrenotation['data_restituzione']) - strtotime($resultUserPrenotation['data_ritiro']))/86400);

                        } elseif($resultUserPrenotation['data_ritiro'] && !$resultUserPrenotation['data_restituzione']) {

                            $totalCost = $resultUserPrenotation['prezzo_noleggio'] * intval((time() - strtotime($resultUserPrenotation['data_ritiro']))/86400);

                        } else {

                            $totalCost = 0;

                        }

                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONTOTALCOST$', $totalCost, $templateUserPrenotation);

                        $formUserDelete = '';

                        if(intval(time() - strtotime($resultUserPrenotation['data_prenotazione'])) <= 86400) {

                            $formUserDelete = '<form action="phpAdminPrenotationListPageDelete.php" method="post">
                            <fieldset>
                            <legend>Bottone elimina</legend>
                            $REPLACEHIDDENDELETECODE$
                            <button type="submit" tabindex="' . $tabindex . '">Elimina</button>
                            </fieldset>
                            </form>';

                            $tabindex = $tabindex + 1;

                            $formUserDelete = str_replace('$REPLACEHIDDENDELETECODE$', '<input type="hidden" name="numprenotazione" value="' . $replaceUserNumber . '"/>
                            <input type="hidden" name="tipeOfConsole" value="' . $resultUserPrenotation['console'] . '"/>
                            <input type="hidden" name="code" value="' . $resultUserPrenotation['videogioco'] . '"/>', $formUserDelete);

                        } else {

                            $formUserDelete = '<form action="" method="post">
                           <fieldset>
                           <legend>Bottone elimina</legend>
                           $REPLACEHIDDENDELETECODE$
                           <button type="submit" disabled="disabled">Non cliccabile</button>
                           </fieldset>
                           </form>';

                            $formUserDelete = str_replace('$REPLACEHIDDENDELETECODE$', '', $formUserDelete);

                        }

                        $templateUserPrenotation = str_replace('$REPLACESINGLEPRENOTATIONFORMDELETE$', $formUserDelete, $templateUserPrenotation);

                        $userTotalPrenotationPage = $userTotalPrenotationPage . $templateUserPrenotation;

                        $pStart = $pStart + 1;

                    }

                    if($resultUserPrenotation == NULL) $pStart = $pStart + 1;
                    else $pStart;

                    mysqli_close($connectionDatabase);

                    if($boolWhileIsFetch) {

                        if(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'yes') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione eliminata con successo!</p>', $centralBody);

                        } elseif(isset($_GET["deletePr"]) && $_GET["deletePr"] == 'no') {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '<p>Prenotazione non eliminata, problema con il <span xml:lang="en" lang="en">database</span>!</p>', $centralBody);

                        } else {

                            $centralBody = str_replace('$INFORMATIONPRENOTATIONLISTPAGE$', '', $centralBody);

                        }

                        $prevPStart = $_GET["pstart"] - ($_GET["pfinish"] - $_GET["pstart"]);
                        $prevPFinish = $_GET["pstart"];

                        $numberPage = $_GET["pfinish"]/($_GET["pfinish"] - $_GET["pstart"]);

                        $centralBody = str_replace('$PRENOTATIONUMBERPAGE$', '<p class="NumberPage">Pagina ' . $numberPage . '</p>', $centralBody);

                        $centralBody = str_replace('$PRENOTATIONLIST$', $userTotalPrenotationPage, $centralBody);

                        if($_GET["pstart"] == 0) $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKPREVIOUSPAGEPRENOTATIONLIST$', '<a class="MovePagePrec" title="Questo link porta alla pagina precedente" href="phpPrincipal.php?menu=prenotazioni&amp;pstart=' . $prevPStart . '&amp;pfinish=' . $prevPFinish . '&amp;fromVideogame=' . $_GET["fromVideogame"] . '">Pagina precedente</a>', $centralBody);

                        $nextPStart = $_GET["pfinish"];
                        $nextPFinish = $_GET["pfinish"] + ($_GET["pfinish"] - $_GET["pstart"]);

                        if($pStart != $pFinish || $resultUserPrenotation == NULL) $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '', $centralBody);
                        else $centralBody = str_replace('$LINKNEXTPAGEPRENOTATIONLIST$', '<a class="MovePageSucc" title="Questo link porta alla pagina successiva" href="phpPrincipal.php?menu=prenotazioni&amp;pstart=' . $nextPStart . '&amp;pfinish=' . $nextPFinish . '&amp;fromVideogame=' . $_GET["fromVideogame"] . '">Pagina successiva</a>', $centralBody);

                    } else {

                        $centralBody = '<p>Non sono state trovate prenotazioni. Effettua la tua prima prenotazione!</p>';

                    }

                } else {

                    $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $centralBody;

            }

        }

    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }

}

?>
