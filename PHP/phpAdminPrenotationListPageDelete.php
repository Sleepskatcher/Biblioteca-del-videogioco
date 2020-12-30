<?php

session_start();

include('phpAssemblyHeader.php');
include('phpAssemblyMenu.php');
include('phpAssemblyBreadcrumb.php');
include('phpAssemblyCentralBody.php');
include('phpAssemblyPageOutPhpPrincipal.php');

include('phpConnectionDatabase.php');

$principalPage = '';
$errorPage = '';

if(empty($_GET)) {

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);
        header('Location: phpPrincipal.php');
        exit;

    } else {

        $idPrenotationDelete = '';
        if(isset($_POST["numprenotazione"])) $idPrenotationDelete = $_POST["numprenotazione"];
        $tipeOfConsole = '';
        if(isset($_POST["tipeOfConsole"])) $tipeOfConsole = $_POST["tipeOfConsole"];
        $code = '';
        if(isset($_POST["code"])) $code = $_POST["code"];
        $boolUpdateRent = false;
        $errorPage = '';

        if(isset($_SESSION["username"]) && ($_SESSION["username"] == 'admin' || $_SESSION["username"] != 'admin')) {

            $query_prenotation = "SELECT * FROM prenotazione WHERE id = '$idPrenotationDelete'";
            $requestPrenotation = $connectionDatabase -> query($query_prenotation);

            $numele = $_SESSION["numele"];
            $url = $_SESSION["url"];

            if($requestPrenotation) {

                $resultPrenotation = $requestPrenotation -> fetch_assoc();

                if($resultPrenotation != NULL) {

                    if($resultPrenotation['data_ritiro'] != NULL && $resultPrenotation['data_restituzione'] != NULL) {

                        $boolDUpdateRent = false;// controllo fatto per sicurezza perchè andrò ad eliminare SEMPRE e solo prenotazioni senza date di ritiro e prenotazione

                    } else {

                        $boolUpdateRent = true;

                    }

                    $query_deletePrenotation = "DELETE FROM prenotazione WHERE id = '$idPrenotationDelete'";

                    $requestDeleterenotation = $connectionDatabase -> query($query_deletePrenotation);

                    if($requestDeleterenotation) {

                        if($boolUpdateRent) {

                            $query_updateRent = "UPDATE disponibili SET noleggiati = noleggiati - 1 WHERE videogioco = '$code' AND console = '$tipeOfConsole'";
                            $requestUpdateRent = $connectionDatabase -> query($query_updateRent);

                            if($query_updateRent) {

                                if(!isset($_SESSION["url"])) {

                                    mysqli_close($connectionDatabase);
                                    header('Location: phpPrincipal.php');
                                    exit;

                                } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "") {

                                    mysqli_close($connectionDatabase);

                                    if(($numele - 1) == 0) {

                                        $posinizio = strpos($url, 'startpr=');
                                        $posinizio = $posinizio + 8;
                                        $salvainizio = '';
                                        $posfine = strpos($url, 'finishpr=');
                                        $posfine = $posfine + 9;
                                        $salvafine = '';


                                        while(is_numeric($url[$posinizio])) {

                                            $salvainizio = $salvainizio . $url[$posinizio];
                                            $posinizio = $posinizio + 1;

                                        }

                                        while(is_numeric($url[$posfine])) {

                                            $salvafine = $salvafine . $url[$posfine];
                                            $posfine = $posfine + 1;

                                        }

                                        $differenza = $salvafine - $salvainizio;
                                        $nuovoInizio = '';
                                        if(($salvainizio - $differenza) >= 0) $nuovoInizio = $salvainizio - $differenza;
                                        else $nuovoInizio = 0;

                                        $nuovaFine = '';
                                        if(($salvafine - $differenza) >= 0) $nuovaFine = $salvafine - $differenza;
                                        else $nuovaFine = $nuovaFine + $differenza;

                                        $url = str_replace($salvainizio, $nuovoInizio, $url);
                                        $url = str_replace($salvafine, $nuovaFine, $url);


                                    } else {

                                        $url;

                                    }

                                    header('Location:' . $url . '&deletePr=yes');
                                    exit;

                                } else {

                                    mysqli_close($connectionDatabase);
                                    header('Location: phpPrincipal.php');
                                    exit;

                                }

                            } else {

                                $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html');

                            }

                        } else {

                            $errorPage = file_get_contents('../HTML/ErrorConnectionDatabaseQueryOrFetchPage.html'); //reinderizzo con yesno, ma non succederà mai

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

            mysqli_close($connectionDatabase);
            header('Location: phpPrincipal.php');
            exit;

        }

    }

} else {

    $errorPage = file_get_contents("../HTML/errorpage404.html");

}

mysqli_close($connectionDatabase);

assemblyPageOutPhpPrincipal($principalPage, $errorPage);

echo $principalPage;

?>
