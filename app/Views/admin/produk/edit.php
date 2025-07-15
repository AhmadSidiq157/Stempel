<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <h1 class="h2 pb-2 mb-3 border-bottom"><?= esc($title ?? 'Edit Produk') ?></h1>
    
    <form action="<?= site_url('admin/produk/update/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">
        
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= esc($produk['nama_produk']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        <?php foreach($kategori as $kat): ?>
                            <option value="<?= $kat['id'] ?>" <?= ($kat['id'] == $produk['kategori_id']) ? 'selected' : '' ?>>
                                <?= esc($kat['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= esc($produk['harga']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= esc($produk['deskripsi']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>
            </div>
            <div class="col-md-4">
                <p>Gambar Saat Ini:</p>
                <img src="<?= site_url('uploads/produk/' . esc($produk['gambar'])) ?>" class="img-fluid rounded shadow-sm">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="<?= site_url('admin/produk') ?>" class="btn btn-secondary mt-3">Batal</a>
    </form>
<?= $this->endSection() ?>
