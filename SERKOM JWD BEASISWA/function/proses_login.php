<?php
require_once '../database/koneksi.php';

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Periksa user email di database
$sql = "SELECT id, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) { //Ada Email di database
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) { //Mencocokan Password
        // Login berhasil
        session_start();
        $_SESSION['user_id'] = $row['id'];
        header('Location: ../view/beranda.php'); // Benar Masuk ke Beranda
    } else {
        // Login gagal, password tidak cocok
        echo "<script>
                alert('Invalid password!');
                window.location.href = '../view/login.php'; // Kembali ke halaman login
              </script>";
    }
} else {
    // Login gagal, email tidak ditemukan
    echo "<script>
            alert('Email not found!');
            window.location.href = '../view/login.php'; // Kembali ke halaman login
          </script>";
}

$stmt->close();
$conn->close();
?>
