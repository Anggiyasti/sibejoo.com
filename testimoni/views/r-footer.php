<footer id="footer" class="footer pb-0" data-bg-img="<?=base_url('assets/retemplate/images/footer-bg.png') ?>" data-bg-color="#25272e" style="background-image: url(&quot;images/footer-bg.png&quot;); background-position: initial !important; background-size: initial !important; background-repeat: initial !important; background-attachment: initial !important; background-origin: initial !important; background-clip: initial !important; background-color: rgb(37, 39, 46) !important;">
  <div class="container pt-70 pb-40">
    <div class="row multi-row-clearfix">
      <div class="col-md-6 col-md-offset-3 text-center">
        <img alt="" src="http://sibejoo.com/img/logo-sibejoo.png">
        <p class="font-12 mt-20 mb-60">NextEvent is a library of corporate and business templates with predefined web elements which helps you to build your own site. Lorem ipsum dolor sit amet elit.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="widget dark">
          <h5 class="widget-title line-bottom-theme-colored-2">Mengenai Sibejoo</h5>
          <div class="text-widget">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt distinctio soluta corporis, omnis odit libero ad laborum illum, nam, accusamus nihil cumque magnam voluptatibus eos odio ratione mollitia.</p>
          </div>
          <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-20">
            <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
            <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a> </li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a> </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="widget dark">
          <h5 class="widget-title line-bottom-theme-colored-2">Video Terbaru</h5>
          <div class="row" id="video_last">
            <ul class="list list-divider list-border">
            </ul>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
        <div class="widget dark">
          <h5 class="widget-title line-bottom-theme-colored-2">Kirim Kami Testimoni</h5>
          <form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post" novalidate="novalidate">

            <div class="form-group">
              <textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="7" aria-required="true" id="isitestimoni"></textarea>
            </div>
            <div class="form-group">
              <input name="form_botcheck" class="form-control" type="hidden" value="">
              <a type="submit" onclick="simpan_testimonials()" class="btn btn-default btn-transparent btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</a>
            </div>
          </form>

          <!-- Quick Contact Form Validation-->
          <script type="text/javascript">
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
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-theme-colored p-20">
    <div class="row text-center">
      <div class="col-md-12">
        <p class="text-white font-11 m-0">Copyright ©2017 Neon Develover</p>
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
</script>