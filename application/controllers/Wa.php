<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wa/index.html';
            $config['first_url'] = base_url() . 'wa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        //$config['total_rows'] = $this->Wa_model->total_rows($q);
        $wa = $this->Wa_model->get_all();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wa_data' => $wa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => 0,
            'start' => $start,
            'content' => 'backend/wa/wa_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wa/index.html';
            $config['first_url'] = base_url() . 'wa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Wa_model->total_rows($q);
        $wa = $this->Wa_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'wa_data' => $wa,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/wa/wa_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Wa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'phone' => $row->phone,
		'message' => $row->message,
		'secret' => $row->secret,
		'retry' => $row->retry,
		'isGroup' => $row->isGroup,'content' => 'backend/wa/wa_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wa/create_action'),
	    'phone' => set_value('phone'),
	    'message' => set_value('message'),
	    'secret' => set_value('secret'),
	    'retry' => set_value('retry'),
	    'isGroup' => set_value('isGroup'),
	    'content' => 'backend/wa/wa_form',
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
		'phone' => $this->input->post('phone',TRUE),
		'message' => $this->input->post('message',TRUE),
		'secret' => $this->input->post('secret',TRUE),
		'retry' => $this->input->post('retry',TRUE),
		'isGroup' => $this->input->post('isGroup',TRUE),
	    );

            $this->Wa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Wa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wa/update_action'),
		'phone' => set_value('phone', $row->phone),
		'message' => set_value('message', $row->message),
		'secret' => set_value('secret', $row->secret),
		'retry' => set_value('retry', $row->retry),
		'isGroup' => set_value('isGroup', $row->isGroup),
	    'content' => 'backend/wa/wa_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'phone' => $this->input->post('phone',TRUE),
		'message' => $this->input->post('message',TRUE),
		'secret' => $this->input->post('secret',TRUE),
		'retry' => $this->input->post('retry',TRUE),
		'isGroup' => $this->input->post('isGroup',TRUE),
	    );

            $this->Wa_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wa_model->get_by_id($id);

        if ($row) {
            $this->Wa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('message', 'message', 'trim|required');
	$this->form_validation->set_rules('secret', 'secret', 'trim|required');
	$this->form_validation->set_rules('retry', 'retry', 'trim|required');
	$this->form_validation->set_rules('isGroup', 'isgroup', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wa.xls";
        $judul = "wa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Message");
	xlsWriteLabel($tablehead, $kolomhead++, "Secret");
	xlsWriteLabel($tablehead, $kolomhead++, "Retry");
	xlsWriteLabel($tablehead, $kolomhead++, "IsGroup");

	foreach ($this->Wa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->message);
	    xlsWriteLabel($tablebody, $kolombody++, $data->secret);
	    xlsWriteLabel($tablebody, $kolombody++, $data->retry);
	    xlsWriteLabel($tablebody, $kolombody++, $data->isGroup);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=wa.doc");

        $data = array(
            'wa_data' => $this->Wa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('wa/wa_doc',$data);
    }

}

/* End of file Wa.php */
/* Location: ./application/controllers/Wa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-06-10 05:00:05 */
/* http://harviacode.com */