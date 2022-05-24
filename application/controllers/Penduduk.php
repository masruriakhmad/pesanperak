<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penduduk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penduduk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penduduk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penduduk/index.html';
            $config['first_url'] = base_url() . 'penduduk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penduduk_model->total_rows($q);
        $penduduk = $this->Penduduk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penduduk_data' => $penduduk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/penduduk/penduduk_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penduduk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penduduk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penduduk/index.html';
            $config['first_url'] = base_url() . 'penduduk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penduduk_model->total_rows($q);
        $penduduk = $this->Penduduk_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'penduduk_data' => $penduduk,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/penduduk/penduduk_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penduduk' => $row->id_penduduk,
		'nik' => $row->nik,
		'nama' => $row->nama,
		'id_agama' => $row->id_agama,
		'alamat' => $row->alamat,
		'no_hp' => $row->no_hp,
		'id_desa' => $row->id_desa,'content' => 'backend/penduduk/penduduk_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('penduduk/create_action'),
	    'id_penduduk' => set_value('id_penduduk'),
	    'nik' => set_value('nik'),
	    'nama' => set_value('nama'),
	    'id_agama' => set_value('id_agama'),
	    'alamat' => set_value('alamat'),
	    'no_hp' => set_value('no_hp'),
	    'id_desa' => set_value('id_desa'),
	    'content' => 'backend/penduduk/penduduk_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nik' => $this->input->post('nik',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
	    );

            $this->Penduduk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('penduduk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penduduk/update_action'),
		'id_penduduk' => set_value('id_penduduk', $row->id_penduduk),
		'nik' => set_value('nik', $row->nik),
		'nama' => set_value('nama', $row->nama),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'alamat' => set_value('alamat', $row->alamat),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'id_desa' => set_value('id_desa', $row->id_desa),
	    'content' => 'backend/penduduk/penduduk_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penduduk', TRUE));
        } else {
            $data = array(
		'nik' => $this->input->post('nik',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
	    );

            $this->Penduduk_model->update($this->input->post('id_penduduk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penduduk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);

        if ($row) {
            $this->Penduduk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penduduk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('id_desa', 'id desa', 'trim|required');

	$this->form_validation->set_rules('id_penduduk', 'id_penduduk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "penduduk.xls";
        $judul = "penduduk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Desa");

	foreach ($this->Penduduk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_desa);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=penduduk.doc");

        $data = array(
            'penduduk_data' => $this->Penduduk_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('penduduk/penduduk_doc',$data);
    }

}

/* End of file Penduduk.php */
/* Location: ./application/controllers/Penduduk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-19 05:04:18 */
/* http://harviacode.com */