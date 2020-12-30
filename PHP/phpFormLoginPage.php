<?php

session_start();

if(empty($_GET)) {

    $loginPage = file_get_contents('../HTML/loginpage.html');

    $username = '';
    if(isset($_POST["exusername"])) $username = $_POST["exusername"];
    $password = '';
    if(isset($_POST["expassword"])) $password = $_POST["expassword"];



    if(isset($_POST["exusername"]) && isset($_POST["expassword"])) {

        include('phpConnectionDatabase.php');

        $query_controlLogin = "SELECT username AND password FROM utente WHERE username = '$username' AND password = '$password'";

        $controlLogin = $connectionDatabase -> query($query_controlLogin);
        if($controlLogin) {

            $resultLogin = $controlLogin -> fetch_assoc();

            if($resultLogin != NULL) {

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

                    $loginPage;

                }


            } else {

                mysqli_close($connectionDatabase);
                $loginPage = str_replace('$ERRORLOGINPAGE$', '<p><span xml:lang="en" lang="en">Username</span> e/o <span xml:lang="en" lang="en">password</span> errati.', $loginPage);
                $loginPage = str_replace('$VALUEUSERNAMELOG$', $username, $loginPage);

            }

        } else {

            mysqli_close($connectionDatabase);
            $loginPage = file_get_contents('../HTML/OutErrorConnectionDatabaseQueryOrFetchPage.html');

        }

        echo $loginPage;

    } else {

        mysqli_close($connectionDatabase);

    }

} else {

    $loginPage = file_get_contents('../HTML/OutPageErrorPage404.html');
    echo $loginPage;

}

?>
