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
                    <h2><b>List Pengaduan</b></h2>
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
                <form action="<?php echo site_url('pengaduan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>pengaduan/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">No Pengaduan</th>
		<th class="text-center">Id Pelapor</th>
		<th class="text-center">Id Korban</th>
		<th class="text-center">Tempat Kejadian</th>
		<th class="text-center">Id Desa</th>
		<th class="text-center">Kronologi</th>
		<th class="text-center">Tgl Kejadian</th>
		<th class="text-center">Tgl Tindak Lanjut</th>
		<th class="text-center">Note Tindak Lanjut</th>
		<th class="text-center">Tgl Penyelesaian</th>
		<th class="text-center">Note Penyelesaian</th>
		<th class="text-center">Tgl Monitoring</th>
		<th class="text-center">Note Monitoring</th>
		<th class="text-center">Tgl Input</th>
		<th class="text-center">Flag</th>
		<th class="text-center">Id User</th></tr>
            </thead>
			<tbody><?php
            foreach ($pengaduan_data as $pengaduan)
            {
                ?>
                <tr style="cursor: pointer">
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pengaduan->no_pengaduan ?></td>
			<td><?php echo $pengaduan->id_pelapor ?></td>
			<td><?php echo $pengaduan->id_korban ?></td>
			<td><?php echo $pengaduan->tempat_kejadian ?></td>
			<td><?php echo $pengaduan->id_desa ?></td>
			<td><?php echo $pengaduan->kronologi ?></td>
			<td><?php echo $pengaduan->tgl_kejadian ?></td>
			<td><?php echo $pengaduan->tgl_tindak_lanjut ?></td>
			<td><?php echo $pengaduan->note_tindak_lanjut ?></td>
			<td><?php echo $pengaduan->tgl_penyelesaian ?></td>
			<td><?php echo $pengaduan->note_penyelesaian ?></td>
			<td><?php echo $pengaduan->tgl_monitoring ?></td>
			<td><?php echo $pengaduan->note_monitoring ?></td>
			<td><?php echo $pengaduan->tgl_input ?></td>
			<td><?php echo $pengaduan->flag ?></td>
			<td><?php echo $pengaduan->id_user ?></td>
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