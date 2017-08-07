 <?php 

        foreach ($siswa as $row) {

            $namaDepan = $row['namaDepan'];

            $namaBelakang = $row['namaBelakang'];

            $alamat = $row['alamat'];

            $noKontak = $row['noKontak'];

            $biografi = $row['biografi'];

            $namaSekolah = $row['namaSekolah'];

            $alamatSekolah  = $row['alamatSekolah']; 

            $photo=base_url().'assets/image/photo/siswa/'.$row['photo'];

            $oldphoto=$row['photo'];

        } ;

     ?>       

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/upbar.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>


<div class="modal fade " tabindex="-1" role="dialog" id="myModal">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>

      </div>

      <div class="modal-body">

        <div id="chartContainer" style="height: 400px; width: 100%;">

        </div>

        <div class="modal-footer bg-color-3">



        </div>

      </form>



    </div>

  </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

</div>

<div class="modal fade " tabindex="-1" role="dialog" id="myModal2">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title">Modal title</h4>

      </div>

      <div class="modal-body">





      </div>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div>

<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center text-white">{judul_header}</h1>
        </div>
      </div>
    </div>
  </div>      
</section>
<!-- TITLE -->

<section>
  <div class="container">
        <div class="row">
  <ul id="myTab" class="nav nav-tabs boot-tabs col-md-12" style="margin-left: 15px;">
    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
    <li><a href="#photo" data-toggle="tab">Photo</a></li>
    <li><a href="#email" data-toggle="tab">Email</a></li>
    <li><a href="#password" data-toggle="tab">Password</a></li>
  </ul>
