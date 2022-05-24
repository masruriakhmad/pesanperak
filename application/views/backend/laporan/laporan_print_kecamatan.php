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
            .table1{
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
            <table border="0" class="table1" width="100%">
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

        <div class="row" align="center">
           
                        <h3><b>Rekap Laporan Pengaduan Per Kecamatan</b></h3>
                        Bulan ......... Tahun ..........
                    </div>
                <div class="ibox-content">
           <div class="row" style="margin-bottom: 10px">

        </div>
                            

    <div class="table-responsive">
        <table border="1"  width="100% >
            <thead class="thead-light">
        <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nama Kecamatan</th>
		<th class="text-center">Laporan Masuk</th>
		<th class="text-center">Pending</th>
		<th class="text-center">Ditindaklanjuti</th>
		<th class="text-center">Selesai</th>
        <th class="text-center">Dimonitoring</th>
        </tr>
            </thead>
			<tbody>
            <?php
            $tot_masuk=0;
            $tot_pending=0;
            $tot_tindaklanjut=0;
            $tot_selesai=0;
            $tot_monitoring=0;
            
            foreach ($pengaduan_data as $pengaduan)
            {
                ?>
                <tr>
			<td align="center" width="10px"><?php echo ++$start ?></td>
			<td align="center"><?php echo $pengaduan->nama_kecamatan ?></td>
			<td align="center"><?php echo $pengaduan->jml_masuk; $tot_masuk +=$pengaduan->jml_masuk ?></td>
			<td align="center"><?php echo $pengaduan->jml_pending;$tot_pending +=$pengaduan->jml_pending ?></td>
			<td align="center"><?php echo $pengaduan->jml_tindaklanjut;$tot_tindaklanjut +=$pengaduan->jml_tindaklanjut ?></td>
            <td align="center"><?php echo $pengaduan->jml_selesai; $tot_selesai += $pengaduan->jml_selesai ?></td>
            <td align="center"><?php echo $pengaduan->jml_monitoring; $tot_monitoring +=$pengaduan->jml_monitoring ?></td>
			
		</tr> 
                <?php
            }
            ?>
        <tr>
			<td align="center" width="10px"></td>
			<td align="center">Total</td>
			<td align="center"><?php echo $tot_masuk ?></td>
			<td align="center"><?php echo $tot_pending ?></td>
			<td align="center"><?php echo $tot_tindaklanjut ?></td>
            <td align="center"><?php echo $tot_selesai ?></td>
            <td align="center"><?php echo $tot_monitoring ?></td>
			
		</tr> 
            </tbody>
        </table>
    </div>
    <div width="80%">
    </div>
    <div>
    <br><br>
    <text align="right">Temanggung, <?php echo date('d-m-Y') ?></text>
    <br><br>
    Kepala Dinas,
    <br><br><br><br><br><br>
    Nama Kepala Dinas <br>
    NIP.-
    </div>
    </div>
    </div>
    </div>

        
    </div>

    
    <script>
        window.print();
    </script>
    
    </body>
  
</html>