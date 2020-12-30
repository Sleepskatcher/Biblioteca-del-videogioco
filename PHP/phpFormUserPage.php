<?php

session_start();

if(empty($_GET)) {

    include('phpConnectionDatabase.php');

    $userPage = file_get_contents('../HTML/UserPage.html');


    $changePassword = NULL;
    if(!empty($_POST["accountchangepassword"])) $changePassword = $_POST["accountchangepassword"];
    $changeEmail = NULL;
    if(!empty($_POST["accountchangeemail"])) $changeEmail = $_POST["accountchangeemail"];
    $username = NULL;
    if(!empty($_SESSION["username"])) $username = $_SESSION["username"];


    if(!isset($_SESSION["username"])) {

        mysqli_close($connectionDatabase);

        header('Location: phpPrincipal.php');
        exit;

    } else {

        $query_formUserPage = "SELECT * FROM utente WHERE username = '$username'";
        $controlFormUserPage = $connectionDatabase -> query($query_formUserPage);

        if($controlFormUserPage) {

            $resultFormUserPage = $controlFormUserPage -> fetch_assoc();

            if($resultFormUserPage != NULL) {

                $userPage = str_replace('$USERNAMEACCOUNT$', $resultFormUserPage['username'], $userPage);
                $userPage = str_replace('$ACCOUNTNAME$', $resultFormUserPage['nome'], $userPage);
                $userPage = str_replace('$ACCOUNTSURNAME$', $resultFormUserPage['cognome'], $userPage);
                $userPage = str_replace('$ACCOUNTCHANGEEMAIL$', '', $userPage);


                if(substr_count($changePassword, ' ') > 0) {

                    $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p>La <span xml:lang="en" lang="en">password</span> contiene degli spazi, non va bene. Ridigitare la <span xml:lang="en" lang="en">password</span></p>', $userPage);


                } elseif(isset($_POST["accountchangepassword"]) && isset($_POST["accountconfirmchangepassword"]) && $_POST["accountchangepassword"] != $_POST["accountconfirmchangepassword"]) {

                    $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p>Conferma <span xml:lang="en" lang="en">password</span> errata, riscriverla correttamente</p>', $userPage);
                    $userPage = str_replace('$ACCOUNTPASSWORD$', $resultFormUserPage['password'], $userPage);
                    $userPage = str_replace('$ACCOUNTEMAIL$', $resultFormUserPage['email'], $userPage);

                } elseif(!empty($_POST["accountchangeemail"]) && substr_count($changeEmail, '.') == 0) {

                    $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p>Inserire un\'<span xml:lang="en" lang="en">email</span> valida, manca il .com, .it etc...</p>', $userPage);
                    $userPage = str_replace('$ACCOUNTPASSWORD$', $resultFormUserPage['password'], $userPage);
                    $userPage = str_replace('$ACCOUNTEMAIL$', $resultFormUserPage['email'], $userPage);

                } else {

                    $boolError = false;

                    if(!empty($_POST["accountchangepassword"]) && empty($_POST["accountchangeemail"])) {

                        $query_userPageChangePassword = "UPDATE utente SET password = '$changePassword' WHERE username = '$username'";
                        $updatePassword = $connectionDatabase -> query($query_userPageChangePassword);

                        if($updatePassword) {

                            $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p><span xml:lang="en" lang="en">Password</span> aggiornata correttamente.</p>', $userPage);
                            $userPage = str_replace('$ACCOUNTPASSWORD$', $changePassword, $userPage);
                            $userPage = str_replace('$ACCOUNTEMAIL$', $resultFormUserPage['email'], $userPage);

                        } else {

                            $boolError = true;

                        }

                    } elseif(empty($_POST["accountchangepassword"]) && !empty($_POST["accountchangeemail"])) {

                        $query_userPageChangeEmail = "UPDATE utente SET email = '$changeEmail' WHERE username = '$username'";
                        $updateEmail = $connectionDatabase -> query($query_userPageChangeEmail);

                        if($updateEmail) {

                            $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p><span xml:lang="en" lang="en">Email</span> aggiornata correttamente.</p>', $userPage);
                            $userPage = str_replace('$ACCOUNTPASSWORD$', $resultFormUserPage['password'], $userPage);
                            $userPage = str_replace('$ACCOUNTEMAIL$', $changeEmail, $userPage);

                        } else {

                            $boolError = true;

                        }

                    } elseif(!empty($_POST["accountchangepassword"]) && !empty($_POST["accountchangeemail"])) {

                        $query_userPageChangePassAndEmail = "UPDATE utente SET password = '$changePassword', email = '$changeEmail' WHERE username = '$username'";
                        $updatePassAndEmail = $connectionDatabase -> query($query_userPageChangePassAndEmail);

                        if($updatePassAndEmail) {

                            $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p><span xml:lang="en" lang="en">Password</span> ed <span xml:lang="en" lang="en">email</span> aggiornate correttamente.</p>', $userPage);
                            $userPage = str_replace('$ACCOUNTPASSWORD$', $changePassword, $userPage);
                            $userPage = str_replace('$ACCOUNTEMAIL$', $changeEmail, $userPage);

                        } else {

                            $boolError = true;

                        }


                    } else {


                        $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p>Non hai modificato nulla</p>', $userPage);
                        $userPage = str_replace('$ACCOUNTPASSWORD$', $resultFormUserPage['password'], $userPage);
                        $userPage = str_replace('$ACCOUNTEMAIL$', $resultFormUserPage['email'], $userPage);

                    }

                    if($boolError) {

                        $userPage = str_replace('$ERRORACCOUNTPAGE$', '<p>Qualcosa è andato storto con il <span xml:lang="en" lang="en">database</span></p>', $userPage);
                        $userPage = str_replace('$ACCOUNTPASSWORD$', $resultFormUserPage['password'], $userPage);
                        $userPage = str_replace('$ACCOUNTEMAIL$', $resultFormUserPage['email'], $userPage);

                    } else {

                        $userPage;

                    }

                }

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
        <button type="submit" tabindex="8">Elimina <span xml:lang="en" lang="en">account</span></button>
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
