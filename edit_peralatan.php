<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil semua inputan POST
    $id_peralatan = $_POST['id_peralatan'];
    $kode_peralatan = $_POST['kode_peralatan'];
    $nama_peralatan = $_POST['nama_peralatan'];
    $nama_jenis = $_POST['nama_jenis'];
    $nama_merk = $_POST['nama_merk'];
    $nama_warna = $_POST['nama_warna'];
    $tanggal_beli_peralatan = $_POST['tanggal_beli_peralatan'];
    $status_peralatan = $_POST['status_peralatan'];
    $jumlah_kerusakan_peralatan = $_POST['jumlah_kerusakan_peralatan'];
    $status_ketersediaan_peralatan = $_POST['status_ketersediaan_peralatan'];
    $aturan_service_peralatan = $_POST['aturan_service_peralatan'];
    $old_image_peralatan = $_POST['old_image_peralatan'];

    if ($status_peralatan === "Baik") {
        $jumlah_kerusakan_peralatan = 0;
    }

   // Periksa apakah file gambar baru diunggah
   $image_peralatan = $old_image_peralatan; // Default ke gambar lama
   if (isset($_FILES['image_peralatan']) && $_FILES['image_peralatan']['error'] == UPLOAD_ERR_OK) {
       $image_peralatan = time() . "_" . $_FILES['image_peralatan']['name'];
       $target_dir = "uploads/";
       $target_file = $target_dir . $image_peralatan;

       // Create uploads directory if it doesn't exist
       if (!is_dir($target_dir)) {
           mkdir($target_dir, 0755, true);
       }

       $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
       $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

       if (in_array($imageFileType, $allowed_types)) {
           if (move_uploaded_file($_FILES['image_peralatan']['tmp_name'], $target_file)) {
               // Hapus gambar lama
               if (!empty($old_image_peralatan) && file_exists("uploads/" . $old_image_peralatan)) {
                   unlink("uploads/" . $old_image_peralatan);
               }
           } else {
               echo "Gagal memindahkan file.";
               exit;
           }
       } else {
           echo "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
           exit;
       }
   }


    // Jalankan query UPDATE
    $query = "UPDATE peralatan SET 
        KODE_PERALATAN = '$kode_peralatan',
        ID_JENIS = '$nama_jenis',
        ID_MERK = '$nama_merk',
        ID_WARNA = '$nama_warna',
        NAMA_PERALATAN = '$nama_peralatan',
        TANGGAL_BELI_PERALATAN = '$tanggal_beli_peralatan',
        STATUS_PERALATAN = '$status_peralatan',
        JUMLAH_KERUSAKAN_PERALATAN = '$jumlah_kerusakan_peralatan',
        STATUS_KETERSEDIAAN_PERALATAN = '$status_ketersediaan_peralatan',
        ATURAN_SERVICE_PERALATAN = '$aturan_service_peralatan',
        IMAGE_PERALATAN = '$image_peralatan'
        WHERE ID_PERALATAN = '$id_peralatan'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: peralatan.php?status=edit_success");
    } else {
        header("Location: peralatan.php?status=edit_error");
    }
    exit();
}

?>