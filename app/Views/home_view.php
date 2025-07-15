<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Selamat Datang') ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar Pelanggan -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('/') ?>"><i class="bi bi-gem"></i> TOKO STEMPEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cara Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin') ?>"><i class="bi bi-person-circle"></i> Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container my-5">
        <div class="text-center mb-5">
            <h1 class="display-4"><?= esc($title) ?></h1>
            <p class="lead text-muted">Temukan berbagai jenis stempel berkualitas untuk kebutuhan Anda.</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $item): ?>
                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="<?= site_url('uploads/produk/' . esc($item['gambar'])) ?>" class="card-img-top" alt="<?= esc($item['nama_produk']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= esc($item['nama_produk']) ?></h5>
                                <p class="card-text text-muted small"><span class="badge bg-secondary"><?= esc($item['nama_kategori']) ?></span></p>
                                <p class="card-text flex-grow-1"><?= esc(word_limiter($item['deskripsi'], 15)) ?></p>
                                <h4 class="card-text text-danger fw-bold mt-auto">
                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                </h4>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="#" class="btn btn-success w-100"><i class="bi bi-whatsapp"></i> Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">Belum ada produk yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5 bg-dark text-white">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> Toko Stempel. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
