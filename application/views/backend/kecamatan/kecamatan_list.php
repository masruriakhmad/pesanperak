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
                    <h2><b>List Kecamatan</b></h2>
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
                <?php echo anchor(site_url('kecamatan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('kecamatan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kecamatan'); ?>" class="btn btn-default">Reset</a>
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
		<th class="text-center">Id Kabupaten</th>
		<th class="text-center">Nama Kecamatan</th>
		<th class="text-center">Col1</th>
		<th class="text-center">Col2</th>
		<th class="text-center">Col3</th>
		<th class="text-center">Col4</th>
		<th class="text-center">Col5</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Updated At</th>
		<th class="text-center">Updated By</th>
		<th class="text-center">Isactive</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($kecamatan_data as $kecamatan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $kecamatan->id_kabupaten ?></td>
			<td><?php echo $kecamatan->nama_kecamatan ?></td>
			<td><?php echo $kecamatan->col1 ?></td>
			<td><?php echo $kecamatan->col2 ?></td>
			<td><?php echo $kecamatan->col3 ?></td>
			<td><?php echo $kecamatan->col4 ?></td>
			<td><?php echo $kecamatan->col5 ?></td>
			<td><?php echo $kecamatan->created_at ?></td>
			<td><?php echo $kecamatan->created_by ?></td>
			<td><?php echo $kecamatan->updated_at ?></td>
			<td><?php echo $kecamatan->updated_by ?></td>
			<td><?php echo $kecamatan->isactive ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('kecamatan/read/'.$kecamatan->id_kecamatan),'Read','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('kecamatan/update/'.$kecamatan->id_kecamatan),'Update','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('kecamatan/delete/'.$kecamatan->id_kecamatan),'Delete','class="text-navy" onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
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
		<?php echo anchor(site_url('kecamatan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kecamatan/word'), 'Word', 'class="btn btn-primary"'); ?>
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