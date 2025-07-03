<?php
include "config.php"; // pastikan di config.php sudah ada koneksi $koneksi = mysqli_connect(...)

$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysqli_query($koneksi, $query);

while ($data = mysqli_fetch_assoc($hasil)) {
    $id = $data['ID'];
    $noPengirim = $data['SenderNumber'];
    $msg = strtoupper($data['TextDecoded']);

    $pecah = explode("#", $msg);

    if ($pecah[0] == "NILAI" && count($pecah) == 6) {
        $nis = $pecah[1];
        $mp = $pecah[2];
        $semester = $pecah[3];
        $tahun = $pecah[4];
        $jenis = $pecah[5];

        $query2 = "
            SELECT nilai.nilai_poin, siswa.siswa_nama, pelajaran.pelajaran_nama, 
                   jenis.jenis_nama, semester.semester_nama 
            FROM nilai 
            JOIN siswa ON nilai.siswa_id = siswa.siswa_id 
            JOIN pelajaran ON nilai.pelajaran_id = pelajaran.pelajaran_id 
            JOIN jenis ON nilai.jenis_id = jenis.jenis_id 
            JOIN semester ON nilai.semester_id = semester.semester_id 
            JOIN tahun ON nilai.tahun_id = tahun.tahun_id 
            WHERE siswa.siswa_nis = '$nis' 
              AND pelajaran.pelajaran_nama = '$mp' 
              AND semester.semester_nama = '$semester' 
              AND tahun.tahun_nama = '$tahun' 
              AND jenis.jenis_nama = '$jenis'
        ";

        $hasil2 = mysqli_query($koneksi, $query2);

        if (mysqli_num_rows($hasil2) == 0) {
            $reply = "Data Tidak Ditemukan";
        } else {
            $data2 = mysqli_fetch_assoc($hasil2);
            $reply = "Nama : {$data2['siswa_nama']} | {$data2['pelajaran_nama']} | Semester : {$data2['semester_nama']} | {$data2['jenis_nama']} | Poin : {$data2['nilai_poin']}";
        }

    } elseif ($pecah[0] == "NILAIFULL" && count($pecah) == 5) {
        $nis = $pecah[1];
        $semester = $pecah[2];
        $tahun = $pecah[3];
        $jenis = $pecah[4];

        $query2 = "
            SELECT siswa.siswa_nama, 
                   GROUP_CONCAT(CONCAT_WS('-', pelajaran.pelajaran_nama, nilai.nilai_poin) SEPARATOR ' | ') AS nilai 
            FROM nilai 
            JOIN siswa ON nilai.siswa_id = siswa.siswa_id 
            JOIN pelajaran ON nilai.pelajaran_id = pelajaran.pelajaran_id 
            JOIN jenis ON nilai.jenis_id = jenis.jenis_id 
            JOIN semester ON nilai.semester_id = semester.semester_id 
            JOIN tahun ON nilai.tahun_id = tahun.tahun_id 
            WHERE siswa.siswa_nis = '$nis' 
              AND semester.semester_nama = '$semester' 
              AND tahun.tahun_nama = '$tahun' 
              AND jenis.jenis_nama = '$jenis'
        ";

        $hasil2 = mysqli_query($koneksi, $query2);

        if (mysqli_num_rows($hasil2) == 0) {
            $reply = "Data Tidak Ditemukan";
        } else {
            $data2 = mysqli_fetch_assoc($hasil2);
            $reply = "Nama : {$data2['siswa_nama']} | {$data2['nilai']}";
        }

    } else {
        $reply = "Maaf Perintah Salah";
    }

    // Kirim balasan
    mysqli_query($koneksi, "INSERT INTO outbox (DestinationNumber, TextDecoded) VALUES ('$noPengirim', '$reply')");

    // Tandai pesan sudah diproses
    mysqli_query($koneksi, "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'");
}
?>
