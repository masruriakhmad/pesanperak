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
                    <h2><b>Rekap Laporan By Kecamatan</b></h2>
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
            <a href="<?php echo site_url('laporan/rekap_kecamatan_print/')?>" class="btn btn-warning"><i class='fa fa-print fa-2x'></i></a>
        
            </div>
            

            <div class="col-md-10 text-right">
                <form action="<?php echo site_url('pengaduan/index'); ?>" class="form-inline" method="get">
                    Tanggal Awal :
                    <div class="input-group">
                        <input type="date" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Tanggal Awal">
                    </div>
                    Tanggal Akhir : 
                    <div class="input-group">
                        <input type="date" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Tanggal Akhir">
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengaduan'); ?>" class="btn btn-default">Reset</a>
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
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nama Kecamatan</th>
		<th class="text-center">Laporan Masuk</th>
		<th class="text-center">Pending</th>
		<th class="text-center">Ditindaklanjuti</th>
		<th class="text-center">Selesai</th>
        <th class="text-center">Dimonitoring</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($pengaduan_data as $pengaduan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pengaduan->nama_kecamatan ?></td>
			<td><?php echo $pengaduan->jml_masuk ?></td>
			<td><?php echo $pengaduan->jml_pending ?></td>
			<td><?php echo $pengaduan->jml_tindaklanjut ?></td>
            <td><?php echo $pengaduan->jml_selesai ?></td>
            <td><?php echo $pengaduan->jml_monitoring ?></td>
			<td style="text-align:center" width="200px">
				<?php  
				echo anchor(site_url('laporan/rekap_desa_index/'),'<i class="fa fa-th-list fa-2x"></i>','class="text-navy"'); 
				 
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
                
	    </div>
            <div class="col-md-6 text-right">
               
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    
    </body>
</html>