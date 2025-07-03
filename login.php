<?php
include "config.php";
session_start();

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Ambil data user dari database
    $query = mysqli_prepare($koneksi, "SELECT username, password, nama FROM user WHERE username = ?");
    mysqli_stmt_bind_param($query, "s", $user);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if ($result && mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);

        // Jika password disimpan tanpa hash (tidak direkomendasikan, hanya cocok untuk sistem lama)
        if ($pass === $data['password']) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Password salah
            header("Location: index.php?error=wrongpass");
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("Location: index.php?error=usernotfound");
        exit();
    }
}
?>
