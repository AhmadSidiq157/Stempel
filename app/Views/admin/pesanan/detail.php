<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
    <a href="<?= site_url('admin/pesanan') ?>" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Detail Pelanggan & Pengiriman</div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><?= esc($pesanan['nama_pelanggan'] ?? 'N/A') ?></dd>
                    <dt class="col-sm-4">No. HP</dt>
                    <dd class="col-sm-8"><?= esc($pesanan['no_hp'] ?? 'N/A') ?></dd>
                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8"><?= nl2br(esc($pesanan['alamat'] ?? 'N/A')) ?></dd>
                </dl>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">Update Status Pesanan</div>
            <div class="card-body">
                <form action="<?= site_url('admin/pesanan/update_status/' . $pesanan['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <select name="status" class="form-select">
                            <option value="Baru" <?= ($pesanan['status'] ?? '') == 'Baru' ? 'selected' : '' ?>>Baru</option>
                            <option value="Diproses" <?= ($pesanan['status'] ?? '') == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="Dikirim" <?= ($pesanan['status'] ?? '') == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                            <option value="Selesai" <?= ($pesanan['status'] ?? '') == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="Dibatalkan" <?= ($pesanan['status'] ?? '') == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Pesanan -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Detail Pesanan</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>ID Pesanan:</span>
                    <strong>#<?= esc($pesanan['id']) ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tanggal Pesan:</span>
                    <strong><?= date('d M Y H:i', strtotime($pesanan['created_at'])) ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Status:</span>
                    <strong class="text-primary"><?= esc($pesanan['status'] ?? 'N/A') ?></strong>
                </li>
            </ul>
            <div class="card-body">
                <h6 class="card-title">Produk yang Dipesan:</h6>
                <div class="d-flex align-items-center">
                    <img src="<?= base_url('uploads/produk/' . esc($pesanan['gambar'] ?? 'placeholder.png')) ?>" width="80" class="img-thumbnail me-3" alt="Gambar Produk">
                    <div>
                        <strong><?= esc($pesanan['nama_produk'] ?? 'Produk Dihapus') ?></strong><br>
                        <small><?= esc($pesanan['jumlah']) ?> x Rp <?= number_format($pesanan['harga_satuan'] ?? 0, 0, ',', '.') ?></small>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between fs-5 fw-bold">
                <span>Total Pembayaran:</span>
                <span class="text-danger">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
