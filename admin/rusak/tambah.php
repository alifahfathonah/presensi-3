<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'rusak';
include_once '../../template/sidebar.php';

$status = [
    '' => ' -- Pilih -- ',
    '1' => 'Bisa Diperbaiki',
    '0' => 'Rusak Total',
];
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-tools ml-1 mr-1"></i> Tambah Data Kerusakan Barang</h4>
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
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barang</label>
                                    <div class="col-sm-10">
                                        <select name="id_barang" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan WHERE status = 1 ORDER BY tgl_pengadaan DESC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_barang'] ?>"><?= $row['nm_barang'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Keterangan Kerusakan</label>
                                    <div class="col-sm-10">
                                        <textarea name="ket" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Kerusakan</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_rusak" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Kerusakan</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('status_perbaikan', $status, '', 'class="form-control" id="sp" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row" id="biaya" hidden>
                                    <label class="col-sm-2 col-form-label">Biaya Perbaikan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="biaya_perbaikan" id="rupiah">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Simpan</i></button>
                                        <button type="reset" class="btn btn-sm btn-danger float-right mr-1"><i class="fa fa-times-circle"> Batal</i></button>
                                    </div>
                                </div>
                            </form>
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
    $(window).load(function() {
        $("#sp").change(function() {
            if ($("#sp option:selected").val() == '1') {
                $('#biaya').prop('hidden', false);
                $("#rupiah").prop('required', true);
            } else {
                $('#biaya').prop('hidden', true);
                $("#rupiah").prop('required', false);
            }
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $ket = $_POST['ket'];
    $tgl_rusak = $_POST['tgl_rusak'];
    $status_perbaikan = $_POST['status_perbaikan'];

    if ($status_perbaikan == 1) {
        $biaya_perbaikan = $_POST['biaya_perbaikan'];
    } else {
        $biaya_perbaikan = null;
    }

    $tambah = $con->query("INSERT INTO rusak VALUES (
        default, 
        '$id_barang', 
        '$ket', 
        '$tgl_rusak', 
        '$status_perbaikan',
        '$biaya_perbaikan'
    )");

    if ($tambah) {
        if ($status_perbaikan == 0) {
            $con->query("UPDATE barang SET status = 0 WHERE id_barang = '$id_barang'");
        }
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}


?>