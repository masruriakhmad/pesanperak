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
                    <h2><b>Tindaklanjut Pengaduan</b></h2>
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
                <form action="<?php echo site_url('pengaduan/tindaklanjut_index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengaduan/tindaklanjut_index'); ?>" class="btn btn-default">Reset</a>
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
		<th class="text-center">No Pengaduan</th>
		<th class="text-center">Nama Pelapor</th>
		<th class="text-center">Nama Korban</th>
		<th class="text-center">Tempat Kejadian</th>
		<th class="text-center">Desa Kejadian</th>
        <th class="text-center">Kecamatan</th>
		<th class="text-center">Tanggal Kejadian</th>
		<th class="text-center">Status</th>
		<th class="text-center col-md-2">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($pengaduan_data as $pengaduan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pengaduan->no_pengaduan ?></td>
			<td><?php echo $pengaduan->nama_pelapor ?></td>
			<td><?php echo $pengaduan->nama_korban ?></td>
			<td><?php echo $pengaduan->tempat_kejadian ?></td>
            <td><?php echo $pengaduan->nama_desa ?></td>
            <td><?php echo $pengaduan->nama_kecamatan ?></td>
			<td><?php echo $pengaduan->tgl_kejadian ?></td>
			<td><?php echo $pengaduan->nama_flag ?></td>
			<td style="text-align:center" width="200px">
				<?php  
			
                
                    echo anchor(site_url('pengaduan/read/'.$pengaduan->id_pengaduan),'Read','class="btn btn-xs btn-primary"'); 
            if(is_allow('Action Tindaklanjut')){
				    echo ' | '; 
                    echo anchor(site_url('pengaduan/tindaklanjut_create/'.$pengaduan->id_pengaduan),'Tindak Lanjut','class="btn btn-xs btn-warning"'); 
				    echo ' | '; 
				    echo anchor(site_url('pengaduan/tindaklanjut_cancel/'.$pengaduan->id_pengaduan),'Batalkan','class="btn btn-xs btn-danger" onclick="javascript: return confirm(\'Yakin ingin membatalkan tindak lanjut?\')"'); 
            }
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
		<?php echo anchor(site_url('pengaduan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('pengaduan/word'), 'Word', 'class="btn btn-primary"'); ?>
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