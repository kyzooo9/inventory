<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_guru']) && isset($_POST['nama_guru']) && isset($_POST['username_peminjam']) && isset($_POST['nama_jabatan'])) {
    // Ambil data dari form
    $kode_guru = $_POST['kode_guru'];
    $nama_guru = $_POST['nama_guru'];
    $nik = $_POST['nik'];
    $alamat_guru = $_POST['alamat_guru'];
    $tanggal_lahir_guru = $_POST['tanggal_lahir_guru'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_jabatan = $_POST['nama_jabatan'];

    // Query untuk memasukkan data ke dalam tabel guru
    $query = "INSERT INTO guru (KODE_GURU, NAMA_GURU, NIK, ALAMAT_GURU, TANGGAL_LAHIR_GURU, ID_PEMINJAM, ID_JABATAN) 
              VALUES ('$kode_guru', '$nama_guru', '$nik', '$alamat_guru', '$tanggal_lahir_guru', '$id_peminjam', '$id_jabatan')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: guru.php?status=success');
    } else {
        header('Location: guru.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: guru.php?status=invalid');
    exit();
}
?>
