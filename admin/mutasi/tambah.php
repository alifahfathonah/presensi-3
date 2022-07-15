<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'mutasi';
include_once '../../template/sidebar.php';

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-people-carry ml-1 mr-1"></i> Tambah Data Mutasi Barang</h4>
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
                                    <label class="col-sm-2 col-form-label">Nomor SK</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_surat" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barang</label>
                                    <div class="col-sm-10">
                                        <select name="id_barang" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan ORDER BY tgl_pengadaan DESC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_barang'] ?>"><?= $row['nm_barang'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ruangan</label>
                                    <div class="col-sm-10">
                                        <select name="id_ruangan" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM ruangan ORDER BY id_ruangan DESC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_ruangan'] ?>"><?= $row['nm_ruangan'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_mutasi" required>
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

<?php
if (isset($_POST['submit'])) {
    $no_surat = $_POST['no_surat'];
    $id_barang = $_POST['id_barang'];
    $id_ruangan = $_POST['id_ruangan'];

    $old = $con->query("SELECT * FROM barang WHERE id_barang = '$id_barang' ")->fetch_array();

    $id_ruangan_old = $old['id_ruangan'];

    $tgl_mutasi = $_POST['tgl_mutasi'];

    $tambah = $con->query("INSERT INTO mutasi VALUES (
        default, 
        '$no_surat', 
        '$id_barang', 
        '$id_ruangan', 
        '$id_ruangan_old', 
        '$tgl_mutasi'
    )");

    if ($tambah) {
        $con->query("UPDATE barang SET id_ruangan = '$id_ruangan' WHERE id_barang = '$id_barang'");

        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}


?>