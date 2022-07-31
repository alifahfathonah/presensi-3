<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">Inventaris | Presensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-1 mb-1 d-flex">
            <div class="info">
                <a href="#" class="d-block"><i class="fas fa-user-circle mr-1"></i><b>
                        <?= $_SESSION['nm_user'] ?>
                    </b></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu</li>
                <?php if ($_SESSION['level'] == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/" class="nav-link <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview  <?php if (
                                                            $page == 'user' || $page == 'divisi' || $page == 'ruangan' || $page == 'jabatan' || $page == 'jam'
                                                        ) {
                                                            echo 'menu-open';
                                                        } ?>">
                        <a href="#" class="nav-link <?php if (
                                                        $page == 'user' || $page == 'divisi' || $page == 'ruangan' || $page == 'jabatan' || $page == 'jam'
                                                    ) {
                                                        echo 'active';
                                                    } ?>">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/user/" class="nav-link <?php if ($page == 'user') {
                                                                                            echo 'active';
                                                                                        } ?>">
                                    <i class="fas fa-user mr-1"></i>
                                    <p>Data Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/divisi/" class="nav-link <?php if ($page == 'divisi') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    <p>Data Divisi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/jabatan/" class="nav-link <?php if ($page == 'jabatan') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fas fa-project-diagram mr-1"></i>
                                    <p>Data Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/ruangan/" class="nav-link <?php if ($page == 'ruangan') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fas fa-person-booth mr-1"></i>
                                    <p>Data Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/jam/" class="nav-link <?php if ($page == 'jam') {
                                                                                            echo 'active';
                                                                                        } ?>">
                                    <i class="fas fa-clock mr-1"></i>
                                    <p>Jam Masuk Kerja</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview  <?php if (
                                                            $page == 'pegawai' || $page == 'tugas' || $page == 'absensi' || $page == 'telat' || $page == 'izin'
                                                        ) {
                                                            echo 'menu-open';
                                                        } ?>">
                        <a href="#" class="nav-link <?php if (
                                                        $page == 'pegawai' || $page == 'tugas' || $page == 'absensi' || $page == 'telat' || $page == 'izin'
                                                    ) {
                                                        echo 'active';
                                                    } ?>">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Kepegawaian
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/pegawai/" class="nav-link <?php if ($page == 'pegawai') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>
                                        Data Pegawai
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/absensi/" class="nav-link <?php if ($page == 'absensi') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fa fa-street-view"></i>
                                    <p>
                                        Absensi Kehadiran
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/telat/" class="nav-link <?php if ($page == 'telat') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fa fa-door-open"></i>
                                    <p>
                                        Akses Terlambat Absensi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/izin/" class="nav-link <?php if ($page == 'izin') {
                                                                                            echo 'active';
                                                                                        } ?>">
                                    <i class="nav-icon fa fa-file-signature"></i>
                                    <p>
                                        Data Izin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/tugas/" class="nav-link <?php if ($page == 'tugas') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>
                                        Data Perintah Tugas
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview  <?php if (
                                                            $page == 'pengadaan' || $page == 'barang' || $page == 'rusak' || $page == 'mutasi'
                                                        ) {
                                                            echo 'menu-open';
                                                        } ?>">
                        <a href="#" class="nav-link <?php if (
                                                        $page == 'pengadaan' || $page == 'barang' || $page == 'rusak' || $page == 'mutasi'
                                                    ) {
                                                        echo 'active';
                                                    } ?>">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Inventaris Barang
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/pengadaan/" class="nav-link <?php if ($page == 'pengadaan') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                    <i class="nav-icon fas fa-truck-loading"></i>
                                    <p>
                                        Data Pengadaan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/barang/" class="nav-link <?php if ($page == 'barang') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Data Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/rusak/" class="nav-link <?php if ($page == 'rusak') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>
                                        Data Kerusakan Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/mutasi/" class="nav-link <?php if ($page == 'mutasi') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="nav-icon fas fa-people-carry"></i>
                                    <p>
                                        Data Mutasi Barang
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-print"></i>
                            <p>
                                Laporan Cetak
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_pegawai">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_rekap_presensi">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Rekapitulasi Presensi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_presensi_pegawai">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Presensi Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_izin">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Izin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_tugas">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Perintah Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_pengadaan">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Pengadaan Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_barang">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_rusak">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Kerusakan Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_mutasi">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Mutasi Barang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else if ($_SESSION['level'] == 2) { ?>

                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/" class="nav-link <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-print"></i>
                            <p>
                                Laporan Cetak
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_pegawai">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_rekap_presensi">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Rekapitulasi Presensi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_presensi_pegawai">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Presensi Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_izin">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Izin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_tugas">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Perintah Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_pengadaan">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Pengadaan Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_barang">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_rusak">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Kerusakan Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_mutasi">
                                    <p><i class="fa fa-file-alt fa-1x mr-1"></i> Mutasi Barang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/pegawai/" class="nav-link <?php if ($page == 'dashboard') {
                                                                                    echo 'active';
                                                                                } ?>">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/pegawai/absensi/" class="nav-link <?php if ($page == 'absensi') {
                                                                                            echo 'active';
                                                                                        } ?>">
                            <i class="nav-icon fa fa-street-view"></i>
                            <p>
                                Absensi Kehadiran
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/pegawai/izin/" class="nav-link <?php if ($page == 'izin') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fa fa-file-signature"></i>
                            <p>
                                Data Izin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/pegawai/tugas/" class="nav-link <?php if ($page == 'tugas') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Data Perintah Tugas
                            </p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>

<?php include 'modal.php'; ?>