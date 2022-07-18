<?php

include '../../../app/config.php';

$tugas    = $_POST['id_tugas'];
$pegawai   = $_POST['id_pegawai'];

$tambah = $con->query("INSERT INTO sub_tugas VALUES (
            default,
            '$tugas', 
            '$pegawai'
        )");

if ($tambah) {
    $data['hasil'] = 'sukses';
} else {

    $data['hasil'] = 'gagal';
}

echo json_encode($data);
