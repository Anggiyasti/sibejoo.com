<!-- konten -->
<section id="main" role="main" class="mt10">
    <!-- js untuk progres bar file yg di upload -->
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/upbar.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/library/jquery/js/jequery.form.js') ?>"></script>

    <div class="col-md-12">

        <!-- START Form panel -->

        <form  class="panel panel-teal form-horizontal form-bordered" action="javascript:void(0)" method="post" accept-charset="utf-8" enctype="multipart/form-data">

            <div class="panel-heading"><h5 class="panel-title">Form Update Video</h5>
                                        <!-- Start old info data video -->
                        <input type="text" id="oldtkt" value="<?=$infovideo['id_tingkat'];?>" hidden="true">
                        <input type="text"  id="oldmp"  value="<?=$infovideo['id_mp'];?>" hidden="true">
                        <input type="text" id="oldbab"  value="<?=$infovideo['id_bab'];?>" hidden="true">
                        <input type="text" id="oldsub"  value="<?=$infovideo['id_subbab'];?>" hidden="true">
                        <input type="text" name="pilihan" value="<?=$video['namaFile'];?>" hidden>
                        <!-- END old info data soal -->
            <input type="text" name="UUID" value="<?=$video['UUID']?>" hidden="true" >

            </div>



            <div  class="form-group">

                <label class="col-sm-1 control-label">Tingkat</label>

                <div class="col-sm-4">

                    <select class="form-control" name="tingkat" id="tingkat">

                        <option>-Pilih Tingkat-</option>



                    </select>

                </div>



                <label class="col-sm-2 control-label">Mata Pelajaran</label>

                <div class="col-sm-4">

                    <select class="form-control" name="mataPelajaran" id="pelajaran">



                    </select>

                </div>

            </div>



            <div class="form-group">

                <label class="col-sm-1 control-label">Bab</label>

                <div class="col-sm-4">

                    <select class="form-control" name="bab" id="bab">



                    </select>

                </div>



                <label class="col-sm-2 control-label">Subab</label>

                <div class="col-sm-4">

                    <select class="form-control" name="subBab" id="subbab">



                    </select>

                     <span class="text-danger"><?php echo form_error('subBab'); ?></span>

                </div>

            </div>



            <!-- pilih option upload video -->

            <div class="form-group">

            <label class="control-label col-sm-2">Pilihan Upload Video</label>

              <div class="col-sm-8">

                <div class="btn-group" data-toggle="buttons" >

                  <label class="btn btn-teal btn-outline" id="up_server">

                    <input type="radio" name="option_up" value="server" autocomplete="off" id="radio_server"> Upload Video Ke server

                  </label>

                  <label class="btn btn-teal btn-outline " id="up_link">

                    <input type="radio" name="option_up"  value="link" autocomplete="off" id="radio_link"> Link

                  </label>

                </div>

              </div>

            </div>



            <!-- untuk preview video -->

            <div  class="form-group server prv_video" hidden="true">

                <div class="row" style="margin:1%;"> 

                    <div class="col-md-12">

                        <video id="preview" class="img-tumbnail image " src="<?=base_url();?>assets/video/<?=$video['namaFile'];?>" width="100%" height="50%" controls >

                            

                        </video>

                    </div>

                    <div class="col-md-5 left"> 

                        <h6>Name: <span id="filename"></span></h6> 

                    </div> 

                    <div class="col-md-4 left"> 

                        <h6>Size: <span id="filesize"></span>Kb</h6> 

                    </div> 

                    <div class="col-md-3 bottom"> 

                        <h6>Type: <span id="filetype"></span></h6> 

                    </div>

                </div>

            </div>



