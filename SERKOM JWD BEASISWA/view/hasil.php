<?php
include 'header-login.php'; 
include '../database/koneksi.php'; // Koneksi database

// Perintah SQL Membaca Database Tabel Daftar
$query = "SELECT * FROM daftar";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Display the records in a table
    echo "<div class='container mt-5'>";
    echo "<h2 class='text-center mb-4'>Daftar Pendaftaran Beasiswa</h2>";
    echo "<table class='table table-striped table-hover table-bordered'>";
    echo "<thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Semester</th>
                <th>IPK Terakhir</th>
                <th>Beasiswa</th>
                <th>Syarat Berkas</th>
                <th>Status Ajuan</th>
                <th>Tanggal Pendaftaran</th>
            </tr>
          </thead>";
    echo "<tbody>";

    $no = 1; 
    while ($row = $result->fetch_assoc()) {
        $status_ajuan = $row['status_ajuan'] == 0 ? 'Belum Terverifikasi' : ($row['status_ajuan'] == 1 ? 'Sudah Terverifikasi' : 'Status Tidak Valid');
        
        $file_path = '../uploads/' . $row['syarat_berkas'];
        $download_link = file_exists($file_path) ? "<a href='$file_path' download class='btn btn-pink btn-sm'><i class='fas fa-download'></i> Download</a>" : "<span class='text-muted'>File Tidak Tersedia</span>";
        
        $tanggal_pendaftaran = date('d-m-Y H:i:s', strtotime($row['created_at']));

        echo "<tr>
                <td>$no</td> <!-- Display the incremented counter as No -->
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td>{$row['no_hp']}</td>
                <td>{$row['semester']}</td>
                <td>{$row['last_ipk']}</td>
                <td>{$row['beasiswa']}</td>
                <td>$download_link</td>
                <td>$status_ajuan</td>
                <td>$tanggal_pendaftaran</td>
              </tr>";

        $no++; 
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p class='text-center'>Tidak ada data untuk ditampilkan.</p>";
}

include 'footer.php';
?>
