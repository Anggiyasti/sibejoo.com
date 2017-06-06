  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Lupa Password</h2>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
           <div class="tab-content">
            <h3 class="text-center" >LUPA PASSWORD</h3>
            
            <!-- Mailchimp Subscription Form-->
            <form class="newsletter-form mt-40" name="form-register" action="<?= base_url() ?>index.php/register/ch_mail_aktivasi" method="post">
            <?php if ($this->session->flashdata('notif') != '') {

                        ?>

                        <div class="alert alert-warning">

                            <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                        </div>

                    <?php } else { ?>

                        <div class="alert alert-warning">

                            <span class="semibold">Note :</span>&nbsp;&nbsp;Kami akan kirimkan kode reset password ke email akun mu.

                        </div>

                    <?php }; ?>

                    <hr class="nm">
              <label for="mce-EMAIL"></label>
              <div class="input-group col-md-12">
                <input type="email" name="email" placeholder="xxx@mail.com" data-height="45px" class="form-control " value="">
                <span class="text-danger"><?php echo form_error('email'); ?></span>
                <!-- <span class="input-group-btn">
                  <button type="submit" class="btn btn-colored btn-dark btn-lg m-0" data-height="45px">Kirim Ulang Kode Verifikasi</button>
                </span> -->
              </div>

              <div class="form-group">
                    <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Submit</button>
              </div>
            </form>

            
          </div>
        </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Mailchimp Subscription Form Validation-->
            <script type="text/javascript">
              $('#mailchimp-subscription-form1').ajaxChimp({
                  callback: mailChimpCallBack,
                  url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
              });

              function mailChimpCallBack(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#mailchimp-subscription-form1'),
                      $response = '';
                  $mailchimpform.children(".alert").remove();
                  if (resp.result === 'success') {
                      $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  } else if (resp.result === 'error') {
                      $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  }
                  $mailchimpform.prepend($response);
              }
            </script>