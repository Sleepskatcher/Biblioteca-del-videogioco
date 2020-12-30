<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');
include('phpAssemblyCentralBody.php');
include('phpAssemblyPageOutPhpPrincipal.php');

include('phpConnectionDatabase.php');

$principalPage = '';
$listFormPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == "modificapren" && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $listFormPage = file_get_contents('../HTML/AdminPrenotationListPage.html');

            $idFormPrenotation = '';
            if(isset($_POST["listPageHiddenCode"])) $idFormPrenotation = $_POST["listPageHiddenCode"];
            $formListPagePickUpDate = '';
            if(isset($_POST["listPagePickUpDate"])) $formListPagePickUpDate = $_POST["listPagePickUpDate"];
            $formListPageDeliverDate = '';
            if(isset($_POST["listPageDeliverDate"])) $formListPageDeliverDate = $_POST["listPageDeliverDate"];
            $sendStart = '';
            if(isset($_POST["startpr"])) $sendStart = $_POST["startpr"];
            $sendFinish = '';
            if(isset($_POST["finishpr"])) $sendFinish = $_POST["finishpr"];

            $query_insertDate = '';

            $boolError = false;
            $boolUpdateRent = false;

            $linkComeBack = '';

            if(!isset($_SESSION["url"])) {

                $linkComeBack = 'phpPrincipal.php';
                $listFormPage = str_replace('$LISTPAGECOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="13"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $listFormPage);

            } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "") {

                $linkComeBack = $_SESSION["url"];
                $listFormPage = str_replace('$LISTPAGECOMEBACK$', '<a class="BackPage" title="Questo link torna indietro alla pagina precedente" href="' . $linkComeBack . '" tabindex="13"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna indietro</a>', $listFormPage);

            } else {

                $linkComeBack = 'phpPrincipal.php';
                $listFormPage = str_replace('$LISTPAGECOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="13"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $listFormPage);

            }


            if($formListPagePickUpDate == NULL && $formListPageDeliverDate == NULL) {

                $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. Non ha inserito alcuna data</p>', $listFormPage);
                $boolError = true;

            } elseif(isset($_POST["listPagePickUpDate"]) && $formListPagePickUpDate != NULL && $formListPageDeliverDate == NULL) {

                $query_insertDate = "UPDATE prenotazione SET data_ritiro = '$formListPagePickUpDate' WHERE id = '$idFormPrenotation'";

            } elseif(isset($_POST["listPagePickUpDate"]) && isset($_POST["listPageDeliverDate"]) && $formListPagePickUpDate != NULL && $formListPageDeliverDate != NULL) {

                $query_insertDate = "UPDATE prenotazione SET data_ritiro = '$formListPagePickUpDate', data_restituzione = '$formListPageDeliverDate' WHERE id = '$idFormPrenotation'";
                $boolUpdateRent = true;

            } else {

                $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. Hai inserito la data di consegna e non quella di ritiro, errore</p>', $listFormPage);
                $boolError = true;

            }

            $query_controlDate = "SELECT * FROM prenotazione WHERE id = '$idFormPrenotation'";
            $requestControlDate = $connectionDatabase -> query($query_controlDate);
            $resultControlDate = '';

            if($requestControlDate) {

                $resultControlDate = $requestControlDate -> fetch_assoc();

                if($resultControlDate != NULL) {

                    if(isset($_POST["listPagePickUpDate"]) && $resultControlDate['data_prenotazione'] > $formListPagePickUpDate) {

                        //data prenotazione paggiore di data ritiro effettivo
                        $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. La data di prenotazione è maggiore della data di ritiro</p>', $listFormPage);
                        $boolError = true;
                        $boolUpdateRent = false;

                    } elseif(isset($_POST["listPagePickUpDate"]) && isset($_POST["listPageDeliverDate"]) && $formListPageDeliverDate != NULL && $formListPagePickUpDate > $formListPageDeliverDate) {

                        //data di ritiro > data restituzione
                        $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. La data di ritiro è maggiore della data di restituzione</p>', $listFormPage);
                        $boolError = true;
                        $boolUpdateRent = false;

                    } elseif(isset($_POST["listPageDeliverDate"]) && $formListPageDeliverDate != NULL && $resultControlDate['data_prenotazione'] > $formListPageDeliverDate) {

                        //data prenotazione > data restituzione
                        $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. La data di prenotazione è maggiore della data di restituzione</p>', $listFormPage);
                        $boolError = true;
                        $boolUpdateRent = false;

                    } elseif((!isset($_POST["listPageDeliverDate"]) && $formListPageDeliverDate == NULL && $resultControlDate['data_ritiro'] != NULL && $resultControlDate['data_restituzione'] == NULL) || (isset($_POST["listPagePickUpDate"]) && isset($_POST["listPageDeliverDate"]) && $formListPagePickUpDate == $resultControlDate['data_ritiro'] && $formListPageDeliverDate == $resultControlDate['data_restituzione'])) {

                        $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. Non hai modificato nulla</p>', $listFormPage);
                        $boolError = true;
                        $boolUpdateRent = false;

                    } elseif($resultControlDate['data_ritiro'] != NULL && $resultControlDate['data_restituzione'] != NULL && ((isset($_POST["listPagePickUpDate"]) && $formListPagePickUpDate == NULL) || (isset($_POST["listPageDeliverDate"]) && $formListPageDeliverDate == NULL))) {

                        $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica non effettuata. Hai provato ad eliminare una delle due date o entrambe, non  puoi farlo.</p>', $listFormPage);
                        $boolError = true;
                        $boolUpdateRent = false;

                    } elseif($resultControlDate['data_ritiro'] != NULL && $resultControlDate['data_restituzione'] != NULL && isset($_POST["listPagePickUpDate"]) && isset($_POST["listPageDeliverDate"]) && ($resultControlDate['data_ritiro'] != $formListPagePickUpDate || $resultControlDate['data_restituzione'] != $formListPageDeliverDate)) {

                        //questo controllo mi serve perchè una volta che avrò inserito una data di riconsegna non adnrò a toccare i noleggiati
                        $boolUpdateRent = false;

                    } else {

                        $boolError = false;

                    }

                } else {

                    $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }



            if($boolError) {

                $query_takeOldDate = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE prenotazione.id = '$idFormPrenotation'";
                $requestTakeOldDate = $connectionDatabase -> query($query_takeOldDate);
                $resultTakeOldDate = '';
                //printa di nuovo la pagina, lancio query al database e non faccio UPDATE;

                if($requestTakeOldDate) {

                    $resultTakeOldDate = $requestTakeOldDate -> fetch_assoc();

                    if($resultTakeOldDate != NULL) {

                        $listFormPage = str_replace('$LISTPAGEAUTOINCREMENTALCODE$', '<p>Numero della prenotazione: ' . $idFormPrenotation . '</p>', $listFormPage);
                        $listFormPage = str_replace('$LISTPAGEHIDDENCODE$', '<input type="hidden" name="listPageHiddenCode" value="' . $idFormPrenotation . '"/>
                        <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                        <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEUSERNAME$', $resultTakeOldDate['utente'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEVIDEOGAMECODE$', $resultTakeOldDate['videogioco'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEVIDEOGAMENAME$', $resultTakeOldDate['nome_videogioco'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGECONSOLE$', $resultTakeOldDate['console'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEPRENOTATIONDATE$', $resultTakeOldDate['data_prenotazione'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEPICKUPDATE$', $resultTakeOldDate['data_ritiro'], $listFormPage);
                        $listFormPage = str_replace('$VALUELISTPAGEDELIVERDATE$', $resultTakeOldDate['data_restituzione'], $listFormPage);

                        $listFormPageTotalCost = 0;

                        if($resultTakeOldDate['data_ritiro'] && $resultTakeOldDate['data_restituzione'] && $resultTakeOldDate['data_ritiro'] == $resultTakeOldDate['data_restituzione']) {

                            $listFormPageTotalCost = $resultTakeOldDate['prezzo_noleggio'];

                        } elseif($resultTakeOldDate['data_ritiro'] && $resultTakeOldDate['data_restituzione']) {

                            $listFormPageTotalCost = $resultTakeOldDate['prezzo_noleggio'] *  intval((strtotime($resultTakeOldDate['data_restituzione']) - strtotime($resultTakeOldDate['data_ritiro']))/86400);

                        } elseif($resultTakeOldDate['data_ritiro'] && !$resultTakeOldDate['data_restituzione']) {

                            $listFormPageTotalCost = $resultTakeOldDate['prezzo_noleggio'] * intval((time() - strtotime($resultTakeOldDate['data_ritiro']))/86400);

                        } else {

                            $listFormPageTotalCost = 0;

                        }

                        $listFormPage = str_replace('$VALUELISTPAGETOTALCOST$', $listFormPageTotalCost, $listFormPage);

                    } else {

                        $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                } else {

                    $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                //controllare che data che inserisco sia effettivamente maggiore della precedente altrimenti....è un errore!!!

                $requestInsertDate = $connectionDatabase -> query($query_insertDate);
                $resultNewDate = '';
                //qui lancio query al database, controllo che la nuova data sia maggiore di quella precedente data_ritiro >= data_prenotazione
                if($requestInsertDate) {

                    $query_takeNewData = "SELECT prenotazione.id, prenotazione.utente, prenotazione.videogioco, prenotazione.nome_videogioco, prenotazione.console, prenotazione.data_prenotazione, prenotazione.data_ritiro, prenotazione.data_restituzione, videogioco.prezzo_noleggio FROM prenotazione INNER JOIN videogioco ON prenotazione.videogioco = videogioco.codice WHERE prenotazione.id = '$idFormPrenotation'";
                    $requestTakeNewData = $connectionDatabase -> query($query_takeNewData);
                    $resultTakeNewData = '';

                    if($requestTakeNewData) {

                        $resultTakeNewData = $requestTakeNewData -> fetch_assoc();

                        if($resultTakeNewData != NULL) {

                            $listFormPage = str_replace('$ERRORADMINPRENOTATIONLISTPAGE$', '<p>Modifica avvenuta con successo</p>', $listFormPage);
                            $listFormPage = str_replace('$LISTPAGEAUTOINCREMENTALCODE$', '<p>Numero della prenotazione: ' . $idFormPrenotation . '</p>', $listFormPage);
                            $listFormPage = str_replace('$LISTPAGEHIDDENCODE$', '<input type="hidden" name="listPageHiddenCode" value="' . $idFormPrenotation . '"/>
                            <input type="hidden" name="startpr" value="' . $sendStart . '"/>
                            <input type="hidden" name="finishpr" value="' . $sendFinish . '"/>', $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEUSERNAME$', $resultTakeNewData['utente'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEVIDEOGAMECODE$', $resultTakeNewData['videogioco'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEVIDEOGAMENAME$', $resultTakeNewData['nome_videogioco'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGECONSOLE$', $resultTakeNewData['console'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEPRENOTATIONDATE$', $resultTakeNewData['data_prenotazione'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEPICKUPDATE$', $resultTakeNewData['data_ritiro'], $listFormPage);
                            $listFormPage = str_replace('$VALUELISTPAGEDELIVERDATE$', $resultTakeNewData['data_restituzione'], $listFormPage);

                            $listFormPageTotalCost = 0;

                            if($resultTakeNewData['data_ritiro'] && $resultTakeNewData['data_restituzione'] && $resultTakeNewData['data_ritiro'] == $resultTakeNewData['data_restituzione']) {

                                $listFormPageTotalCost = $resultTakeNewData['prezzo_noleggio'];

                            } elseif($resultTakeNewData['data_ritiro'] && $resultTakeNewData['data_restituzione']) {

                                $listFormPageTotalCost = $resultTakeNewData['prezzo_noleggio'] *  intval((strtotime($resultTakeNewData['data_restituzione']) - strtotime($resultTakeNewData['data_ritiro']))/86400);

                            } elseif($resultTakeNewData['data_ritiro'] && !$resultTakeNewData['data_restituzione']) {

                                $listFormPageTotalCost = $resultTakeNewData['prezzo_noleggio'] * intval((time() - strtotime($resultTakeNewData['data_ritiro']))/86400);

                            } else {

                                $listFormPageTotalCost = 0;

                            }

                            $listFormPage = str_replace('$VALUELISTPAGETOTALCOST$', $listFormPageTotalCost, $listFormPage);

                            if($boolUpdateRent && $resultTakeNewData['data_ritiro'] != NULL && $resultTakeNewData['data_restituzione'] != NULL) {

                                $code = $resultTakeNewData['videogioco'];
                                $tipeOfConsole = $resultTakeNewData['console'];
                                $query_updateRent = "UPDATE disponibili SET noleggiati = noleggiati - 1 WHERE videogioco = '$code' AND console = '$tipeOfConsole'";

                                $requestUpdateRent = $connectionDatabase -> query($query_updateRent);

                                if($requestUpdateRent) {

                                    $listFormPage;

                                } else {

                                    $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                                }

                            }

                        } else {

                            $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                        }

                    } else {

                        $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                } else {

                    $listFormPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $listFormPage;

        }

    }

} else {

    $listFormPage = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

assemblyPageOutPhpPrincipal($principalPage, $listFormPage);

echo $principalPage;

?>
