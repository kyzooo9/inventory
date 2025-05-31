<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

if (isset($_POST['kode_jadwal'])) {
    // Ambil data dari form
    $kode_jadwal = $_POST['kode_jadwal'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];
    $semester = $_POST['semester'];
    $keterangan_siswa = $_POST['keterangan_siswa'];
    $id_kelas_siswa = $_POST['nama_kelas_siswa'];
    $id_guru = $_POST['nama_guru'];
    $id_hari = $_POST['nama_hari'];
    $id_pelajaran = $_POST['nama_pelajaran'];

    // Query untuk memasukkan data ke dalam tabel siswa
    $query = "INSERT INTO jadwal (KODE_JADWAL, JAM_MASUK, JAM_KELUAR, SEMESTER, ID_KELAS_SISWA, ID_GURU, ID_HARI, ID_PELAJARAN) 
              VALUES ('$kode_jadwal', '$jam_masuk', '$jam_keluar', '$semester', '$id_kelas_siswa', '$id_guru', '$id_hari', '$id_pelajaran')";
    
    $result = mysqli_query($koneksi, $query);

    // Redirect ke halaman kelas_siswa dengan status
    if ($result) {
        header('Location: jadwal.php?status=success');
    } else {
        header('Location: jadwal.php?status=error');
    }
    exit();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    header('Location: jadwal.php?status=invalid');
    exit();
}
?>
