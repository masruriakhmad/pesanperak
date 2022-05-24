<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Korban Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Nama Korban</td><td><?php echo $nama_korban; ?></td></tr>
	    <tr><td>Id Agama</td><td><?php echo $id_agama; ?></td></tr>
	    <tr><td>Id Desa</td><td><?php echo $id_desa; ?></td></tr>
	    <tr><td>Alamat Korban</td><td><?php echo $alamat_korban; ?></td></tr>
	    <tr><td>No Hp Korban</td><td><?php echo $no_hp_korban; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('korban') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>