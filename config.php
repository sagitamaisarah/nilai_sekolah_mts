<?php
$koneksi = mysqli_connect("localhost", "root", "", "nilai-sekolah-smp");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
