<?php
include '../../app/config.php';

$no = 1;

if (isset($_POST['cetak1'])) {

    $divisi = $_POST['divisi'];
    $cekdivisi = isset($divisi);
    if ($divisi == $cekdivisi) {
        $sql = mysqli_query($con, "SELECT * FROM pegawai a JOIN divisi b ON a.id_divisi = b.id_divisi JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_divisi = '$divisi' ORDER BY tmt DESC");
        $dt = $con->query("SELECT * FROM divisi WHERE id_divisi = '$divisi'")->fetch_array();
        $label = 'LAPORAN DATA PEGAWAI <br> Divisi : ' . $dt['nm_divisi'];
    }
} else if (isset($_POST['cetak2'])) {
    $jabatan = $_POST['jabatan'];
    $cekjabatan = isset($jabatan);
    if ($jabatan == $cekjabatan) {
        $sql = mysqli_query($con, "SELECT * FROM pegawai a JOIN divisi b ON a.id_divisi = b.id_divisi JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_jabatan = '$jabatan' ORDER BY tmt DESC");
        $dt = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$jabatan'")->fetch_array();
        $label = 'LAPORAN DATA PEGAWAI <br> Jabatan : ' . $dt['nm_jabatan'];
    }
} else {
    $sql = mysqli_query($con, "SELECT * FROM pegawai a JOIN divisi b ON a.id_divisi = b.id_divisi JOIN jabatan c ON a.id_jabatan = c.id_jabatan ORDER BY tmt DESC");
    $label = 'LAPORAN DATA PEGAWAI';
}

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pegawai</title>
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
                            <th>TMT</th>
                            <th>Lama Kerja</th>
                            <th>TTL</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) {
                            $tgl = new DateTime($data['tgl_lahir']);
                            $tmt = new DateTime($data['tmt']);
                            $today = new DateTime('today');
                            $y = $today->diff($tgl)->y;
                            $ytmt = $today->diff($tmt)->y;
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_pegawai'] ?><br>
                                    <b>NIP</b> : <?= $data['nip'] ?><br>
                                    <b>Status</b> : <?= $data['status'] ?>
                                </td>
                                <td align="center"><?= $data['nm_divisi'] ?></td>
                                <td align="center"><?= $data['nm_jabatan'] ?></td>
                                <td align="center"><?= tgl($data['tmt']) ?></td>
                                <td align="center"><?= $ytmt . ' Tahun' ?></td>
                                <td align="center"><?= $data['tmpt_lahir'] . ', ' . tgl($data['tgl_lahir']) ?></td>
                                <td align="center"><?= $y . ' Usia' ?></td>
                                <td align="center"><?= $data['jk'] ?></td>
                                <td align="center"><?= $data['agama'] ?></td>
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