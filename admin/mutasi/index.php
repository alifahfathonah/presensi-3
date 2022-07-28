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
                    <h4 class="m-0 text-dark"><i class="fas fa-people-carry ml-1 mr-1"></i> Data Mutasi Barang</h4>
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
                                            <th>Nomor SK</th>
                                            <th>Data Barang</th>
                                            <th>Lokasi Sekarang</th>
                                            <th>Lokasi Lama</th>
                                            <th>Tanggal Mutasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM mutasi a JOIN barang b ON a.id_barang = b.id_barang JOIN pengadaan c ON b.id_pengadaan = c.id_pengadaan JOIN ruangan d ON a.id_ruangan = d.id_ruangan ORDER BY tgl_mutasi DESC");
                                        while ($row = $data->fetch_array()) {
                                            $tgl = new DateTime($row['tgl_mutasi']);
                                            $today = new DateTime('today');
                                            $y = $today->diff($tgl)->y;
                                            $m = $today->diff($tgl)->m;
                                            $d = $today->diff($tgl)->d;
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['no_surat'] ?></td>
                                                <td>
                                                    <b>Kode</b> : <?= $row['kd_pengadaan'] ?><br>
                                                    <b>Nama</b> : <?= $row['nm_barang'] ?><br>
                                                    <b>Tanggal</b> : <?= tgl($row['tgl_pengadaan']) ?>
                                                </td>
                                                <td align="center">Ruangan <?= $row['nm_ruangan'] ?></td>
                                                <td align="center">
                                                    <?php $r = $con->query("SELECT * FROM ruangan WHERE id_ruangan = '$row[id_ruangan_old]' ")->fetch_array();
                                                    echo 'Ruangan ' . $r['nm_ruangan'];
                                                    ?>
                                                </td>
                                                <td align="center">
                                                    <?= tgl($row['tgl_mutasi']) ?>
                                                    <hr>
                                                    Terhitung : <?= $y . " Tahun " . $m . " Bulan " . $d . " Hari" ?> Lalu
                                                </td>
                                                <td align="center" width="9%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i> </a>
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