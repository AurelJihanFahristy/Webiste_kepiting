<?php
// Mulai session (jika belum ada)
if (!session_id()) {
    session_start();
}

// Jika admin SUDAH login, lempar dia ke dashboard (index.php)
if (isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kepiting Segar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin-top: 100px;
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card mx-auto">
            <div class="card-body p-4 p-md-5">
                <h3 class="card-title text-center mb-4 fw-bold">Login Admin</h3>
                
                <?php
                // Tampilkan pesan error jika ada
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    if ($_GET['error'] == 'salah') {
                        echo 'Username atau password salah!';
                    } elseif ($_GET['error'] == 'kosong') {
                        echo 'Username dan password tidak boleh kosong!';
                    }
                    echo '</div>';
                }
                ?>

                <form action="proses_login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger fw-bold">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>