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
                <?php echo anchor(site_url('penduduk/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('penduduk/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('penduduk'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
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
		<th class="text-center">Is Active</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($penduduk_data as $penduduk)
            {
                ?>
                <tr>
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
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('penduduk/read/'.$penduduk->id_penduduk),'Read','class="btn btn-xs btn-primary"'); 
				echo ' | '; 
				echo anchor(site_url('penduduk/update/'.$penduduk->id_penduduk),'Update','class="btn btn-xs btn-warning"'); 
				echo ' | '; 
				echo anchor(site_url('penduduk/delete/'.$penduduk->id_penduduk),'Delete','class="btn btn-xs btn-danger" onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
				?>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('penduduk/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('penduduk/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>