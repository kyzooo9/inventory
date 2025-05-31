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
            <h1 class="m-0">Peralatan SMK ABC Surabaya</h1>
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
                                <th>Kode Peralatan</th>
                                <th>Nama Peralatan</th>
                                <th>Jenis</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Tanggal Beli</th>
                                <th>Status</th>
                                <th>Jumlah Rusak</th>
                                <th>Ketersediaan</th>
                                <th>Service</th>
                                <th>Image</th>
                                <?php if ($_SESSION['role'] === 'Admin'): ?>
                                <?php echo '<th>Aksi</th>' ?>
                                <?php endif; ?>
                            </tr>
                        </thead>
                      <tbody>
                      <?php
                        $query = "SELECT pr.*, j.NAMA_JENIS, m.NAMA_MERK, w.NAMA_WARNA FROM peralatan pr JOIN jenis j ON pr.ID_JENIS = j.ID_JENIS JOIN merk m ON pr.ID_MERK = m.ID_MERK JOIN warna w ON pr.ID_WARNA = w.ID_WARNA;";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <tr>
                                  <td><?= $no++; ?></td>
                                  <td><?php echo($row['KODE_PERALATAN']); ?></td>
                                  <td><?php echo($row['NAMA_PERALATAN']); ?></td>
                                  <td><?php echo($row['NAMA_JENIS']); ?></td>
                                  <td><?php echo($row['NAMA_MERK']); ?></td>
                                  <td><?php echo($row['NAMA_WARNA']); ?></td>
                                  <td><?php echo($row['TANGGAL_BELI_PERALATAN']); ?></td>
                                  <td><?php echo($row['STATUS_PERALATAN']); ?></td>
                                  <td><?php echo($row['JUMLAH_KERUSAKAN_PERALATAN']); ?></td>
                                  <td><?php echo($row['STATUS_KETERSEDIAAN_PERALATAN']); ?></td>
                                  <td><?php echo($row['ATURAN_SERVICE_PERALATAN']); ?></td>
                                  <td>
                                      <?php
                                          $imagePath = htmlspecialchars($row['IMAGE_PERALATAN']);
                                      ?>
                                      <img src="uploads/<?= $imagePath; ?>" alt="Image" width="50" onerror="this.onerror=null; this.src='uploads/default.jpg';"> 
                                  </td>
                                  <?php if ($_SESSION['role'] === 'Admin'): ?>
                                  <td>
                                      <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#modalEdit<?= $no ?>">
                                            <i class="fa fa-edit"></i> Edit
                                      </button>
                                      <button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modalHapus<?= $no ?>">
                                            <i class="fa fa-trash"></i> Hapus
                                      </button>
                                  </td>
                                  <?php endif; ?>
                                  <!-- Modal Edit -->
                                  <div class="modal fade" id="modalEdit<?= $no ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel">Edit Data Peralatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="edit_peralatan.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_peralatan" class="form-control" value="<?= $row['ID_PERALATAN'] ?>">
                                                    
                                                    <div class="form-group">
                                                        <label for="kode_peralatan">Kode Peralatan</label>
                                                        <input type="text" class="form-control" name="kode_peralatan" id="kode_peralatan" value="<?= $row['KODE_PERALATAN'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_peralatan">Nama Peralatan</label>
                                                        <input type="text" class="form-control" id="nama_peralatan" name="nama_peralatan" value="<?= $row['NAMA_PERALATAN'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_jenis">Nama Jenis</label>
                                                        <select class="form-control" id="nama_jenis" name="nama_jenis" required>
                                                            <option value="" disabled>-- Pilih Jenis --</option>
                                                            <?php
                                                            $query_username = "SELECT ID_JENIS, NAMA_JENIS FROM jenis";
                                                            $result_username = mysqli_query($koneksi, $query_username);
                                                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                                                $selected = ($row_username['ID_JENIS'] == $row['ID_JENIS']) ? 'selected' : '';
                                                                echo '<option value="' . $row_username['ID_JENIS'] . '" ' . $selected . '>' . htmlspecialchars($row_username['NAMA_JENIS']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_merk">Nama Merk</label>
                                                        <select class="form-control" id="nama_merk" name="nama_merk" required>
                                                            <option value="" disabled>-- Pilih Nama Merk --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_MERK, NAMA_MERK FROM merk";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_MERK'] == $row['ID_MERK']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_MERK'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_MERK']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_warna">Nama Warna</label>
                                                        <select class="form-control" id="nama_warna" name="nama_warna" required>
                                                            <option value="" disabled>-- Pilih Warna --</option>
                                                            <?php
                                                            $query_jabatan = "SELECT ID_WARNA, NAMA_WARNA FROM warna";
                                                            $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                                                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                                $selected = ($row_jabatan['ID_WARNA'] == $row['ID_WARNA']) ? 'selected' : '';
                                                                echo '<option value="' . $row_jabatan['ID_WARNA'] . '" ' . $selected . '>' . htmlspecialchars($row_jabatan['NAMA_WARNA']) . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_beli_peralatan">Tanggal Beli</label>
                                                        <input type="date" class="form-control" id="tanggal_beli_peralatan" name="tanggal_beli_peralatan" value="<?= $row['TANGGAL_BELI_PERALATAN'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status_peralatan">Status Peralatan</label>
                                                    <select class="form-control" id="status_peralatan1" name="status_peralatan" required onchange="handleStatusChange('edit')">
                                                        <option value="" disabled selected>-- Pilih Status Peralatan --</option>
                                                        <option value="Baik" <?= ($row['STATUS_PERALATAN'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                                        <option value="Rusak" <?= ($row['STATUS_PERALATAN'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah_kerusakan1">Jumlah Kerusakan</label>
                                                        <input type="number" class="form-control" id="jumlah_kerusakan1" name="jumlah_kerusakan" 
                                                            value="<?= isset($row['JUMLAH_KERUSAKAN']) ? htmlspecialchars($row['JUMLAH_KERUSAKAN']) : ''; ?>" 
                                                            <?= (isset($row['STATUS_PERALATAN']) && $row['STATUS_PERALATAN'] == 'Baik') ? 'disabled' : 'required'; ?>>
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="status_ketersediaan_peralatan">Status Ketersediaan Peralatan</label>
                                                          <select class="form-control" id="status_ketersediaan_peralatan" name="status_ketersediaan_peralatan" required>
                                                              <option value="" disabled selected>-- Pilih>Status Ketersediaan Peralatan --</option>
                                                              <option value="Tersedia" <?= ($row['STATUS_KETERSEDIAAN_PERALATAN'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                                              <option value="Tidak Tersedia" <?= ($row['STATUS_KETERSEDIAAN_PERALATAN'] == 'Tidak Tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="aturan_service_peralatan">Aturan Service</label>
                                                        <textarea class="form-control" id="aturan_service_peralatan" name="aturan_service_peralatan" required><?= htmlspecialchars($row['ATURAN_SERVICE_PERALATAN']); ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image Peralatan</label>
                                                        <input type="file" name="image_peralatan" class="form-control">
                                                        <input type="hidden" name="old_image_peralatan" value="<?= htmlspecialchars($row['IMAGE_PERALATAN']); ?>">
                                                        <div class="mt-2">
                                                            <?php if (!empty($row['IMAGE_PERALATAN'])): ?>
                                                                <img src="uploads/<?= htmlspecialchars($row['IMAGE_PERALATAN']); ?>" alt="Image Peralatan" width="100" class="img-thumbnail">
                                                            <?php else: ?>
                                                                <p>Tidak ada gambar yang tersedia</p>
                                                            <?php endif; ?>
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
                                              <form id="formHapus" action="hapus_peralatan.php" method="get ">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Peralatan</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_peralatan" name="id_peralatan" value="<?= $row['ID_PERALATAN'] ?>">
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
            <form id="formTambah" action="tambah_peralatan.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Peralatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
								
                    $result = mysqli_query($koneksi, "SELECT kode_peralatan FROM peralatan ORDER BY id_peralatan DESC LIMIT 1");
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                      $lastCode = $row['kode_peralatan'];
                      $number = (int) substr($lastCode, -3);
                      $newNumber = $number + 1;

                      $newCode = 'PR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                    } else {
                      $newCode = 'PR001';
                    }
                    ?>
                    <div class="form-group">
                          <label for="kode_peralatan">Kode Peralatan</label>
                          <input type="text" class="form-control" name="kode_peralatan" id="kode_peralatan" value="<?php echo $newCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_peralatan">Nama Peralatan</label>
                        <input type="text" class="form-control" id="nama_peralatan" name="nama_peralatan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_jenis">Jenis Peralatan</label>
                        <select class="form-control" id="nama_jenis" name="nama_jenis" required>
                            <option value="" disabled selected>-- Pilih Jenis Peralatan --</option>
                            <?php
                            $query_username = "SELECT ID_JENIS, NAMA_JENIS FROM jenis";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_JENIS'] . '">' . htmlspecialchars($row_username['NAMA_JENIS']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_merk">Merk Peralatan</label>
                        <select class="form-control" id="nama_merk" name="nama_merk" required>
                            <option value="" disabled selected>-- Pilih Merk Peralatan --</option>
                            <?php
                            $query_username = "SELECT ID_MERK, NAMA_MERK FROM merk";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_MERK'] . '">' . htmlspecialchars($row_username['NAMA_MERK']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_warna">Warna Peralatan</label>
                        <select class="form-control" id="nama_warna" name="nama_warna" required>
                            <option value="" disabled selected>-- Pilih Warna Peralatan --</option>
                            <?php
                            $query_username = "SELECT ID_WARNA, NAMA_WARNA FROM warna";
                            $result_username = mysqli_query($koneksi, $query_username);
                            while ($row_username = mysqli_fetch_assoc($result_username)) {
                                echo '<option value="' . $row_username['ID_WARNA'] . '">' . htmlspecialchars($row_username['NAMA_WARNA']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_beli_peralatan">Tanggal Beli</label>
                        <input type="date" class="form-control" name="tanggal_beli_peralatan" required>
                    </div>
                    <div class="form-group">
                        <label for="status_peralatan">Status Peralatan</label>
                        <select class="form-control" id="status_peralatan" name="status_peralatan" required onchange="handleStatusChange('tambah')">
                            <option value="" disabled selected>-- Pilih Status Peralatan --</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kerusakan_peralatan">Jumlah Kerusakan Peralatan</label>
                        <input type="number" class="form-control" id="jumlah_kerusakan_peralatan" name="jumlah_kerusakan_peralatan" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status_ketersediaan_peralatan">Status Ketersediaan Peralatan</label>
                        <select class="form-control" id="status_ketersediaan_peralatan" name="status_ketersediaan_peralatan" required>
                        <option value="" disabled selected>-- Pilih Status Ketersediaan Peralatan --</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aturan_service_peralatan">Aturan Service</label>
                        <textarea type="text-area" class="form-control" name="aturan_service_peralatan" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="image_peralatan">Image Peralatan</label>
                      <input type="file" class="form-control-file" id="image_peralatan" name="image_peralatan" accept="image/*" required>
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

<script>
  // Fungsi handleStatusChange untuk menangani perubahan status
  function handleStatusChange(context) {
        let status, jumlahKerusakan;

        // Tentukan elemen berdasarkan konteks (tambah atau edit)
        if (context === 'tambah') {
            status = document.getElementById('status_peralatan').value;
            jumlahKerusakan = document.getElementById('jumlah_kerusakan_peralatan');
        } else if (context === 'edit') {
            status = document.getElementById('status_peralatan1').value;
            jumlahKerusakan = document.getElementById('jumlah_kerusakan1');
        }

        // Aktifkan atau nonaktifkan input jumlah kerusakan berdasarkan status
        if (status === 'Rusak') {
            jumlahKerusakan.disabled = false;
            jumlahKerusakan.value = ''; // Kosongkan nilai jika diaktifkan
        } else if (status === 'Baik') {
            jumlahKerusakan.disabled = true;
            jumlahKerusakan.value = 'Tidak ada'; // Isi default
        }
    }

    // Jalankan fungsi saat halaman dimuat untuk modal edit
    window.onload = function() {
        // Panggil fungsi handleStatusChange untuk memastikan input disabled sesuai status yang ada
        handleStatusChange('edit');
    };
</script>

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