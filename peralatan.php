
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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/smkabc.jpg" alt="AdminLTELogo" height="100" width="100">
  </div>

<?php
	include 'koneksi.php';
    include 'header.php';
    include 'sidebar.php';
  ?>


  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Peminjam</h1>
          </div>
        </div><
      </div>
    </div>
   <!--main konten -->
    <section class="content">
    <?php
      if (isset($_GET['status'])) {
        $status = $_GET['status'];
          if ($status === 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    peralatan berhasil ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'edit_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data peralatan berhasil diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'delete_success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data peralatan berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'edit_error') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat mengedit data peminjam!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } elseif ($status === 'delete_error') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat menghapus data peminjam!
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
                              <th>Aksi</th>
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
                                  <td><?= htmlspecialchars($row['KODE_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['NAMA_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['TANGGAL_BELI_PERALATAN	']); ?></td>
                                  <td><?= htmlspecialchars($row['STATUS_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['JUMLAH_KERUSAKAN_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['STATUS_KETERSEDIAAN_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['ATURAN_SERVICE_PERALATAN']); ?></td>
                                  <td><?= htmlspecialchars($row['IMAGE_PERALATAN']); ?></td>
                                  <td>
                                      <?php
                                          $imagePath = htmlspecialchars($row['IMAGE_PERALATAN']);
                                      ?>
                                      <img src="uploads/<?= $imagePath; ?>" alt="Image" width="50" onerror="this.onerror=null; this.src='uploads/default.jpg';"> 
                                  </td>
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
                                              <form action="edit_peralatan.php" method="post" enctype="multipart/form-data">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title">Edit Data Peralatan</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" name="id_peralatan" value="<?= $row['ID_PERALATAN']; ?>">
                                                      <div class="form-group">
                                                          <label>Kode Peminjam</label>
                                                          <input type="text" name="kode_peminjam" id="kode_peminjam" class="form-control" value="<?= $row['KODE_PEMINJAM']; ?>" required>
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Nama Peralatan</label>
                                                          <input type="text" name="Nama_Peralatan" class="form-control" value="<?= $row['USERNAME_PERALATAN']; ?>" required>
                                                      </div>
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
                                                          <label for="Nama_Merk">Merk</label>
                                                          <select class="form-control" id="Nama_Merk" name="Nama_Merk" required onchange="handleStatusChange('edit')">
                                                              <option value="" disabled selected>-- Pilih Merk --</option>
                                                              <option value="Aktif" <?= ($row['NAMA_MERK'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                                              <option value="Tidak Aktif" <?= ($row['NAMA_MERK'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="Nama_Warna">Warna</label>
                                                          <select class="form-control" id="Nama_Warna" name="Nama_Nama_WarnaMerk" required onchange="handleStatusChange('edit')">
                                                              <option value="" disabled selected>-- Pilih Warna --</option>
                                                              <option value="Aktif" <?= ($row['NAMA_WARNA'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                                              <option value="Tidak Aktif" <?= ($row['NAMA_WARNA'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="tanggal_lahir_guru">Tanggal Beli</label>
                                                        <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="keterangan_peringatan_edit">Keterangan Peringatan</label>
                                                          <input type="text" class="form-control" id="keterangan_peringatan_edit" name="keterangan_peringatan" 
                                                              value="<?= htmlspecialchars($row['KETERANGAN_PERINGATAN']); ?>" 
                                                              <?= ($row['STATUS_PEMINJAM'] == 'Tidak Aktif') ? 'disabled' : ''; ?>>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="role">Role</label>
                                                          <select class="form-control" id="role" name="role" required>
                                                              <option value="" disabled selected>-- Pilih Role --</option>
                                                              <option value="Admin" <?= ($row['ROLE'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                                              <option value="Guru" <?= ($row['ROLE'] == 'Guru') ? 'selected' : ''; ?>>Guru</option>
                                                              <option value="Siswa" <?= ($row['ROLE'] == 'Siswa') ? 'selected' : ''; ?>>Siswa</option>
                                                          </select>
                                                    </div>
                                                      <div class="form-group" enctype="multipart/form-data">
                                                        <label>Image Peminjam</label>
                                                        <input type="file" name="image_peminjam" class="form-control">
                                                        <input type="hidden" name="old_image_peminjam" value="<?= htmlspecialchars($row['IMAGE_PEMINJAM']); ?>">
                                                        <div class="mt-2">
                                                            <?php if (!empty($row['IMAGE_PEMINJAM'])): ?>
                                                                <img src="uploads/<?= htmlspecialchars($row['IMAGE_PEMINJAM']); ?>" alt="Image Peminjam" width="100" class="img-thumbnail">
                                                            <?php else: ?>
                                                                <p>Tidak ada gambar yang tersedia</p>
                                                            <?php endif; ?>
                                                      </div>
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


                                  <!-- Modal Hapus -->
                                  <div class="modal fade" id="modalHapus<?= $no ?>" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <form id="formHapus" action="hapus_peminjam.php" method="get">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="modalHapusLabel">Hapus Data Peminjam</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <input type="hidden" id="id_peminjam" name="id_peminjam" value="<?= $row['ID_PEMINJAM'] ?>">
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
          
          </div> 
        
        </div>
  
      </div>
      <!-- Modal Tambah -->
      <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="formTambah" action="tambah_peminjam.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data Peminjam</h5>
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
                       <label>Nama Peralatan</label>
                              <input type="text" name="Nama_Peralatan" class="form-control" value="<?= $row['USERNAME_PERALATAN']; ?>" required>
                          </div>
                          <div class="form-group">
                        <label for="nama_jenis">Jenis</label>
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
                        <label for="nama_merk">Merk</label>
                        <select class="form-control" id="nama_merk" name="nama_merk" required>
                        <option value="" disabled>-- Pilih Merk --</option>
                        <?php
                        $query_username = "SELECT ID_MERK, NAMA_MERK FROM MERK";
                        $result_username = mysqli_query($koneksi, $query_username);
                        while ($row_username = mysqli_fetch_assoc($result_username)) {
                            $selected = ($row_username['ID_MERK'] == $row['ID_MERK']) ? 'selected' : '';
                            echo '<option value="' . $row_username['ID_MERK'] . '" ' . $selected . '>' . htmlspecialchars($row_username['NAMA_MERK']) . '</option>';
                        }
                        ?>
                        </select>
                          <div class="form-group">
                              <label for="Nama_Warna">Warna</label>
                              <select class="form-control" id="Nama_Warna" name="Nama_Nama_WarnaMerk" required onchange="handleStatusChange('edit')">
                                  <option value="" disabled selected>-- Pilih Warna --</option>
                                  <option value="Aktif" <?= ($row['NAMA_WARNA'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                  <option value="Tidak Aktif" <?= ($row['NAMA_WARNA'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="tanggal_lahir_guru">Tanggal Beli</label>
                            <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
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
    </section>
  </div>




	<?php
		include 'footer.php';
	?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<!-- jQuery -->

<script>
function togglePassword(no) {
    const passwordInput = document.getElementById(`passwordInput${no}`);
    const eyeIcon = document.getElementById(`eyeIcon${no}`);
    if (passwordInput.type == "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>

<script>
  // Fungsi handleStatusChange
  function handleStatusChange(mode) {
      let statusElement, keteranganElement;

      // Sesuaikan elemen berdasarkan mode (tambah/edit)
      if (mode === 'tambah') {
          statusElement = document.getElementById('status_peminjam_tambah');
          keteranganElement = document.getElementById('keterangan_peringatan_tambah');
      } else if (mode === 'edit') {
          statusElement = document.getElementById('status_peminjam_edit');
          keteranganElement = document.getElementById('keterangan_peringatan_edit');
      }

      // Periksa nilai status
      if (statusElement.value === 'Aktif') {
          keteranganElement.disabled = false;
          keteranganElement.value = ''; // Kosongkan nilai input
      } else if (statusElement.value === 'Tidak Aktif') {
          keteranganElement.disabled = true;
          keteranganElement.value = 'Tidak ada'; // Isi dengan nilai default
      }
  }

  // Pastikan fungsi dijalankan saat halaman dimuat untuk mode edit
  window.onload = function () {
      handleStatusChange('edit'); // Panggil untuk mode edit
  };
</script>


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