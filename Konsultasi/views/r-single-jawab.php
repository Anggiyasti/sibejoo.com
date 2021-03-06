<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/config.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/adapters/jquery.js') ?>"></script>

<style type="text/css">
	.komen {
		width:80%;
		margin-left: 120px;
		/*border: 1px solid pink;*/

	}
	.komen li{
		margin: 0;
		padding: 0;
		line-height:1.8;
	}
	.komen quote{
		/*border: 1px solid black;*/
		padding: 3px 20px;
		width: inherit;
		background: rgba(0,0,0,.1);
		font-style: italic;
	}
	blockquote {
		background: #f9f9f9;
		border-left: 10px solid #ccc;
		margin: 1.5em 10px;
		padding: 0.5em 10px;
		quotes: "\201C""\201D""\2018""\2019";
	}
	blockquote:before {
		color: #ccc;
		content: open-quote;
		font-size: 4em;
		line-height: 0.1em;
		margin-right: 0.25em;
		vertical-align: -0.4em;
	}
	blockquote p {
		display: inline;
	}

	.blog-post {
    margin-bottom: 40px;
  }
  .blog-post .post-info, .pricing-table .header-pt {
    border-top-left-radius: 10px;
    -ms-border-top-left-radius: 10px;
    -moz-border-top-left-radius: 10px;
    -webkit-border-top-left-radius: 10px;
}
.blog-post .post-info {
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-align-content: center;
    -ms-flex-line-pack: center;
    align-content: center;
    background-color: #555555;
    text-align: center;
    color: #ffffff;
    overflow: hidden;
}

.post-info .date-post {
    width: 53px;
    height: 53px;
    background-color: #202C45;
}
.post-info .date-post .day {
    font-size: 25px;
    font-weight: 500;
    height: 50%;
    line-height: 33px;
}
.post-info-main {
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    vertical-align: middle;
    display: inline-block;
}
.post-info .comments-post {
    width: 53px;
    line-height: 53px;
    height: 53px;
    background-color: #202C45;
}
.post-info + .quotes {
    margin-top: 20px;
}
.quote-avatar-author {
    float: left;
    margin: 5px 40px 0 0;
}
.bg-color-2 {
    background-color: #555555;
    color: #ffffff;
}
.bg-color-2 a{
    background-color: #555555;
    color: #ffffff;
}
a, button {
    cursor: pointer;
}
</style>

