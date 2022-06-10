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
                    <h2 style="margin-top:0px"><?php echo $button ?> Wa </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Message <?php echo form_error('message') ?></label>
            <input type="text" class="form-control" name="message" id="message" placeholder="Message" value="<?php echo $message; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Secret <?php echo form_error('secret') ?></label>
            <input type="text" class="form-control" name="secret" id="secret" placeholder="Secret" value="<?php echo $secret; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Retry <?php echo form_error('retry') ?></label>
            <input type="text" class="form-control" name="retry" id="retry" placeholder="Retry" value="<?php echo $retry; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">IsGroup <?php echo form_error('isGroup') ?></label>
            <input type="text" class="form-control" name="isGroup" id="isGroup" placeholder="IsGroup" value="<?php echo $isGroup; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('wa') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>