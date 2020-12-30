<?php

$connectionDatabase = mysqli_connect("localhost", "mmitillo", "Mi5ithei4les7Sie") or die(header('Location: ../HTML/ErrorDatabaseCloseMySql.html'));
mysqli_select_db($connectionDatabase, "mmitillo");

//$connectionDatabase = mysqli_connect("localhost", "root", "") or die(header('Location: ../HTML/ErrorDatabaseCloseMySql.html'));
//mysqli_select_db($connectionDatabase, "tecweb");

?>
