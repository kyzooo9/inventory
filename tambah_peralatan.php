<?php
include 'koneksi.php';

if (isset($_POST['kode_peralatan']) && isset($_POST['nama_peralatan'])) {
    // Ambil data dari form
    $kode_peralatan = $_POST['kode_peralatan'];
    $nama_peralatan = $_POST['nama_peralatan'];
    $tanggal_beli_peralatan = $_POST['tanggal_beli_peralatan'];
    $status_peralatan = $_POST['status_peralatan'];
    $jumlah_kerusakan_peralatan = $_POST['jumlah_kerusakan_peralatan'];
    $status_ketersediaan_peralatan = $_POST['status_ketersediaan_peralatan'];
    $aturan_service_peralatan = $_POST['aturan_service_peralatan'];
    $id_jenis = $_POST['nama_jenis'];
    $id_merk = $_POST['nama_merk'];
    $id_warna = $_POST['nama_warna'];


    if ($status_peralatan === "Baik") {
        $jumlah_kerusakan_peralatan = 0;
    }

    if (isset($_FILES['image_peralatan']) && $_FILES['image_peralatan']['error'] == 0) {
        $target_dir = "uploads/";
        
        $file_ext = strtolower(pathinfo($_FILES["image_peralatan"]["name"], PATHINFO_EXTENSION));
        
        $new_file_name = $kode_peralatan . '.' . $file_ext;
        $target_file = $target_dir . $new_file_name;

        $check = getimagesize($_FILES["image_peralatan"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }

        if ($_FILES["image_peralatan"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        if (!in_array($file_ext, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (move_uploaded_file($_FILES["image_peralatan"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO peralatan (KODE_PERALATAN, NAMA_PERALATAN, TANGGAL_BELI_PERALATAN, STATUS_PERALATAN, JUMLAH_KERUSAKAN_PERALATAN, STATUS_KETERSEDIAAN_PERALATAN, ATURAN_SERVICE_PERALATAN, image_peralatan, ID_JENIS, ID_MERK, ID_WARNA) 
            VALUES ('$kode_peralatan', '$nama_peralatan', '$tanggal_beli_peralatan', '$status_peralatan', '$jumlah_kerusakan_peralatan', '$status_ketersediaan_peralatan', '$aturan_service_peralatan', '$new_file_name', '$id_jenis', '$id_merk', '$id_warna')";


            $result = mysqli_query($koneksi, $query);

            if ($result) {
                header('Location: peralatan.php?status=success');
            } else {
                echo "Sorry, there was an error saving your data.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No image uploaded or there was an error in the file upload.";
    }
}
?>
