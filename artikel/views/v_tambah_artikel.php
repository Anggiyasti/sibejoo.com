<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>
<script src="<?= base_url('assets/plugins/croppie/croppie.js') ?>""></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/croppie/croppie.css') ?>">

<!-- START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
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
                    <?php echo $this->session->flashdata('msg'); ?> 
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
                                <div id="crop-artikel" style="width:900px"></div>
                                <!--/ END Statistic Widget -->
                            </div>
                            <div class="col-sm-12" align="center">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-2">
                        <a href="javascript:void(0)" class="btn btn-primary upload-artikel">Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
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

 // FUNGSI CROP IMAGE
// setting canvas upload cropnya
$uploadCrop = $('#crop-artikel').croppie({
    enableExif: true,
    viewport: {
        width: 700,
        height: 350,
        type: 'square'
    },
    boundary: {
        width: 950,
        height: 500
    },
    enableZoom:true,
    mouseWheelZoom:true,
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

$('.upload-artikel').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
    // simpan team
    save(resp);
    });
});   

function save(img){
    var datas = {
        jdlartikel : $('input[name=jdlartikel]').val(),
        editor1 : htmlspecialchars(CKEDITOR.instances.editor1.getData()),
        foto: $('[name=foto]').val(),
        img:img
    }
    var elementId = "filefoto";
    if (datas.jdlartikel == "" || datas.editor1 == "") {
        swal("Oops!", "Judul dan isi artikel harus diisi!","warning");
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
                    setTimeout(function() {
                            swal({
                                title: "Good job!",
                                text: "Artikel berhasil ditambahkan",
                                type: "success"
                            }, function() {
                                window.location = base_url+"artikel";
                            });
                        }, 1000); 
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