<?php
// konfigurasi koneksi
$host = "localhost";
$user = "root";
$pass = "";
$db   = "nilai_sekolah_mts"; // pastikan database ini sudah dibuat di phpMyAdmin

// membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
