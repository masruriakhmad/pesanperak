<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Pelapor Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Nama Pelapor</td><td><?php echo $nama_pelapor; ?></td></tr>
	    <tr><td>Id Agama</td><td><?php echo $id_agama; ?></td></tr>
	    <tr><td>Id Desa</td><td><?php echo $id_desa; ?></td></tr>
	    <tr><td>Alamat Pelapor</td><td><?php echo $alamat_pelapor; ?></td></tr>
	    <tr><td>No Hp Pelapor</td><td><?php echo $no_hp_pelapor; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pelapor') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>