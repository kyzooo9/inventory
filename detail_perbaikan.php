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
            <h1 class="m-0">Transaksi Perbaikan SMK ABC Surabaya</h1>
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
                              <th>Kode Transaksi Perbaikan</th>
                              <th>Kode Perbaikan</th>
                              <th>Nama Peralatan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT dp.*, pb.KODE_PERBAIKAN, pr.NAMA_PERALATAN FROM detail_perbaikan dp JOIN perbaikan pb ON dp.ID_PERBAIKAN = pb.ID_PERBAIKAN JOIN peralatan pr ON dp.ID_PERALATAN = pr.ID_PERALATAN;";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?= htmlspecialchars($row['KODE_DETAIL_PERBAIKAN']); ?></td>
                                  <td><?= htmlspecialchars($row['KODE_PERBAIKAN']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_PERALATAN']); ?></td>
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
                                                <h5 class="modal-title" id="modalEditLabel">Edit Transaksi Perbaikan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="edit_detail_perbaikan.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kode_detail_perbaikan" class="form-control" value="<?= $row['KODE_DETAIL_PERBAIKAN'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_detail_perbaikan">Kode Petail Perbaikan</label>
                                                        <input type="text" class="form-control" name="kode_detail_perbaikan" id="kode_detail_perbaikan" value="<?= $row['KODE_DETAIL_PERBAIKAN'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kode_perbaikan">Kode Perbaikan</label>
                                                        <select class="form-control" id="kode_perbaikan" name="kode_perbaikan" required>
                                                            <option value="" disabled>-- Pilih Kode Perbaikan --</option>
                                                            <?php
                                                            $query_username = "SELECT ID_PERBAIKAN, KODE_PERBAIKAN FROM perbaikan";
                                                            $result_username = mysqli_query($koneksi, $query_username);
                                                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                                                $selected = ($row_username['ID_PERBAIKAN'] == $row['ID_PERBAIKAN']) ? 'selected' : '';
                                                                echo '<option value="' . $row_username['ID_PERBAIKAN'] . '" ' . $selected . '>' . htmlspecialchars($row_username['KODE_PERBAIKAN']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="nama_peralatan">Nama Peralatan</label>
                                                        <select class="form-control" id="nama_peralatan" name="nama_peralatan" required>
                                                            <option value="" disabled>-- Pilih Nama Peralatan --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_PERALATAN, NAMA_PERALATAN FROM peralatan";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_PERALATAN'] == $row['ID_PERALATAN']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_PERALATAN'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_PERALATAN']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
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
                                <div class="modal fade" id="modalHapus<?= $no ?>" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <form id="formHapus" action="hapus_detail_perbaikan.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Detail Perbaikan</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="kode_detail_perbaikan" name="kode_detail_perbaikan" value="<?= $row['KODE_DETAIL_PERBAIKAN'] ?>">
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
            <form id="formTambah" action="tambah_detail_perbaikan.php" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Transaksi Perbaikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
								
                                $result = mysqli_query($koneksi, "SELECT kode_detail_perbaikan FROM detail_perbaikan ORDER BY kode_detail_perbaikan DESC LIMIT 1");
                                $row = mysqli_fetch_assoc($result);
            
                                if ($row) {
                                  $lastCode = $row['kode_detail_perbaikan'];
                                  $number = (int) substr($lastCode, -3);
                                  $newNumber = $number + 1;
        
                                  $newCode = 'DPB' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                                } else {
                                  $newCode = 'DPB001';
                                }
                                ?>
                    <div class="form-group">
                        <label for="kode_detail_perbaikan">Kode Detail Perbaikan</label>
                        <input type="text" class="form-control" name="kode_detail_perbaikan" id="kode_detail_perbaikan" value="<?php echo $newCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kode_perbaikan">Kode Perbaikan</label>
                        <select class="form-control" id="kode_perbaikan" name="kode_perbaikan" required>
                            <option value="" disabled selected>-- Pilih Kode Perbaikan --</option>
                            <?php
                            $query_username = "SELECT ID_PERBAIKAN, KODE_PERBAIKAN FROM perbaikan";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_PERBAIKAN'] . '">' . htmlspecialchars($row_username['KODE_PERBAIKAN']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_peralatan">Nama Peralatan</label>
                        <select class="form-control" id="nama_peralatan" name="nama_peralatan" required>
                            <option value="" disabled selected>-- Pilih Nama Peralatan --</option>
                            <?php
                            $query_peralatan = "SELECT ID_PERALATAN, NAMA_PERALATAN FROM peralatan WHERE STATUS_PERALATAN = 'Rusak'";
                            $result_peralatan = mysqli_query($koneksi, $query_peralatan);
                            while ($row_peralatan = mysqli_fetch_assoc($result_peralatan)) {
                                echo '<option value="' . $row_peralatan['ID_PERALATAN'] . '">' . htmlspecialchars($row_peralatan['NAMA_PERALATAN']) . '</option>';
                            }
                            ?>
                        </select>
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>  
</body>
</html>