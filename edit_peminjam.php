<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peminjam = $_POST['id_peminjam'];
    $kode_peminjam = $_POST['kode_peminjam'];
    $username_peminjam = $_POST['username_peminjam'];
    $password_peminjam = $_POST['password_peminjam'];
    $status_peminjam = $_POST['status_peminjam'];
    $keterangan_peringatan = $_POST['keterangan_peringatan'];
    $role = $_POST['role'];
    $old_image_peminjam = $_POST['old_image_peminjam'];

    if ($status_peminjam === "Tidak Aktif") {
        $keterangan_peringatan = "Tidak ada";
    }

    // Debugging: Check file upload
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Periksa apakah file gambar baru diunggah
    $image_peminjam = $old_image_peminjam; // Default ke gambar lama
    if (isset($_FILES['image_peminjam']) && $_FILES['image_peminjam']['error'] == UPLOAD_ERR_OK) {
        $image_peminjam = time() . "_" . $_FILES['image_peminjam']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_peminjam;

        // Create uploads directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image_peminjam']['tmp_name'], $target_file)) {
                // Hapus gambar lama
                if (!empty($old_image_peminjam) && file_exists("uploads/" . $old_image_peminjam)) {
                    unlink("uploads/" . $old_image_peminjam);
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

    // Hash the password
    $hashed_password = password_hash($password_peminjam, PASSWORD_DEFAULT);

    // Debugging: Check new image filename
    echo "New image filename: " . $image_peminjam;

    // Query untuk update data peminjam
    $query = "UPDATE peminjam SET KODE_PEMINJAM = ?, USERNAME_PEMINJAM = ?, PASSWORD_PEMINJAM = ?, STATUS_PEMINJAM = ?, KETERANGAN_PERINGATAN = ?, ROLE = ?, IMAGE_PEMINJAM = ? WHERE ID_PEMINJAM = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssssssi", $kode_peminjam, $username_peminjam, $hashed_password, $status_peminjam, $keterangan_peringatan, $role, $image_peminjam, $id_peminjam);

    if ($stmt->execute()) {
        header("Location: peminjam.php?status=edit_success");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
?>