<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_pemesanan'])) {
    // Ambil data dari form
    $kode_pemesanan = $_POST['kode_pemesanan'];
    $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
    $status_pemesanan = $_POST['status_pemesanan'];
    $id_peminjam = $_POST['username_peminjam'];

    // Query untuk memasukkan data ke dalam tabel siswa
    $query = "INSERT INTO pemesanan (KODE_PEMESANAN, TANGGAL_PEMESANAN, STATUS_PEMESANAN, ID_PEMINJAM) 
              VALUES ('$kode_pemesanan', '$tanggal_pemesanan', '$status_pemesanan', '$id_peminjam')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: pemesanan.php?status=success');
    } else {
        header('Location: pemesanan.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: pemesanan.php?status=invalid');
    exit();
}
?>
