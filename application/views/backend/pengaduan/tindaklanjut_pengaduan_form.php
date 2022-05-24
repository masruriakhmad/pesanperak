<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px"><?php echo $button ?> Tindak Lanjut </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
              <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
        <tr>
            <td colspan="6" class="text-center">
                <h4><b>NOMOR PENGADUAN : <?php echo $no_pengaduan; ?> </b></h4>
            </td> 
        </tr>
        <tr>
            <td colspan="2" class="text-center"><h4><b>DATA PELAPOR</b></h4></td>
            
            <td colspan="2" class="text-center"><h4><b>DATA KORBAN</b></h4></td>
            
            <td colspan="2" class="text-center"><h4><b>DATA KEJADIAN</b></h4></td>
            
        </tr>
        <tr>
            <td>NIK Pelapor</td>
            <td><?php echo $nik_pelapor; ?></td>
            <td>NIK Korban</td>
            <td><?php echo $nik_korban; ?></td>
            <td>Tempat Kejadian</td>
            <td><?php echo $tempat_kejadian; ?></td>

        </tr>
        <tr>
            <td>Nama Pelapor</td>
            <td><?php echo $nama_pelapor; ?></td></h4></td>
            <td>Nama Korban</td>
            <td><?php echo $nama_korban; ?></td>
            <td>Desa Kejadian</td>
            <td><?php echo $nama_desa_kejadian; ?></td>
        </tr>
        <tr>
            <td>Agama Pelapor</td>
            <td><?php echo $nama_agama_pelapor; ?> </td>
            <td>Agama Korban</td>
            <td><?php echo $nama_agama_korban; ?></td>
            <td>Kecamatan Kejadian</td>
            <td><?php echo $nama_kecamatan_kejadian; ?></td>
        </tr>
        <tr>
            <td>Alamat Pelapor</td>
            <td><?php echo $alamat_pelapor; ?></td>
            <td>Alamat Korban</td>
            <td><?php echo $alamat_korban; ?></td>
            <td>Tanggal Kejadian</td>
            <td><?php echo $tgl_kejadian; ?></td>
            
        </tr>
        <tr>
            <td>Kecamatan Pelapor</td>
            <td><?php echo $nama_kecamatan_pelapor; ?></td>
            <td>Kecamatan Korban</td>
            <td><?php echo $nama_kecamatan_korban; ?></td>
            <td>Tanggal Input</td>
            <td><?php echo $tgl_input; ?></td>
            
        </tr>
        <tr>
            <td>Desa Pelapor</td>
            <td><?php echo $nama_desa_pelapor; ?></td>
            <td>Desa Korban</td>
            <td><?php echo $nama_desa_korban; ?></td>
            <td>Kronologi</td>
            <td><?php echo $kronologi; ?></td> 
        </tr>
        <tr>
            <td colspan="6" class="text-center" >
                <h4><b>STATUS PENGADUAN : <?php echo $nama_flag; ?> </b></h4>
            </td> 
        </tr>
    </table>

        <div class="form-group">
            <label for="date">Tanggal Tindak Lanjut <?php echo form_error('tgl_tindak_lanjut') ?></label>
            <input type="date" class="form-control" name="tgl_tindak_lanjut" id="tgl_tindak_lanjut" placeholder="Tanggal Tindak Lanjut" value="<?php echo $tgl_tindak_lanjut; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Catatan Tindak Lanjut <?php echo form_error('note_tindak_lanjut') ?></label>
            <textarea type="text" class="form-control" name="note_tindak_lanjut" id="note_tindak_lanjut" placeholder="Note Tindak Lanjut" value="<?php echo $note_tindak_lanjut; ?>" /></textarea>
        </div>

        <!--
	    <div class="form-group">
            <label for="date">Tgl Penyelesaian <?php echo form_error('tgl_penyelesaian') ?></label>
            <input type="text" class="form-control" name="tgl_penyelesaian" id="tgl_penyelesaian" placeholder="Tgl Penyelesaian" value="<?php echo $tgl_penyelesaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Penyelesaian <?php echo form_error('note_penyelesaian') ?></label>
            <input type="text" class="form-control" name="note_penyelesaian" id="note_penyelesaian" placeholder="Note Penyelesaian" value="<?php echo $note_penyelesaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Monitoring <?php echo form_error('tgl_monitoring') ?></label>
            <input type="text" class="form-control" name="tgl_monitoring" id="tgl_monitoring" placeholder="Tgl Monitoring" value="<?php echo $tgl_monitoring; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Monitoring <?php echo form_error('note_monitoring') ?></label>
            <input type="text" class="form-control" name="note_monitoring" id="note_monitoring" placeholder="Note Monitoring" value="<?php echo $note_monitoring; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Input <?php echo form_error('tgl_input') ?></label>
            <input type="text" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tgl Input" value="<?php echo $tgl_input; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Flag <?php echo form_error('flag') ?></label>
            <input type="text" class="form-control" name="flag" id="flag" placeholder="Flag" value="<?php echo $flag; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
    -->
	    <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan; ?>" />
        <input type="hidden" name="no_pengaduan" value="<?php echo $no_pengaduan; ?>" />
        <input type="hidden" name="id_pelapor" value="<?php echo $id_pelapor; ?>" />
        <input type="hidden" name="id_korban" value="<?php echo $id_korban; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengaduan/tindaklanjut_index') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
    
</html>