<?php

if(empty($_GET)) {

    $loginPage = file_get_contents('../HTML/loginpage.html');
    $loginPage = str_replace('$ERRORLOGINPAGE$', '', $loginPage);
    $loginPage = str_replace('$VALUEUSERNAMELOG$', '', $loginPage);

    echo $loginPage;

} else {

    $loginPage = file_get_contents('../HTML/OutPageErrorPage404.html');
    echo $loginPage;

}

?>
