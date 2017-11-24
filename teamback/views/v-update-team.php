<script src="<?= base_url('assets/plugins/croppie/croppie.js') ?>""></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/croppie/croppie.css') ?>">
<!-- START Template Main  -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- START row -->
        <div class="row">
            <div class="col-md-6">
                <?php if ($this->session->flashdata('notif') != '') {
                    ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.
                    </div>
                <?php }; ?>
                <!-- Form horizontal layout bordered -->
                <div class="panel panel-danger">
                    <input type="text" name="id" value="<?= $team['id'] ?>" hidden>
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Team</h3>
                        <a href="<?= base_url('index.php/teamback')?>" class="btn btn-default btn-sm pull-right"style="margin-top:-33px;" >Kembali</a>
                    </div>               
                    <div class="panel-body">
                        <br>
                        <div class="">
                            <p class="text-center">IDENTITAS TEAM</p>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama</label>
                            <div class="col-sm-10 mb10">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="true" value="<?= $team['nama'] ?>">
                                <span class="text-danger"> <?php echo form_error('nama'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Posisi</label>
                            <div class="col-sm-10 mb10">
                                <input type="text" class="form-control" placeholder="Posisi" name="posisi" value="<?= $team['posisi'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('posisi'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Keterangan</label>
                            <div class="col-sm-10 mb10">
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="<?= $team['keterangan'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('keterangan'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Email</label>
                            <div class="col-sm-10 mb10">
                                <input class="form-control" type="email" name="email" value="<?= $team['email'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Instagram</label>
                            <div class="col-sm-10 mb10">
                                <input class="form-control" type="text" name="instagram" value="<?= $team['instagram'] ?>">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-sm-2">Foto</label>
                            <div class="col-sm-10">
                                <label for="filefoto" class="btn btn-sm btn-default filefoto">
                                    Pilih Foto
                                </label>
                                <input style="display:none;" type="file" id="filefoto" name="foto" onchange="cek_fileFoto(this,z='');"/>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <a href="javascript:void(0)" class="btn btn-primary upload-update">Simpan Perubahan</a>
                        </div>
                    </div>

                </div>
                <!--/ Form horizontal layout bordered -->
            </div>
                    <!-- preview foto -->
                    <div class="col-sm-6">
                        <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Preview Foto Team</h3>
                        </div>  
                        <div class="panel-body pb0 pt0 pl0 pr0">
                            <div id="upload-crop" style="width:500px" hidden="true"></div>
                            <?php if ($team['foto'] != '' ) : ?>
                                <?php $filefoto=base_url().'assets/image/team/'.$team['foto']; ?>
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown  prv_foto mb0">
                                    <div class="col-xs-4 panel bgcolor-danger text-center">
                                        <img id="prevfile" class="img-tumbnail logo" src="<?=$filefoto;?>" width="50%"  >
                                    </div>
                                </div>
                                <!--/ END Statistic Widget -->
                            <?php else : ?>
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown  prv_foto mb0">
                                    <div class="col-xs-4 panel bgcolor-danger text-center">
                                        <img id="prevfile" class="img-tumbnail logo" src="<?=base_url()?>assets\image\avatar\default.png" width="50%"  >
                                    </div>
                                </div>
                                <!--/ END Statistic Widget -->
                            <?php endif ?>
                        </div>
                        <div class="panel-footer pb0 pt0 pl0 pr0">
                            
                        </div>
                        </div>                      
                    </div>
                    <!-- end preview foto -->

        </div>
        <!--/ END row -->
    </div>
</section>
 <!-- END Template Main -->
 <script src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>
 <!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>

 <script type="text/javascript">
    function update(img){
        var datas = {
            id : $('input[name=id]').val(),
            nama : $('input[name=nama]').val(),
            posisi : $('input[name=posisi]').val(),
            keterangan:$('input[name=keterangan]').val(),
            email:$('input[name=email]').val(),
            instagram:$('input[name=instagram]').val(),
            foto: $('[name=foto]').val(),
            img:img
        }

        //id fileinput
        var elementId = "filefoto";
        if (datas.nama == "" || datas.posisi == "") {
            swal('Nama dan posisi harus diisi');
        }else{
            // cek dulu inputan emailnya
            // jika bukan email masuk kesini
            if (!datas.email.match(/\S+@\S+\.\S+/)) {
                swal("Oops", "Email tidak sesuai!", "info");
            } else {
                url = base_url+"teamback/ajax_update_team";
                // do_upload
                $.ajaxFileUpload({
                    url:url,
                    data:datas,
                    dataType:"TEXT",
                    type:"POST",
                    fileElementId :elementId,
                    success:function(data){
                        setTimeout(function() {
                            swal({
                                title: "Good job!",
                                text: "Team berhasil diubah",
                                type: "success"
                            }, function() {
                                window.location = base_url+"teamback";
                            });
                        }, 1000); 
                    },
                    error:function(){
                        
                    }
                });
            }

        }
    }

     // show preview foto
  function preview_fileFoto(oInput,z='') {
    var viewer = {
          load : function(e){
              $('#prevfile'+z).attr('src', e.target.result);
          },
          setProperties : function(file){
              $('#namefile'+z).text(file.name);
              $('#typefile'+z).text(file.type);
              $('#sizefile'+z).text(Math.round(file.size/1024));
          },
        }

      var file = oInput.files[0];
      var reader = new FileReader();
      var size=Math.round(file.size/1024);
      // start pengecekan ukuran file
      if (size>=500) {
        swal('Silahkan cek file size Foto!','File size foto maksimal 500kb','warning');
      }else{
        $(".prv_foto"+z).show();
        reader.onload = viewer.load;
        reader.readAsDataURL(file);
        viewer.setProperties(file);
      }
  }

  //cek dulu type filenya
  function cek_fileFoto(oInput,z='') {
    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                swal('Silahkan cek type extension gambar! ', 'Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png', 'warning');
                return false;
        }else{
            preview_fileFoto(oInput,z='');
        }
      }
    }
          return true;
  }

  // FUNGSI CROP IMAGE
// setting canvas upload cropnya
$uploadCrop = $('#upload-crop').croppie({
    enableExif: true,
    viewport: {
        width: 350,
        height: 350,
    },
    boundary: {
        width: 450,
        height: 450
    }
});

$('#filefoto').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
        });
        
    }
    reader.readAsDataURL(this.files[0]);
    $('.prv_foto').hide();
    $('#upload-crop').show();
});

$('.upload-update').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
    // update team
    update(resp);
    });
});
 </script>
