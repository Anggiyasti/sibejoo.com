<script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">


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
                    <div class="panel-heading">
                        <h3 class="panel-title">Tambah Data Team</h3>
                        <a href="<?= base_url('index.php/teamback')?>" class="btn btn-default btn-sm pull-right" style="margin-top:-33px;" >Kembali</a>
                    </div>               
                    <div class="panel-body">
                        <br>
                        <div class="">
                            <p class="text-center">IDENTITAS TEAM</p>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nama</label>
                            <div class="col-sm-9 mb10">
                                <input class="form-control" type="text" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Posisi</label>
                            <div class="col-sm-9 mb10">
                                <input class="form-control" type="text" name="posisi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Keterangan</label>
                            <div class="col-sm-9 mb10">
                                <input class="form-control" type="text" name="keterangan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Email</label>
                            <div class="col-sm-9 mb10">
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Instagram</label>
                            <div class="col-sm-9 mb10">
                                <input class="form-control" type="text" name="instagram">
                            </div>
                        </div>
                        <div class="form-group">

                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-3">Foto</label>
                            <div class="col-sm-9">
                                <label for="filefoto" class="btn btn-sm btn-default filefoto">
                                    Pilih Foto
                                </label>
                                <input style="display:none;" type="file" id="filefoto" name="foto" onchange="cek_fileFoto(this,z='');"/>
                            </div>
                        </div>                        
                         <div class="row"></div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-2 pull-right">
                            <a href="javascript:void(0)" class="btn btn-primary upload-save">Simpan</a>
                        </div>
                    </div>

                </div>
                <!--/ Form horizontal layout bordered -->
            </div>

            <!-- untuk preview foto -->
            <div class="col-sm-6">
                <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Preview Foto Team</h3>
                </div>  
                <div class="panel-body pb0 pt0 pl0 pr0">
                    <!-- START Statistic Widget -->
                    <div id="upload-crop" style="width:500px"></div>
                    <!--/ END Statistic Widget -->
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
<script src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>
<!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
 <!-- END Template Main -->
 <script type="text/javascript">
    // simpan team
    function save(img){
        var datas = {
            nama : $('input[name=nama]').val(),
            posisi : $('input[name=posisi]').val(),
            keterangan:$('input[name=keterangan]').val(),
            email:$('input[name=email]').val(),
            instagram:$('input[name=instagram]').val(),
            foto: $('[name=foto]').val(),
            crop:img
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
                url = base_url+"teamback/ajax_add_team";
                // do_upload
                $.ajaxFileUpload({
                    url:url,
                    data:datas,
                    dataType:"TEXT",
                    type:"POST",
                    fileElementId :elementId,
                    success:function(Data){
                        setTimeout(function() {
                            swal({
                                title: "Good job!",
                                text: "Team berhasil ditambahkan",
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
        // $('#e_size_video').modal('show');
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
});

$('.upload-save').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
    // simpan team
    save(resp);
    });
});
 </script>
