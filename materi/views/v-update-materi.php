<!-- Start Script Matjax -->
<script type="text/x-mathjax-config">
 MathJax.Hub.Config({
 showProcessingMessages: false,
 tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
});
</script>
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
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

<section class="" id="main" role="main"">
	<div class="container-fluid">
		<!-- Start row -->
		<div class="row">
			
			<div class="col-md-12">
				<!-- Start Panel -->
				<form class="form-horizontal form-bordered  panel panel-teal" action="javascript:void(0)" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<!-- Start HEading Panel -->
					<div class="panel-heading">
						<h3 class="panel-title">Form Update Materi</h3>
						<input type="text" name="UUID" value="<?=$singleMateri['UUID']?>" hidden="true">
						  <!-- Start old info data materi -->
                        <input type="text" id="oldtkt" value="<?=$infomateri['id_tingkat'];?>" hidden="true">
                        <input type="text"  id="oldmp"  value="<?=$infomateri['id_mp'];?>" hidden="true">
                        <input type="text" id="oldbab"  value="<?=$infomateri['id_bab'];?>" hidden="true">
                        <input type="text" id="oldsub"  value="<?=$infomateri['id_subbab'];?>" hidden="true">
                        <input type="text" id="oldpub"  value="<?=$singleMateri['publish']?>" hidden="true">
                        <!-- END old info data materi -->
					</div>
					<!-- End Panel Heading -->

					<!-- Start Pnel Body -->
					<div class="panel-body">
						<!-- Start Dropd Down depeden -->
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
								<select class="form-control" name="subBabID" id="subbab" required="">

								</select>
								<span class="text-danger"><?php echo form_error('subBab'); ?></span>
							</div>
						</div>
						<!-- END Drop Down depeden -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Judul Materi</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="judul" required="" value="<?=$singleMateri['judulMateri']?>" >
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Jenis Upload</label>
							<div class="col-sm-8">
                               <?php if ($singleMateri['url_file'] == NULL): ?>
                                <div class="btn-group" data-toggle="buttons" >
                                    <label class="btn btn-teal btn-outline active " id="in-text">
                                        <input type="radio" autocomplete="off" name="opupload" value="text" checked="true"> Text 
                                    </label>
                                    <label class="btn btn-teal btn-outline" id="in-upload">
                                        <input type="radio" name="opupload" value="file" autocomplete="off"> File
                                    </label>
                                </div>
                                   
                              <?php else: ?>
								<div class="btn-group" data-toggle="buttons" >
									<label class="btn btn-teal btn-outline" id="in-text">
										<input type="radio" autocomplete="off" name="opupload" value="text" > Text 
									</label>
									<label class="btn btn-teal btn-outline active" id="in-upload">
										<input type="radio" name="opupload" value="file" autocomplete="off" checked="true"> File
									</label>
								</div>
                            <?php endif ?>
							</div>
						</div>

						<!-- Start field input materi -->
						<div class="form-group"  id="jenis-editor">
							<label class="control-label col-sm-2">Jenis Editor</label>
							<div class="col-sm-8">
								<div class="btn-group" data-toggle="buttons" >
									<label class="btn btn-teal btn-outline active " id="in-materi">
										<input type="radio" autocomplete="off" checked="true"> Input Materi
									</label>
									<label class="btn btn-teal btn-outline" id="pr-rumus">
										<input type="radio"   autocomplete="off"> Rumus Matematika
									</label>
								</div>
							</div>
						</div>


						<div id="uploadMateri">
						<div class="form-group">
    						<label class="control-label col-sm-2">File Materi Lama</label>
    						<div class="col-sm-8 " >                                            
        						<div class="col-md-5 left"> 
        							<h6><span id="filename" ><?=$singleMateri['url_file'];?></span></h6> 
    							</div> 
    							<br>
        						
                                <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" value="<?=$singleMateri['url_file']?>" />
    						</div>
                            <div class="col-sm-8 " style="margin-left: 18%;">   
                                <a href="<?= base_url('assets/file_materi/'.$singleMateri['url_file'])?>" class="btn btn-sm btn-default" target="_blank" >Download</a>
                              
                            </div>
						</div>

						
						<div class="form-group">
    						<label class="control-label col-sm-2">File Matei Baru</label>
    						<div class="col-sm-8 " >                                            
        						<div class="col-sm-12">
            						<div class="col-md-5 left"> 
                						<h6>Name: <span id="filenameSoal"></span></h6> 
            						</div> 
            						<div class="col-md-4 left"> 
                						<h6>Size: <span id="filesizeSoal"></span>Kb</h6> 
            						</div> 
            						<div class="col-md-3 bottom"> 
                						<h6>Type: <span id="filetypeSoal"></span></h6> 
            						</div>
        						</div>

        						<div class="col-sm-12">
            						<label for="fileSoal" class="btn btn-sm btn-default">
                					Pilih File
           						</label>
            						<input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
        						</div>



    						</div>
						</div>
						</div>

						<div id="textmateri">
						<div class="form-group">
							<!-- Start Editor Soal -->
							<div id="editor-soal">
								<label class="control-label col-sm-2">Materi</label>
								<div class="col-sm-10">
									<textarea   name="editor1" class="form-control" id="" >

									<?=$singleMateri['isiMateri']?>

									</textarea>
								</div>
							</div>
							<!-- End Editor Soal -->
							<!-- Start Math jax -->
							<div id="editor-rumus" hidden="true">
								<label class="control-label col-sm-2">Buat rumus</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="MathInput" cols="60" rows="10" onkeyup="Preview.Update()" >
									</textarea>
								</div>
								<label class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<p>
										Configured delimiters:
										<ul>
											<li>TeX, inline mode: <code>\(...\)</code> or <code>$...$</code></li>
											<li>TeX, display mode: <code>\[...\]</code> or <code> $$...$$</code></li>
											<li>Asciimath: <code>`...`</code>.</li>
										</ul>
									</p>
								</div>
								<label class="control-label col-sm-2"></label>
								<div class="col-sm-10">
									<label class="control-label" >Preview is shown here:</label>
									<div class="form-control" id="MathPreview" ></div>
									<div class="form-control" id="MathBuffer" style=" 
									visibility:hidden; position:absolute; top:0; left: 0"></div>
								</div>
							</div>
							<script>
								Preview.Init();
							</script>
							<!-- End MathJax -->
						</div>
						<!-- END  field input materi -->
						</div>

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="checkbox custom-checkbox">  
									<input type="checkbox" name="stpublish" id="giftcheckbox" value="1">  
									<label for="giftcheckbox" >&nbsp;&nbsp;Publish</label>   
								</div>
							</div>
						</div>

					</div>
					<!-- End Panel Body -->
					
					<!-- Start Penl Footer -->
					<div class="panel-footer">
						<div class="col-sm-7">
							<button type="submit" class="btn btn-primary" onclick="ubahmateri()">Simpan Perubahan</button>
						</div>
					</div>
					<!-- End Panel Footer -->
				</form>
				<!-- End Pnel -->
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
	// Replace the <textarea id="editor1"> with a CKEditor
   // instance, using default configuration.

   CKEDITOR.replace( 'editor1' );


    // Script for getting the dynamic values from database using jQuery and AJAX
   
    // var materi = CKEDITOR
    var opupload = $('input[name=opupload]:checked').val();
    if (opupload == 'text') {
        $("#textmateri").show();
            $("#uploadMateri").hide();
            $("#jenis-editor").show();

    }else{
        $("#uploadMateri").show();
            $("#textmateri").hide();
            $("#jenis-editor").hide();
    }

    $(document).ready(function () {
    	//set opton dropdown mp
              loadPelajaran($('#oldtkt').val());
            // #########################

            // set option dropdown bab
              load_bab($('#oldmp').val());
            // ##################
            // set optopn dropdown sub
            load_sub_bab($('#oldbab').val());
            // ###############
            //set pub
            var oldpub=$('#oldpub').val();
          
            //
    	// Start event untuk jenis editor
    	$("#in-materi").click(function(){
    		$("#editor-soal").show();
    		$("#editor-rumus").hide();
    	});

    	$("#pr-rumus").click(function(){
    		$("#editor-rumus").show();
    		$("#editor-soal").hide();
    	});

    	// $("#uploadMateri").hide();
    	// Start event untuk jenis upload
    	$("#in-text").click(function(){
    		$("#textmateri").show();
    		$("#uploadMateri").hide();
    		$("#jenis-editor").show();
    	});

    	$("#in-upload").click(function(){
    		$("#uploadMateri").show();
    		$("#textmateri").hide();
    		$("#jenis-editor").hide();

    	});
           // End event untuk jenis editor
	// Strt dropp down depeden
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
                //console.log(data);
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


    function ubahmateri(){
    	url = base_url+"materi/updateMateri";
    	if ($('#giftcheckbox').is(':checked')) {
        stpublish =1;
      }
      else{
        stpublish =0;
      }

        var datas = {
        	UUID : $('input[name=UUID]').val(),
            judul : $('input[name=judul]').val(),
            editor1 : CKEDITOR.instances.editor1.getData(),
            subBabID : $('select[name=subBabID]').val(),
            stpublish : stpublish,
            opupload : $('input[name=opupload]:checked').val(),
            gambarSoal: $('[name=gambarSoal]').val(),
        }
        var elementId = "fileSoal";

        // console.log(datas);
            // do_upload
            $.ajaxFileUpload({
                url:url,
                data:datas,
                dataType:"TEXT",
                type:"POST",
                fileElementId :elementId,
                success:function(data){
                	// console.log(data);
                    swal({
                    title: "Materi Berhasil Diubah!",
                    type: "success",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Selesai",
                    closeOnConfirm: false,
                },

            function(isConfirm){
                    if (isConfirm) {
                        window.location.href = base_url+"materi/list_all_materi";
                    } 
                    else {
                        swal("Ubah Data dibatalkan");
                    }
                });
                },
                error:function(){
                	swal("gagal merubah data!");
                    
                }
            });
    }


  function ValidateSingleInput(oInput) {
  var _validFileExtensions = [".doc", ".docx", ".ppt", ".pptx", ".pdf"]; 
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
           $('#warningupload').modal('show');
                swal('Silahkan cek type extension file! ', 'Type yang bisa di upload hanya ".doc", ".docx", ".ppt", ".pptx", ".pdf', 'warning');
                return false;
            }
        }
    }
    return true;
}



    loadTingkat();
	// End Drop down depeden
