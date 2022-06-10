<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Wa Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
	    <tr><td>Message</td><td><?php echo $message; ?></td></tr>
	    <tr><td>Secret</td><td><?php echo $secret; ?></td></tr>
	    <tr><td>Retry</td><td><?php echo $retry; ?></td></tr>
	    <tr><td>IsGroup</td><td><?php echo $isGroup; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wa') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>