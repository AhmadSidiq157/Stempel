<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang, <?= esc(session()->get('username')) ?>!</h1>
    </div>

    <p class="lead">Ini adalah halaman dashboard panel admin Anda.</p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Pesanan</h5>
                            <h2 class="fw-bold display-4"><?= esc($total_pesanan ?? 0) ?></h2>
                        </div>
                        <i class="bi bi-cart-check-fill opacity-50" style="font-size: 4rem;"></i>
                    </div>
                </div>
                 <a href="<?= site_url('admin/pesanan') ?>" class="card-footer text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Produk</h5>
                            <h2 class="fw-bold display-4"><?= esc($total_produk ?? 0) ?></h2>
                        </div>
                        <i class="bi bi-box-seam-fill opacity-50" style="font-size: 4rem;"></i>
                    </div>
                </div>
                <a href="<?= site_url('admin/produk') ?>" class="card-footer text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Kategori</h5>
                            <h2 class="fw-bold display-4"><?= esc($total_kategori ?? 0) ?></h2>
                        </div>
                        <i class="bi bi-tags-fill opacity-50" style="font-size: 4rem;"></i>
                    </div>
                </div>
                 <a href="<?= site_url('admin/kategori') ?>" class="card-footer text-white text-decoration-none">
                    Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
