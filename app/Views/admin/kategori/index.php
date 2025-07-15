<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title ?? 'Manajemen Kategori') ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('admin/kategori/create') ?>" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kategori)): ?>
                    <?php $i = 1; ?>
                    <?php foreach ($kategori as $item): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($item['nama_kategori']) ?></td>
                        <td>
                            <a href="<?= site_url('admin/kategori/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                            <a href="<?= site_url('admin/kategori/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"><i class="bi bi-trash-fill"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data kategori.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>
