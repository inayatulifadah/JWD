<?php
include '../database/koneksi.php'; // Koneksi ke database

// Periksa apakah ID atau file sudah ditentukan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan nama file dari database berdasarkan ID
    $sql = "SELECT syarat_berkas FROM daftar WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($syarat_berkas);
    $stmt->fetch();

    // Periksa apakah file ditemukan
    if ($syarat_berkas && file_exists('../uploads/' . $syarat_berkas)) {
        $file_path = '../uploads/' . $syarat_berkas;
        $filename = basename($file_path); // Mengambil nama file

        // Set headers untuk memulai unduhan file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Membersihkan buffer output sebelum membaca file
        ob_clean();
        flush();
        readfile($file_path);
        exit;
    } else {
        // Jika file tidak ditemukan, beri tahu pengguna
        echo "<script>alert('File tidak ditemukan.'); window.location.href = '../view/hasil.php';</script>";
    }
} else {
    // Jika ID tidak diberikan, beri tahu pengguna
    echo "<script>alert('ID file tidak ditentukan.'); window.location.href = '../view/hasil.php';</script>";
}

$stmt->close();
$conn->close();
?>
