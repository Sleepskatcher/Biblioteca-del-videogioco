<?php

session_start();

include('phpAssemblyPageOutPhpPrincipal.php');
include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

include('phpConnectionDatabase.php');

$principalPage = '';
$formDeleteItemPageRequest = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'eliminavid' &&  count($_GET) < 2/*empty($_GET)*/) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $formDeleteItemPageRequest = file_get_contents('../HTML/DeleteItemPage.html');
            $code = '';
            if(isset($_POST["code"])) $code = $_POST["code"];
            $tipeOfConsole = '';
            if(isset($_POST["tipeOfConsole"])) $tipeOfConsole = $_POST["tipeOfConsole"];
            $query_deleteItemSelected = "DELETE FROM disponibili WHERE videogioco = '$code' AND console = '$tipeOfConsole'";
            $query_currentPrenotation = "SELECT utente, videogioco, console FROM prenotazione WHERE videogioco = '$code' AND console = '$tipeOfConsole' AND data_prenotazione IS NOT NULL AND data_ritiro IS NOT NULL AND data_restituzione IS NULL";
            $query_deleteFailForPrenotation = "UPDATE disponibili SET copie = 0 WHERE videogioco = '$code' AND console = '$tipeOfConsole'";

            $query_informationVideogame = "SELECT * FROM videogioco WHERE videogioco.codice = '$code'";

            $formDeleteItemPageRequest = str_replace('$DELETEITEMVIDEOGAMEHIDDENCODE$', '<p>Codice videogioco: ' . $code . '</p>', $formDeleteItemPageRequest);

            $formDeleteItemPageRequest = str_replace('$DELETEITEMHIDDENCODEANDTIPEOFCONSOLE$', '', $formDeleteItemPageRequest);

            $requestCurrentPrenotation = $connectionDatabase -> query($query_currentPrenotation);
            $resultCurrentPrenotation = NULL;

            if($requestCurrentPrenotation) {

                $resultCurrentPrenotation = $requestCurrentPrenotation -> fetch_assoc();

                if($resultCurrentPrenotation != NULL) {

                    $requestDeleteFailForPrenotation = $connectionDatabase -> query($query_deleteFailForPrenotation);

                    if($requestDeleteFailForPrenotation) {

                        $requestInformationVideogame = $connectionDatabase -> query($query_informationVideogame);

                        if($requestInformationVideogame) {

                            $resultInformationVideogame = $requestInformationVideogame -> fetch_assoc();

                            if($resultInformationVideogame != NULL) {

                                $formDeleteItemPageRequest = str_replace('$ERRORDELETEITEMPAGE$', '<p>L\'eliminazione del prodotto dal catalogo non ha avuto successo. Ci sono ancora delle copie in prenotazione e/o noleggiati. Sono state messe le copie del prodotto a zero in modo che nessuno possa ancora prenotarle. Assicurarsi di ritirare tutte le copie per procedere all\'eliminazione del prodotto. Schiacciare <a title="link che porta alle prenotazioni" href="phpPrincipal.php?menu=prenotazioni&amp;tipeOfConsole=' . $tipeOfConsole . '&amp;code=' . $code . '&amp;pstart=0&amp;pfinish=10&amp;fromVideogame=yes">QUI</a> per andare alla pagina di prenotazione per questo videogioco in modo da visualizzare le prenotazioni ancora in atto per questo videogioco</p>', $formDeleteItemPageRequest);

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMENAME$', $resultInformationVideogame["nome"], $formDeleteItemPageRequest);

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEEXITDATE$', $resultInformationVideogame["data_uscita"], $formDeleteItemPageRequest);

                                if($resultInformationVideogame['pegi'] == 3) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);


                                } elseif($resultInformationVideogame['pegi'] == 7) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } elseif($resultInformationVideogame['pegi'] == 12) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } elseif($resultInformationVideogame['pegi'] == 16) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', 'selected="selected"', $formDeleteItemPageRequest);

                                }

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEKIND$', $resultInformationVideogame['genere'], $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $resultInformationVideogame["descrizione"], $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEPRICE$', $resultInformationVideogame['prezzo_noleggio'], $formDeleteItemPageRequest);

                                if($resultInformationVideogame['bestseller'] == "1") {

                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERNO$', '', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERSI$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formDeleteItemPageRequest);

                                }


                                if($tipeOfConsole == 'Xbox360') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKXBOX360$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEXBOX360$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKXBOX360$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEXBOX360$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'XboxOne') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKXBOXONE$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEXBOXONE$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKXBOXONE$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEXBOXONE$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'Wii') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKWII$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEWII$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKWII$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEWII$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'WiiU') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKWIIU$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEWIIU$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKWIIU$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEWIIU$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'Switch') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKSWITCHN$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUESWITCHN$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKSWITCHN$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUESWITCHN$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'PlayStation3') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION3$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION3$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION3$', '0', $formDeleteItemPageRequest);

                                }

                                if($tipeOfConsole == 'PlayStation4') {

                                    $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION4$', 'checked="checked"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION4$', '0', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION4$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION4$', '0', $formDeleteItemPageRequest);

                                }

                            } else {

                                $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                            }

                        } else {

                            $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                        }

                    } else {

                        $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                } else {

                    $requestDeleteItemSelected = $connectionDatabase -> query($query_deleteItemSelected);


                    if($requestDeleteItemSelected) {

                        $formDeleteItemPageRequest = str_replace('$ERRORDELETEITEMPAGE$', '<p>L\'eliminazione del prodotto, per la console che era selezionata, dal catalogo ha avuto successo!</p>', $formDeleteItemPageRequest);

                        $requestInformationVideogame = $connectionDatabase -> query($query_informationVideogame);

                        //rimetto infromazioni del videogioco
                        if($requestInformationVideogame) {

                            $resultInformationVideogame = $requestInformationVideogame -> fetch_assoc();

                            if($resultInformationVideogame != NULL) {

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMENAME$', $resultInformationVideogame['nome'], $formDeleteItemPageRequest);

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEEXITDATE$', $resultInformationVideogame['data_uscita'], $formDeleteItemPageRequest);

                                if($resultInformationVideogame['pegi'] == 3) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);


                                } elseif($resultInformationVideogame['pegi'] == 7) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } elseif($resultInformationVideogame['pegi'] == 12) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } elseif($resultInformationVideogame['pegi'] == 16) {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', '', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$SELCETPEGI3$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI7$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI12$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI16$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTPEGI18$', 'selected="selected"', $formDeleteItemPageRequest);

                                }

                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEKIND$', $resultInformationVideogame['genere'], $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $resultInformationVideogame['descrizione'], $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEVIDEOGAMEPRICE$', $resultInformationVideogame['prezzo_noleggio'], $formDeleteItemPageRequest);

                                if($resultInformationVideogame['bestseller'] == "1") {

                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERNO$', '', $formDeleteItemPageRequest);

                                } else {

                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERSI$', '', $formDeleteItemPageRequest);
                                    $formDeleteItemPageRequest = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formDeleteItemPageRequest);

                                }

                                $formDeleteItemPageRequest = str_replace('$CHECKXBOX360$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEXBOX360$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKXBOXONE$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEXBOXONE$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKWII$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEWII$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKWIIU$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEWIIU$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKSWITCHN$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUESWITCHN$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION3$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION3$', '0', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$CHECKPLAYSTATION4$', '', $formDeleteItemPageRequest);
                                $formDeleteItemPageRequest = str_replace('$VALUEPLAYSTATION4$', '0', $formDeleteItemPageRequest);

                            } else {

                                $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                            }

                        } else {

                            $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                        }

                    } else {

                        $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                }

            } else {

                $formDeleteItemPageRequest = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $formDeleteItemPageRequest;

        }

    }

} else {

    $formDeleteItemPageRequest = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

assemblyPageOutPhpPrincipal($principalPage, $formDeleteItemPageRequest);

echo $principalPage;

?>
