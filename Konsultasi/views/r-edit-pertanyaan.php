<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
    }

    a, button {
      cursor: pointer;
  }
</style>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/adapters/jquery.js') ?>"></script>

<!-- modal preview -->
	<div class="modal fade" id="preview" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="alert alert-dismissable alert-danger" id="info" hidden="true" >
						<button type="button" class="close" onclick="hideme()" >×</button>
						<strong>Terjadi Kesalahan</strong> <br>isi tanggapan anda.
					</div>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title text-center text-danger">Preview Postingan</h2>
				</div>
				<div class="modal-body">
					<div class="container judul"></div>
					<hr>
					<div class="container isi"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="save()">Post</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- modal preview -->

<!-- modal preview -->
	<div class="modal fade" id="show_gambar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document" style="width: 90%">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title text-center text-danger">Daftar Gambar</h2>
				</div>
				<div class="modal-body">
					<table class="table_img" style="font-size: 13px;width: 100%;">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama File</th>
								<th>Tanggal</th>
								<th>Image</th>
								<th>Link/URL</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
					<textarea id="temp" style="display: inline; border: none;"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- modal preview -->


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
    <div class="section-content">
      <div class="row">
      	<div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">

      		<div class="col-sm-12">		
				<div class="alert alert-dismissable alert-danger" id="info" hidden="true" >
					<button type="button" class="close" onclick="hideme()" >×</button>
					<strong>Terjadi Kesalahan</strong> <br>Isi nama pertanyaan dan pertanyaan di editor yang sudah disediakan.
				</div>
			</div>

			<!-- Start Editor Soal -->
			<div class="col-sm-12">
				<div class="col-sm-8">
					
					Judul Pertanyaan <br>
					<input name="judul_pertanyaan" type="text" size="50" aria-required="true" class="form-control search-input col-sm-10" style="height: 35px;" value="<?=(htmlspecialchars($edit['judulPertanyaan'])) ?>"> 
				</div>
				<div class="col-sm-4">
					<a onclick="show_image()" class="btn btn-default btn-theme-colored" style="margin-top: 15px; height: 40px;">Lihat Gambar</a>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="col-sm-12">
				<br>
				Isi Pertanyaan :
				<textarea  name="editor1" class="form-control" id="isi"></textarea>
				<br>
				<form action="<?=base_url('konsultasi/do_upload') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
					Upload Gambar : 
					<input type="file" class="cws-button bt-color-3 alt smalls post" name="file" style="display: inline" onchange="cek_fileFoto(this,z='');">
					<a onclick="submit_upload()" style="border: 2px solid #18bb7c; padding: 2px;display: inline" title="Upload">Upload <i class="fa fa-cloud-download"></i></a> 
					<div id="output" style="display: inline">
						<a style="border: 2px solid grey; padding: 2px;display: none;" title="Sisipkan" disabled="disabled">Sisipkan <i class="fa fa-cloud-upload"></i></a> 
					</div>
					<input type="submit" class="fa fa-cloud-upload submit-upload" style="margin-top: 3px;display: none" value="Upload" >				
					</a>
				</form>
				<br>
				<a onclick="edit_pertanyaan()" class="btn btn-default btn-theme-colored edit_pertanyaan">Post</a>
				<br>
				<br>
				<hr>
				</div>
			</div>
			<!-- END Start Editor Soal -->
      	</div>
      </div>
    </div>
  </div>
</section>
<input type="text" value="<?=(htmlspecialchars($edit['isiPertanyaan'])) ?>" name="isi_pertanyaan" hidden="true">