<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center text-white">{judul_halaman}</h1>
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
      		<?php if ($data_postingan!=array()): ?>
      			<?php $link = base_url('konsultasi/singlekonsultasi/').$data_postingan['pertanyaanID'] ?>
      			<div class="blog-post">
      				<article>
      					<div class="row bg-color-2">
							<div class="container"><?=$data_postingan['date_created'] ?> |
							 <a onclick="single_konsul(<?=$data_postingan['pertanyaanID'] ?>)"><?=$data_postingan['judulPertanyaan'] ?></a></div>
						</div><br>

						<div class="quotes clear-fix" >
							<div class="quote-avatar-author clear-fix">
								<?php 
								if ($data_postingan['hakAkses']=="siswa") {
									$gbr = base_url().'assets/image/photo'."/".$data_postingan['hakAkses']."/".$data_postingan['siswa_photo'];
								}else{
									$gbr = base_url().'assets/image/photo'."/".$data_postingan['hakAkses']."/".$data_postingan['guru_photo'];
								}
								?>
								<img src="<?=$gbr ?>" width="60px">
									<div class="author-info"><?=$data_postingan['namaPengguna'] ?><br><span><?=$data_postingan['hakAkses'] ?></span></div>
							</div>

							<div>
							<?php $value =htmlspecialchars($data_postingan['isiJawaban']). 
									"<span style='font-style:italic'><br>Post By:".ucfirst($data_postingan['namaPengguna']	).
									"<a href='".$link."'><i class='fa fa-arrow-circle-o-right'> > </i></a>"?>
								<div class="komen"><?=$data_postingan['isiJawaban'] ?>
									<input type="hidden" name="<?=$data_postingan['jawabID'] ?>" 
										value="<?=$value ?>">
								</div>

							</div>

						</div><br>

						<?php if ($this->session->userdata('HAKAKSES')=="guru"): ?>
							<div class="text-right">
								<a onclick="quote(<?=$data_postingan['jawabID'] ?>)" >
									<i class="fa fa-quote-right ">
									</i> Quote	
								</a>
							</div>
						<?php else :?>
							<?php if ($data_postingan['namaPengguna']==$this->session->userdata('USERNAME')): ?>
								<div class="text-right">
									<a onclick="quote(<?=$data_postingan['jawabID'] ?>)">
										<i class="fa fa-quote-right ">
										</i> Quote	
									</a> |

									<a href="<?=base_url('konsultasi/editpost/'.$data_postingan['jawabID']) ?>">
										<i class="fa fa-pencil smaller">
										</i> Edit	
									</a>
								</div>

							<?php else :?>
								<div class="text-right">
									<a onclick="point(<?=$data_postingan['jawabID'] ?>)">
										<i class="fa fa-heart">
										</i> Point
									</a> |

									<a onclick="quote(<?=$data_postingan['jawabID'] ?>)">
										<i class="fa fa-quote-right ">
										</i> Quote	
									</a>
								</div>
							<?php endif ?>
						<?php endif ?>

      				</article>
      			</div>
      		<?php endif; ?>

      		<!-- editor reply -->
			<div class="container">	
				<hr>
				<div class="col-sm-12" id="jawaban">
					<br>
					<span>Isi Jawaban :</span>
					<textarea  name="respon" class="form-control" id="isi" row=10 cols=80></textarea>
					<br>
					<form action="<?=base_url('konsultasi/do_upload') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
						<span>Upload gambar :</span> 
						<input type="file" class="cws-button bt-color-3 alt smaller post" name="file" style="display: inline">
						<a onclick="submit_upload()" style="border: 2px solid #18bb7c; padding: 2px;display: inline" title="Upload"><i class="fa fa-cloud-download"></i></a> 
						<div id="output" style="display: inline">
							<a style="border: 2px solid grey; padding: 2px;display: inline" title="Sisipkan" disabled><i class="fa fa-cloud-upload"></i></a> 
						</div>
						<input type="submit" class="fa fa-cloud-upload submit-upload" style="margin-top: 3px;display: none" value="Upload">
					</form>
					<a onclick="simpan_jawaban()" class="btn btn-default btn-theme-colored post">Post</a>
				</div>
			</div>

      	</div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
		function insert(){
			nama_file = $('.insert').data('nama');
			url = base_url+"assets/image/konsultasi/"+nama_file;

			CKEDITOR.instances.isi.insertHtml('<img src='+url+' ' + CKEDITOR.instances.isi.getSelection().getNative()+'>');
		}
		
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

		function sukses(){ 
			jQuery('#form-upload').resetForm();
			jQuery('#submit-button').removeAttr('disabled');
		}

		var ckeditor;

		

		$(document).ready(function(){
			CKEDITOR.replace( 'respon', {
				height: 260,
				/* Default CKEditor styles are included as well to avoid copying default styles. */
			} );

			/*ckeditor = CKEDITOR.replace('respon');	*/
		});

		var ckeditor;
		var string;
		var txt = 1;
		function quote(data){
			if (data==0) {						
					// balas
					$('html, body').animate({
						scrollTop: $("#jawaban").offset().top
					}, 2000);
				}else{
					//quote
					$('html, body').animate({
						scrollTop: $("#jawaban").offset().top
					}, 2000);

					string = $('input[name='+data+']').val();

					CKEDITOR.instances.isi.setData("<blockquote>"+string+"</blockquote><br>");
				}

			}
			function simpan_jawaban(){
				// get text from ck editor
				txt = CKEDITOR.instances.isi.getData();
				
				var datas = {
					isiJawaban : txt,
					penggunaID : $('input[name=idpengguna]').val(),
					pertanyaanID : $('input[name=idpertanyaan]').val(),
				};

				url = base_url+"konsultasi/ajax_add_jawaban/";
				$.ajax({
					url : url,
					type: "POST",
					data: datas,
					dataType: "TEXT",
					success: function(data){
						window.location = base_url+"konsultasi/singlekonsultasi/"+datas.pertanyaanID;
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error adding / update data');
					}
				});

			}

			function point(data){
				elemen = "<textarea class='form-control' name='komentar'></textarea>";
				$('.modal-body').html(elemen);
				$('.modal-header .modal-title').html("Berikan Komentar");
				$('#myModal').modal('show');
				button = "<button type='button' class='cws-button bt-color-1 alt small' data-dismiss='modal'>Batal</button><button type='button' class='cws-button bt-color-2 alt small mulai-btn post'onclick='komen("+data+")'>Berikan</button>";

				$('.modal-footer').html(button);


			}

			function komen(data){
				var isikomentar = $('textarea[name=komentar]').val();

	// url = base_url+"konsultasi/ajax_add_point/"+data;
	url = base_url+"konsultasi/check_point/"+data;

	datas = {
		isiKomentar : isikomentar,
		idJawaban : data
	}
	var stat;
	$.ajax({
		url : url,
		type: "POST",
		data: datas,
		dataType: "json",
		success: function(data, status, jqXHR)
		{
			stat = get_data(data, datas);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			swal('Error adding / update data');
		}
	});

}

function get_data(data, datas){
	status = data;
	postingan = datas;
	if (status==1) {
		swal("Tidak Dapat Memberikan Point")
	}else{
		url = base_url+"konsultasi/ajax_add_point/"+postingan.idJawaban;
		$.ajax({
			url : url,
			type: "POST",
			data: datas,
			dataType: "text",
			success: function()
			{
				swal("sudah ditambahkan");
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				swal('Error adding / update data');
			}
		});
	}
}

// redirect ke single konsultasi
  function single_konsul(pertanyaanID) {
    url_ajax = base_url+"konsultasi/tamp_single";

    var global_properties = {
      pertanyaanID: pertanyaanID
    };

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: url_ajax,
      data: global_properties,
      success: function(data){
        window.location.href = base_url + "konsultasi/singlekonsultasi";  
      },error:function(data){
        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
      }

    });
  }
</script>
