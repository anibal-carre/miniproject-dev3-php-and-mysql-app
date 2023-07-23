<?php

$host = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "miniproject3";
$connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);

if (!$connect) {
    echo "Something went wrong";
}
