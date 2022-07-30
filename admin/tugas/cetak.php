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

if (isset($_POST['cetak1'])) {

    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $sql = mysqli_query($con, "SELECT * FROM tugas WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' ORDER BY tanggal ASC");
    $label = 'LAPORAN DATA PERINTAH TUGAS <br> Bulan : ' . $bln[date($bulan)] . ' ' . $tahun;
} else {
    $sql = mysqli_query($con, "SELECT * FROM tugas ORDER BY tanggal DESC");
    $label = 'LAPORAN DATA PERINTAH TUGAS';
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
    <title>Laporan Data Perintah Tugas</title>
</head>

<style>
    th {
        color: white;
    }

    th.black {
        color: black;
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
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Hari/Tanggal</th>
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Yang Bertugas</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['no_surat'] ?></td>
                                <td align="center"><?= $data['perihal'] ?></td>
                                <td align="center"><?= tgl_indo($data['tanggal']) ?></td>
                                <td align="center"><?= $data['jam'] ?> WITA</td>
                                <td align="center" width="20%"><?= $data['tempat'] ?></td>
                                <td align="center">
                                    <table border="1" cellspacing="0" cellpadding="6">
                                        <tr>
                                            <th class="black">Nama</th>
                                            <th class="black">NIP</th>
                                        </tr>
                                        <?php
                                        $q = $con->query("SELECT * FROM sub_tugas td JOIN pegawai p ON p.id_pegawai = td.id_pegawai WHERE td.id_tugas = '$data[id_tugas]' ");
                                        while ($d = $q->fetch_array()) { ?>
                                            <tr>
                                                <td><?= $d['nm_pegawai'] ?></td>
                                                <td align="center"><?= $d['nip'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
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