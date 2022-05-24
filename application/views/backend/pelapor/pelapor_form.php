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
                    <h2 style="margin-top:0px"><?php echo $button ?> Pelapor </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama Pelapor <?php echo form_error('nama_pelapor') ?></label>
            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="Nama Pelapor" value="<?php echo $nama_pelapor; ?>" />
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
            <label for="longtext">Alamat Pelapor <?php echo form_error('alamat_pelapor') ?></label>
            <input type="text" class="form-control" name="alamat_pelapor" id="alamat_pelapor" placeholder="Alamat Pelapor" value="<?php echo $alamat_pelapor; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp Pelapor <?php echo form_error('no_hp_pelapor') ?></label>
            <input type="text" class="form-control" name="no_hp_pelapor" id="no_hp_pelapor" placeholder="No Hp Pelapor" value="<?php echo $no_hp_pelapor; ?>" />
        </div>
	    <input type="hidden" name="id_pelapor" value="<?php echo $id_pelapor; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pelapor') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>