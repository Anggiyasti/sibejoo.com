<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>
     
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
                              <input type="text" name="id" value="<?= $RH['id_art'] ?>" hidden>
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
                                <input class="form-control" type="text" name="jdlreport" value="<?= $RH['judul_art_katagori'] ?>"  data-parsley-required required>
                                            <br>
                            <span id="pesan"></span>
                            </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2">ISI REPORT HEROO</label>
                              <div class="col-sm-10">
                              <textarea  name="editor1" class="form-control" id="" value=""  data-parsley-required required>
                                <?= $RH['isi_art_kategori'] ?></textarea>
                              <br>
                              <span id="pesan"></span>
                              </div>
                        </div>

                        <div class="form-group">
                              <label class="col-sm-2">KATEGORI</label>
                              <div class="col-sm-10">
                                <input name="kategori" type="text" id="oldtkt" value="<?= $RH['kategori'] ?>" hidden="true">
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
                                <input style="display:none;" type="file" id="filefoto" name="foto" onchange="cek_fileFoto(this,z='');"  data-parsley-required required/>
                                <br><br><br>
                              <span id="pesan"></span>
                            </div>
                        </div>

                      <div class="col-sm-10">                
                        <div class="panel-body pb0 pt0 pl0 pr0">
                        <!-- START Statistic Widget -->
                      <?php if ($RH['gambar'] != '' ) : ?>
                                <?php $filefoto=base_url().'assets/image/reportheroo/'.$RH['gambar']; ?>
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown  prv_foto mb0" align="center">
                                    <img id="prevfile" class="img-tumbnail logo" src="<?=$filefoto;?>" width="50%">
                                </div>
                                <!--/ END Statistic Widget -->
                            <?php else : ?>
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown  prv_logo mb0" align="center">
                                     <img id="prevfile" class="img-tumbnail logo" src="<?=base_url()?>assets\image\avatar\default.png" width="50%"  >
                                </div>
                                <!--/ END Statistic Widget -->
                            <?php endif ?>
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


                    <div class="panel-footer">
                      <div class="col-md-2">
                        <button onclick="updateReport()" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                      </div>
                    </div>

                    </div>
        </div>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>
        


        </section>
        <!--/ END Template Main -->


<script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<script type="text/javascript">

 CKEDITOR.replace( 'editor1' );

 var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    


function updateReport(){
        var datas = {
            id : $('input[name=id]').val(),
            jdlreport : $('input[name=jdlreport]').val(),
            editor1 : CKEDITOR.instances.editor1.getData(),
            kategori : $('select[name=kategori]').val(),
            foto: $('[name=foto]').val()
        }
        //id fileinput
        var elementId = "filefoto";
        if (datas.jdlartikel == "" || datas.editor1 == "" || datas.kategori == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"reportheroo/ajax_update_reportH";
            // do_upload
            $.ajaxFileUpload({
                url:url,
                data:datas,
                dataType:"TEXT",
                type:"POST",
                fileElementId :elementId,
                success:function(Data){
                    swal({
                    title: "Report Heroo Berhasil di Ubah!",
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
                        swal("Ubah Data dibatalkan");
                    }
                });
                },
                error:function(){
                    
                }
        });

        }
    }

  // Set option Jawaban ###########
  var tampjawaban =  $('#tampjawaban').val();
  if (tampjawaban != '') {
    var tamid ='#opjawaban option[value='+tampjawaban+']';
    $(tamid).attr('selected','selected');
  }else{
  }

    //buat load kategori
    function loadLKategori() {
      jQuery(document).ready(function () {
        var oldtkt = $('#oldtkt').val();
        var kategori_id = {"kategori_id": $('#kategori').val()};
        var idKategori;
        $.ajax({
          type: "POST",
          dataType: "json",
          data: kategori_id,

          url: "<?= base_url() ?>index.php/artikel/getkategori",

          success: function (data) {
            $('#kategori').html('<option value="">-- Pilih kategori  --</option>');

            $.each(data, function (i, data) {
            if (data.id_kategori==oldtkt) {
               $('#kategori').append("<option value='" + data.id_kategori + "' selected>" + data.nama_kategori + "</option>");
             } else {
              $('#kategori').append("<option value='" + data.id_kategori + "'>" + data.nama_kategori + "</option>");
          }

              return idKategori = data.id_kategori;

            });

          }

        });


        $('#kategori').change(function () {
          kategori_id = {"kategori_ids": $('#kategori').val()};
        })

        
      })
    }
    ;
    loadLKategori();


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