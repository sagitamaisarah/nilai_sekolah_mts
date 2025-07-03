<?php
include 'koneksi.php'; // Pastikan koneksi database disiapkan ($conn)
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="spacer-bottom-sm">Manajemen Siswa</h3>
        <a href="?user=Siswa&create=Siswa" class="btn btn-primary mb-2">
            <span class="fa fa-plus"></span> Tambah Siswa
        </a>
        <hr/>

        <?php 
        if (isset($_GET['create']) && $_GET['create'] === 'Siswa') {
            include('form/create_siswa.php');
            require_once('core/create.php');

        } elseif (isset($_GET['edit-siswa'])) {
            include('form/edit_siswa.php');

        } elseif (isset($_GET['del-siswa'])) {
            include('core/delete.php');
        }
        ?>

        <div class="block-flat no-padding">
            <div class="content">
                <table class="no-border blue table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Tempat / Tanggal Lahir</th>
                            <th>Telepon</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th style="width: 15%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT s.*, k.kelas_nama 
                                                      FROM siswa s
                                                      INNER JOIN kelas k ON s.kelas_id = k.kelas_id
                                                      ORDER BY siswa_nama ASC");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_nis']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_ttl']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_telp']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_gender']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_status']); ?></td>
                            <td><?php echo htmlspecialchars($data['siswa_alamat']); ?></td>
                            <td><?php echo htmlspecialchars($data['kelas_nama']); ?></td>
                            <td class="text-center">
                                <a href="?user=Siswa&edit-siswa=<?php echo $data['siswa_id']; ?>" class="btn btn-warning btn-sm">
                                    <span class="fa fa-edit"></span> Edit
                                </a>
                                <a href="?user=Siswa&del-siswa=<?php echo $data['siswa_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">
                                    <span class="fa fa-trash-o"></span> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
