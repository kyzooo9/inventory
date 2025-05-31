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
            <h1 class="m-0">Peminjaman SMK ABC Surabaya</h1>
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
                                <th>Kode Peminjaman</th>
                                <th>Nama Guru</th>
                                <th>Username</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Kembali</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                      <tbody>
                      <?php
                        $query = "SELECT pm.*, pj.USERNAME_PEMINJAM, g.NAMA_GURU, d.DENDA FROM peminjaman pm JOIN peminjam pj ON pm.ID_PEMINJAM = pj.ID_PEMINJAM JOIN guru g ON pm.ID_GURU = g.ID_GURU JOIN denda d ON pm.ID_DENDA = d.ID_DENDA;";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?= htmlspecialchars($row['KODE_PEMINJAMAN']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_GURU']); ?></td>
                                  <td><?= htmlspecialchars($row['USERNAME_PEMINJAM']); ?></td>
                                  <td><?= htmlspecialchars($row['TANGGAL_PEMINJAMAN']); ?></td>
                                  <td><?= htmlspecialchars($row['TANGGAL_KEMBALI']); ?></td>
                                  <td><?= htmlspecialchars($row['TANGGAL_PENGEMBALIAN']); ?></td>
                                  <td><?= htmlspecialchars($row['DENDA']); ?></td>
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
                                            <form action="edit_peminjaman.php" method="post" >
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_peminjaman" class="form-control" value="<?= $row['ID_PEMINJAMAN'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_peminjaman">Kode [eminjaman</label>
                                                        <input type="text" class="form-control" name="kode_peminjaman" id="kode_peminjaman" value="<?= $row['KODE_PEMINJAMAN'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_guru">Nama Guru</label>
                                                        <select class="form-control" id="nama_guru" name="nama_guru" required>
                                                            <option value="" disabled>-- Pilih Nama Guru --</option>
                                                            <?php
                                                            $query_username = "SELECT ID_GURU, NAMA_GURU FROM guru";
                                                            $result_username = mysqli_query($koneksi, $query_username);
                                                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                                                $selected = ($row_username['ID_GURU'] == $row['ID_GURU']) ? 'selected' : '';
                                                                echo '<option value="' . $row_username['ID_GURU'] . '" ' . $selected . '>' . htmlspecialchars($row_username['NAMA_GURU']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
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
                                                        <label for="nama_kelas_siswa">Nama Kelas Siswa</label>
                                                        <select class="form-control" id="nama_kelas_siswa" name="nama_kelas_siswa" required>
                                                            <option value="" disabled>-- Pilih Nama Kelas Siswa --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_KELAS_SISWA, NAMA_KELAS_SISWA FROM kelas_siswa";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_KELAS_SISWA'] == $row['ID_KELAS_SISWA']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_KELAS_SISWA'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_KELAS_SISWA']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                                        <input type="date" class="form-control" id="tanggal_peminjaman_edit" name="tanggal_peminjaman" value="<?= $row['TANGGAL_PEMINJAMAN'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_kembali">Tanggal Kembali</label>
                                                        <input type="date" class="form-control" id="tanggal_kembali_edit" name="tanggal_kembali" value="<?= $row['TANGGAL_KEMBALI'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?= $row['TANGGAL_PENGEMBALIAN'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="denda">DENDA</label>
                                                        <select class="form-control" id="denda" name="denda" required>
                                                            <option value="" disabled>-- Pilih Denda --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_DENDA, DENDA FROM denda";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_DENDA'] == $row['ID_DENDA']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_DENDA'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['DENDA']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
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
                                              <form id="formHapus" action="hapus_peminjaman.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Peminjaman</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_peminjaman" name="id_peminjaman" value="<?= $row['ID_PEMINJAMAN'] ?>">
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
            <form id="formTambah" action="tambah_peminjaman.php" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="modal-body">
                <?php
								
                    $result = mysqli_query($koneksi, "SELECT kode_peminjaman FROM peminjaman ORDER BY id_peminjaman DESC LIMIT 1");
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                      $lastCode = $row['kode_peminjaman'];
                      $number = (int) substr($lastCode, -3);
                      $newNumber = $number + 1;

                      $newCode = 'PJ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                    } else {
                      $newCode = 'PJ001';
                    }
                    ?>
                    <div class="form-group">
                          <label for="kode_peminjaman">Kode Peminjaman</label>
                          <input type="text" class="form-control" name="kode_peminjaman" id="kode_peminjaman" value="<?php echo $newCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <select class="form-control" id="nama_guru" name="nama_guru" required>
                            <option value="" disabled selected>-- Pilih Username --</option>
                            <?php
                            $query_username = "SELECT ID_GURU, NAMA_GURU FROM guru";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_GURU'] . '">' . htmlspecialchars($row_username['NAMA_GURU']) . '</option>';
                            }
                            ?>
                        </select>
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
                        <div class="form-group">
                            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" readonly>
                        </div> 
                        <script>
                            document.getElementById('tanggal_peminjaman').addEventListener('change', function () {
                                // Ambil tanggal peminjaman
                                const tanggalPeminjaman = new Date(this.value);

                                // Tambahkan 1 hari ke tanggal peminjaman
                                const tanggalKembali = new Date(tanggalPeminjaman);
                                tanggalKembali.setDate(tanggalKembali.getDate() + 1);

                                // Format tanggal kembali ke yyyy-mm-dd
                                const year = tanggalKembali.getFullYear();
                                const month = String(tanggalKembali.getMonth() + 1).padStart(2, '0');
                                const day = String(tanggalKembali.getDate()).padStart(2, '0');
                                const formattedDate = `${year}-${month}-${day}`;

                                // Set nilai pada input tanggal kembali
                                document.getElementById('tanggal_kembali').value = formattedDate;
                            });
                        </script>

                    <div class="form-group">
                        <label for="denda">Denda</label>
                        <select class="form-control" id="denda" name="denda" required>
                            <option value="" disabled selected>-- Pilih Denda --</option>
                            <?php
                            $query_kelas_siswa = "SELECT ID_DENDA, DENDA FROM denda";
                            $result_kelas_siswa = mysqli_query($koneksi, $query_kelas_siswa);
                            while ($row_kelas_siswa = mysqli_fetch_assoc($result_kelas_siswa)) {
                                echo '<option value="' . $row_kelas_siswa['ID_DENDA'] . '">' . htmlspecialchars($row_kelas_siswa['DENDA']) . '</option>';
                            }
                            ?>
                        </select>
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