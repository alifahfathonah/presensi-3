<?php
include '../../app/config.php';

$no = 1;


if (isset($_POST['cetak1'])) {

    $tahun = $_POST['tahun'];

    $sql = mysqli_query($con, "SELECT * FROM pengadaan WHERE YEAR(tgl_pengadaan) = '$tahun' ORDER BY tgl_pengadaan ASC");

    $label = 'LAPORAN DATA PENGADAAN BARANG <br> Tahun Pengadaan : ' . $tahun;
} else {
    $sql = mysqli_query($con, "SELECT * FROM pengadaan ORDER BY tgl_pengadaan DESC");

    $label = 'LAPORAN DATA PENGADAAN BARANG';
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
    <title>Laporan Data Pengadaan Barang</title>
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
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Tanggal</th>
                            <th>Pengadaan Terhitung</th>
                            <th>Sumber Dana</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) {
                            $tgl = new DateTime($data['tgl_pengadaan']);
                            $today = new DateTime('today');
                            $y = $today->diff($tgl)->y;
                            $m = $today->diff($tgl)->m;
                            $d = $today->diff($tgl)->d;
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['kd_pengadaan'] ?></td>
                                <td><?= $data['nm_barang'] ?></td>
                                <td align="center"><?= $data['satuan'] ?></td>
                                <td align="center"><?= tgl($data['tgl_pengadaan']) ?></td>
                                <td align="center"><?= $y . " Tahun " . $m . " Bulan " . $d . " Hari" ?> Lalu</td>
                                <td align="center"><?= $data['sumber_dana'] ?></td>
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