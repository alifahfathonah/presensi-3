<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'barang';
include_once '../../template/sidebar.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-sitemap ml-1 mr-1"></i> Data Barang</h4>
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
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Data Barang</th>
                                            <th>Satuan</th>
                                            <th>Tanggal</th>
                                            <th>Sumber Dana</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan WHERE a.status IS NULL AND a.id_ruangan IS NULL ORDER BY b.tgl_pengadaan DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td>
                                                    <b>Kode</b> : <?= $row['kd_pengadaan'] ?><br>
                                                    <b>Barang</b> : <?= $row['nm_barang'] ?><br>
                                                </td>
                                                <td align="center"><?= $row['satuan'] ?></td>
                                                <td align="center"><?= tgl($row['tgl_pengadaan']) ?></td>
                                                <td align="center"><?= $row['sumber_dana'] ?></td>
                                                <td align="center" width="12%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn bg-olive btn-xs" title="Edit"><i class="fa fa-check-circle"></i> Verifikasi</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>

                            <hr>

                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Data Barang</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th>Kondisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan JOIN ruangan c ON a.id_ruangan = c.id_ruangan WHERE a.id_ruangan IS NOT NULL AND a.status IS NOT NULL ORDER BY b.tgl_pengadaan DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td>
                                                    <b>Kode</b> : <?= $row['kd_pengadaan'] ?><br>
                                                    <b>Barang</b> : <?= $row['nm_barang'] ?><br>
                                                </td>
                                                <td align="center"><?= tgl($row['tgl_pengadaan']) ?></td>
                                                <td align="center">Ruangan <?= $row['nm_ruangan'] ?></td>
                                                <td align="center">
                                                    <?php if ($row['status'] == 1) {
                                                        echo 'Baik';
                                                    } else {
                                                        echo 'Rusak';
                                                    } ?>
                                                </td>
                                                <td align="center" width="9%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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