<?php

session_start();

session_unset();

session_destroy();

header('Location: phpPrincipal.php');
exit;

?>
