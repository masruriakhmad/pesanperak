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
        <h2>Desa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kecamatan</th>
		<th>Nama Desa</th>
		<th>Col1</th>
		<th>Col2</th>
		<th>Col3</th>
		<th>Col4</th>
		<th>Col5</th>
		<th>Created At</th>
		<th>Created By</th>
		<th>Updated At</th>
		<th>Updated By</th>
		<th>Isactive</th>
		
            </tr><?php
            foreach ($desa_data as $desa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $desa->id_kecamatan ?></td>
		      <td><?php echo $desa->nama_desa ?></td>
		      <td><?php echo $desa->col1 ?></td>
		      <td><?php echo $desa->col2 ?></td>
		      <td><?php echo $desa->col3 ?></td>
		      <td><?php echo $desa->col4 ?></td>
		      <td><?php echo $desa->col5 ?></td>
		      <td><?php echo $desa->created_at ?></td>
		      <td><?php echo $desa->created_by ?></td>
		      <td><?php echo $desa->updated_at ?></td>
		      <td><?php echo $desa->updated_by ?></td>
		      <td><?php echo $desa->isactive ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>