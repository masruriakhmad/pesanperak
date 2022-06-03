<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengaduan extends CI_Controller
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
        $this->load->helper('sf');

    }

    //fungsi index
    public function index()
    {
		//variable q  dari input tex pencarian
		//variable start dari nomr urut ditampilan dataset di view
        $q 		= urldecode($this->input->get('q', TRUE));
        $start	= intval($this->input->get('start'));
        
		//jika variabel q tidak bernilai kosong maka base url dan first url ditambah urlencode dari variablel q
        if ($q <> '') {
            $config['base_url'] 	= base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] 	= base_url() . 'pengaduan/index.html?q=' . urlencode($q);

		//jika tidak maka base url dan first url adalah index.html
        } else {
            $config['base_url'] 	= base_url() . 'pengaduan/index.html';
            $config['first_url'] 	= base_url() . 'pengaduan/index.html';
        }
		//setting pagination
        $config['per_page'] 		= 10;
        $config['page_query_string']= TRUE;
        $config['total_rows'] 		= $this->Pengaduan_model->total_rows($q);
		
        $user_desa= $this->session->userdata('id_desa');
		$flag	=1;

		//jika user desa tidak null data difilter by user data
        if($user_desa!=NULL){

			$pengaduan = $this->Pengaduan_model->get_limit_data_where($config['per_page'], $start, $q, $user_desa,$flag);
			
		//jika tidak data tidak difilter menurut user desa	
        }else{

			$pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q, $flag);

        }
        
		//meload library  dan inisialisasi pagination bawaan codeigniter dengan config yang ada
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        //data yang akan digunakan pada view
		$data = array(
            'pengaduan_data' 	=> $pengaduan,
            'q' 				=> $q, 									//pendeklarasian variabel q
            'pagination' 		=> $this->pagination->create_links(), 	// pembuatan link untuk pagination
            'total_rows' 		=> $config['total_rows'], 				//variabel untuk total baris
            'start' 			=> $start, 								//pendeklarasian variabel start
			'session_desa'		=> $this->session->userdata('id_desa'), //data session user desa
            'content' 			=> 'backend/pengaduan/pengaduan_list', 	//data content yang dipanggil
        );

		/*
		//header('Content-Type: application/json');
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Data table',
						'data'	  => $pengaduan
                    )
                );

		//var_dump($data['pengaduan_data']);
		/*
		foreach($datalist AS $dataset){
			echo $dataset->no_pengaduan;
			echo "<br>";
		}
		*/

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

    //fungsi read pengaduan
    public function read($id) 
    {
		//pengambilan row/hasil query read dari table pengaduan
        $row 			= $this->Pengaduan_model->get_by_id($id);
        
        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //pengambilan data  pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //pengambilan data korban korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);
        
		//jika hasil $row True makan set data dari table
        if ($row) {
			//data array untuk dilempar ke view
            $data = array(
		'id_pengaduan' 			=> $row->id_pengaduan,
		'no_pengaduan' 			=> $row->no_pengaduan,

		//pelapor
		'nik_pelapor' 			=> $row->nik_pelapor,
		'nama_pelapor' 			=> $row->nama_pelapor,
		'id_agama_pelapor' 		=> $row_pelapor->id_agama,
		'nama_agama_pelapor' 	=> $row_pelapor->nama_agama,
		'id_desa_pelapor' 		=> $row_pelapor->id_desa,
		'nama_desa_pelapor' 	=> $row_pelapor->nama_desa,
		'alamat_pelapor' 		=> $row->alamat_pelapor,
		'no_hp_pelapor' 		=> $row->no_hp_pelapor,
		'id_kecamatan_pelapor' 	=> $row_pelapor->id_kecamatan,
		'nama_kecamatan_pelapor'=> $row_pelapor->nama_kecamatan,

		//korban
		'nik_korban' 			=> $row->nik_korban,
		'nama_korban' 			=> $row->nama_korban,
		'id_agama_korban' 		=> $row_korban->id_agama,
		'nama_agama_korban' 	=> $row_korban->nama_agama,
		'id_desa_korban' 		=> $row_korban->id_desa,
		'nama_desa_korban' 		=> $row_korban->nama_desa,
		'alamat_korban' 		=> $row->alamat_korban,
		'no_hp_korban' 			=> $row->no_hp_korban,
		'id_kecamatan_korban' 	=> $row_korban->id_kecamatan,
		'nama_kecamatan_korban' => $row_korban->nama_kecamatan,
		
		//kejadian
		'tempat_kejadian' 		=> $row->tempat_kejadian,
		'id_desa_kejadian' 		=> $row->id_desa,
		'nama_desa_kejadian' 	=> $row->nama_desa,
		'id_kecamatan_kejadian' => $row->id_kecamatan,
		'nama_kecamatan_kejadian'=> $row->nama_kecamatan,
		'kronologi' 			=> $row->kronologi,
		'tgl_kejadian' 			=> $row->tgl_kejadian,
		
		//tindaklanjut
		'tgl_tindak_lanjut' 	=> $row->tgl_tindak_lanjut,
		'note_tindak_lanjut' 	=> $row->note_tindak_lanjut,
		'tgl_penyelesaian' 		=> $row->tgl_penyelesaian,
		'note_penyelesaian' 	=> $row->note_penyelesaian,
		'tgl_monitoring' 		=> $row->tgl_monitoring,
		'note_monitoring' 		=> $row->note_monitoring,
		
		//keterangan
		'tgl_input' 			=> $row->tgl_input,
		'nama_flag' 			=> $row->nama_flag,
		'id_user' 				=> $row->id_user,

		//content
		'content' 				=> 'backend/pengaduan/pengaduan_read',
	    );

			//panggil view
            $this->load->view(layout(), $data);

		//jika $row tidak true redirect ke Pengaduan Index
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan'));
        }
    }

    //fungsi create form pengaduan
    public function create() 
    {
    	if($this->session->userdata('id_desa')==NULL){

    		$this->session->set_flashdata('message', 'Input Data Harus melalui User Desa');
            redirect(site_url('pengaduan'));
   

    	}else {
        
        $data = array(
        'button' 				=> 'Create',
        'action' 				=> site_url('pengaduan/create_action'),

        //Data Aduan
	    'id_pengaduan' 			=> set_value('id_pengaduan'),
	    'no_pengaduan' 			=> $this->Pengaduan_model->get_no_pengaduan(),
	    'tempat_kejadian' 		=> set_value('tempat_kejadian'),
	    'id_desa' 				=> set_value('id_desa'),
	    'nama_desa' 			=> set_value('nama_desa'),
	    'id_kecamatan' 			=> set_value('id_kecamatan'),
	    'nama_kecamatan' 		=> set_value('nama_kecamatan'),
	    'kronologi' 			=> set_value('kronologi'),
	    'tgl_kejadian' 			=> set_value('tgl_kejadian'),
	    'tgl_tindak_lanjut' 	=> set_value('tgl_tindak_lanjut'),
	    'note_tindak_lanjut' 	=> set_value('note_tindak_lanjut'),
	    'tgl_penyelesaian' 		=> set_value('tgl_penyelesaian'),
	    'note_penyelesaian' 	=> set_value('note_penyelesaian'),
	    'tgl_monitoring' 		=> set_value('tgl_monitoring'),
	    'note_monitoring' 		=> set_value('note_monitoring'),
	    'tgl_input' => set_value('tgl_input'),
	    'id_flag' => set_value('id_flag'),
	    'id_user' => set_value('id_user'),

	    //pelapor
	    'id_pelapor' => set_value('id_pelapor'),
	    'nik_pelapor' => set_value('nik_pelapor'),
	    'nama_pelapor' => set_value('nama_pelapor'),
	    'id_agama_pelapor' => set_value('id_agama_pelapor'),
	    'nama_agama_pelapor' => set_value('nama_agama_pelapor'),
	    'alamat_pelapor' => set_value('alamat_pelapor'),
	    'id_kecamatan_pelapor' => set_value('id_kecamatan_pelapor'),
	    'nama_kecamatan_pelapor' => set_value('nama_kecamatan_pelapor'),
	    'id_desa_pelapor' => set_value('id_desa_pelapor'),
	    'nama_desa_pelapor' => set_value('nama_desa_pelapor'),
	    'no_hp_pelapor' => set_value('no_hp_pelapor'),
	    'f_ktp_pelapor' => set_value('f_ktp_pelapor'),

	    //
	    'id_korban' => set_value('id_korban'),
	    'nik_korban' => set_value('nik_korban'),
	    'nama_korban' => set_value('nama_korban'),
	    'id_agama_korban' => set_value('id_agama_korban'),
	    'nama_agama_korban' => set_value('nama_agama_korban'),
	    'alamat_korban' => set_value('alamat_korban'),
	    'id_kecamatan_korban' => set_value('id_kecamatan_korban'),
	    'nama_kecamatan_korban' => set_value('nama_kecamatan_korban'),
	    'id_desa_korban' => set_value('id_desa_korban'),
	    'nama_desa_korban' => set_value('nama_desa_korban'),
	    'no_hp_korban' => set_value('id_hp_korban'),
	    'f_ktp_korban' => set_value('f_ktp_korban'),

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/pengaduan_form',
	);
        $this->load->view(layout(), $data);

      }
    }
    
    //fungsi proses simpan pengaduan
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        	$data_pelapor=array(
       	'nik_pelapor' 	=> $this->input->post('nik_pelapor',TRUE),
	    'nama_pelapor' 	=> $this->input->post('nama_pelapor',TRUE),
	    'id_agama' 		=> $this->input->post('id_agama_pelapor',TRUE),
	    'alamat_pelapor'=> $this->input->post('alamat_pelapor',TRUE),
	    'id_desa' 		=> $this->input->post('id_desa_pelapor',TRUE),
	    'no_hp_pelapor' => $this->input->post('no_hp_pelapor',TRUE),
        	);


            $data_korban=array(
        'nik_korban' => $this->input->post('nik_korban',TRUE),
	    'nama_korban' => $this->input->post('nama_korban',TRUE),
	    'id_agama' => $this->input->post('id_agama_korban',TRUE),
	    'alamat_korban' => $this->input->post('alamat_korban',TRUE),
	    'id_desa' => $this->input->post('id_desa_korban',TRUE),
	    'no_hp_korban' => $this->input->post('no_hp_korban',TRUE),
            );

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		'tempat_kejadian' => $this->input->post('tempat_kejadian',TRUE),
        'nik_pelapor' => $this->input->post('nik_pelapor',TRUE),
        'nik_korban' => $this->input->post('nik_korban',TRUE),
		'id_desa' => $this->session->userdata('id_desa'),
		'kronologi' => $this->input->post('kronologi',TRUE),
		'tgl_kejadian' => $this->input->post('tgl_kejadian',TRUE),
		'tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		'id_user' => $this->session->userdata('id_user'),
		'tgl_input' => date('Y-m-d H:i:s'),
		'id_flag' => 1,

	    );

            if($this->input->method()==='post')
            {

			$lokasi_gambar 	= '/uploads/ktp/';
			$tipe_gambar 	= 'jpg|jpeg|png';
			$ukuran_gambar 	= 2048;
			sf_upload($data['nik_pelapor'], $lokasi_gambar, $tipe_gambar, $ukuran_gambar, "f_ktp_pelapor");
			sf_upload($data['nik_korban'], $lokasi_gambar, $tipe_gambar, $ukuran_gambar, "f_ktp_pelapor");
           	$this->Pelapor_model->insert($data_pelapor);
            $this->Korban_model->insert($data_korban);
            $this->Pengaduan_model->insert($data);
            $this->session->set_flashdata('message', 'Data Pengaduan Sukses Tersimpan');
            redirect(site_url('pengaduan'));	

            }
        }
    }
    
    //fungsi update form pengaduan
    public function update($id) 
    {
        
        $row = $this->Pengaduan_model->get_by_id($id);

        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //untuk data pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //untuk data korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);


        if ($row) {
            $data = array(
        'button' => 'Update',
        'action' => site_url('pengaduan/update_action'),
		
		//pengaduan
		'id_pengaduan' => set_value('id_pengaduan', $row->id_pengaduan),
		'no_pengaduan' => set_value('no_pengaduan', $row->no_pengaduan),
		'tempat_kejadian' => set_value('tempat_kejadian', $row->tempat_kejadian),
		'id_desa' => set_value('id_desa', $row->id_desa),
		'nama_desa' => set_value('nama_desa', $row->nama_desa),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
		'nama_kecamatan' => set_value('nama_kecamatan', $row->nama_kecamatan),
		'kronologi' => set_value('kronologi', $row->kronologi),
		'tgl_kejadian' => set_value('tgl_kejadian', $row->tgl_kejadian),
		
		//tindak lanjut
		'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut', $row->tgl_tindak_lanjut),
		'note_tindak_lanjut' => set_value('note_tindak_lanjut', $row->note_tindak_lanjut),
		'tgl_penyelesaian' => set_value('tgl_penyelesaian', $row->tgl_penyelesaian),
		'note_penyelesaian' => set_value('note_penyelesaian', $row->note_penyelesaian),
		'tgl_monitoring' => set_value('tgl_monitoring', $row->tgl_monitoring),
		'note_monitoring' => set_value('note_monitoring', $row->note_monitoring),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'id_flag' => set_value('id_flag', $row->id_flag),
		'id_user' => set_value('id_user', $row->id_user),

		//pelapor
		'id_pelapor' => set_value('id_korban', $row->id_pelapor),
		'nik_pelapor' => set_value('nik_pelapor', $row->nik_pelapor),
	    'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
	    'id_agama_pelapor' => set_value('id_agama_pelapor', $row_pelapor->id_agama),
	    'nama_agama_pelapor' => set_value('nama_agama_pelapor', $row_pelapor->nama_agama),
	    'f_ktp_pelapor' => set_value('f_ktp_pelapor'),
	    'id_desa_pelapor' => set_value('id_desa_pelapor', $row_pelapor->id_desa),
	    'nama_desa_pelapor' => set_value('nama_desa_pelapor', $row_pelapor->nama_desa),
	    'id_kecamatan_pelapor' => set_value('id_kecamatan_pelapor', $row_pelapor->id_kecamatan),
	    'nama_kecamatan_pelapor' => set_value('nama_kecamatan_pelapor', $row_pelapor->nama_kecamatan),
	    'alamat_pelapor' => set_value('alamat_pelapor', $row->alamat_pelapor),
	    'no_hp_pelapor' => set_value('no_hp_pelapor', $row->no_hp_pelapor),

		//korban
		'id_korban' => set_value('id_korban', $row->id_korban),
		'nik_korban' => set_value('nik_korban', $row->nik_korban),
	    'nama_korban' => set_value('nama_korban', $row->nama_korban),
	    'id_agama_korban' => set_value('id_agama_korban', $row_korban->id_agama),
	    'nama_agama_korban' => set_value('nama_agama_korban', $row_korban->nama_agama),
	    'id_desa_korban' => set_value('id_desa_korban', $row_korban->id_desa),
	    'nama_desa_korban' => set_value('nama_desa_korban', $row_korban->nama_desa),
	    'id_kecamatan_korban' => set_value('id_kecamatan_korban', $row_korban->id_kecamatan),
	    'nama_kecamatan_korban' => set_value('nama_kecamatan_korban', $row_korban->nama_kecamatan),
	    'alamat_korban' => set_value('alamat_korban', $row->alamat_korban),
	    'no_hp_korban' => set_value('no_hp_korban', $row->no_hp_korban),
	    'f_ktp_korban' => set_value('f_ktp_korban'),

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/pengaduan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan'));
        }
    }
    
    //fungsi proses update pengaduan
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengaduan', TRUE));
        } else {

            $data_pelapor = array(
		'nik_pelapor' => $this->input->post('nik_pelapor',TRUE),
		'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
		'alamat_pelapor' => $this->input->post('alamat_pelapor',TRUE),
		'no_hp_pelapor' => $this->input->post('no_hp_pelapor',TRUE),
		'id_agama' => $this->input->post('id_agama_pelapor',TRUE),
		'id_desa' => $this->input->post('id_desa_pelapor',TRUE),
		
	    );

         	$data_korban = array(
		'nik_korban' => $this->input->post('nik_korban',TRUE),
		'nama_korban' => $this->input->post('nama_korban',TRUE),
		'alamat_korban' => $this->input->post('alamat_korban',TRUE),
		'no_hp_korban' => $this->input->post('no_hp_korban',TRUE),
		'id_agama' => $this->input->post('id_agama_korban',TRUE),
		'id_desa' => $this->input->post('id_desa_korban',TRUE),
		
	    );

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		'nik_pelapor' => $this->input->post('nik_pelapor',TRUE),
		'nik_korban' => $this->input->post('nik_korban',TRUE),
		'tempat_kejadian' => $this->input->post('tempat_kejadian',TRUE),
		'id_desa' => $this->session->userdata('id_desa'),
		'kronologi' => $this->input->post('kronologi',TRUE),
		'tgl_kejadian' => $this->input->post('tgl_kejadian',TRUE),
		'tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		);

		
            //update pelapor, update korban, update pengaduan
            $this->Pelapor_model->update($this->input->post('id_pelapor', TRUE), $data_pelapor);
            $this->Korban_model->update($this->input->post('id_korban', TRUE), $data_korban);
            $this->Pengaduan_model->update($this->input->post('id_pengaduan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengaduan'));
        }
    }

    /*
    fungsi tindaklanjut untuk mengupdate nilai pada field :
    1. tgl_tindaklanjut
    2. note_tindaklanjut
    3. flag (dimana flag akan berubah ke status ditindaklanjuti id 2)
    */
    //fungsi tindaklanjut
    
    public function tindaklanjut_index()
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

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
		
		$user_desa= $this->session->userdata('id_desa');
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
            'content' => 'backend/pengaduan/tindaklanjut_pengaduan_list',
        );


        $this->load->view(layout(), $data);

    }

    public function tindaklanjut_create($id)
    {
		
		if($this->session->userdata['id_desa'] != NULL){

			$this->session->set_flashdata('message', 'Anda Bukan User Kabupaten (Tindak Lanjut dilakukan oleh User Kabupaten');
            redirect(site_url('pengaduan/tindaklanjut_index'));

		}else{

			$row = $this->Pengaduan_model->get_by_id($id);

        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //untuk data pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //untuk data korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);


        if ($row) {
            $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengaduan/tindaklanjut_action'),
		
		//pengaduan
		'id_pengaduan' => set_value('id_pengaduan', $row->id_pengaduan),
		'no_pengaduan' => set_value('no_pengaduan', $row->no_pengaduan),
		'tempat_kejadian' => set_value('tempat_kejadian', $row->tempat_kejadian),
		'id_desa_kejadian' => set_value('id_desa_kejadian', $row->id_desa),
		'nama_desa_kejadian' => set_value('nama_desa_kejadian', $row->nama_desa),
		'id_kecamatan_kejadian' => set_value('id_kecamatan_kejadian', $row->id_kecamatan),
		'nama_kecamatan_kejadian' => set_value('nama_kecamatan_kejadian', $row->nama_kecamatan),
		'kronologi' => set_value('kronologi', $row->kronologi),
		'tgl_kejadian' => set_value('tgl_kejadian', $row->tgl_kejadian),
		
		//tindak lanjut
		'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut', $row->tgl_tindak_lanjut),
		'note_tindak_lanjut' => set_value('note_tindak_lanjut', $row->note_tindak_lanjut),
		'tgl_penyelesaian' => set_value('tgl_penyelesaian', $row->tgl_penyelesaian),
		'note_penyelesaian' => set_value('note_penyelesaian', $row->note_penyelesaian),
		'tgl_monitoring' => set_value('tgl_monitoring', $row->tgl_monitoring),
		'note_monitoring' => set_value('note_monitoring', $row->note_monitoring),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'id_flag' => set_value('id_flag', $row->id_flag),
		'nama_flag' => set_value('nama_flag', $row->nama_flag),
		'id_user' => set_value('id_user', $row->id_user),

		//pelapor
		'id_pelapor' => set_value('id_korban', $row->id_pelapor),
		'nik_pelapor' => set_value('nik_pelapor', $row->nik_pelapor),
	    'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
	    'id_agama_pelapor' => set_value('id_agama_pelapor', $row_pelapor->id_agama),
	    'nama_agama_pelapor' => set_value('nama_agama_pelapor', $row_pelapor->nama_agama),
	    'id_desa_pelapor' => set_value('id_desa_pelapor', $row_pelapor->id_desa),
	    'nama_desa_pelapor' => set_value('nama_desa_pelapor', $row_pelapor->nama_desa),
	    'id_kecamatan_pelapor' => set_value('id_kecamatan_pelapor', $row_pelapor->id_kecamatan),
	    'nama_kecamatan_pelapor' => set_value('nama_kecamatan_pelapor', $row_pelapor->nama_kecamatan),
	    'alamat_pelapor' => set_value('alamat_pelapor', $row->alamat_pelapor),
	    'no_hp_pelapor' => set_value('no_hp_pelapor', $row->no_hp_pelapor),

		//korban
		'id_korban' => set_value('id_korban', $row->id_korban),
		'nik_korban' => set_value('nik_korban', $row->nik_korban),
	    'nama_korban' => set_value('nama_korban', $row->nama_korban),
	    'id_agama_korban' => set_value('id_agama_korban', $row_korban->id_agama),
	    'nama_agama_korban' => set_value('nama_agama_korban', $row_korban->nama_agama),
	    'id_desa_korban' => set_value('id_desa_korban', $row_korban->id_desa),
	    'nama_desa_korban' => set_value('nama_desa_korban', $row_korban->nama_desa),
	    'id_kecamatan_korban' => set_value('id_kecamatan_korban', $row_korban->id_kecamatan),
	    'nama_kecamatan_korban' => set_value('nama_kecamatan_korban', $row_korban->nama_kecamatan),
	    'alamat_korban' => set_value('alamat_korban', $row->alamat_korban),
	    'no_hp_korban' => set_value('no_hp_korban', $row->no_hp_korban),

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/tindaklanjut_pengaduan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/tindaklanjut_index'));
        }

		}
    }

    public function tindaklanjut_action()
    {
    	 $this->_rules_tindaklanjut();

        if ($this->form_validation->run() == FALSE) {

            $this->update($this->input->post('id_pengaduan', TRUE));
        
        } else {

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		'tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		'id_flag' => 2 //$this->input->post('note_tindak_lanjut',TRUE),
		/*
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		*/
		);
        
            $this->Pengaduan_model->update($this->input->post('id_pengaduan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengaduan/tindaklanjut_index'));
        }
    }


    /* 
    fungsi untuk membatalkan tindaklanjut yaitu mengubah flag menjadi pending dan menghapus
    data pada kolom tgl_tindaklanjut dan note tindaklanjut
    Syarat :
    1. Data pada penyelesaian dan monitoring bernilai null
    2. flag bernilai 2/ ditindaklanjuti
    */
    public function tindaklanjut_cancel($id)
    {
		$row = $this->Pengaduan_model->get_by_id($id);

        if ($row) {

        	$data = array(
		'tgl_tindak_lanjut' => NULL,
		'note_tindak_lanjut' => NULL,
		'id_flag' => 1 //$this->input->post('note_tindak_lanjut',TRUE),
		/*
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		*/
		);

            $this->Pengaduan_model->update($id,$data);
            $this->session->set_flashdata('message', 'Tindak Lanjut di Batalkan');
            redirect(site_url('pengaduan/tindaklanjut_index'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/tindaklanjut_index'));
        }

    }

    /*
    fungsi penyelesaian untuk mengupdate nilai pada field :
    1. tgl_penyelesaian
    2. note_penyelesaian
    3. flag (dimana flag akan berubah ke status selesai id 3)
    */
    //fungsi peneyelesaian
    public function penyelesaian_index()
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

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
        $user_desa= $this->session->userdata('id_desa');
		$flag=2;
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
            'content' => 'backend/pengaduan/penyelesaian_pengaduan_list',
        );


        $this->load->view(layout(), $data);

    }


        public function penyelesaian_create($id)
    {
    
        $row = $this->Pengaduan_model->get_by_id($id);

        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //untuk data pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //untuk data korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);


        if ($row) {
            $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengaduan/penyelesaian_action'),
		
		//pengaduan
		'id_pengaduan' => set_value('id_pengaduan', $row->id_pengaduan),
		'no_pengaduan' => set_value('no_pengaduan', $row->no_pengaduan),
		'tempat_kejadian' => set_value('tempat_kejadian', $row->tempat_kejadian),
		'id_desa_kejadian' => set_value('id_desa_kejadian', $row->id_desa),
		'nama_desa_kejadian' => set_value('nama_desa_kejadian', $row->nama_desa),
		'id_kecamatan_kejadian' => set_value('id_kecamatan_kejadian', $row->id_kecamatan),
		'nama_kecamatan_kejadian' => set_value('nama_kecamatan_kejadian', $row->nama_kecamatan),
		'kronologi' => set_value('kronologi', $row->kronologi),
		'tgl_kejadian' => set_value('tgl_kejadian', $row->tgl_kejadian),
		
		//tindak lanjut
		'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut', $row->tgl_tindak_lanjut),
		'note_tindak_lanjut' => set_value('note_tindak_lanjut', $row->note_tindak_lanjut),
		'tgl_penyelesaian' => set_value('tgl_penyelesaian', $row->tgl_penyelesaian),
		'note_penyelesaian' => set_value('note_penyelesaian', $row->note_penyelesaian),
		'tgl_monitoring' => set_value('tgl_monitoring', $row->tgl_monitoring),
		'note_monitoring' => set_value('note_monitoring', $row->note_monitoring),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'id_flag' => set_value('id_flag', $row->id_flag),
		'nama_flag' => set_value('nama_flag', $row->nama_flag),
		'id_user' => set_value('id_user', $row->id_user),

		//pelapor
		'id_pelapor' => set_value('id_korban', $row->id_pelapor),
		'nik_pelapor' => set_value('nik_pelapor', $row->nik_pelapor),
	    'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
	    'id_agama_pelapor' => set_value('id_agama_pelapor', $row_pelapor->id_agama),
	    'nama_agama_pelapor' => set_value('nama_agama_pelapor', $row_pelapor->nama_agama),
	    'id_desa_pelapor' => set_value('id_desa_pelapor', $row_pelapor->id_desa),
	    'nama_desa_pelapor' => set_value('nama_desa_pelapor', $row_pelapor->nama_desa),
	    'id_kecamatan_pelapor' => set_value('id_kecamatan_pelapor', $row_pelapor->id_kecamatan),
	    'nama_kecamatan_pelapor' => set_value('nama_kecamatan_pelapor', $row_pelapor->nama_kecamatan),
	    'alamat_pelapor' => set_value('alamat_pelapor', $row->alamat_pelapor),
	    'no_hp_pelapor' => set_value('no_hp_pelapor', $row->no_hp_pelapor),

		//korban
		'id_korban' => set_value('id_korban', $row->id_korban),
		'nik_korban' => set_value('nik_korban', $row->nik_korban),
	    'nama_korban' => set_value('nama_korban', $row->nama_korban),
	    'id_agama_korban' => set_value('id_agama_korban', $row_korban->id_agama),
	    'nama_agama_korban' => set_value('nama_agama_korban', $row_korban->nama_agama),
	    'id_desa_korban' => set_value('id_desa_korban', $row_korban->id_desa),
	    'nama_desa_korban' => set_value('nama_desa_korban', $row_korban->nama_desa),
	    'id_kecamatan_korban' => set_value('id_kecamatan_korban', $row_korban->id_kecamatan),
	    'nama_kecamatan_korban' => set_value('nama_kecamatan_korban', $row_korban->nama_kecamatan),
	    'alamat_korban' => set_value('alamat_korban', $row->alamat_korban),
	    'no_hp_korban' => set_value('no_hp_korban', $row->no_hp_korban),

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/penyelesaian_pengaduan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/penyelesaian_index'));
        }

    }

    public function penyelesaian_action()
    {
    	 $this->_rules_penyelesaian();

        if ($this->form_validation->run() == FALSE) {

            $this->update($this->input->post('id_pengaduan', TRUE));
        
        } else {

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		/*'
		tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		*/
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		/*
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		*/
		'id_flag' => 3 //$this->input->post('note_tindak_lanjut',TRUE),
	
		);
        
            $this->Pengaduan_model->update($this->input->post('id_pengaduan', TRUE), $data);
            $this->session->set_flashdata('message', 'Data Penyelesaian Tersimpan');
            redirect(site_url('pengaduan/penyelesaian_index'));
        }
    }

    /* 
    fungsi untuk membatalkan tindaklanjut yaitu mengubah flag menjadi pending dan menghapus
    data pada kolom tgl_tindaklanjut dan note tindaklanjut
    Syarat :
    1. Data pada penyelesaian dan monitoring bernilai null
    2. flag bernilai 2/ ditindaklanjuti
    */
    public function penyelesaian_cancel($id)
    {
		$row = $this->Pengaduan_model->get_by_id($id);

        if ($row) {

        	$data = array(
		/*
		'tgl_tindak_lanjut' => NULL,
		'note_tindak_lanjut' => NULL,
		*/
		'tgl_penyelesaian' => NULL,
		'note_penyelesaian' => NULL,
		/*
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		*/
		'id_flag' => 2 
		);

            $this->Pengaduan_model->update($id,$data);
            $this->session->set_flashdata('message', 'Penyelesaian Dibatalkan');
            redirect(site_url('pengaduan/penyelesaian_index'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/penyelesaian_index'));
        }

    }

    /*
    fungsi monitoring untuk mengupdate nilai pada field :
    1. tgl_monitoring
    2. note_monitoring
    3. flag (dimana flag akan berubah ke status selesai id 3)
    */
    //fungsi monitoring
        public function monitoring_index()
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

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
        $user_desa= $this->session->userdata('id_desa');
		$flag=3;
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
            'content' => 'backend/pengaduan/monitoring_pengaduan_list',
        );


        $this->load->view(layout(), $data);

    }


        public function monitoring_create($id)
    {
    
        $row = $this->Pengaduan_model->get_by_id($id);

        //ambil nik pelapor dan korban
        $nik_pelapor 	= $row->nik_pelapor;
        $nik_korban 	= $row->nik_korban;

        //untuk data pelapor
        $row_pelapor 	= $this->Pelapor_model->get_by_nik($nik_pelapor);
        
        //untuk data korban
        $row_korban 	= $this->Korban_model->get_by_nik($nik_korban);


        if ($row) {
            $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengaduan/monitoring_action'),
		
		//pengaduan
		'id_pengaduan' => set_value('id_pengaduan', $row->id_pengaduan),
		'no_pengaduan' => set_value('no_pengaduan', $row->no_pengaduan),
		'tempat_kejadian' => set_value('tempat_kejadian', $row->tempat_kejadian),
		'id_desa_kejadian' => set_value('id_desa_kejadian', $row->id_desa),
		'nama_desa_kejadian' => set_value('nama_desa_kejadian', $row->nama_desa),
		'id_kecamatan_kejadian' => set_value('id_kecamatan_kejadian', $row->id_kecamatan),
		'nama_kecamatan_kejadian' => set_value('nama_kecamatan_kejadian', $row->nama_kecamatan),
		'kronologi' => set_value('kronologi', $row->kronologi),
		'tgl_kejadian' => set_value('tgl_kejadian', $row->tgl_kejadian),
		
		//tindak lanjut
		'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut', $row->tgl_tindak_lanjut),
		'note_tindak_lanjut' => set_value('note_tindak_lanjut', $row->note_tindak_lanjut),
		'tgl_penyelesaian' => set_value('tgl_penyelesaian', $row->tgl_penyelesaian),
		'note_penyelesaian' => set_value('note_penyelesaian', $row->note_penyelesaian),
		'tgl_monitoring' => set_value('tgl_monitoring', $row->tgl_monitoring),
		'note_monitoring' => set_value('note_monitoring', $row->note_monitoring),
		'tgl_input' => set_value('tgl_input', $row->tgl_input),
		'id_flag' => set_value('id_flag', $row->id_flag),
		'nama_flag' => set_value('nama_flag', $row->nama_flag),
		'id_user' => set_value('id_user', $row->id_user),

		//pelapor
		'id_pelapor' => set_value('id_korban', $row->id_pelapor),
		'nik_pelapor' => set_value('nik_pelapor', $row->nik_pelapor),
	    'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
	    'id_agama_pelapor' => set_value('id_agama_pelapor', $row_pelapor->id_agama),
	    'nama_agama_pelapor' => set_value('nama_agama_pelapor', $row_pelapor->nama_agama),
	    'id_desa_pelapor' => set_value('id_desa_pelapor', $row_pelapor->id_desa),
	    'nama_desa_pelapor' => set_value('nama_desa_pelapor', $row_pelapor->nama_desa),
	    'id_kecamatan_pelapor' => set_value('id_kecamatan_pelapor', $row_pelapor->id_kecamatan),
	    'nama_kecamatan_pelapor' => set_value('nama_kecamatan_pelapor', $row_pelapor->nama_kecamatan),
	    'alamat_pelapor' => set_value('alamat_pelapor', $row->alamat_pelapor),
	    'no_hp_pelapor' => set_value('no_hp_pelapor', $row->no_hp_pelapor),

		//korban
		'id_korban' => set_value('id_korban', $row->id_korban),
		'nik_korban' => set_value('nik_korban', $row->nik_korban),
	    'nama_korban' => set_value('nama_korban', $row->nama_korban),
	    'id_agama_korban' => set_value('id_agama_korban', $row_korban->id_agama),
	    'nama_agama_korban' => set_value('nama_agama_korban', $row_korban->nama_agama),
	    'id_desa_korban' => set_value('id_desa_korban', $row_korban->id_desa),
	    'nama_desa_korban' => set_value('nama_desa_korban', $row_korban->nama_desa),
	    'id_kecamatan_korban' => set_value('id_kecamatan_korban', $row_korban->id_kecamatan),
	    'nama_kecamatan_korban' => set_value('nama_kecamatan_korban', $row_korban->nama_kecamatan),
	    'alamat_korban' => set_value('alamat_korban', $row->alamat_korban),
	    'no_hp_korban' => set_value('no_hp_korban', $row->no_hp_korban),

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/monitoring_pengaduan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/monitoring_index'));
        }

    }

    public function monitoring_action()
    {
    	 $this->_rules_monitoring();

        if ($this->form_validation->run() == FALSE) {

            $this->update($this->input->post('id_pengaduan', TRUE));
        
        } else {

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		/*'
		tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		*/
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		
		'id_flag' => 4 //$this->input->post('note_tindak_lanjut',TRUE),
	
		);
        
            $this->Pengaduan_model->update($this->input->post('id_pengaduan', TRUE), $data);
            $this->session->set_flashdata('message', 'Data Monitoring Tersimpan');
            redirect(site_url('pengaduan/monitoring_index'));
        }
    }

    /* 
    fungsi untuk membatalkan tindaklanjut yaitu mengubah flag menjadi pending dan menghapus
    data pada kolom tgl_tindaklanjut dan note tindaklanjut
    Syarat :
    1. Data pada penyelesaian dan monitoring bernilai null
    2. flag bernilai 2/ ditindaklanjuti
    */
    public function monitoring_cancel($id)
    {
		$row = $this->Pengaduan_model->get_by_id($id);

        if ($row) {

        	$data = array(
		/*
		'tgl_tindak_lanjut' => NULL,
		'note_tindak_lanjut' => NULL,
		
		'tgl_penyelesaian' => NULL,
		'note_penyelesaian' => NULL,
		*/
		'tgl_monitoring' => NULL,
		'note_monitoring' => NULL,
		
		'id_flag' => 3 
		);

            $this->Pengaduan_model->update($id,$data);
            $this->session->set_flashdata('message', 'Monitoring Dibatalkan');
            redirect(site_url('pengaduan/monitoring_index'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/monitoring_index'));
        }

    }

	//fungsi monitoring
	public function selesai_index()
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

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
        $user_desa= $this->session->userdata('id_desa');
		$flag=4;
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
            'content' => 'backend/pengaduan/selesai_pengaduan_list',
        );


        $this->load->view(layout(), $data);

    }

    
    public function delete($id) 
    {
		
        $row = $this->Pengaduan_model->get_by_id($id);

        if ($row) {
            $this->Pengaduan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengaduan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_pengaduan', 'no pengaduan', 'trim|required');
	$this->form_validation->set_rules('tempat_kejadian', 'tempat kejadian', 'trim|required');
	$this->form_validation->set_rules('kronologi', 'kronologi', 'trim|required');
	$this->form_validation->set_rules('tgl_kejadian', 'tgl kejadian', 'trim|required');
	$this->form_validation->set_rules('id_pengaduan', 'id_pengaduan', 'trim');

	$this->form_validation->set_rules('nik_pelapor', 'nik_pelapor', 'trim');
	$this->form_validation->set_rules('nama_pelapor', 'nama_pelapor', 'trim');
	$this->form_validation->set_rules('id_agama_pelapor', 'id_agama_pelapor', 'trim');
	$this->form_validation->set_rules('alamat_pelapor', 'alamat_pelapor', 'trim');
	$this->form_validation->set_rules('no_hp_pelapor', 'no hp_pelapor', 'trim');
	$this->form_validation->set_rules('id_desa_pelapor', 'id desa_pelapor', 'trim|required');

	$this->form_validation->set_rules('nik_korban', 'nik_korban', 'trim');
	$this->form_validation->set_rules('nama_korban', 'nama_korban', 'trim');
	$this->form_validation->set_rules('agama_korban', 'agama_korban', 'trim');
	$this->form_validation->set_rules('alamat_korban', 'alamat_korban', 'trim');
	$this->form_validation->set_rules('no_hp_korban', 'no hp_korban', 'trim');
	$this->form_validation->set_rules('id_desa_korban', 'id desa_pelapor', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_tindaklanjut() 
    {
	$this->form_validation->set_rules('no_pengaduan', 'no pengaduan', 'trim|required');
	$this->form_validation->set_rules('tgl_tindak_lanjut', 'tgl tindak_lanjut', 'trim|required');
	$this->form_validation->set_rules('note_tindak_lanjut', 'note tindak_lanjut', 'trim|required');
	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_penyelesaian() 
    {
	$this->form_validation->set_rules('no_pengaduan', 'no pengaduan', 'trim|required');
	$this->form_validation->set_rules('tgl_penyelesaian', 'tgl penyelesaian', 'trim|required');
	$this->form_validation->set_rules('note_penyelesaian', 'note penyelesaian', 'trim|required');
	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_monitoring() 
    {
	$this->form_validation->set_rules('no_pengaduan', 'no pengaduan', 'trim|required');
	$this->form_validation->set_rules('tgl_monitoring', 'tgl monitoring', 'trim|required');
	$this->form_validation->set_rules('note_monitoring', 'note monitoring', 'trim|required');
	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengaduan.xls";
        $judul = "pengaduan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "No Pengaduan");
	xlsWriteLabel($tablehead, $kolomhead++, "nik pelapor");
	xlsWriteLabel($tablehead, $kolomhead++, "nik korban");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Kejadian");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Desa");
	xlsWriteLabel($tablehead, $kolomhead++, "Kronologi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kejadian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Tindak Lanjut");
	xlsWriteLabel($tablehead, $kolomhead++, "Note Tindak Lanjut");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penyelesaian");
	xlsWriteLabel($tablehead, $kolomhead++, "Note Penyelesaian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Monitoring");
	xlsWriteLabel($tablehead, $kolomhead++, "Note Monitoring");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Input");
	xlsWriteLabel($tablehead, $kolomhead++, "ID Flag");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->Pengaduan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_pengaduan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik_pelapor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik_korban);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tempat_kejadian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_desa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kronologi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_kejadian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_tindak_lanjut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note_tindak_lanjut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penyelesaian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note_penyelesaian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_monitoring);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note_monitoring);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_input);
	    xlsWriteNumber($tablebody, $kolombody++, $data->flag);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pengaduan.doc");

        $data = array(
            'pengaduan_data' => $this->Pengaduan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pengaduan/pengaduan_doc',$data);
    }

    //tampilan index menu laporan
    public function laporan_index()
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

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengaduan_model->total_rows($q);
        $pengaduan = $this->Pengaduan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengaduan_data' => $pengaduan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/laporan/laporan_list',
        );


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

    //laporan action (fungsi print pdf)
    public function laporan_print($id)
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
		'content' => 'backend/laporan/template_surat',
	    );

            $this->load->view('backend/laporan/laporan_print', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan/laporan_index'));
        }
    }

    function get_desa(){

    	$id_kecamatan = $this->input->post('kecamatan');

    	$getdesa = $this->Desa_model->get_by_kecamatan($id_kecamatan);
		//cetak json
    	echo json_encode($getdesa);
    }



}

/* End of file Pengaduan.php */
/* Location: ./application/controllers/Pengaduan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 09:42:38 */
/* http://harviacode.com */