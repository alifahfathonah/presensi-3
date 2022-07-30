<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'absensi';
include_once '../../template/sidebar.php';
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
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Data Pegawai</th>
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai ORDER BY id_absensi DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td>
                                                    <b>Nama</b> : <?= $row['nm_pegawai'] ?><br>
                                                    <b>NIP</b> : <?= $row['nip'] ?>
                                                </td>
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