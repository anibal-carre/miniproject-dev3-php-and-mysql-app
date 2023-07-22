<?php

$host = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "miniproject";
$connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);

if (!$connect) {
    echo "Something went wrong";
}
