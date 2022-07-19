<?php
include_once '../../app/config.php';

$id = $_GET['id'];
$data = $con->query("SELECT * FROM tugas WHERE id_tugas = '$id'");
$row = $data->fetch_array();

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
ob_start();
?>

<html>

<head>
    <title>Surat Perintah Tugas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">

</head>

<body bgcolor="#FFFFFF">
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="90">
                </td>
                <td align="center">
                    <h4>PEMERINTAH KOTA BANJARMASIN</h4>
                    <h3>DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</h3>
                    <h6>Jl. RE Martadinata, Telawang, Banjarmasin Barat, Kota Banjarmasin, <br> Kalimantan Selatan Kode Pos 70231</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="90">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">
    <table width="670" border="0" cellspacing="2" cellpadding="2" align="center">
        <tr>
            <td align="center">
                <h4><b>SURAT PERINTAH TUGAS</b><br>
                </h4>
            </td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td style="text-align: right;">Banjarmasin, <?= tgl(date('Y-m-d')); ?></td>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <div align="left">
                <td>
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                        <tr>
                            <td width="13%">Nomor</td>
                            <td width="70%">: <?= $row['no_surat'] ?></td>
                        </tr>
                        <tr>
                            <td width="13%">Hal</td>
                            <td width="70%">: Perintah Tugas</td>
                        </tr>
                    </table>
                </td>
            </div>
        </tr>
        <tr>
            <td>&nbsp;<br></td>
        </tr>
        <tr>
            <td>&nbsp;<br>
            </td>
        </tr>
        <tr>
            <div align="left">
                <td>Kepala Dinas Komunikasi, Informatika dan Statistik Kota Banjarmasin memberi perintah tugas kepada :</td>
            </div>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    $qry = $con->query("SELECT * FROM sub_tugas td JOIN pegawai p ON p.id_pegawai = td.id_pegawai JOIN divisi d ON d.id_divisi = p.id_divisi JOIN jabatan j ON p.id_jabatan = j.id_jabatan WHERE td.id_tugas = '$id' ORDER BY td.id_sub_tugas ASC");
                    while ($data2 = $qry->fetch_array()) {
                    ?>
                        <tr>
                            <td width="1%">&nbsp;</td>
                            <td width="29%">N a m a</td>
                            <td width="70%">: <?= $data2['nm_pegawai'] ?> </td>
                        </tr>
                        <tr>
                            <td width="1%">&nbsp;</td>
                            <td width="29%">NIP</td>
                            <td width="70%">: <?= $data2['nip'] ?> </td>
                        </tr>
                        <tr>
                            <td width="1%">&nbsp;</td>
                            <td width="29%">Divisi</td>
                            <td width="70%">: <?= $data2['nm_divisi'] ?></td>
                        </tr>
                        <tr>
                            <td width="1%">&nbsp;</td>
                            <td width="29%">Jabatan</td>
                            <td width="70%">: <?= $data2['nm_jabatan'] ?>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">Untuk melakukan <?= $row['perihal'] ?> pada :</td><br><br>
        </tr>
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td width="20%">Hari</td>
                <td width="5%">:</td>
                <td width="75%"><?= hari($row['tanggal']) ?></td>
            <tr>
            <tr>
                <td width="20%">Tanggal</td>
                <td width="5%">:</td>
                <td width="75%"><?= tgl($row['tanggal']) ?></td>
            <tr>
            <tr>
                <td width="20%">Jam</td>
                <td width="5%">:</td>
                <td width="75%"><?= $row['jam'] . " WITA" ?></td>
            <tr>
            <tr>
                <td width="20%">Tempat</td>
                <td width="5%">:</td>
                <td width="75%"><?= $row['tempat'] ?></td>
            </tr>
        </table>

        <tr>
            <td>&nbsp;<br><br><br></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="60%"></td>
                        <td width="10%"></td>
                        <td width="30%" align="center">Disetujui oleh,</td>
                    </tr>
                    <tr>
                        <td width="60%"><br>
                            <p class="signature"></p>
                        </td>

                        <td width="30%"><br><br><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td width="60%"></td>
                        <td width="10%"></td>
                        <td width="30%"></td>
                    </tr>
                    <tr>
                        <td width="60%" align="left">

                        </td>
                        <td width="10%"></td>
                        <td width="30%" align="left">
                            <p style="text-align: center;"><br></p>
                            <hr size="1" width="80%" color="#000000">
                        </td>
                    </tr>
                    <tr>
                        <td width="60%"></td>
                        <td width="10%"></td>
                        <td width="30%" align="center">Kepala DISKOMINFOTIK <br> Kota Banjarmasin</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

        </tr>
    </table>

</body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>