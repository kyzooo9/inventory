<?php
include 'koneksi.php';

if (isset($_POST['username_peminjam'])) {
    $kode_peminjam = $_POST['kode_peminjam'];
    $username_peminjam = $_POST['username_peminjam'];
    $password_peminjam = $_POST['password_peminjam'];
    $status_peminjam = $_POST['status_peminjam'];
    $keterangan_peringatan = $_POST['keterangan_peringatan'];
    $role = $_POST['role'];

    if ($status_peminjam === "Tidak Aktif") {
        $keterangan_peringatan = "Tidak ada";
    }

    if (isset($_FILES['image_peminjam']) && $_FILES['image_peminjam']['error'] == 0) {
        $target_dir = "uploads/";
        
        $file_ext = strtolower(pathinfo($_FILES["image_peminjam"]["name"], PATHINFO_EXTENSION));
        
        $new_file_name = $kode_peminjam . '.' . $file_ext;
        $target_file = $target_dir . $new_file_name;

        $check = getimagesize($_FILES["image_peminjam"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }

        if ($_FILES["image_peminjam"]["size"] > 5000000) {
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

        if (move_uploaded_file($_FILES["image_peminjam"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO peminjam (KODE_PEMINJAM, USERNAME_PEMINJAM, PASSWORD_PEMINJAM, STATUS_PEMINJAM, KETERANGAN_PERINGATAN, ROLE, IMAGE_PEMINJAM) 
                      VALUES ('$kode_peminjam', '$username_peminjam', '$password_peminjam', '$status_peminjam', '$keterangan_peringatan', '$role', '$new_file_name')";

            $result = mysqli_query($koneksi, $query);

            if ($result) {
                header('Location: peminjam.php?status=success');
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
