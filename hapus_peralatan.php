<?php
include 'koneksi.php';

if (isset($_GET['id_peralatan'])) {
    $id_peralatan = $_GET['id_peralatan'];

    // Ambil nama file gambar dari database
    $query_get_image = "SELECT image_peralatan FROM peralatan WHERE id_peralatan = '$id_peralatan'";
    $result_get_image = mysqli_query($koneksi, $query_get_image);

    if ($result_get_image) {
        $row = mysqli_fetch_assoc($result_get_image);

        // Hapus gambar dari folder jika file ada
        if ($row && !empty($row['image_peralatan'])) {
            $file_path = 'uploads/' . $row['image_peralatan']; // Sesuaikan direktori
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    } else {
        die("Query error: " . mysqli_error($koneksi)); // Debugging query
    }

    // Hapus data dari database
    $query = "DELETE FROM peralatan WHERE id_peralatan = '$id_peralatan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("location:peralatan.php?status=delete_success");
    } else {
        header("location:peralatan.php?status=delete_error");
    }
    exit();
}

?>
