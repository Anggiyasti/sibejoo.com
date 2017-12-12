  
  <!-- Start main-content -->
  <div class="main-content" id = "login">

  

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
           

            <div class="tab-content" id = "garis">
              <div class="tab-pane fade in active p-20" >
                <h4> Silahkan Masuk</h4>
                <hr>
                   <?php if ($this->session->flashdata('notif') != '') {

                    ?>

                    <div class="alert alert-warning">

                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>

                    </div>

                <?php } else { ?>

                    <div class="alert alert-warning">

                        Siap berpetualang? Isi form, tekan masuk!

                    </div>

                <?php }; ?>
              </div>
                <section class="main">
        <form action = "<?= base_url('index.php/login/validasiLogin'); ?>" name="login-form" class="clearfix form-1" method = "post">
          <p class="field">
            <input type="text" name="username" placeholder="Username or email">
            <i class="glyphicon glyphicon-user"></i>
          </p>
            <p class="field">
              <input type="password" name="password" placeholder="Password">
              <i href="" class="glyphicon glyphicon-eye-open" id = "show" title="lihat kata sandi"></i>
          </p>
           <p class="field">
              <input type="checkbox" name="ceklis">             Lihat Kata Sandi
          </p>
          <p class="submit">
            <button type="submit" name="submit" title = "Login">Masuk</button>
          </p>
          <hr>
           <div class="clear text-center mt-15">
                  <label for="form_checkbox">
                    <a class="text-theme-colored font-weight-600 font-12" href="<?= base_url('index.php/register'); ?>">Belum Punya Akun?</a>  <a class="text-theme-colored font-weight-600 font-12" href="<?= base_url('index.php/register/lupapassword'); ?>">Lupa Password?</a>
          </div>
        </form>
      </section>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
  <script type="text/javascript">
  $(document).ready(function(){
    var type_input_pswd = 'password';

    //event look pswd
    $('input[name="ceklis"]').click(function(){  
      // pengecekan type input password
      type_input_pswd = $("input[name=password]").get(0).type;
      console.log(type_input_pswd);
      if (type_input_pswd == "password") {
        // jika type password di ubah ke text
        $("input[name=password]").get(0).type = 'text';
        $("#show").removeClass("glyphicon-eye-open");
        $("#show").addClass("glyphicon-eye-close");
        type_input_pswd='text';
      } else {
         // jika type text di ubah ke password
        $("input[name=password]").get(0).type = 'password';
        type_input_pswd='password';
        $("#show").removeClass("glyphicon-eye-close");
        $("#show").addClass("glyphicon-eye-open");
      }

    });
  });  </script>