<!--             <div class="form-group server" hidden="true">

                <div class="col-md-11 bottom">		

                    <progress id="prog" max="100" value="0" style="display:none;"></progress>

                </div>

            </div> -->



            <!-- upload ke server -->

            <div id="upload" class="form-group server" hidden="true">

                <label class="col-sm-2 control-label">File Video</label>

                <div class="col-sm-4">



                    <label for="file" class="btn btn-sm btn-default">

                        Pilih Video

                    </label>

                    <input style="display:none;" type="file" id="file" name="video" onchange="ValidateSingleInput(this);"/>

                    <!-- <span class="col-sm-12 text-danger"><?php echo form_error('video'); ?></span> -->

                </div>

            </div>
        <!-- prev thumbnail -->
        <div  class="form-group prv_thumbnail" >
            <div class="row" style="margin:1%;"> 
                <div class="col-md-12">
                    <img id="prevthumbnail" class="img-tumbnail image" src="<?=base_url();?>assets/image/thumbnail/<?=$video['thumbnail'];?>" width="25%"  >
                </div>
                <div class="col-md-5 left"> 
                    <h6>Name: <span id="namethumbnail"></span></h6> 
                </div> 
                <div class="col-md-4 left"> 
                    <h6>Size: <span id="sizethumbnail"></span>Kb</h6> 
                </div> 
                <div class="col-md-3 bottom"> 
                    <h6>Type: <span id="typethumbnail"></span></h6> 
                </div>
            </div>
        </div>
        <!--/ prev thumbnail -->
        <!-- Upload thumbnail -->
        <div class="form-group server">
           <label class="col-sm-2 control-label">Thumbnail</label>
            <div class="col-sm-4">
                <label for="thumbnail" class="btn btn-sm btn-default">
                    Pilih gambar
                </label>
                <input style="display:none;" type="file" id="thumbnail" name="thumbnail" onchange="ValidateInputThumbnail(this);"/>
            </div>
        </div>
         <!-- /Upload thumbnail -->
         <div class="form-group link2" hidden="true"></div>

            <!-- upload video by link -->
            <div class="form-group link" >

              <label class="col-sm-2 control-label">Link Video</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" value="<?=$video['link']?>" name="link_video">

              </div>

            </div>



            <div class="form-group">

                <label class="col-sm-2 control-label">Judul Video</label>

                <div class="col-sm-9">

                    <input type="text" name="judulvideo" value="<?=$video['judulVideo']?>" class="form-control">

                     <span class="text-danger"><?php echo form_error('judulvideo'); ?></span>

                </div>



            </div>



            <div class="form-group">

                <label class="col-sm-2 control-label">Deskripsi Video</label>

                <div class="col-sm-9">

                    <textarea class="form-control" name="deskripsi"><?=$video['deskripsi']?></textarea>

                </div>

            </div>



            <div class="form-group">

                <label class="control-label col-sm-2">Publish</label>

                <div class="col-sm-4">
                <input type="text" value="<?=$video['published']?>" id="tamp-publish" hidden="true">
                    <select name="publish" class="form-control">


                        <option value="0" id="pub0">Tidak</option>

                        <option value="1" id="pub1">Ya</option>

                    </select>

                </div>

            </div>



            <div class="panel-footer">

                <button type="submit" class="btn btn-primary" data-style="zoom-in" onclick="updateData()"><span class="ladda-label">Simpan</span></button>

            </div>



        </form>

        <!--/ END Form panel -->

    </div>





</section>

