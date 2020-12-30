<?php

session_start();

include("phpAssemblyPageOutPhpPrincipal.php");
include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

include('phpConnectionDatabase.php');

$formChangeItemSendPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'modificavid' &&  count($_GET) < 2/*empty($_GET)*/) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            /*
        $pathToUpload = 'C:/xampp/htdocs/ProgettoTecweb/COPERTINE_VIDEOGIOCHI/';

                            $adminFile_tmp = $_FILES['vidImage']['tmp_name'];

                            //$_FILES['vidImage']['name'] = $autoIncrementalCodeJustInsert . $_FILES['vidImage']['name'];

                            $adminFile_name = $_FILES['vidImage']['name'];


                            while(file_exists($pathToUpload . $adminFile_name)) {

                                $int = rand(0, 9);
                                $adminFile_name = $int . $adminFile_name;
                                $_FILES['vidImage']['name'] = $adminFile_name;

                            }

                            if(move_uploaded_file($adminFile_tmp, $pathToUpload . $adminFile_name)) {

                                $notError;

                            } else {

                                $error;

                            }
                            $nameVideogameImage = $_FILES["vidImage"]["name"];
        */


            $formChangeItemSendPage = file_get_contents('../HTML/SubAdminMenuChangeItem.html');

            $linkComeBack = '';

            if(!isset($_SESSION["url"])) {

                $linkComeBack = 'phpPrincipal.php';
                $formChangeItemSendPage = str_replace('$LINKCOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $formChangeItemSendPage);

            } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "") {

                $linkComeBack = $_SESSION["url"];
                $formChangeItemSendPage = str_replace('$LINKCOMEBACK$', '<a class="BackPage" title="Questo link torna indietro alla pagina precedente" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna indietro</a>', $formChangeItemSendPage);

            } else {

                $linkComeBack = 'phpPrincipal.php';
                $formChangeItemSendPage = str_replace('$LINKCOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $formChangeItemSendPage);

            }

            $code = '';
            if(isset($_POST["code"])) $code = $_POST["code"];

            $nome = '';
            if(isset($_POST["vidName"])) $nome = $_POST["vidName"];

            $copertina = '';
            if(isset($_POST["vidImage"])) $copertina = $_POST["vidImage"];
            $data_uscita = '';
            if(isset($_POST["vidExitDate"])) $data_uscita = $_POST["vidExitDate"];
            $pegi = '';
            if(isset($_POST["vidPegi"])) $pegi = $_POST["vidPegi"];
            $genere = '';
            if(isset($_POST["vidKind"])) $genere = $_POST["vidKind"];

            $prezzo_noleggio = '';
            if(isset($_POST["vidPrice"])) $prezzo_noleggio = $_POST["vidPrice"];
            $bestseller = '';
            if(isset($_POST["vidBestSel"])) $bestseller = $_POST["vidBestSel"];

            $descrizione = '';
            if(isset($_POST["vidDescription"])) $descrizione = $_POST["vidDescription"];

            $boolXbox360 = false;
            if(isset($_POST["boolXbox360"])) $boolXbox360 = $_POST["boolXbox360"];
            $boolXboxOne = false;
            if(isset($_POST["boolXboxOne"])) $boolXboxOne = $_POST["boolXboxOne"];
            $boolWii = false;
            if(isset($_POST["boolWii"])) $boolWii = $_POST["boolWii"];
            $boolWiiU = false;
            if(isset($_POST["boolWiiU"])) $boolWiiU = $_POST["boolWiiU"];
            $boolSwitch = false;
            if(isset($_POST["boolSwitch"])) $boolSwitch = $_POST["boolSwitch"];
            $boolPlayStation3 = false;
            if(isset($_POST["boolPlayStation3"])) $boolPlayStation3 = $_POST["boolPlayStation3"];
            $boolPlayStation4 = false;
            if(isset($_POST["boolPlayStation4"])) $boolPlayStation4 = $_POST["boolPlayStation4"];


            $boolControlFirstPart = false;

            $boolControlSecondPart = true;

            $query_controlChangeVideogame = "SELECT * FROM videogioco INNER JOIN disponibili ON videogioco.codice = disponibili.videogioco WHERE videogioco.codice = '$code'";
            $requestControlChangeVideogame = $connectionDatabase -> query($query_controlChangeVideogame);

            if($requestControlChangeVideogame) {

                $resultControlChangeVideogame = $requestControlChangeVideogame -> fetch_assoc();

                if($resultControlChangeVideogame != NULL) {

                    if($resultControlChangeVideogame['nome'] != $_POST["vidName"] || (isset($_FILES["vidImage"]) && is_uploaded_file($_FILES["vidImage"]["tmp_name"]) && $resultControlChangeVideogame['copertina'] != $_FILES["vidImage"]["name"] && $_FILES["vidImage"]["name"] != NULL) || $resultControlChangeVideogame['data_uscita'] != $_POST["vidExitDate"] || $resultControlChangeVideogame['pegi'] != $_POST["vidPegi"] || $resultControlChangeVideogame['genere'] != $_POST["vidKind"] || $resultControlChangeVideogame['descrizione'] != $_POST["vidDescription"] || $resultControlChangeVideogame['prezzo_noleggio'] != $_POST["vidPrice"] || $resultControlChangeVideogame['bestseller'] != $_POST["vidBestSel"]) {

                        $boolControlFirstPart = true;

                    } else {

                        $boolControlFirstPart = false;

                    }

                } else {

                    $formChangeItemSendPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

                $arrayConsole = array(isset($_POST["ItemXbox360"]), isset($_POST["ItemXboxOne"]), isset($_POST["ItemWii"]), isset($_POST["ItemWiiU"]), isset($_POST["ItemSwitchN"]), isset($_POST["ItemPlayStation3"]), isset($_POST["ItemPlayStation4"]));

                $arrayQuantity = array($_POST["QXbox360"], $_POST["QXboxOne"], $_POST["QWii"], $_POST["QWiiU"], $_POST["QSwitchN"], $_POST["QPlayStation3"], $_POST["QPlayStation4"]);

                $arrayPhrases = array('la <span xml:lang="en" lang="en">Xbox</span> 360', 'la <span xml:lang="en" lang="en">Xbox One</span>', 'la <span xml:lang="en" lang="en">Wii</span>', 'la <span xml:lang="en" lang="en">Wii U</span>', 'la <span xml:lang="en" lang="en">Switch</span>', 'la <span xml:lang="en" lang="en">PlayStation</span> 3', 'la <span xml:lang="en" lang="en">Playstation</span> 4');

                $arrayBoolConsole = array($boolXbox360, $boolXboxOne, $boolWii, $boolWiiU, $boolSwitch, $boolPlayStation3, $boolPlayStation4);

                $cont = 0;

                $totArray = count($arrayConsole);

                while($boolControlSecondPart && $cont < $totArray) {

                    if(($boolControlSecondPart && $arrayConsole[$cont] && !empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] > 0 && $arrayBoolConsole[$cont]) || ($boolControlSecondPart && $arrayConsole[$cont] && !empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] > 0) || ($boolControlSecondPart && $arrayConsole[$cont] && empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] == 0 && $arrayBoolConsole[$cont])) {

                        $boolControlSecondPart = true;

                    } else {

                        if($boolControlSecondPart && $arrayConsole[$cont] && empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] == 0) {

                            $boolControlSecondPart = false;
                            //errore perchè non posso inserire zero videogiochi, almeno un videogioco
                            $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Non è stata inserita alcuna copia per '. $arrayPhrases[$cont] .'. Inserire almeno una copia.</p>', $formChangeItemSendPage);

                        } elseif($boolControlSecondPart && !$arrayConsole[$cont] && !empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] > 0) {

                            $boolControlSecondPart = false;
                            //errore perchè devo selezionare la casella
                            $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Non è stata selezionata la casella per '. $arrayPhrases[$cont] .'. Selezionare la casella.</p>', $formChangeItemSendPage);


                        } elseif($boolControlSecondPart && !$arrayConsole[$cont] && empty($arrayQuantity[$cont]) && $arrayQuantity[$cont] == 0) {

                            $boolControlSecondPart = true;
                            $formChangeItemSendPage;
                            //non fare nulla perchè va bene così

                        } else {

                            $boolControlSecondPart = false;
                            $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Qualcosa è andato storto, i controlli sono saltati .</p>', $formChangeItemSendPage);

                        }

                    }

                    $cont = $cont + 1;

                }

                if((!$boolControlFirstPart && !$boolControlSecondPart) || ($boolControlFirstPart && !$boolControlSecondPart) || (!$boolControlFirstPart && empty($_POST["QXbox360"]) && $_POST["QXbox360"] == 0 && empty($_POST["QXboxOne"]) && $_POST["QXboxOne"] == 0 && empty($_POST["QWii"]) && $_POST["QWii"] == 0 && empty($_POST["QWiiU"]) && $_POST["QWiiU"] == 0 && empty($_POST["QSwitchN"]) && $_POST["QSwitchN"] == 0 && empty($_POST["QPlayStation3"]) && $_POST["QPlayStation3"] == 0 && empty($_POST["QPlayStation4"]) && $_POST["QPlayStation4"] == 0)) {

                    if((!$boolControlFirstPart && !$boolControlSecondPart) || (!$boolControlFirstPart && empty($_POST["QXbox360"]) && $_POST["QXbox360"] == 0 && empty($_POST["QXboxOne"]) && $_POST["QXboxOne"] == 0 && empty($_POST["QWii"]) && $_POST["QWii"] == 0 && empty($_POST["QWiiU"]) && $_POST["QWiiU"] == 0 && empty($_POST["QSwitchN"]) && $_POST["QSwitchN"] == 0 && empty($_POST["QPlayStation3"]) && $_POST["QPlayStation3"] == 0 && empty($_POST["QPlayStation4"]) && $_POST["QPlayStation4"] == 0)) $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Non è stata effettuata alcuna modifica</p>', $formChangeItemSendPage);
                    else $formChangeItemSendPage;

                    $formChangeItemSendPage = str_replace('$CHANGEITEMVIDEOGAMEHIDDENCODE$', '<input type="hidden" name="code" value="' . $code . '"/>', $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$CHANGEITEMVIDEOGAMEAUTOINCREMENTALCODE$', '<p>Codice videogioco: ' . $code . '</p>', $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMENAME$', $nome, $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEIMAGE$', $copertina, $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEEXITDATE$', $data_uscita, $formChangeItemSendPage);

                    if($pegi == 3) {

                        $formChangeItemSendPage = str_replace('$SELCETPEGI3$', 'selected="selected"', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                    } elseif($pegi == 7) {

                        $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI7$', 'selected="selected"', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                    } elseif($pegi == 12) {

                        $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI12$', 'selected="selected"', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                    } elseif($pegi == 16) {

                        $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI16$', 'selected="selected"', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTPEGI18$', 'selected="selected"', $formChangeItemSendPage);

                    }

                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEKIND$', $genere, $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $descrizione, $formChangeItemSendPage);
                    $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEPRICE$', $prezzo_noleggio, $formChangeItemSendPage);

                    if($bestseller == "1") {

                        $formChangeItemSendPage = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTBESTSELLERNO$', '', $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage = str_replace('$SELECTBESTSELLERSI$', '', $formChangeItemSendPage);
                        $formChangeItemSendPage = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formChangeItemSendPage);

                    }

                    $requestControlChangeVideogame -> data_seek(0);

                    while($resultControlChangeVideogame = $requestControlChangeVideogame -> fetch_assoc()) {

                        if($resultControlChangeVideogame['console'] == 'Xbox360') {

                            $inputXbox360 = '<input id="ItemXbox360" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                            <input type="hidden" name="ItemXbox360" value="Xbox360"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="X360Old" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="23" min="0" max="$MAXNUMBEROFCOPYXBOX360$" name="QXbox360" value="0"/></p>
                            <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyXbox360 = 999 - $resultControlChangeVideogame['copie'];
                            $inputXbox360 = str_replace('$MAXNUMBEROFCOPYXBOX360$', $maxNumberOfCopyXbox360, $inputXbox360);
                            $formChangeItemSendPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemSendPage);
                            $boolXbox360 = true;

                        } elseif($resultControlChangeVideogame['console'] == 'XboxOne') {

                            $inputXboxOne = '<input id="ItemXboxOne" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                            <input type="hidden" name="ItemXboxOne" value="XboxOne"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox One</span>:<input id="XOneOld" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="26" min="0" max="$MAXNUMBEROFCOPYXBOXONE$" name="QXboxOne" value="0"/></p>
                            <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyXboxOne = 999 - $resultControlChangeVideogame['copie'];
                            $inputXboxOne = str_replace('$MAXNUMBEROFCOPYXBOXONE$', $maxNumberOfCopyXboxOne, $inputXboxOne);
                            $formChangeItemSendPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemSendPage);
                            $boolXboxOne = true;

                        } elseif($resultControlChangeVideogame['console'] == 'Wii') {

                            $inputWii = '<input id="ItemWii" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                            <input type="hidden" name="ItemWii" value="Wii"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii</span>:<input id="WOld" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="29" min="0" max="$MAXNUMBEROFCOPYWII$" name="QWii" value="0"/></p>
                            <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyWii = 999 - $resultControlChangeVideogame['copie'];
                            $inputWii = str_replace('$MAXNUMBEROFCOPYWII$', $maxNumberOfCopyWii, $inputWii);
                            $formChangeItemSendPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemSendPage);
                            $boolWii = true;

                        } elseif($resultControlChangeVideogame['console'] == 'WiiU') {

                            $inputWiiU = '<input id="ItemWiiU" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                            <input type="hidden" name="ItemWiiU" value="WiiU"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii U</span>:<input id="WUOld" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="32" min="0" max="$MAXNUMBEROFCOPYWIIU$" name="QWiiU" value="0"/></p>
                            <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyWiiU = 999 - $resultControlChangeVideogame['copie'];
                            $inputWiiU = str_replace('$MAXNUMBEROFCOPYWIIU$', $maxNumberOfCopyWiiU, $inputWiiU);
                            $formChangeItemSendPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemSendPage);
                            $boolWiiU = true;

                        } elseif($resultControlChangeVideogame['console'] == 'Switch') {

                            $inputSwitch = '<input id="ItemSwitchN" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                            <input type="hidden" name="ItemSwitchN" value="Switch"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Switch</span>:<input id="SwOld" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="35" min="0" max="$MAXNUMBEROFCOPYSWITCHN$" name="QSwitchN" value="0"/></p>
                            <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                            $maxNumberOfCopySwitch = 999 - $resultControlChangeVideogame['copie'];
                            $inputSwitch = str_replace('$MAXNUMBEROFCOPYSWITCHN$', $maxNumberOfCopySwitch, $inputSwitch);
                            $formChangeItemSendPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemSendPage);
                            $boolSwitch = true;

                        } elseif($resultControlChangeVideogame['console'] == 'PlayStation3') {

                            $inputPlayStation3 = '<input id="ItemPlayStation3" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                            <input type="hidden" name="ItemPlayStation3" value="PlayStation3"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="P3Old" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="38" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION3$" name="QPlayStation3" value="0"/></p>
                            <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyPlayStation3 = 999 - $resultControlChangeVideogame['copie'];
                            $inputPlayStation3 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION3$', $maxNumberOfCopyPlayStation3, $inputPlayStation3);
                            $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemSendPage);
                            $boolPlayStation3 = true;

                        } elseif($resultControlChangeVideogame['console'] == 'PlayStation4') {

                            $inputPlayStation4 = '<input id="ItemPlayStation4" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                            <input type="hidden" name="ItemPlayStation4" value="PlayStation4"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="P4Old" type="number" value="' . $resultControlChangeVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="41" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION4$" name="QPlayStation4" value="0"/></p>
                            <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyPlayStation4 = 999 - $resultControlChangeVideogame['copie'];
                            $inputPlayStation4 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION4$', $maxNumberOfCopyPlayStation4, $inputPlayStation4);
                            $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemSendPage);
                            $boolPlayStation4 = true;

                        } else {

                            $formChangeItemSendPage;

                        }

                    }

                    if(!$boolXbox360 && !isset($_POST["ItemXbox360"])) {

                        $inputXbox360 = '<input id="ItemXbox360" title="Spunta Xbox360" onclick="controlCheckXbox360Mod()" type="checkbox" tabindex="21" name="ItemXbox360" value="Xbox360"/>
                        <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="22" min="0" max="999" name="QXbox360" value="' . $_POST["QXbox360"] . '"/></p>
                        <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemSendPage);

                    } elseif(!$boolXbox360 && isset($_POST["ItemXbox360"])) {

                        $inputXbox360 = '<input id="ItemXbox360" title="Spunta Xbox360" onclick="controlCheckXbox360Mod()" type="checkbox" tabindex="21" name="ItemXbox360" value="Xbox360" checked="checked"/>
                        <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="22" min="0" max="999" name="QXbox360" value="' . $_POST["QXbox360"] . '"/></p>
                        <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolXboxOne && !isset($_POST["ItemXboxOne"])) {

                        $inputXboxOne = '<input id="ItemXboxOne" title="Spunta XboxOne" onclick="controlCheckXboxOneMod()" type="checkbox" tabindex="24" name="ItemXboxOne" value="XboxOne"/>
                        <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="25" min="0" max="999" name="QXboxOne" value="' . $_POST["QXboxOne"] . '"/></p>
                        <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemSendPage);

                    } elseif(!$boolXboxOne && isset($_POST["ItemXboxOne"])) {

                        $inputXboxOne = '<input id="ItemXboxOne" title="Spunta XboxOne" onclick="controlCheckXboxOneMod()" type="checkbox" tabindex="24" name="ItemXboxOne" value="XboxOne" checked="checked"/>
                        <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="25" min="0" max="999" name="QXboxOne" value="' . $_POST["QXboxOne"] . '"/></p>
                        <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolWii && !isset($_POST["ItemWii"])) {

                        $inputWii = '<input id="ItemWii" title="Spunta Wii" onclick="controlCheckWiiMod()" type="checkbox" tabindex="27" name="ItemWii" value="Wii"/>
                        <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="28" min="0" max="999" name="QWii" value="' . $_POST["QWii"] . '"/></p>
                        <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemSendPage);

                    } elseif(!$boolWii && isset($_POST["ItemWii"])) {

                        $inputWii = '<input id="ItemWii" title="Spunta Wii" onclick="controlCheckWiiMod()" type="checkbox" tabindex="27" name="ItemWii" value="Wii" checked="checked"/>
                        <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="28" min="0" max="999" name="QWii" value="' . $_POST["QWii"] . '"/></p>
                        <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolWiiU && !isset($_POST["ItemWiiU"])) {

                        $inputWiiU = '<input id="ItemWiiU" title="Spunta WiiU" onclick="controlCheckWiiUMod()" type="checkbox" tabindex="30" name="ItemWiiU" value="WiiU"/>
                        <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="31" min="0" max="999" name="QWiiU" value="' . $_POST["QWiiU"] . '"/></p>
                        <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemSendPage);

                    } elseif(!$boolWiiU && isset($_POST["ItemWiiU"])) {

                        $inputWiiU = '<input id="ItemWiiU" title="Spunta WiiU" onclick="controlCheckWiiUMod()" type="checkbox" tabindex="30" name="ItemWiiU" value="WiiU" checked="checked"/>
                        <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="31" min="0" max="999" name="QWiiU" value="' . $_POST["QWiiU"] . '"/></p>
                        <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolSwitch && !isset($_POST["ItemSwitchN"])) {

                        $inputSwitch = '<input id="ItemSwitchN" title="Spunta Switch" onclick="controlCheckSwitchMod()" type="checkbox" tabindex="33" name="ItemSwitchN" value="Switch"/>
                        <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="34" min="0" max="999" name="QSwitchN" value="' . $_POST["QSwitchN"] . '"/></p>
                        <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemSendPage);

                    } elseif(!$boolSwitch && isset($_POST["ItemSwitchN"])) {

                        $inputSwitch = '<input id="ItemSwitchN" title="Spunta Switch" onclick="controlCheckSwitchMod()" type="checkbox" tabindex="33" name="ItemSwitchN" value="Switch" checked="checked"/>
                        <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="34" min="0" max="999" name="QSwitchN" value="' . $_POST["QSwitchN"] . '"/></p>
                        <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolPlayStation3 && !isset($_POST["ItemPlayStation3"])) {

                        $inputPlayStation3 = '<input id="ItemPlayStation3" title="Spunta PlayStation3" onclick="controlCheckPlay3Mod()" type="checkbox" tabindex="36" name="ItemPlayStation3" value="PlayStation3"/>
                        <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="37" min="0" max="999" name="QPlayStation3" value="' . $_POST["QPlayStation3"] . '"/></p>
                        <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemSendPage);

                    } elseif(!$boolPlayStation3 && isset($_POST["ItemPlayStation3"])) {

                        $inputPlayStation3 = '<input id="ItemPlayStation3" title="Spunta PlayStation3" onclick="controlCheckPlay3Mod()" type="checkbox" tabindex="36" name="ItemPlayStation3" value="PlayStation3" checked="checked"/>
                        <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="37" min="0" max="999" name="QPlayStation3" value="' . $_POST["QPlayStation3"] . '"/></p>
                        <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(!$boolPlayStation4 && !isset($_POST["ItemPlayStation4"])) {

                        $inputPlayStation4 = '<input id="ItemPlayStation4" title="Spunta PlayStation4" onclick="controlCheckPlay4Mod()" type="checkbox" tabindex="39" name="ItemPlayStation4" value="PlayStation4"/>
                        <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="40" min="0" max="999" name="QPlayStation4" value="' . $_POST["QPlayStation4"] . '"/></p>
                        <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemSendPage);

                    } elseif(!$boolPlayStation4 && isset($_POST["ItemPlayStation4"])) {

                        $inputPlayStation4 = '<input id="ItemPlayStation4" title="Spunta PlayStation4" onclick="controlCheckPlay4Mod()" type="checkbox" tabindex="39" name="ItemPlayStation4" value="PlayStation4" checked="checked"/>
                        <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="40" min="0" max="999" name="QPlayStation4" value="' . $_POST["QPlayStation4"] . '"/></p>
                        <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                        $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemSendPage);

                    } else {

                        $formChangeItemSendPage;

                    }

                    $formChangeItemSendPage = str_replace('$SUBADMINMENUADDITEMHIDDENBOOL$', '<input type="hidden" name="boolXbox360" value="' . $boolXbox360 . '"/>
                    <input type="hidden" name="boolXboxOne" value="' . $boolXboxOne . '"/>
                    <input type="hidden" name="boolWii" value="' . $boolWii . '"/>
                    <input type="hidden" name="boolWiiU" value="' . $boolWiiU . '"/>
                    <input type="hidden" name="boolSwitch" value="' . $boolSwitch . '"/>
                    <input type="hidden" name="boolPlayStation3" value="' . $boolPlayStation3 . '"/>
                    <input type="hidden" name="boolPlayStation4" value="' . $boolPlayStation4 . '"/>', $formChangeItemSendPage);

                } else {

                    if($boolControlFirstPart) {

                        if($resultControlChangeVideogame['nome'] != $_POST["vidName"] || (isset($_FILES["vidImage"]) && is_uploaded_file($_FILES["vidImage"]["tmp_name"]) && $resultControlChangeVideogame['copertina'] != $_FILES["vidImage"]["name"] && $_FILES["vidImage"]["name"] != '') || $resultControlChangeVideogame['data_uscita'] != $_POST["vidExitDate"] || $resultControlChangeVideogame['pegi'] != $_POST["vidPegi"] || $resultControlChangeVideogame['genere'] != $_POST["vidKind"] || $resultControlChangeVideogame['descrizione'] != $_POST["vidDescription"] || $resultControlChangeVideogame['prezzo_noleggio'] != $_POST["vidPrice"] || $resultControlChangeVideogame['bestseller'] != $_POST["vidBestSel"]) {

                            /*if($null) {

                                $pathToUpload = 'C:/xampp/htdocs/ProgettoTecweb/COPERTINE_VIDEOGIOCHI/';

                                $adminFile_tmp = $_FILES['vidImage']['tmp_name'];

                                //$_FILES['vidImage']['name'] = $autoIncrementalCodeJustInsert . $_FILES['vidImage']['name'];

                                $adminFile_name = $_FILES['vidImage']['name'];

                                while(file_exists($pathToUpload . $adminFile_name)) {

                                    $int = rand(0, 9);
                                    $adminFile_name = $int . $adminFile_name;
                                    $_FILES['vidImage']['name'] = $adminFile_name;

                                }

                                if(move_uploaded_file($adminFile_tmp, $pathToUpload . $adminFile_name)) {

                                    $notError;

                                } else {

                                    $error;

                                }

                            } else {



                            }*/

                            //$nameVideogameImage = $_FILES["vidImage"]["name"];

                            //commento per ricordarsi caricamento immagine database
                            if(isset($_FILES["vidImage"]) && $resultControlChangeVideogame['copertina'] != $_FILES["vidImage"]["name"] && is_uploaded_file($_FILES["vidImage"]["tmp_name"])) {

                                //$pathToUpload = 'C:/xampp/htdocs/ProgettoTecweb/COPERTINE_VIDEOGIOCHI/';

                                //$adminFile_tmp = $_FILES['vidImage']['tmp_name'];

                                //$adminFile_name = $_FILES['vidImage']['name'];

                                /*while(file_exists($pathToUpload . $adminFile_name)) {

                                    $int = rand(0, 9);
                                    $adminFile_name = $int . $adminFile_name;
                                    $_FILES['vidImage']['name'] = $adminFile_name;

                                }*/

                                $copertina = $_FILES["vidImage"]["name"];

                                /*if(move_uploaded_file($adminFile_tmp, $pathToUpload . $adminFile_name)) {

                                    $notError;

                                } else {

                                    $error;

                                }*/


                            } else {

                                //echo 'non salvo l\'immagine /n';
                                $copertina = $resultControlChangeVideogame['copertina'];

                            }

                            //$copertina = $_FILES["vidImage"]["name"];
                            $nomeE = mysqli_real_escape_string($connectionDatabase, $nome);
                            $genereE = mysqli_real_escape_string($connectionDatabase, $genere);
                            $descrizioneE = mysqli_real_escape_string($connectionDatabase, $descrizione);

                            $query_updateItem = "UPDATE videogioco SET nome = '$nomeE', copertina = '$copertina', data_uscita = '$data_uscita', pegi = '$pegi', genere = '$genereE', descrizione = '$descrizioneE', prezzo_noleggio = '$prezzo_noleggio', bestseller = '$bestseller' WHERE codice = '$code'";
                            $requestUpdateItem = $connectionDatabase -> query($query_updateItem);

                            if($requestUpdateItem) {

                                $boolControlFirstPart = true;

                            } else {

                                $boolControlFirstPart = false;
                                $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Qualcosa è andato storto con la richiesta al database</p>', $formChangeItemSendPage);

                            }

                        } else {

                            $formChangeItemSendPage;

                        }

                    } else {

                        $formChangeItemSendPage;

                    }

                    if(empty($_POST["QXbox360"]) && $_POST["QXbox360"] == 0 && empty($_POST["QXboxOne"]) && $_POST["QXboxOne"] == 0 && empty($_POST["QWii"]) && $_POST["QWii"] == 0 && empty($_POST["QWiiU"]) && $_POST["QWiiU"] == 0 && empty($_POST["QSwitchN"]) && $_POST["QSwitchN"] == 0 && empty($_POST["QPlayStation3"]) && $_POST["QPlayStation3"] == 0 && empty($_POST["QPlayStation4"]) && $_POST["QPlayStation4"] == 0) {

                        $boolControlSecondPart = false;

                    } else {

                        $boolControlSecondPart = true;

                    }


                    if($boolControlSecondPart) {

                        $count = 0;

                        $saveConsole = NULL;
                        $saveQuantity = NULL;

                        $arrayValue = array('Xbox360', 'XboxOne', 'Wii', 'WiiU', 'Switch', 'PlayStation3', 'PlayStation4');


                        while($count < $totArray) {

                            if(!$arrayBoolConsole[$count] && $arrayConsole[$count] && $arrayQuantity[$count] > 0) {

                                $saveConsole = $arrayValue[$count];
                                $saveQuantity = $arrayQuantity[$count];

                                $query_insertNewAvailable = "INSERT INTO disponibili(videogioco, console, copie) VALUES ('$code', '$saveConsole', '$saveQuantity')";

                                $requestInsertNewAvailable = $connectionDatabase -> query($query_insertNewAvailable);

                                if($requestInsertNewAvailable) {

                                    $boolControlSecondPart = true;

                                } else {

                                    $boolControlSecondPart = false;

                                }

                            } elseif($arrayBoolConsole[$count] && $arrayConsole[$count] && $arrayQuantity[$count] > 0) {

                                $saveConsole = $arrayValue[$count];
                                $saveQuantity = $arrayQuantity[$count];

                                $query_updateAvailable = "UPDATE disponibili SET copie = copie + '$saveQuantity' WHERE videogioco = '$code' AND console = '$saveConsole'";

                                $requestUpdateAvailable = $connectionDatabase -> query($query_updateAvailable);

                                if($requestUpdateAvailable) {

                                    $boolControlSecondPart = true;

                                } else {

                                    $boolControlSecondPart = false;

                                }

                            } else {

                                $saveConsole;
                                $saveQuantity;

                            }

                            $count = $count + 1;

                        }

                    } else {

                        $formChangeItemSendPage;

                    }

                    $query_updateVideogame = "SELECT * FROM videogioco INNER JOIN disponibili ON videogioco.codice = disponibili.videogioco WHERE videogioco.codice = '$code'";

                    $requestUpdateVideogame = $connectionDatabase -> query($query_updateVideogame);

                    if($requestUpdateVideogame) {

                        $resultUpdateVideogame = $requestUpdateVideogame -> fetch_assoc();

                        if($resultUpdateVideogame != NULL) {

                            //qui dentro fare update e ricaricare pagina
                            $formChangeItemSendPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Modifica avvenuta con successo!</p>', $formChangeItemSendPage);


                            $formChangeItemSendPage = str_replace('$CHANGEITEMVIDEOGAMEHIDDENCODE$', '<input type="hidden" name="code" value="' . $code . '"/>', $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$CHANGEITEMVIDEOGAMEAUTOINCREMENTALCODE$', '<p>Codice videogioco: ' . $code . '</p>', $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMENAME$', $resultUpdateVideogame['nome'], $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEIMAGE$', $resultUpdateVideogame['copertina'], $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEEXITDATE$', $resultUpdateVideogame['data_uscita'], $formChangeItemSendPage);

                            if($resultUpdateVideogame['pegi'] == 3) {

                                $formChangeItemSendPage = str_replace('$SELCETPEGI3$', 'selected="selected"', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                            } elseif($resultUpdateVideogame['pegi'] == 7) {

                                $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI7$', 'selected="selected"', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                            } elseif($resultUpdateVideogame['pegi'] == 12) {

                                $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI12$', 'selected="selected"', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                            } elseif($resultUpdateVideogame['pegi'] == 16) {

                                $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI16$', 'selected="selected"', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI18$', '', $formChangeItemSendPage);

                            } else {

                                $formChangeItemSendPage = str_replace('$SELCETPEGI3$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI7$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI12$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI16$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTPEGI18$', 'selected="selected"', $formChangeItemSendPage);

                            }

                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEKIND$', $resultUpdateVideogame['genere'], $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $descrizione, $formChangeItemSendPage);
                            $formChangeItemSendPage = str_replace('$VALUEVIDEOGAMEPRICE$', $prezzo_noleggio, $formChangeItemSendPage);

                            if($resultUpdateVideogame['bestseller'] == "1") {

                                $formChangeItemSendPage = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTBESTSELLERNO$', '', $formChangeItemSendPage);

                            } else {

                                $formChangeItemSendPage = str_replace('$SELECTBESTSELLERSI$', '', $formChangeItemSendPage);
                                $formChangeItemSendPage = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formChangeItemSendPage);

                            }


                            $requestUpdateVideogame -> data_seek(0);


                            while($resultUpdateVideogame = $requestUpdateVideogame -> fetch_assoc()) {

                                if($resultUpdateVideogame['console'] == 'Xbox360') {

                                    $inputXbox360 = '<input id="ItemXbox360" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                                    <input type="hidden" name="ItemXbox360" value="Xbox360"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="X360Old" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="23" min="0" max="$MAXNUMBEROFCOPYXBOX360$" name="QXbox360" value="0"/></p>
                                    <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyXbox360 = 999 - $resultUpdateVideogame['copie'];
                                    $inputXbox360 = str_replace('$MAXNUMBEROFCOPYXBOX360$', $maxNumberOfCopyXbox360, $inputXbox360);
                                    $formChangeItemSendPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemSendPage);
                                    $boolXbox360 = true;

                                } elseif($resultUpdateVideogame['console'] == 'XboxOne') {

                                    $inputXboxOne = '<input id="ItemXboxOne" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                                    <input type="hidden" name="ItemXboxOne" value="XboxOne"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox One</span>:<input id="XOneOld" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="26" min="0" max="$MAXNUMBEROFCOPYXBOXONE$" name="QXboxOne" value="0"/></p>
                                    <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyXboxOne = 999 - $resultUpdateVideogame['copie'];
                                    $inputXboxOne = str_replace('$MAXNUMBEROFCOPYXBOXONE$', $maxNumberOfCopyXboxOne, $inputXboxOne);
                                    $formChangeItemSendPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemSendPage);
                                    $boolXboxOne = true;

                                } elseif($resultUpdateVideogame['console'] == 'Wii') {

                                    $inputWii = '<input id="ItemWii" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                                    <input type="hidden" name="ItemWii" value="Wii"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii</span>:<input id="WOld" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="29" min="0" max="$MAXNUMBEROFCOPYWII$" name="QWii" value="0"/></p>
                                    <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyWii = 999 - $resultUpdateVideogame['copie'];
                                    $inputWii = str_replace('$MAXNUMBEROFCOPYWII$', $maxNumberOfCopyWii, $inputWii);
                                    $formChangeItemSendPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemSendPage);
                                    $boolWii = true;

                                } elseif($resultUpdateVideogame['console'] == 'WiiU') {

                                    $inputWiiU = '<input id="ItemWiiU" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                                    <input type="hidden" name="ItemWiiU" value="WiiU"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii U</span>:<input id="WUOld" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="32" min="0" max="$MAXNUMBEROFCOPYWIIU$" name="QWiiU" value="0"/></p>
                                    <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyWiiU = 999 - $resultUpdateVideogame['copie'];
                                    $inputWiiU = str_replace('$MAXNUMBEROFCOPYWIIU$', $maxNumberOfCopyWiiU, $inputWiiU);
                                    $formChangeItemSendPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemSendPage);
                                    $boolWiiU = true;

                                } elseif($resultUpdateVideogame['console'] == 'Switch') {

                                    $inputSwitch = '<input id="ItemSwitchN" type="checkbox" value="Switch" checked="checked" disabled="disabled"/>
                                    <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                                    <input type="hidden" name="ItemSwitchN" value="Switch"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">Switch</span>:<input id="SwOld" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="35" min="0" max="$MAXNUMBEROFCOPYSWITCHN$" name="QSwitchN" value="0"/></p>
                                    <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                                    $maxNumberOfCopySwitch = 999 - $resultUpdateVideogame['copie'];
                                    $inputSwitch = str_replace('$MAXNUMBEROFCOPYSWITCHN$', $maxNumberOfCopySwitch, $inputSwitch);
                                    $formChangeItemSendPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemSendPage);
                                    $boolSwitch = true;

                                } elseif($resultUpdateVideogame['console'] == 'PlayStation3') {

                                    $inputPlayStation3 = '<input id="ItemPlayStation3" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                                    <input type="hidden" name="ItemPlayStation3" value="PlayStation3"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="P3Old" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="38" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION3$" name="QPlayStation3" value="0"/></p>
                                    <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyPlayStation3 = 999 - $resultUpdateVideogame['copie'];
                                    $inputPlayStation3 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION3$', $maxNumberOfCopyPlayStation3, $inputPlayStation3);
                                    $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemSendPage);
                                    $boolPlayStation3 = true;

                                } elseif($resultUpdateVideogame['console'] == 'PlayStation4') {

                                    $inputPlayStation4 = '<input id="ItemPlayStation4" type="checkbox" checked="checked" disabled="disabled"/>
                                    <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                                    <input type="hidden" name="ItemPlayStation4" value="PlayStation4"/>
                                    <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="P4Old" type="number" value="' . $resultUpdateVideogame['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="41" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION4$" name="QPlayStation4" value="0"/></p>
                                    <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                                    $maxNumberOfCopyPlayStation4 = 999 - $resultUpdateVideogame['copie'];
                                    $inputPlayStation4 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION4$', $maxNumberOfCopyPlayStation4, $inputPlayStation4);
                                    $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemSendPage);
                                    $boolPlayStation4 = true;

                                } else {

                                    $formChangeItemSendPage;

                                }

                            }

                            if(!$boolXbox360) {

                                $inputXbox360 = '<input id="ItemXbox360" title="Spunta Xbox360" onclick="controlCheckXbox360Mod()" type="checkbox" tabindex="21" name="ItemXbox360" value="Xbox360"/>
                                <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="22" min="0" max="999" name="QXbox360" value="0"/></p>
                                <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemSendPage);

                            }

                            if(!$boolXboxOne) {

                                $inputXboxOne = '<input id="ItemXboxOne" title="Spunta XboxOne" onclick="controlCheckXboxOneMod()" type="checkbox" tabindex="24" name="ItemXboxOne" value="XboxOne"/>
                                <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="25" min="0" max="999" name="QXboxOne" value="0"/></p>
                                <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemSendPage);

                            }

                            if(!$boolWii) {

                                $inputWii = '<input id="ItemWii" title="Spunta Wii" onclick="controlCheckWiiMod()" type="checkbox" tabindex="27" name="ItemWii" value="Wii"/>
                                <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="28" min="0" max="999" name="QWii" value="0"/></p>
                                <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemSendPage);

                            }

                            if(!$boolWiiU) {

                                $inputWiiU = '<input id="ItemWiiU" title="Spunta WiiU" onclick="controlCheckWiiUMod()" type="checkbox" tabindex="30" name="ItemWiiU" value="WiiU"/>
                                <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="31" min="0" max="999" name="QWiiU" value="0"/></p>
                                <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemSendPage);

                            }

                            if(!$boolSwitch) {

                                $inputSwitch = '<input id="ItemSwitchN" title="Spunta Switch" onclick="controlCheckSwitchMod()" type="checkbox" tabindex="33" name="ItemSwitchN" value="Switch"/>
                                <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="34" min="0" max="999" name="QSwitchN" value="0"/></p>
                                <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemSendPage);

                            }

                            if(!$boolPlayStation3) {

                                $inputPlayStation3 = '<input id="ItemPlayStation3" title="Spunta PlayStation3" onclick="controlCheckPlay3Mod()" type="checkbox" tabindex="36" name="ItemPlayStation3" value="PlayStation3"/>
                                <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="37" min="0" max="999" name="QPlayStation3" value="0"/></p>
                                <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemSendPage);

                            }

                            if(!$boolPlayStation4) {

                                $inputPlayStation4 = '<input id="ItemPlayStation4" title="Spunta PlayStation4" onclick="controlCheckPlay4Mod()" type="checkbox" tabindex="39" name="ItemPlayStation4" value="PlayStation4"/>
                                <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                                <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="40" min="0" max="999" name="QPlayStation4" value="0"/></p>
                                <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                                $formChangeItemSendPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemSendPage);

                            }

                            $formChangeItemSendPage = str_replace('$SUBADMINMENUADDITEMHIDDENBOOL$', '<input type="hidden" name="boolXbox360" value="' . $boolXbox360 . '"/>
                            <input type="hidden" name="boolXboxOne" value="' . $boolXboxOne . '"/>
                            <input type="hidden" name="boolWii" value="' . $boolWii . '"/>
                            <input type="hidden" name="boolWiiU" value="' . $boolWiiU . '"/>
                            <input type="hidden" name="boolSwitch" value="' . $boolSwitch . '"/>
                            <input type="hidden" name="boolPlayStation3" value="' . $boolPlayStation3 . '"/>
                            <input type="hidden" name="boolPlayStation4" value="' . $boolPlayStation4 . '"/>', $formChangeItemSendPage);

                        } else {

                            $formChangeItemSendPage;

                        }

                    } else {

                        $formChangeItemSendPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                }

            } else {

                $formChangeItemSendPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $formChangeItemSendPage;
            $formChangeItemSendPage = file_get_contents('../HTML/errorpage404.html');

        }

    }

} else {

    $formChangeItemSendPage = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

$principalPage = '';
assemblyPageOutPhpPrincipal($principalPage, $formChangeItemSendPage);

echo $principalPage;

?>
