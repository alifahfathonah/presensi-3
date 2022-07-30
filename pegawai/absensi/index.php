<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'absensi';
include_once '../../template/sidebar.php';

$user = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]'")->fetch_array();
$absen = $user['id_pegawai'];
$tanggal = date('Y-m-d');
$jam = date('H:i');
$cek = $con->query("SELECT * FROM absensi WHERE id_pegawai = '$absen' AND tanggal = '$tanggal'")->fetch_array();
$telat = $con->query("SELECT * FROM telat WHERE id_pegawai = '$absen' AND tanggal = '$tanggal'")->fetch_array();
$jamSekarang = strtotime(date('H:i'));
$limit = $con->query("SELECT * FROM jam_masuk WHERE id = 1")->fetch_array();
$jamLimit = strtotime($limit['jam']);
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-street-view ml-1 mr-1"></i> Absensi Kehadiran</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <!-- <a href="tambah" class="btn btn-sm bg-dark"><i class="fa fa-plus-circle"> Tambah Data</i></a> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                        <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                    <?php $_SESSION['pesan'] = '';
                    } ?>

                    <?php if (!isset($cek)) { ?>
                        <?php if (($jamSekarang <= $jamLimit) || (isset($telat))) { ?>
                            <form method="POST">
                                <input type="hidden" id="latitude" name="latitude" required>
                                <input type="hidden" id="longitude" name="longitude" required>
                                <button id="current_location" class="btn btn-lg btn-block bg-cyan mb-2"><i class="fa fa-street-view"> Klik untuk melakukan Absensi</i></button>
                                <div id="konfirmasi" class="row mt-2 mb-2" hidden>
                                    <div class="col-6">
                                        <button type="submit" name="submit" class="btn btn-lg btn-block bg-success"><i class="fa fa-check-circle"> Absensi Sekarang</i></button>
                                    </div>
                                    <div class="col-6">
                                        <a href="" id="batal" class="btn btn-lg btn-block bg-danger"><i class="fa fa-times-circle"> Batal</i></a>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <form method="POST">
                                <a href="#" class="btn btn-lg btn-block bg-danger mb-2"><i class="fa fa-times-circle"> Kamu Terlambat melakukan Absensi ! <br><br> silahkan hubungi Administrator untuk membuka akses Absensi</i></a>
                            </form>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert bg-gradient-olive alert-dismissible">
                            <h5><i class="icon fas fa-check"></i> Informasi</h5>
                            <?php if ($cek['sts'] == 'Hadir') { ?>
                                Anda Sudah Melakukan Absensi !
                            <?php } else if ($cek['sts'] == 'Cuti') { ?>
                                Anda Sedang Cuti !
                            <?php } else if ($cek['sts'] == 'Izin') { ?>
                                Anda Sedang Izin !
                            <?php } else { ?>
                                Anda Sedang Sakit !
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM absensi WHERE id_pegawai = '$absen' ORDER BY id_absensi DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= hari($row['tanggal']) ?></td>
                                                <td align="center"><?= tgl($row['tanggal']) ?></td>
                                                <td align="center"><?= $row['jam'] ?></td>
                                                <td align="center" width="10%">
                                                    <?php if ($row['sts'] == 'Hadir') { ?>
                                                        <a href="lokasi?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-map-marker-alt mr-1"></i> Detail</a>
                                                    <?php } else { ?>
                                                        <a href="#" class="btn bg-warning btn-xs" title="Edit"><i class="fas fa-exclamation-triangle mr-1"></i></i> <?= $row['sts'] ?> !</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
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
    $("#current_location").click(function() { //user clicks button
        if ("geolocation" in navigator) { //check geolocation available 
            //try to get user current location using getCurrentPosition() method
            navigator.geolocation.getCurrentPosition(function(position) {
                $("#latitude").val(position.coords.latitude);
                $("#longitude").val(position.coords.longitude);
            });
        } else {
            console.log("Browser doesn't support geolocation!");
        }
    });

    if ($("#current_location").click(function(e) {
            e.preventDefault();
            $("#current_location").prop('disabled', true);
            $("#konfirmasi").prop('hidden', false);
        }));

    if ($("#batal").click(function(e) {
            e.preventDefault();
            $("#current_location").prop('disabled', false);
            $("#konfirmasi").prop('hidden', true);
        }));
</script>

<?php


if (isset($_POST['submit'])) {

    $tambah = $con->query("INSERT INTO absensi VALUES (
        default, 
        '$absen',
        null,
        '$tanggal',
        '$jam',
        '$_POST[latitude]',
        '$_POST[longitude]',
        'Hadir'
    )");

    if ($tambah) {
        $_SESSION['pesan'] = "Anda Telah Melakukan Absensi Kehadiran";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}
