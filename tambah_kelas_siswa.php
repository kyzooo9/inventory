<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_kelas_siswa'])) {
    // Ambil data dari form
    $kode_kelas_siswa = $_POST['kode_kelas_siswa'];
    $nama_kelas_siswa = $_POST['nama_kelas_siswa'];
    $ruangan = $_POST['ruangan'];
    $id_kelas = $_POST['nama_kelas'];
    $id_jurusan = $_POST['nama_jurusan'];
    
    // Query untuk memasukkan data ke dalam tabel kelas_siswa
    $query = "INSERT INTO kelas_siswa (KODE_KELAS_SISWA, NAMA_KELAS_SISWA, ID_KELAS, ID_JURUSAN, RUANGAN) 
              VALUES ('$kode_kelas_siswa', '$nama_kelas_siswa', '$id_kelas', '$id_jurusan', '$ruangan')";
    
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Query untuk memperbarui kolom GABUNGAN
        $update_gabungan_query = "
            UPDATE kelas_siswa ks
            JOIN kelas k ON k.ID_KELAS = ks.ID_KELAS
            JOIN jurusan j ON j.ID_JURUSAN = ks.ID_JURUSAN
            SET ks.GABUNGAN = CONCAT(k.NAMA_KELAS, '-', j.INISIAL, '-', ks.NAMA_KELAS_SISWA)
            WHERE ks.KODE_KELAS_SISWA = '$kode_kelas_siswa'
        ";
        
        $update_result = mysqli_query($koneksi, $update_gabungan_query);

        // Redirect ke halaman kelas_siswa dengan status
        if ($update_result) {
            header('Location: kelas_siswa.php?status=success');
        } else {
            header('Location: kelas_siswa.php?status=error_update');
        }
    } else {
        header('Location: kelas_siswa.php?status=error_insert');
    }   
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: kelas_siswa.php?status=invalid');
    exit();
}
?>
