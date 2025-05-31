<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_peminjaman_guru']) && isset($_POST['username_peminjam'])) {
    // Ambil data dari form
    $kode_peminjaman_guru = $_POST['kode_peminjaman_guru'];
    $keterangan_peminjaman = $_POST['keterangan_peminjaman'];
    $id_peminjam = $_POST['username_peminjam'];

    // Query untuk memasukkan data ke dalam tabel peminjaman_guru
    $query = "INSERT INTO peminjaman_guru (KODE_PEMINJAMAN_GURU, KETERANGAN_PEMINJAMAN, ID_PEMINJAM) 
              VALUES ('$kode_peminjaman_guru', '$keterangan_peminjaman', '$id_peminjam')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: peminjaman_guru.php?status=success');
    } else {
        header('Location: peminjaman_guru.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: peminjaman_guru.php?status=invalid');
    exit();
}
?>
