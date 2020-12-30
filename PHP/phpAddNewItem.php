<?php

session_start();

include("phpAssemblyPageOutPhpPrincipal.php");
include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

include('phpConnectionDatabase.php');

$formAddItem = '';
$principalPage = '';

if(isset($_GET["menu"]) && $_GET["menu"] == 'inserimentovid' && count($_GET) < 2) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            $formAddItem = file_get_contents('../HTML/SubAdminMenuAddItem.html');
            $formAddItem = str_replace('$ERRORSUBADMINMENUADDITEMPAGE$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMENAME$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMEIMAGE$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMEEXITDATE$', '', $formAddItem);
            $formAddItem = str_replace('$SELCETPEGI3$', '', $formAddItem);
            $formAddItem = str_replace('$SELECTPEGI7$', '', $formAddItem);
            $formAddItem = str_replace('$SELECTPEGI12$', '', $formAddItem);
            $formAddItem = str_replace('$SELECTPEGI16$', '', $formAddItem);
            $formAddItem = str_replace('$SELECTPEGI18$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMEKIND$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMEDESCRIPTION$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEVIDEOGAMEPRICE$', '0.01', $formAddItem);
            $formAddItem = str_replace('$SELECTBESTSELLERSI$', '', $formAddItem);
            $formAddItem = str_replace('$SELECTBESTSELLERNO$', '', $formAddItem);
            $formAddItem = str_replace('$CHECKXBOX360$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEXBOX360$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKXBOXONE$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEXBOXONE$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKWII$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEWII$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKWIIU$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEWIIU$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKSWITCHN$', '', $formAddItem);
            $formAddItem = str_replace('$VALUESWITCHN$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKPLAYSTATION3$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEPLAYSTATION3$', '0', $formAddItem);
            $formAddItem = str_replace('$CHECKPLAYSTATION4$', '', $formAddItem);
            $formAddItem = str_replace('$VALUEPLAYSTATION4$', '0', $formAddItem);

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        } else {

            $formAddItem;

        }

    }

} else {

    $formAddItem = file_get_contents('../HTML/errorpage404.html');

}

mysqli_close($connectionDatabase);
assemblyPageOutPhpPrincipal($principalPage, $formAddItem);

echo $principalPage;

?>
