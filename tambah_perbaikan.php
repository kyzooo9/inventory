<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_perbaikan']) && isset($_POST['nama_guru'])) {
    // Ambil data dari form
    $kode_perbaikan = $_POST['kode_perbaikan'];
    $nama_guru = $_POST['nama_guru'];
    $tanggal_perbaikan = $_POST['tanggal_perbaikan'];

    // Query untuk memasukkan data ke dalam tabel kelas_siswa
    $query = "INSERT INTO perbaikan (KODE_PERBAIKAN, TANGGAL_PERBAIKAN, ID_GURU) 
              VALUES ('$kode_perbaikan', '$tanggal_perbaikan', '$nama_guru')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: perbaikan.php?status=success');
    } else {
        header('Location: perbaikan.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: perbaikan.php?status=invalid');
    exit();
}
?>
