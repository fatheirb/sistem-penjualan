<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="mb-3">
    <button
        type="button"
        class="btn btn-white bg-white border rounded-pill shadow-sm"
        id="produk-back"
        title="Click to go back"
        aria-label="Click to go back"
    >
        <i class="fas fa-arrow-left me-2" aria-hidden="true"></i>Click to go back
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><?= esc($title); ?></h4>
    </div>
    <div class="card-body">
        <?php if ($errors !== []): ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= esc($action); ?>" method="post" id="produk-form">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="kode_produk" class="form-label">Kode Produk</label>
                <input
                    type="text"
                    class="form-control"
                    id="kode_produk"
                    name="kode_produk"
                    value="<?= esc($produk['kode_produk'] ?? ''); ?>"
                    maxlength="20"
                    required
                    <?= $isEdit ? 'readonly' : ''; ?>
                >
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= esc($produk['nama_produk'] ?? ''); ?>" maxlength="100" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?= esc($produk['satuan'] ?? ''); ?>" maxlength="30" required>
            </div>
            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?= esc($produk['harga_jual'] ?? ''); ?>" min="0" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= esc($produk['stok'] ?? ''); ?>" min="0" step="1" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" id="produk-submit">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('produk-back').addEventListener('click', function () {
        if (window.history.length > 1) {
            window.history.back();
            return;
        }

        window.location.assign(<?= json_encode(site_url('produk')); ?>);
    });

    document.getElementById('produk-form').addEventListener('submit', function () {
        const submitButton = document.getElementById('produk-submit');
        submitButton.disabled = true;
        submitButton.textContent = 'Menyimpan...';
    });
</script>

<?= $this->endSection(); ?>
