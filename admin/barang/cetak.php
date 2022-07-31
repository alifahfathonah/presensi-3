<?php
include '../../app/config.php';

$no = 1;


if (isset($_POST['cetak1'])) {

    $sb = $_POST['status'];

    if ($sb == 1) {
        $kondisi = 'Baik';
    } else {
        $kondisi = 'Rusak';
    }

    $sql = mysqli_query($con, "SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan JOIN ruangan c ON a.id_ruangan = c.id_ruangan WHERE a.id_ruangan IS NOT NULL AND a.status = '$sb' ORDER BY b.tgl_pengadaan DESC");

    $label = 'LAPORAN DATA BARANG <br> Kondisi : ' . $kondisi;
} else if (isset($_POST['cetak2'])) {

    $ruangan = $_POST['ruangan'];

    $sql = mysqli_query($con, "SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan JOIN ruangan c ON a.id_ruangan = c.id_ruangan WHERE a.id_ruangan = '$ruangan' ORDER BY b.tgl_pengadaan DESC");
    $dt = $con->query("SELECT * FROM ruangan WHERE id_ruangan = '$ruangan' ")->fetch_array();
    $label = 'LAPORAN DATA BARANG <br> Lokasi Ruangan : ' . $dt['nm_ruangan'];
} else {
    $sql = mysqli_query($con, "SELECT * FROM barang a JOIN pengadaan b ON a.id_pengadaan = b.id_pengadaan JOIN ruangan c ON a.id_ruangan = c.id_ruangan WHERE a.id_ruangan IS NOT NULL AND a.status IS NOT NULL ORDER BY b.tgl_pengadaan DESC");

    $label = 'LAPORAN DATA BARANG';
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
    <title>Laporan Data Barang</title>
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
                            <th>Tanggal Pengadaan</th>
                            <th>Sumber Dana</th>
                            <th>Ruangan</th>
                            <th>Kondisi Barang</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['kd_pengadaan'] ?></td>
                                <td><?= $data['nm_barang'] ?></td>
                                <td align="center"><?= $data['satuan'] ?></td>
                                <td align="center"><?= tgl($data['tgl_pengadaan']) ?></td>
                                <td align="center"><?= $data['sumber_dana'] ?></td>
                                <td align="center"><?= $data['nm_ruangan'] ?></td>
                                <td align="center">
                                    <?php if ($data['status'] == 1) {
                                        echo 'Baik';
                                    } else {
                                        echo 'Rusak';
                                    } ?>
                                </td>
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