<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title ?? 'Buat Pesanan Manual') ?></h1>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= site_url('admin/pesanan/store') ?>" method="post">
                <?= csrf_field() ?> <!-- Perlindungan CSRF CodeIgniter -->
                
                <h5 class="card-title mb-3">Informasi Pemesan</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="<?= old('nama_pemesan') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= old('no_telepon') ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
                </div>

                <hr class="my-4">

                <h5 class="card-title mb-3">Detail Pesanan</h5>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="produk_id" class="form-label">Produk yang Dipesan</label>
                        <select class="form-select" id="produk_id" name="produk_id" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php if (!empty($produk)): ?>
                                <?php foreach($produk as $item): ?>
                                    <option value="<?= $item['id'] ?>" data-harga="<?= $item['harga'] ?>" <?= old('produk_id') == $item['id'] ? 'selected' : '' ?>>
                                        <?= esc($item['nama_produk']) ?> (Rp <?= number_format($item['harga'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="<?= old('jumlah', 1) ?>" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?= old('total_harga', 0) ?>" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan Pesanan</button>
                <a href="<?= site_url('admin/pesanan') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script>
        // Pastikan DOM sudah dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen-elemen yang diperlukan
            const produkSelect = document.getElementById('produk_id');
            const jumlahInput = document.getElementById('jumlah');
            const totalHargaInput = document.getElementById('total_harga');

            // Fungsi untuk menghitung total harga
            function calculateTotal() {
                const selectedOption = produkSelect.options[produkSelect.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga') || 0;
                const jumlah = jumlahInput.value || 0;
                
                // Hitung total dan set nilainya di input total harga
                totalHargaInput.value = harga * jumlah;
            }

            // Tambahkan event listener untuk memanggil fungsi kalkulasi
            produkSelect.addEventListener('change', calculateTotal);
            jumlahInput.addEventListener('input', calculateTotal);

            // Panggil fungsi sekali saat halaman dimuat untuk menginisialisasi nilai jika ada old input
            calculateTotal();
        });
    </script>
<?= $this->endSection() ?>
