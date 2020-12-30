<?php

if(empty($_GET)) {

    $registrationPage = file_get_contents('../HTML/registrationpage.html');

    $registrationPage = str_replace('$ERRORREGISTRATIONPAGE$', '', $registrationPage);
    $registrationPage = str_replace('$VALUENAME$', '', $registrationPage);
    $registrationPage = str_replace('$VALUESURNAME$', '', $registrationPage);
    $registrationPage = str_replace('$VALUEUSERNAME$', '', $registrationPage);
    $registrationPage = str_replace('$VALUEEMAIL$', '', $registrationPage);

    echo $registrationPage;

} else {

    $registrationPage = file_get_contents('../HTML/OutPageErrorPage404.html');
    echo $registrationPage;

}

?>
