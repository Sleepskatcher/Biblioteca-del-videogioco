<?php

function assemblyLateralSubMenu(&$lateralSubMenu) {

    if(!isset($_GET['menu']) || $_GET['menu'] == 'chisiamo' || $_GET['menu'] == 'comefunzionanoleggio' || $_GET['menu'] == 'elencoprenotazionitot' || $_GET['menu'] == 'inserimentovid' || $_GET['menu'] == 'prenotazioni') {

        $lateralSubMenu = '';

    } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6)) {

        if(isset($_GET['console']) && $_GET['console'] == 'microsoft') {

            $lateralSubMenu = file_get_contents('../HTML/SubMenuMicrosoftGeneralMenu.html');

            if(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'Xbox360') {

                $lateralSubMenu = str_replace('$RADIOXBOX360$', 'checked="checked"', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOXBOXONE$', '', $lateralSubMenu);

            } elseif(isset($_GET["radioXbox"]) && $_GET["radioXbox"] == 'XboxOne') {

                $lateralSubMenu = str_replace('$RADIOXBOX360$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOXBOXONE$', 'checked="checked"', $lateralSubMenu);

            } else {

                $lateralSubMenu = str_replace('$RADIOXBOX360$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOXBOXONE$', '', $lateralSubMenu);

            }

        } elseif(isset($_GET['console']) && $_GET['console'] == 'nintendo') {

            $lateralSubMenu = file_get_contents('../HTML/SubMenuNintendoGeneralMenu.html');
            if(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Wii') {

                $lateralSubMenu = str_replace('$RADIOWII$', 'checked', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOWIIU$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOSWITCH$', '', $lateralSubMenu);

            } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'WiiU') {

                $lateralSubMenu = str_replace('$RADIOWII$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOWIIU$', 'checked', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOSWITCH$', '', $lateralSubMenu);

            } elseif(isset($_GET["radioNintendo"]) && $_GET["radioNintendo"] == 'Switch') {

                $lateralSubMenu = str_replace('$RADIOWII$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOWIIU$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOSWITCH$', 'checked', $lateralSubMenu);

            } else {

                $lateralSubMenu = str_replace('$RADIOWII$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOWIIU$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOSWITCH$', '', $lateralSubMenu);

            }

        } elseif(isset($_GET['console']) && $_GET['console'] == 'sony') {

            $lateralSubMenu = file_get_contents('../HTML/SubMenuSonyGeneralMenu.html');
            if(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation3') {

                $lateralSubMenu = str_replace('$RADIOPLAYSTATION3$', 'checked', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOPLAYSTATION4$', '', $lateralSubMenu);

            } elseif(isset($_GET["radioSony"]) && $_GET["radioSony"] == 'PlayStation4') {

                $lateralSubMenu = str_replace('$RADIOPLAYSTATION3$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOPLAYSTATION4$', 'checked', $lateralSubMenu);

            } else {

                $lateralSubMenu = str_replace('$RADIOPLAYSTATION3$', '', $lateralSubMenu);
                $lateralSubMenu = str_replace('$RADIOPLAYSTATION4$', '', $lateralSubMenu);

            }

        } else {

            $lateralSubMenu = '';

        }

    } else {

        $lateralSubMenu = '';

    }
}

?>
