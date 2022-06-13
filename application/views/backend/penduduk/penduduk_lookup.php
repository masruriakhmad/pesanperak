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
                    <h2><b>List Penduduk</b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
               
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('penduduk/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>penduduk/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nik</th>
		<th class="text-center">Nama</th>
		<th class="text-center">Id Agama</th>
		<th class="text-center">Alamat</th>
		<th class="text-center">No Hp</th>
		<th class="text-center">Id Desa</th>
		<th class="text-center">Pelapor</th>
		<th class="text-center">Korban</th>
		<th class="text-center">Pelaku</th>
		<th class="text-center">Foto Ktp</th>
		<th class="text-center">Foto Ybs</th>
		<th class="text-center">Create By</th>
		<th class="text-center">Create At</th>
		<th class="text-center">Is Active</th></tr>
            </thead>
			<tbody><?php
            foreach ($penduduk_data as $penduduk)
            {
                ?>
                <tr style="cursor: pointer">
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $penduduk->nik ?></td>
			<td><?php echo $penduduk->nama ?></td>
			<td><?php echo $penduduk->id_agama ?></td>
			<td><?php echo $penduduk->alamat ?></td>
			<td><?php echo $penduduk->no_hp ?></td>
			<td><?php echo $penduduk->id_desa ?></td>
			<td><?php echo $penduduk->pelapor ?></td>
			<td><?php echo $penduduk->korban ?></td>
			<td><?php echo $penduduk->pelaku ?></td>
			<td><?php echo $penduduk->foto_ktp ?></td>
			<td><?php echo $penduduk->foto_ybs ?></td>
			<td><?php echo $penduduk->create_by ?></td>
			<td><?php echo $penduduk->create_at ?></td>
			<td><?php echo $penduduk->is_active ?></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>