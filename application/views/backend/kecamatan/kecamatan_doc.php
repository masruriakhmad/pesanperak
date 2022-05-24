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
        <h2>Kecamatan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Kabupaten</th>
		<th>Nama Kecamatan</th>
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
            foreach ($kecamatan_data as $kecamatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kecamatan->id_kabupaten ?></td>
		      <td><?php echo $kecamatan->nama_kecamatan ?></td>
		      <td><?php echo $kecamatan->col1 ?></td>
		      <td><?php echo $kecamatan->col2 ?></td>
		      <td><?php echo $kecamatan->col3 ?></td>
		      <td><?php echo $kecamatan->col4 ?></td>
		      <td><?php echo $kecamatan->col5 ?></td>
		      <td><?php echo $kecamatan->created_at ?></td>
		      <td><?php echo $kecamatan->created_by ?></td>
		      <td><?php echo $kecamatan->updated_at ?></td>
		      <td><?php echo $kecamatan->updated_by ?></td>
		      <td><?php echo $kecamatan->isactive ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>