<!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<!-- /Script ajax upload -->



            <script>

                // Script for getting the dynamic values from database using jQuery and AJAX

                $(document).ready(function () {
                    // set option pilihan jenis video
                    set_pilihan();
                   // set opton dropdown mp
                      loadPelajaran($('#oldtkt').val());
                    // #########################

                    // set option dropdown bab
                      load_bab($('#oldmp').val());
                    // ##################
                    // set optopn dropdown sub
                    load_sub_bab($('#oldbab').val());
                    // ###############    
                      // Set option Jawaban ###########
                     var tamppublish=$('#tamp-publish').val();
                     if (tamppublish ==1) {
                       $('#pub1').attr('selected','selected');
                       }else{
                        $('#pub0').attr('selected','selected');
                       }

                      // ######################################

                    $('#eTingkat').change(function () {
                        var form_data = {

                            name: $('#eTingkat').val()

                        };



                        $.ajax({

                            url: "<?php echo site_url('videoback/getPelajaran'); ?>",

                            type: 'POST',
                            dataType: "json",
                            data: form_data,

                            success: function (msg) {

                                var sc = '';

                                $.each(msg, function (key, val) {

                                    sc += '<option value="' + val.id + '">' + val.keterangan + '</option>';

                                });

                                $("#ePelajaran option").remove();

                                $("#ePelajaran").append(sc);

                            }

                        });

                    });

                      // Strat  event untuk pilihan jenis input  

                    $("#up_server").click(function(){

                        $(".server").show();

                        $(".link").hide();
                        $(".prv_thumbnail").show();


                    });

                    $("#up_link").click(function(){

                        $(".link").show();

                        $(".server").hide();

                        $(".prv_video").hide(); 
                        $(".prv_thumbnail").hide();

                    });

                    $("#file").click(function(){

                       $(".prv_video").show();

                    });
                    $("#thumbnail").click(function () {

                        $(".prv_thumbnail").show();

                    });



                });


                //buat load tingkat

                function loadTingkat() {

                    jQuery(document).ready(function () {
                        var oldtkt = $('#oldtkt').val();
                        var tingkat_id = {"tingkat_id": $('#tingkat').val()};

                        var idTingkat;

                        $.ajax({

                            type: "POST",
                            dataType: "json",
                            data: tingkat_id,

                            url: "<?= base_url() ?>index.php/videoback/getTingkat",

                            success: function (data) {

                                console.log("Data" + data);

                                $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');

                                $.each(data, function (i, data) {

                                 if (data.id==oldtkt) {
                                   $('#tingkat').append("<option value='" + data.id + "' selected>" + data.aliasTingkat + "</option>");
                               } else {
                                $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
                            }

                            return idTingkat = data.id;

                        });

                            }

                        });



                        $('#tingkat').change(function () {

                            tingkat_id = {"tingkat_id": $('#tingkat').val()};

                            loadPelajaran($('#tingkat').val());

                        })



                        $('#pelajaran').change(function () {

                            pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};

                            load_bab($('#pelajaran').val());

                        })



                        $('#bab').change(function () {

                            load_sub_bab($('#bab').val());

                        })

                    })

                }

                ;



                //buat load pelajaran

                function loadPelajaran(tingkatID) {
                    var oldmp = $('#oldmp').val();
                    $.ajax({

                        type: "POST",
                        dataType: "json",
                        data: tingkatID.tingkat_id,

                        url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,

                        success: function (data) {

                            $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');

                            $.each(data, function (i, data) {

                                if (data.id == oldmp ) {
                                  $('#pelajaran').append("<option value='" + data.id + "' selected>" + data.keterangan + "</option>");
                              } else {
                                  $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
                              }

                          });

                        }

                    });

                }

                //buat load bab

                function load_bab(mapelID) {
                    var oldbab = $('#oldbab').val();
                    $.ajax({

                        type: "POST",
                        dataType: "json",
                        data: mapelID.mapel_id,

                        url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,

                        success: function (data) {
                            $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');
                            $.each(data, function (i, data) {

                             if (data.id==oldbab) {
                                 $('#bab').append("<option value='" + data.id + "' selected>" + data.judulBab + "</option>");
                             } else {
                                 $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
                             }
                             

                         });

                        }



                    });

                }

                //load sub bab

                function load_sub_bab(babID) {
                    var oldsub = $('#oldsub').val();
                    $.ajax({

                        type: "POST",
                        dataType: "json",
                        data: babID.bab_id,

                        url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,

                        success: function (data) {

                            $('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');
                            $.each(data, function (i, data) {

                              if (data.id==oldsub) {
                               $('#subbab').append("<option value='" + data.id + "' selected>" + data.judulSubBab + "</option>");
                           } else {
                               $('#subbab').append("<option value='" + data.id + "' >" + data.judulSubBab + "</option>");
                           }
                       });

                        }



                    });

                }

                loadTingkat();

            </script>


<!-- start script js validation extension -->
<script type="text/javascript">
 var _validFileExtensions = [".mp4"];    
