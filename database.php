<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "gestionetudiants";
$port = 3306;
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, $port);
if (!$conn) {
    die("Something went wrong;");
}