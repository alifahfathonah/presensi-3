<?php
require '../app/config.php';
include_once '../template/header.php';
$page = 'dashboard';
include_once '../template/sidebar.php';
$log = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ")->fetch_array();
$user = $log['id_pegawai'];

// $a1 = $con->query("SELECT COUNT(*) AS total FROM pendaftaran WHERE id_peserta = '$user' ")->fetch_array();
// $a2 = $con->query("SELECT COUNT(*) AS total FROM pendaftaran WHERE verif = 1 AND id_peserta = '$user'")->fetch_array();
// $a3 = $con->query("SELECT COUNT(*) AS total FROM pendaftaran WHERE verif = 0 AND id_peserta = '$user'")->fetch_array();
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
                            <span class="info-box-text">Data</span>
                            <span class="info-box-number"> Total Data</span>
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