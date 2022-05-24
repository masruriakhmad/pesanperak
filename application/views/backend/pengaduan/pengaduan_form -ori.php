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
                    <h2 style="margin-top:0px"><?php echo $button ?> Pengaduan </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Id Pengaduan <?php echo form_error('id_pelapor') ?></label>
            <input type="text" class="form-control" name="get_id_pengaduan" id="id_pengaduan" placeholder="Id Pengaduan" value="<?php echo $get_id_pengaduan; ?>" disabled/>
        </div>
        <div class="form-group">
            <label for="varchar">Id Pelapor <?php echo form_error('id_pelapor') ?></label>
            <input type="text" class="form-control" name="id_pelapor" id="id_pelapor" placeholder="Id Pelapor" value="<?php echo $id_pelapor; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Id Korban <?php echo form_error('id_korban') ?></label>
            <input type="text" class="form-control" name="id_korban" id="id_korban" placeholder="Id Korban" value="<?php echo $id_korban; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Desa <?php echo form_error('id_desa') ?></label>
            <input type="text" class="form-control" name="id_desa" id="id_desa" placeholder="Id Desa" value="<?php echo $id_desa; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Kronologi <?php echo form_error('kronologi') ?></label>
            <textarea class="form-control" name="kronologi" id="kronologi" placeholder="Kronologi" value="<?php echo $kronologi; ?>" />
            </textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Kejadian <?php echo form_error('tgl_kejadian') ?></label>
            <input type="date" class="form-control" name="tgl_kejadian" id="tgl_kejadian" placeholder="Tgl Kejadian" value="<?php echo $tgl_kejadian; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Tindak Lanjut <?php echo form_error('tgl_tindak_lanjut') ?></label>
            <input type="date" class="form-control" name="tgl_tindak_lanjut" id="tgl_tindak_lanjut" placeholder="Tgl Tindak Lanjut" value="<?php echo $tgl_tindak_lanjut; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Tindak Lanjut <?php echo form_error('note_tindak_lanjut') ?></label>
            <textarea class="form-control" name="note_tindak_lanjut" id="note_tindak_lanjut" placeholder="Note Tindak Lanjut" value="<?php echo $note_tindak_lanjut; ?>" />
            </textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Penyelesaian <?php echo form_error('tgl_penyelesaian') ?></label>
            <input type="date" class="form-control" name="tgl_penyelesaian" id="tgl_penyelesaian" placeholder="Tgl Penyelesaian" value="<?php echo $tgl_penyelesaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Penyelesaian <?php echo form_error('note_penyelesaian') ?></label>
            <textarea class="form-control" name="note_penyelesaian" id="note_penyelesaian" placeholder="Note Penyelesaian" value="<?php echo $note_penyelesaian; ?>" />
            </textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Monitoring <?php echo form_error('tgl_monitoring') ?></label>
            <input type="date" class="form-control" name="tgl_monitoring" id="tgl_monitoring" placeholder="Tgl Monitoring" value="<?php echo $tgl_monitoring; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Monitoring <?php echo form_error('note_monitoring') ?></label>
            <textarea  class="form-control" name="note_monitoring" id="note_monitoring" placeholder="Note Monitoring" value="<?php echo $note_monitoring; ?>" /></textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Input <?php echo form_error('tgl_input') ?></label>
            <input type="date" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tgl Input" value="<?php echo $tgl_input; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('flag') ?></label>
            <input type="text" class="form-control" name="flag" id="flag" placeholder="Flag" value="<?php echo $flag; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
	    <input type="hidden" name="id_pengaduan" value="
        <?php echo $get_id_pengaduan; ?>
        " /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengaduan') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>