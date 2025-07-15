<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <h1 class="h2 pb-2 mb-3 border-bottom"><?= esc($title ?? 'Tambah Produk Baru') ?></h1>
    
    <form action="<?= site_url('admin/produk/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $kat): ?>
                    <option value="<?= $kat['id'] ?>"><?= esc($kat['nama_kategori']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input class="form-control" type="file" id="gambar" name="gambar" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/produk') ?>" class="btn btn-secondary">Batal</a>
    </form>
<?= $this->endSection() ?>
