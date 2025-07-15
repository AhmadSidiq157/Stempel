<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <h1 class="h2 pb-2 mb-3 border-bottom"><?= esc($title ?? 'Ubah Status Pesanan') ?></h1>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold">
            Detail Pesanan #<?= esc($pesanan['id']) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Pemesan:</strong><br> <?= esc($pesanan['nama_pemesan']) ?></p>
                    <p><strong>Produk Dipesan:</strong><br> <?= esc($pesanan['nama_produk']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah:</strong><br> <?= esc($pesanan['jumlah']) ?> pcs</p>
                    <p><strong>Total Harga:</strong><br> Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= site_url('admin/pesanan/update/' . $pesanan['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">
        
        <div class="mb-3">
            <label for="status" class="form-label fw-bold">Ubah Status Pesanan</label>
            <select class="form-select" id="status" name="status">
                <?php foreach($statuses as $status): ?>
                    <option value="<?= $status ?>" <?= ($status == $pesanan['status']) ? 'selected' : '' ?>>
                        <?= ucfirst($status) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Update Status</button>
        <a href="<?= site_url('admin/pesanan') ?>" class="btn btn-secondary">Kembali</a>
    </form>
<?= $this->endSection() ?>
