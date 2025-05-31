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
            <h1 class="m-0">Kelas Siswa SMK ABC SURABAYA</h1>
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
                        <th>Kode Kelas Siswa</th>
                        <th>Nama Kelas</th>
                        <th>Jurusan</th>
                        <th>Kelas Siswa</th>
                        <th>Ruang Kelas</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $query = "SELECT ks.*, k.NAMA_KELAS, j.NAMA_JURUSAN, j.INISIAL FROM kelas_siswa ks JOIN jurusan j ON ks.ID_JURUSAN = j.ID_JURUSAN JOIN kelas k ON ks.ID_KELAS = k.ID_KELAS;";
            

                      $result = mysqli_query($koneksi, $query);
                      $no = 1;

                      while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                              <td><?= $no++; ?></td>
                              <td><?= htmlspecialchars($row['KODE_KELAS_SISWA']); ?></td>
                              <td><?= htmlspecialchars($row['NAMA_KELAS']); ?></td>
                              <td><?= htmlspecialchars($row['INISIAL']); ?></td>
                              <td><?= htmlspecialchars($row['NAMA_KELAS_SISWA']); ?></td>
                              <td><?= htmlspecialchars($row['RUANGAN']); ?></td>
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
                                          <h5 class="modal-title" id="modalEditLabel">Edit Kelas Siswa</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="edit_kelas_siswa.php" method="post">
                                                    <input type="text" name="id_kelas_siswa" class="form-control" id="id_kelas_siswa" value="<?php echo $row['ID_KELAS_SISWA'] ?>" hidden>
                                                    <div class="form-group">
                                                      <label>Kode Kelas Siswa</label>
                                                      <input type="text" name="kode_kelas_siswa" class="form-control" id="kode_kelas_siswa" value="<?php echo $row['KODE_KELAS_SISWA'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="id_kelas">Nama Kelas</label>
                                                      <select name="id_kelas" class="form-control" id="id_kelas" required>
                                                        <?php
                                                        $kelasQuery = "SELECT ID_KELAS, NAMA_KELAS FROM kelas";
                                                        $kelasResult = mysqli_query($koneksi, $kelasQuery);

                                                        while ($kelas = mysqli_fetch_assoc($kelasResult)) {
                                                          $selected = $kelas['ID_KELAS'] == $row['ID_KELAS'] ? 'selected' : '';
                                                          echo "<option value='{$kelas['ID_KELAS']}' $selected>{$kelas['NAMA_KELAS']}</option>";
                                                        }
                                                        ?>
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="id_jurusan">Nama Jurusan</label>
                                                      <select name="id_jurusan" class="form-control" id="id_jurusan" required>
                                                        <?php
                                                        $jurusanQuery = "SELECT ID_JURUSAN, NAMA_JURUSAN FROM jurusan";
                                                        $jurusanResult = mysqli_query($koneksi, $jurusanQuery);

                                                        while ($jurusan = mysqli_fetch_assoc($jurusanResult)) {
                                                          $selected = $jurusan['ID_JURUSAN'] == $row['ID_JURUSAN'] ? 'selected' : '';
                                                          echo "<option value='{$jurusan['ID_JURUSAN']}' $selected>{$jurusan['NAMA_JURUSAN']}</option>";
                                                        }
                                                        ?>
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>Kelas Siswa</label>
                                                      <select class="form-control" id="nama_kelas_siswa" name="nama_kelas_siswa" required>
                                                              <option value="" disabled selected>-- Pilih Status Pemesanan --</option>
                                                              <option value="1" <?= ($row['NAMA_KELAS_SISWA'] == '1') ? 'selected' : ''; ?>>1</option>
                                                              <option value="2" <?= ($row['NAMA_KELAS_SISWA'] == '2') ? 'selected' : ''; ?>>2</option>
                                                              <option value="3" <?= ($row['NAMA_KELAS_SISWA'] == '3') ? 'selected' : ''; ?>>3</option>
                                                              <option value="4" <?= ($row['NAMA_KELAS_SISWA'] == '4') ? 'selected' : ''; ?>>4</option>
                                                              <option value="5" <?= ($row['NAMA_KELAS_SISWA'] == '5') ? 'selected' : ''; ?>>5</option>
                                                              <option value="6" <?= ($row['NAMA_KELAS_SISWA'] == '6') ? 'selected' : ''; ?>>6</option>
                                                              <option value="7" <?= ($row['NAMA_KELAS_SISWA'] == '7') ? 'selected' : ''; ?>>7</option>
                                                              <option value="8" <?= ($row['NAMA_KELAS_SISWA'] == '8') ? 'selected' : ''; ?>>8</option>
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>Ruang Kelas</label>
                                                      <input type="text" name="ruangan" class="form-control" id="ruangan" value="<?php echo $row['RUANGAN'] ?>">
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
                                              <form id="formHapus" action="hapus_kelas_siswa.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Kelas Siswa</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_kelas_siswa" name="id_kelas_siswa" value="<?= $row['ID_KELAS_SISWA'] ?>">
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
            <form id="formTambah" action="tambah_kelas_siswa.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Nama Kelas Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
								
								$result = mysqli_query($koneksi, "SELECT kode_kelas_siswa FROM kelas_siswa ORDER BY id_kelas_siswa DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_kelas_siswa'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'KLSW' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'KLSW001';
								}
								?>
                    <div class="form-group">
											<label for="kode_kelas_siswa">Kode</label>
											<input type="text" class="form-control" name="kode_kelas_siswa" id="kode_kelas_siswa" value="<?php echo $newCode; ?>" readonly>
										</div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <select class="form-control" id="nama_kelas" name="nama_kelas" required>
                            <option value="" disabled selected>-- Pilih Nama Kelas --</option>
                            <?php
                            $query_kelas = "SELECT ID_KELAS, NAMA_KELAS FROM kelas";
                            $result_kelas = mysqli_query($koneksi, $query_kelas);
                            while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                echo '<option value="' . $row_kelas['ID_KELAS'] . '">' . htmlspecialchars($row_kelas['NAMA_KELAS']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <select class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                            <option value="" disabled selected>-- Pilih Nama Jurusan --</option>
                            <?php
                            $query_jurusan = "SELECT ID_JURUSAN, NAMA_JURUSAN FROM jurusan";
                            $result_jurusan = mysqli_query($koneksi, $query_jurusan);
                            while ($row_jurusan = mysqli_fetch_assoc($result_jurusan)) {
                                echo '<option value="' . $row_jurusan['ID_JURUSAN'] . '">' . htmlspecialchars($row_jurusan['NAMA_JURUSAN']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas_siswa">Kelas Siswa</label>
                        <select class="form-control" id="nama_kelas_siswa" name="nama_kelas_siswa" required>
                          <option value="" disabled selected>-- Pilih Kelas Siswa --</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ruangan">Ruang Kelas</label>
                        <input type="text" class="form-control" id="ruangan" name="ruangan" required>
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>  
</body>
</html>