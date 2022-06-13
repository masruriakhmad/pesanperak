<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Sy_menu_model');
        $this->load->model('Pengaduan_model');
        $this->load->model('Wa_model');
        $this->load->helper('sf');
        // is_logged();
    }

    public function index() {

      
        $data=array(
        'button' => 'Create',
        'action' => site_url('coba/cobaupload'),
        );

        $database = $this->Wa_model->get_all();

        var_dump($database);

        $data1 = [
            "data" => [
                [
                    "phone"     => '085643538783',
                    "message"   => 'chat 1',
                    "secret"    => false,
                    "retry"     => false,
                    "isGroup"   => false
                ],
                [
                    "phone"     => '085643538783',
                    "message"   => 'chat 1',
                    "secret"    => false,
                    "retry"     => false,
                    "isGroup"   => false
                ],
                [
                    "phone"     => '085643538783',
                    "message"   => 'chat 1',
                    "secret"    => false,
                    "retry"     => false,
                    "isGroup"   => false
                ]
            ]
        ];
        echo "<pre>";
        var_dump($data1);

        $this->load->view('vcoba', $data);
        
    }

    public function send(){

        $nowa = '085643538783';//$this->input->post('nowa');
        $chat = 'pesan';//$this->input->post('chat');
        
        if(api_sendwa($nowa, $chat)){

            echo 'Pesan Whatsapp telah dikiirm';

        }
        else{
            echo 'Gagal Kirim Pesan Whatsapp';
        }

    }

    public function multiple_send(){

       // $nowa = array('085643538783','088805050000');
        //$chat = array('pesan ke satu', 'pesan kedua');


        
        //$payload=array($data);
        
        
        if(api_sendwa_multiple($data)){

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