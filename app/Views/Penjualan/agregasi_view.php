<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Laporan Agregasi Penjualan per Pelanggan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Nilai Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($agregasi)): ?>
                        <?php foreach ($agregasi as $row): ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= $row['kode_pelanggan']; ?></span></td>
                            <td class="fw-bold"><?= $row['nama_pelanggan']; ?></td>
                            <td><span class="badge bg-primary"><?= $row['jumlah_transaksi']; ?> Transaksi</span></td>
                            <td class="fw-bold text-success">Rp <?= number_format($row['total_nilai_penjualan'], 2, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Tidak ada data agregasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>