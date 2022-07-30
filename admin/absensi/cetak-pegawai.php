<?php
include '../../app/config.php';

$no = 1;

$bln = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

if (isset($_POST['cetak'])) {

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $pegawai = $_POST['pegawai'];

    $sql = mysqli_query($con, "SELECT * FROM absensi a LEFT JOIN pegawai b ON a.id_pegawai = b.id_pegawai JOIN divisi c ON b.id_divisi = c.id_divisi JOIN jabatan d ON b.id_jabatan = d.id_jabatan WHERE a.id_pegawai = '$pegawai' AND MONTH(a.tanggal) = '$bulan' AND YEAR(a.tanggal) = '$tahun' ORDER BY a.tanggal ASC");
    $dt = $con->query("SELECT * FROM pegawai WHERE id_pegawai = '$pegawai'")->fetch_array();
    $label = 'LAPORAN DATA PRESENSI PEGAWAI <br> Nama Pegawai : ' . $dt['nm_pegawai'] . ' <br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun;
}

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Presensi Pegawai</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="75">
                </td>
                <td align="center">
                    <h4>PEMERINTAH KOTA BANJARMASIN</h4>
                    <h2>DINAS KOMUNIKASI DAN INFORMATIKA STATISTIK</h2>
                    <h6>Jl. RE Martadinata, Telawang, Banjarmasin Barat, Kota Banjarmasin, Kalimantan Selatan Kode Pos 70231</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="75">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#007BFF" align="center">
                            <th>No</th>
                            <th>Data Pegawai</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Tanggal</th>
                            <th>Jam Absen</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_pegawai'] ?><br>
                                    <b>NIP</b> : <?= $data['nip'] ?><br>
                                    <b>Status</b> : <?= $data['status'] ?>
                                </td>
                                <td align="center"><?= $data['nm_divisi'] ?></td>
                                <td align="center"><?= $data['nm_jabatan'] ?></td>
                                <td align="center"><?= tgl($data['tanggal']) ?></td>
                                <td align="center"><?= $data['jam'] ?></td>
                                <td align="center"><?= $data['sts'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="85%">
                </td>
                <td align="center">
                    <h6>
                        <?= tgl_indo(date('Y-m-d')) ?><br>
                        Banjarmasin <br>
                        <br><br><br><br>
                        <u>Kepala DISKOMINFOTIK</u><br>
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>