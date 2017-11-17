<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script><script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>


        <!--/ END Template Sidebar (Left) -->

        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START panel -->
                        <div class="panel panel-default">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Artikel</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                           
           <?php echo $this->session->flashdata('msg'); ?> 
            <!-- <form name="form-account" action="<?=base_url()?>index.php/artikel/insertartikel/1"  method="post" accept-charset="utf-8" enctype="multipart/form-data"> -->
      
             <div class="panel-body">
                        <br>
                        <div class="">
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <label class="col-sm-2">JUDUL ARTIKEL</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="jdlartikel">
                                            <br>
                            <span id="pesan"></span>
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2">ISI ARTIKEL</label>
                              <div class="col-sm-10">
                              <input class="form-control" type="text" name="editor1">
                              <br>
                              <span id="pesan"></span>
                              </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2">FOTO</label>
                            <div class="col-sm-10">
                                <label for="filefoto" class="btn btn-sm btn-default filefoto">
                                    Pilih Gambar
                                </label>
                                <input style="display:none;" type="file" id="filefoto" name="foto" onchange="cek_fileFoto(this,z='');" />
                                <br><br><br>
                              <span id="pesan"></span>
                            </div>
                        </div>



                        <div class="col-sm-10">

                
                <div class="panel-body pb0 pt0 pl0 pr0">
                    <!-- START Statistic Widget -->
                    <div class="table-layout animation delay animating fadeInDown  prv_foto mb0" align="center">
                       <img id="prevfile" class="img-tumbnail logo" src="" alt=""  width="50%"  >
                    </div>
                    <!--/ END Statistic Widget -->
                </div>
                  <div class="col-sm-12" align="center">
                    <div class="col-md-5 left"> 
                      <h6>Name: <span id="namefile"></span></h6> 
                    </div> 
                    <div class="col-md-4 left"> 
                      <h6>Size: <span id="sizefile"></span>Kb</h6> 
                    </div> 
                    <div class="col-md-3 bottom"> 
                      <h6>Type: <span id="typefile"></span></h6> 
                    </div>
                </div>
                </div>


            </div>
                    
                  <div class="panel-footer">
                    <div class="col-md-2">
                      <a onclick="save()" class="btn btn-primary">Simpan</a>
                    </div>
                  </div>



        </section>
                              

        <!--/ END Template Main -->

 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>

<script type="text/javascript">
function htmlspecialchars(str) {
    var map = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        "\"": "&quot;",
        "'": "&#39;" // ' -> &apos; for XML only
    };
    return str.replace(/[&<>"']/g, function(m) { return map[m]; });
}

 CKEDITOR.replace( 'editor1' );

 var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    

   function save(){
        var datas = {
            jdlartikel : $('input[name=jdlartikel]').val(),
            editor1 : htmlspecialchars(CKEDITOR.instances.editor1.getData()),
            foto: $('[name=foto]').val(),
        }
        //id fileinput
        // console.log(datas);
        var elementId = "filefoto";
        if (datas.jdlartikel == "" || datas.editor1 == "" || datas.foto == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"artikel/ajax_add_artikel";
            // do_upload
            $.ajaxFileUpload({
                url:url,
                data:datas,
                dataType:"TEXT",
                type:"POST",
                fileElementId :elementId,
                success:function(Data){
                  console.log(Data);
                    swal({
                    title: "Artikel Berhasil Ditambahkan!",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Selesai",
                    closeOnConfirm: false,
                },
            function(isConfirm){
                    if (isConfirm) {
                        window.location.href = base_url+"artikel/index/1";
                    } 
                    else {
                        swal("Tambah Data dibatalkan");
                    }
                });
                },
                error:function(){
                    
                }
            });

            
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
      if (size>=2100000) {
        swal('Silahkan cek file size Foto!','File size foto maksimal 2MB','warning');
        // $('#e_size_video').modal('show');
      }else{
        $(".prv_foto"+z).show();
        reader.onload = viewer.load;
        reader.readAsDataURL(file);
        viewer.setProperties(file);
      }
  }
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        console.log(sFileName);
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
             $('#notif').show();

                return false;
            }

            file = oInput.files[0];
            if (file.size > 2100000 ) {
               $('#size').show();
               return false;
            } 
            
        }
    }
    return true;
}


function ValidateSingleInput1(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        console.log(sFileName);
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
             $('#notifa').show();

                return false;
            }

            file = oInput.files[0];
            if (file.size > 2100000 ) {
               $('#sizea').show();
               return false;
            } 
            
        }
    }
    return true;
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
 </script>












