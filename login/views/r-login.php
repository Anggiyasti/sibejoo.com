  
  <!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Login</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
           

            <div class="tab-content">
              <div class="tab-pane fade in active p-15" >
                <h4 class="text-gray mt-0 pt-5"> Silahkan Login</h4>
                <?php if ($this->session->flashdata('notif') != '') {

                    ?>

                    <div class="alert alert-warning">

                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                    </div>

                <?php } else { ?>

                    <div class="alert alert-warning">

                        Siap berpetualang? Isi form, tekan Login!

                    </div>

                <?php }; ?>

                <hr>

                <br>
                <form action = "<?= base_url('index.php/login/validasiLogin'); ?>" name="login-form" class="clearfix" method = "post">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_username_email">Username/Email</label>
                      <input type="text" name="username" class="form-control" class="form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_password">Password</label>
                      <input name="password" type="password" class="form-control"  required>
                    </div>
                  </div>
                  <div class="clear pull-left mt-15">
                    <label for="form_checkbox">
                      <a class="text-theme-colored font-weight-600 font-12" href="<?= base_url('index.php/register/lupapassword'); ?>">Lupa Password?</a>
                  </div>
                  <div class="form-group pull-right mt-10">

                    <button type="submit" class="btn btn-dark btn-theme-colored">Login</button>
                  </div>
                  <div class="clear text-center mt-15">
                  <label for="form_checkbox">
                    <a class="text-theme-colored font-weight-600 font-12" href="<?= base_url('index.php/register'); ?>">Belum Punya Akun?</a>
                  </div>
                  
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
