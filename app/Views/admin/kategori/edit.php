<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <h1 class="h2 pb-2 mb-3 border-bottom"><?= esc($title ?? 'Edit Kategori') ?></h1>
    
    <form action="<?= site_url('admin/kategori/update/' . $kategori['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST"> <!-- Method Spoofing for UPDATE -->
        
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= esc($kategori['nama_kategori']) ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= site_url('admin/kategori') ?>" class="btn btn-secondary">Batal</a>
    </form>
<?= $this->endSection() ?>