function ValidateSingleInput(oInput) {
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
                swal('Silahkan cek type extension video! ', 'Type yang bisa di upload hanya .mp4', 'warning');
                // resetVideo();
                return false;
            } else {
                fileVideo(oInput,z='');
            }
        }
    }
    return true;
}
    // show preview video
  function fileVideo(oInput,z='') {
    var viewer = {
        load : function(e){
          $('#preview'+z).attr('src', e.target.result);
        },
        setProperties : function(file){
          $('#filename'+z).text(file.name);
          $('#filetype'+z).text(file.type);
          $('#filesize'+z).text(Math.round(file.size/1024));
        },
      }

    var file = oInput.files[0];
    var reader = new FileReader();
    var size=Math.round(file.size/1024);
     if (size>=90000) {
        swal('Silahkan cek file size video!', 'File size video maksimal 90Mb', 'warning');
      }else{
        $(".prv_video"+z).show();
        reader.onload = viewer.load;
        reader.readAsDataURL(file);
        viewer.setProperties(file);
      }
  }

  //cek dulu type file thumbnail
  function ValidateInputThumbnail(oInput,z='') {
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
                swal('Silahkan cek type extension thumbnail! ', 'Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png', 'warning');
                return false;
        }else{
            fileThumbnail(oInput,z='');
        }
      }
    }
          return true;
  }

  // show preview Thumbnail
  function fileThumbnail(oInput,z='') {
    var viewer = {
          load : function(e){
              $('#prevthumbnail'+z).attr('src', e.target.result);
          },
          setProperties : function(file){
              $('#namethumbnail'+z).text(file.name);
              $('#typethumbnail'+z).text(file.type);
              $('#sizethumbnail'+z).text(Math.round(file.size/1024));
          },
        }

      var file = oInput.files[0];
      var reader = new FileReader();
      var size=Math.round(file.size/1024);
      // start pengecekan ukuran file
      if (size>=100) {
        swal('Silahkan cek file size thumbnail!', 'File size thumbnail maksimal 100 Kb', 'warning');
      }else{
        $(".prv_thumbnail"+z).show();
        reader.onload = viewer.load;
        reader.readAsDataURL(file);
        viewer.setProperties(file);
      }
  }

function resetVideo(){
      $("input[name=video]").val("");
      $('#previewAudio').attr('src', "");
      $('#filename').text("");
      $('#filetype').text("");
      $('#filesize').text("");
  }

    //update data thumbnail
    function updateThumbnail(y='') {
      var tumbnail = 'tumbnail'+y;
      var UUID =$('[name=UUID'+y+']').val();
      var datas = {tumbnail:tumbnail, UUID:UUID};
      var url = base_url+"index.php/videoback/chThumbnail";
      var filethumbnail = "thumbnail"+y;
      $.ajaxFileUpload({
        url : url,
        type: "POST",
        data: {UUID:UUID},
        fileElementId :filethumbnail,
        dataType: "TEXT", 
        success: function(data)
        {
        
          setTimeout(function() {
                swal({
                    title: "Wow!",
                    text: "Video Berhasil Terupdate!",
                    type: "success"
                }, function() {
                    window.location = base_url+"videoback/daftarvideo";
                });
            }, 1000);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          sweetAlert("Oops...", "Data gagal tersimpan!", "error");
        }
      });
    }

    //post data form
    function updateData(y='') {
      var subBab =$('[name=subBab'+y+']').val();
      var option_up = $('[name=option_up'+y+']:checked').val();
      var video ='video'+y;
      var link_video =$('[name=link_video'+y+']').val();
      var jenis_video =$('[name=jenis_video'+y+']').val();
      var judulvideo =$('[name=judulvideo'+y+']').val();
      var deskripsi =$('[name=deskripsi'+y+']').val();
      var publish =$('[name=publish'+y+']').val();
      var UUID =$('[name=UUID'+y+']').val();

      var datas = {
            subBab:subBab,
            option_up:option_up,
            video:video,
            link_video:link_video,
            jenis_video:jenis_video,
            judulvideo:judulvideo,
            deskripsi:deskripsi,
            publish:publish,
            UUID:UUID
      };

      var url = base_url+"index.php/videoback/cek_option_update";
      var filevideo = "file"+y;
      var bar = $('.prog'+y);
      $('.F'+y).attr("hidden","true");
      $('.indiF'+y).addClass('show');
      $.ajaxFileUpload({
        url : url,
        type: "POST",
        data: datas,
        fileElementId :filevideo,
        dataType: "TEXT",
        onChange: function()
        {
        },
            uploadProgress: function ( event, position, total,percentComplete)         {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);

        },
        success: function(data)
        {
            var percentVal = '100%';
            bar.width(percentVal);
            updateThumbnail(y);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          sweetAlert("Oops...", "Data gagal tersimpan!", "error");
        }
      });
    }

    // set pilihan video ################
    // set pilihan video ################
    function set_pilihan() {
        pil=$('input[name=pilihan]').val();
        if (pil!='') {
            // hide input pilihan E
            $("#up_server").addClass('active');
            $("#radio_server").attr('checked',true);
            $(".server").show();
            $(".link").hide();
        }else{
            $("#up_link").addClass('active');
            $("#radio_link").attr('checked',true);
            $(".link").show();
            $(".server").hide();
            $(".prv_video").hide(); 
            $(".prv_thumbnail").hide();
        }
    }

</script>
<!-- END -->
