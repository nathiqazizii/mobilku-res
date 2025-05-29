<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mobilku";

$conn = new mysqli($host, $user, $pass, $dbname);

// Error handling
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
