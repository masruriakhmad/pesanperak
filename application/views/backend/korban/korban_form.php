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
                    <h2 style="margin-top:0px"><?php echo $button ?> Korban </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama Korban <?php echo form_error('nama_korban') ?></label>
            <input type="text" class="form-control" name="nama_korban" id="nama_korban" placeholder="Nama Korban" value="<?php echo $nama_korban; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Agama <?php echo form_error('id_agama') ?></label>
            <input type="text" class="form-control" name="id_agama" id="id_agama" placeholder="Id Agama" value="<?php echo $id_agama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Desa <?php echo form_error('id_desa') ?></label>
            <input type="text" class="form-control" name="id_desa" id="id_desa" placeholder="Id Desa" value="<?php echo $id_desa; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Alamat Korban <?php echo form_error('alamat_korban') ?></label>
            <input type="text" class="form-control" name="alamat_korban" id="alamat_korban" placeholder="Alamat Korban" value="<?php echo $alamat_korban; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp Korban <?php echo form_error('no_hp_korban') ?></label>
            <input type="text" class="form-control" name="no_hp_korban" id="no_hp_korban" placeholder="No Hp Korban" value="<?php echo $no_hp_korban; ?>" />
        </div>
	    <input type="hidden" name="id_korban" value="<?php echo $id_korban; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('korban') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>