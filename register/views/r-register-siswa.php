  
  <!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white">Register</h2>
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
              
              <div class="tab-pane fade in active p-15" id="register-tab">
                <form name="reg-form" class="register-form" method="post">
                  <div class="icon-box mb-0 p-0">
                    <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                      <i class="pe-7s-users"></i>
                    </a>
                    <h4 class="text-gray pt-10 mt-0 mb-30">REGISTRASI</h4>
                  </div>
                  <div class="alert alert-warning">

                        <span class="semibold">Catatan :</span>&nbsp;&nbsp;Silahkan diisi semua.

                    </div>
                    <hr>
                    <h5 class="text-gray text-center">IDENTITAS PENGGUNA</h5>
                    <br>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="form_name">Nama Depan</label>
                      <input name="form_name" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Nama Belakang </label>
                      <input name="form_email" class="form-control" type="email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_choose_username">Alamat</label>
                      <input id="form_choose_username" name="form_choose_username" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_choose_username">No Kontak</label>
                      <input id="form_choose_username" name="form_choose_username" class="form-control" type="text">
                    </div>
                  </div>
                  <hr>
                  <h5 class="text-gray text-center">IDENTITAS SEKOLAH</h5>
                    <br>
                  <div class="row">
                  <div class="form-group col-md-12">
                    <label>Tingkat Sekolah</label>
                    <select class="form-control" name="tingkatID" id="tingkatID" required>

                                <option value="">-Pilih Tingkat Sekolah-</option>

                                <option value="6">Kelas 1 - SD</option>

                                <option value="7">Kelas 2 - SD</option>

                                <option value="8">Kelas 3 - SD</option>

                                <option value="9">Kelas 4 - SD</option>

                                <option value="10">Kelas 5 - SD</option>

                                <option value="11">Kelas 6 - SD</option>

                                <option value="12">Kelas 7 - SMP</option>

                                <option value="13">Kelas 8 - SMP</option>

                                <option value="14">Kelas 9 - SMP</option>

                                <option value="15">Kelas 10 - SMA IPA</option>

                                <option value="16">Kelas 11 - SMA IPA</option>

                                <option value="17">Kelas 12 - SMA IPA</option>

                                <option value="18">Kelas 10 - SMA IPS</option>

                                <option value="19">Kelas 11 - SMA IPS</option>

                                <option value="20">Kelas 12 - SMA IPS</option>  

                            </select>
                  </div>
                </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_choose_password">Nama Sekolah</label>
                      <input id="form_choose_password" name="form_choose_password" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Alamat Sekolah</label>
                      <input id="form_re_enter_password" name="form_re_enter_password"  class="form-control" type="text">
                    </div>
                  </div>

                  <hr>
                  <h5 class="text-gray text-center">AKUN</h5>
                    <br>

                    <div class="row">
                    <div class="form-group col-md-12">
                      <label for="form_choose_password">Username</label>
                      <input id="form_choose_password" name="form_choose_password" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Password</label>
                      <input id="form_re_enter_password" name="form_re_enter_password"  class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Confirm Password</label>
                      <input id="form_re_enter_password" name="form_re_enter_password"  class="form-control" type="text">
                    </div>

                  </div>

                  <hr>
                  <h5 class="text-gray text-center">BIMBEL</h5>
                    <br>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label >Bimbel</label>
                      <select class="form-control" name="bimbel">
                                <option value="">- Pilih Bimbel Kalian -</option>
                                <option value="Neutron">Neutron</option>
                                <option value="GO">GO</option>
                                <option value="1bimbel lainya">Bimbel lainya</option>
                            </select>
                    </div>
                  </div>
                  <hr>
                  <div class="Keaktivan hide">
                        <div class="grid-col grid-col-8" >
                            <p class="text-center">DATA NEON</p>
                        </div> 
                       <div class="grid-col grid-col-8">
                            <div class="form-group">
                                <select class="form-control" name="cabang">
                                    <option value="">- Pilih Cabang -</option>
                                    <?php foreach ($cabang as $cabang_item): ?>
                                    <option value="<?=$cabang_item->id ?>"><?=$cabang_item->namaCabang ?></option>
                                    <?php endforeach ?>
                                </select>
                                <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->
                                <span class="text-danger"><?php echo form_error('cabang'); ?></span>
                            </div>
                        </div> 

                    <div class="form-group col-md-12">

                        <div class="form-group">

                            <input placeholder="Nomer Induk Siswa Neutron contoh : 120300xxx" type="text" class="form-control login-input input-sm" name="noinduk" value="<?php echo set_value('noinduk'); ?>" data-parsley-required>

                            <i class="ico-tag9 form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalaha penginputan nama pengguna -->

                            <span class="text-danger"><?php echo form_error('noinduk'); ?></span>

                        </div>

                    </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-12">


                        <p class="small">Untuk konfirmasi dan pengaktifan akun baru, kita akan mengirim kode aktivasi ke email kamu.</p>

                        <!-- Star form konfirmasi akun by email -->

                        <div class="form-group">

                            <input type="email" class="form-control input-sm" name="email" value="<?php echo set_value('email'); ?>" placeholder="xxx@mail.com" required>

                            <i class="ico-envelop form-control-icon"></i>

                            <!-- untuk menampilkan pesan kesalahan penginputan email -->

                            <span class="text-danger"><?php echo form_error('email'); ?></span> 

                        </div>

                    </div>
                     </div>

                  <div class="form-group">
                    <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">Register Now</button>
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
