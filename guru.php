<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada dan menggunakan $conn
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="spacer-bottom-sm">Manajemen Guru</h3>
        <a href="?user=Guru&create=Guru" class="btn btn-primary mb-2">
            <span class="fa fa-plus"></span> Tambah Guru
        </a>
        <hr/>

        <?php 
        if (isset($_GET['create']) && $_GET['create'] === 'Guru') {
            include('form/create_guru.php');
            require_once('core/create.php');

        } elseif (isset($_GET['edit-guru'])) {
            include('form/edit_guru.php');

        } elseif (isset($_GET['del-guru'])) {
            include('core/delete.php');
        }
        ?>

        <div class="block-flat no-padding">
            <div class="content">
                <table class="no-border blue table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mapel</th>
                            <th style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM guru ORDER BY guru_nama ASC");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['guru_nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['guru_nip']); ?></td>
                            <td><?php echo htmlspecialchars($data['guru_mapel']); ?></td>
                            <td class="text-center">
                                <a href="?user=Guru&edit-guru=<?php echo $data['guru_id']; ?>" class="btn btn-warning btn-sm">
                                    <span class="fa fa-edit"></span> Edit
                                </a>
                                <a href="?user=Guru&del-guru=<?php echo $data['guru_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus guru ini?')">
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
