<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory | SMk ABC</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/smkabc.jpg" alt="AdminLTELogo" height="100" width="100">
  </div>

  <!-- Navbar & Sidebar start -->
  <?php
	include 'koneksi.php';
    include 'header.php';
    include 'sidebar.php';
  ?>
   <!-- Navbar & Sidebar end -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Siswa SMK ABC Surabaya</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <?php

      if (isset($_GET['status'])) {
        $status = $_GET['status'];
          if ($status === 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data denda peminjam berhasil ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'edit_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data denda peminjaman berhasil diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'delete_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data denda peminjaman berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'edit_error') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat mengedit data denda peminjaman!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'delete_error') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat menghapus data denda peminjaman!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
      }
      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
              </div>

              <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode Siswa</th>
                              <th>NIS</th>
                              <th>Nama Siswa</th>
                              <th>Username</th>
                              <th>Kelas Siswa</th>
                              <th>Alamat</th>
                              <th>Angkatan</th>
                              <th>Keterangan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT s.*, pj.USERNAME_PEMINJAM, ks.GABUNGAN FROM siswa s LEFT JOIN peminjam pj ON s.ID_PEMINJAM = pj.ID_PEMINJAM LEFT JOIN kelas_siswa ks ON s.ID_KELAS_SISWA = ks.ID_KELAS_SISWA;";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?= htmlspecialchars($row['KODE_SISWA']); ?></td>
                                  <td><?= htmlspecialchars($row['NIS']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_SISWA']); ?></td>
                                  <td><?= htmlspecialchars($row['USERNAME_PEMINJAM']); ?></td>
                                  <td><?= htmlspecialchars($row['GABUNGAN']); ?></td>
                                  <td><?= htmlspecialchars($row['ALAMAT_SISWA']); ?></td>
                                  <td><?= htmlspecialchars($row['ANGKATAN_SISWA']); ?></td>
                                  <td><?= htmlspecialchars($row['KETERANGAN_SISWA']); ?></td>
                                  <td>
                                      <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#modalEdit<?= $no ?>">
                                            <i class="fa fa-edit"></i> Edit
                                      </button>

                                      <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modalHapus<?= $no ?>">
                                            <i class="fa fa-trash"></i> Hapus
                                      </button>
                                  </td>

                                  <!-- Modal Edit -->
                                  <div class="modal fade" id="modalEdit<?= $no ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel">Edit Data Guru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="edit_siswa.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_siswa" class="form-control" value="<?= $row['ID_SISWA'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_siswa">Kode Siswa</label>
                                                        <input type="text" class="form-control" name="kode_siswa" id="kode_siswa" value="<?= $row['KODE_SISWA'] ?>" readonly>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="nis">NIS</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="nis" name="nis" value="<?= $row['NIS'] ?>" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="nama_siswa">Nama Siswa</label>
                                                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $row['NAMA_SISWA'] ?>" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="username_peminjam">Username</label>
                                                        <select class="form-control" id="username_peminjam" name="username_peminjam" required>
                                                            <option value="" disabled>-- Pilih Username --</option>
                                                            <?php
                                                            $query_username = "SELECT ID_PEMINJAM, USERNAME_PEMINJAM FROM peminjam";
                                                            $result_username = mysqli_query($koneksi, $query_username);
                                                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                                                $selected = ($row_username['ID_PEMINJAM'] == $row['ID_PEMINJAM']) ? 'selected' : '';
                                                                echo '<option value="' . $row_username['ID_PEMINJAM'] . '" ' . $selected . '>' . htmlspecialchars($row_username['USERNAME_PEMINJAM']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="gabungan">Nama Kelas Siswa</label>
                                                        <select class="form-control" id="gabungan" name="gabungan" required>
                                                            <option value="" disabled>-- Pilih Nama Kelas Siswa --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_KELAS_SISWA, GABUNGAN FROM kelas_siswa";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_KELAS_SISWA'] == $row['ID_KELAS_SISWA']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_KELAS_SISWA'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['GABUNGAN']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="alamat_siswa">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" value="<?= $row['ALAMAT_SISWA'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="angkatan_siswa">Angkatan Siswa</label>
                                                          <select class="form-control" id="angkatan_siswa" name="angkatan_siswa" required>
                                                              <option value="" disabled selected>-- Pilih Angkatan Siswa --</option>
                                                              <option value="2019" <?= ($row['ANGKATAN_SISWA'] == '2019') ? 'selected' : ''; ?>>2019</option>
                                                              <option value="2020" <?= ($row['ANGKATAN_SISWA'] == '2020') ? 'selected' : ''; ?>>2020</option>
                                                              <option value="2021" <?= ($row['ANGKATAN_SISWA'] == '2021') ? 'selected' : ''; ?>>2021</option>
                                                              <option value="2022" <?= ($row['ANGKATAN_SISWA'] == '2022') ? 'selected' : ''; ?>>2022</option>
                                                              <option value="2023" <?= ($row['ANGKATAN_SISWA'] == '2023') ? 'selected' : ''; ?>>2023</option>
                                                              <option value="2024" <?= ($row['ANGKATAN_SISWA'] == '2024') ? 'selected' : ''; ?>>2024</option>
                                                          </select>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="keterangan_siswa">Keterangan</label>
                                                        <input type="text" class="form-control" id="keterangan_siswa" name="keterangan_siswa" value="<?= $row['KETERANGAN_SISWA'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalHapus<?= $no ?>" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <form id="formHapus" action="hapus_siswa.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Siswa</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_siswa" name="id_siswa" value="<?= $row['ID_SISWA'] ?>">
                                                      <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-danger">Hapus</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </tr>
                              <?php
                          }
                          ?>
                      </tbody>
                  </table>
              </div>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formTambah" action="tambah_siswa.php" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="modal-body">
                <?php
								
                    $result = mysqli_query($koneksi, "SELECT kode_siswa FROM siswa ORDER BY id_siswa DESC LIMIT 1");
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                      $lastCode = $row['kode_siswa'];
                      $number = (int) substr($lastCode, -3);
                      $newNumber = $number + 1;

                      $newCode = 'SW' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                    } else {
                      $newCode = 'SW001';
                    }
                    ?>
                    <div class="form-group">
                          <label for="kode_siswa">Kode Siswa</label>
                          <input type="text" class="form-control" name="kode_siswa" id="kode_siswa" value="<?php echo $newCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="siswa">NIS</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="username_peminjam">Username</label>
                        <select class="form-control" id="username_peminjam" name="username_peminjam" required>
                            <option value="" disabled selected>-- Pilih Username --</option>
                            <?php
                            $query_username = "SELECT ID_PEMINJAM, USERNAME_PEMINJAM FROM peminjam";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_PEMINJAM'] . '">' . htmlspecialchars($row_username['USERNAME_PEMINJAM']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gabungan">Nama Kelas Siswa</label>
                        <select class="form-control" id="gabungan" name="gabungan" required>
                            <option value="" disabled selected>-- Pilih Nama Kelas Siswa --</option>
                            <?php
                            $query_kelas_siswa = "SELECT ID_KELAS_SISWA, GABUNGAN FROM kelas_siswa";
                            $result_kelas_siswa = mysqli_query($koneksi, $query_kelas_siswa);
                            while ($row_kelas_siswa = mysqli_fetch_assoc($result_kelas_siswa)) {
                                echo '<option value="' . $row_kelas_siswa['ID_KELAS_SISWA'] . '">' . htmlspecialchars($row_kelas_siswa['GABUNGAN']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat_siswa">Alamat</label>
                        <input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" required>
                    </div>
                    <div class="form-group">
                    <label for="angkatan_siswa">Angkatan Siswa</label>
                    <select class="form-control" id="angkatan_siswa1" name="angkatan_siswa" required>
                      <option value="" disabled selected>-- Pilih Angkatan Siswa --</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      
                    </select>
                  </div>
                    <div class="form-group">
                        <label for="keterangan_siswa">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_siswa" name="keterangan_siswa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
                  </div>


	<!-- footer start -->
	<?php
		include 'footer.php';
	?>
	<!-- footer end -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>  
</body>
</html>