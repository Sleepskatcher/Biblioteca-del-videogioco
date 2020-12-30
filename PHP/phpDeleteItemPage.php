<?php

session_start();

include("phpAssemblyPageOutPhpPrincipal.php");
include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

include('phpConnectionDatabase.php');

$formDeleteItemPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'eliminavid' &&  count($_GET) < 2/*empty($_GET)*/) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $formDeleteItemPage = file_get_contents('../HTML/DeleteItemPage.html');
            $code = '';
            if(isset($_POST["code"])) $code = $_POST["code"];
            $tipeOfConsole = '';
            if(isset($_POST["tipeOfConsole"])) $tipeOfConsole = $_POST["tipeOfConsole"];
            $query_selectDeleteItem = "SELECT * FROM videogioco INNER JOIN disponibili ON videogioco.codice = disponibili.videogioco WHERE videogioco.codice = '$code' AND disponibili.console = '$tipeOfConsole'";

            $requestSelectDeleteItem = $connectionDatabase -> query($query_selectDeleteItem);
            $resultSelectDeleteItem = NULL;

            if($requestSelectDeleteItem) {

                $resultSelectDeleteItem = $requestSelectDeleteItem -> fetch_assoc();

                if($resultSelectDeleteItem != NULL) {

                    if($resultSelectDeleteItem['copie'] == 0 && $resultSelectDeleteItem['noleggiati'] > $resultSelectDeleteItem['copie']) $formDeleteItemPage = str_replace('$ERRORDELETEITEMPAGE$', '<p>L\'eliminazione del prodotto dal catalogo non ha può eesere effettuata. Ci sono ancora delle copie in prenotazione e/o noleggiati. Schiacciando su elimina verranno messe a zero le copie in modo che nessun altro possa ordinarne. Assicurarsi di ritirare tutte le copie per procedere all\'eliminazione del prodotto. Schiacciare <a title="link che porta alle prenotazioni" href="phpPrincipal.php?menu=prenotazioni&amp;tipeOfConsole=' . $tipeOfConsole . '&amp;code=' . $code . '&amp;pstart=0&amp;pfinish=10&amp;fromVideogame=yes">QUI</a> per andare alla pagina di prenotazione per questo videogioco in modo da visualizzare le prenotazioni ancora in atto per questo videogioco</p>', $formDeleteItemPage);
                    else $formDeleteItemPage = str_replace('$ERRORDELETEITEMPAGE$', '<p>Qui elimini il videogioco per la <span xml:lang="en" lang="en">console</span> selezionata. Quel videogioco non sarà più disponibile per quella <span xml:lang="en" lang="en">console</span></p>', $formDeleteItemPage);

                    $formDeleteItemPage = str_replace('$DELETEITEMVIDEOGAMEHIDDENCODE$', '<p>Codice videogioco: ' . $code . '</p>', $formDeleteItemPage);

                    $formDeleteItemPage = str_replace('$DELETEITEMHIDDENCODEANDTIPEOFCONSOLE$', '<input type="hidden" name="code" value="' . $code . '"/>
                    <input type="hidden" name="tipeOfConsole" value="' . $tipeOfConsole . '"/>', $formDeleteItemPage);
                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMENAME$', $resultSelectDeleteItem['nome'], $formDeleteItemPage);
                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $formDeleteItemPage);
                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMEEXITDATE$', $resultSelectDeleteItem['data_uscita'], $formDeleteItemPage);

                    if($resultSelectDeleteItem['pegi'] == 3) {

                        $formDeleteItemPage = str_replace('$SELCETPEGI3$', 'selected="selected"', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI7$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI12$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI16$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI18$', '', $formDeleteItemPage);


                    } elseif($resultSelectDeleteItem['pegi'] == 7) {

                        $formDeleteItemPage = str_replace('$SELCETPEGI3$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI7$', 'selected="selected"', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI12$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI16$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI18$', '', $formDeleteItemPage);

                    } elseif($resultSelectDeleteItem['pegi'] == 12) {

                        $formDeleteItemPage = str_replace('$SELCETPEGI3$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI7$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI12$', 'selected="selected"', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI16$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI18$', '', $formDeleteItemPage);

                    } elseif($resultSelectDeleteItem['pegi'] == 16) {

                        $formDeleteItemPage = str_replace('$SELCETPEGI3$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI7$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI12$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI16$', 'selected="selected"', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI18$', '', $formDeleteItemPage);

                    } else {

                        $formDeleteItemPage = str_replace('$SELCETPEGI3$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI7$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI12$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI16$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTPEGI18$', 'selected="selected"', $formDeleteItemPage);

                    }

                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMEKIND$', $resultSelectDeleteItem['genere'], $formDeleteItemPage);
                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $resultSelectDeleteItem['descrizione'], $formDeleteItemPage);
                    $formDeleteItemPage = str_replace('$VALUEVIDEOGAMEPRICE$', $resultSelectDeleteItem['prezzo_noleggio'], $formDeleteItemPage);

                    if($resultSelectDeleteItem['bestseller'] == "1") {

                        $formDeleteItemPage = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTBESTSELLERNO$', '', $formDeleteItemPage);

                    } else {

                        $formDeleteItemPage = str_replace('$SELECTBESTSELLERSI$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formDeleteItemPage);

                    }

                    $requestSelectDeleteItem -> data_seek(0);
                    $boolXbox360 = false;
                    $boolXboxOne = false;
                    $boolWii = false;
                    $boolWiiU = false;
                    $boolSwitch = false;
                    $boolPlayStation3 = false;
                    $boolPlayStation4 = false;

                    while($resultSelectDeleteItem = $requestSelectDeleteItem -> fetch_assoc()) {

                        if($resultSelectDeleteItem['console'] == 'Xbox360') {

                            $formDeleteItemPage = str_replace('$CHECKXBOX360$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEXBOX360$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolXbox360 = true;

                        } elseif($resultSelectDeleteItem['console'] == 'XboxOne') {

                            $formDeleteItemPage = str_replace('$CHECKXBOXONE$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEXBOXONE$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolXboxOne = true;

                        } elseif($resultSelectDeleteItem['console'] == 'Wii') {

                            $formDeleteItemPage = str_replace('$CHECKWII$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEWII$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolWii = true;

                        } elseif($resultSelectDeleteItem['console'] == 'WiiU') {

                            $formDeleteItemPage = str_replace('$CHECKWIIU$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEWIIU$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolWiiU = true;

                        } elseif($resultSelectDeleteItem['console'] == 'Switch') {

                            $formDeleteItemPage = str_replace('$CHECKSWITCHN$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUESWITCHN$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolSwitch = true;

                        } elseif($resultSelectDeleteItem['console'] == 'PlayStation3') {

                            $formDeleteItemPage = str_replace('$CHECKPLAYSTATION3$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEPLAYSTATION3$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolPlayStation3 = true;

                        } elseif($resultSelectDeleteItem['console'] == 'PlayStation4') {

                            $formDeleteItemPage = str_replace('$CHECKPLAYSTATION4$', 'checked="checked"', $formDeleteItemPage);
                            $formDeleteItemPage = str_replace('$VALUEPLAYSTATION4$', $resultSelectDeleteItem['copie'], $formDeleteItemPage);
                            $boolPlayStation4 = true;

                        } else {

                            $formDeleteItemPage;

                        }

                    }

                    if(!$boolXbox360) {

                        $formDeleteItemPage = str_replace('$CHECKXBOX360$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEXBOX360$', '0', $formDeleteItemPage);

                    }

                    if(!$boolXboxOne) {

                        $formDeleteItemPage = str_replace('$CHECKXBOXONE$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEXBOXONE$', '0', $formDeleteItemPage);

                    }

                    if(!$boolWii) {

                        $formDeleteItemPage = str_replace('$CHECKWII$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEWII$', '0', $formDeleteItemPage);

                    }

                    if(!$boolWiiU) {

                        $formDeleteItemPage = str_replace('$CHECKWIIU$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEWIIU$', '0', $formDeleteItemPage);

                    }

                    if(!$boolSwitch) {

                        $formDeleteItemPage = str_replace('$CHECKSWITCHN$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUESWITCHN$', '0', $formDeleteItemPage);

                    }

                    if(!$boolPlayStation3) {

                        $formDeleteItemPage = str_replace('$CHECKPLAYSTATION3$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEPLAYSTATION3$', '0', $formDeleteItemPage);

                    }

                    if(!$boolPlayStation4) {

                        $formDeleteItemPage = str_replace('$CHECKPLAYSTATION4$', '', $formDeleteItemPage);
                        $formDeleteItemPage = str_replace('$VALUEPLAYSTATION4$', '0', $formDeleteItemPage);

                    }

                } else {

                    $formDeleteItemPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $formDeleteItemPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $formDeleteItemPage;

        }

    }

} else {

    $formDeleteItemPage = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

$principalPage = '';
assemblyPageOutPhpPrincipal($principalPage, $formDeleteItemPage);

echo $principalPage;

?>
