<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "hotel-list";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}
