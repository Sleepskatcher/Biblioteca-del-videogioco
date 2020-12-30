<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');
include('phpAssemblyCentralBody.php');
include('phpAssemblyPageOutPhpPrincipal.php');

include('phpConnectionDatabase.php');


$principalPage = '';
$paginaFormAddItem = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'inserimentovid' && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $boolassemblyLateralSubMenu = true;

            $paginaFormAddItem = file_get_contents('../HTML/SubAdminMenuAddItem.html');

            if(isset($_POST["vidName"]) /*&& isset($_POST["vidImage"])*/ && isset($_FILES["vidImage"]) /*&& is_uploaded_file($_FILES["vidImage"]["tmp_name"])*/ && isset($_POST["vidExitDate"]) && isset($_POST["vidPegi"]) && isset($_POST["vidKind"]) && isset($_POST["vidDescription"]) && isset($_POST["vidPrice"]) && isset($_POST["vidBestSel"]) && isset($_POST["QXbox360"]) && isset($_POST["QXboxOne"]) && isset($_POST["QWii"]) && isset($_POST["QWiiU"]) && isset($_POST["QSwitchN"]) && isset($_POST["QPlayStation3"]) && isset($_POST["QPlayStation4"])) {

                $videogameName = $_POST["vidName"];
                $videogameImage = '';
                $videogameDate = $_POST["vidExitDate"];
                $videogamePegi = $_POST["vidPegi"];
                $videogameKind = $_POST["vidKind"];
                $videogameDescription = $_POST["vidDescription"];
                $videogamePrice = $_POST["vidPrice"];
                $videogameBestSeller = $_POST["vidBestSel"];

                $checkXbox360 = '';
                if(isset($_POST["ItemXbox360"])) $checkXbox360 = $_POST["ItemXbox360"];
                $xbox360 = $_POST["QXbox360"];
                $checkXboxOne = '';
                if(isset($_POST["ItemXboxOne"])) $checkXboxOne = $_POST["ItemXboxOne"];
                $xboxOne = $_POST["QXboxOne"];
                $checkWii = '';
                if(isset($_POST["ItemWii"])) $checkWii = $_POST["ItemWii"];
                $wii = $_POST["QWii"];
                $checkWiiU = '';
                if(isset($_POST["ItemWiiU"])) $checkWiiU = $_POST["ItemWiiU"];
                $wiiU = $_POST["QWiiU"];
                $checkSwitchN = '';
                if(isset($_POST["ItemSwitchN"])) $checkSwitchN = $_POST["ItemSwitchN"];
                $switchN = $_POST["QSwitchN"];
                $checkPlayStation3 = '';
                if(isset($_POST["ItemPlayStation3"])) $checkPlayStation3 = $_POST["ItemPlayStation3"];
                $playStation3 = $_POST["QPlayStation3"];
                $checkPlayStation4 = '';
                if(isset($_POST["ItemPlayStation4"])) $checkPlayStation4 = $_POST["ItemPlayStation4"];
                $playStation4 = $_POST["QPlayStation4"];

                $boolConsoleSelect = true;

                $boolNumberItem = false;

                $arrayConsole = array(isset($_POST["ItemXbox360"]), isset($_POST["ItemXboxOne"]), isset($_POST["ItemWii"]), isset($_POST["ItemWiiU"]), isset($_POST["ItemSwitchN"]), isset($_POST["ItemPlayStation3"]), isset($_POST["ItemPlayStation4"]));

                $arrayQuantity = array($_POST["QXbox360"], $_POST["QXboxOne"], $_POST["QWii"], $_POST["QWiiU"], $_POST["QSwitchN"], $_POST["QPlayStation3"], $_POST["QPlayStation4"]);

                $arrayPhrases = array('la <span xml:lang="en" lang="en">Xbox</span> 360', 'la <span xml:lang="en" lang="en">Xbox One</span>', 'la <span xml:lang="en" lang="en">Wii</span>', 'la <span xml:lang="en" lang="en">Wii U</span>', 'la <span xml:lang="en" lang="en">Switch</span>', 'la <span xml:lang="en" lang="en">PlayStation</span> 3', 'la <span xml:lang="en" lang="en">Playstation</span> 4');

                $cont = 0;

                $totArray = count($arrayConsole);

                while($boolConsoleSelect && $cont < $totArray) {

                    if($boolConsoleSelect && $arrayConsole[$cont] && !empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] > 0) {

                        $boolConsoleSelect = true;

                    } else {

                        if($boolConsoleSelect && $arrayConsole[$cont] && empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] == 0) {

                            $boolConsoleSelect = false;
                            //errore perchè non posso inserire zero videogiochi, almeno un videogioco
                            $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>Non è stata inserita alcuna copia per '. $arrayPhrases[$cont] .'. Inserire almeno una copia.</p>', $paginaFormAddItem);

                        } elseif($boolConsoleSelect && !$arrayConsole[$cont] && !empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] > 0) {

                            $boolConsoleSelect = false;
                            //errore perchè devo selezionare la casella
                            $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>Non è stata selezionata la casella per '. $arrayPhrases[$cont] .'. Selezionare la casella.</p>', $paginaFormAddItem);


                        } elseif($boolConsoleSelect && !$arrayConsole[$cont] && empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] == 0) {

                            $boolConsoleSelect = true;
                            $paginaFormAddItem;
                            //non fare nulla perchè va bene così

                        } else {

                            $boolConsoleSelect = false;
                            $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>Qualcosa è andato storto, i controlli sono saltati .</p>', $paginaFormAddItem);

                        }

                    }

                    $cont = $cont + 1;

                }

                if($boolConsoleSelect && empty($_POST["QXbox360"]) && $_POST["QXbox360"] == 0 && empty($_POST["QXboxOne"]) && $_POST["QXboxOne"] == 0 && empty($_POST["QWii"]) && $_POST["QWii"] == 0 && empty($_POST["QWiiU"]) && $_POST["QWiiU"] == 0 && empty($_POST["QSwitchN"]) && $_POST["QSwitchN"] == 0 && empty($_POST["QPlayStation3"]) && $_POST["QPlayStation3"] == 0 && empty($_POST["QPlayStation4"]) && $_POST["QPlayStation4"] == 0) {

                    $boolNumberItem = false;
                    $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>Non è stata selezionata nessuna casella per nessuna <span xml:lang="en" lang="en">console</span>. Selezionare almeno una casella ed inserire almeno una copia</p>', $paginaFormAddItem);

                } else $boolNumberItem = true;

                if(!$boolConsoleSelect || !$boolNumberItem) {

                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMENAME$', $videogameName, $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEEXITDATE$', $videogameDate, $paginaFormAddItem);

                    if($videogamePegi == 3) {

                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', 'selected="selected"', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                    } elseif($videogamePegi == 7) {

                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', 'selected="selected"', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                    } elseif($videogamePegi == 12) {

                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', 'selected="selected"', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                    } elseif($videogamePegi == 16) {

                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', 'selected="selected"', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                    } else {

                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', 'selected="selected"', $paginaFormAddItem);

                    }

                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEKIND$', $videogameKind, $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $videogameDescription, $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEPRICE$', $videogamePrice, $paginaFormAddItem);

                    if($videogameBestSeller == "1") {

                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERNO$', '', $paginaFormAddItem);

                    } else {

                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERSI$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $paginaFormAddItem);

                    }

                    if(isset($_POST["ItemXbox360"])) $paginaFormAddItem = str_replace('$CHECKXBOX360$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKXBOX360$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEXBOX360$', $xbox360, $paginaFormAddItem);

                    if(isset($_POST["ItemXboxOne"])) $paginaFormAddItem = str_replace('$CHECKXBOXONE$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKXBOXONE$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEXBOXONE$', $xboxOne, $paginaFormAddItem);

                    if(isset($_POST["ItemWii"])) $paginaFormAddItem = str_replace('$CHECKWII$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKWII$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEWII$', $wii, $paginaFormAddItem);

                    if(isset($_POST["ItemWiiU"])) $paginaFormAddItem = str_replace('$CHECKWIIU$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKWIIU$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEWIIU$', $wiiU, $paginaFormAddItem);

                    if(isset($_POST["ItemSwitchN"])) $paginaFormAddItem = str_replace('$CHECKSWITCHN$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKSWITCHN$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUESWITCHN$', $switchN, $paginaFormAddItem);

                    if(isset($_POST["ItemPlayStation3"])) $paginaFormAddItem = str_replace('$CHECKPLAYSTATION3$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKPLAYSTATION3$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEPLAYSTATION3$', $playStation3, $paginaFormAddItem);

                    if(isset($_POST["ItemPlayStation4"])) $paginaFormAddItem = str_replace('$CHECKPLAYSTATION4$', 'checked="checked"', $paginaFormAddItem);
                    else $paginaFormAddItem = str_replace('$CHECKPLAYSTATION4$', '', $paginaFormAddItem);

                    $paginaFormAddItem = str_replace('$VALUEPLAYSTATION4$', $playStation4, $paginaFormAddItem);

                } else {

                    $query_controlIfExist = "SELECT * FROM videogioco WHERE nome = '$videogameName' AND data_uscita = '$videogameDate' AND pegi = '$videogamePegi' AND genere = '$videogameKind'";
                    $requestControlIfExist = $connectionDatabase -> query($query_controlIfExist);
                    $resultControlIfExist = NULL;

                    if($requestControlIfExist) {

                        $resultControlIfExist = $requestControlIfExist -> fetch_assoc();

                        if($resultControlIfExist != NULL) {

                            $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>VIdeogioco già esistente nel catalogo. Modificalo invece di reinserirlo nuovamente!</p>', $paginaFormAddItem);

                        } else {

                            /*$pathToUpload = '/home/mmitillo/public_html/COPERTINE_VIDEOGIOCHI/';

                            $adminFile_tmp = $_FILES['vidImage']['tmp_name'];

                            //$_FILES['vidImage']['name'] = $autoIncrementalCodeJustInsert . $_FILES['vidImage']['name'];

                            $adminFile_name = $_FILES['vidImage']['name'];


                            while(file_exists($pathToUpload . $adminFile_name)) {

                                $int = rand(0, 9);
                                $adminFile_name = $int . $adminFile_name;
                                $_FILES['vidImage']['name'] = $adminFile_name;

                            }
                            //non faccio controlli perchè per arrivare qui DEVO tassattivamente avere già la path e l'immagine settata quindi il caricamente dell'immagine non può fallire...
                            if(move_uploaded_file($adminFile_tmp, $pathToUpload . $adminFile_name)) {

                                $notError;

                            } else {

                                $error;

                            }*/

                            $nameVideogameImage = $_FILES["vidImage"]["name"];

                            $query_insertVideogame = "INSERT INTO videogioco(nome, copertina, data_uscita, pegi, genere, descrizione, prezzo_noleggio, bestseller) VALUES ('$videogameName', '$nameVideogameImage', '$videogameDate', '$videogamePegi', '$videogameKind', '$videogameDescription', '$videogamePrice', '$videogameBestSeller')";

                            $requestdatabaseVideogame = $connectionDatabase -> query($query_insertVideogame);

                            $videogameNameE = mysqli_real_escape_string($connectionDatabase, $videogameName);
                            $videogameKindE = mysqli_real_escape_string($connectionDatabase, $videogameKind);
                            $videogameDescriptionE = mysqli_real_escape_string($connectionDatabase, $videogameDescription);

                            $query_justInsert = "SELECT * FROM videogioco WHERE nome = '$videogameNameE' AND copertina = '$nameVideogameImage' AND data_uscita = '$videogameDate' AND pegi = '$videogamePegi' AND genere = '$videogameKindE' AND descrizione = '$videogameDescriptionE' AND prezzo_noleggio = '$videogamePrice' AND bestseller = '$videogameBestSeller'";

                            $requestJustInsert = $connectionDatabase -> query($query_justInsert);
                            $resultJustInsert = $requestJustInsert -> fetch_assoc();

                            $autoIncrementalCodeJustInsert = $resultJustInsert['codice'];

                            $count = 0;

                            $saveConsole = NULL;
                            $saveQuantity = NULL;

                            $arrayValue = array('Xbox360', 'XboxOne', 'Wii', 'WiiU', 'Switch', 'PlayStation3', 'PlayStation4');

                            while($count < $totArray) {

                                if($arrayConsole[$count] && $arrayQuantity[$count] > 0) {

                                    $saveConsole = $arrayValue[$count];
                                    $saveQuantity = $arrayQuantity[$count];

                                    $query_insertAvailable = "INSERT INTO disponibili(videogioco, console, copie) VALUES ('$autoIncrementalCodeJustInsert', '$saveConsole', '$saveQuantity')";

                                    $requestInsertAvailable = $connectionDatabase -> query($query_insertAvailable);

                                    if($requestInsertAvailable) {

                                        $count;

                                    } else {

                                        $count = $totArray;

                                    }

                                } else {

                                    $saveConsole;
                                    $saveQuantity;

                                }

                                $count = $count + 1;

                            }

                            $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>VIdeogioco inserito correttamente!</p>', $paginaFormAddItem);

                        }


                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMENAME$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEEXITDATE$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEKIND$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEPRICE$', '0.01', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERSI$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$SELECTBESTSELLERNO$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKXBOX360$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEXBOX360$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKXBOXONE$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEXBOXONE$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKWII$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEWII$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKWIIU$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEWIIU$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKSWITCHN$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUESWITCHN$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKPLAYSTATION3$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEPLAYSTATION3$', '0', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$CHECKPLAYSTATION4$', '', $paginaFormAddItem);
                        $paginaFormAddItem = str_replace('$VALUEPLAYSTATION4$', '0', $paginaFormAddItem);

                    } else {

                        $paginaFormAddItem = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                }

            } else {

                $paginaFormAddItem = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                //lasciato per quando il caricamento dell'immagine fallisce, non è un errore o una dimenticanza
                /*if(is_uploaded_file($_FILES['vidImage']['tmp_name'])) {

                    $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>L\'immagine che hai inserito è troppo grande. Inserisci un\'immagine più piccola</p>', $paginaFormAddItem);

                } else {

                    $paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>Sei arrivato qui senza inserire un videogioco. Perchè lo hai fatto??? Non fare il birbante ed inserisci un videogioco. Non devi distruggere il sito...me lo hai pagato tu!</p>', $paginaFormAddItem);

                }*/
                /*$paginaFormAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '<p>VIdeogioco inserito correttamente!</p>', $paginaFormAddItem);

                $videogameName = '';
                if(isset($_POST["vidName"])) $videogameName = $_POST["vidName"];
                $videogameImage = '';
                if(isset($_FILES["vidImage"])) $videogameImage = $_FILES["vidImage"];
                $videogameDate = '';
                if(isset($_POST["vidExitDate"])) $videogameDate = $_POST["vidExitDate"];
                $videogamePegi = '';
                if(isset($_POST["vidPegi"])) $videogamePegi = $_POST["vidPegi"];
                $videogameKind = '';
                if(isset($_POST["vidKind"])) $videogameKind = $_POST["vidKind"];
                $videogameDescription = '';
                if(isset($_POST["vidDescription"])) $videogameDescription = $_POST["vidDescription"];
                $videogamePrice = '0.01';
                if(isset($_POST["vidPrice"])) $videogamePrice = $_POST["vidPrice"];
                $videogameBestSeller = '';
                if(isset($_POST["vidBestSel"])) $videogameBestSeller = $_POST["vidBestSel"];

                $checkXbox360 = '';
                if(isset($_POST["ItemXbox360"])) $checkXbox360 = $_POST["ItemXbox360"];
                $xbox360 = '0';
                if(isset($_POST["QXbox360"])) $xbox360 = $_POST["QXbox360"];
                $checkXboxOne = '';
                if(isset($_POST["ItemXboxOne"])) $checkXboxOne = $_POST["ItemXboxOne"];
                $xboxOne = '0';
                if(isset($_POST["QXboxOne"])) $xboxOne = $_POST["QXboxOne"];
                $checkWii = '';
                if(isset($_POST["ItemWii"])) $checkWii = $_POST["ItemWii"];
                $wii = '0';
                if(isset($_POST["QWii"])) $wii = $_POST["QWii"];
                $checkWiiU = '';
                if(isset($_POST["ItemWiiU"])) $checkWiiU = $_POST["ItemWiiU"];
                $wiiU = '0';
                if(isset($_POST["QWiiU"])) $wiiU = $_POST["QWiiU"];
                $checkSwitchN = '';
                if(isset($_POST["ItemSwitchN"])) $checkSwitchN = $_POST["ItemSwitchN"];
                $switchN = '0';
                if(isset($_POST["QSwitchN"])) $switchN = $_POST["QSwitchN"];
                $checkPlayStation3 = '';
                if(isset($_POST["ItemPlayStation3"])) $checkPlayStation3 = $_POST["ItemPlayStation3"];
                $playStation3 = '0';
                if(isset($_POST["QPlayStation3"])) $playStation3 = $_POST["QPlayStation3"];
                $checkPlayStation4 = '';
                if(isset($_POST["ItemPlayStation4"])) $checkPlayStation4 = $_POST["ItemPlayStation4"];
                $playStation4 = '0';
                if(isset($_POST["QPlayStation4"])) $playStation4 = $_POST["QPlayStation4"];

                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMENAME$', $videogameName, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEEXITDATE$', $videogameDate, $paginaFormAddItem);

                if($videogamePegi == 3) {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', 'selected', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                } elseif($videogamePegi == 7) {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', 'selected', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                } elseif($videogamePegi == 12) {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', 'selected', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                } elseif($videogamePegi == 16) {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', 'selected', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                } elseif($videogamePegi == 18) {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', 'selected', $paginaFormAddItem);

                } else {

                    $paginaFormAddItem = str_replace('$SELCETPEGI3$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI7$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI12$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI16$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTPEGI18$', '', $paginaFormAddItem);

                }

                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEKIND$', $videogameKind, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $videogameDescription, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEVIDEOGAMEPRICE$', $videogamePrice, $paginaFormAddItem);

                if($videogameBestSeller == "1") {

                    $paginaFormAddItem = str_replace('$SELECTBESTSELLERSI$', 'selected', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTBESTSELLERNO$', '', $paginaFormAddItem);

                } else {

                    $paginaFormAddItem = str_replace('$SELECTBESTSELLERSI$', '', $paginaFormAddItem);
                    $paginaFormAddItem = str_replace('$SELECTBESTSELLERNO$', 'selected', $paginaFormAddItem);

                }

                $paginaFormAddItem = str_replace('$CHECKXBOX360$', $checkXbox360, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEXBOX360$', $xbox360, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKXBOXONE$', $checkXboxOne, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEXBOXONE$', $xboxOne, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKWII$', $checkWii, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEWII$', $wii, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKWIIU$', $checkWiiU, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEWIIU$', $wiiU, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKSWITCHN$', $checkSwitchN, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUESWITCHN$', $switchN, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKPLAYSTATION3$', $checkPlayStation3, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEPLAYSTATION3$', $playStation3, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$CHECKPLAYSTATION4$', $checkPlayStation4, $paginaFormAddItem);
                $paginaFormAddItem = str_replace('$VALUEPLAYSTATION4$', $playStation4, $paginaFormAddItem);
                //$principalPage = str_replace('$CENTRALBODY$', $centralBody, $principalPage);

                */

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $paginaFormAddItem;

        }

    }


} else {

    $paginaFormAddItem = str_replace('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

assemblyPageOutPhpPrincipal($principalPage, $paginaFormAddItem);

echo $principalPage;

?>
