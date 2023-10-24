<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'sundayManual';


$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}




//Global Varialbles
define("CSRF_TOKEN_SECRET", 'sjhgjhjsdbshbshb');










