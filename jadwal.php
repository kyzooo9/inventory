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
            <h1 class="m-0">Jadwal SMK ABC Surabaya</h1>
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
                              <th>Kode Jadwal</th>
                              <th>Kelas Siswa</th>
                              <th>Nama Guru</th>
                              <th>Hari</th>
                              <th>Pelajaran</th>
                              <th>Jam Masuk</th>
                              <th>Jam Keluar</th>
                              <th>Semester</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT j.*, ks.NAMA_KELAS_SISWA, g.NAMA_GURU, h.NAMA_HARI, p.NAMA_PELAJARAN FROM jadwal j JOIN kelas_siswa ks ON j.ID_KELAS_SISWA = ks.ID_KELAS_SISWA JOIN guru g ON j.ID_GURU = g.ID_GURU JOIN hari h ON j.ID_HARI = h.ID_HARI JOIN pelajaran p ON j.ID_PELAJARAN = p.ID_PELAJARAN ORDER BY j.ID_JADWAL ASC;";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?= htmlspecialchars($row['KODE_JADWAL']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_KELAS_SISWA']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_GURU']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_HARI']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_PELAJARAN']); ?></td>
                                  <td><?= htmlspecialchars($row['JAM_MASUK']); ?></td>
                                  <td><?= htmlspecialchars($row['JAM_KELUAR']); ?></td>
                                  <td><?= htmlspecialchars($row['SEMESTER']); ?></td>
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
                                                <h5 class="modal-title" id="modalEditLabel">Edit Data Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="edit_jadwal.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_jadwal" class="form-control" value="<?= $row['ID_JADWAL'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_jadwal">Kode Jadwal</label>
                                                        <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" value="<?= $row['KODE_JADWAL'] ?>" readonly>
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
                                                        <label for="nama_guru">Nama Guru</label>
                                                        <select class="form-control" id="nama_guru" name="nama_guru" required>
                                                            <option value="" disabled>-- Pilih Nama Guru --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_GURU, NAMA_GURU FROM guru";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_GURU'] == $row['ID_GURU']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_GURU'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_GURU']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_hari">Nama Hari</label>
                                                        <select class="form-control" id="nama_hari" name="nama_hari" required>
                                                            <option value="" disabled>-- Pilih Nama Hari --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_HARI, NAMA_HARI FROM hari";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_HARI'] == $row['ID_HARI']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_HARI'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_HARI']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pelajaran">Nama Pelajaran</label>
                                                        <select class="form-control" id="nama_pelajaran" name="nama_pelajaran" required>
                                                            <option value="" disabled>-- Pilih Nama Pelajaran --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_PELAJARAN, NAMA_PELAJARAN FROM pelajaran";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_PELAJARAN'] == $row['ID_PELAJARAN']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_PELAJARAN'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_PELAJARAN']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jam_masuk">Jam Masuk</label>
                                                        <div class="input-group">
                                                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= htmlspecialchars($row['JAM_MASUK']) ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jam_keluar">Jam Keluar</label>
                                                        <div class="input-group">
                                                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= htmlspecialchars($row['JAM_KELUAR']) ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="semester">Semester</label>
                                                          <select class="form-control" id="semester" name="semester" required>
                                                              <option value="" disabled selected>-- Pilih Semester --</option>
                                                              <option value="Genap" <?= ($row['SEMESTER'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                                                              <option value="Ganjil" <?= ($row['SEMESTER'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
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
                                              <form id="formHapus" action="hapus_jadwal.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Jadwal</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_jadwal" name="id_jadwal" value="<?= $row['ID_JADWAL'] ?>">
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
            <form id="formTambah" action="tambah_jadwal.php" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="modal-body">
                <?php
								
                    $result = mysqli_query($koneksi, "SELECT kode_jadwal FROM jadwal ORDER BY id_jadwal DESC LIMIT 1");
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                      $lastCode = $row['kode_jadwal'];
                      $number = (int) substr($lastCode, -3);
                      $newNumber = $number + 1;

                      $newCode = 'JDWL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                    } else {
                      $newCode = 'JDWL001';
                    }
                    ?>
                    <div class="form-group">
                          <label for="kode_jadwal">Kode Jadwal</label>
                          <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" value="<?php echo $newCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas_siswa">Nama Kelas Siswa</label>
                        <select class="form-control" id="nama_kelas_siswa" name="nama_kelas_siswa" required>
                            <option value="" disabled selected>-- Pilih Nama Kelas Siswa --</option>
                            <?php
                            $query_kelas_siswa = "SELECT ID_KELAS_SISWA, NAMA_KELAS_SISWA FROM kelas_siswa";
                            $result_kelas_siswa = mysqli_query($koneksi, $query_kelas_siswa);
                            while ($row_kelas_siswa = mysqli_fetch_assoc($result_kelas_siswa)) {
                                echo '<option value="' . $row_kelas_siswa['ID_KELAS_SISWA'] . '">' . htmlspecialchars($row_kelas_siswa['NAMA_KELAS_SISWA']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <select class="form-control" id="nama_guru" name="nama_guru" required>
                            <option value="" disabled selected>-- Pilih Nama Guru --</option>
                            <?php
                            $query_guru = "SELECT ID_GURU, NAMA_GURU FROM guru";
                            $result_guru = mysqli_query($koneksi, $query_guru);
                            while ($row_guru = mysqli_fetch_assoc($result_guru)) {
                                echo '<option value="' . $row_guru['ID_GURU'] . '">' . htmlspecialchars($row_guru['NAMA_GURU']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_hari">Nama Hari</label>
                        <select class="form-control" id="nama_hari" name="nama_hari" required>
                            <option value="" disabled selected>-- Pilih Nama Hari --</option>
                            <?php
                            $query_hari = "SELECT ID_HARI, NAMA_HARI FROM hari";
                            $result_hari = mysqli_query($koneksi, $query_hari);
                            while ($row_hari = mysqli_fetch_assoc($result_hari)) {
                                echo '<option value="' . $row_hari['ID_HARI'] . '">' . htmlspecialchars($row_hari['NAMA_HARI']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_pelajaran">Nama Pelajaran</label>
                        <select class="form-control" id="nama_pelajaran" name="nama_pelajaran" required>
                            <option value="" disabled selected>-- Pilih Nama Pelajaran --</option>
                            <?php
                            $query_pelajaran = "SELECT ID_PELAJARAN, NAMA_PELAJARAN FROM pelajaran";
                            $result_pelajaran = mysqli_query($koneksi, $query_pelajaran);
                            while ($row_pelajaran = mysqli_fetch_assoc($result_pelajaran)) {
                                echo '<option value="' . $row_pelajaran['ID_PELAJARAN'] . '">' . htmlspecialchars($row_pelajaran['NAMA_PELAJARAN']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_masuk">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_keluar">Jam Keluar</label>
                        <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester1" name="semester" required>
                        <option value="" disabled selected>-- Pilih Semester --</option>
                        <option value="Genap">Genap</option>
                        <option value="Ganjil">Ganjil</option>
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