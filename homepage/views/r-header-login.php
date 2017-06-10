<header id="header" class="header">
 <div class="header-top bg-theme-color-2 sm-text-center p-0">
  <div class="container">
   <div class="row">
    <div class="col-md-4">
     <div class="widget no-border m-0">
      <ul class="list-inline font-13 sm-text-center mt-5">
       <li>
        <a href="tel:(022)87805676 " class="text-white"><i class="fa fa-phone"></i> (022)87805676 </a>
       </li>
       <li>
        <a href="mailto:contact@sibejoo.com  " class="text-white"><i class="fa fa-envelope-o"></i> info@sibejoo.com </a>
       </li>
       <li>
        <a class="text-white" href="<?=base_url('logout') ?>">Logout</a>
       </li>
      </ul>
     </div>
    </div>
    <div class="col-md-8">
     <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
      <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
       <li><a href="https://www.facebook.com/Sibejoo-239504716124473"><i class="fa fa-facebook text-white"></i></a></li>
       <li><a href="https://twitter.com/sibejoo"><i class="fa fa-twitter text-white"></i></a></li>
       <li><a href="https://www.instagram.com/sibejoo/"><i class="fa fa-instagram text-white"></i></a></li>
      </ul>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="header-middle p-0 bg-lightest xs-text-center">
  <div class="container pt-0 pb-0">
   <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-5">
     <div class="widget no-border m-0">
      <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="<?=base_url()?>"><img src="http://sibejoo.com/img/logo-sibejoo.png" alt=""></a>
     </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4">
     <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
      <ul class="list-inline">
       <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
       <li>
        <a href="#" class="font-12 text-gray text-uppercase">Hubungi Kami Sekarang!</a>
        <h5 class="font-14 m-0"> +(022) 87805676</h5>
       </li>
      </ul>
     </div>
    </div>  
    <div class="col-xs-12 col-sm-4 col-md-3">
     <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
      <ul class="list-inline">
       <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
       <li>
        <a href="#" class="font-12 text-gray text-uppercase">Kita Buka</a>
        <h5 class="font-13 text-black m-0"> Senin-Sabtu 8:00-16:00</h5>
       </li>
      </ul>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="header-nav">
  <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px" style="z-index: auto; position: static; top: auto;">
   <div class="container">
    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive"><a href="javascript:void(0)" class="showhide" style="display: none;"><em></em><em></em><em></em></a>

     <ul class="menuzord-menu menuzord-indented scrollable" style="max-height: 400px;">
    
      <!--  CEK USERNYA SIAPA -->
      <!--  KALO SISWA, KELUARIN MENU YANG INI. -->
      <?php if ($this->session->userdata('HAKAKSES')=='siswa'): ?>
          <li><a href="<?=base_url('welcome') ?>">Home<span class="indicator"></a></li>
          <li><a href="<?=base_url('video') ?>">Video<span class="indicator"></a></li>
          <li><a href="<?=base_url('tryout') ?>">Try Out<span class="indicator"></a></li>
          <li><a href="<?=base_url('konsultasi/pertanyaan_all') ?>">Konsultasi<span class="indicator"></a></li>
          <li><a href="<?=base_url('tesonline/daftarlatihan') ?>">Latihan<span class="indicator"></a></li>
          <li><a href="<?=base_url('ortuback/pesan') ?>">Pesan<span class="indicator"></a></li>
          <li><a href="<?=base_url('modulonline/allmodul') ?>">Edu Drive<span class="indicator"></a></li>

          <ul class="menuzord-menu menuzord-indented scrollable" style="max-height: 400px;">
            <li><a href="#home"> Learning Line<span class="indicator"></a>
             <ul class="dropdown" style="right: auto; display: none;">
              <li><a href="javascript:void(0);" onclick="lineMapel(1)">SD<span class="indicator"></span></a></li>
              <li><a href="javascript:void(0);" onclick="lineMapel(2)">SMP<span class="indicator"></span></a></li>
              <li><a href="javascript:void(0);" onclick="lineMapel(3)">SMA<span class="indicator"></span></a></li>
              <li><a href="javascript:void(0);" onclick="lineMapel(4)">SMA IPA<span class="indicator"></span></a></li>
              <li><a href="javascript:void(0);" onclick="lineMapel(5)">SMA IPS<span class="indicator"></span></a></li>
            </ul>
           </li>
            
            <ul class="menuzord-menu menuzord-indented scrollable" style="max-height: 400px;">
             <li><a href="#home">Halo, <?=$this->session->userdata('NAMASISWA') ?>!<span class="indicator"><?php if ($this->session->userdata('member')==1): ?>
                <span class="label label-info" title="Member"><i class="fa fa-user"></i> </span>
              <?php endif ?></a>
              <ul class="dropdown" style="right: auto; display: none;">
               <li><a href="<?=base_url('siswa') ?>">Dashboard<span class="indicator"></span></a>
               <li><a href="<?=base_url('siswa/profilesetting') ?>">Pengaturan Profile<span class="indicator"></span></a>
               <li><a href="<?=base_url('') ?>">Donasi<span class="indicator"></span></a>
               <li><a href="<?=base_url('logout') ?>">Logout<span class="indicator"></span></a>
               </li>
              </li>
             </ul>
      <?php else: ?>
      <!--  KALO ORANG TUA MURID, KELUARIN MENU YANG INI. -->
      <li><a href="<?=base_url('welcome') ?>">Welcome<span class="indicator"></a></li>
      <li><a href="<?=base_url('video') ?>">Video<span class="indicator"></a></li>
      <li><a href="<?=base_url('tryout') ?>">Try Out<span class="indicator"></a></li>
      <li><a href="<?=base_url('welcome') ?>">Latihan<span class="indicator"></a></li>
      <li><a href="<?=base_url('welcome') ?>">Pesan<span class="indicator"></a></li>
      <li><a href="<?=base_url('welcome') ?>">Halo, <?=$this->session->userdata('USERNAME') ?>! 
        <?php if ($this->session->userdata('member')==1): ?>
          <span class="label label-info">Member</span>
        <?php endif ?>
      <span class="indicator"></a></li>     
     <?php endif ?>



    </ul>

    

    <div id="top-search-bar" class="collapse">
     <div class="container">
      <form role="search" action="#" class="search_form_top" method="get">
       <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
       <span class="search-close"><i class="fa fa-search"></i></span>
      </form>
     </div>
    </div>
   </nav>
  </div>
 </div><div style="display: none; width: 1351px; height: 73px; float: none;"></div>
