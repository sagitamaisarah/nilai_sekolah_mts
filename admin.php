<?php
include '../koneksi.php'; // sesuaikan path jika file ini di subfolder

?>

<div class="row">
    <div class="col-md-12">
        <h3 class="spacer-bottom-sm">Manajemen Admin</h3>
        <a href="?user=Admin&create=Admin" class="btn btn-primary">
            <span class="fa fa-plus"></span> Tambah Admin
        </a>
        <hr/>

        <?php 
        if (isset($_GET['create']) && $_GET['create'] === 'Admin') {
            include('form/create_admin.php');
            require_once('core/create.php');

        } elseif (isset($_GET['edit-admin'])) {
            include('form/edit_admin.php');

        } elseif (isset($_GET['del-admin'])) {
            include('core/delete.php');
        }
        ?>

        <div class="block-flat no-padding">
            <div class="content">
                <table class="no-border blue table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM user WHERE level = 'admin' ORDER BY nama ASC");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td class="text-center">
                                <a href="?user=Admin&edit-admin=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">
                                    <span class="fa fa-edit"></span> Edit
                                </a>
                                <a href="?user=Admin&del-admin=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus admin ini?')">
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
