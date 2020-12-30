<?php

function assemblyVideogamePage(&$centralBody) {

    if(isset($_GET["tipeOfConsole"]) && isset($_GET["code"])) {

        $centralBody = file_get_contents('../HTML/VideogamePage.html');

        include('phpConnectionDatabase.php');
        $console = '';
        if(isset($_GET["console"])) $console = $_GET["console"];
        $tipeOfConsole = '';
        if(isset($_GET["tipeOfConsole"])) $tipeOfConsole = $_GET["tipeOfConsole"];
        $code = '';
        if(isset($_GET["code"])) $code = $_GET["code"];

        $query_takeDataFromDatabaseVideogame = "SELECT * FROM videogioco INNER JOIN disponibili ON videogioco.codice = disponibili.videogioco WHERE videogioco.codice = '$code' AND disponibili.console = '$tipeOfConsole'";

        $query_availableFor = "";

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') $query_availableFor = "SELECT console FROM disponibili WHERE videogioco = '$code' ORDER BY console";
        else $query_availableFor = "SELECT console FROM disponibili WHERE videogioco = '$code' AND copie <> '0' ORDER BY console";

        $requestTakeDataFromDatabaseVideogame = $connectionDatabase -> query($query_takeDataFromDatabaseVideogame);

        if($requestTakeDataFromDatabaseVideogame) {

            $resultTakeDataFromDatabaseVideogame = $requestTakeDataFromDatabaseVideogame -> fetch_assoc();

            if($resultTakeDataFromDatabaseVideogame != NULL) {

                if((isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && $_GET["tipeOfConsole"] == $resultTakeDataFromDatabaseVideogame['console'] && $_GET["code"] == $resultTakeDataFromDatabaseVideogame['codice']) || (isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && $_GET["tipeOfConsole"] == $resultTakeDataFromDatabaseVideogame['console'] && $_GET["code"] == $resultTakeDataFromDatabaseVideogame['codice'])) {

                    $videogameName = $resultTakeDataFromDatabaseVideogame['nome'];
                    $videogameExitDateEngl = $resultTakeDataFromDatabaseVideogame['data_uscita'];

                    $day = substr($videogameExitDateEngl, 8, 2); //gli ordino la data in italiano in modo che abbia senso

                    $month = substr($videogameExitDateEngl, 5, 2);

                    $year = substr($videogameExitDateEngl, 0, 4);

                    $videogameExitDate = $day . '-' . $month . '-' . $year;

                    $videogameKind = $resultTakeDataFromDatabaseVideogame['genere'];

                    $videogameImage = $resultTakeDataFromDatabaseVideogame['copertina'];

                    $numberOfCopy = $resultTakeDataFromDatabaseVideogame['copie'];
                    $numberRental = $resultTakeDataFromDatabaseVideogame['noleggiati'];

                    $videogameAvailableFor = '';
                    $requestAvailableFor = $connectionDatabase -> query($query_availableFor);

                    if($requestAvailableFor) {

                        while($resultAvailableFor = $requestAvailableFor -> fetch_assoc()) {

                            if($resultAvailableFor['console'] != $tipeOfConsole && ($resultAvailableFor['console'] == 'Xbox360' || $resultAvailableFor['console'] == 'XboxOne')) {

                                $videogameAvailableFor = $videogameAvailableFor . ' ' . '<a title="Questo link porta allo stesso videogioco ma per un\'altra console" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;tipeOfConsole=' . $resultAvailableFor['console'] . '&amp;code=' . $code . '"><span xml:lang="en" lang="en">' . $resultAvailableFor['console'] . '</span></a>' . ',';

                            } elseif($resultAvailableFor['console'] != $tipeOfConsole && ($resultAvailableFor['console'] == 'Wii' || $resultAvailableFor['console'] == 'WiiU' || $resultAvailableFor['console'] == 'Switch')) {

                                $videogameAvailableFor = $videogameAvailableFor . ' ' . '<a title="Questo link porta allo stesso videogioco ma per altre console" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;tipeOfConsole=' . $resultAvailableFor['console'] . '&amp;code=' . $code . '"><span xml:lang="en" lang="en">' . $resultAvailableFor['console'] . '</span></a>' . ',';

                            } elseif($resultAvailableFor['console'] != $tipeOfConsole && ($resultAvailableFor['console'] == 'PlayStation3' || $resultAvailableFor['console'] == 'PlayStation4')) {

                                $videogameAvailableFor = $videogameAvailableFor . ' ' . '<a title="Questo link porta allo stesso videogioco ma per altre console" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;tipeOfConsole=' . $resultAvailableFor['console'] . '&amp;code=' . $code . '"><span xml:lang="en" lang="en">' . $resultAvailableFor['console'] . '</span></a>' . ',';

                            } else {

                                $videogameAvailableFor = $videogameAvailableFor . ' ' . '<span xml:lang="en" lang="en">' . $resultAvailableFor['console'] . '</span>' . ',';

                            }

                        }

                        $videogameAvailableFor = substr($videogameAvailableFor, 0, strlen($videogameAvailableFor)-1); //elimina ultima virgola

                    }

                    $videogamePegi = $resultTakeDataFromDatabaseVideogame['pegi'];
                    $videogameDescription = $resultTakeDataFromDatabaseVideogame['descrizione'];

                    mysqli_close($connectionDatabase);

                    if($numberOfCopy == $numberRental && $numberOfCopy != 0) {

                        $centralBody = str_replace('$INFORMATIONVIDEOGAMEPAGE$', '<p>Videogioco al momento non disponibile, tutte le copie sono noleggiate</p>', $centralBody);

                    } else {

                        $centralBody;

                    }

                    $centralBody = str_replace('$PAGEVIDEOGAMENAME$', $videogameName . ' per ' . $tipeOfConsole, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEEXITDATE$', $videogameExitDate, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEKIND$', $videogameKind, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEIMAGE$', '../COPERTINE_VIDEOGIOCHI/' . $videogameImage, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEAVAILABLEFOR$', $videogameAvailableFor, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEPEGI$', $videogamePegi, $centralBody);
                    $centralBody = str_replace('$PAGEVIDEOGAMEDESCRIPTION$', $videogameDescription, $centralBody);

                    if(!isset($_SESSION["username"])) {

                        if($numberOfCopy > $numberRental) {

                            $differenceCopy = $numberOfCopy - $numberRental;
                            $centralBody = str_replace('$INFORMATIONVIDEOGAMEPAGE$', '<p>Sono disponibili ' . $differenceCopy . ' copie. Prenotane una! Registrati per prenotare una copia.</p>', $centralBody);

                        }

                        $centralBody = str_replace('$LINKPRENOTATIONFORADMIN$', '', $centralBody);

                        $centralBody = str_replace('$PHPFILE$', '', $centralBody);
                        $centralBody = str_replace('$DISABLEORNOT$', 'disabled="disabled"', $centralBody);
                        $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONPRENOTATION$', 'Registrati per poter prenotare', $centralBody);
                        $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCODEPRENOTATION$', '', $centralBody);
                        $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCONSOLEPRENOTATION$', '', $centralBody);

                        $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINMODIFY$', '', $centralBody);
                        $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINDELETE$', '', $centralBody);

                    } else {

                        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                            $centralBody = str_replace('$LINKPRENOTATIONFORADMIN$', '<a title="Questo link porta alla pagina prenotazioni" href="phpPrincipal.php?menu=prenotazioni&amp;tipeOfConsole=' . $tipeOfConsole . '&amp;code=' . $code . '&amp;fromVideogame=yes&amp;pstart=0&amp;pfinish=10">Prenotazioni attive per questo videogioco</a>', $centralBody);


                            $differenceCopy = $numberOfCopy - $numberRental;
                            $pInformationForAdmin = '<p>Codice videogioco: ' . $code;
                            $pInformationForAdmin = $pInformationForAdmin . '</p>
                            <p>Questo videogioco ha ' . $numberOfCopy . ' copie totali. Sono disponibili per essere noleggiate ancora ' . $differenceCopy . ' copie. Sono noleggiate ' . $numberRental .  ' copie</p>';

                            if($numberOfCopy == 0) $pInformationForAdmin = $pInformationForAdmin . '<p>Attenzione quando tutte le copie noleggiate torneranno indietro in negozio procedere all\'eliminazione del prodotto.</p>';
                            else $pInformationForAdmin;

                            $centralBody = str_replace('$INFORMATIONVIDEOGAMEPAGE$', $pInformationForAdmin, $centralBody);


                            $centralBody = str_replace('$PHPFILE$', '', $centralBody);
                            $centralBody = str_replace('$DISABLEORNOT$', 'disabled="disabled"', $centralBody);
                            $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONPRENOTATION$', 'Sei l\'amministratore, non puoi prenotare', $centralBody);
                            $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCODEPRENOTATION$', '', $centralBody);
                            $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCONSOLEPRENOTATION$', '', $centralBody);

                            $formModify = '<form action="phpModifyItemPage.php?menu=modificavid" method="post">
                            <fieldset>
                            <legend>Modifica</legend>
                            <input type="hidden" name="code" value="' . $code . '"/>
                            <button type="submit">Modifica</button>
                            </fieldset>
                            </form>';

                            $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINMODIFY$', $formModify, $centralBody);

                            $formDelete = '<form action="phpDeleteItemPage.php?menu=eliminavid" method="post">
                            <fieldset>
                            <legend>Modifica</legend>
                            <input type="hidden" name="code" value="' . $code . '"/>
                            <input type="hidden" name="tipeOfConsole" value="' . $tipeOfConsole . '"/>
                            <button type="submit">Elimina</button>
                            </fieldset>
                            </form>';

                            $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINDELETE$', $formDelete, $centralBody);


                        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                            $centralBody = str_replace('$LINKPRENOTATIONFORADMIN$', '', $centralBody);

                            if($numberOfCopy > $numberRental) {

                                $differenceCopy = $numberOfCopy - $numberRental;
                                $centralBody = str_replace('$INFORMATIONVIDEOGAMEPAGE$', '<p>Sono disponibili ' . $differenceCopy . ' copie. Prenotane una!</p>', $centralBody);

                                $centralBody = str_replace('$PHPFILE$', 'phpPrenotationVideogame.php', $centralBody);
                                $centralBody = str_replace('$DISABLEORNOT$', '', $centralBody);
                                $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONPRENOTATION$', 'Prenota', $centralBody);
                                $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCODEPRENOTATION$', '<input type="hidden" name="code" value="' . $code . '"/>', $centralBody); /*<input type="hidden" name="videogameName" value="' . $resultTakeDataFromDatabaseVideogame['nome'] . '"/>*/
                                $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCONSOLEPRENOTATION$', '<input type="hidden" name="tipeOfConsole" value="' . $tipeOfConsole . '"/>', $centralBody);

                            } else {

                                $centralBody = str_replace('$INFORMATIONVIDEOGAMEPAGE$', '', $centralBody);

                                $centralBody = str_replace('$PHPFILE$', '', $centralBody);
                                $centralBody = str_replace('$DISABLEORNOT$', 'disabled="disabled"', $centralBody);
                                $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONPRENOTATION$', 'Non disponibile', $centralBody);
                                $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCODEPRENOTATION$', '', $centralBody);
                                $centralBody = str_replace('$VIDEOGAMEPAGEHIDDENCONSOLEPRENOTATION$', '', $centralBody);

                            }

                            $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINMODIFY$', '', $centralBody);
                            $centralBody = str_replace('$PAGEVIDEOGAMEBUTTONADMINDELETE$', '', $centralBody);

                        } else {

                            $centralBody;

                        }

                    }

                } else {

                    $centralBody = file_get_contents('../HTML/errorpage404.html');

                }

            } else {

                $centralBody = '<p>Non ho trovato nulla. Videogioco non disponibile</p>';

            }

        } else {

            $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

        }

    } else {

        $centralBody = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

    }

}

?>
