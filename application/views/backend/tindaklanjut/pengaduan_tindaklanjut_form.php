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
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">No Pengaduan <?php echo form_error('no_pengaduan') ?></label>
            <input type="text" class="form-control" name="no_pengaduan" id="no_pengaduan" placeholder="No Pengaduan" value="<?php echo $no_pengaduan; ?>" disabled/>
        </div>
        <table class="table">
        <tr><td>No Pengaduan</td><td><?php echo $no_pengaduan; ?></td></tr>
        
        <tr><td><h4><b>DATA PELAPOR</b></h4></td><td></td></tr>
        <tr><td>NIK Pelapor</td><td><?php echo $nik_pelapor; ?></td></tr>
        <tr><td>Nama Pelapor</td><td><?php echo $nama_pelapor; ?></td></tr>
        <tr><td>Agama Pelapor</td><td><?php echo $nama_agama_pelapor; ?></td></tr>
        <tr><td>Alamat Pelapor</td><td><?php echo $alamat_pelapor; ?></td></tr>
        <tr><td>Kecamatan Pelapor</td><td><?php echo $nama_kecamatan_pelapor; ?></td></tr>
        <tr><td>Desa Pelapor</td><td><?php echo $nama_desa_pelapor; ?></td></tr>
        
        <tr><td><h4><b>DATA KORBAN</b></h4></td><td></td></tr>
        <tr><td>NIK Korban</td><td><?php echo $nik_korban; ?></td></tr>
        <tr><td>Nama Korban</td><td><?php echo $nama_korban; ?></td></tr>
        <tr><td>Agama Korban</td><td><?php echo $nama_agama_korban; ?></td></tr>
        <tr><td>Alamat Korban</td><td><?php echo $alamat_korban; ?></td></tr>
        <tr><td>Kecamatan Korban</td><td><?php echo $nama_kecamatan_korban; ?></td></tr>
        <tr><td>Desa Korban</td><td><?php echo $nama_desa_korban; ?></td></tr>

        <tr><td><h4><b>DATA KEJADIAN</b></h4></td><td></td></tr>
        <tr><td>Tempat Kejadian</td><td><?php echo $tempat_kejadian; ?></td></tr>
        <tr><td>Desa Kejadian</td><td><?php echo $nama_desa_kejadian; ?></td></tr>
        <tr><td>Kecamatan Kejadian</td><td><?php echo $nama_kecamatan_kejadian; ?></td></tr>
        <tr><td>Kronologi</td><td><?php echo $kronologi; ?></td></tr>
        <tr><td>Tanggal Kejadian</td><td><?php echo $tgl_kejadian; ?></td></tr>

        <tr><td><h4><b>DATA TINDAK LANJUT</b></h4></td><td></td></tr>
        <tr><td>Tanggal Tindak Lanjut</b></h4></td><td><?php echo $tgl_tindak_lanjut; ?></td></tr>
        <tr><td>Note Tindak Lanjut</td><td><?php echo $note_tindak_lanjut; ?></td></tr>
        <tr><td>Tanggal Penyelesaian</td><td><?php echo $tgl_penyelesaian; ?></td></tr>
        <tr><td>Note Penyelesaian</td><td><?php echo $note_penyelesaian; ?></td></tr>
        <tr><td>Tanggal Monitoring</td><td><?php echo $tgl_monitoring; ?></td></tr>
        <tr><td>Note Monitoring</td><td><?php echo $note_monitoring; ?></td></tr>

        <tr><td><h4><b>KETERANGAN</b></h4></td><td></td></tr>
        <tr><td>Tanggal Input</td><td><?php echo $tgl_input; ?></td></tr>
        <tr><td>Status</td><td><h4><?php echo $nama_flag; ?></h4></td></tr>
        <!--
        <tr><td>Dibuat Oleh</td><td><?php echo $id_user; ?></td></tr>
    -->
        <tr><td></td><td><a href="<?php echo site_url('pengaduan') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>

        <!--PELAPOR-->
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


         <!--korban-->
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
            <select type="text" class="form-control" name="agama_korban" id="agama_korban" placeholder="Agama Korban" value="<?php echo $agama_korban; ?>" />
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
            <select type="text" class="form-control" name="id_kecamatan_korban" id="id_kecamatan_korban" placeholder="Kecamatan Korban" value="<?php echo $id_kecamatan_korban; ?>" />
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
        <label for="varchar">DATA KEJADIAN</label>
        </div>
	    <div class="form-group">
            <label for="int">Tempat Kejadian <?php echo form_error('tempat_kejadian') ?></label>
            <textarea type="text" class="form-control" name="tempat_kejadian" id="tempat_kejadian" placeholder="Tempat Kejadian" value="<?php echo $tempat_kejadian; ?>" /><?php echo $tempat_kejadian; ?></textarea>
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
	    <div class="form-group">
            <label for="longtext">Kronologi <?php echo form_error('kronologi') ?></label>
            <textarea type="text" class="form-control" name="kronologi" id="kronologi" placeholder="Kronologi" value="<?php echo $kronologi; ?>" /><?php echo $kronologi; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Kejadian <?php echo form_error('tgl_kejadian') ?></label>
            <input type="date" class="form-control" name="tgl_kejadian" id="tgl_kejadian" placeholder="Tanggal Kejadian" value="<?php echo $tgl_kejadian; ?>" />
        </div>
	    <!--
        <div class="form-group">
            <label for="date">Tgl Tindak Lanjut <?php echo form_error('tgl_tindak_lanjut') ?></label>
            <input type="text" class="form-control" name="tgl_tindak_lanjut" id="tgl_tindak_lanjut" placeholder="Tgl Tindak Lanjut" value="<?php echo $tgl_tindak_lanjut; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Tindak Lanjut <?php echo form_error('note_tindak_lanjut') ?></label>
            <input type="text" class="form-control" name="note_tindak_lanjut" id="note_tindak_lanjut" placeholder="Note Tindak Lanjut" value="<?php echo $note_tindak_lanjut; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Penyelesaian <?php echo form_error('tgl_penyelesaian') ?></label>
            <input type="text" class="form-control" name="tgl_penyelesaian" id="tgl_penyelesaian" placeholder="Tgl Penyelesaian" value="<?php echo $tgl_penyelesaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Penyelesaian <?php echo form_error('note_penyelesaian') ?></label>
            <input type="text" class="form-control" name="note_penyelesaian" id="note_penyelesaian" placeholder="Note Penyelesaian" value="<?php echo $note_penyelesaian; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Monitoring <?php echo form_error('tgl_monitoring') ?></label>
            <input type="text" class="form-control" name="tgl_monitoring" id="tgl_monitoring" placeholder="Tgl Monitoring" value="<?php echo $tgl_monitoring; ?>" />
        </div>
	    <div class="form-group">
            <label for="longtext">Note Monitoring <?php echo form_error('note_monitoring') ?></label>
            <input type="text" class="form-control" name="note_monitoring" id="note_monitoring" placeholder="Note Monitoring" value="<?php echo $note_monitoring; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Input <?php echo form_error('tgl_input') ?></label>
            <input type="text" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tgl Input" value="<?php echo $tgl_input; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Flag <?php echo form_error('flag') ?></label>
            <input type="text" class="form-control" name="flag" id="flag" placeholder="Flag" value="<?php echo $flag; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
    -->
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