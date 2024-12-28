<?php
include 'header-login.php'; 

// Memulai sesi
session_start();

// Array IPK berdasarkan semester
$ipk_per_semester = [
    1 => 2.5, 2 => 2.8, 3 => 3.0, 4 => 3.2,
    5 => 3.4, 6 => 3.6, 7 => 3.8, 8 => 4.0
];

// Pilihan beasiswa
$beasiswa_list = ['Akademik', 'Non-Akademik', 'Pembangunan'];
?>

<body>
<div class="container mt-5" style="max-width: 1300px;">
    <h2 class="text-center mb-4">Form Pendaftaran Beasiswa</h2>
    <form action="../function/proses_daftar.php" method="POST" enctype="multipart/form-data" class="form-container shadow-lg p-4 rounded bg-light">
        <div class="row"> 
            <!-- Left Column -->
            <!-- input nama -->
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" tabindex="1" required>
            </div>
            <!-- input email -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" tabindex="2" required>
            </div>
            <!-- input nomor hp -->
            <div class="col-md-6 mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="\d*" tabindex="3" oninput="validatePhoneNumber()" required>
                <small id="no_hp_error" class="text-danger d-none">Masukkan Angka Saja!</small>
            </div>
            <!-- pilih semester saat ini -->
            <div class="col-md-6 mb-3">
                <label for="semester" class="form-label">Semester Saat Ini</label>
                <select class="form-select" id="semester" name="semester" tabindex="4" required>
                    <option value="" disabled selected>Pilih Semester</option>   
                    <?php foreach ($ipk_per_semester as $semester => $ipk): ?>
                        <option value="<?= $semester ?>" data-ipk="<?= $ipk ?>">Semester <?= $semester ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="row">
            <!-- Right Column -->
            <div class="col-md-6 mb-3">
                <label for="last_ipk" class="form-label">IPK Terakhir</label>
                <input type="text" class="form-control" id="last_ipk" name="last_ipk" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="beasiswa" class="form-label">Pilih Beasiswa</label>
                <select class="form-select" id="beasiswa" name="beasiswa" tabindex="5" required>
                    <option value="" selected disabled>Pilih Beasiswa</option>
                    <?php foreach ($beasiswa_list as $beasiswa): ?>
                        <option value="<?= $beasiswa ?>"><?= $beasiswa ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="syarat_berkas" class="form-label">Unggah Berkas (PDF, DOCX, ZIP)</label>
                <input type="file" class="form-control" id="syarat_berkas" name="syarat_berkas" accept=".pdf, .docx, .zip" tabindex="6" required>
            </div>
        </div>

        <div class="d-flex justify-content-end">
    <a href="pendaftaran.php" class="btn btn-secondary me-0.5">Batal</a>
    <button type="submit" class="btn btn-pink ms-3">Kirim Formulir</button>
</div>

    </form>
</div>

<!-- Optional: Add some custom styles -->
<style>
    .form-container {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 8px;
        transition: border-color 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        border-radius: 8px;
        background-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        border-radius: 8px;
        background-color: #6c757d;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #495057;
    }

    .form-label {
        font-weight: bold;
    }

    .mb-3 small {
        font-size: 0.85rem;
    }
</style>


<script>
    // Validasi nomor HP
    function validatePhoneNumber() {
        const no_hp = document.getElementById('no_hp');
        const error = document.getElementById('no_hp_error');

        if (/[^0-9]/.test(no_hp.value)) {
            error.classList.remove('d-none');
        } else {
            error.classList.add('d-none');
        }
    }

    // Update IPK berdasarkan semester
    document.getElementById('semester').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const ipk = selectedOption.getAttribute('data-ipk');
        document.getElementById('last_ipk').value = ipk;

        // Nonaktifkan beasiswa jika IPK kurang dari 3.0
        const beasiswaSelect = document.getElementById('beasiswa');
        if (ipk < 3.0) {
            beasiswaSelect.value = "";
            beasiswaSelect.disabled = true;
        } else {
            beasiswaSelect.disabled = false;
        }
    });
</script>
</body>
</html>

<br><br>
<?php include 'footer.php'; ?>
