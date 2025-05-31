<?php
include 'koneksi.php';

if (isset($_POST['id_jadwal'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];
    $semester = $_POST['semester'];
    $id_kelas_siswa = $_POST['nama_kelas_siswa'];
    $id_guru = $_POST['nama_guru'];
    $id_hari = $_POST['nama_hari'];
    $id_pelajaran = $_POST['nama_pelajaran'];

    $query = "UPDATE jadwal SET jam_masuk='$jam_masuk', jam_keluar='$jam_keluar', semester='$semester', id_guru='$id_guru', id_hari='$id_hari', id_pelajaran='$id_pelajaran', id_kelas_siswa='$id_kelas_siswa' WHERE id_jadwal='$id_jadwal'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: jadwal.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: jadwal.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>