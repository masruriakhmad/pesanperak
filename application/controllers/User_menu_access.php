<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_menu_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_menu_access_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_menu_access/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_menu_access/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_menu_access/index.html';
            $config['first_url'] = base_url() . 'user_menu_access/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_menu_access_model->total_rows($q);
        $user_menu_access = $this->User_menu_access_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_menu_access_data' => $user_menu_access,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_menu_access/user_menu_access_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_menu_access/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_menu_access/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_menu_access/index.html';
            $config['first_url'] = base_url() . 'user_menu_access/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_menu_access_model->total_rows($q);
        $user_menu_access = $this->User_menu_access_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'user_menu_access_data' => $user_menu_access,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_menu_access/user_menu_access_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->User_menu_access_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user_menu_access' => $row->id_user_menu_access,
		'id_menu' => $row->id_menu,
		'id_group' => $row->id_group,'content' => 'backend/user_menu_access/user_menu_access_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_menu_access'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user_menu_access/create_action'),
	    'id_user_menu_access' => set_value('id_user_menu_access'),
	    'id_menu' => set_value('id_menu'),
	    'id_group' => set_value('id_group'),
	    'content' => 'backend/user_menu_access/user_menu_access_form',
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
		'id_menu' => $this->input->post('id_menu',TRUE),
		'id_group' => $this->input->post('id_group',TRUE),
	    );

            $this->User_menu_access_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user_menu_access'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_menu_access_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user_menu_access/update_action'),
		'id_user_menu_access' => set_value('id_user_menu_access', $row->id_user_menu_access),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'id_group' => set_value('id_group', $row->id_group),
	    'content' => 'backend/user_menu_access/user_menu_access_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_menu_access'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user_menu_access', TRUE));
        } else {
            $data = array(
		'id_menu' => $this->input->post('id_menu',TRUE),
		'id_group' => $this->input->post('id_group',TRUE),
	    );

            $this->User_menu_access_model->update($this->input->post('id_user_menu_access', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user_menu_access'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_menu_access_model->get_by_id($id);

        if ($row) {
            $this->User_menu_access_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user_menu_access'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_menu_access'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_menu', 'id menu', 'trim|required');
	$this->form_validation->set_rules('id_group', 'id group', 'trim|required');

	$this->form_validation->set_rules('id_user_menu_access', 'id_user_menu_access', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user_menu_access.xls";
        $judul = "user_menu_access";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Menu");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Group");

	foreach ($this->User_menu_access_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_menu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_group);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=user_menu_access.doc");

        $data = array(
            'user_menu_access_data' => $this->User_menu_access_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('user_menu_access/user_menu_access_doc',$data);
    }

}

/* End of file User_menu_access.php */
/* Location: ./application/controllers/User_menu_access.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-05-20 04:47:05 */
/* http://harviacode.com */