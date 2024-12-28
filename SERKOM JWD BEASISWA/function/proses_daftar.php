<?php
include '../database/koneksi.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $semester = $_POST['semester'];
    $last_ipk = $_POST['last_ipk'];
    $beasiswa = $_POST['beasiswa'];
    $status_ajuan = 0;

    // Validasi dan proses upload berkas
    $allowed_extensions = ['pdf', 'docx', 'zip'];
    $file_name = $_FILES['syarat_berkas']['name'];
    $file_tmp = $_FILES['syarat_berkas']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        // Tentukan folder upload
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Membuat folder upload jika belum ada
        }

        // Menyusun path lengkap dengan nama file asli
        $file_path = $upload_dir . basename($file_name); // Gunakan nama file asli

        // Pindahkan file ke folder upload
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Simpan data ke database dengan nama file yang baru
            $stmt = $conn->prepare("INSERT INTO daftar (nama, email, no_hp, semester, last_ipk, beasiswa, syarat_berkas, status_ajuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssidsis", $nama, $email, $no_hp, $semester, $last_ipk, $beasiswa, $file_name, $status_ajuan); // Simpan nama file asli di database

            if ($stmt->execute()) {
                // Ambil id yang baru saja disisipkan
                $id_daftar = $stmt->insert_id;

                // Update database dengan nama file lengkap berdasarkan ID
                $new_file_name = $id_daftar . "_" . $file_name; // Menggabungkan ID dengan nama file
                $new_file_path = $upload_dir . $new_file_name;

                // Pindahkan file ke nama baru dengan ID
                if (rename($file_path, $new_file_path)) {
                    // Update nama file baru ke database
                    $update_stmt = $conn->prepare("UPDATE daftar SET syarat_berkas = ? WHERE id = ?");
                    $update_stmt->bind_param("si", $new_file_name, $id_daftar);

                    if ($update_stmt->execute()) {
                        // Notifikasi jika berhasil
                        echo "<script>
                            alert('Formulir berhasil dikirim. Berkas berhasil diunggah.');
                            window.location.href = '../view/hasil.php'; // Arahkan ke halaman hasil
                        </script>";
                    } else {
                        // Notifikasi jika gagal mengupdate data
                        echo "<script>
                            alert('Terjadi kesalahan saat mengupdate nama berkas.');
                            window.location.href = '../view/pendaftaran.php'; // Arahkan kembali ke halaman form
                        </script>";
                    }
                } else {
                    // Notifikasi jika gagal merename berkas
                    echo "<script>
                        alert('Gagal merename berkas.');
                        window.location.href = '../view/pendaftaran.php'; // Arahkan kembali ke halaman form
                    </script>";
                }
            } else {
                // Notifikasi jika gagal menyimpan data
                echo "<script>
                    alert('Terjadi kesalahan saat menyimpan data.');
                    window.location.href = '../view/pendaftaran.php'; // Arahkan kembali ke halaman form
                </script>";
            }
        } else {
            // Notifikasi jika gagal mengunggah berkas
            echo "<script>
                alert('Gagal mengunggah berkas.');
                window.location.href = '../view/pendaftaran.php'; // Arahkan kembali ke halaman form
            </script>";
        }
    } else {
        // Notifikasi jika format file tidak valid
        echo "<script>
            alert('Format file tidak valid. Harap unggah file dengan format PDF, DOCX, atau ZIP.');
            window.location.href = '../view/pendaftaran.php'; // Arahkan kembali ke halaman form
        </script>";
    }
}
?>
