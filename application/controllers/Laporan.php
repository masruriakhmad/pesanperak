<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelapor_model');
        $this->load->model('Korban_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('Desa_model');
        $this->load->model('Agama_model');
        $this->load->model('Pengaduan_model');
        $this->load->library('form_validation');


    }

	//fungsi index
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $user_desa= $this->session->userdata('id_desa');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $pengaduan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
			'tgl_awal'	 		=> set_value('tgl_awal'),
			'tgl_akhir' 		=> set_value('tgl_akhir'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_list',
        );
		
       //echo '<pre>';  print_r($pengaduan); echo '</pre>';
        $this->load->view(layout(), $data);
    }

    //fungsi lookup
    public function lookup()
        {
            $q 		= urldecode($this->input->get('q', TRUE));
            $start 	= intval($this->input->get('start'));
            $idhtml = $this->input->get('idhtml');
            
            if ($q <> '') {
                $config['base_url'] 	= base_url() . 'pengaduan/index.html?q=' . urlencode($q);
                $config['first_url'] 	= base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] 	= base_url() . 'pengaduan/index.html';
                $config['first_url'] 	= base_url() . 'pengaduan/index.html';
            }
    
            $config['per_page'] 		= 10;
            $config['page_query_string']= TRUE;
            $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
            $pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q);
    
    
            $data = array(
                'pengaduan_data' 	=> $pengaduan,
                'idhtml' 			=> $idhtml,
                'q' 				=> $q,
                'total_rows' 		=> $config['total_rows'],
                'start' 			=> $start,
                'content' 			=> 'backend/pengaduan/pengaduan_lookup',
            );
            ob_start();
            $this->load->view($data['content'], $data);
            return ob_get_contents();
            ob_end_clean();
        }

        //fungsi filter laporan
        public function filter(){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
            $user_desa= $this->session->userdata('id_desa');
            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $pengaduan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
			'tgl_awal'	 		=> set_value('tgl_awal'),
			'tgl_akhir' 		=> set_value('tgl_akhir'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_list',
        );
		
       //echo '<pre>';  print_r($pengaduan); echo '</pre>';
        $this->load->view(layout(), $data);
            
        }

    //tampilan form yang akan dicetak
    public function laporan_read($id)
    {

    	 $row 			= $this->Pengaduan_model->get_by_id($id);
        
        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //untuk data pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //untuk data korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);
        
        if ($row) {

            $data = array(
		'id_pengaduan' => $row->id_pengaduan,
		'no_pengaduan' => $row->no_pengaduan,

		//pelapor
		'nik_pelapor' => $row->nik_pelapor,
		'nama_pelapor' => $row->nama_pelapor,
		'id_agama_pelapor' => $row_pelapor->id_agama,
		'nama_agama_pelapor' => $row_pelapor->nama_agama,
		'id_desa_pelapor' => $row_pelapor->id_desa,
		'nama_desa_pelapor' => $row_pelapor->nama_desa,
		'alamat_pelapor' => $row->alamat_pelapor,
		'no_hp_pelapor' => $row->no_hp_pelapor,
		'id_kecamatan_pelapor' => $row_pelapor->id_kecamatan,
		'nama_kecamatan_pelapor' => $row_pelapor->nama_kecamatan,

		//korban
		'nik_korban' => $row->nik_korban,
		'nama_korban' => $row->nama_korban,
		'id_agama_korban' => $row_korban->id_agama,
		'nama_agama_korban' => $row_korban->nama_agama,
		'id_desa_korban' => $row_korban->id_desa,
		'nama_desa_korban' => $row_korban->nama_desa,
		'alamat_korban' => $row->alamat_korban,
		'no_hp_korban' => $row->no_hp_korban,
		'id_kecamatan_korban' => $row_korban->id_kecamatan,
		'nama_kecamatan_korban' => $row_korban->nama_kecamatan,
		
		//kejadian
		'tempat_kejadian' => $row->tempat_kejadian,
		'id_desa_kejadian' => $row->id_desa,
		'nama_desa_kejadian' => $row->nama_desa,
		'id_kecamatan_kejadian' => $row->id_kecamatan,
		'nama_kecamatan_kejadian' => $row->nama_kecamatan,
		'kronologi' => $row->kronologi,
		'tgl_kejadian' => $row->tgl_kejadian,
		
		//tindaklanjut
		'tgl_tindak_lanjut' => $row->tgl_tindak_lanjut,
		'note_tindak_lanjut' => $row->note_tindak_lanjut,
		'tgl_penyelesaian' => $row->tgl_penyelesaian,
		'note_penyelesaian' => $row->note_penyelesaian,
		'tgl_monitoring' => $row->tgl_monitoring,
		'note_monitoring' => $row->note_monitoring,
		
		//keterangan
		'tgl_input' => $row->tgl_input,
		'nama_flag' => $row->nama_flag,
		'id_user' => $row->id_user,

		//content
		'content' => 'backend/laporan/laporan_read',
	    );

            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/laporan_index'));
        }

    }


    //index laporan rekap kecamatan
    function rekap_kecamatan_index(){

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $user_desa= $this->session->userdata('id_desa');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $this->Pengaduan_model->get_group_kecamatan(),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_list_kecamatan',
        );
		
       $this->load->view(layout(), $data);

    }

    //print laporan rekap kecamatan
    function rekap_kecamatan_print(){

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $user_desa= $this->session->userdata('id_desa');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $this->Pengaduan_model->get_group_kecamatan(),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_print_kecamatan',
        );
		
       $this->load->view($data['content'], $data);

    }

     //index laporan rekap desa
     function rekap_desa_index(){

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $user_desa= $this->session->userdata('id_desa');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $this->Pengaduan_model->get_group_desa(),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_list_desa',
        );
		
        $this->load->view(layout(), $data);

    }

     //print laporan rekap kecamatan
     function rekap_desa_print(){

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $user_desa= $this->session->userdata('id_desa');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$flag=1;
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $this->Pengaduan_model->get_group_desa(),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'session_desa'=> $this->session->userdata('id_desa'),
            'f_ktp_pelapor'=> '1.jpg',
            'f_ktp_korban'=>'1.jpg',
            'content' => 'backend/laporan/laporan_print_desa',
        );
		
       $this->load->view($data['content'], $data);

    }


     //laporan action (fungsi print pdf)
     public function laporan_print($id)
     {
         $row 			= $this->Pengaduan_model->get_by_id($id);
         
         //ambil nik pelapor dan korban
         $nik_pelapor 	= $row->nik_pelapor;
         $nik_korban 	= $row->nik_korban;
         $no_pengaduan 	= $row->no_pengaduan;
 
         //untuk data pelapor
         $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
         
         //untuk data korban
         $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);

         //file ktp pelapor dan korban ambil dengan parameter nama file
         $ekstensi='.jpg';
         $kodekorban='1';
         
         $f_ktp_pelapor = $no_pengaduan.$ekstensi;
         $f_ktp_korban = $no_pengaduan.$kodekorban.$ekstensi;
         
         if ($row) {
 
             $data = array(
         'id_pengaduan' => $row->id_pengaduan,
         'no_pengaduan' => $row->no_pengaduan,
 
         //pelapor
         'nik_pelapor' => $row->nik_pelapor,
         'nama_pelapor' => $row->nama_pelapor,
         'id_agama_pelapor' => $row_pelapor->id_agama,
         'nama_agama_pelapor' => $row_pelapor->nama_agama,
         'id_desa_pelapor' => $row_pelapor->id_desa,
         'nama_desa_pelapor' => $row_pelapor->nama_desa,
         'alamat_pelapor' => $row->alamat_pelapor,
         'no_hp_pelapor' => $row->no_hp_pelapor,
         'id_kecamatan_pelapor' => $row_pelapor->id_kecamatan,
         'nama_kecamatan_pelapor' => $row_pelapor->nama_kecamatan,
         'f_ktp_pelapor'=>$f_ktp_pelapor,
 
         //korban
         'nik_korban' => $row->nik_korban,
         'nama_korban' => $row->nama_korban,
         'id_agama_korban' => $row_korban->id_agama,
         'nama_agama_korban' => $row_korban->nama_agama,
         'id_desa_korban' => $row_korban->id_desa,
         'nama_desa_korban' => $row_korban->nama_desa,
         'alamat_korban' => $row->alamat_korban,
         'no_hp_korban' => $row->no_hp_korban,
         'id_kecamatan_korban' => $row_korban->id_kecamatan,
         'nama_kecamatan_korban' => $row_korban->nama_kecamatan,
         'f_ktp_korban'=>$f_ktp_korban,
         
         //kejadian
         'tempat_kejadian' => $row->tempat_kejadian,
         'id_desa_kejadian' => $row->id_desa,
         'nama_desa_kejadian' => $row->nama_desa,
         'id_kecamatan_kejadian' => $row->id_kecamatan,
         'nama_kecamatan_kejadian' => $row->nama_kecamatan,
         'kronologi' => $row->kronologi,
         'tgl_kejadian' => $row->tgl_kejadian,
         
         //tindaklanjut
         'tgl_tindak_lanjut' => $row->tgl_tindak_lanjut,
         'note_tindak_lanjut' => $row->note_tindak_lanjut,
         'tgl_penyelesaian' => $row->tgl_penyelesaian,
         'note_penyelesaian' => $row->note_penyelesaian,
         'tgl_monitoring' => $row->tgl_monitoring,
         'note_monitoring' => $row->note_monitoring,
         
         //keterangan
         'tgl_input' => $row->tgl_input,
         'nama_flag' => $row->nama_flag,
         'id_user' => $row->id_user,
 
         //content
         'content' => 'backend/laporan/template_surat',
         );
 
             $this->load->view('backend/laporan/laporan_print', $data);
         } else {
             $this->session->set_flashdata('message', 'Record Not Found');
             redirect(site_url('pengaduan/laporan_index'));
         }
     }


}

/* End of file Pengaduan.php */
/* Location: ./application/controllers/Pengaduan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 09:42:38 */
/* http://harviacode.com */