<br>

          <div class="col-md-12">
            <div class="border-1px p-25">
            <?php if ($this->session->flashdata('updsiswa') != '') {
               ?>
              <div class="alert alert-warning fade in">

                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <span class="semibold">Note :</span><?php echo $this->session->flashdata('updsiswa'); ?>
              </div>
              
              <?php } else { ?>

                                <div class="alert alert-warning fade in">

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                    <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.

                                </div>

                            <?php }; ?>

              <div id="myTabContent" class="tab-content">
              
              <div class="tab-pane fade in active" id="profile">
              
              <form class="panel form-horizontal form-bordered" name="form-profile" action="<?=base_url()?>index.php/siswa/ubahprofilesiswa" method="post" accept-charset="utf-8" enctype="multipart/form-data">



                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">
                                            <h4 class="text-theme-colored text-uppercase m-0">Profile</h4>
                                            <div class="line-bottom mb-30"></div>
                                            <p>This information appears on your public profile, search results, and beyond.</p>
                                                
                                                
                                            </div>

                                        </div>

                                        

                                        <div class="form-group">

                                            <label class="control-label">Nama Depan</label>


                                                <input type="text" class="form-control" name="namadepan" value="<?=$namaDepan;?>">

                                                <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>

                                            
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label">Nama Belakang</label>


                                                 <input type="text" class="form-control" name="namabelakang" value="<?=$namaBelakang;?>">


                                        </div>


                                        <div class="form-group">

                                            <label class="control-label">Alamat</label>


                                                 <input type="text" class="form-control" name="alamat" value="<?=$alamat; ?>">

                                                 <span class="text-danger"> <?php echo form_error('namadepan'); ?></span>


                                        </div>

                                        <div class="form-group">

                                            <label class="control-label">No Kontak</label>


                                                 <input type="text" class="form-control" name="nokontak" value="<?=$noKontak;?>">

                                                 <span class="text-danger"> <?php echo form_error('nokontak'); ?></span>


                                        </div>

                                        <div class="form-group">

                                            <label class="control-label">Bio</label>


                                                <textarea class="form-control" rows="3" placeholder="Describe about yourself" name="biografi"><?=$biografi;?></textarea>

                                                <p class="help-block">About yourself in 160 characters or less.</p>


                                        </div>

                                        <div class="form-group">

                                            <label class="control-label">Nama Sekolah</label>


                                                <input type="text" class="form-control" name="namasekolah" value="<?=$namaSekolah;?>">    


                                        </div>

                                        <div class="form-group">

                                            <label class="control-label">Alamat Sekolah</label>


                                                <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>">

                                                <br>


                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->

                                                <button type="reset" class="btn btn-default btn-dark btn-theme-colored">Reset</button>

                                                <button type="submit" class="btn btn-primary btn-dark btn-theme-colored">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                    <!-- <div class="">

                                        <button type="reset" class="btn btn-default">Reset</button>

                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

                                    </div> -->

                                </form>
              <!-- Appointment Form Validation-->
              </div>
              <div class="tab-pane fade" id="photo">
              
              <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/siswa/upload/<?=$oldphoto; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >



                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Photo</h4>

                                                <p class="text-default nm">pilih photo baru untuk merubah photo profilmu !</p>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Photo</label>

                                            <div class="col-sm-9">

                                                <div class="btn-group pr5">

                                                  

                                                   <img id="preview" class="img-circle img-bordered" src="<?=$photo;?>" alt="" width="34px" />

                                                   

                                                </div>

                                                <div class="btn-group">

                                                   

                                                <input type="file" id="file" name="photo" class="btn btn-default" required="true"/>

                                                </div>


                                            </div>

                                        </div>

                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default btn-dark btn-theme-colored">Reset</button>

                                                <button type="submit" class="btn btn-primary btn-dark btn-theme-colored">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                </form>
              <!-- Appointment Form Validation-->
              </div>
              <div class="tab-pane fade" id="email">

                                <!-- form email -->

                                <form class="panel form-horizontal form-bordered" name="form-account" action="<?=base_url()?>index.php/siswa/ubahemailsiswa" method="POST" >

                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Email</h4>

                                                <p class="text-default nm">Masukan email barumu, untuk merubah email yang sekarang digunakan</p>

                                            </div>

                                        </div>



                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Email</label>

                                            <div class="col-sm-5">

                                                <input type="email" class="form-control" name="email" value="" required="true">

                                                <span class="text-danger"> <?php echo form_error('email'); ?></span>



                                            </div>

                                        </div>

                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default btn-dark btn-theme-colored">Reset</button>

                                                <button type="submit" class="btn btn-primary btn-dark btn-theme-colored">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>




                                    </div>

                                </form>

                                <!--/ form email -->

                            </div>

                            <div class="tab-pane" id="password">

                                <!-- form password -->

                                <form class="panel form-horizontal form-bordered" name="form-password" action="<?=base_url()?>index.php/siswa/ubahkatasandi" method="POST">

                                    <div class="panel-body pt0 pb0">

                                        <div class="form-group header bgcolor-default">

                                            <div class="col-md-12">

                                                <h4 class="semibold mt0 mb5">Kata Sandi</h4>

                                                <p class="text-default nm">Ingin merubah password?</p>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Kata Sandi Lama</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="sandilama" required="true">

                                                <p class="help-block"><a href="javascript:void(0);">Forgot password?</a></p>

                                                 <span class="text-danger"> <?php echo form_error('sandilama'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Kata Sandi Baru</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="newpass" required="true">

                                                 <span class="text-danger"> <?php echo form_error('newpass'); ?></span>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-3 control-label">Verifikasi Kata Sandi</label>

                                            <div class="col-sm-5">

                                                <input type="password" class="form-control" name="verifypass" required="true">

                                                 <span class="text-danger"> <?php echo form_error('verifypass'); ?></span>

                                            </div>

                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">

                                                <!-- <input type="text" class="form-control" name="alamatsekolah" value="<?=$alamatSekolah;?>"> -->
                                                <br>
                                                <button type="reset" class="btn btn-default btn-dark btn-theme-colored">Reset</button>

                                                <button type="submit" class="btn btn-primary btn-dark btn-theme-colored">Simpan Perubahan</button>
                                                

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>

            </div>
            </div>
          </div>
        </div>
      </div>
</section>

