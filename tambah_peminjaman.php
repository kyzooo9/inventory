<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_peminjaman'])) {
    // Ambil data dari form
    $kode_peminjaman = $_POST['kode_peminjaman'];
    $id_guru = $_POST['nama_guru'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_denda = $_POST['denda'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

    // Query untuk memasukkan data ke dalam tabel peminjaman
    $query = "INSERT INTO peminjaman (KODE_PEMINJAMAN, TANGGAL_PEMINJAMAN, TANGGAL_KEMBALI, TANGGAL_PENGEMBALIAN, ID_GURU, ID_DENDA, ID_PEMINJAM)
              VALUES ('$kode_peminjaman', '$tanggal_peminjaman', '$tanggal_kembali', '$tanggal_pengembalian', '$id_guru', '$id_denda', '$id_peminjam')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman peminjaman dengan status
    if ($result) {
        header('Location: peminjaman.php?status=success');
    } else {
        header('Location: peminjaman.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: peminjaman.php?status=invalid');
    exit();
}
?>
