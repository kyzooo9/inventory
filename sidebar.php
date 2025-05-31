<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Memulai session jika session belum dimulai
}
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

include 'koneksi.php';

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="profil.php" class="brand-link">
        <img src="dist/img/smkabc.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMK ABC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="uploads/<?= $_SESSION['image'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=($_SESSION['username']) ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="profil.php" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i> 
                        <p>Profil</p>
                    </a>
                </li>

                <!-- Menu Master -->
                <?php if ($role === 'Admin' || $role === 'Siswa'): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>Master Siswa<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php if ($role === 'Admin'): ?>
                            <li class="nav-item">
                                <a href="siswa.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="kelas.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="jurusan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jurusan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="kelas_siswa.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelas Siswa</p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="peminjaman_siswa.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman Siswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Menu Guru (Admin hanya) -->
                <?php if ($role === 'Admin' || $role === 'Guru'): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Master Guru<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php if ($role === 'Admin'): ?>
                            <li class="nav-item">
                                <a href="guru.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Guru</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="jabatan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pelajaran.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pelajaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="hari.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hari</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="jadwal.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal</p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="peminjaman_guru.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman Guru</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if ($role === 'Admin' || $role === 'Guru' || $role === 'Siswa'): ?>
                    <!-- Menu Master Peralatan dan Peminjaman (Admin hanya) -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>Pinjam & Alat<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                                <a href="peralatan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peralatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="peminjaman.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman</p>
                                </a>
                            </li>
                            
                            <?php if ($role === 'Admin'): ?>
                            <li class="nav-item">
                                <a href="pemesanan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pemesanan</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="peminjam.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjam</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="denda.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Denda</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="jenis.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jenis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="merk.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Merk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="warna.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Warna</p>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Menu Transaksi -->
                <?php if ($role === 'Admin' || $role === 'Guru' || $role === 'Siswa'): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Transaksi Peminjaman<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Transaksi Pemesanan, Peminjaman (Admin, Guru, Siswa) -->
                            
                            <li class="nav-item">
                                <a href="detail_peminjaman.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaksi Peminjaman</p>
                                </a>
                            </li>
                            <?php if ($role === 'Admin'): ?>
                            <li class="nav-item">
                                <a href="detail_pemesanan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaksi Pemesanan</p>
                                </a>
                            </li>
                            <?php endif;?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Menu Transaksi Perbaikan (Admin + Guru) -->
                <?php if ($role === 'Admin'): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-wrench"></i>
                            <p>Transaksi Perbaikan<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="detail_perbaikan.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaksi Perbaikan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fa fa-share"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>