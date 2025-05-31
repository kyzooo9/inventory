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
            <h1 class="m-0">Transaksi Peminjaman SMK ABC Surabaya</h1>
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
                              <th>Kode Transaksi Peminjaman</th>
                              <th>Guru</th>
                              <th>Peralatan</th>
                              <th>Tanggal Peminjaman</th>
                              <th>Tanggal Kembali</th>
                              <th>Tanggal Pengembalian</th>
                              <th>Denda</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT dpj.kode_detail_peminjaman, pj.id_denda, d.denda, pj.id_peminjaman, pr.id_peralatan, pr.nama_peralatan, gr.id_guru, gr.nama_guru, pj.tanggal_peminjaman, pj.tanggal_kembali, pj.tanggal_pengembalian
                                  FROM detail_peminjaman dpj
                                  JOIN peminjaman pj ON dpj.id_peminjaman = pj.id_peminjaman 
                                  JOIN peralatan pr ON dpj.id_peralatan = pr.id_peralatan
                                  JOIN denda d ON pj.id_denda = d.id_denda
                                  JOIN guru gr ON pj.id_guru = gr.id_guru";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?php echo ($row['kode_detail_peminjaman']); ?></td>
                                  <td><?php echo ($row['nama_guru']); ?></td>
                                  <td><?php echo ($row['nama_peralatan']); ?></td>
                                  <td><?php echo ($row['tanggal_peminjaman']); ?></td>
                                  <td><?php echo ($row['tanggal_kembali']); ?></td>
                                  <td><?php echo ($row['tanggal_pengembalian']); ?></td>
                                  <td><?php echo ($row['denda']); ?></td>
                                  <td>
                                      <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#modalEdit<?= $no ?>">
                                            <i class="fa fa-edit"></i> Edit
                                      </button>

                                      <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modalHapus<?= $no ?>">
                                            <i class="fa fa-trash"></i> Hapus
                                      </button>
                                      <a class="btn btn-outline-info my-2" href="dikembalikan.php?idp=<?= $res['ID_PEMINJAMAN'] ?>&idprt=<?= $res['ID_PERALATAN'] ?>" role="button"><i class="fas fa-book mr-2"></i>Dikembalikan</a>
                                  </td>

                                  <!-- Modal Edit -->
                                  <div class="modal fade" id="modalEdit<?= $no ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel">Edit Transaksi Peminjaman</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="edit_detail_peminjaman.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="kode_detail_peminjaman" class="form-control" value="<?= $row['KODE_DETAIL_PEMINJAMAN'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_detail_peminjaman">Kode Petail Peminjaman</label>
                                                        <input type="text" class="form-control" name="kode_detail_peminjaman" id="kode_detail_peminjaman" value="<?= $row['KODE_DETAIL_PEMINJAMAN'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kode_peminjaman">Kode Peminjaman</label>
                                                        <select class="form-control" id="kode_peminjaman" name="kode_peminjaman" required>
                                                            <option value="" disabled>-- Pilih Kode Peminjaman --</option>
                                                            <?php
                                                            $query_username = "SELECT ID_PEMINJAMAN, KODE_PEMINJAMAN FROM peminjaman";
                                                            $result_username = mysqli_query($koneksi, $query_username);
                                                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                                                $selected = ($row_username['ID_PEMINJAMAN'] == $row['ID_PEMINJAMAN']) ? 'selected' : '';
                                                                echo '<option value="' . $row_username['ID_PEMINJAMAN'] . '" ' . $selected . '>' . htmlspecialchars($row_username['KODE_PEMINJAMAN']) . '</option>';
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
                                              <form id="formHapus" action="hapus_detail_peminjaman.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Detail Peminjaman</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="kode_detail_peminjaman" name="kode_detail_peminjaman" value="<?= $row['kode_detail_peminjaman'] ?>">
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="tambah_detail_peminjaman.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        // Mengambil kode hari terakhir dari table hari
                        $result = mysqli_query($koneksi, "SELECT kode_detail_peminjaman FROM detail_peminjaman ORDER BY kode_detail_peminjaman DESC LIMIT 1;");
                        $row = mysqli_fetch_assoc($result);

                        if ($row) {
                            $lastCode = $row['kode_detail_peminjaman']; // Mengambil kode hari terakhir
                            $number = (int) substr($lastCode, -3); // Mengambil 3 digit terakhir
                            $newNumber = $number + 1; // Menambahkan 1
                            // Membentuk kode hari baru dengan format HR001, HR002, dll.
                            $newCode = 'DPJM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                        } else {
                            // Jika table kosong, mulai dari HR001
                            $newCode = 'DPJM001';
                        }
                        ?>
                        <div class="form-group">
                            <label for="kode_detail_peminjaman">Kode Detail Peminjaman</label>
                            <input required type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="kode_detail_peminjaman" value="<?= $newCode ?>" id="kode_detail_peminjaman" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_peralatan">Peralatan</label>
                            <select required class="form-control" name="id_peralatan" id="">
                                <option value="" selected hidden></option>
                                <?php
                                $query = "SELECT * FROM peralatan WHERE status_ketersediaan_peralatan = 'Tersedia'";
                                $result = mysqli_query($koneksi, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $peralatan = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach ($peralatan as $prt) {
                                        echo '<option value="' . $prt['ID_PERALATAN'] . '">' . $prt['NAMA_PERALATAN'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>Tidak ada peralatan tersedia</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_peminjaman">Kode Peminjaman</label>
                            <select required class="form-control" name="id_peminjaman" id="">
                                <option value="" selected hidden></option>
                                <?php
                                $query = "SELECT * FROM peminjaman";
                                foreach ($peminjaman as $pmj) : ?>
                                    <option value="<?php echo $pmj['ID_PEMINJAMAN'] ?>"><?php echo $pmj['KODE_PEMINJAMAN'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Tambah</button>
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