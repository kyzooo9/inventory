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

<?php
 include 'koneksi.php';

 // Ambil username dari session
 $username = $_SESSION['username'];
 
 // Query untuk mendapatkan role user
 $queryRole = "SELECT role FROM peminjam WHERE username_peminjam = ?";
 $stmtRole = $koneksi->prepare($queryRole);
 $stmtRole->bind_param("s", $username);
 $stmtRole->execute();
 $resultRole = $stmtRole->get_result();
 
 // Cek jika data ditemukan
 if ($resultRole->num_rows == 0) {
     die("Data pengguna tidak ditemukan.");
 }
 
 $userRole = $resultRole->fetch_assoc()['role'];
 
 // Query untuk mengambil data pengguna berdasarkan role
 if ($userRole == 'Guru') {
     $query = "SELECT j.id_jabatan, j.nama_jabatan, gr.id_guru AS id, gr.nama_guru AS name, gr.nik, pj.username_peminjam as email, pj.role, pj.image_peminjam AS image 
               FROM guru gr join peminjam pj on gr.id_peminjam=pj.id_peminjam join jabatan j on gr.id_jabatan=j.id_jabatan WHERE pj.username_peminjam = ?";
 } elseif ($userRole == 'Siswa') {
     $query = "SELECT sw.id_siswa AS id, sw.nama_siswa AS name, sw.nis, pj.username_peminjam AS email, pj.role, pj.image_peminjam AS image 
               FROM siswa sw join peminjam pj on sw.id_peminjam=pj.id_peminjam WHERE pj.username_peminjam = ?";
 } elseif ($userRole == 'Admin') {
     $query = "SELECT id_peminjam AS id, username_peminjam AS name, role, image_peminjam AS image 
               FROM peminjam WHERE username_peminjam = ?";
 }
 
 $stmt = $koneksi->prepare($query);
 $stmt->bind_param("s", $username);
 $stmt->execute();
 $result = $stmt->get_result();
 
 
 $userData = $result->fetch_assoc();
 ?>

  <!-- Navbar & Sidebar start -->
  <?php
   
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
            <h1 class="m-0">Selamat Datang</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-0 shadow">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Your Profile</h3>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <!-- Informasi Profil -->
                        <div class="w-75">
                        <?php if ($userRole === 'Guru' || $userRole === 'Siswa'): ?>
                            <div class="form-group">
                                <label>Nomor Induk:</label>
                                <p><?php echo htmlspecialchars($userData['nik'] ?? $userData['nis'] ?? '-'); ?></p>
                            </div>
                            <?php endif ?>
                        <?php if ($userRole === 'Guru'): ?>
                            <div class="form-group">
                                <label>Jabatan:</label>
                                <p><?php echo htmlspecialchars($userData['nama_jabatan'] ?? '-'); ?></p>
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label>Username:</label>
                                <p><?php echo htmlspecialchars($userData['name'] ?? 'belum terdaftar sebagai siswa'); ?></p>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <p><?php echo htmlspecialchars($userData['email'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="form-group">
                                <label>Role:</label>
                                <p><?php echo htmlspecialchars($userData['role'] ?? 'belum terdaftar role apapun'); ?></p>
                            </div>
                        </div>

                        <!-- Gambar Profil -->
                        <div class="w-25 text-center">
                          <label>Image:</label><br>
                          <?php
                          $imagePath = 'uploads/' . $userData['image'];
                          if (!empty($userData['image']) && file_exists($imagePath)) {
                              echo '<img src="' . htmlspecialchars($imagePath) . '" class="img-thumbnail img-fluid">';
                          } else {
                              echo '<p>Gambar tidak ditemukan di folder uploads</p>';
                          }
                          ?>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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