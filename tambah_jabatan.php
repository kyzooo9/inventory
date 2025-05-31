<?php
include 'koneksi.php';

if (isset($_POST['nama_jabatan'])) {
    $kode_jabatan = $_POST['kode_jabatan'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $query = "INSERT INTO jabatan (KODE_JABATAN, NAMA_JABATAN) VALUES ('$kode_jabatan', '$nama_jabatan')";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: jabatan.php?status=success"); // Ganti 'your_page.php' dengan nama file Anda
    } else {
        header("Location: jabatan.php?status=error"); // Ganti 'your_page.php' dengan nama file Anda
    }
    exit();
}
?>
