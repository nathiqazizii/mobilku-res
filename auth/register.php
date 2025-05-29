<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape semua input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);

    // Cek apakah username sudah dipakai
    $cek = $conn->query("SELECT * FROM user WHERE username='$username'");
    if (!$cek) {
        die("Query error: " . $conn->error);
    }

    if ($cek->num_rows > 0) {
        echo "Username sudah digunakan.";
        exit;
    }

    // Lakukan INSERT
    $sql = "INSERT INTO user (username, password, email, nama_lengkap) 
            VALUES ('$username', '$password', '$email', '$nama')";
    
    if ($conn->query($sql)) {
        header("Location: login.php");
    } else {
        echo "Registrasi gagal: " . $conn->error;
    }
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
  <!-- Halaman Registrasi -->
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow bg-white" style="min-width: 350px;">
        <div class="card-header text-center text-danger">
            <h4 class="mb-0">Mobilku.id</h4>
        </div>
        <div>
            <p class="text-center text-muted">Buat Akun Baru</p>
        </div>
        <div class="card-body">
            <form action="register.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control mb-3" id="floatingName" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    <label for="floatingName">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control mb-3" id="floatingEmail" name="email" placeholder="Email" required>
                    <label for="floatingEmail">Email</label>
                </div>
                <button type="submit" class="btn btn-danger w-100">Daftar</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a class="text-danger" href="login.php">Login</a></p>
            </div>
        </div>
        <div class="card-footer text-center text-body-secondary">
            <footer>
                <small>&copy; 2023 Mobilku.id. All rights reserved.</small>
            </footer>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>