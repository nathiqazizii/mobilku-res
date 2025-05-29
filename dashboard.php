<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Ambil daftar mobil milik user
$result = $conn->query("SELECT * FROM mobil WHERE user_id = $user_id");
$jumlah_mobil = $result->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Mobilku.id</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Sidebar -->
<nav class="navbar bg-danger fixed-left flex-column vh-100" style="position: fixed; left: 0; top: 0; width: 220px;">
  <div class="container-fluid flex-column align-items-start">
    <a class="navbar-brand mt-2 mb-4 d-flex align-items-center text-white fw-bold" href="#">
      Mobilku.id
    </a>
    <ul class="navbar-nav flex-column w-100">
      <li class="nav-item">
        <a class="nav-link active text-dark" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="profil.php">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="auth/login.php">Keluar</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Konten utama -->
<div style="margin-left: 220px;">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Dashboard</h4>
      <div>Selamat datang, <strong><?= htmlspecialchars($username) ?></strong></div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <div><strong>Total Mobil</strong>: <?= $jumlah_mobil ?></div>
      <a href="tambah_mobil.php" class="btn btn-danger btn-sm">+ Tambah Mobil</a>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Mobil</th>
          <th>Tipe</th>
          <th>Tahun</th>
          <th>Kapasitas</th>
          <th>Transmisi</th>
          <th>Harga/Hari</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($mobil = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($mobil['nama_mobil']) ?></td>
            <td><?= htmlspecialchars($mobil['tipe']) ?></td>
            <td><?= $mobil['tahun'] ?></td>
            <td><?= $mobil['kapasitas'] ?> orang</td>
            <td><?= htmlspecialchars($mobil['transmisi']) ?></td>
            <td>Rp <?= number_format($mobil['harga'], 0, ',', '.') ?></td>
            <td>
              <div class="d-flex gap-2">
                <a href="edit_mobil.php?id=<?= $mobil['id'] ?>" class="btn btn-sm btn-light border border-danger text-danger">Edit</a>
                <a href="hapus_mobil.php?id=<?= $mobil['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus mobil ini?')">Hapus</a>
              </div>
            </td>
          </tr>
        <?php } ?>
        <?php if ($jumlah_mobil == 0): ?>
          <tr><td colspan="8" class="text-center text-muted">Belum ada mobil.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
