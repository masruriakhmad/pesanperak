<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Korban extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Korban_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'korban/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'korban/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'korban/index.html';
            $config['first_url'] = base_url() . 'korban/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Korban_model->total_rows($q);
        $korban = $this->Korban_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'korban_data' => $korban,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/korban/korban_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'korban/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'korban/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'korban/index.html';
            $config['first_url'] = base_url() . 'korban/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Korban_model->total_rows($q);
        $korban = $this->Korban_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'korban_data' => $korban,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/korban/korban_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Korban_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_korban' => $row->id_korban,
		'nik_korban' => $row->nik_korban,
		'nama_korban' => $row->nama_korban,
		'id_agama' => $row->id_agama,
		'id_desa' => $row->id_desa,
		'alamat_korban' => $row->alamat_korban,
		'no_hp_korban' => $row->no_hp_korban,'content' => 'backend/korban/korban_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('korban'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('korban/create_action'),
	    'id_korban' => set_value('id_korban'),
	    'nik_korban' => set_value('nik_korban'),
	    'nama_korban' => set_value('nama_korban'),
	    'id_agama' => set_value('id_agama'),
	    'id_desa' => set_value('id_desa'),
	    'alamat_korban' => set_value('alamat_korban'),
	    'no_hp_korban' => set_value('no_hp_korban'),
	    'content' => 'backend/korban/korban_form',
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
		'nama_korban' => $this->input->post('nama_korban',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
		'alamat_korban' => $this->input->post('alamat_korban',TRUE),
		'no_hp_korban' => $this->input->post('no_hp_korban',TRUE),
	    );

            $this->Korban_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('korban'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Korban_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('korban/update_action'),
		'id_korban' => set_value('id_korban', $row->id_korban),
		'nik_korban' => set_value('nik_korban', $row->nik_korban),
		'nama_korban' => set_value('nama_korban', $row->nama_korban),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'id_desa' => set_value('id_desa', $row->id_desa),
		'alamat_korban' => set_value('alamat_korban', $row->alamat_korban),
		'no_hp_korban' => set_value('no_hp_korban', $row->no_hp_korban),
	    'content' => 'backend/korban/korban_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('korban'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_korban', TRUE));
        } else {
            $data = array(
		'nama_korban' => $this->input->post('nama_korban',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
		'alamat_korban' => $this->input->post('alamat_korban',TRUE),
		'no_hp_korban' => $this->input->post('no_hp_korban',TRUE),
	    );

            $this->Korban_model->update($this->input->post('id_korban', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('korban'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Korban_model->get_by_id($id);

        if ($row) {
            $this->Korban_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('korban'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('korban'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_korban', 'nama korban', 'trim|required');
	$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	$this->form_validation->set_rules('id_desa', 'id desa', 'trim|required');
	$this->form_validation->set_rules('alamat_korban', 'alamat korban', 'trim|required');
	$this->form_validation->set_rules('no_hp_korban', 'no hp korban', 'trim|required');

	$this->form_validation->set_rules('id_korban', 'id_korban', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "korban.xls";
        $judul = "korban";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Korban");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Desa");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Korban");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Korban");

	foreach ($this->Korban_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_korban);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_desa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_korban);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_korban);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=korban.doc");

        $data = array(
            'korban_data' => $this->Korban_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('korban/korban_doc',$data);
    }

}

/* End of file Korban.php */
/* Location: ./application/controllers/Korban.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-19 08:14:36 */
/* http://harviacode.com */