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
                    <h2 style="margin-top:0px"><?php echo $button ?> Flag </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama Flag <?php echo form_error('nama_flag') ?></label>
            <input type="text" class="form-control" name="nama_flag" id="nama_flag" placeholder="Nama Flag" value="<?php echo $nama_flag; ?>" />
        </div>
	    <input type="hidden" name="id_flag" value="<?php echo $id_flag; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('flag') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>