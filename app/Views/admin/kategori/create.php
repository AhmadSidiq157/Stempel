<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <h1 class="h2 pb-2 mb-3 border-bottom"><?= esc($title ?? 'Tambah Kategori Baru') ?></h1>
    
    <form action="<?= site_url('admin/kategori/store') ?>" method="post">
        <?= csrf_field() ?> <!-- CSRF Protection -->
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/kategori') ?>" class="btn btn-secondary">Batal</a>
    </form>
<?= $this->endSection() ?>
