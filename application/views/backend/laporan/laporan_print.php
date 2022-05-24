<!doctype html>

<html>
    <head>
        <title></title>
        <style type ="text/css">
            body{
            	font-family:  arial; 
            	background-color: #ccc
            } 
            .rangkasurat {
            	margin: 0;
            	border: initial;
            	border-radius: initial;
           		width: initial;
            	min-height: initial;
            	box-shadow: initial;
            	background: initial;
            	page-break-after: always;
            }
            .table{
            	border-bottom: 3px solid #000; 
            	padding:  2px
            }
            .tengah{
            	text-align: center;
            	line-height: 8px
            }

            @page {
        		size: A4;
        		margin: 0 auto;
    		}
    		@media print {
        	html, body {
            width: 210mm;
            height: 297mm;        
        }
        </style>

    </head>
    <body>
    	<div class="rangkasurat">
            <table border="0" class="table" width="100%">
                <tr>
                    <td><img src="<?=base_url()?>uploads/logo/logo_instansi.png" width="70px" height="100px"></td>
                    <td class="tengah">
                        <h2>PEMERINTAH KABUPATEN TEMANGGUNG</h2>
                        <h3>DINAS PENGENDALIAN PENDUDUK, KELUARGA BERENCANA,</h3>
						<h3>PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</h3>
                        <p>Jln. Jend. Sudirman No. 41-42  Temanggung Kode Pos 56216 Telp. (0293) 4961389
                        	<br><br>
                        Surat elektronik : kominfo@temanggungkab.go.id 
                    	<br>
                    	<br>
                    Laman:kominfo.temanggungkab.go.id</p>
                    </td>
                </tr>
            </table>

            <table border="0" width="100%" >
	    <tr>
	    	<th width="25%"></th>
	    	<th width="50%"><b><u><h4>NOMOR PENGADUAN : <?php echo $no_pengaduan; ?></h4></u></b></th>
	    	<th width="25%"></th>
	    	
	    </tr>
	    
	    <tr>
	    	<td><b>DATA PELAPOR</b></td>
	    	<td></td><td rowspan="6" colspan="2">
	    	<img src="<?php echo base_url('uploads/ktp/'.$f_ktp_pelapor)?>" class="img-fluid" alt="Responsive image" width="200" height="120"></td></tr>
	    <tr>
	    	<tr><td>&nbsp</td><td></td><td></td></tr>
	    	<td>NIK Pelapor</td><td><?php echo $nik_pelapor; ?></td><td></td></tr>
	    <tr><td>Nama Pelapor</td><td><?php echo $nama_pelapor; ?></td><td ></td></tr>
	    <tr><td>Agama Pelapor</td><td><?php echo $nama_agama_pelapor; ?></td><td ></td></tr>
	    <tr><td>Alamat Pelapor</td><td colspan="3"><?php echo $alamat_pelapor." ,Kelurahan ".$nama_desa_pelapor." ,Kecamatan ".$nama_kecamatan_pelapor; ?></td><td ></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>

	    <tr><td><b>DATA KORBAN</b></td><td></td><td rowspan="5" colspan="2">
	    	<img src="<?php echo base_url('uploads/ktp/'.$f_ktp_korban)?>" class="img-fluid" alt="Responsive image" width="200" height="120"></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td>NIK Korban</td><td><?php echo $nik_korban; ?></td><td ></td></tr>
	    <tr><td>Nama Korban</td><td><?php echo $nama_korban; ?></td><td ></td></tr>
	    <tr><td>Agama Korban</td><td><?php echo $nama_agama_korban; ?></td><td ></td></tr>
	    <tr><td>Alamat Korban</td><td colspan="3"><?php echo $alamat_korban." ,Kelurahan ".$nama_desa_korban." ,Kecamatan ".$nama_kecamatan_korban; ?></td><td></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    
	    <tr><td><b>DATA KEJADIAN</b></td><td></td><td ></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td>Tanggal Kejadian</td><td colspan="3"><?php echo $tgl_kejadian; ?></td><td ></td></tr>
	    <tr><td>Tempat Kejadian</td><td colspan="3"><?php echo $tempat_kejadian." ,Kelurahan ".$nama_desa_kejadian." ,Kecamatan ".$nama_kecamatan_kejadian; ?></td><td ></td></tr>
	    <tr><td>Kronologi</td><td colspan="3"><?php echo $kronologi; ?></td><td ></td></tr>

	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td><b>TINDAK LANJUT</b></td><td></td><td ></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td>Catatan Tindak Lanjut</td><td colspan="3"><?php echo "Ditindaklanjuti tanggal ".$tgl_tindak_lanjut."<br> dengan catatan : ".$note_tindak_lanjut; ?></td><td ></td></tr>
	    <tr><td>Catatan Penyelesaian</td><td colspan="3"><?php echo "Dislesaikan tanggal ".$tgl_penyelesaian."<br> dengan Catatan : ".$note_penyelesaian; ?></td><td ></td></tr>
	    <tr><td>Catatan Monitoring</td><td colspan="3"><?php echo "Dimonitoring tanggal : ".$tgl_monitoring."<br> dengan catatan : ".$note_monitoring; ?></td><td ></td></tr>

	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td><b>KETERANGAN</b></td><td colspan="3"></td><td></td></tr>
	    <tr><td>&nbsp</td><td></td><td></td></tr>
	    <tr><td>Tanggal Pelaporan</td><td colspan="3"><?php echo $tgl_input; ?></td><td></td></tr>
	    <tr><td>Status Laporan</td><td colspan="3"><h4><?php echo $nama_flag; ?></h4></td><td></td></tr>
	</table>

        </div>
 
    </div>
    <script>
        window.print();
    </script>
    </body>
</html>