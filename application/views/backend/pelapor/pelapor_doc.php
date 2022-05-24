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
        <h2>Pelapor List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Pelapor</th>
		<th>Id Agama</th>
		<th>Id Desa</th>
		<th>Alamat Pelapor</th>
		<th>No Hp Pelapor</th>
		
            </tr><?php
            foreach ($pelapor_data as $pelapor)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pelapor->nama_pelapor ?></td>
		      <td><?php echo $pelapor->id_agama ?></td>
		      <td><?php echo $pelapor->id_desa ?></td>
		      <td><?php echo $pelapor->alamat_pelapor ?></td>
		      <td><?php echo $pelapor->no_hp_pelapor ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>