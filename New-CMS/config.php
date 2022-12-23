<?php
// ini_set ('display_errors', 1);
// ini_set ('display_startup_errors', 1);
// error_reporting (E_ALL);


$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "CMS_DB";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");

?>