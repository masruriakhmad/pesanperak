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
                    <h2 style="margin-top:0px"><?php echo $button ?> Penduduk </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nik <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Agama <?php echo form_error('id_agama') ?></label>
            <input type="text" class="form-control" name="id_agama" id="id_agama" placeholder="Id Agama" value="<?php echo $id_agama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Desa <?php echo form_error('id_desa') ?></label>
            <input type="text" class="form-control" name="id_desa" id="id_desa" placeholder="Id Desa" value="<?php echo $id_desa; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Pelapor <?php echo form_error('pelapor') ?></label>
            <input type="text" class="form-control" name="pelapor" id="pelapor" placeholder="Pelapor" value="<?php echo $pelapor; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Korban <?php echo form_error('korban') ?></label>
            <input type="text" class="form-control" name="korban" id="korban" placeholder="Korban" value="<?php echo $korban; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Pelaku <?php echo form_error('pelaku') ?></label>
            <input type="text" class="form-control" name="pelaku" id="pelaku" placeholder="Pelaku" value="<?php echo $pelaku; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Foto Ktp <?php echo form_error('foto_ktp') ?></label>
            <input type="text" class="form-control" name="foto_ktp" id="foto_ktp" placeholder="Foto Ktp" value="<?php echo $foto_ktp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Foto Ybs <?php echo form_error('foto_ybs') ?></label>
            <input type="text" class="form-control" name="foto_ybs" id="foto_ybs" placeholder="Foto Ybs" value="<?php echo $foto_ybs; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Create By <?php echo form_error('create_by') ?></label>
            <input type="text" class="form-control" name="create_by" id="create_by" placeholder="Create By" value="<?php echo $create_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Create At <?php echo form_error('create_at') ?></label>
            <input type="text" class="form-control" name="create_at" id="create_at" placeholder="Create At" value="<?php echo $create_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Is Active <?php echo form_error('is_active') ?></label>
            <input type="text" class="form-control" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" />
        </div>
	    <input type="hidden" name="id_penduduk" value="<?php echo $id_penduduk; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('penduduk') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>