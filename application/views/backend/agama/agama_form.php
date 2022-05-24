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
                    <h2 style="margin-top:0px"><?php echo $button ?> Agama </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama Agama <?php echo form_error('nama_agama') ?></label>
            <input type="text" class="form-control" name="nama_agama" id="nama_agama" placeholder="Nama Agama" value="<?php echo $nama_agama; ?>" />
        </div>
	    <input type="hidden" name="id_agama" value="<?php echo $id_agama; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('agama') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>