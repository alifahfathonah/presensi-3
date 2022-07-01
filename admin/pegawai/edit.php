<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'pegawai';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM Pegawai WHERE id_pegawai ='$id'");
$row = $query->fetch_array();

$is_active = [
    '' => '---Pilih---',
    '1' => 'Aktif',
    '0' => 'Non Aktif',
];

$status = [
    '' => '---Pilih---',
    'ASN' => 'ASN',
    'Non ASN / Kontrak' => 'Non ASN / Kontrak',
];

$jk = [
    '' => '---Pilih---',
    'Laki - laki' => 'Laki - laki',
    'Perempuan' => 'Perempuan',
];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-id-badge ml-1 mr-1"></i> Edit Data pegawai</h4>
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
                                    <label class="col-sm-2 col-form-label">Nama pegawai</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nm_pegawai" value="<?= $row['nm_pegawai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nip" value="<?= $row['nip'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <select name="id_divisi" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM divisi ORDER BY id_divisi DESC"); ?>
                                            <?php foreach ($data as $d) :
                                                if ($d['id_divisi'] == $row['id_divisi']) { ?>
                                                    <option value="<?= $d['id_divisi']; ?>" selected="<?= $d['id_divisi']; ?>"><?= $d['nm_divisi'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_divisi'] ?>"><?= $d['nm_divisi'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan DESC"); ?>
                                            <?php foreach ($data as $d) :
                                                if ($d['id_jabatan'] == $row['id_jabatan']) { ?>
                                                    <option value="<?= $d['id_jabatan']; ?>" selected="<?= $d['id_jabatan']; ?>"><?= $d['nm_jabatan'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_jabatan'] ?>"><?= $d['nm_jabatan'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Kerja</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('status', $status, $row['status'], 'class="form-control" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">TMT</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tmt" value="<?= $row['tmt'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tmpt_lahir" value="<?= $row['tmpt_lahir'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_lahir" value="<?= $row['tgl_lahir'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('jk', $jk, $row['jk'], 'class="form-control" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="agama" value="<?= $row['agama'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="alamat" required><?= $row['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No. HP</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="hp" value="<?= $row['hp'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Pegawai</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('is_active', $is_active, $row['is_active'], 'class="form-control" required') ?>
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
    $nm_pegawai = $_POST['nm_pegawai'];
    $nip = $_POST['nip'];
    $id_divisi = $_POST['id_divisi'];
    $id_jabatan = $_POST['id_jabatan'];
    $status = $_POST['status'];
    $tmt = $_POST['tmt'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $is_active = $_POST['is_active'];

    $update = $con->query("UPDATE pegawai SET 
        nm_pegawai = '$nm_pegawai',
        nip = '$nip',
        id_divisi = '$id_divisi',
        id_jabatan = '$id_jabatan',
        status = '$status',
        tmt = '$tmt',
        tmpt_lahir = '$tmpt_lahir',
        tgl_lahir = '$tgl_lahir',
        jk = '$jk',
        agama = '$agama',
        alamat = '$alamat',
        hp = '$hp',
        is_active = '$is_active'
        WHERE id_pegawai = '$id'
    ");

    if ($update) {
        if ($is_active == 1) {
            $con->query("UPDATE user SET
                nm_user = '$nm_pegawai',
                username = '$nip'
                WHERE id_pegawai = '$id' 
            ");
        } else {
            $con->query("UPDATE user SET
                nm_user = '$nm_pegawai',
                username = '<i>Akun Dinonaktifkan<i>'
                WHERE id_pegawai = '$id' 
            ");
        }
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}


?>