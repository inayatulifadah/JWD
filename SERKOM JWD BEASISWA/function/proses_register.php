<?php
// Sertakan file koneksi database
require_once '../database/koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi password
if ($password !== $confirm_password) {
    echo "<script>
        alert('Passwords do not match!');
        window.location.href = '../view/register.php'; // Kembali ke halaman register
    </script>";
    exit();
}

// Cek apakah email sudah terdaftar
$sql = "SELECT email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('Email sudah digunakan. Silakan gunakan email lain.');
        window.location.href = '../view/register.php'; // Kembali ke halaman register
    </script>";
    $stmt->close();
    exit();
}

// Hash password 
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Simpan ke database
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script>
        alert('Registration successful!');
        window.location.href = '../view/login.php'; // Arahkan ke halaman login
    </script>";
} else {
    echo "<script>
        alert('Error: " . $stmt->error . "');
        window.location.href = '../view/register.php'; // Kembali ke halaman register
    </script>";
}

$stmt->close();
$conn->close();
?>
