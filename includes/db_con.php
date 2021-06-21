<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db_reservation-system";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName) or
    die("Connection failed:" . mysqli_connect_error());


$first_name = "";
$last_name = "";
$address = "";
$phone_number = "";
$date = "";


session_start();
