<?php 

  foreach ($artikel as $row) {
    
     $id_artikel = $row['id_artikel'];
     $judul_artikel = $row['judul_artikel'];
     $isi_artikel = $row['isi_artikel'];
     $gambar=base_url().'assets/image/artikel/'.$row['gambar'];
     $oldphoto=$row['gambar'];
} ;

?> 
<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/library/jquery/js/preview.js') ?>"></script>
<script>
  var Preview = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview");
    this.buffer = document.getElementById("MathBuffer");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
      this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("MathInput").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
       ["Typeset",MathJax.Hub,this.buffer],
       ["PreviewDone",this]
       );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview.callback = MathJax.Callback(["CreatePreview",Preview]);
Preview.callback.autoReset = true;  // make sure it can run more than once

</script> 
<!--END Script priview mathjax form input buat rumus-->
<!-- Script priview mathjax untuk priview soal-->
<script>
  var Preview2 = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  //
  //  Get the preview and buffer DIV's
  //
  Init: function () {
    this.preview = document.getElementById("MathPreview2");
    this.buffer = document.getElementById("MathBuffer2");
  },

  //
  //  Switch the buffer and preview, and display the right one.
  //  (We use visibility:hidden rather than display:none since
  //  the results of running MathJax are more accurate that way.)
  //
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  //
  //  This gets called when a key is pressed in the textarea.
  //  We check if there is already a pending update and clear it if so.
  //  Then set up an update to occur after a small delay (so if more keys
  //    are pressed, the update won't occur until after there has been 
  //    a pause in the typing).
  //  The callback function is set up below, after the Preview object is set up.
  //
  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
      this.timeout = setTimeout(this.callback,this.delay);
  },

  //
  //  Creates the preview and runs MathJax on it.
  //  If MathJax is already trying to render the code, return
  //  If the text hasn't changed, return
  //  Otherwise, indicate that MathJax is running, and start the
  //    typesetting.  After it is done, call PreviewDone.
  //  
  CreatePreview: function () {
    Preview2.timeout = null;
    if (this.mjPending) return;
    var text = CKEDITOR.instances.editor1.getData();
    // console.log(text);
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
        ["Typeset",MathJax.Hub,this.buffer],
        ["PreviewDone",this]
        );
    }
  },

  //
  //  Indicate that MathJax is no longer running,
  //  and swap the buffers to show the results.
  //
  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};

//
//  Cache a callback to the CreatePreview action
//
Preview2.callback = MathJax.Callback(["CreatePreview",Preview2]);
Preview2.callback.autoReset = true;  // make sure it can run more than once

</script>      
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
            <form name="form-account" action="<?=base_url()?>index.php/artikel/gambar_artikel/<?=$id_artikel; ?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data">
             <div class="form-group">
                                        <label class="col-sm-2">Judul Artikel</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="judul artikel" name="judul_artikel" value="<?=$judul_artikel;?>">
                                            <br>
                      <span id="pesan"></span>
                                        </div>
                                    </div>
                                     
                                    <div class="form-group">
                                        <label class="col-sm-2">Isi Artikel</label>
                                        <div class="col-sm-10">
                                           <textarea  name="editor1" class="form-control" id="" value="">
                                <?=$isi_artikel; ?></textarea>
                                            <br>
                                        <span id="pesan"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Gambar Artikel</label>
                                        <div class="col-sm-10">
                                            <img id="preview" class="img-bordered" src="<?=$gambar;?>" alt="" width="700px" height="1050px" />
                                            <div class="input-icon">
                                            <label><p>Gambar tidak boleh lebih dari 2mb (700x467)</p></label>
                                            <input  type="file" id="file" name="photo" class="btn " onchange="ValidateSingleInput(this);" />
                                            <br>

                                            <br>

                                            <div class="one-half-responsive last-column" id="photo">

            <div class="notification notification-danger" id="notif" hidden="true">
            <a class="close-notification no-smoothState"><i class="ion-android-close"></i></a>
            <h4>Silahkan cek type extension gambar!</h4>
            <p>Type yang bisa di upload hanya .jpeg|.gif|.jpg|.png|.bmp</p>
          </div>

          <div class="notification notification-danger" id="size" hidden="true">
            <a class="close-notification no-smoothState"><i class="ion-android-close"></i></a>
            <h4>Silahkan cek ukuran gambar!</h4>
            <p>Ukuran yang bisa di upload maksimal 2mb ! </p>
          </div>

                      <span id="pesan"></span>
                                        </div>
                                    </div>

                                    


                                     <div class="content">

            

                   

                   
                </div>

            </div>
             <button type="submit" class="btn btn-primary">Simpan</button>

             
            </form>
        </div>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>
        


        </section>
        <!--/ END Template Main -->



<script type="text/javascript">

 CKEDITOR.replace( 'editor1' );

 var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    

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



 // Set option Jawaban ###########
          var tampjawaban =  $('#tampjawaban').val();
          if (tampjawaban != '') {
              var tamid ='#opjawaban option[value='+tampjawaban+']';
             $(tamid).attr('selected','selected');
          }else{
          }






</script>










