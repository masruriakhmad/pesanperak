<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">Penduduk Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Nik</td><td><?php echo $nik; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Id Agama</td><td><?php echo $id_agama; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>Id Desa</td><td><?php echo $id_desa; ?></td></tr>
	    <tr><td>Pelapor</td><td><?php echo $pelapor; ?></td></tr>
	    <tr><td>Korban</td><td><?php echo $korban; ?></td></tr>
	    <tr><td>Pelaku</td><td><?php echo $pelaku; ?></td></tr>
	    <tr><td>Foto Ktp</td><td><?php echo $foto_ktp; ?></td></tr>
	    <tr><td>Foto Ybs</td><td><?php echo $foto_ybs; ?></td></tr>
	    <tr><td>Create By</td><td><?php echo $create_by; ?></td></tr>
	    <tr><td>Create At</td><td><?php echo $create_at; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('penduduk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>