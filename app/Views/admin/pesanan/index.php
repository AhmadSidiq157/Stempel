<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title ?? 'Manajemen Pesanan') ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('admin/pesanan/create') ?>" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg"></i> Buat Pesanan Manual
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Pemesan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Pesan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pesanan)): ?>
                    <?php foreach ($pesanan as $item): ?>
                    <tr>
                        <td>#<?= esc($item['id']) ?></td>
                        <td>
                            <strong><?= esc($item['nama_pemesan']) ?></strong><br>
                            <small class="text-muted"><?= esc($item['no_telepon']) ?></small>
                        </td>
                        <td><?= esc($item['nama_produk']) ?></td>
                        <td><?= esc($item['jumlah']) ?></td>
                        <td>Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                        <td>
                            <?php 
                                $status_class = 'bg-secondary';
                                if ($item['status'] == 'diproses') $status_class = 'bg-info text-dark';
                                if ($item['status'] == 'selesai') $status_class = 'bg-success';
                                if ($item['status'] == 'dibatalkan') $status_class = 'bg-danger';
                            ?>
                            <span class="badge <?= $status_class ?>"><?= ucfirst(esc($item['status'])) ?></span>
                        </td>
                        <td><?= date('d M Y, H:i', strtotime($item['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/pesanan/edit/' . $item['id']) ?>" class="btn btn-sm btn-info" title="Ubah Status"><i class="bi bi-pencil"></i></a>
                            <a href="<?= site_url('admin/pesanan/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')" title="Hapus Pesanan"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">Belum ada data pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>
