<table class="table table-striped table-bordered">
    <thead class="bg-purple">
        <tr align="center">
            <th>
                <center>No</center>
            </th>
            <th>
                <center>Nama Pegawai</center>
            </th>
            <th>
                <center>NIP</center>
            </th>
            <th>
                <center>Jabatan</center>
            </th>
            <th>
                <center>Aksi</center>
            </th>
        </tr>
    </thead>

    <tbody>

        <?php
        include "../../../app/config.php";
        $no1 = 1;
        $id1 = $_POST['id'];

        $data1 = mysqli_query($con, "SELECT * FROM sub_tugas td LEFT JOIN pegawai p ON p.id_pegawai = td.id_pegawai JOIN jabatan j ON p.id_jabatan = j.id_jabatan WHERE id_tugas = '$id1' ");
        while ($tampil1 = mysqli_fetch_array($data1)) {
        ?>
            <tr>
                <td align="center"><?= $no1++; ?></td>
                <td><?= $tampil1['nm_pegawai'] ?></td>
                <td align="center"><?= $tampil1['nip'] ?></td>
                <td align="center"><?= $tampil1['nm_jabatan'] ?></td>
                <td align="center">
                    <a class="btn btn-xs btn-danger" href="#" id="hapus" data-id="<?= $tampil1[0]; ?>"> <i class="fa fa-trash"></i> Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>

</table>


<hr>