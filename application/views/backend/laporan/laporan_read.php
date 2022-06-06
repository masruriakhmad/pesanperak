<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Cetak Data Pengaduan</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        <a href="<?php echo site_url('Laporan/') ?>" class="btn btn-default"><i class='fa fa-reply fa-2x'></i></a>
        <a href="<?php echo site_url('laporan/laporan_print/'.$id_pengaduan)?>" class="btn btn-warning" target="_blank"><i class='fa fa-print fa-2x'></i></a>
        <table class="table">
	    <tr><td>No Pengaduan</td><td><b><?php echo $no_pengaduan; ?></b></td></tr>
	    
	    <tr><td><h4><b>DATA PELAPOR</b></h4></td><td></td></tr>
	    <tr><td>NIK Pelapor</td><td><?php echo $nik_pelapor; ?></td></tr>
	    <tr><td>Nama Pelapor</td><td><?php echo $nama_pelapor; ?></td></tr>
	    <tr><td>Agama Pelapor</td><td><?php echo $nama_agama_pelapor; ?></td></tr>
	    <tr><td>Alamat Pelapor</td><td><?php echo $alamat_pelapor; ?></td></tr>
	    <tr><td>Kecamatan Pelapor</td><td><?php echo $nama_kecamatan_pelapor; ?></td></tr>
	    <tr><td>Desa Pelapor</td><td><?php echo $nama_desa_pelapor; ?></td></tr>
	    
	    <tr><td><h4><b>DATA KORBAN</b></h4></td><td></td></tr>
	    <tr><td>NIK Korban</td><td><?php echo $nik_korban; ?></td></tr>
	    <tr><td>Nama Korban</td><td><?php echo $nama_korban; ?></td></tr>
	    <tr><td>Agama Korban</td><td><?php echo $nama_agama_korban; ?></td></tr>
	    <tr><td>Alamat Korban</td><td><?php echo $alamat_korban; ?></td></tr>
	    <tr><td>Kecamatan Korban</td><td><?php echo $nama_kecamatan_korban; ?></td></tr>
	    <tr><td>Desa Korban</td><td><?php echo $nama_desa_korban; ?></td></tr>

	    <tr><td><h4><b>DATA KEJADIAN</b></h4></td><td></td></tr>
	    <tr><td>Tempat Kejadian</td><td><?php echo $tempat_kejadian; ?></td></tr>
	    <tr><td>Desa Kejadian</td><td><?php echo $nama_desa_kejadian; ?></td></tr>
	    <tr><td>Kecamatan Kejadian</td><td><?php echo $nama_kecamatan_kejadian; ?></td></tr>
	    <tr><td>Kronologi</td><td><?php echo $kronologi; ?></td></tr>
	    <tr><td>Tanggal Kejadian</td><td><?php echo $tgl_kejadian; ?></td></tr>

	    <tr><td><h4><b>DATA TINDAK LANJUT</b></h4></td><td></td></tr>
	    <tr><td>Tanggal Tindak Lanjut</b></h4></td><td><?php echo $tgl_tindak_lanjut; ?></td></tr>
	    <tr><td>Note Tindak Lanjut</td><td><?php echo $note_tindak_lanjut; ?></td></tr>
	    <tr><td>Tanggal Penyelesaian</td><td><?php echo $tgl_penyelesaian; ?></td></tr>
	    <tr><td>Note Penyelesaian</td><td><?php echo $note_penyelesaian; ?></td></tr>
	    <tr><td>Tanggal Monitoring</td><td><?php echo $tgl_monitoring; ?></td></tr>
	    <tr><td>Note Monitoring</td><td><?php echo $note_monitoring; ?></td></tr>

	    <tr><td><h4><b>KETERANGAN</b></h4></td><td></td></tr>
	    <tr><td>Tanggal Input</td><td><?php echo $tgl_input; ?></td></tr>
	    <tr><td>Status</td><td><h4><?php echo $nama_flag; ?></h4></td></tr>
	    <!--
	    <tr><td>Dibuat Oleh</td><td><?php echo $id_user; ?></td></tr>
	-->
	<!--
	   <tr><td></td><td><a href="<?php echo site_url('pengaduan') ?>" class="btn btn-default">Cancel</a></td>
		<td></td><td><a href="<?php echo site_url('pengaduan') ?>" class="btn btn-default">Cancel</a></td></tr>
	-->
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>