<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title ?? 'Manajemen Produk') ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('admin/produk/create') ?>" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Produk
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produk)): ?>
                    <?php foreach ($produk as $item): ?>
                    <tr>
                        <td>
                            <!-- Baris ini membuat URL yang benar untuk menampilkan gambar -->
                            <img src="<?= site_url('uploads/produk/' . esc($item['gambar'])) ?>" 
                                 alt="<?= esc($item['nama_produk']) ?>" 
                                 width="80" 
                                 class="img-thumbnail">
                        </td>
                        <td><?= esc($item['nama_produk']) ?></td>
                        <td><span class="badge bg-secondary"><?= esc($item['nama_kategori']) ?></span></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/produk/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <a href="<?= site_url('admin/produk/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" title="Hapus"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada data produk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>
