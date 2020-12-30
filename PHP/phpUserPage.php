<?php

session_start();

if(empty($_GET)) {

    include('phpConnectionDatabase.php');

    $userPage = file_get_contents('../HTML/UserPage.html');
    $username = '';
    if(isset($_SESSION["username"])) $username = $_SESSION["username"];

    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);

        header('Location: phpPrincipal.php');
        exit;

    } else {

        $query_userPage = "SELECT * FROM utente WHERE username = '$username'";
        $controlUserPage = $connectionDatabase -> query($query_userPage);

        if($controlUserPage) {

            $resultUserPage = $controlUserPage -> fetch_assoc();

            if($resultUserPage != NULL) {

                $userPage = str_replace('$ERRORACCOUNTPAGE$', '', $userPage);
                $userPage = str_replace('$USERNAMEACCOUNT$', $resultUserPage['username'], $userPage);
                $userPage = str_replace('$ACCOUNTNAME$', $resultUserPage['nome'], $userPage);
                $userPage = str_replace('$ACCOUNTSURNAME$', $resultUserPage['cognome'], $userPage);
                $userPage = str_replace('$ACCOUNTPASSWORD$', $resultUserPage['password'], $userPage);
                $userPage = str_replace('$ACCOUNTEMAIL$', $resultUserPage['email'], $userPage);
                $userPage = str_replace('$ACCOUNTCHANGEEMAIL$', '', $userPage);

            } else {

                $userPage = file_get_contents('../HTML/OutErrorConnectionDatabaseQueryOrFetchPage.html');

            }

        } else {

            $userPage = file_get_contents('../HTML/OutErrorConnectionDatabaseQueryOrFetchPage.html');

        }

        $query_controlloPrenotazioni = "SELECT * FROM prenotazione WHERE utente = '$username' AND data_ritiro IS NOT NULL AND data_restituzione IS NULL";
        $controlloPrenotazioni = $connectionDatabase -> query($query_controlloPrenotazioni);
        $resultControlloPrenotazioni = $controlloPrenotazioni -> fetch_assoc();

        if(isset($_SESSION["username"]) && (($_SESSION["username"] == 'admin') || ($resultControlloPrenotazioni != NULL))) $userPage = str_replace('$ACCOUNTDELETEBUTTON$', '', $userPage);
        else $userPage = str_replace('$ACCOUNTDELETEBUTTON$', '<form action="../PHP/phpFormUserPageDeleteAccount.php" method="post">
        <fieldset>
        <button id="DeleteAccount" type="submit" tabindex="8">Elimina <span xml:lang="en" lang="en">account</span></button>
        </fieldset>
        </form>', $userPage);

        mysqli_close($connectionDatabase);

        echo $userPage;

    }

} else {

    $userPage = file_get_contents('../HTML/OutPageErrorPage404.html');
    echo $userPage;

}

?>
