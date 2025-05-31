<?php
include 'koneksi.php';

if (isset($_POST['id_siswa']) && isset($_POST['nama_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $kode_siswa = $_POST['kode_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $alamat_siswa = $_POST['alamat_siswa'];
    $angkatan_siswa = $_POST['angkatan_siswa'];
    $keterangan_siswa = $_POST['keterangan_siswa'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_kelas_siswa = $_POST['gabungan'];

    $query = "UPDATE siswa SET kode_siswa='$kode_siswa', nama_siswa='$nama_siswa', nis='$nis', alamat_siswa='$alamat_siswa', angkatan_siswa='$angkatan_siswa', angkatan_siswa='$angkatan_siswa', id_peminjam='$id_peminjam', id_kelas_siswa='$id_kelas_siswa' WHERE id_siswa='$id_siswa'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: siswa.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: siswa.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>