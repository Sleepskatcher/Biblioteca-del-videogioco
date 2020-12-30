<?php

session_start();

if(empty($_GET)) {

    $registrationPage = file_get_contents('../HTML/registrationpage.html');

    $name = '';
    if(isset($_POST["name"])) $name = $_POST["name"];
    $surname = '';
    if(isset($_POST["surname"])) $surname = $_POST["surname"];
    $username = '';
    if(isset($_POST["username"])) $username = $_POST["username"];
    $email = '';
    if(isset($_POST["email"])) $email = $_POST["email"];
    $password = '';
    if(isset($_POST["password"])) $password = $_POST["password"];
    $passwordconfirmed = '';
    if(isset($_POST["passwordconfirmed"])) $passwordconfirmed = $_POST["passwordconfirmed"];

    if(substr_count($username, ' ') > 0) {

        $registrationPage = str_replace('$ERRORREGISTRATIONPAGE$', '<p>Lo <span xml:lang="en" lang="en">username</span> contiene degli spazi, non va bene. Ridigitare la <span xml:lang="en" lang="en">username</span> senza spazi</p>', $registrationPage);
        $registrationPage = str_replace('$VALUENAME$', $name, $registrationPage);
        $registrationPage = str_replace('$VALUESURNAME$', $surname, $registrationPage);
        $registrationPage = str_replace('$VALUEUSERNAME$', '', $registrationPage);
        $registrationPage = str_replace('$VALUEEMAIL$', $email, $registrationPage);

        echo $registrationPage;

    } elseif(substr_count($email, '.') == 0) {

        $registrationPage = str_replace('$ERRORREGISTRATIONPAGE$', '<p>Le <span xml:lang="en" lang="en">email</span> non è valida. Inserire un\' <span xml:lang="en" lang="en">email</span> valida</p>', $registrationPage);
        $registrationPage = str_replace('$VALUENAME$', $name, $registrationPage);
        $registrationPage = str_replace('$VALUESURNAME$', $surname, $registrationPage);
        $registrationPage = str_replace('$VALUEUSERNAME$', $username, $registrationPage);
        $registrationPage = str_replace('$VALUEEMAIL$', '', $registrationPage);

        echo $registrationPage;

    } elseif(substr_count($password, ' ') > 0) {

        $registrationPage = str_replace('$ERRORREGISTRATIONPAGE$', '<p>La <span xml:lang="en" lang="en">password</span> contiene degli spazi, non va bene. Ridigitare la <span xml:lang="en" lang="en">password</span> senza spazi</p>', $registrationPage);
        $registrationPage = str_replace('$VALUENAME$', $name, $registrationPage);
        $registrationPage = str_replace('$VALUESURNAME$', $surname, $registrationPage);
        $registrationPage = str_replace('$VALUEUSERNAME$', $username, $registrationPage);
        $registrationPage = str_replace('$VALUEEMAIL$', $email, $registrationPage);

        echo $registrationPage;

    } else {

        include('phpConnectionDatabase.php');
        $query_controlRegistration = "SELECT username FROM utente WHERE username = '$username'";
        $controlRegistration = $connectionDatabase -> query($query_controlRegistration);
        $resultRegistration = $controlRegistration -> fetch_assoc();

        if($controlRegistration) {

            if($resultRegistration != NULL) {

                mysqli_close($connectionDatabase);

                $registrationPage = str_replace('$ERRORREGISTRATIONPAGE$', '<p><span xml:lang="en" lang="en">Username</span> già in uso, usarne un altro</p>', $registrationPage);
                $registrationPage = str_replace('$VALUENAME$', $name, $registrationPage);
                $registrationPage = str_replace('$VALUESURNAME$', $surname, $registrationPage);
                $registrationPage = str_replace('$VALUEUSERNAME$', '', $registrationPage);
                $registrationPage = str_replace('$VALUEEMAIL$', $email, $registrationPage);

                echo $registrationPage;

            } else {

                $query_insertRegistration = "INSERT INTO utente(username, password, nome, cognome, email) VALUES ('$username', '$password', '$name', '$surname', '$email')";

                $requestDatabaseregistration = $connectionDatabase -> query($query_insertRegistration);

                mysqli_close($connectionDatabase);

                $_SESSION["username"] = $username;

                if(!isset($_SESSION["url"]) && isset($_SESSION["username"])) {

                    header('Location: phpPrincipal.php');
                    exit;

                } elseif(isset($_SESSION["url"]) && $_SESSION["url"] != "" && isset($_SESSION["username"])) {

                    $redirectUrl = $_SESSION["url"];
                    header('Location:' . $redirectUrl);
                    exit;

                } else {

                    $registrationPage;

                }

            }

        } else {

            mysqli_close($connectionDatabase);
            $registrationPage = file_get_contents('../HTML/OutErrorConnectionDatabaseQueryOrFetchPage.html');
            echo $registrationPage;

        }

    }

} else {

    $registrationPage = file_get_contents('../HTML/OutPageErrorPage404.html');
    echo $registrationPage;

}

?>
