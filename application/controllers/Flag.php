<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flag extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Flag_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'flag/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'flag/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'flag/index.html';
            $config['first_url'] = base_url() . 'flag/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Flag_model->total_rows($q);
        $flag = $this->Flag_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'flag_data' => $flag,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/flag/flag_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'flag/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'flag/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'flag/index.html';
            $config['first_url'] = base_url() . 'flag/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Flag_model->total_rows($q);
        $flag = $this->Flag_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'flag_data' => $flag,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/flag/flag_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Flag_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_flag' => $row->id_flag,
		'nama_flag' => $row->nama_flag,'content' => 'backend/flag/flag_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flag'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('flag/create_action'),
	    'id_flag' => set_value('id_flag'),
	    'nama_flag' => set_value('nama_flag'),
	    'content' => 'backend/flag/flag_form',
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
		'nama_flag' => $this->input->post('nama_flag',TRUE),
	    );

            $this->Flag_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('flag'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Flag_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('flag/update_action'),
		'id_flag' => set_value('id_flag', $row->id_flag),
		'nama_flag' => set_value('nama_flag', $row->nama_flag),
	    'content' => 'backend/flag/flag_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flag'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_flag', TRUE));
        } else {
            $data = array(
		'nama_flag' => $this->input->post('nama_flag',TRUE),
	    );

            $this->Flag_model->update($this->input->post('id_flag', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('flag'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Flag_model->get_by_id($id);

        if ($row) {
            $this->Flag_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('flag'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('flag'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_flag', 'nama flag', 'trim|required');

	$this->form_validation->set_rules('id_flag', 'id_flag', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "flag.xls";
        $judul = "flag";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Flag");

	foreach ($this->Flag_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_flag);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=flag.doc");

        $data = array(
            'flag_data' => $this->Flag_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('flag/flag_doc',$data);
    }

}

/* End of file Flag.php */
/* Location: ./application/controllers/Flag.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-03 05:40:43 */
/* http://harviacode.com */