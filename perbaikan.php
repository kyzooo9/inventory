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
  <title>Inventory | SMK ABC</title>

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

  <!-- Preloader -->
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
            <h1 class="m-0">Perbaikan Alat</h1>
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
                      Data kelas siswa berhasil ditambahkan!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          } elseif ($status === 'edit_success') {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Data kelas siswa berhasil diedit!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          } elseif ($status === 'delete_success') {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Data kelas siswa berhasil dihapus!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          } elseif ($status === 'edit_error') {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Terjadi kesalahan saat mengedit data kelas siswa!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          } elseif ($status === 'delete_error') {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Terjadi kesalahan saat menghapus data kelas siswa!
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
                        <th>Kode Perbaikan</th>
                        <th>Nama Guru</th>
                        <th>Tanggal Perbaikan</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $query = "SELECT pb.*, g.ID_GURU, g.NAMA_GURU FROM perbaikan pb JOIN guru g ON pb.ID_GURU = g.ID_GURU";
            

                      $result = mysqli_query($koneksi, $query);
                      $no = 1;

                      while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                              <td><?= $no++; ?></td>
                              <td><?= htmlspecialchars($row['KODE_PERBAIKAN']); ?></td>
                              <td><?= htmlspecialchars($row['NAMA_GURU']); ?></td>
                              <td><?= htmlspecialchars($row['TANGGAL_PERBAIKAN']); ?></td>
                                  <td>
                                      <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#modalEdit<?= $no ?>">
                                            <i class="fa fa-edit"></i> Edit
                                      </button>

                                      <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modalHapus<?= $no ?>">
                                            <i class="fa fa-trash"></i> Hapus
                                      </button>
                                  </td>

                                  <!-- Modal Edit -->
                                  <div class="modal fade" id="modalEdit<?= $no ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="modalEditLabel">Edit Perbaikan</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="edit_perbaikan.php" method="post">
                                                    <input type="text" name="id_perbaikan" class="form-control" id="id_perbaikan" value="<?php echo $row['ID_PERBAIKAN'] ?>" hidden>
                                                    <div class="form-group">
                                                      <label>Kode Perbaikan</label>
                                                      <input type="text" name="kode_perbaikan" class="form-control" id="kode_perbaikan" value="<?php echo $row['KODE_PERBAIKAN'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="id_guru">Nama Guru</label>
                                                      <select name="id_guru" class="form-control" id="id_guru" required>
                                                        <?php
                                                        $jurusanQuery = "SELECT ID_GURU, NAMA_GURU FROM guru";
                                                        $jurusanResult = mysqli_query($koneksi, $jurusanQuery);

                                                        while ($jurusan = mysqli_fetch_assoc($jurusanResult)) {
                                                          $selected = $jurusan['ID_GURU'] == $row['ID_GURU'] ? 'selected' : '';
                                                          echo "<option value='{$jurusan['ID_GURU']}' $selected>{$jurusan['NAMA_GURU']}</option>";
                                                        }
                                                        ?>
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_perbaikan">Tanggal Perbaikan</label>
                                                        <input type="date" class="form-control" id="tanggal_perbaikan" name="tanggal_perbaikan" value="<?= $row['TANGGAL_PERBAIKAN'] ?>" required>
                                                    </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- Modal Hapus Data -->
                                  <div class="modal fade" id="modalHapus<?= $no ?>" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <form id="formHapus" action="hapus_perbaikan.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Perbaikan</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_perbaikan" name="id_perbaikan" value="<?= $row['ID_PERBAIKAN'] ?>">
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
            <form id="formTambah" action="tambah_perbaikan.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Nama Kelas Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $result = mysqli_query($koneksi, "SELECT kode_perbaikan FROM perbaikan ORDER BY id_perbaikan DESC LIMIT 1");
                    $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $lastCode = $row['kode_perbaikan'];
                            $number = (int) substr($lastCode, -3);
                            $newNumber = $number + 1;
                            $newCode = 'PB' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                        } else {
                            $newCode = 'PB001';
                        }
                    ?>
                    <div class="form-group">
				        <label for="kode_perbaikan">Kode</label>
							<input type="text" class="form-control" name="kode_perbaikan" id="kode_perbaikan" value="<?php echo $newCode; ?>" readonly>
					</div>
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <select class="form-control" id="nama_guru" name="nama_guru" required>
                            <option value="" disabled selected>-- Pilih Nama Guru --</option>
                            <?php
                            $query_jurusan = "SELECT ID_GURU, NAMA_GURU FROM guru";
                            $result_jurusan = mysqli_query($koneksi, $query_jurusan);
                            while ($row_jurusan = mysqli_fetch_assoc($result_jurusan)) {
                                echo '<option value="' . $row_jurusan['ID_GURU'] . '">' . htmlspecialchars($row_jurusan['NAMA_GURU']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_perbaikan">Tanggal Perbaikan</label>
                        <input type="date" class="form-control" id="tanggal_perbaikan" name="tanggal_perbaikan" required>
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