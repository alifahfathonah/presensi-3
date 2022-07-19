<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'absensi';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai JOIN divisi c ON b.id_divisi = c.id_divisi JOIN jabatan d ON b.id_jabatan = d.id_jabatan WHERE a.id_absensi = '$id' ");
$row = $query->fetch_array();

?>

<style>
    #lokasi {
        height: 400px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-street-view ml-1 mr-1"></i> Detail Absensi Kehadiran</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 float-right">
                    <a href="#" onClick="history.go(-1);" class="btn btn-xs bg-dark float-right"><i class="fa fa-arrow-left"> Kembali</i></a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- left column -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">
                            <dl class="row">
                                <dt class="col-sm-2">Nama Pegawai</dt>
                                <dd class="col-sm-10">: <?= $row['nm_pegawai'] ?></dd>
                                <dt class="col-sm-2">NIP</dt>
                                <dd class="col-sm-10">: <?= $row['nip'] ?></dd>
                                <dt class="col-sm-2">Divisi</dt>
                                <dd class="col-sm-10">: <?= $row['nm_divisi'] ?></dd>
                                <dt class="col-sm-2">Jabatan</dt>
                                <dd class="col-sm-10">: <?= $row['nm_jabatan'] ?></dd>
                                <dt class="col-sm-2">Waktu Absensi</dt>
                                <dd class="col-sm-10">: <?= hari($row['tanggal']) . ', ' . tgl($row['tanggal']) . ' (Jam ' . $row['jam'] . ' WITA)' ?></dd>
                            </dl>
                            <hr>
                            <div id="lokasi"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../../template/footer.php';
?>

<script>
    var mymap = L.map('lokasi').setView([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>], 15);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicml6YWxkZXYiLCJhIjoiY2p2d2Z6a2gwMnVsajN6bzE4cnVla2dscSJ9.rOecnfTEpVlBvFc3ZIrJag'
    }).addTo(mymap);

    var marker = L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>]).addTo(mymap);
    marker.bindPopup("<b><?= $row['nm_pegawai'] ?></b><hr><?= hari($row['tanggal']) . ', ' . tgl($row['tanggal']) . ' (Jam ' . $row['jam'] . ' WITA)' ?>").openPopup();
</script>