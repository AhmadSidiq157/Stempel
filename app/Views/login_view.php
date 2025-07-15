<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Login') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #e9ecef;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="card login-card shadow-lg">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h3 class="card-title fw-bold">Admin Login</h3>
                <p class="text-muted">Silakan masuk untuk melanjutkan</p>
            </div>
            
            <!-- Menampilkan pesan error jika ada -->
            <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;?>

            <form action="<?= site_url('auth/login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
