<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="rounded-4 bg-dark text-white p-4 p-md-5 mb-4 shadow">
    <div class="row align-items-center g-4">
        <div class="col-lg-8">
            <span class="badge rounded-pill text-bg-success mb-3">Sistem Informasi Penjualan</span>
            <h1 class="display-5 fw-bold mb-3">Selamat datang</h1>
            <p class="lead text-white-50 mb-4">
                Kelola data produk dan lihat ringkasan transaksi penjualan dalam satu tempat.
            </p>
            <a href="<?= base_url('/produk'); ?>" class="btn btn-success btn-lg">
                <i class="fas fa-boxes me-2"></i>Lihat Data Produk
            </a>
        </div>
        <div class="col-lg-4 text-center d-none d-lg-block">
            <i class="fas fa-cash-register text-success" style="font-size: 8rem;"></i>
        </div>
    </div>
</section>

<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h2 class="h4 fw-bold mb-1">Menu Utama</h2>
        <p class="text-muted mb-0">Pilih halaman yang ingin Anda buka.</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <a href="<?= base_url('/produk'); ?>" class="card h-100 text-decoration-none border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="rounded-3 bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 3rem; height: 3rem;">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3 class="h5 fw-bold text-dark">Data Produk</h3>
                <p class="text-muted mb-3">Lihat daftar produk, harga, satuan, dan stok.</p>
                <span class="text-primary fw-semibold">Buka data produk <i class="fas fa-arrow-right ms-1"></i></span>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= base_url('/penjualan/join'); ?>" class="card h-100 text-decoration-none border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="rounded-3 bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 3rem; height: 3rem;">
                    <i class="fas fa-receipt"></i>
                </div>
                <h3 class="h5 fw-bold text-dark">Laporan Transaksi</h3>
                <p class="text-muted mb-3">Lihat transaksi beserta informasi pelanggan.</p>
                <span class="text-success fw-semibold">Buka laporan JOIN <i class="fas fa-arrow-right ms-1"></i></span>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="<?= base_url('/penjualan/agregasi'); ?>" class="card h-100 text-decoration-none border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="rounded-3 bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 3rem; height: 3rem;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="h5 fw-bold text-dark">Agregasi Penjualan</h3>
                <p class="text-muted mb-3">Bandingkan jumlah transaksi dan total penjualan per pelanggan.</p>
                <span class="text-info fw-semibold">Buka laporan agregasi <i class="fas fa-arrow-right ms-1"></i></span>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection(); ?>
