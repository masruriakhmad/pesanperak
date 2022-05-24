<div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-success float-right">Total</span>
                                </div>
                                <h5>Laporan Pengaduan</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $total_laporan?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo round($total_laporan/$total_laporan*100,1) ?>% </div>
                                <small>Total Laporan</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-success float-right">Laporan</span>
                                </div>
                                <h5>Pending</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $jumlah_pending?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo round($jumlah_pending/$total_laporan*100,1) ?>% </div>
                                <small>Jumlah Laporan Pending</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-info float-right">Laporan</span>
                                </div>
                                <h5>Tertindaklanjuti</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $jumlah_tindaklanjut?></h1>
                                <div class="stat-percent font-bold text-info"><?php echo round($jumlah_tindaklanjut/$total_laporan*100,1) ?>% </div>
                                <small>Jumlah</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-primary float-right">Laporan</span>
                                </div>
                                <h5>Terselesaikan</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $jumlah_selesai?></h1>
                                <div class="stat-percent font-bold text-navy"><?php echo round($jumlah_selesai/$total_laporan*100,1) ?>% </div>
                                <small>Jumlah</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-danger float-right">Laporan</span>
                                </div>
                                <h5>Termonitoring</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $jumlah_monitoring?></h1>
                                <div class="stat-percent font-bold text-danger"><?php echo round($jumlah_monitoring/$total_laporan*100,1) ?>% </div>
                                <small>Jumlah</small>
                            </div>
                        </div>
                    </div>
                    
        <!--div Row-->            
        </div>

        <!--Grafik-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Grafik Kasus di Kabupaten Temanggung </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="morris-one-line-chart"></div>
                            
                        </div>
                    </div>
                </div>
            </div>

            
<!--Pengaduan Terbaru-->
<div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2><b>List Pengaduan Terbaru</b></h2>
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

            </div>
        </div>
        <div class="table-responsive" id="myTable">
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
        <!--
        <th class="text-center">Action</th>
    -->
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
         
        </tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
        <div class="row">
         <!--
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        -->
        </div>

        </div>
    </div>
    </div>
</div>


