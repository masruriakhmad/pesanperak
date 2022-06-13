<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Penduduk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nik</th>
		<th>Nama</th>
		<th>Id Agama</th>
		<th>Alamat</th>
		<th>No Hp</th>
		<th>Id Desa</th>
		<th>Pelapor</th>
		<th>Korban</th>
		<th>Pelaku</th>
		<th>Foto Ktp</th>
		<th>Foto Ybs</th>
		<th>Create By</th>
		<th>Create At</th>
		<th>Is Active</th>
		
            </tr><?php
            foreach ($penduduk_data as $penduduk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $penduduk->nik ?></td>
		      <td><?php echo $penduduk->nama ?></td>
		      <td><?php echo $penduduk->id_agama ?></td>
		      <td><?php echo $penduduk->alamat ?></td>
		      <td><?php echo $penduduk->no_hp ?></td>
		      <td><?php echo $penduduk->id_desa ?></td>
		      <td><?php echo $penduduk->pelapor ?></td>
		      <td><?php echo $penduduk->korban ?></td>
		      <td><?php echo $penduduk->pelaku ?></td>
		      <td><?php echo $penduduk->foto_ktp ?></td>
		      <td><?php echo $penduduk->foto_ybs ?></td>
		      <td><?php echo $penduduk->create_by ?></td>
		      <td><?php echo $penduduk->create_at ?></td>
		      <td><?php echo $penduduk->is_active ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>