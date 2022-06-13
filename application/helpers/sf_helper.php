<?php
// function get_data_kategori($for_modul)
// {
//     $ci                   = &get_instance();
//     $data_ref_anggota = $ci->db->join('kategori bb', 'aa.ket=bb.id_kategori', 'right')
//         ->where('bb.for_modul', $for_modul)
//         ->get('kategori aa')->result_array();
//     $ref_kategori = array();
//     foreach ($data_ref_anggota as $v) {
//         $ref_kategori[$v['id_kategori']] = $v['nama_kategori'];
//     }
//     return $ref_kategori;

// }
//--------------untuk bikin dropdown------------/


function is_logged()
{
    $ci = &get_instance();
    if ($ci->session->userdata('logged') != true) {
        redirect('Frontend', 'refresh');
    }
}

//fungsi izin aktif menu
function is_allow($acs)
{
    $ci      = &get_instance();
    $lvl     = $_SESSION['level'];
    $isallow =$ci->db->query(
        "SELECT * FROM user_access as aa inner join master_access as bb 
        on aa.kd_access=bb.id 
        WHERE bb.nm_access='$acs' and aa.id_group='$lvl'"
    )->row();
    
    if ($isallow != []) {
        if ($isallow->is_allow == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }

}

function get_data_kategori($for_modul)
{

    $ci                   = &get_instance();
    $data_kateg = $ci->db
        ->where('for_modul', $for_modul)
        ->get('kategori')->result_array();
    $ref_kategori = array();
    $ref_kategori = array(""=>">> Pilih");
    foreach ($data_kateg as $v) {
        $ref_kategori[$v['id_kat']] = $v['cat_name'];
    }
    return $ref_kategori;

}

function get_combo($tbl,$id,$nm,$add_opt)
{

    $ci = &get_instance();
    $data = $ci->db->get($tbl)->result_array();
    $res = array();
    $res = $add_opt;
    foreach ($data as $v) {
        $res[$v[$id]] = $v[$nm];
    }
    return $res;

}

function get_by_id_kategori($id)
{

    $ci                   = &get_instance();
    $data_kateg = $ci->db
        ->where('id_kat', $id)
        ->get('kategori')->row();
    $data_kateg->cat_name;
    return $data_kateg->cat_name;

}
// function get_data_dropdown($tbl,$where)
// {

//     $ci                   = &get_instance();
//     $data_tbl = $ci->db
//         ->where('for_modul', $for_modul)
//         ->get($tbl)->result_array();
//     $ref_kategori = array();
//     $ref_kategori = array(""=>">> Pilih");
//     foreach ($data_tbl as $v) {
//         $ref_kategori[$v['id_kat']] = $v['cat_name'];
//     }
//     return $ref_kategori;

// }

function data_app($id = 'APP_NAME')
{
    $ci            = &get_instance();
    $data_instansi = $ci->db->query("SELECT conf_val FROM sy_config WHERE conf_name='$id'")->row();

    if ($data_instansi != []) {
       return $data_instansi->conf_val;
    } else {
        return "";
    }
    
}

//fungsi layout untuk dipanggil di setiap controller
function layout($l = 'back')
{
    if ($l == 'front') {
        return "layout_frontend";
    } else {
        return "layout_backend";
    }
}


//fungsi cek session akses
function cek_session_akses($link, $id)
{
    $ci      = &get_instance();
    $session = $ci->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    if ($session == '0' and $ci->session->userdata('level') != 'admin') {
        redirect(base_url() . 'administrator/home');
    }
}

//fungsi mendapatkan data user
function get_data_users()
{
    $ci = &get_instance();
    $ci->db->select('*')
        ->where_in('level', array('2', '3'))
        ->where('isactive', 1);
    $data_users_disposisi = $ci->db->get('users')->result_array();
    $users_disposisi      = array();
    foreach ($data_users_disposisi as $v) {
        $users_disposisi[$v['id_user']] = $v['fullname'];
    }
    return $users_disposisi;
}

//fungsi menampilkan jumlah wor pada suatu table
function get_numrows($tbl)
{
    $ci = &get_instance();
    $ci->db->select('*');
    $total_row = $ci->db->get($tbl)->num_rows();
    return $total_row;
}


//fungsi mengaktifkan menu
function activate_menu($controller, $by = 'c')
{
    //c=controller, f=method/function
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router class to active.
    if ($by == 'c') {
        $class = $CI->router->fetch_class();
    } elseif ($by == 'f') {
        $class = $CI->router->fetch_method();
    }
    return ($class == $controller) ? 'active' : '';
}

//fungsi format rupiah
function format_rupiah($number)
{

    return 'Rp ' . number_format($number);
}

function formatBytes($size, $precision = 2)
{
    $base     = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

//fungsi lookup untuk menampilkan modal lookup
function lookup()
{?>
<div class="modal" id="lookup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        &times;
                    </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1><i class="fa fa-refresh"></i></h1>
                </div>
            </div>
        </div>
    </div>
<?php }

//fungsi nama hari
function nama_hari($day){
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

return $dayList[$day];
}

//fungsi tanggal format indonesia
function tanggal_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal
 
    echo $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

//fungsi generator kode
function GenerateCode() {
    $possible ='123456789';
    $operator ='+x-';   
    $admin    = array('Edy S', 'Bima N', 'Zaki C');
    $a = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    $b = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    $opr = substr($operator, mt_rand(0, strlen($operator)-1), 1);
    if($opr=='+'){
        $res = $a + $b;
    }
    else if($opr=='x'){
        $res = $a * $b;
    }
    else{
        $res = $a - $b;
    }
    $code['adm']  = $admin[mt_rand(0, strlen($operator)-1)];
    $code['res']  = $res;
    $code['text'] = $a.' '.$opr.' '.$b.' =';
    return $code ;
}

//fungsi backup Database
function backupDB(){

// Try this, You can change format zip to gz if you like :)
$CI = get_instance();
$CI->load->dbutil();

$prefs = array(     
    'format'      => 'zip',             
    'filename'    => 'my_db_backup.sql'
    );


$backup =& $CI->dbutil->backup($prefs); 

$db_name = data_app(). date("Y-m-d-H-i-s") .'.zip';
$save = base_url().'assets/db/'.$db_name;

$CI->load->helper('file');
write_file($save, $backup); 


$CI->load->helper('download');
force_download($db_name, $backup);
}

// pastikan untuk menggunakan sf_upload, di controller._rules field jangan di required
function sf_upload($nama_gambar, $lokasi_gambar, $tipe_gambar, $ukuran_gambar, $name_file_form) {
    $CI                    = &get_instance();
    $nmfile                = $nama_gambar. "_" . time();
    $config['upload_path'] = './' . $lokasi_gambar;
    //tambahi skrip disini is_dir exist
    $config['allowed_types'] = $tipe_gambar;
    $config['max_size']      = $ukuran_gambar;
    $config['file_name']     = $nmfile;
    $CI->load->library('upload', $config);
    $CI->upload->do_upload($name_file_form);
    //die($CI->upload->display_errors());
    $result1 = $CI->upload->data();
    $result  = ['gambar' => $result1];
    $dfile   = $result['gambar']['file_name'];

    return $dfile;
}

//fumgsi api whatsapp
function api_sendwa($nowa,$chat){
    $curl = curl_init();
    $token = "O6UT8a7LZ5mug1gEGcRgKP1DxrGBQo2t9wMqT31GgMdtdU9xwFQk42k2m615hkC0";
    $data = [

        'phone'     => $nowa,
        'message'   => $chat,
        'secret'    => false, // or true
        'priority'  => false, // or true
    ];
    
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: $token",
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    
    return json_decode($result);
}

//fungsi multiple send text whatsapp
function api_sendwa_multiple($data){
    
    $curl   = curl_init();
    $token  = "O6UT8a7LZ5mug1gEGcRgKP1DxrGBQo2t9wMqT31GgMdtdU9xwFQk42k2m615hkC0";
    $random = true;
    $payload= $data;
    curl_setopt($curl, CURLOPT_HTTPHEADER,
    array(
        "Authorization : $token",
        "Content-Type  : application/json"
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($curl, CURLOPT_URL, "https://kudus.wablas.com/api/v2/send-message?random=$random");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result);

}
