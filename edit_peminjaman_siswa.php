<?php
include 'koneksi.php';

if (isset($_POST['id_peminjaman_siswa']) && isset($_POST['username_peminjam'])) {
    $id_peminjaman_siswa = $_POST['id_peminjaman_siswa'];
    $kode_peminjaman_siswa = $_POST['kode_peminjaman_siswa'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $guru_pengajar = $_POST['guru_pengajar'];
    $id_peminjam = $_POST['username_peminjam'];

    $query = "UPDATE peminjaman_siswa SET kode_peminjaman_siswa='$kode_peminjaman_siswa', mata_pelajaran='$mata_pelajaran', guru_pengajar='$guru_pengajar', id_peminjam='$id_peminjam' WHERE id_peminjaman_siswa='$id_peminjaman_siswa'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: peminjaman_siswa.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: peminjaman_siswa.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>