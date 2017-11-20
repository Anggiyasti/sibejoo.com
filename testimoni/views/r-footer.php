<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;);">
        <div class="container">
          <div class="row border-bottom">
            <div class="col-sm-6 col-md-3">
              <div class="widget dark">
                <img class="mt-5 mb-20" alt="" src="http://sibejoo.com/img/logo-sibejoo.png">
                <p>PT VORTEX BUANA EDUMEDIA</p>
                <ul class="list-inline mt-5">
                  <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">022-0662395</a> </li>
                  <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-gray" href="#">contact@sibejoo.com</a> </li>
                  <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="https://sibejoo.com/">https://sibejoo.com/</a> </li>
                  <li class="m-0 pl-10 pr-10"><i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#" >Line: @wuf2783p (Sibejoo)</a></li>
                  <li class="m-0 pl-10 pr-10"><i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-gray" href="#" >Komplek Taman Mutiara Blok C1 No 11 Cibabat, Cimahi.</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="widget dark">
                <h4 class="widget-title">Useful Links</h4>
                <ul class="list angle-double-right list-border">
                  <li><a href="<?=base_url()?>edudrive/allmodul">Edu Drive</a></li>
                  <li><a href="<?=base_url()?>konsultasi/pertanyaan_all">Konsultasi</a></li>
                  <li><a href="<?=base_url()?>tesonline/daftarlatihan">Latihan</a></li>
                  <li><a href="<?=base_url()?>passinggradefront/passinggrade_univ">Passing Grade</a></li>
                  <li><a href="<?=base_url()?>tryout">Try Out</a></li>              
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="widget dark">
                <h4 class="widget-title line-bottom-theme-colored-2">Jam Kerja</h4>
                <div class="opening-hours">
                  <ul class="list-border">
                    <li class="clearfix"> <span>  Senin - Jum'at :  </span>
                      <div class="value pull-right"> 8.00 am - 16.00 pm </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="widget dark">
                <h5 class="widget-title line-bottom-theme-colored-2">Video Terbaru</h5>
                <div class="row" id="video_last">
                  <ul class="list list-divider list-border">
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="widget dark">
                <h4 class="widget-title">Kirim Kami Testimoni</h4>
                <form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post" novalidate="novalidate">
                  <div class="form-group">
                    <textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="7" aria-required="true" id="isitestimoni"></textarea>
                  </div>
                  <div class="form-group">
                    <input name="form_botcheck" class="form-control" type="hidden" value="">
                    <a type="submit" onclick="simpan_testimonials()" class="btn btn-default btn-transparent btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row mt-10">
            <div class="col-md-2">
                <div class="widget dark">
                  <h5 class="widget-title mb-10">Hubungi kami</h5>
                  <div class="text-gray">
                   022-87805676 <br>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="widget dark">
                  <h5 class="widget-title mb-10">Terhubung dengan kami</h5>
                  <ul class="styled-icons icon-bordered icon-sm">
                    <li><a href="https://www.facebook.com/Sibejoo-239504716124473"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/sibejoo"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.youtube.com/user/sibejoo"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="https://www.instagram.com/sibejoo/"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-5 col-md-offset-2">
                <div class="widget dark">
                  <h5 class="widget-title mb-10">Berlangganans</h5>
                  <!-- Mailchimp Subscription Form Starts Here -->
                  <form id="mailchimp-subscription-form-footer2" class="newsletter-form" id="formsubs" method="post" action="javascript:void(0)">
                    <div class="input-group">
                      <input type="email" name="email" id="emailsubs3" placeholder="Email Anda" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer" value="<?php echo set_value('email'); ?>" required>
                      <span class="input-group-btn">
                        <input type="button" value="Berlangganan" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14" data-height="45px" onclick="subscriber()"> 
                      </span>
                    </div>
                  </form>
                  <!-- Mailchimp Subscription Form Validation-->
                  <script type="text/javascript">
                    function subscriber(){
                      email = $('#emailsubs3').val();
                      // Hide any previous response text
                      $mailchimpform = $('#mailchimp-subscription-form-footer2'),
                      $mailchimpform.children(".alert").remove();
                      if (email=="" || email==" ") {
                        $mailchimpform.prepend('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Email Tidak Boleh Kosong!</div>');
                      } else {
                        $.ajax({
                          url: base_url+'homepage/addsubs',
                          type: "POST",
                          data: {email:email},
                          dataType: "json",
                          success: function(data) {
                            respon_action(data);
                          },
                          error: function(data) {
                            respon_action(data);
                          }
                        });
                      }
                    }



                function respon_action(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#mailchimp-subscription-form-footer2'),
                  $response = '';
                  $mailchimpform.children(".alert").remove();
                  if (resp.status === true) {
                    $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.message + '</div>';
                  } else if (resp.status === false) {
                    $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.message + '</div>';
                  }
                  $mailchimpform.prepend($response);
                }
                  </script>
                  <!-- Mailchimp Subscription Form Ends Here -->
                </div>
              </div>
          </div>
        </div>
        <div class="container-fluid bg-theme-colored p-20">
          <div class="row text-center">
            <div class="col-md-12">
              <p class="text-white font-11 m-0">Copyright ©2017 Sibejoo. All Rights Reserved</p>
            </div>
          </div>
        </div>
      </footer>

<script>
  function simpan_testimonials(){
    var isitestimoni = $("#isitestimoni").val();

    if (isitestimoni=="") {
      swal("Failed", "Silahkan isi testimoni!", "warning")

    }else{
      $.ajax({
        type: "POST",
        url: '<?php echo base_url() ?>index.php/testimoni/addtestimoni',
        data: {isitestimoni: isitestimoni},
        success: function (data)
        {
          swal("Good job!", "Testimoni mu telah terkirim!", "success")
          document.getElementById("isitestimoni").value = "";
        },
        error: function ()
        {
          alert('fail');
        }
      });
    }
  }


  $.ajax({
   type: "POST",
   dataType:"JSON",
   url: "<?= base_url() ?>video/ajax_get_last_video",
   success: function (data,i) {
    $('#video_last ul').append(data.data[0]);
    $('#video_last ul').append(data.data[1]);
  }
});

  function kunjungivideo(data){
    document.location = base_url+"video/seevideo/"+data;
  }  

  function subscribe(){
            email = $('#emailsubs').val();

            $.ajax({
              url: base_url+'homepage/addsubs',
              type: "POST",
              data: {email:email},
              dataType: "json",
              success: function(data) {
                respon_action(data);
              },
              error: function(data) {
                respon_action(data);
              }
            });
          }   

          function respon_action(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#mailchimp-subscription-form-footer'),
                  $response = '';
                  $mailchimpform.children(".alert").remove();
                  if (resp.status === true) {
                    $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.message + '</div>';
                  } else if (resp.status === false) {
                    $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.message + '</div>';
                  }
                  $mailchimpform.prepend($response);
                }    
  $("#footer_quick_contact_form").validate({
              submitHandler: function(form) {
                var form_btn = $(form).find('button[type="submit"]');
                var form_result_div = '#form-result';
                $(form_result_div).remove();
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                $(form).ajaxSubmit({
                  dataType:  'json',
                  success: function(data) {
                    if( data.status == 'true' ) {
                      $(form).find('.form-control').val('');
                    }
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn('slow');
                    setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                  }
                });
              }
            });   
</script>