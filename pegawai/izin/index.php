<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'izin';
include_once '../../template/sidebar.php';

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
                    <h4 class="m-0 text-dark"><i class="fa fa-file-signature ml-1 mr-1"></i> Data Izin</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="tambah" class="btn btn-sm bg-dark"><i class="fa fa-plus-circle"> Tambah Data</i></a>
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
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Jenis Izin</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM izin WHERE id_pegawai = '$absen' ORDER BY id_izin DESC");
                                        while ($row = $data->fetch_array()) {
                                            $tgl1 = $row['tgl_mulai'];
                                            $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                                            $a = date_create($tgl2);
                                            $b = date_create($row['tgl_selesai']);
                                            $diff = date_diff($a, $b);
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['sts_izin'] ?></td>
                                                <td><?= $row['ket_izin'] ?></td>
                                                <td align="center">
                                                    <?= tgl($row['tgl_mulai']) . ' s/d ' . tgl($row['tgl_selesai']) ?><br>
                                                    Lama Izin : <?= $diff->d . ' Hari' ?>
                                                </td>
                                                <td align="center"><a href="<?= base_url() ?>/file-izin/<?= $row['file_izin'] ?>" target="_BLANK" class="btn btn-xs btn-primary"><i class="fa fa-file fa-sm"></i> Lihat</a></td>
                                                <td align="center" width="18%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
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