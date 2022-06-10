<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Sy_menu_model');
        $this->load->model('Pengaduan_model');
        $this->load->helper('sf');
        // is_logged();
    }

    public function index() {

      
        $data=array(
        'button' => 'Create',
        'action' => site_url('coba/send'),
        );

        $this->load->view('vcoba', $data);
        
    }

    public function send(){

        $nowa = $this->input->post('nowa');
        $chat = $this->input->post('chat');
        
        if(api_sendwa($nowa, $chat)){

            echo 'Pesan Whatsapp telah dikiirm';

        }
        else{
            echo 'Gagal Kirim Pesan Whatsapp';
        }

    }

    function cobaupload(){


        if($this->input->method()==='post')
            {
            
        
            $nama_gambar    = 'Dataupload';
            $lokasi_gambar 	= 'uploads/ktp/';
			$tipe_gambar 	= 'jpg|jpeg|png';
			$ukuran_gambar 	= 2048;
            
            $nama_file =sf_upload($nama_gambar, $lokasi_gambar, $tipe_gambar, $ukuran_gambar, "upload") ;

            echo $nama_file;
            
    }

}
}