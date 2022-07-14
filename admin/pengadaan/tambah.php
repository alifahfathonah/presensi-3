<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'pengadaan';
include_once '../../template/sidebar.php';


$query = mysqli_query($con, "SELECT max(kd_pengadaan) as kode FROM pengadaan");
$data = mysqli_fetch_array($query);
$kode = $data['kode'];

$urutan = (int) substr($kode, 6, 6);
$urutan++;
$huruf = "IVB";
$kode = $huruf . sprintf("%06s", $urutan);
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-truck-loading ml-1 mr-1"></i> Tambah Data Pengadaan Barang</h4>
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
                                        <input type="text" class="form-control" name="kd_pengadaan" value="<?= $kode ?>" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nm_barang" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="satuan" placeholder="Contoh : Unit, Set, dll.." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Pengadaan</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_pengadaan" value="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Sumber Dana</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sumber_dana" required>
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
    $kd_pengadaan = $_POST['kd_pengadaan'];
    $nm_barang = $_POST['nm_barang'];
    $satuan = $_POST['satuan'];
    $tgl_pengadaan = $_POST['tgl_pengadaan'];
    $sumber_dana = $_POST['sumber_dana'];

    $tambah = $con->query("INSERT INTO pengadaan VALUES (
        default, 
        '$kd_pengadaan', 
        '$nm_barang', 
        '$satuan', 
        '$tgl_pengadaan',
        '$sumber_dana'
    )");

    if ($tambah) {
        $dt = mysqli_insert_id($con);
        $con->query("INSERT INTO barang VALUES (
            default,
            $dt,
            null,
            null
        )");
        $_SESSION['pesan'] = "Data Berhasil di Simpan";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal disimpan. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    }
}


?>