<?php
$izin = [
    '' => '-- Pilih --',
    'Izin' => 'Izin',
    'Cuti' => 'Cuti',
    'Sakit' => 'Sakit',
];

$sb = [
    '' => '-- Pilih --',
    '1' => 'Baik',
    '0' => 'Rusak',
];

?>
<div class="modal fade" id="lap_pegawai" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Pegawai</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/pegawai/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Berdasarkan Divisi</label>
                            <select name="divisi" class="form-control" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM divisi ORDER BY id_divisi ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_divisi'] ?>"><?= $row['nm_divisi'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="POST" target="_blank" action="<?= base_url('admin/pegawai/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Berdasarkan Jabatan</label>
                            <select name="jabatan" class="form-control" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_jabatan'] ?>"><?= $row['nm_jabatan'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak2" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/pegawai/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_rekap_presensi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Rekapitulasi Presensi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/absensi/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" required>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tahun</label>
                            <input type="number" class="form-control" required name="tahun" value="<?= date('Y') ?>">
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_presensi_pegawai" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Presensi Pegawai</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/absensi/cetak-pegawai') ?>">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label>Nama pegawai</label>
                            <select name="pegawai" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM pegawai ORDER BY nm_pegawai ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_pegawai'] ?>"><?= $row['nm_pegawai'] ?> | NIP. <?= $row['nip'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" required>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Tahun</label>
                            <input type="number" class="form-control" required name="tahun" value="<?= date('Y') ?>">
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_izin" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Izin pegawai</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/izin/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Jenis Izin</label>
                            <?= form_dropdown('izin', $izin, '', 'class="form-control" required') ?>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="POST" target="_blank" action="<?= base_url('admin/izin/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" required>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tahun</label>
                            <input type="number" class="form-control" required name="tahun" value="<?= date('Y') ?>">
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak2" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/izin/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_tugas" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Perintah Tugas</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/tugas/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control" required>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tahun</label>
                            <input type="number" class="form-control" required name="tahun" value="<?= date('Y') ?>">
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/tugas/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_pengadaan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Pengadaan Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/pengadaan/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Tahun Pengadaan</label>
                            <select name="tahun" class="form-control" required>
                                <?php
                                $query = $con->query("SELECT tgl_pengadaan FROM pengadaan GROUP BY year(tgl_pengadaan) ORDER BY tgl_pengadaan DESC");
                                echo "<option value=''> -- Pilih Tahun -- </option>";
                                while ($row = $query->fetch_array()) {
                                    $data = explode('-', $row['tgl_pengadaan']);
                                    $tahun = $data[0];
                                    echo "<option value='$tahun'>$tahun</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/pengadaan/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_barang" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/barang/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Status Barang</label>
                            <?= form_dropdown('status', $sb, '', 'class="form-control" required') ?>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="POST" target="_blank" action="<?= base_url('admin/barang/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Lokasi Ruangan</label>
                            <select name="ruangan" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php $data = $con->query("SELECT * FROM ruangan ORDER BY id_ruangan ASC"); ?>
                                <?php foreach ($data as $row) : ?>
                                    <option value="<?= $row['id_ruangan'] ?>"><?= $row['nm_ruangan'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak2" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/barang/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_rusak" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Kerusakan Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/rusak/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Tahun Kerusakan</label>
                            <select name="tahun" class="form-control" required>
                                <?php
                                $query = $con->query("SELECT tgl_rusak FROM rusak GROUP BY year(tgl_rusak) ORDER BY tgl_rusak DESC");
                                echo "<option value=''> -- Pilih Tahun -- </option>";
                                while ($row = $query->fetch_array()) {
                                    $data = explode('-', $row['tgl_rusak']);
                                    $tahun = $data[0];
                                    echo "<option value='$tahun'>$tahun</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/rusak/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="lap_mutasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Mutasi Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/mutasi/cetak') ?>">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label>Tahun Mutasi</label>
                            <select name="tahun" class="form-control" required>
                                <?php
                                $query = $con->query("SELECT tgl_mutasi FROM mutasi GROUP BY year(tgl_mutasi) ORDER BY tgl_mutasi DESC");
                                echo "<option value=''> -- Pilih Tahun -- </option>";
                                while ($row = $query->fetch_array()) {
                                    $data = explode('-', $row['tgl_mutasi']);
                                    $tahun = $data[0];
                                    echo "<option value='$tahun'>$tahun</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top: 31px;">
                            <button type="submit" name="cetak1" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="col-md-12 text-center">
                    <a href="<?= base_url('admin/mutasi/cetak') ?>" target="_blank" class="btn bg-purple btn-sm"><i class="fa fa-print"> </i> Cetak Semua </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>