<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">    
    <style>
        /* Custom CSS for enlarging navbar text */
        .navbar-nav .nav-link {
            font-size: 1.2rem; /* Change the value to adjust the size */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-pink">
        <div class="container-fluid py-3">
            <a class="navbar-brand" href="beranda.php">Pendaftaran Beasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Add ms-auto to push the navbar items to the right -->
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pendaftaran.php">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hasil.php">Hasil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../function/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
