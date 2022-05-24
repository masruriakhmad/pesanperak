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
        <h2>Korban List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Korban</th>
		<th>Id Agama</th>
		<th>Id Desa</th>
		<th>Alamat Korban</th>
		<th>No Hp Korban</th>
		
            </tr><?php
            foreach ($korban_data as $korban)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $korban->nama_korban ?></td>
		      <td><?php echo $korban->id_agama ?></td>
		      <td><?php echo $korban->id_desa ?></td>
		      <td><?php echo $korban->alamat_korban ?></td>
		      <td><?php echo $korban->no_hp_korban ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>