<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - CI4 & PostgreSQL</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Navbar Modern -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url('/'); ?>">
                <i class="fas fa-cash-register me-2"></i>Sistem Penjualan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/produk'); ?>">
                            <i class="fas fa-boxes me-1"></i> Data Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/penjualan/join'); ?>">
                            <i class="fas fa-random me-1"></i> Laporan JOIN
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/penjualan/agregasi'); ?>">
                            <i class="fas fa-chart-bar me-1"></i> Laporan Agregasi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Dinamis -->
    <div class="container my-4">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted">
        <p>&copy; 2026 - Sistem Informasi Penjualan | Dibangun dengan CodeIgniter 4 & PostgreSQL</p>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>