<?php
include 'koneksi.php';

if (isset($_GET['id_peminjam'])) {
    $id_peminjam = $_GET['id_peminjam'];

    // Ambil nama file gambar dari database
    $query_get_image = "SELECT image_peminjam FROM peminjam WHERE id_peminjam = '$id_peminjam'";
    $result_get_image = mysqli_query($koneksi, $query_get_image);

    if ($result_get_image) {
        $row = mysqli_fetch_assoc($result_get_image);

        // Hapus gambar dari folder jika file ada
        if ($row && !empty($row['image_peminjam'])) {
            $file_path = 'uploads/' . $row['image_peminjam']; // Sesuaikan direktori
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    } else {
        die("Query error: " . mysqli_error($koneksi)); // Debugging query
    }

    // Hapus data dari database
    $query = "DELETE FROM peminjam WHERE id_peminjam = '$id_peminjam'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("location:peminjam.php?status=delete_success");
    } else {
        header("location:peminjam.php?status=delete_error");
    }
    exit();
}

?>
