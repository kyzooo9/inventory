<?php
include 'koneksi.php';

if (isset($_POST['id_guru']) && isset($_POST['nama_guru'])) {
    $id_guru = $_POST['id_guru'];
    $kode_guru = $_POST['kode_guru'];
    $nama_guru = $_POST['nama_guru'];
    $nik = $_POST['nik'];
    $alamat_guru = $_POST['alamat_guru'];
    $tanggal_lahir_guru = $_POST['tanggal_lahir_guru'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_jabatan = $_POST['nama_jabatan'];

    $query = "UPDATE guru SET kode_guru='$kode_guru', nama_guru='$nama_guru', nik='$nik', alamat_guru='$alamat_guru', tanggal_lahir_guru='$tanggal_lahir_guru', id_peminjam='$id_peminjam', id_jabatan='$id_jabatan' WHERE id_guru='$id_guru'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: guru.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: guru.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>