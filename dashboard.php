<?php 
session_start();
require_once('layout/header.php');
?>

<div class="container-fluid mt-4" id="pcont">
	<div class="page-head mb-3">
		<h2>Welcome MTS SIRAJUL HUDA PAOK DANDAK</h2>
		<ol class="breadcrumb">
			<li><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
		</ol>
	</div>

	<!-- Navigation Panel -->
	<div class="mb-4">
		<a href="dashboard.php?user=admin" class="btn btn-primary">Admin</a>
		<a href="dashboard.php?user=guru" class="btn btn-secondary">Guru</a>
		<a href="dashboard.php?user=siswa" class="btn btn-success">Siswa</a>
		<a href="dashboard.php?akademik=pelajaran" class="btn btn-info">Pelajaran</a>
		<a href="dashboard.php?akademik=kelas" class="btn btn-warning">Kelas</a>
		<a href="dashboard.php?akademik=tahun" class="btn btn-dark">Tahun Ajaran</a>
		<a href="dashboard.php?nilai=Raport" class="btn btn-danger">Raport</a>
		<a href="dashboard.php?cetak=laporan-nilai-siswa" class="btn btn-outline-primary">Cetak Siswa</a>
	</div>

	<!-- ====================== Content Area ======================= -->
	<div class="card">
		<div class="card-body">
			<?php
			// ============== MENU USER ===============
			if (isset($_GET['user'])) {
				$user = $_GET['user'];
				switch ($user) {
					case 'admin':
						include('tabel/tabel_admin.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Admin') {
							include('form/create_admin.php');
						} elseif (isset($_GET['edit-admin'])) {
							include('form/edit_admin.php');
						} elseif (isset($_GET['del-admin'])) {
							include('core/delete.php');
						}
						break;

					case 'guru':
						include('tabel/tabel_guru.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Guru') {
							include('form/create_guru.php');
						} elseif (isset($_GET['edit-guru'])) {
							include('form/edit_guru.php');
						} elseif (isset($_GET['del-guru'])) {
							include('core/delete.php');
						}
						break;

					case 'siswa':
						include('tabel/tabel_siswa.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Siswa') {
							include('form/create_siswa.php');
						} elseif (isset($_GET['edit-siswa'])) {
							include('form/edit_siswa.php');
						} elseif (isset($_GET['del-siswa'])) {
							include('core/delete.php');
						}
						break;

					default:
						echo "<div class='alert alert-warning'>Halaman user tidak dikenali.</div>";
				}
			}
			// ============== MENU AKADEMIK ===============
			elseif (isset($_GET['akademik'])) {
				$akademik = $_GET['akademik'];
				switch ($akademik) {
					case 'pelajaran':
						include('tabel/tabel_pelajaran.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Pelajaran') {
							include('form/create_pelajaran.php');
						} elseif (isset($_GET['edit-pelajaran'])) {
							include('form/edit_pelajaran.php');
						} elseif (isset($_GET['del-pelajaran'])) {
							include('core/delete.php');
						}
						break;

					case 'kelas':
						include('tabel/tabel_kelas.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Kelas') {
							include('form/create_kelas.php');
						} elseif (isset($_GET['edit-kelas'])) {
							include('form/edit_kelas.php');
						} elseif (isset($_GET['del-kelas'])) {
							include('core/delete.php');
						}
						break;

					case 'tahun':
						include('tabel/tabel_tahun.php');
						if (isset($_GET['create']) && $_GET['create'] === 'Tahun') {
							include('form/create_tahun.php');
						} elseif (isset($_GET['edit-tahun'])) {
							include('form/edit_tahun.php');
						} elseif (isset($_GET['del-tahun'])) {
							include('core/delete.php');
						}
						break;

					default:
						echo "<div class='alert alert-warning'>Halaman akademik tidak dikenali.</div>";
				}
			}
			// ============== MENU NILAI ===============
			elseif (isset($_GET['nilai'])) {
				$nilai = $_GET['nilai'];
				switch ($nilai) {
					case 'Ulangan1': include('tabel/tabel_ulangan1.php'); break;
					case 'Ulangan2': include('tabel/tabel_ulangan2.php'); break;
					case 'Ulangan3': include('tabel/tabel_ulangan3.php'); break;
					case 'UTS':      include('tabel/tabel_uts.php'); break;
					case 'UAS':      include('tabel/tabel_uas.php'); break;
					case 'Raport':   include('tabel/tabel_raport.php'); break;
					case 'Kirim':    include('form/kirim_raport.php'); break;
					default:
						echo "<div class='alert alert-warning'>Halaman nilai tidak dikenali.</div>";
				}
			}
			// ============== MENU CETAK ===============
			elseif (isset($_GET['cetak'])) {
				$cetak = $_GET['cetak'];
				switch ($cetak) {
					case 'laporan-nilai-siswa':
						include('laporan/laporan-siswa.php'); break;
					case 'laporan-nilai-kelas':
						include('laporan/laporan-kelas.php'); break;
					default:
						echo "<div class='alert alert-warning'>Halaman cetak tidak dikenali.</div>";
				}
			}
			// ============== DEFAULT (SAAT GET KOSONG) ===============
			else {
				echo "<div class='alert alert-info'>Selamat datang di <strong>Sistem Informasi Nilai Siswa</strong>. Silakan pilih menu di atas.</div>";
			}
			?>
		</div>
	</div>
</div>

<?php 
require_once('layout/footer.php'); 
?>
