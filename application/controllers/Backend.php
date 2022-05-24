<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Sy_menu_model');
        $this->load->model('Pengaduan_model');
        // is_logged();
    }

    public function index() {

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengaduan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengaduan/index.html';
            $config['first_url'] = base_url() . 'pengaduan/index.html';
        }
        $where= $this->session->userdata('id_desa');
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

        $pending= 1;
        $tindaklanjut=2;
        $selesai= 3;
        $monitoring= 4;

        $params= $this->session->userdata('id_desa');

        $jumlah_pending        = $this->Pengaduan_model->get_jumlah($pending,$params);
        $jumlah_tindaklanjut   = $this->Pengaduan_model->get_jumlah($tindaklanjut,$params);
        $jumlah_selesai        = $this->Pengaduan_model->get_jumlah($selesai,$params);
        $jumlah_monitoring     = $this->Pengaduan_model->get_jumlah($monitoring,$params);

        $total_laporan = $jumlah_pending+$jumlah_tindaklanjut+$jumlah_selesai+$jumlah_monitoring;
        
        $data_graph= $this->Pengaduan_model->get_groupby_bulan();
        
        $data = array(
            'pengaduan_data' => $pengaduan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'jumlah_pending' => $jumlah_pending,
            'jumlah_tindaklanjut' => $jumlah_tindaklanjut,
            'jumlah_selesai' => $jumlah_selesai,
            'jumlah_monitoring' => $jumlah_monitoring,
            'total_laporan'=>$total_laporan,
            'data_graph'=> json_encode($data_graph),
            'content' => 'backend/dashboard',
        );


        print($data['data_graph']);
       // var_dump($data_graph);

        $this->load->view('layout_backend.php', $data);

            //echo $total_laporan;
        //echo $this->session->userdata('level');
    }

}
