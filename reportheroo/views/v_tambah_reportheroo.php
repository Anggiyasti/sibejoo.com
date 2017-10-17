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
                                <h3 class="panel-title">Form Report Heroo</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                           
           <?php echo $this->session->flashdata('msg'); ?> 
            <div class="panel-body">
                        <br>
                        <div class="">
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <label class="col-sm-2">JUDUL REPORT HEROO</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="jdlreport">
                                            <br>
                            <span id="pesan"></span>
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2">ISI REPORT HEROO</label>
                              <div class="col-sm-10">
                              <input class="form-control" type="text" name="editor1">
                              <br>
                              <span id="pesan"></span>
                              </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-2">KATEGORI</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="kategori" id="kategori">
                                        <option>-Pilih Kategori-</option>
                                </select>
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
                      <a onclick="savereport()" class="btn btn-primary">Simpan</a>
                    </div>
                  </div>
        


        </section>
        <!--/ END Template Main -->


<script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<script type="text/javascript">

 CKEDITOR.replace( 'editor1' );

 var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];  

 function savereport(){
        var datas = {
            jdlreport : $('input[name=jdlreport]').val(),
            editor1 : CKEDITOR.instances.editor1.getData(),
            kategori : $('select[name=kategori]').val(),
            foto: $('[name=foto]').val(),
        }
        //id fileinput
        console.log(datas);
        var elementId = "filefoto";
        if (datas.jdlreport == "" || datas.editor1 == "" || datas.foto == "" || datas.kategori == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"Reportheroo/ajax_add_ReportH";
            // do_upload
            $.ajaxFileUpload({
                url:url,
                data:datas,
                dataType:"TEXT",
                type:"POST",
                fileElementId :elementId,
                success:function(Data){
                    swal({
                    title: "Artikel Berhasil Ditambahkan!",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Selesai",
                    closeOnConfirm: false,
                },
            function(isConfirm){
                    if (isConfirm) {
                        window.location.href = base_url+"Reportheroo";
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

//buat load tingkat
    function loadkategori() {
      jQuery(document).ready(function () {
        var kategori_id = {"kategori_id": $('#kategori').val()};
        var idKategori;
        $.ajax({
          type: "POST",
          dataType: "json",
          data: kategori_id,

          url: "<?= base_url() ?>index.php/reportheroo/getkategori",

          success: function (data) {

            console.log("Data" + data);

            $('#kategori').html('<option value="">-- Pilih Kategori  --</option>');

            $.each(data, function (i, data) {

              $('#kategori').append("<option value='" + data.id_kategori + "'>" + data.nama_kategori + "</option>");

              return idKategori = data.id_kategori;

            });

          }

        });
      })
    }
    ;
    loadkategori();


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










