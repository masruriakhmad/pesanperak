<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelapor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelapor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pelapor/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pelapor/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pelapor/index.html';
            $config['first_url'] = base_url() . 'pelapor/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelapor_model->total_rows($q);
        $pelapor = $this->Pelapor_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pelapor_data' => $pelapor,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/pelapor/pelapor_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pelapor/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pelapor/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pelapor/index.html';
            $config['first_url'] = base_url() . 'pelapor/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pelapor_model->total_rows($q);
        $pelapor = $this->Pelapor_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'pelapor_data' => $pelapor,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/pelapor/pelapor_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Pelapor_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pelapor' => $row->id_pelapor,
		'nik_pelapor' => $row->nik_pelapor,
		'nama_pelapor' => $row->nama_pelapor,
		'id_agama' => $row->id_agama,
		'id_desa' => $row->id_desa,
		'alamat_pelapor' => $row->alamat_pelapor,
		'no_hp_pelapor' => $row->no_hp_pelapor,'content' => 'backend/pelapor/pelapor_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelapor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pelapor/create_action'),
	    'id_pelapor' => set_value('id_pelapor'),
	    'nik_pelapor' => set_value('nik_pelapor'),
	    'nama_pelapor' => set_value('nama_pelapor'),
	    'id_agama' => set_value('id_agama'),
	    'id_desa' => set_value('id_desa'),
	    'alamat_pelapor' => set_value('alamat_pelapor'),
	    'no_hp_pelapor' => set_value('no_hp_pelapor'),
	    'content' => 'backend/pelapor/pelapor_form',
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
		'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
		'alamat_pelapor' => $this->input->post('alamat_pelapor',TRUE),
		'no_hp_pelapor' => $this->input->post('no_hp_pelapor',TRUE),
	    );

            $this->Pelapor_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pelapor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelapor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pelapor/update_action'),
		'id_pelapor' => set_value('id_pelapor', $row->id_pelapor),
		'nik_pelapor' => set_value('nik_pelapor', $row->nik_pelapor),
		'nama_pelapor' => set_value('nama_pelapor', $row->nama_pelapor),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'id_desa' => set_value('id_desa', $row->id_desa),
		'alamat_pelapor' => set_value('alamat_pelapor', $row->alamat_pelapor),
		'no_hp_pelapor' => set_value('no_hp_pelapor', $row->no_hp_pelapor),
	    'content' => 'backend/pelapor/pelapor_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelapor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelapor', TRUE));
        } else {
            $data = array(
		'nama_pelapor' => $this->input->post('nama_pelapor',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
		'alamat_pelapor' => $this->input->post('alamat_pelapor',TRUE),
		'no_hp_pelapor' => $this->input->post('no_hp_pelapor',TRUE),
	    );

            $this->Pelapor_model->update($this->input->post('id_pelapor', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelapor'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelapor_model->get_by_id($id);

        if ($row) {
            $this->Pelapor_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pelapor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelapor'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pelapor', 'nama pelapor', 'trim|required');
	$this->form_validation->set_rules('id_agama', 'id agama', 'trim|required');
	$this->form_validation->set_rules('id_desa', 'id desa', 'trim|required');
	$this->form_validation->set_rules('alamat_pelapor', 'alamat pelapor', 'trim|required');
	$this->form_validation->set_rules('no_hp_pelapor', 'no hp pelapor', 'trim|required');

	$this->form_validation->set_rules('id_pelapor', 'id_pelapor', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pelapor.xls";
        $judul = "pelapor";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelapor");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Desa");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Pelapor");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Pelapor");

	foreach ($this->Pelapor_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelapor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_desa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_pelapor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_pelapor);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pelapor.doc");

        $data = array(
            'pelapor_data' => $this->Pelapor_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pelapor/pelapor_doc',$data);
    }

}

/* End of file Pelapor.php */
/* Location: ./application/controllers/Pelapor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-19 08:14:42 */
/* http://harviacode.com */