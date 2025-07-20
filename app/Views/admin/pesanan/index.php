<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID Pesanan</th>
                <th>Tgl Pesan</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pesanan)): ?>
                <?php foreach ($pesanan as $item): ?>
                <tr>
                    <td>#<?= esc($item['id']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($item['created_at'])) ?></td>
                    <td><?= esc($item['nama_pelanggan']) ?></td>
                    <td><?= esc($item['nama_produk']) ?></td>
                    <td>Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                    <td><span class="badge bg-info text-dark"><?= esc($item['status']) ?></span></td>
                    <td class="text-center">
                        <a href="<?= site_url('admin/pesanan/detail/' . $item['id']) ?>" class="btn btn-sm btn-primary" title="Lihat Detail"><i class="bi bi-eye-fill"></i></a>
                        <a href="<?= site_url('admin/pesanan/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')" title="Hapus"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada pesanan yang masuk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
