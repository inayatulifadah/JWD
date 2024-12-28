<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "beasiswa";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
