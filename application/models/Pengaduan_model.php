<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{

    public $table = 'pengaduan';
    public $id = 'id_pengaduan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
        $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
        $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
        $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
        $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }


    
      // get groupby bulan
      function get_groupby_bulan()
      {
        $query= "SELECT DISTINCT MONTH(tgl_input) AS bulan, COUNT(no_pengaduan) AS jml_pengaduan
        FROM 
        pengaduan
        GROUP BY bulan
        "; 
        return $this->db->query($query)->result();
      }

    //fungsi rekap jumlah pada dashboard $where itu status flag, param adalah id_desa
    function get_jumlah($flag,$params)
    {
    
    if ($params==NULL){

    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->where('pengaduan.id_flag', $flag);
    $this->db->from($this->table);
        return $this->db->count_all_results();

        }else{

    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->where('pengaduan.id_flag', $flag);
    $this->db->where('pengaduan.id_desa', $params);
    $this->db->from($this->table);
        return $this->db->count_all_results();
        }
    }


    // get data by id
    function get_by_id($id)
    {
       // $this->db->select('desa.nama_desa AS nama_desa_pelapor');
        $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
        $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
        $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
        $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
        $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
        //$this->db->join('agama','agama.id_agama=pelapor.id_agama');
        //$this->db->join('agama','agama.id_agama=korban.id_agama');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->like('id_pengaduan', $q);
	$this->db->or_like('pengaduan.no_pengaduan', $q);
	$this->db->or_like('pengaduan.nik_pelapor', $q);
	$this->db->or_like('pengaduan.nik_korban', $q);
	$this->db->or_like('pengaduan.tempat_kejadian', $q);
	$this->db->or_like('pengaduan.id_desa', $q);
	$this->db->or_like('pengaduan.kronologi', $q);
	$this->db->or_like('pengaduan.tgl_kejadian', $q);
	$this->db->or_like('pengaduan.tgl_tindak_lanjut', $q);
	$this->db->or_like('pengaduan.note_tindak_lanjut', $q);
	$this->db->or_like('pengaduan.tgl_penyelesaian', $q);
	$this->db->or_like('pengaduan.note_penyelesaian', $q);
	$this->db->or_like('pengaduan.tgl_monitoring', $q);
	$this->db->or_like('pengaduan.note_monitoring', $q);
	$this->db->or_like('pengaduan.tgl_input', $q);
	$this->db->or_like('pengaduan.id_flag', $q);
	$this->db->or_like('pengaduan.id_user', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }
/*
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->order_by($this->id, $this->order);
    
    $this->db->like('pengaduan.id_pengaduan', $q);
	$this->db->or_like('pengaduan.no_pengaduan', $q);
	$this->db->or_like('pengaduan.nik_pelapor', $q);
	$this->db->or_like('pengaduan.nik_korban', $q);
	$this->db->or_like('pengaduan.tempat_kejadian', $q);
	$this->db->or_like('pengaduan.id_desa', $q);
	$this->db->or_like('pengaduan.kronologi', $q);
	$this->db->or_like('pengaduan.tgl_kejadian', $q);
	$this->db->or_like('pengaduan.tgl_tindak_lanjut', $q);
	$this->db->or_like('pengaduan.note_tindak_lanjut', $q);
	$this->db->or_like('pengaduan.tgl_penyelesaian', $q);
	$this->db->or_like('pengaduan.note_penyelesaian', $q);
	$this->db->or_like('pengaduan.tgl_monitoring', $q);
	$this->db->or_like('pengaduan.note_monitoring', $q);
	$this->db->or_like('pengaduan.tgl_input', $q);
	$this->db->or_like('pengaduan.id_flag', $q);
	$this->db->or_like('pengaduan.id_user', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
*/

//data laporan masuk,pending,ditindaklanjuti selesai, dimonitor grup by id kecamatan
//data laporan masuk,pending,ditindaklanjuti selesai, dimonitor grup by id desa

 // get by desa
 function get_group_desa()
 {
    
    $sql= "SELECT *,
            COUNT(no_pengaduan) AS jml_masuk,
            COUNT(IF(id_flag=1,id_flag,NULL)) AS jml_pending,
            COUNT(IF(id_flag=2,id_flag,NULL)) AS jml_tindaklanjut,
            COUNT(IF(id_flag=3,id_flag,NULL)) AS jml_selesai,
            COUNT(IF(id_flag=4,id_flag,NULL)) AS jml_monitoring
            FROM pengaduan JOIN desa
            ON pengaduan.id_desa=desa.id_desa
            GROUP BY desa.id_desa
            "; 
     return $this->db->query($sql)->result();
 }

  // get  rekap jumlah by kecamatan
  function get_group_kecamatan()
  {
     
     $sql= "SELECT *,
             COUNT(no_pengaduan) AS jml_masuk,
             COUNT(IF(id_flag=1,id_flag,NULL)) AS jml_pending,
             COUNT(IF(id_flag=2,id_flag,NULL)) AS jml_tindaklanjut,
             COUNT(IF(id_flag=3,id_flag,NULL)) AS jml_selesai,
             COUNT(IF(id_flag=4,id_flag,NULL)) AS jml_monitoring
             FROM 
             pengaduan JOIN desa 
             ON pengaduan.id_desa=desa.id_desa
             JOIN kecamatan 
             ON desa.id_kecamatan=kecamatan.id_kecamatan 
             GROUP BY kecamatan.id_kecamatan
             "; 
      return $this->db->query($sql)->result();
  }

    // get data with limit 
    function get_limit_data($limit, $start = 0, $q = NULL,$flag) {
        $this->db->where('pengaduan.id_flag', $flag);
        $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
        $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
        $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
        $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
        $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
                }

    // get data with limit untuk user desa
    function get_limit_data_where($limit, $start = 0, $q = NULL, $user_desa, $flag) {
    $this->db->where('pengaduan.id_desa', $user_desa);
    $this->db->where('pengaduan.id_flag', $flag);
    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->order_by($this->id, $this->order);
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

     // get total rows tindaklanjut
    function total_rows_tindaklanjut($q = NULL) {
    $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
    $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
    $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
    $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
    $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
    $this->db->like('id_pengaduan', $q);
    $this->db->or_like('pengaduan.no_pengaduan', $q);
    $this->db->or_like('pengaduan.nik_pelapor', $q);
    $this->db->or_like('pengaduan.nik_korban', $q);
    $this->db->or_like('pengaduan.tempat_kejadian', $q);
    $this->db->or_like('pengaduan.id_desa', $q);
    $this->db->or_like('pengaduan.kronologi', $q);
    $this->db->or_like('pengaduan.tgl_kejadian', $q);
    $this->db->or_like('pengaduan.tgl_tindak_lanjut', $q);
    $this->db->or_like('pengaduan.note_tindak_lanjut', $q);
    $this->db->or_like('pengaduan.tgl_penyelesaian', $q);
    $this->db->or_like('pengaduan.note_penyelesaian', $q);
    $this->db->or_like('pengaduan.tgl_monitoring', $q);
    $this->db->or_like('pengaduan.note_monitoring', $q);
    $this->db->or_like('pengaduan.tgl_input', $q);
    $this->db->or_like('pengaduan.id_flag', $q);
    $this->db->or_like('pengaduan.id_user', $q);
    //$this->db->where($this->table);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search tindaklanjut
    function get_limit_data_tindaklanjut($limit, $start = 0, $q = NULL) {
        $this->db->join('pelapor','pelapor.nik_pelapor=pengaduan.nik_pelapor');
        $this->db->join('korban','korban.nik_korban=pengaduan.nik_korban');
        $this->db->join('desa','desa.id_desa=pengaduan.id_desa');
        $this->db->join('kecamatan','kecamatan.id_kecamatan=desa.id_kecamatan');
        $this->db->join('flag','flag.id_flag=pengaduan.id_flag');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('pengaduan.id_pengaduan', $q);
    $this->db->or_like('pengaduan.no_pengaduan', $q);
    $this->db->or_like('pengaduan.nik_pelapor', $q);
    $this->db->or_like('pengaduan.nik_korban', $q);
    $this->db->or_like('pengaduan.tempat_kejadian', $q);
    $this->db->or_like('pengaduan.id_desa', $q);
    $this->db->or_like('pengaduan.kronologi', $q);
    $this->db->or_like('pengaduan.tgl_kejadian', $q);
    $this->db->or_like('pengaduan.tgl_tindak_lanjut', $q);
    $this->db->or_like('pengaduan.note_tindak_lanjut', $q);
    $this->db->or_like('pengaduan.tgl_penyelesaian', $q);
    $this->db->or_like('pengaduan.note_penyelesaian', $q);
    $this->db->or_like('pengaduan.tgl_monitoring', $q);
    $this->db->or_like('pengaduan.note_monitoring', $q);
    $this->db->or_like('pengaduan.tgl_input', $q);
    $this->db->or_like('pengaduan.id_flag', $q);
    $this->db->or_like('pengaduan.id_user', $q);
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

        //fungsi untuk mendapatkan kode
    function get_no_pengaduan(){

        date_default_timezone_set('Asia/Jakarta');

        $date=date('Y-m-d');

        $q = $this->db->query("SELECT MAX(RIGHT(no_pengaduan,4)) AS kd_max FROM pengaduan WHERE DATE(tgl_input)=CURDATE()");

        $kd = "";

        if($q->num_rows()>0){

            foreach($q->result() as $k){

                $tmp = ((int)$k->kd_max)+1;

                $kd = sprintf("%04s", $tmp);

            }

        }else{

            $kd = "0001";

        }

        $inisial="P";

        date_default_timezone_set('Asia/Jakarta');

        return $inisial.date('ymd').$kd;

     }

}

/* End of file Pengaduan_model.php */
/* Location: ./application/models/Pengaduan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 09:42:38 */
/* http://harviacode.com */