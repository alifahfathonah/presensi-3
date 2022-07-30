<?php
require '../app/config.php';
include_once '../template/header.php';
$page = 'dashboard';
include_once '../template/sidebar.php';
$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_pegawai'];

$a = $con->query("SELECT COUNT(*) AS total FROM tugas a JOIN sub_tugas b ON a.id_tugas = b.id_tugas WHERE b.id_pegawai = '$user' ")->fetch_array();
$b = $con->query("SELECT COUNT(*) AS total FROM izin WHERE id_pegawai = '$user'")->fetch_array();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="info-box mb-12 bg-gradient-purple">
                        <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Izin</span>
                            <span class="info-box-number"><?= $b['total'] ?> Total Data</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="info-box mb-12 bg-gradient-olive">
                        <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Perintah Tugas</span>
                            <span class="info-box-number"><?= $a['total'] ?> Total Data</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../template/footer.php';
?>