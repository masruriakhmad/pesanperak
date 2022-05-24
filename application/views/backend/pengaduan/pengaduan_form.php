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
                    
                        <h2 style="margin-top:0px"><?php echo $button ?> Pengaduan </h2>
                        <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                    
                </div>
        
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="ibox-content">

     <div class="col-lg-12">
        <label for="varchar">
            <h3>No Pengaduan : <?php echo $no_pengaduan; ?></h3>
        </label>
     </div>

     <div class="col-lg-6">
       <div class="ibox ">
         <div class="ibox-title">
                                <!--
                                <div class="ibox-tools">
                                    <span class="label label-success float-right">Monthly</span>
                                </div>
                            -->
                                <h5>DATA PELAPOR</h5>
                            </div>
                            <div class="ibox-content">
                                

                            <div class="form-group">
            <label for="varchar">NIK Pelapor <?php echo form_error('nik_pelapor') ?></label>
            <input type="number" class="form-control" name="nik_pelapor" id="nik_pelapor" placeholder="Nik Pelapor" value="<?php echo $nik_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Pelapor <?php echo form_error('nama_pelapor') ?></label>
            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="Nama Pelapor" value="<?php echo $nama_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Agama Pelapor <?php echo form_error('agama_pelapor') ?></label>
            <select type="text" class="form-control" name="id_agama_pelapor" id="id_agama_pelapor" placeholder="Agama Pelapor" value="<?php echo $id_agama_pelapor; ?>" />
                <option value="<?php echo $id_agama_pelapor;?>"><?php echo $nama_agama_pelapor ?></option>
                <?php foreach($agama as $row) { ?>
                    <option value="<?php echo $row->id_agama ?>">
                        <?php echo $row->nama_agama; ?>
                        </option>
            <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Alamat Pelapor <?php echo form_error('alamat_pelapor') ?></label>
            <textarea type="text" class="form-control" name="alamat_pelapor" id="alamat_pelapor" placeholder="Alamat Pelapor" value="<?php echo $alamat_pelapor; ?>" /><?php echo $alamat_pelapor; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Kecamatan Pelapor <?php echo form_error('id_kecamatan') ?></label>
            <select type="text" class="form-control" name="id_kecamatan" id="id_kecamatan_pelapor" placeholder="Kecamatan Pelapor" value="<?php echo $id_kecamatan; ?>" />
                
                <option value="<?php echo $id_kecamatan_pelapor;?>"><?php echo $nama_kecamatan_pelapor ?></option>

                <?php foreach($kecamatan as $row) { ?>
                <option value="<?php echo $row->id_kecamatan;?>">
                    <?php echo $row->nama_kecamatan ?>
                    </option>
                <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Desa Pelapor <?php echo form_error('id_desa') ?></label>
            <select type="text" class="form-control" name="id_desa_pelapor" id="id_desa_pelapor" placeholder="Desa Pelapor" value="<?php echo $id_desa; ?>" />
                <option value="<?php echo $id_desa_pelapor;?>"><?php echo $nama_desa_pelapor; ?></option>
        </select>
        </div>
        <div class="form-group">
            <label for="varchar">No Hp Pelapor <?php echo form_error('no_hp_pelapor') ?></label>
            <input type="number" class="form-control" name="no_hp_pelapor" id="no_hp_pelapor" placeholder="No Hp Pelapor" value="<?php echo $no_hp_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Upload KTP <?php echo form_error('f_ktp_pelapor') ?></label>
            <input type="file" class="form-control" name="f_ktp_pelapor" id="preview" placeholder="File KTP Pelapor (PDF/JPEG) max 2mb" aria-describedby="fileHelpId" onChange="loadFile(event)"/>
        </div>
        <div class="form-group">
        <img src="" width="300px" height="200px" id="prev1">
        </div>
        <!--
         <div class="form-group">
            <label for="upload">Upload file</label>
            <input type="file" class="form-control-file" name="upload" id="preview" placeholder="Upload"
              aria-describedby="fileHelpId" onChange="loadFile(event)">
          </div>
          
          <div>
            <br><img src="" width="200px" height="215px" id="prev">
          </div>
          
        <!--
        <div class="form-group">
            <div id="msg"></div>
            <input type="file" name="gambar" class="file" >
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                    <div class="input-group-append">
                    <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                </div>
                </div>
            <img src="gambar/80x80.png" id="preview" class="img-thumbnail">
        </div>
    -->

                                <!--
                                <h1 class="no-margins">40 886,200</h1>
                                <!--
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <!--
                                <small>Total income</small>
                            -->
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <!--
                                    <span class="label label-success float-right">Monthly</span>
                                -->
                                </div>
                                <h5>DATA KORBAN</h5>
                            </div>
                            <div class="ibox-content">
                                
                                <div class="form-group">
            <label for="varchar">Nik Korban <?php echo form_error('nik_korban') ?></label>
            <input type="number" class="form-control" name="nik_korban" id="nik_korban" placeholder="Nik Korban" value="<?php echo $nik_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Korban <?php echo form_error('nama_korban') ?></label>
            <input type="text" class="form-control" name="nama_korban" id="nama_korban" placeholder="Nama Korban" value="<?php echo $nama_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Agama Korban <?php echo form_error('agama_korban') ?></label>
            <select type="text" class="form-control" name="id_agama_korban" id="id_agama_korban" placeholder="Agama Korban" value="<?php echo $id_agama_korban; ?>" />
                <option value="<?php echo $id_agama_korban;?>"><?php echo $nama_agama_korban ?></option>
                <?php foreach($agama as $row) { ?>
                    <option value="<?php echo $row->id_agama ?>">
                        <?php echo $row->nama_agama; ?>
                        </option>
            <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Alamat Korban <?php echo form_error('alamat_korban') ?></label>
            <textarea type="text" class="form-control" name="alamat_korban" id="alamat_korban" placeholder="Alamat Korban" value="<?php echo $alamat_korban; ?>" /><?php echo $alamat_korban; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Kecamatan Korban <?php echo form_error('id_kecamatan') ?></label>
            <select class="selectpicker form-control" name="id_kecamatan_korban" id="id_kecamatan_korban" placeholder="Kecamatan Korban" value="<?php echo $id_kecamatan_korban; ?>" data-live-search="true"/>
                <option value="<?php echo $id_kecamatan_korban;?>"><?php echo $nama_kecamatan_korban ?></option>
                <?php foreach($kecamatan as $row) { ?>
                <option value="<?php echo $row->id_kecamatan ?>">
                    <?php echo $row->nama_kecamatan ?>
                    </option>
                <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Desa Korban <?php echo form_error('id_desa') ?></label>
            <select type="text" class="form-control" name="id_desa_korban" id="id_desa_korban" placeholder="Desa Korban" value="<?php echo $id_desa; ?>" />
                <option value="<?php echo $id_desa_korban;?>"><?php echo $nama_desa_korban; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">No Hp Korban <?php echo form_error('no_hp_korban') ?></label>
            <input type="number" class="form-control" name="no_hp_korban" id="no_hp_korban" placeholder="No Hp Korban" value="<?php echo $no_hp_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Upload KTP <?php echo form_error('f_ktp_korban') ?></label>
            <input type="file" class="form-control" name="f_ktp_korban" id="preview2" placeholder="File KTP Pelapor (PDF/JPEG) max 2mb" aria-describedby="fileHelpId" onChange="loadFile2(event)"/>
        </div>
        <div class="form-group">
        <img src="" width="300px" height="200px" id="prev2">
        </div>

                                <!--
                                <h1 class="no-margins">40 886,200</h1>
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <small>Total income</small>
                            -->
                            </div>
                        </div>
                    </div>


<!--        
	    <div class="form-group">
            <label for="varchar"><h4>No Pengaduan : <?php echo $no_pengaduan; ?></h4></label>
            <input type="hidden" class="form-control" name="no_pengaduan" id="no_pengaduan" placeholder="No Pengaduan" value="<?php echo $no_pengaduan; ?>" />
        </div>
       

        PELAPOR
        <div class="form-group">
        <label for="varchar">DATA PELAPOR</label>
        </div>
        <div class="form-group">
            <label for="varchar">NIK Pelapor <?php echo form_error('nik_pelapor') ?></label>
            <input type="number" class="form-control" name="nik_pelapor" id="nik_pelapor" placeholder="Nik Pelapor" value="<?php echo $nik_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Pelapor <?php echo form_error('nama_pelapor') ?></label>
            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="Nama Pelapor" value="<?php echo $nama_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Agama Pelapor <?php echo form_error('agama_pelapor') ?></label>
            <select type="text" class="form-control" name="id_agama_pelapor" id="id_agama_pelapor" placeholder="Agama Pelapor" value="<?php echo $id_agama_pelapor; ?>" />
                <option value="<?php echo $id_agama_pelapor;?>"><?php echo $nama_agama_pelapor ?></option>
                <?php foreach($agama as $row) { ?>
                    <option value="<?php echo $row->id_agama ?>">
                        <?php echo $row->nama_agama; ?>
                        </option>
            <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Alamat Pelapor <?php echo form_error('alamat_pelapor') ?></label>
            <textarea type="text" class="form-control" name="alamat_pelapor" id="alamat_pelapor" placeholder="Alamat Pelapor" value="<?php echo $alamat_pelapor; ?>" /><?php echo $alamat_pelapor; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Kecamatan Pelapor <?php echo form_error('id_kecamatan') ?></label>
            <select type="text" class="form-control" name="id_kecamatan" id="id_kecamatan_pelapor" placeholder="Kecamatan Pelapor" value="<?php echo $id_kecamatan; ?>" />
                <option value="<?php echo $id_kecamatan_pelapor;?>"><?php echo $nama_kecamatan_pelapor ?></option>
                <?php foreach($kecamatan as $row) { ?>
                <option value="<?php echo $row->id_kecamatan ?>">
                    <?php echo $row->nama_kecamatan ?>
                    </option>
                <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Desa Pelapor <?php echo form_error('id_desa') ?></label>
            <select type="text" class="form-control" name="id_desa_pelapor" id="id_desa_pelapor" placeholder="Desa Pelapor" value="<?php echo $id_desa; ?>" />
                <option value="<?php echo $id_desa_pelapor;?>"><?php echo $nama_desa_pelapor; ?></option>
        </select>
        </div>
        <div class="form-group">
            <label for="varchar">No Hp Pelapor <?php echo form_error('no_hp_pelapor') ?></label>
            <input type="text" class="form-control" name="no_hp_pelapor" id="no_hp_pelapor" placeholder="No Hp Pelapor" value="<?php echo $no_hp_pelapor; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Upload KTP <?php echo form_error('f_ktp_pelapor') ?></label>
            <input type="file" class="form-control" name="f_ktp_pelapor" id="v" placeholder="File KTP Pelapor (PDF/JPEG) max 2mb" value="<?php echo $f_ktp_pelapor; ?>" />
        </div>


         <!--korban
         <div class="form-group">
        <label for="varchar">DATA KORBAN</label>
        </div>
        <div class="form-group">
            <label for="varchar">Nik Korban <?php echo form_error('nik_korban') ?></label>
            <input type="number" class="form-control" name="nik_korban" id="nik_korban" placeholder="Nik Korban" value="<?php echo $nik_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Korban <?php echo form_error('nama_korban') ?></label>
            <input type="text" class="form-control" name="nama_korban" id="nama_korban" placeholder="Nama Korban" value="<?php echo $nama_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Agama Korban <?php echo form_error('agama_korban') ?></label>
            <select type="text" class="form-control" name="id_agama_korban" id="id_agama_korban" placeholder="Agama Korban" value="<?php echo $id_agama_korban; ?>" />
                <option value="<?php echo $id_agama_korban;?>"><?php echo $nama_agama_korban ?></option>
                <?php foreach($agama as $row) { ?>
                    <option value="<?php echo $row->id_agama ?>">
                        <?php echo $row->nama_agama; ?>
                        </option>
            <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Alamat Korban <?php echo form_error('alamat_korban') ?></label>
            <textarea type="text" class="form-control" name="alamat_korban" id="alamat_korban" placeholder="Alamat Korban" value="<?php echo $alamat_korban; ?>" /><?php echo $alamat_korban; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Kecamatan Korban <?php echo form_error('id_kecamatan') ?></label>
            <select class="selectpicker form-control" name="id_kecamatan_korban" id="id_kecamatan_korban" placeholder="Kecamatan Korban" value="<?php echo $id_kecamatan_korban; ?>" data-live-search="true"/>
                <option value="<?php echo $id_kecamatan_korban;?>"><?php echo $nama_kecamatan_korban ?></option>
                <?php foreach($kecamatan as $row) { ?>
                <option value="<?php echo $row->id_kecamatan ?>">
                    <?php echo $row->nama_kecamatan ?>
                    </option>
                <?php }; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Desa Korban <?php echo form_error('id_desa') ?></label>
            <select type="text" class="form-control" name="id_desa_korban" id="id_desa_korban" placeholder="Desa Korban" value="<?php echo $id_desa; ?>" />
                <option value="<?php echo $id_desa_korban;?>"><?php echo $nama_desa_korban; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">No Hp Korban <?php echo form_error('no_hp_korban') ?></label>
            <input type="text" class="form-control" name="no_hp_korban" id="no_hp_korban" placeholder="No Hp Korban" value="<?php echo $no_hp_korban; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Upload KTP <?php echo form_error('f_ktp_korban') ?></label>
            <input type="file" class="form-control" name="f_ktp_korban" id="v" placeholder="File KTP Korban (PDF/JPEG) max 2mb" value="<?php echo $f_ktp_korban; ?>" />
        </div>
-->

<div class="col-lg-12">
<div class="ibox ">
    <div class="ibox-title">
                               
        <h5>DATA KEJADIAN</h5>
    </div>

    <div class="ibox-content">
        <div class="form-group">
            <label for="int">Tempat Kejadian <?php echo form_error('tempat_kejadian') ?></label>
            <textarea type="text" class="form-control" name="tempat_kejadian" id="tempat_kejadian" placeholder="Tempat Kejadian" value="<?php echo $tempat_kejadian; ?>" /><?php echo $tempat_kejadian; ?></textarea>
        </div>
        <div class="form-group">
            <label for="longtext">Kronologi <?php echo form_error('kronologi') ?></label>
            <textarea type="text" class="form-control" name="kronologi" id="kronologi" placeholder="Kronologi" value="<?php echo $kronologi; ?>" /><?php echo $kronologi; ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Kejadian <?php echo form_error('tgl_kejadian') ?></label>
            <input type="date" class="form-control" name="tgl_kejadian" id="tgl_kejadian" placeholder="Tanggal Kejadian" value="<?php echo $tgl_kejadian; ?>" />
        </div>
    </div>
    </div>
    </div>
    <!--
        <div class="form-group">
        <label for="varchar">DATA KEJADIAN</label>
        </div>
	    
        <div class="form-group">
            <label for="int">Kecamatan Kejadian <?php echo form_error('id_kecamatan') ?></label>
            <select type="text" class="form-control" name="id_kecamatan_kejadian" id="id_kecamatan_kejadian" placeholder="Kecamatan Kejadian" value="<?php echo $id_kecamatan; ?>" />
                <option value="<?php echo $id_kecamatan;?>"><?php echo $nama_kecamatan ?></option>
                <?php foreach($kecamatan as $row) { ?>
                <option value="<?php echo $row->id_kecamatan ?>">
                    <?php echo $row->nama_kecamatan ?>
                    </option>
                <?php }; ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Desa Kejadian <?php echo form_error('id_desa') ?></label>
            <select type="text" class="form-control" name="id_desa_kejadian" id="id_desa_kejadian" placeholder="Desa Kejadian" value="<?php echo $id_desa; ?>" />
                <option value="<?php echo $id_desa;?>"><?php echo $nama_desa; ?></option>
        </select>
        </div>
    -->
	    <input type="hidden" name="no_pengaduan" value="<?php echo $no_pengaduan; ?>" />
        <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan; ?>" />
        <input type="hidden" name="id_pelapor" value="<?php echo $id_pelapor; ?>" />
        <input type="hidden" name="id_korban" value="<?php echo $id_korban; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengaduan') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
    
</html>