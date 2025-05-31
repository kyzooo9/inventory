<?php
require_once 'koneksi.php';

// Ambil ID guru dari URL
$id_peminjaman = $_GET['idp'];
$id_peralatan = $_GET['idprt'];
$tanggalToday = date('Y-m-d');
$id_denda = '4';

$queryTanggal = "SELECT tanggal_pengembalian FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
$resultTanggal = mysqli_query($koneksi, $queryTanggal);
$row = mysqli_fetch_assoc($resultTanggal);
$tanggal_pengembalian = $row['tanggal_pengembalian'];

// Pastikan tanggal pengembalian tidak kosong
if (!empty($tanggal_pengembalian)) {
    // Ubah string tanggal menjadi objek DateTime
    $today = new DateTime($tanggalToday);
    $tanggalPengembalian = new DateTime($tanggal_pengembalian);

    // Hitung selisih hari
    $selisih = $today->diff($tanggalPengembalian);

    if ($today > $tanggalPengembalian) {
        $hariTelat = $selisih->days; // Jumlah hari keterlambatan

        if ($hariTelat == 1) {
            $id_denda = '4';
        } elseif ($hariTelat > 1) {
            $id_denda = '5';
        }

        // $totalDenda = $hariTelat * $dendaPerHari; // Hitung total denda
        // echo "Terlambat: $hariTelat hari.<br>";
        // echo "Total denda: Rp." . number_format($totalDenda, 0, ',', '.');
    } else {
        echo "Tidak terlambat. Tidak ada denda.";
    }
} else {
    echo "Tanggal pengembalian tidak valid.";
}


echo $queryDenda = "UPDATE peminjaman 
        SET id_denda = '$id_denda'
        WHERE id_peminjaman = '$id_peminjaman'";

if (mysqli_query($koneksi, $queryDenda)) {
    echo "Data berhasil dihapus!";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
    die;
}

// Query untuk menghapus data
echo $queryPrt = "UPDATE peralatan 
        SET status_ketersediaan_peralatan = 'Tersedia',
        keterangan = 'Peralatan Tersedia'
        WHERE id_peralatan = '$id_peralatan'";

if (mysqli_query($koneksi, $queryPrt)) {
    echo "Data berhasil dihapus!";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
    die;
}

echo $query = "UPDATE peminjaman 
        SET tanggal_kembali = '$tanggalToday'
        WHERE id_peminjaman = '$id_peminjaman'";

if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil dihapus!";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
    die;
}

// Tutup koneksi
mysqli_close($koneksi);

// Redirect ke halaman lain
header("Location: http://localhost/inventory_sekolahh/pages/detailPeminjaman.php");
die();