<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_peminjaman_siswa']) && isset($_POST['username_peminjam'])) {
    // Ambil data dari form
    $kode_peminjaman_siswa = $_POST['kode_peminjaman_siswa'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $guru_pengajar = $_POST['guru_pengajar'];
    $id_peminjam = $_POST['username_peminjam'];

    // Query untuk memasukkan data ke dalam tabel peminjaman_guru
    $query = "INSERT INTO peminjaman_siswa (KODE_PEMINJAMAN_SISWA, MATA_PELAJARAN, GURU_PENGAJAR, ID_PEMINJAM) 
              VALUES ('$kode_peminjaman_siswa', '$mata_pelajaran', '$guru_pengajar', '$id_peminjam')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: peminjaman_siswa.php?status=success');
    } else {
        header('Location: peminjaman_siswa.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: peminjaman_siswa.php?status=invalid');
    exit();
}
?>
