<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=data_app()?></title>

    <link href="<?=base_url()?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/sweetalert/css/sweetalert.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?=base_url()?>assets/vendor/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Data Table -->
    <link href="<?=base_url()?>assets/vendor/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?=base_url()?>assets/vendor/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
 <!-- <link rel="stylesheet" href="<?=base_url()?>assets/vendor/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->

    <link href="<?=base_url()?>assets/vendor/datepicker/css/datepicker3.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/inspinia/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/radiocheck/radiocheck.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendor/inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/vendor/radiocheck/radioonoff.css"/>
    
    <!-- <link href="<?=base_url()?>assets/vendor/inspinia/css/animate.css" rel="stylesheet"> -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>    
    <script src="<?=base_url()?>assets/vendor/inspinia/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/1f5aa34486.js" crossorigin="anonymous"></script>
    
    <script>
                var loadFile = function (event) {
                var output = document.getElementById('prev1');
                
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function () {
                  URL.revokeObjectURL(output.src)
                  // free memory
                }
              };
</script>
<script>
                var loadFile2 = function (event) {
                var output = document.getElementById('prev2');

                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function () {
                  URL.revokeObjectURL(output.src)
                  // free memory
                }
              };
</script>

    <style>
  html { height: 100% !important; }
  body { height: 100% !important; padding-bottom: 30px; }
  .footer { position: fixed; left: 0; right: 0; bottom: 0; }
   .table-condensed{
  font-size: 13px;
}
</style>
</head>
<?php

$CI = &get_instance();
       //dari helper
       lookup();
//panggil sf_helper
$CI->load->model('Users_model');
$CI->load->model('User_access_model');
// $jml_upload_risalah      = $CI->Upload_risalah_model->total_rows();
// Penarikan jumlah data untuk syarat

// $CI->load->model('Kelengkapan_model');
// $jml_kelengkapan = $CI->Kelengkapan_model->total_rows();

?>
<body>
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                        <?php if ($this->session->userdata('foto') != '' && file_exists(FCPATH . "assets/foto_users/" . $this->session->userdata('foto'))) { //die('a');?>
                            <img alt="image" class="img-circle" src="<?=base_url()?>assets/foto_users/<?=$this->session->userdata('foto')?>" style="width: 45px;" />
                        <?php } else {?>
                            <img alt="image" class="img-circle" src="<?=base_url()?>assets/foto_users/a4.jpg" style="width: 45px;" />
                        <?php }?>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$CI->Users_model->get_by_id($this->session->userdata('id_user'))->fullname?></strong>
                             </span> <span class="text-muted text-xs block">Tentang <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#"><?=$this->session->userdata('email')?></a></li>
                            <li><a href="#"><?=$this->session->userdata('telp')?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?=base_url()?>auth/logout">Keluar</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        ER+
                    </div>
                </li>

<?php
//MENU DARI TABEL sy_menu
//meng aray kan menu dari tabel sy menu yang merupakan parent menu atau nilai parent 0
//select menu.nama menu where id_menu
//coding untuk filter menu berdasar group user

