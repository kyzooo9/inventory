<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_siswa'])) {
    // Ambil data dari form
    $kode_siswa = $_POST['kode_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $alamat_siswa = $_POST['alamat_siswa'];
    $angkatan_siswa = $_POST['angkatan_siswa'];
    $keterangan_siswa = $_POST['keterangan_siswa'];
    $id_peminjam = $_POST['username_peminjam'];
    $id_kelas_siswa = $_POST['gabungan'];

    // Query untuk memasukkan data ke dalam tabel siswa
    $query = "INSERT INTO siswa (KODE_SISWA, NAMA_SISWA, NIS, ALAMAT_SISWA, ANGKATAN_SISWA, KETERANGAN_SISWA, ID_PEMINJAM, ID_KELAS_SISWA) 
              VALUES ('$kode_siswa', '$nama_siswa', '$nis', '$alamat_siswa', '$angkatan_siswa', '$keterangan_siswa', '$id_peminjam', '$id_kelas_siswa')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: siswa.php?status=success');
    } else {
        header('Location: siswa.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: siswa.php?status=invalid');
    exit();
}
?>
