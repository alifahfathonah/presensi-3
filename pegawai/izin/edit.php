<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'izin';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM izin WHERE id_izin ='$id'");
$row = $query->fetch_array();

$jns = [
    '' => '-- Pilih --',
    'Izin' => 'Izin',
    'Cuti' => 'Cuti',
    'Sakit' => 'Sakit',
];

$user = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]'")->fetch_array();
$absen = $user['id_pegawai'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-file-signature ml-1 mr-1"></i> Edit Data Izin</h4>
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
                                    <label class="col-sm-2 col-form-label">Jenis Izin</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('sts_izin', $jns, $row['sts_izin'], 'class="form-control" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ket_izin" value="<?= $row['ket_izin'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File Izin</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".pdf,.PDF" class="form-control" name="file_izin">
                                        <label style='color: red; font-style: italic; font-size: 12px;'>* Biarkan Kosong jika File tidak di ubah</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_mulai" value="<?= $row['tgl_mulai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_selesai" value="<?= $row['tgl_selesai'] ?>" required>
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
    $sts_izin = $_POST['sts_izin'];
    $ket_izin = $_POST['ket_izin'];

    $f_file_izin = "";

    if (!empty($_FILES['file_izin']['name'])) {
        $filelama = $row['file_izin'];

        // UPLOAD FILE 
        $file      = $_FILES['file_izin']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $file_izin = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['file_izin']['size'];
        $tmp_file  = $_FILES['file_izin']['tmp_name'];
        $dir_file  = '../../file-izin/';
        $allow_ext        = array('pdf', 'PDF');
        $allow_size       = 2097152;
        // var_dump($file_izin); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $file_izin);
                if (file_exists($dir_file . $filelama)) {
                    unlink($dir_file . $filelama);
                }
                $f_file_izin .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        swal({
                            title: '',
                            text:  'Ukuran Foto Terlalu Besar, Maksimal 2 Mb',
                            type: 'warning',
                            timer: 3000,
                            showConfirmButton: true
                        });     
                    },10);   
                    window.setTimeout(function(){ 
                        window.location.replace('tambah');
                    } ,2000); 
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {    
                    swal({
                        title: 'Format File Tidak Didukung',
                        text:  'File Harus Berupa PDF',
                        type: 'warning',
                        timer: 3000,
                        showConfirmButton: true
                    });     
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('tambah');
                } ,2000);  
            </script>";
        }
    } else {
        $file_izin = $row['file_izin'];
        $f_file_izin .= "Upload Success!";
    }

    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];

    if (!empty($f_file_izin)) {
        $update = $con->query("UPDATE izin SET 
            sts_izin = '$sts_izin', 
            ket_izin = '$ket_izin',
            file_izin = '$file_izin',
            tgl_mulai = '$tgl_mulai',
            tgl_selesai = '$tgl_selesai'
            WHERE id_izin = '$id'
        ");

        $con->query("DELETE FROM absensi WHERE id_izin = '$id' ");

        $start = strtotime($tgl_mulai);
        $end = strtotime($tgl_selesai);

        // Loop between timestamps, 24 hours at a time
        for ($i = $start; $i <= $end; $i = $i + 86400) {
            $thisDate = date('Y-m-d', $i);
            $con->query("INSERT INTO absensi VALUES (
                default,
                '$absen', 
                '$id',
                '$thisDate',
                '-',
                null,
                null,
                '$sts_izin'
            )");
        }

        if ($update) {
            $_SESSION['pesan'] = "Data Berhasil di Update";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal diubah. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
        }
    }
}


?>