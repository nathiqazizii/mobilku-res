<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

// Proses form jika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $nama_mobil = mysqli_real_escape_string($conn, $_POST['nama_mobil']);
    $tipe = mysqli_real_escape_string($conn, $_POST['tipe']);
    $tahun = (int)$_POST['tahun'];
    $kapasitas = (int)$_POST['kapasitas'];
    $transmisi = mysqli_real_escape_string($conn, $_POST['transmisi']);
    $harga = (int)$_POST['harga'];

    $sql = "INSERT INTO mobil (user_id, nama_mobil, tipe, tahun, kapasitas, transmisi, harga)
            VALUES ('$user_id', '$nama_mobil', '$tipe', '$tahun', '$kapasitas', '$transmisi', '$harga')";

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal menambahkan mobil: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Mobil - Mobilku.id</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Sidebar -->
<nav class="navbar bg-danger fixed-left flex-column vh-100" style="position: fixed; left: 0; top: 0; width: 220px;">
  <div class="container-fluid flex-column align-items-start">
    <a class="navbar-brand mt-2 mb-4 d-flex align-items-center text-white fw-bold" href="#">Mobilku.id</a>
    <ul class="navbar-nav flex-column w-100">
      <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="profil.php">Profil</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="auth/logout.php">Keluar</a></li>
    </ul>
  </div>
</nav>

<!-- Konten Utama -->
<div style="margin-left: 220px;">
  <div class="container py-4">
    <h4 class="mb-4">Tambah Mobil</h4>
    
    <form method="POST" class="border p-4 rounded bg-light">
      <div class="mb-3">
        <label class="form-label">Nama Mobil</label>
        <input type="text" name="nama_mobil" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tipe</label>
        <input type="text" name="tipe" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" required min="1980" max="2025">
      </div>
      <div class="mb-3">
        <label class="form-label">Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control" required min="1">
      </div>
      <div class="mb-3">
        <label class="form-label">Transmisi</label>
        <select name="transmisi" class="form-select" required>
          <option value="Manual">Manual</option>
          <option value="Matic">Matic</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga Sewa per Hari (Rp)</label>
        <input type="number" name="harga" class="form-control" required min="10000">
      </div>
      <button type="submit" class="btn btn-danger">Simpan</button>
      <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
