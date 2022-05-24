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
                    <h2><b>List Pelapor</b></h2>
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
                <?php echo anchor(site_url('pelapor/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pelapor/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pelapor'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nama Pelapor</th>
		<th class="text-center">Id Agama</th>
		<th class="text-center">Id Desa</th>
		<th class="text-center">Alamat Pelapor</th>
		<th class="text-center">No Hp Pelapor</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($pelapor_data as $pelapor)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pelapor->nama_pelapor ?></td>
			<td><?php echo $pelapor->id_agama ?></td>
			<td><?php echo $pelapor->id_desa ?></td>
			<td><?php echo $pelapor->alamat_pelapor ?></td>
			<td><?php echo $pelapor->no_hp_pelapor ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pelapor/read/'.$pelapor->id_pelapor),'Read','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('pelapor/update/'.$pelapor->id_pelapor),'Update','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('pelapor/delete/'.$pelapor->id_pelapor),'Delete','class="text-navy" onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
				?>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('pelapor/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pelapor/word'), 'Word', 'class="btn btn-primary"'); ?>
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