</div>
</header>

<script type="text/javascript">
function laporkanbug() {
 $('#laporkanbug').modal('show');
 $('#laporkanbug .info .lengkapi').addClass('hide');
 $('#laporkanbug .info .gagal').addClass('hide');
 $('#laporkanbug .info .sukses').addClass('hide');

}

function post_bug(){
 var datas = {
  'isi' : $('input[name=halaman]').val(),
  'alamat': $('textarea[name=message]').val()
 };


        $('.lapor').text('Lapor'); //change button text
                $('.lapor').attr('disabled',false); //set button enable
        $('.selesai').text('Batal'); //change button text
        if (datas.isi=="" || datas.alamat=="") {
         $('#laporkanbug .info .lengkapi').removeClass('hide');
         $('#laporkanbug .info .sukses').addClass('hide');
         $('#laporkanbug .info .gagal').addClass('hide');
        }else{
         url = base_url+"bug/ajax_add_bug";
         $.ajax({
          dataType:'text',
          data:datas,
          type:'POST',
          url: url,
          success:function(data){
           $('#laporkanbug .info .lengkapi').addClass('hide');
           $('#laporkanbug .info .sukses').removeClass('hide');
           $('#laporkanbug .info .gagal').addClass('hide');
           $('.form-laporan')[0].reset();

              $('.lapor').text('Melapor..'); //change button text
                      $('.lapor').attr('disabled',true); //set button enable
              $('.selesai').text('selesai..'); //change button text


             },error:function(){
              $('#laporkanbug .info .lengkapi').removeClass('hide');
              $('#laporkanbug .info .sukses').addClass('hide');
              $('#laporkanbug .info .gagal').removeClass('hide');
             }
            });
        }
        
       }
       </script>

       <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

       <script type="text/javascript">

       jQuery(document).ready(function () {
        var socket = io.connect( 'http://'+window.location.hostname+':3000' );
        var new_count_komen = 0;
        var mapelID=8;
        var obMapel ='';
        var penggunaID = ('<?=$this->session->userdata['id']?>');
        var url = "<?= base_url() ?>index.php/ortuback/ajax_ortuID";

    // SOCKET CREATE LAPORAN
    socket.on('pesan_baru', function(data){
     $.getJSON( base_url+"ortuback/jumlah_pesan/"+penggunaID, function( datas ) {
      $('.jumlah_notifikasi').text(datas);
     });
     var id_ortu = data.id_ortu;
     var jenis_lapor = data.jenis_lapor;
     var isi = data.isi;
      // substring dulu isi nya dari 0 sampe 10
      var isi_sub = isi.substring(0,10);

      $.ajax({
       url:url,
       success:function(data){
              // ubah type data  dari json ke objek
              obj =JSON.parse(data);
              
              // ambil id ortu dari objek 
              ortuID = obj[0].id;


              for (i = 0; i < obj.length; i++) { 
                // cek pengguna yang dituju bukan?
                if (id_ortu == ortuID ) {
                    // play sound notification
                    $('#notif_audio')[0].play();
                    //add laporan baru ke data notif id message-tbody
                    $( "#message-tbody" ).prepend('<li> <a href="'+base_url+'ortuback/pesan/'+data.UUID+'" class="media border-dotted read">'+isi_sub+'</a></li>');
                    // $( "#message-tbody" ).prepend(' <a href="'+base_url+'ortuback/see_message/'+data.UUID+'" class="media border-dotted read">'+isi+'</a>');
                   } 
                  }


                 },              
                });

      
     });
    // SOCKET CREATE LAPORAN



    


   });


</script>
<script type="text/javascript">
    function lineMapel(id_tingkat) {
        url_ajax = base_url+"linetopik/ambiltingkat";

        var global_properties = {
          id_tingkat: id_tingkat
        };

        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: url_ajax,
          data: global_properties,
          success: function(data){
            window.location.href = base_url + "linetopik/lineMapel";  
          },error:function(data){
            sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
          }

        });
    }
    
</script>