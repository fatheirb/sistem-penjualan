<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Daftar Data Produk</h4>
        <!-- Tombol Tambah Produk (Opsional untuk CRUD) -->
        <a href="<?= base_url('/produk/create'); ?>" class="btn btn-light btn-sm fw-bold">
            <i class="fas fa-plus me-1"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        <?php if ($message = session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert"><?= esc($message); ?></div>
        <?php endif; ?>
        <?php if ($message = session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert"><?= esc($message); ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produk)): ?>
                        <?php foreach ($produk as $row): ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= esc($row['kode_produk']); ?></span></td>
                            <td class="fw-bold"><?= esc($row['nama_produk']); ?></td>
                            <td><?= esc($row['satuan']); ?></td>
                            <td>Rp <?= number_format((float) $row['harga_jual'], 2, ',', '.'); ?></td>
                            <td>
                                <span class="badge <?= $row['stok'] > 0 ? 'bg-success' : 'bg-danger'; ?>">
                                    <?= esc($row['stok']); ?>
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="<?= site_url('produk/edit/' . rawurlencode($row['kode_produk'])); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Ubah
                                </a>
                                <form action="<?= site_url('produk/delete/' . rawurlencode($row['kode_produk'])); ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada data produk ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>