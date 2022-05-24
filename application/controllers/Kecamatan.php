<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kecamatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kecamatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kecamatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kecamatan/index.html';
            $config['first_url'] = base_url() . 'kecamatan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kecamatan_model->total_rows($q);
        $kecamatan = $this->Kecamatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kecamatan_data' => $kecamatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/kecamatan/kecamatan_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kecamatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kecamatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kecamatan/index.html';
            $config['first_url'] = base_url() . 'kecamatan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kecamatan_model->total_rows($q);
        $kecamatan = $this->Kecamatan_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'kecamatan_data' => $kecamatan,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/kecamatan/kecamatan_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kecamatan' => $row->id_kecamatan,
		'id_kabupaten' => $row->id_kabupaten,
		'nama_kecamatan' => $row->nama_kecamatan,
		'col1' => $row->col1,
		'col2' => $row->col2,
		'col3' => $row->col3,
		'col4' => $row->col4,
		'col5' => $row->col5,
		'created_at' => $row->created_at,
		'created_by' => $row->created_by,
		'updated_at' => $row->updated_at,
		'updated_by' => $row->updated_by,
		'isactive' => $row->isactive,'content' => 'backend/kecamatan/kecamatan_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kecamatan/create_action'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'id_kabupaten' => set_value('id_kabupaten'),
	    'nama_kecamatan' => set_value('nama_kecamatan'),
	    'col1' => set_value('col1'),
	    'col2' => set_value('col2'),
	    'col3' => set_value('col3'),
	    'col4' => set_value('col4'),
	    'col5' => set_value('col5'),
	    'created_at' => set_value('created_at'),
	    'created_by' => set_value('created_by'),
	    'updated_at' => set_value('updated_at'),
	    'updated_by' => set_value('updated_by'),
	    'isactive' => set_value('isactive'),
	    'content' => 'backend/kecamatan/kecamatan_form',
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
		'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
		'nama_kecamatan' => $this->input->post('nama_kecamatan',TRUE),
		'col1' => $this->input->post('col1',TRUE),
		'col2' => $this->input->post('col2',TRUE),
		'col3' => $this->input->post('col3',TRUE),
		'col4' => $this->input->post('col4',TRUE),
		'col5' => $this->input->post('col5',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Kecamatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kecamatan/update_action'),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
		'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
		'nama_kecamatan' => set_value('nama_kecamatan', $row->nama_kecamatan),
		'col1' => set_value('col1', $row->col1),
		'col2' => set_value('col2', $row->col2),
		'col3' => set_value('col3', $row->col3),
		'col4' => set_value('col4', $row->col4),
		'col5' => set_value('col5', $row->col5),
		'created_at' => set_value('created_at', $row->created_at),
		'created_by' => set_value('created_by', $row->created_by),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'updated_by' => set_value('updated_by', $row->updated_by),
		'isactive' => set_value('isactive', $row->isactive),
	    'content' => 'backend/kecamatan/kecamatan_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kecamatan', TRUE));
        } else {
            $data = array(
		'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
		'nama_kecamatan' => $this->input->post('nama_kecamatan',TRUE),
		'col1' => $this->input->post('col1',TRUE),
		'col2' => $this->input->post('col2',TRUE),
		'col3' => $this->input->post('col3',TRUE),
		'col4' => $this->input->post('col4',TRUE),
		'col5' => $this->input->post('col5',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Kecamatan_model->update($this->input->post('id_kecamatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kecamatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kecamatan_model->get_by_id($id);

        if ($row) {
            $this->Kecamatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kecamatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kabupaten', 'id kabupaten', 'trim|required');
	$this->form_validation->set_rules('nama_kecamatan', 'nama kecamatan', 'trim|required');
	$this->form_validation->set_rules('col1', 'col1', 'trim|required');
	$this->form_validation->set_rules('col2', 'col2', 'trim|required');
	$this->form_validation->set_rules('col3', 'col3', 'trim|required');
	$this->form_validation->set_rules('col4', 'col4', 'trim|required');
	$this->form_validation->set_rules('col5', 'col5', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');
	$this->form_validation->set_rules('updated_by', 'updated by', 'trim|required');
	$this->form_validation->set_rules('isactive', 'isactive', 'trim|required');

	$this->form_validation->set_rules('id_kecamatan', 'id_kecamatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kecamatan.xls";
        $judul = "kecamatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kabupaten");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kecamatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Col1");
	xlsWriteLabel($tablehead, $kolomhead++, "Col2");
	xlsWriteLabel($tablehead, $kolomhead++, "Col3");
	xlsWriteLabel($tablehead, $kolomhead++, "Col4");
	xlsWriteLabel($tablehead, $kolomhead++, "Col5");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated By");
	xlsWriteLabel($tablehead, $kolomhead++, "Isactive");

	foreach ($this->Kecamatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kabupaten);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kecamatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col4);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col5);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_by);
	    xlsWriteNumber($tablebody, $kolombody++, $data->isactive);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kecamatan.doc");

        $data = array(
            'kecamatan_data' => $this->Kecamatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kecamatan/kecamatan_doc',$data);
    }

}

/* End of file Kecamatan.php */
/* Location: ./application/controllers/Kecamatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 23:52:02 */
/* http://harviacode.com */