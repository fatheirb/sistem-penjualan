<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="fas fa-random me-2"></i>Laporan Transaksi Penjualan (JOIN dengan Pelanggan)</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No. Penjualan</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($penjualan)): ?>
                        <?php foreach ($penjualan as $row): ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= $row['no_penjualan']; ?></span></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td class="fw-bold text-primary"><?= $row['nama_pelanggan']; ?></td>
                            <td class="fw-bold text-success">Rp <?= number_format($row['total_transaksi'], 2, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Tidak ada data transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>