if($this->session->userdata('id_group') != 1){    
$this->db->group_by('user_access.id_menu');
$this->db->order_by('order_no','asc');
$this->db->join('sy_menu','sy_menu.id_menu=user_access.id_menu');
$this->db->where('sy_menu.parent',0);
$this->db->where('user_access.is_allow',1);
$this->db->where('user_access.id_group',$this->session->userdata('id_group'));
$data_menu=$this->db->get('user_access')->result();
}
else{
$data_menu=$this->db->order_by("order_no", "ASC")->get_where('sy_menu', array('parent' => 0,))->result();
}
foreach ($data_menu as $kmenu0 => $vmenu0) 
    
    {?>
        <li class="<?=strtolower(activate_menu($vmenu0->note))?>">

            <!--mengambil data field url yang berisi nama controler -->
            <a href="<?=base_url()?><?=$vmenu0->url?>">

                <!--mengambil data field icon yang berisi nama fa icon -->
                <i class="fa <?=$vmenu0->icon?>"></i>
                
                <!--mengambil data field label yang berisi nama Menu -->
                <span class="nav-label"><?=$vmenu0->label?></span>
                <span class="label label-primary pull-right"></span></a>

                <?php
                //meng aray kan menu dari tabel sy menu yang merupakan parent menu atau nilai parent sesuai id menu 
                if($this->session->userdata('id_group') != 1){  
                $this->db->group_by('user_access.id_menu');
                $this->db->order_by('order_no','asc');
                $this->db->join('sy_menu','sy_menu.id_menu=user_access.id_menu');
                $this->db->where('sy_menu.parent',$vmenu0->id_menu);
                $this->db->where('user_access.is_allow',1);
                $this->db->where('user_access.id_group',$this->session->userdata('id_group'));
                $data_submenu=$this->db->get('user_access')->result();
                }
                else{
                $data_submenu=$this->db->get_where('sy_menu', array('parent' => $vmenu0->id_menu))->result();
                }
                foreach ($data_submenu as $kmenu1 => $vmenu1) 
                    
                    {?>
                   
                   <ul class="nav nav-second-level">
                         <li>
                            <!-- ambil nama dari url menu yaitu controller-->
                            <a href="<?=base_url()?><?=$vmenu1->url?>">
                            <i class="fa <?=$vmenu1->icon?>"></i>
                            <?=$vmenu1->label?>
                         <!-- <span class="label label-primary pull-right">12</span> -->
                     </a></li>
                    </ul>
                <?php }?>

                </li>
                <?php }?>

            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Cari apa ..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"><?=data_app('APP_NAME')?>, <?=data_app('OPD_NAME')?></span>
                </li>

                <li>
                    <a href="<?=base_url() . 'auth/logout'?>">
                        <i class="fa fa-sign-out"></i> Keluar
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <!--Ini adalah Tag Content-->
        <div class="wrapper wrapper-content">
        <div class="table-responsive" >
            
        <?php $this->load->view($content);?>

        </div>
        </div>
        </div>

        <!--Ini Footer halaman-->
        <div class="footer">
            <div class="pull-right">
                <?=data_app('RIGHT_FOOTER');?>
            </div>
            <div>
                <?=data_app('LEFT_FOOTER');?>
            </div>
        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Mainly scripts Data Table -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    
    <!-- Morris -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/morris/morris.js"></script>

    <!-- Flot -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/inspinia.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?=base_url()?>assets/vendor/sweetalert/js/sweetalert.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Sparkline -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/chartJs/Chart.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?=base_url()?>assets/js/sf.js"></script>

    <!--Data Tables-->
    <script src="<?=base_url()?>assets/vendor/inspinia/js/plugins/DataTables/datatables.min.js"></script>
    
<!--Data Graph-->
  <script>
         Morris.Line({
        element: 'morris-one-line-chart',
        data:<?php echo $data_graph ?>,
        xkey: ['bulan'],
        ykeys: ['jml_pengaduan'],
        resize: true,
        lineWidth:4,
        labels: ['Jumlah Pengaduan'],
        lineColors: ['#1ab394'],
        pointSize:5,
        });
