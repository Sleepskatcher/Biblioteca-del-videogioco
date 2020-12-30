<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');
include('phpAssemblyCentralBody.php');
include('phpAssemblyLateralSubMenuConsoleWithDatabase.php');
include('phpAssemblyVideogamePage.php');
include('phpAssemblyAdminPrenotationList.php');
include('phpAssemblyPrenotation.php');
include('phpAssemblyLateralSubMenu.php');
include('phpAssemblySearchVideogame.php');
include('phpAssemblySearchAdminPrenotation.php');
include('phpAssemblyHomepageBestSeller.php');

$principalPage = file_get_contents('../HTML/PrincipalPage.html');
$header = file_get_contents('../HTML/generalheader.html');
$menu = file_get_contents('../HTML/generalmenu.html');
$breadcrumb = file_get_contents('../HTML/Breadcrumb.html');
$lateralSubMenu = '';
$centralBody = '';
$footer = file_get_contents('../HTML/generalfooter.html');

assemblyHeader($header);
$principalPage = str_replace('$HEADER$', $header, $principalPage);
$principalPage = str_replace('$FOOTER$', $footer, $principalPage);
assemblyMenu($menu);
$principalPage = str_replace('$MENU$', $menu, $principalPage);
assemblyBreadcrumb($breadcrumb);
$principalPage = str_replace('$BREADCRUMB$', $breadcrumb, $principalPage);

$_SESSION["numele"] = 0;

if($centralBody == '' && isset($_GET["menu"]) && ((isset($_SESSION["username"]) && $_SESSION["username"] != 'admin' && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid')) || (!isset($_SESSION["username"]) && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid' || $_GET["menu"] == 'prenotazioni')) || (isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && ($_GET["menu"] == 'chisiamo' || $_GET["menu"] == 'comefunzionanoleggio')))) {

    header('Location: phpPrincipal.php');
    exit;

} else {

    //assemblo SEMPRE e SOLO homepage
    if(!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && empty($_GET)) {

        assemblyHomepageBestSeller($centralBody);

        //qui sotto assemblo gli altri menu semplici: chisiamo, dovesiamo, comefunzionanoleggio, inserisciVideogame
    } elseif(isset($_GET["menu"]) && $_GET["menu"] != 'elencoprenotazionitot' && $_GET["menu"] != 'prenotazioni' && ($_GET["menu"] == 'catalogo' || $_GET["menu"] == 'chisiamo' || $_GET["menu"] == 'comefunzionanoleggio' || $_GET["menu"] == 'inserimentovid') && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

        assemblyCentralBody($centralBody); // non faccio nulla perchè ci pensa già il assembly centralbody a fare il lavoro assegnandoli il file

        //qui sotto gestisco catalogo console quindi quando ho selezionato una console
    } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6)) {

        assemblyLateralSubMenuConsoleWithDatabase($centralBody);

        //qui sotto assemblo il menu elencoprenotazionitot solo per l'admin e quindi lo tengo diviso
    } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && count($_GET) < 4) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 5)) {

        assemblyAdminPrenotationList($centralBody);

        //qui sotto assemblo il menu prenotazione sia per l'username che per l'admin
    } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["code"]) && count($_GET) < 7) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && isset($_GET["code"]) && count($_GET) < 8)) {

        assemblyPrenotation($centralBody);

        //qui sotto assemblo videogioco che sono più casi ma che bisogna settare per forza di cose in quanto ci devono essere tutti i contolli
    } elseif((!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 3) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6) || (!isset($_GET["menu"]) && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 4)) {

        assemblyVideogamePage($centralBody);

        //qui assemblo la ricerca prenotazioni, caso solo admin
    } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6)) {

        assemblySearchAdminPrenotation($centralBody);

        //qui assemblo ricerca generale videogioco, quindi che va bene per tutto
    } elseif(!isset($_GET["menu"]) && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && count($_GET) < 4) {

        assemblySearchVideogame($centralBody);

    } else {

        $centralBody = file_get_contents('../HTML/errorpage404.html');

    }

}

$principalPage = str_replace('$CENTRALBODY$', $centralBody, $principalPage);

assemblyLateralSubMenu($lateralSubMenu);

$principalPage = str_replace('$LATERALSUBMENU$', $lateralSubMenu, $principalPage);

$_SESSION["url"] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

echo $principalPage;

?>
