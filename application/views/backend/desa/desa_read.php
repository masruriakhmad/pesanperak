<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Desa Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Id Kecamatan</td><td><?php echo $id_kecamatan; ?></td></tr>
	    <tr><td>Nama Desa</td><td><?php echo $nama_desa; ?></td></tr>
	    <tr><td>Col1</td><td><?php echo $col1; ?></td></tr>
	    <tr><td>Col2</td><td><?php echo $col2; ?></td></tr>
	    <tr><td>Col3</td><td><?php echo $col3; ?></td></tr>
	    <tr><td>Col4</td><td><?php echo $col4; ?></td></tr>
	    <tr><td>Col5</td><td><?php echo $col5; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td>Updated By</td><td><?php echo $updated_by; ?></td></tr>
	    <tr><td>Isactive</td><td><?php echo $isactive; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('desa') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>