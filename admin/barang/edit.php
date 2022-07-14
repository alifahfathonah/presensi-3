<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'barang';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan WHERE id_barang ='$id'");
$row = $query->fetch_array();

$status = [
    '' => ' -- Pilih --',
    '1' => 'Baik',
    '0' => 'Rusak',
];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-sitemap ml-1 mr-1"></i>
                        <?php if ($row['id_ruangan'] == null && $row['status'] == null) {
                            echo 'Verifikasi Lokasi & Status Barang';
                        } else {
                            echo 'Edit Data Barang';
                        } ?>
                    </h4>
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
                                    <label class="col-sm-2 col-form-label">Kode Pengadaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['kd_pengadaan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['nm_barang'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['satuan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Pengadaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= tgl($row['tgl_pengadaan']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sumber Dana</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['sumber_dana'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ruangan</label>
                                    <div class="col-sm-10">
                                        <select name="id_ruangan" id="id_ruangan" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM ruangan ORDER BY id_ruangan DESC"); ?>
                                            <?php foreach ($data as $d) :
                                                if ($d['id_ruangan'] == $row['id_ruangan']) { ?>
                                                    <option value="<?= $d['id_ruangan']; ?>" selected="<?= $d['id_ruangan']; ?>"><?= $d['nm_ruangan'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_ruangan'] ?>"><?= $d['nm_ruangan'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Barang</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('status', $status, $row['status'], 'class="form-control" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Update</i></button>
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

<?php
if (isset($_POST['submit'])) {
    $id_ruangan = $_POST['id_ruangan'];
    $status = $_POST['status'];

    $update = $con->query("UPDATE barang SET 
        id_ruangan = '$id_ruangan',
        status = '$status'
        WHERE id_barang = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}


?>