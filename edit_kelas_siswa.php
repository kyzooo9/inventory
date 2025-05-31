<?php
include 'koneksi.php';

if (isset($_POST['id_kelas_siswa']) && isset($_POST['nama_kelas_siswa'])) {
    $id_kelas_siswa = $_POST['id_kelas_siswa'];
    $kode_kelas_siswa = $_POST['kode_kelas_siswa'];
    $nama_kelas_siswa = $_POST['nama_kelas_siswa'];
    $ruangan = $_POST['ruangan'];
    $id_kelas = $_POST['id_kelas'];
    $id_jurusan = $_POST['id_jurusan'];

    $query = "UPDATE kelas_siswa SET kode_kelas_siswa='$kode_kelas_siswa', nama_kelas_siswa='$nama_kelas_siswa', ruangan='$ruangan', id_kelas='$id_kelas', id_jurusan='$id_jurusan' WHERE id_kelas_siswa='$id_kelas_siswa'";
    $result = mysqli_query($koneksi, $query); // Simpan hasil query

    if ($result) {
        header("Location: kelas_siswa.php?status=edit_success"); // Status untuk edit berhasil
    } else {
        header("Location: kelas_siswa.php?status=edit_error"); // Status untuk edit gagal
    }
    exit();
}
?>