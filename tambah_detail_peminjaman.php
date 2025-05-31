<?php
require_once 'koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $kode_detail_peminjaman = $_POST['kode_detail_peminjaman'];
    $id_peralatan = $_POST['id_peralatan'];
    $id_peminjaman = $_POST['id_peminjaman'];

    $queryPeminjaman = "SELECT id_peminjam, tanggal_pengembalian FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
    $resPeminjam = mysqli_query($koneksi, $queryPeminjaman);
    $row = mysqli_fetch_assoc($resPeminjam);
    $id_peminjam = $row['id_peminjam'];
    $tanggal_pengembalian = $row['tanggal_pengembalian'];

    $queryUsername = "SELECT username_peminjam FROM peminjam WHERE id_peminjam = $id_peminjam";
    $resUsername = mysqli_query($koneksi, $queryUsername);
    $row = mysqli_fetch_assoc($resUsername);
    $username_peminjam = $row['username_peminjam'];


    // Query insert data
    $query = "INSERT INTO detail_peminjaman (kode_detail_peminjaman, id_peralatan, id_peminjaman) 
              VALUES ('$kode_detail_peminjaman', '$id_peralatan', '$id_peminjaman')";

    $queryStatus = "UPDATE peralatan 
              SET status_ketersediaan_peralatan = 'Dipinjam', 
              keterangan = 'Peralatan ini telah dipinjam oleh $username_peminjam. Dijadwalkan kembali pada tanggal : $tanggal_pengembalian'
              WHERE id_peralatan = $id_peralatan";

        if ($koneksi->query($queryStatus)) {
            echo "Status berhasil diperbarui.";
        } else {
            echo "Error: " . $koneksi->error;
            die;
        }

        if (mysqli_query($koneksi, $query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($koneksi);
            die;
        }
        }


        // Redirect ke halaman lain
        header("Location: detail_peminjaman.php");
        die();