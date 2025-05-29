<?php
session_start();
include 'config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM user WHERE id = $id");

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("User tidak ditemukan.");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>

  <body>
  <!--sidebar -->
<nav class="navbar bg-danger fixed-left flex-column vh-100" style="position: fixed; left: 0; top: 0; width: 220px;">
    <div class="container-fluid flex-column align-items-start">
        <a class="navbar-brand mt-2 mb-4 d-flex align-items-center text-white fw-bold" href="#">
            Mobilku.id
        </a>
        <ul class="navbar-nav flex-column w-100">
            <li class="nav-item">
                <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-dark" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="auth/login.php">Keluar</a>
            </li>
        </ul>
    </div>
</nav>
<div style="margin-left: 220px;">
    <div class="p-3">
        <span class="fw-bold" style="font-size: 1.5rem;">Profil</span>
    </div>
</div>
<!--card profil -->
<div class="container mt-4" style="max-width: 600px;">
    <div class="card">
        <div class="card-body p-4">
            <h3>Profil Pengguna</h3>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($user['nama_lengkap']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Tanggal Bergabung:</strong> <?= isset($user['tanggal_bergabung']) ? $user['tanggal_bergabung'] : "Belum tersedia" ?></p>

            <div class="d-flex gap-2 mt-3">
                <a href="edit_profil.php" class="btn btn-danger">Edit Profil</a>
                <a href="ubah_password.php" class="btn btn-outline-danger">Ubah Password</a>
            </div>
        </div>
        <div class="card-footer text-body-secondary text-center">
            <footer>
                <small>&copy; 2023 Mobilku.id. All rights reserved.</small>
            </footer>
        </div>
    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>