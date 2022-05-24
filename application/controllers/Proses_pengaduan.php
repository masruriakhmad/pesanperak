<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proses_pengaduan extends CI_Controller
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
            'content' => 'backend/pengaduan/pengaduan_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
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


        $data = array(
            'pengaduan_data' => $pengaduan,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/pengaduan/pengaduan_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
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
		'content' => 'backend/pengaduan/pengaduan_read',
	    );

            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan'));
        }
    }

    public function create() 
    {
        
        $data = array(
        'button' => 'Create',
        'action' => site_url('pengaduan/create_action'),

        //Data Aduan
	    'id_pengaduan' => set_value('id_pengaduan'),
	    'no_pengaduan' => $this->Pengaduan_model->get_no_pengaduan(),
	    'tempat_kejadian' => set_value('tempat_kejadian'),
	    'id_desa' => set_value('id_desa'),
	    'nama_desa' => set_value('nama_desa'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'nama_kecamatan' => set_value('nama_kecamatan'),
	    'kronologi' => set_value('kronologi'),
	    'tgl_kejadian' => set_value('tgl_kejadian'),
	    'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut'),
	    'note_tindak_lanjut' => set_value('note_tindak_lanjut'),
	    'tgl_penyelesaian' => set_value('tgl_penyelesaian'),
	    'note_penyelesaian' => set_value('note_penyelesaian'),
	    'tgl_monitoring' => set_value('tgl_monitoring'),
	    'note_monitoring' => set_value('note_monitoring'),
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

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/pengaduan/pengaduan_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        	$data_pelapor=array(
       	'nik_pelapor' => $this->input->post('nik_pelapor',TRUE),
	    'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
	    'id_agama' => $this->input->post('agama_pelapor',TRUE),
	    'alamat_pelapor' => $this->input->post('alamat_pelapor',TRUE),
	    'id_desa' => $this->input->post('id_desa_pelapor',TRUE),
	    'no_hp_pelapor' => $this->input->post('no_hp_pelapor',TRUE),
        	);


            $data_korban=array(
        'nik_korban' => $this->input->post('nik_korban',TRUE),
	    'nama_korban' => $this->input->post('nama_korban',TRUE),
	    'id_agama' => $this->input->post('agama_korban',TRUE),
	    'alamat_korban' => $this->input->post('alamat_korban',TRUE),
	    'id_desa' => $this->input->post('id_desa_korban',TRUE),
	    'no_hp_korban' => $this->input->post('no_hp_korban',TRUE),
            );

            $data = array(
		'no_pengaduan' => $this->input->post('no_pengaduan',TRUE),
		'tempat_kejadian' => $this->input->post('tempat_kejadian',TRUE),
        'nik_pelapor' => $this->input->post('nik_pelapor',TRUE),
        'nik_korban' => $this->input->post('nik_korban',TRUE),
		'id_desa' => $this->input->post('id_desa_kejadian',TRUE),
		'kronologi' => $this->input->post('kronologi',TRUE),
		'tgl_kejadian' => $this->input->post('tgl_kejadian',TRUE),
		'tgl_tindak_lanjut' => $this->input->post('tgl_tindak_lanjut',TRUE),
		'note_tindak_lanjut' => $this->input->post('note_tindak_lanjut',TRUE),
		'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian',TRUE),
		'note_penyelesaian' => $this->input->post('note_penyelesaian',TRUE),
		'tgl_monitoring' => $this->input->post('tgl_monitoring',TRUE),
		'note_monitoring' => $this->input->post('note_monitoring',TRUE),
		'tgl_input' => date('Y-m-d'),
		'id_flag' => 1,

	    );

            $this->Pelapor_model->insert($data_pelapor);
            $this->Korban_model->insert($data_korban);
            $this->Pengaduan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengaduan'));
        }
    }
    
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

	    'content' => 'backend/pengaduan/pengaduan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengaduan'));
        }
    }
    
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
		'id_desa' => $this->input->post('id_desa_kejadian',TRUE),
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

    public function tindaklanjut()
    {
    
    	$data = array(
        'button' => 'Create',
        'action' => site_url('pengaduan/tindaklanjut_action'),

        //Data Aduan
	    'id_pengaduan' => set_value('id_pengaduan'),
	    'no_pengaduan' => $this->Pengaduan_model->get_no_pengaduan(),
	    'tempat_kejadian' => set_value('tempat_kejadian'),
	    'id_desa' => set_value('id_desa'),
	    'nama_desa' => set_value('nama_desa'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'nama_kecamatan' => set_value('nama_kecamatan'),
	    'kronologi' => set_value('kronologi'),
	    'tgl_kejadian' => set_value('tgl_kejadian'),
	    'tgl_tindak_lanjut' => set_value('tgl_tindak_lanjut'),
	    'note_tindak_lanjut' => set_value('note_tindak_lanjut'),
	    'tgl_penyelesaian' => set_value('tgl_penyelesaian'),
	    'note_penyelesaian' => set_value('note_penyelesaian'),
	    'tgl_monitoring' => set_value('tgl_monitoring'),
	    'note_monitoring' => set_value('note_monitoring'),
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

	    'kecamatan'=>$this->Kecamatan_model->get_all(),

	    'agama'=>$this->Agama_model->get_all(),

	    'content' => 'backend/tindaklanjut/pengaduan_tindaklanjut_form',
	);
        $this->load->view(layout(), $data);

    }

    public function penyelesaian()
    {
    


    }

    public function monitoring()
    {
    


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
	$this->form_validation->set_rules('id_desa_kejadian', 'id desa_kejadian', 'trim|required');
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


    function get_desa(){

    	$id_kecamatan = $this->input->post('kecamatan');

    	$getdesa = $this->Desa_model->get_by_kecamatan($id_kecamatan);

    echo json_encode($getdesa);

    }

    public function print()
    {
       
    }

}

/* End of file Pengaduan.php */
/* Location: ./application/controllers/Pengaduan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 09:42:38 */
/* http://harviacode.com */