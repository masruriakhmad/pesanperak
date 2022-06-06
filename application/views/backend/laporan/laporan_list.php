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
                    <h2><b>Rekap Laporan</b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
           <div class="row" style="margin-bottom: 10px">
            <div class="col-md-2">
            <a href="<?php echo site_url('Laporan/') ?>" class="btn btn-default"><i class='fa fa-reply fa-2x'></i></a>
            <a href="<?php echo site_url('laporan/rekap_desa_print/')?>" class="btn btn-warning"><i class='fa fa-print fa-2x'></i></a>
        
            </div>
        

            <div class="col-md-10 text-right">
                <form action="<?php echo site_url('laporan/index'); ?>" class="form-inline" method="get">
                    Tanggal Awal :
                    <div class="input-group">
                        <input type="date" id="tanggal_awal" class="form-control" name="tgl_awal" value="<?php echo $tgl_awal;?>" placeholder="Tanggal Awal">
                    </div>
                    Tanggal Akhir : 
                    <div class="input-group">
                        <input type="date" id="tanggal_akhir" class="form-control" name="tgl_akhir" value="<?php echo $tgl_akhir;?>" placeholder="Tanggal Akhir">
                    </div>
                   
                    <div class="input-group">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('laporan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Filter</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 10px">
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
		<th class="text-center">Action</th>
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
			<td><?php echo tanggal_indo($pengaduan->tgl_kejadian) ?></td>
			<td><?php echo $pengaduan->nama_flag ?></td>
			<td style="text-align:center" width="100px">
				<?php  
				
				echo anchor(site_url('pengaduan/laporan_read/'.$pengaduan->id_pengaduan),'<i class="fa fa-print fa-2x"></i>','class="text-warning"'); 
				 
				?>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
        </div>
    </div>
    </div>
    </div>
    
    </body>
</html>