</script>

<script type="text/javascript">

    $(function () {



            // Start event priview gambar Soal

            $('#fileSoal').on('change',function () {

                var file = this.files[0];

                var reader = new FileReader();

                reader.onload = viewerSoal.load;

                reader.readAsDataURL(file);

                viewerSoal.setProperties(file);

            });

            var viewerSoal = {

                load : function(e){

                    // $('#previewSoal').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenameSoal').text(file.name);

                    $('#filetypeSoal').text(file.type);

                    $('#filesizeSoal').text(Math.round(file.size/1024));

                },

            }

            // End event priview gambar Soal

            // Start event priview gambar Pembahasan

            $('#filePembahasan').on('change',function () {

              console.log('pembahasan');
              var file = this.files[0];

              var reader = new FileReader();

              reader.onload = viewerPembahasan.load;

              reader.readAsDataURL(file);

              viewerPembahasan.setProperties(file);

          });

            var viewerPembahasan = {

                load : function(e){

                    $('#previewPembahasan').attr('src', e.target.result);

                },

                setProperties : function(file){

                    $('#filenamePembahasan').text(file.name);

                    $('#filetypePembahasan').text(file.type);

                    $('#filesizePembahasan').text(Math.round(file.size/1024));

                },

            }

            // End event priview gambar Soal
        });

    </script>