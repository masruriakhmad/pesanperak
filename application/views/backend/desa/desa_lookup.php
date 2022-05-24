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
                    <h2><b>List Desa</b></h2>
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
                <form action="<?php echo site_url('desa/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>desa/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Id Kecamatan</th>
		<th class="text-center">Nama Desa</th>
		<th class="text-center">Col1</th>
		<th class="text-center">Col2</th>
		<th class="text-center">Col3</th>
		<th class="text-center">Col4</th>
		<th class="text-center">Col5</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Updated At</th>
		<th class="text-center">Updated By</th>
		<th class="text-center">Isactive</th></tr>
            </thead>
			<tbody><?php
            foreach ($desa_data as $desa)
            {
                ?>
                <tr style="cursor: pointer">
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $desa->id_kecamatan ?></td>
			<td><?php echo $desa->nama_desa ?></td>
			<td><?php echo $desa->col1 ?></td>
			<td><?php echo $desa->col2 ?></td>
			<td><?php echo $desa->col3 ?></td>
			<td><?php echo $desa->col4 ?></td>
			<td><?php echo $desa->col5 ?></td>
			<td><?php echo $desa->created_at ?></td>
			<td><?php echo $desa->created_by ?></td>
			<td><?php echo $desa->updated_at ?></td>
			<td><?php echo $desa->updated_by ?></td>
			<td><?php echo $desa->isactive ?></td>
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