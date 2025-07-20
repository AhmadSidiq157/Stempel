<?= $this->extend('layouts/customer_template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><?= esc($title) ?></h4>
                </div>
                <div class="card-body p-4">

                    <!-- Menampilkan detail produk yang dipesan -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="<?= base_url('uploads/produk/' . esc($produk['gambar'])) ?>" class="img-fluid rounded" alt="<?= esc($produk['nama_produk']) ?>">
                        </div>
                        <div class="col-md-8">
                            <h3><?= esc($produk['nama_produk']) ?></h3>
                            <p class="text-muted"><?= esc($produk['deskripsi']) ?></p>
                            <h4 class="text-danger fw-bold">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h4>
                        </div>
                    </div>

                    <hr>

                    <!-- Form Pemesanan -->
                    <form action="<?= site_url('pesan/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="produk_id" value="<?= esc($produk['id']) ?>">
                        <input type="hidden" name="harga" id="harga" value="<?= esc($produk['harga']) ?>">

                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= old('nama_pelanggan') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP (WhatsApp)</label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap Pengiriman</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah Pesan</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', 1) ?>" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Harga</label>
                                <h4 id="total_harga" class="fw-bold">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h4>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Kirim Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Script sederhana untuk update total harga secara real-time
document.addEventListener('DOMContentLoaded', function() {
    const hargaSatuan = parseFloat(document.getElementById('harga').value);
    const jumlahInput = document.getElementById('jumlah');
    const totalHargaDisplay = document.getElementById('total_harga');

    function updateTotal() {
        const jumlah = parseInt(jumlahInput.value) || 0;
        const total = hargaSatuan * jumlah;
        totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    jumlahInput.addEventListener('input', updateTotal);
});
</script>

<?= $this->endSection() ?>