<script type="text/javascript"> 
	var ckeditor;
	$(document).ready(function(){
		ckeditor = CKEDITOR.replace( 'editor1' );
		isiPertanyaan = $('input[name=isi_pertanyaan]').val();

		CKEDITOR.instances.isi.setData(isiPertanyaan);
	});

	function submit_upload(){
		$('.submit-upload').click();
	}
	jQuery(document).ready(function() { 
		jQuery('#form-gambar').on('submit', function(e) {
			e.preventDefault();
			jQuery('#submit-button').attr('disabled', ''); 
			jQuery("#output").html('<div style="padding:10px"><img src="<?php echo base_url('assets/image/loading/spinner11.gif'); ?>" alt="Please Wait"/> <span>Mengunggah...</span></div>');
			jQuery(this).ajaxSubmit({
				target: '#output',
				success:  sukses 
			});
		});
	}); 

	function sukses()  { 
		jQuery('#form-upload').resetForm();
		jQuery('#submit-button').removeAttr('disabled');
		swal({ 
			html:true, 
			title:'Upload Berhasil', 
			text:'<b>Selanjutnya klik tombol sisipkan!</b>', 
			type:'info'});
	} 

	function insert(){
		nama_file = $('.insert').data('nama');
		url = base_url+"assets/image/konsultasi/"+nama_file;

		CKEDITOR.instances.isi.insertHtml('<img src='+url+' ' + CKEDITOR.instances.isi.getSelection().getNative()+'>');

	}

	
	// masukin text ke posisi tertentu
	jQuery.fn.extend({
		insertAtCaret: function(myValue){
			return this.each(function(i) {
				if (document.selection) {
					this.focus();
					sel = document.selection.createRange();
					sel.text = myValue;
					this.focus();
				}
				else if (this.selectionStart || this.selectionStart == '0') {
					var startPos = this.selectionStart;
					var endPos = this.selectionEnd;
					var scrollTop = this.scrollTop;
					this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
					this.focus();
					this.selectionStart = startPos + myValue.length;
					this.selectionEnd = startPos + myValue.length;
					this.scrollTop = scrollTop;
				} else {
					this.value += myValue;
					this.focus();
				}
			})
		}
	});
	// masukin text ke posisi tertentu

	
</script>
<!-- UPLOAD -->
<script>
	function preview(){
		var desc = ckeditor.getData();jqXHR
		var data = {
			namapertanyaan : $('input[name=namaPertanyaan]').val(),
			isi : desc,
		}

		$('.modal-body .judul').html("<h5>Judul</h5>");		
		$('.modal-body .judul').append(data.namapertanyaan);
		$('.modal-body .isi').html("<h5>Isi Pertanyaan</h5>	");
		$('.modal-body .isi').append(data.isi);


		if (data.namapertanyaan == "" || data.namapertanyaan == "") {
			swal("Tolong, isi judul dan pertanyaan anda..")

		}else{
			$('#preview').modal('show');
		}
	}

	// edit pertanyaan
	function edit_pertanyaan(){
		var desc = ckeditor.getData();
		var data = {
			isi : desc+"<br>",
			judul_pertanyaan : $('input[name=judul_pertanyaan]').val(),
			pertanyaanID: <?=$edit['id'] ?>
		}

		if (data.isi == "") {
			$('#info').show();
		}else{
			url = base_url+"konsultasi/ajax_update_pertanyaan/";
			$.ajax({
				url : url,
				type: "POST",
				data: data,
				dataType: "JSON",
				success: function(data)
				{
                $('.post').text('Posting..'); //change 
                $('.post').attr('disabled',false); //set
                setTimeout(function() {
	                swal({
	                    title: "Wow!",
	                    text: "Pertanyaan berhasil diubah",
	                    type: "success"
	                }, function() {
	                    window.location = base_url+"konsultasi/singlekonsultasi";
	                });
	            }, 1000); 
                // window.location = base_url+"konsultasi/singlekonsultasi";
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	            	swal('Error adding / update data');
	            }
	        });
		}
	}

	function hideme(){
		$('#info').hide();
	}
	var table_gambar;
	function show_image(){
		$('#show_gambar').modal('show');
		table_gambar = $('.table_img').DataTable({
			"ajax": {
				"url": base_url+"konsultasi/list_image_uploaded",
				"type": "POST"
			},
			"emptyTable": "Tidak Ada Data Pesan",
			"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
			"bDestroy": true,
		});
	}

	function upload_gambar_konsultasi(){

	}
</script>