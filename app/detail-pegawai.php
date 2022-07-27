<?php
require 'configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>

<form action="#" method="POST" target="blank">
    <div id="id<?= $id = $row[0]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button> -->
                    <h5 class="modal-title" id="custom-width-modalLabel"> <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-info-circle"></i></button> Detail Data Pegawai</h5>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                </div>
                <?php
                $q = $con->query("SELECT * FROM pegawai a JOIN divisi b ON a.id_divisi = b.id_divisi JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE id_pegawai = '$id' ");
                $d = $q->fetch_array();
                $tgl = new DateTime($d['tgl_lahir']);
                $tmt = new DateTime($d['tmt']);
                $today = new DateTime('today');
                $y = $today->diff($tgl)->y;
                $ytmt = $today->diff($tmt)->y;
                ?>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card-body" style="text-align: left;">
                                <dl class="row">
                                    <dt class="col-sm-3">Nama Pegawai</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_pegawai'] ?></dd>
                                    <dt class="col-sm-3">NIP</dt>
                                    <dd class="col-sm-9">: <?= $d['nip'] ?></dd>
                                    <dt class="col-sm-3">Divisi</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_divisi'] ?></dd>
                                    <dt class="col-sm-3">Jabatan</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_jabatan'] ?></dd>
                                    <dt class="col-sm-3">Status Kerja</dt>
                                    <dd class="col-sm-9">: <?= $d['status'] ?></dd>
                                    <dt class="col-sm-3">TMT</dt>
                                    <dd class="col-sm-9">: <?= tgl($d['tmt']) ?></dd>
                                    <dt class="col-sm-3">Scan Ijazah Terakhir</dt>
                                    <dd class="col-sm-9">: <a href="<?= base_url() ?>/scan-ijazah/<?= $d['scan_ijazah'] ?>" class="btn btn-xs bg-purple" target="_BLANK"><i class="fa fa-file-alt mr-1"></i> Lihat File</a></dd>
                                    <dt class="col-sm-3">Lama Kerja</dt>
                                    <dd class="col-sm-9">: <?= $ytmt . ' Tahun'; ?></dd>
                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                    <dd class="col-sm-9">: <?= $d['tmpt_lahir'] ?></dd>
                                    <dt class="col-sm-3">Tanggal Lahir</dt>
                                    <dd class="col-sm-9">: <?= tgl($d['tgl_lahir']) ?></dd>
                                    <dt class="col-sm-3">Usia</dt>
                                    <dd class="col-sm-9">: <?= $y . ' Tahun'; ?></dd>
                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                    <dd class="col-sm-9">: <?= $d['jk'] ?></dd>
                                    <dt class="col-sm-3">Agama</dt>
                                    <dd class="col-sm-9">: <?= $d['agama'] ?></dd>
                                    <dt class="col-sm-3">Alamat</dt>
                                    <dd class="col-sm-9">: <?= $d['alamat'] ?></dd>
                                    <dt class="col-sm-3">No HP</dt>
                                    <dd class="col-sm-9">: <?= $d['hp'] ?></dd>
                                    <dt class="col-sm-3">Status Pegawai</dt>
                                    <dd class="col-sm-9">:
                                        <?php if ($d['is_active'] == 1) {
                                            echo 'Aktif';
                                        } else {
                                            echo 'Non Aktif';
                                        } ?>
                                    </dd>
                                </dl>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>