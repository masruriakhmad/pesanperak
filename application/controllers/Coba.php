<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Sy_menu_model');
        $this->load->model('Pengaduan_model');
        // is_logged();
    }

    public function index() {

        /*
        $data_tbl = array('user');

        var_dump($data_tbl);

        
        foreach ($data_tbl as $key=> $vtbl) {

            echo '<br>'.$key.'<br>';

        }
        */
        

        $data = array(
            'content' => 'backend/dashboard',
            'content1' => 'data content1',

        );

        //$data1 =$this->Pengaduan_model->get_all();
        
        //var_dump($data1);

        //echo $data['content'];

        $data1=$data['content'].$data['content1'];
        $data=array(
            'data1'=> 'ini string',
            'data2'=> date('Y-m-d H:i:s')
        );

        //echo $data['data1'].$data['data2'];


        $x=0;
        for ($x=0 ; $x<=1; $x++){
            if($x==1){

                echo "ini x adalah".$x;
            }
            else if($x==0){
                
                
                echo "ini x adalah".$x;
            }

        }

        $x=0;
        for ($x=0 ; $x<=10; $x++){
            echo $x;

        }

        //$this->load->view('vcoba');
    }

    function cobaupload(){
        if($this->input->method()==='post')
            {

            $file_name='ktp';
            $config['upload_path']=FCPATH.'/uploads/ktp/';
            $config['allowed_types']='gif|jpg|jpeg|png';
            $config['file_name']=$file_name;
            $config['overwrite']=true;
            //$config['max_size']=1024;
            //$config['max_width']=1080;
            $config['max_height']=1080;

            $this->load->library('upload',$config);
            $file = $this->input->post('f_ktp_pelapor');

            if(!$this->upload->do_upload('f_ktp_pelapor')){

            echo $this->upload->display_errors();


            Echo "data tidak terupload";                
            //$data['error']= $this->upload->display_errors();

            }else{


            Echo "data terupload";

            }   

        
    }

}
}