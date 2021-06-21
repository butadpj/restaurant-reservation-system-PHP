<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db_reservation-system";
// $port = "3307";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName) or
    die("Connection failed:" . mysqli_connect_error());


$name = "";
$contact = "";
$date = "";

session_start();
