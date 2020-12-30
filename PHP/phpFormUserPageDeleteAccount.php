<?php

session_start();

if(!isset($_SESSION["username"])) {

    header('Location: phpPrincipal.php');
    exit;

} else {

    if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

        header('Location: phpPrincipal.php');
        exit;

    } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

        $username = '';
        if(isset($_SESSION["username"])) $username = $_SESSION["username"];

        include('phpConnectionDatabase.php');
        $query_deleteAccount = "DELETE FROM utente WHERE username = '$username'";
        $requestDeleteAccount = $connectionDatabase -> query($query_deleteAccount);

        if($requestDeleteAccount) {

            session_unset();

            session_destroy();

            header('Location: phpPrincipal.php');
            exit;

        } else {

            echo 'Errore con il database';

        }


    } else {

        header('Location: phpPrincipal.php');
        exit;

    }

}

?>
