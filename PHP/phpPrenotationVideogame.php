<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');

$errorPage = '';

if(empty($_GET)) {

    if(!isset($_SESSION["username"])) {

        header('Location: phpPrincipal.php');
        exit;

    } else {

        if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

            header('Location: phpPrincipal.php');
            exit;

        } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

            include('phpConnectionDatabase.php');

            $errorPage = '';

            $code = '';
            if(isset($_POST["code"])) $code = $_POST["code"];
            //$videogameName = '';
            //if(isset($_POST["videogameName"])) $videogameName = $_POST["videogameName"];
            $tipeOfConsole = '';
            if(isset($_POST["tipeOfConsole"])) $tipeOfConsole = $_POST["tipeOfConsole"];

            $currentTime = time();
            $currentDate = date('Y/m/d', $currentTime);
            $username = $_SESSION["username"];

            $query_takeName = "SELECT videogioco.nome FROM videogioco WHERE videogioco.codice = '$code'";
            $requestTakeName = $connectionDatabase -> query($query_takeName);

            if($requestTakeName) {

                $resultTakeName = $requestTakeName -> fetch_assoc();

                if($resultTakeName != NULL) {

                    $preName = $resultTakeName['nome'];

                    $videogameName = mysqli_real_escape_string($connectionDatabase, $preName);

                    $query_insertPrenotation = "INSERT INTO prenotazione(utente, videogioco, nome_videogioco, console, data_prenotazione, data_ritiro, data_restituzione) VALUES ('$username', '$code', '$videogameName', '$tipeOfConsole', '$currentDate', NULL, NULL)";

                    $requestInsertPrenotation = $connectionDatabase -> query($query_insertPrenotation);

                    if($requestInsertPrenotation) {

                        $query_updateRent = "UPDATE disponibili SET noleggiati = noleggiati + 1 WHERE videogioco = '$code' AND console = '$tipeOfConsole'";

                        $requestUpdateRent = $connectionDatabase -> query($query_updateRent);

                        if($requestUpdateRent) {

                            mysqli_close($connectionDatabase);
                            header('Location: phpPrincipal.php?menu=prenotazioni&pstart=0&pfinish=10&fromVideogame=yes');
                            exit;

                        } else {

                            $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                        }

                    } else {

                        $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                    }

                } else {

                    $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                }

            } else {

                $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } else {

            header('Location: phpPrincipal.php');
            exit;

        }

    }

} else {

    $errorPage = file_get_contents('../HTML/errorpage404.html');

}

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
$principalPage = str_replace('$BREADCRUMB$', '', $principalPage);
$principalPage = str_replace('$LATERALSUBMENU$', '', $principalPage);
$principalPage = $principalPage = str_replace('$CENTRALBODY$', $errorPage, $principalPage);

echo $principalPage;

?>
