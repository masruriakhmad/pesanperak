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
                    <h2 style="margin-top:0px"><?php echo $button ?> User_menu_access </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="int">Id Menu <?php echo form_error('id_menu') ?></label>
            <input type="text" class="form-control" name="id_menu" id="id_menu" placeholder="Id Menu" value="<?php echo $id_menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Group <?php echo form_error('id_group') ?></label>
            <input type="text" class="form-control" name="id_group" id="id_group" placeholder="Id Group" value="<?php echo $id_group; ?>" />
        </div>
	    <input type="hidden" name="id_user_menu_access" value="<?php echo $id_user_menu_access; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user_menu_access') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>