<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'tugas';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM tugas WHERE id_tugas ='$id'");
$row = $query->fetch_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-briefcase ml-1 mr-1"></i> Edit Data Perintah Tugas</h4>
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
                                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['no_surat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Perihal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="perihal" value="<?= $row['perihal'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal & Jam</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>" required>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="time" class="form-control" name="jam" value="<?= $row['jam'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tempat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tempat" value="<?= $row['tempat'] ?>" required>
                                    </div>
                                </div>
                                <hr>
                                <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-secondary mb-2"><i class="fa fa-plus-circle"></i> Tambah Pegawai</a>
                                <input type="hidden" id="dataid" value="<?= $id; ?>">
                                <div id="data-pegawai">

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
<div class="modal fade" id="modal-tambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Pegawai </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah" method="POST" enctype="multipart/form-data" action="detail/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="id_tugas" value="<?= $id ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" id="id_pegawai" name="id_pegawai" required>
                                    <option disabled selected> -- Pilih -- </option>
                                    <?php
                                    $q = $con->query("SELECT * FROM pegawai p WHERE is_active = 1 ORDER BY nm_pegawai ASC");
                                    while ($d = $q->fetch_array()) {
                                    ?>
                                        <option value="<?= $d['id_pegawai'] ?>"><?= $d['nm_pegawai'] ?> | NIP. <?= $d['nip'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<?php
include_once '../../template/footer.php';
?>
<script>
    muncul();
    var data = "detail/tampil.php";

    function muncul() {
        $.post('detail/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-pegawai").html(data);
            }
        );
    }

    $("#form-tambah").submit(function(e) {
        e.preventDefault();

        var dataform = $("#form-tambah").serialize();
        $.ajax({
            url: "detail/simpan.php",
            type: "POST",
            data: dataform,
            success: function(result) {
                var hasil = JSON.parse(result);
                if (hasil.hasil == "sukses") {
                    $('#modal-tambah').modal('hide');
                    $("#id_pegawai").val('');
                    muncul();
                }
            }
        });
    });

    $(document).on('click', '#hapus', function(e) {
        e.preventDefault();
        $.post('detail/hapus.php', {
                id: $(this).attr('data-id')
            },
            function(html) {
                muncul();
            }
        );
    });
</script>
<?php
if (isset($_POST['submit'])) {
    $perihal = $_POST['perihal'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tempat = $_POST['tempat'];

    $update = $con->query("UPDATE tugas SET 
        perihal = '$perihal',
        tanggal = '$tanggal',
        jam = '$jam',
        tempat = '$tempat'
        WHERE id_tugas = '$id'
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