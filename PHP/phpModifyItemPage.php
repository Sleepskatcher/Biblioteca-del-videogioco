<?php

session_start();

include("phpAssemblyPageOutPhpPrincipal.php");
include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

include('phpConnectionDatabase.php');

$formChangeItemPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'modificavid' &&  count($_GET) < 2/*empty($_GET)*/) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $formChangeItemPage = file_get_contents('../HTML/SubAdminMenuChangeItem.html');

            $linkComeBack = '';

            if(!isset($_SESSION["url"])) {

                $linkComeBack = 'phpPrincipal.php';
                $formChangeItemPage = str_replace('$LINKCOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $formChangeItemPage);

            } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "") {

                $linkComeBack = $_SESSION["url"];
                $formChangeItemPage = str_replace('$LINKCOMEBACK$', '<a class="BackPage" title="Questo link torna indietro alla pagina precedente" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna indietro</a>', $formChangeItemPage);

            } else {

                $linkComeBack = 'phpPrincipal.php';
                $formChangeItemPage = str_replace('$LINKCOMEBACK$', '<a title="Questo link porta alla home" href="' . $linkComeBack . '" tabindex="12"><img class="ArrowBack" alt="Freccia per tornare indietro" src="../IMMAGINI/LeftArrow.png"/>Torna alla <span xml:lang="en" lang="en">home</span></a>', $formChangeItemPage);

            }

            $code = '';
            if(isset($_POST["code"])) $code = $_POST["code"];
            $query_modifyItem = "SELECT * FROM videogioco INNER JOIN disponibili ON videogioco.codice = disponibili.videogioco WHERE videogioco.codice = '$code'";
            $requestModifyItem = $connectionDatabase -> query($query_modifyItem);
            $resultModifyItem = NULL;

            if($requestModifyItem) {

                $resultModifyItem = $requestModifyItem -> fetch_assoc();

                if($resultModifyItem != NULL) {

                    $formChangeItemPage = str_replace('$ERRORSUBADMINMENUCHANGEITEMPAGE$', '<p>Qui puoi modificare i vari campi del videogioco</p>', $formChangeItemPage);
                    $formChangeItemPage = str_replace('$CHANGEITEMVIDEOGAMEHIDDENCODE$', '<input type="hidden" name="code" value="' . $code . '"/>', $formChangeItemPage);
                    $formChangeItemPage = str_replace('$CHANGEITEMVIDEOGAMEAUTOINCREMENTALCODE$', '<p>Codice videogioco: ' . $code . '</p>', $formChangeItemPage);
                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMENAME$', $resultModifyItem['nome'], $formChangeItemPage);

                    //aprire cartella che mi interessa
                    /*$saveFile = '';
                    $pathServer = 'C:/xampp/htdocs/ProgettoTecweb/COPERTINE_VIDEOGIOCHI/';
                    $boolExit = true;

                    if(is_dir($pathServer)) {

                        if($path = opendir($pathServer)) {

                            while(($file = readdir($path)) !== false && $boolExit) {

                                if($file == $resultModifyItem['copertina']) {

                                    $boolExit = false;
                                    $saveFile =

                                }

                            }

                        }

                    } else {

                        $saveFile;

                    }*/

                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $formChangeItemPage);
                    //$formChangeItemPage = str_replace('$VALUEVIDEOGAMEIMAGE$', $resultModifyItem['copertina'], $formChangeItemPage); // immagine non riesco ancora a settarla per problema che non me la reinderizza. Trovare soluzione altrimenti bisogna togliere l'immagine
                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMEEXITDATE$', $resultModifyItem['data_uscita'], $formChangeItemPage);

                    if($resultModifyItem['pegi'] == 3) {

                        $formChangeItemPage = str_replace('$SELCETPEGI3$', 'selected="selected"', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI7$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI12$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI16$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI18$', '', $formChangeItemPage);


                    } elseif($resultModifyItem['pegi'] == 7) {

                        $formChangeItemPage = str_replace('$SELCETPEGI3$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI7$', 'selected="selected"', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI12$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI16$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI18$', '', $formChangeItemPage);

                    } elseif($resultModifyItem['pegi'] == 12) {

                        $formChangeItemPage = str_replace('$SELCETPEGI3$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI7$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI12$', 'selected="selected"', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI16$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI18$', '', $formChangeItemPage);

                    } elseif($resultModifyItem['pegi'] == 16) {

                        $formChangeItemPage = str_replace('$SELCETPEGI3$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI7$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI12$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI16$', 'selected="selected"', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI18$', '', $formChangeItemPage);

                    } else {

                        $formChangeItemPage = str_replace('$SELCETPEGI3$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI7$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI12$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI16$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTPEGI18$', 'selected="selected"', $formChangeItemPage);

                    }

                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMEKIND$', $resultModifyItem['genere'], $formChangeItemPage);
                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', $resultModifyItem['descrizione'], $formChangeItemPage);
                    $formChangeItemPage = str_replace('$VALUEVIDEOGAMEPRICE$', $resultModifyItem['prezzo_noleggio'], $formChangeItemPage);

                    if($resultModifyItem['bestseller'] == "1") {

                        $formChangeItemPage = str_replace('$SELECTBESTSELLERSI$', 'selected="selected"', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTBESTSELLERNO$', '', $formChangeItemPage);

                    } else {

                        $formChangeItemPage = str_replace('$SELECTBESTSELLERSI$', '', $formChangeItemPage);
                        $formChangeItemPage = str_replace('$SELECTBESTSELLERNO$', 'selected="selected"', $formChangeItemPage);

                    }

                    $requestModifyItem -> data_seek(0);
                    $boolXbox360 = false;
                    $boolXboxOne = false;
                    $boolWii = false;
                    $boolWiiU = false;
                    $boolSwitch = false;
                    $boolPlayStation3 = false;
                    $boolPlayStation4 = false;

                    while($resultModifyItem = $requestModifyItem -> fetch_assoc()) {

                        if($resultModifyItem['console'] == 'Xbox360') {

                            $inputXbox360 = '<input id="ItemXbox360" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                            <input type="hidden" name="ItemXbox360" value="Xbox360"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="X360Old" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="23" min="0" max="$MAXNUMBEROFCOPYXBOX360$" name="QXbox360" value="0"/></p>
                            <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyXbox360 = 999 - $resultModifyItem['copie'];
                            $inputXbox360 = str_replace('$MAXNUMBEROFCOPYXBOX360$', $maxNumberOfCopyXbox360, $inputXbox360);
                            $formChangeItemPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemPage);
                            $boolXbox360 = true;

                        } elseif($resultModifyItem['console'] == 'XboxOne') {

                            $inputXboxOne = '<input id="ItemXboxOne" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                            <input type="hidden" name="ItemXboxOne" value="XboxOne"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Xbox One</span>:<input id="XOneOld" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="26" min="0" max="$MAXNUMBEROFCOPYXBOXONE$" name="QXboxOne" value="0"/></p>
                            <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyXboxOne = 999 - $resultModifyItem['copie'];
                            $inputXboxOne = str_replace('$MAXNUMBEROFCOPYXBOXONE$', $maxNumberOfCopyXboxOne, $inputXboxOne);
                            $formChangeItemPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemPage);
                            $boolXboxOne = true;

                        } elseif($resultModifyItem['console'] == 'Wii') {

                            $inputWii = '<input id="ItemWii" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                            <input type="hidden" name="ItemWii" value="Wii"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii</span>:<input id="WOld" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="29" min="0" max="$MAXNUMBEROFCOPYWII$" name="QWii" value="0"/></p>
                            <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyWii = 999 - $resultModifyItem['copie'];
                            $inputWii = str_replace('$MAXNUMBEROFCOPYWII$', $maxNumberOfCopyWii, $inputWii);
                            $formChangeItemPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemPage);
                            $boolWii = true;

                        } elseif($resultModifyItem['console'] == 'WiiU') {

                            $inputWiiU = '<input id="ItemWiiU" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                            <input type="hidden" name="ItemWiiU" value="WiiU"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Wii U</span>:<input id="WUOld" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="32" min="0" max="$MAXNUMBEROFCOPYWIIU$" name="QWiiU" value="0"/></p>
                            <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                            $maxNumberOfCopyWiiU = 999 - $resultModifyItem['copie'];
                            $inputWiiU = str_replace('$MAXNUMBEROFCOPYWIIU$', $maxNumberOfCopyWiiU, $inputWiiU);
                            $formChangeItemPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemPage);
                            $boolWiiU = true;

                        } elseif($resultModifyItem['console'] == 'Switch') {

                            $inputSwitch = '<input id="ItemSwitchN" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                            <input type="hidden" name="ItemSwitchN" value="Switch"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">Switch</span>:<input id="SwOld" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="35" min="0" max="$MAXNUMBEROFCOPYSWITCHN$" name="QSwitchN" value="0"/></p>
                            <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                            $maxNumberOfCopySwitch = 999 - $resultModifyItem['copie'];
                            $inputSwitch = str_replace('$MAXNUMBEROFCOPYSWITCHN$', $maxNumberOfCopySwitch, $inputSwitch);
                            $formChangeItemPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemPage);
                            $boolSwitch = true;

                        } elseif($resultModifyItem['console'] == 'PlayStation3') {

                            $inputPlayStation3 = '<input id="ItemPlayStation3" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                            <input type="hidden" name="ItemPlayStation3" value="PlayStation3"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="P3Old" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="38" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION3$" name="QPlayStation3" value="0"/></p>
                            <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyPlayStation3 = 999 - $resultModifyItem['copie'];
                            $inputPlayStation3 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION3$', $maxNumberOfCopyPlayStation3, $inputPlayStation3);
                            $formChangeItemPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemPage);
                            $boolPlayStation3 = true;

                        } elseif($resultModifyItem['console'] == 'PlayStation4') {

                            $inputPlayStation4 = '<input id="ItemPlayStation4" type="checkbox" checked="checked" disabled="disabled"/>
                            <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                            <input type="hidden" name="ItemPlayStation4" value="PlayStation4"/>
                            <p>Numero di copie inserite per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="P4Old" type="number" value="' . $resultModifyItem['copie'] . '" disabled="disabled"/> Numero di copie da aggiungere per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="41" min="0" max="$MAXNUMBEROFCOPYPLAYSTATION4$" name="QPlayStation4" value="0"/></p>
                            <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                            $maxNumberOfCopyPlayStation4 = 999 - $resultModifyItem['copie'];
                            $inputPlayStation4 = str_replace('$MAXNUMBEROFCOPYPLAYSTATION4$', $maxNumberOfCopyPlayStation4, $inputPlayStation4);
                            $formChangeItemPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemPage);
                            $boolPlayStation4 = true;

                        } else {

                            $formChangeItemPage;

                        }

                    }

                    if(!$boolXbox360) {

                        $inputXbox360 = '<input id="ItemXbox360" title="Spunta Xbox360" onclick="controlCheckXbox360Mod()" type="checkbox" tabindex="21" name="ItemXbox360" value="Xbox360"/>
                        <label for="ItemXbox360"><span xml:lang="en" lang="en">Xbox</span> 360</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox</span> 360:<input id="QXbox360" title="Inserisci copie Xbox360" onkeyup="controlXbox360Mod()" onfocusout="controlXbox360Mod()" type="number" tabindex="22" min="0" max="999" name="QXbox360" value="0"/></p>
                        <p id="AvvisoXbox360Mod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTXBOX360$', $inputXbox360, $formChangeItemPage);

                    }

                    if(!$boolXboxOne) {

                        $inputXboxOne = '<input id="ItemXboxOne" title="Spunta XboxOne" onclick="controlCheckXboxOneMod()" type="checkbox" tabindex="24" name="ItemXboxOne" value="XboxOne"/>
                        <label for="ItemXboxOne"><span xml:lang="en" lang="en">Xbox One</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Xbox One</span>:<input id="QXboxOne" title="Inserisci copie XboxOne" onkeyup="controlXboxOneMod()" onfocusout="controlXboxOneMod()" type="number" tabindex="25" min="0" max="999" name="QXboxOne" value="0"/></p>
                        <p id="AvvisoXboxOneMod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTXBOXONE$', $inputXboxOne, $formChangeItemPage);

                    }

                    if(!$boolWii) {

                        $inputWii = '<input id="ItemWii" title="Spunta Wii" onclick="controlCheckWiiMod()" type="checkbox" tabindex="27" name="ItemWii" value="Wii"/>
                        <label for="ItemWii"><span xml:lang="en" lang="en">Wii</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii</span>:<input id="QWii" title="Inserisci copie Wii" onkeyup="controlWiiMod()" onfocusout="controlWiiMod()" type="number" tabindex="28" min="0" max="999" name="QWii" value="0"/></p>
                        <p id="AvvisoWiiMod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTWII$', $inputWii, $formChangeItemPage);

                    }

                    if(!$boolWiiU) {

                        $inputWiiU = '<input id="ItemWiiU" title="Spunta WiiU" onclick="controlCheckWiiUMod()" type="checkbox" tabindex="30" name="ItemWiiU" value="WiiU"/>
                        <label for="ItemWiiU"><span xml:lang="en" lang="en">Wii U</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Wii U</span>:<input id="QWiiU" title="Inserisci copie WiiU" onkeyup="controlWiiUMod()" onfocusout="controlWiiUMod()" type="number" tabindex="31" min="0" max="999" name="QWiiU" value="0"/></p>
                        <p id="AvvisoWiiUMod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTWIIU$', $inputWiiU, $formChangeItemPage);

                    }

                    if(!$boolSwitch) {

                        $inputSwitch = '<input id="ItemSwitchN" title="Spunta Switch" onclick="controlCheckSwitchMod()" type="checkbox" tabindex="33" name="ItemSwitchN" value="Switch"/>
                        <label for="ItemSwitchN"><span xml:lang="en" lang="en">Switch</span></label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">Switch</span>:<input id="QSwitchN" title="Inserisci copie Switch" onkeyup="controlSwitchMod()" onfocusout="controlSwitchMod()" type="number" tabindex="34" min="0" max="999" name="QSwitchN" value="0"/></p>
                        <p id="AvvisoSwitchMod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTSWITCH$', $inputSwitch, $formChangeItemPage);

                    }

                    if(!$boolPlayStation3) {

                        $inputPlayStation3 = '<input id="ItemPlayStation3" title="Spunta PlayStation3" onclick="controlCheckPlay3Mod()" type="checkbox" tabindex="36" name="ItemPlayStation3" value="PlayStation3"/>
                        <label for="ItemPlayStation3"><span xml:lang="en" lang="en">PlayStation</span> 3</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 3:<input id="QPlayStation3" title="Inserisci copie PlayStation3" onkeyup="controlPlay3Mod()" onfocusout="controlPlay3Mod()" type="number" tabindex="37" min="0" max="999" name="QPlayStation3" value="0"/></p>
                        <p id="AvvisoPlay3Mod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTPLAYSTATION3$', $inputPlayStation3, $formChangeItemPage);

                    }

                    if(!$boolPlayStation4) {

                        $inputPlayStation4 = '<input id="ItemPlayStation4" title="Spunta PlayStation4" onclick="controlCheckPlay4Mod()" type="checkbox" tabindex="39" name="ItemPlayStation4" value="PlayStation4"/>
                        <label for="ItemPlayStation4"><span xml:lang="en" lang="en">PlayStation</span> 4</label>
                        <p>Inserire numero di copie per <span xml:lang="en" lang="en">PlayStation</span> 4:<input id="QPlayStation4" title="Inserisci copie PlayStation4" onkeyup="controlPlay4Mod()" onfocusout="controlPlay4Mod()" type="number" tabindex="40" min="0" max="999" name="QPlayStation4" value="0"/></p>
                        <p id="AvvisoPlay4Mod" class="JavaWarning"></p>';
                        $formChangeItemPage = str_replace('$INPUTPLAYSTATION4$', $inputPlayStation4, $formChangeItemPage);

                    }

                    $formChangeItemPage = str_replace('$SUBADMINMENUADDITEMHIDDENBOOL$', '<input type="hidden" name="boolXbox360" value="' . $boolXbox360 . '"/>
                    <input type="hidden" name="boolXboxOne" value="' . $boolXboxOne . '"/>
                    <input type="hidden" name="boolWii" value="' . $boolWii . '"/>
                    <input type="hidden" name="boolWiiU" value="' . $boolWiiU . '"/>
                    <input type="hidden" name="boolSwitch" value="' . $boolSwitch . '"/>
                    <input type="hidden" name="boolPlayStation3" value="' . $boolPlayStation3 . '"/>
                    <input type="hidden" name="boolPlayStation4" value="' . $boolPlayStation4 . '"/>', $formChangeItemPage);


                } else {

                    $formChangeItemPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $formChangeItemPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $formChangeItemPage;

        }

    }

} else {

    $formChangeItemPage = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);

$principalPage = '';
assemblyPageOutPhpPrincipal($principalPage, $formChangeItemPage);

echo $principalPage;

?>