</script>
    
    <script>
        $(document).ready(function() {

            // $(".m-t").iCheck();
        //      $('input').iCheck({
        //     checkboxClass: 'icheckbox_minimal-grey',
        //     radioClass: 'iradio_minimal-grey'
        // });
        // $('input.timepicker').timepicker({ timeFormat: 'h:mm'});
        $('input.datepicker').datepicker({ format: 'dd-mm-yyyy',autoclose: true});
        // $('input.datepicker-ym').datepicker({ dateFormat: 'mm/yy'});
        
        });

    </script>
    -->
    <!--
    <script type="text/javascript">
            $(document).ready(function () {
                $('#tanggal_awal').datepicker({
                 //merubah format tanggal datepicker ke dd-mm-yyyy
                    format: "dd-mm-yyyy",
                    //aktifkan kode dibawah untuk melihat perbedaanya, disable baris perintah diatasa
                    //format: "dd-mm-yyyy",
                    autoclose: true
                });
            });
    </script>
        -->

    <script>

        //fungsi jika document telah diload semua
        $(document).ready(function(){
            //sembunyikan id_id_desa_pelapor
            $("id_desa_pelapor").hide();
             //sembunyikan id_desa_korban
            $("id_desa_korban").hide();
             //sembunyikan id_desa_kejadian
            $("id_desa_kejadian").hide();

            //memanggil fungsi load pelapor
            loaddesa_pelapor();
            //memanggil fungsi load korban
            loaddesa_korban();
            //memanggil fungsi load kejadian
            loaddesa_kejadian();
        });

        //fungsi dropdown chainned untuk meload daftar desa pelapor
        function loaddesa_pelapor(){
            
            //
            $("#id_kecamatan_pelapor").change(function(){

                //buat variable fungsi untuk mendapatkan value dari data kecamatan yang terpilih
                var getkecamatan_pelapor=$("#id_kecamatan_pelapor").val();

                //fungsi ajax chainned dropdown (format seperti json) menggunakan jquery getJSON
                $.ajax({
                    //type request POST
                    type :"POST",
                    //data type berupa JSON
                    dataType:"JSON",
                    //link url menuju controller Pengaduan dan method get desa
                    url: "<?= base_url();?>Pengaduan/get_desa",
                    //data value dari data kecamatan yang terpilih dan akan dikirim ke get desa
                    data : {kecamatan : getkecamatan_pelapor },

                    //jika fungsi sukses mengembalikan nilai balik berupa fungsi dibawah ini
                    success : function(data){
                        console.log(data);

                        //buat variable awal elemen html bernilai null
                        var html ='';
                        // buat variable counter
                        var i;
                        //fungsi for untuk menampilkan elemen data desa pada combobox dengan membaca panjang data
                        for (i=0; i<data.length; i++){

                            //tambah elemen html berdasar data hasil
                            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
                        }

                        //masukkan hasil elemen html ke inner html pada  combobox id desa pelapor
                        $("#id_desa_pelapor").html(html);
                        //tampilkan combobox desa pelapor
                        $("#id_desa_pelapor").show();
                    }
                });
            });
        }

        function loaddesa_korban(){
            

            $("#id_kecamatan_korban").change(function(){

                var getkecamatan_korban=$("#id_kecamatan_korban").val();

                $.ajax({
                    type :"POST",
                    dataType:"JSON",
                    url: "<?= base_url();?>Pengaduan/get_desa",
                    data : {kecamatan : getkecamatan_korban },

                    success : function(data){
                        console.log(data);

                        var html ='';
                        var i;
                        for (i=0; i<data.length; i++){

                            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
                        }

                        $("#id_desa_korban").html(html);
                        $("#id_desa_korban").show();
                    }
                });
            });
        }

        function loaddesa_kejadian(){
            

            $("#id_kecamatan_kejadian").change(function(){

                var getkecamatan_kejadian=$("#id_kecamatan_kejadian").val();

                $.ajax({
                    type :"POST",
                    dataType:"JSON",
                    url: "<?= base_url();?>Pengaduan/get_desa",
                    data : {kecamatan : getkecamatan_kejadian},

                    success : function(data){
                        console.log(data);

                        var html ='';
                        var i;
                        for (i=0; i<data.length; i++){

                            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
                        }

                        $("#id_desa_kejadian").html(html);
                        $("#id_desa_kejadian").show();
                    }
                });
            });
        }

                function loaddesa_kejadian(){
            

            $("#id_kecamatan").change(function(){

                var getkecamatan=$("#id_kecamatan").val();

                $.ajax({
                    type :"POST",
                    dataType:"JSON",
                    url: "<?= base_url();?>Users/get_desa",
                    data : {kecamatan : getkecamatan},

                    success : function(data){
                        console.log(data);

                        var html ='';
                        var i;
                        for (i=0; i<data.length; i++){

                            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>'
                        }

                        $("#id_desa").html(html);
                        $("#id_desa").show();
                    }
                });
            });
        }



    </script>
     
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                   // { extend: 'copy'},
                   // {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
        });
    </script>
    
  <script>
    $(function() {
    $("#tanggal").datepicker({
    dateFormat: 'yy/mm/dd'
      });
    });
  </script>

</body>
</html>
