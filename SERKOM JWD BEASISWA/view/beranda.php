<?php 
include 'header-login.php'; 
session_start(); // Mulai sesi

// Koneksi ke database
include '../database/koneksi.php'; 

// Ambil ID pengguna dari sesi
$userId = $_SESSION['user_id'] ?? null;

// Query untuk mengambil username
$username = '';
if ($userId) {
    $query = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
    }
    $query->close();
}
?>

<div class="container mt-5">
    <h1 class="text-center text-pink mb-4">Selamat Datang, <?= htmlspecialchars($username) ?>!</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <img src="../asset/image/akademik.jpeg" class="card-img-top" alt="Beasiswa Prestasi">
                <div class="card-body">
                    <h5 class="card-title">Beasiswa Akademik</h5>
                    <p class="card-text">
                        Syarat:
                        <ul>
                            <li>IPK Minimal 3.8</li>
                            <li>Essay Motivasi</li>
                            <li>Sertifikat Prestasi Akademik</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <img src="../asset/image/nonakademik.jpg" class="card-img-top" alt="Beasiswa Unggulan">
                <div class="card-body">
                    <h5 class="card-title">Beasiswa Non-Akademik</h5>
                    <p class="card-text">
                        Syarat:
                        <ul>
                            <li>IPK Minimal 3.5</li>
                            <li>Pengalaman Organisasi</li>
                            <li>Sertifikat Prestasi Non-Akademik</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <img src="../asset/image/influencer.png" class="card-img-top" alt="Beasiswa Hafidz">
                <div class="card-body">
                    <h5 class="card-title">Beasiswa Influencer</h5>
                    <p class="card-text">
                        Syarat:
                        <ul>
                            <li>IPK Minimal 3.0</li>
                            <li>KTP dan KK</li>
                            <li>Akun Sosial Media</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-center">Grafik Penerima Beasiswa</h2>
        <canvas id="beasiswaChart" height="100"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('beasiswaChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2021', '2022', '2023', '2024'],
            datasets: [
                {
                    label: 'Jumlah Penerima Beasiswa Akademik',
                    data: [45, 150, 180, 200],
                    backgroundColor: 'rgba(128, 0, 0, 0.5)', // Maroon
                    borderColor: 'rgba(128, 0, 0, 1)', // Maroon solid
                    borderWidth: 1
                },
                {
                    label: 'Jumlah Penerima Beasiswa Non-Akademik',
                    data: [100, 130, 170, 190],
                    backgroundColor: 'rgba(178, 34, 34, 0.5)', // Firebrick (merah bata)
                    borderColor: 'rgba(178, 34, 34, 1)', // Firebrick solid
                    borderWidth: 1
                },
                {
                    label: 'Jumlah Penerima Beasiswa Influencer',
                    data: [90, 110, 160, 180],
                    backgroundColor: 'rgba(220, 20, 60, 0.5)', // Crimson (merah terang)
                    borderColor: 'rgba(220, 20, 60, 1)', // Crimson solid
                    borderWidth: 1
                }
            ]


        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<?php include 'footer.php'; ?>
