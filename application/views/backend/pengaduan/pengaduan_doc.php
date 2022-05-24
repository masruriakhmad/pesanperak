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
        <h2>Pengaduan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No Pengaduan</th>
		<th>Id Pelapor</th>
		<th>Id Korban</th>
		<th>Tempat Kejadian</th>
		<th>Id Desa</th>
		<th>Kronologi</th>
		<th>Tgl Kejadian</th>
		<th>Tgl Tindak Lanjut</th>
		<th>Note Tindak Lanjut</th>
		<th>Tgl Penyelesaian</th>
		<th>Note Penyelesaian</th>
		<th>Tgl Monitoring</th>
		<th>Note Monitoring</th>
		<th>Tgl Input</th>
		<th>Flag</th>
		<th>Id User</th>
		
            </tr><?php
            foreach ($pengaduan_data as $pengaduan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pengaduan->no_pengaduan ?></td>
		      <td><?php echo $pengaduan->id_pelapor ?></td>
		      <td><?php echo $pengaduan->id_korban ?></td>
		      <td><?php echo $pengaduan->tempat_kejadian ?></td>
		      <td><?php echo $pengaduan->id_desa ?></td>
		      <td><?php echo $pengaduan->kronologi ?></td>
		      <td><?php echo $pengaduan->tgl_kejadian ?></td>
		      <td><?php echo $pengaduan->tgl_tindak_lanjut ?></td>
		      <td><?php echo $pengaduan->note_tindak_lanjut ?></td>
		      <td><?php echo $pengaduan->tgl_penyelesaian ?></td>
		      <td><?php echo $pengaduan->note_penyelesaian ?></td>
		      <td><?php echo $pengaduan->tgl_monitoring ?></td>
		      <td><?php echo $pengaduan->note_monitoring ?></td>
		      <td><?php echo $pengaduan->tgl_input ?></td>
		      <td><?php echo $pengaduan->flag ?></td>
		      <td><?php echo $pengaduan->id_user ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>