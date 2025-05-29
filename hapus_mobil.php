<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id_mobil = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cek apakah mobil milik user
$cek = $conn->query("SELECT * FROM mobil WHERE id = $id_mobil AND user_id = $user_id");
if ($cek->num_rows !== 1) {
    echo "Mobil tidak ditemukan atau Anda tidak memiliki akses.";
    exit;
}

// Lakukan penghapusan
$hapus = $conn->query("DELETE FROM mobil WHERE id = $id_mobil AND user_id = $user_id");

if ($hapus) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "Gagal menghapus mobil: " . $conn->error;
}
?>
