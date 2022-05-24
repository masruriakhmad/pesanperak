<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">User_menu_access Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Id Menu</td><td><?php echo $id_menu; ?></td></tr>
	    <tr><td>Id Group</td><td><?php echo $id_group; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user_menu_access') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>