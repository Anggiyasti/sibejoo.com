<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

<style type="text/css">
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
      		<div class="widget border-1px p-30">
      			<?php if ($this->session->userdata('HAKAKSES')=='siswa'): ?>
      				<!-- MENU UNTUK SISWA -->
					<form class="form-group">
						<h4><b>Filter Pertanyaan</b></h4>
						<div class="row">
		                    <div class="form-group col-md-4">
		                     	<select class="form-control" name="mapel" id="mapelSelect" style="height: 35px;">
									<option value="0">-Pilih Matapelajaran-</option>
									<?php foreach ($mapel as $mapel_item): ?>
										<option value=<?=$mapel_item['tingpelID'] ?>><?=$mapel_item['napel'] ?></option>  
									<?php endforeach ?>
								</select>
		                    </div>
		                    <div class="form-group col-md-4">
		                      <select class="form-control" name="tingkat" id="babSelect" style="height: 35px;" ><option value=0>-Pilih Bab-</option></select>
		                    </div>
		                    <div class="form-group col-md-4">
		                    	<a href="#" class="btn btn-default buat-btn"><i class="fa fa-plus"></i> Buat</a>
		                    	<a href="#" class="btn btn-default cari-btn"><i class="fa fa-search"></i> Cari</a>
		                    </div>
	                  	</div>
					</form>

					<form class="form-group">
						<h4><b>Pencarian Pertanyaan</b></h4>
						<div class="row">
		                    <div class="form-group col-md-4">
		                     	<select class="form-control" style="height: 35px;" name="" id="" onchange="location = this.value";>
									<option value="<?=base_url('konsultasi/pertanyaan_ku') ?>"  class="center-text">Pertanyaan Saya</option>
									<option value="<?=base_url('konsultasi/pertanyaan_all')?>">Semua Pertanyaan</option>
									<option value="<?=base_url('konsultasi/pertanyaan_grade')?>">Pertanyaan Setingkat</option>
									<option selected value="<?=base_url('konsultasi/pertanyaan_mentor')?>">Pertanyaan Sementor</option>
								</select>
		                    </div>
		                    <div class="form-group col-md-4">
		                    	<div class="widget">
				                <div class="search-form">
				                  <form>
				                    <div class="input-group">
				                      <input type="text" placeholder="Cari pertanyaan lalu enter" class="form-control search-input" style="height: 35px;" name="cari" id="search1">
				                      <span class="input-group-btn">
				                      <a href="#" class="btn search-button" style="height: 35px;"><i class="fa fa-search"></i></a>
				                      </span>
				                    </div>
				                  </form>
				                </div>
				              </div>
		                    </div>
		                    <div class="form-group col-md-4">
		                    	<a href="<?=base_url('konsultasi/pertanyaan_mentor') ?>" class="btn btn-default"><i class="fa fa-times"></i> Reset</a>
		                    </div>
	                  	</div>
					</form>
					<!-- END MENU UNTUK SISWA -->

				<?php else: ?>
					<!-- MENU UNTUK GURU -->
					<!-- END MENU UNTUK GURU -->
      			<?php endif; ?>

      			<!-- semua -->
      			<?php if ($my_questions): ?>
      				<?php foreach ($my_questions as $question): ?>
      					<div class="blog-post">
      						<hr class="divider-color">

      						<div class="author-details media-post">
				                <a href="#" class="post-thumb mb-0 pull-left flip pr-20"><img class="img-thumbnail" alt="" src="http://placehold.it/110x110" data-at2x="<?=base_url("assets/image/photo/siswa/".$question['photo'])?>"></a>
				                <div class="post-right">
				                  <h5 class="post-title mt-0 mb-0"><a href="#" class="font-18"><?=$question['namaDepan']." ".$question['namaBelakang'] ?></a></h5>
				                  <div class="comment-date">(<?=$question['date_created'] ?>)</div>
				                  <div class="col-md-10">
				                  	<a onclick="single_konsul(<?=$question['pertanyaanID'] ?>)">
					                  <blockquote class="gray pt-20 pb-20" >
						                <p><i class="fa fa-quote-left"></i> <?=$question['judulPertanyaan'] ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
						                <footer><?=$question['isiPertanyaan'] ?></footer>
						              </blockquote>
						            </a>
					              
				                  <div class="tagline p-0 pt-20 mt-5">
					                <div class="row">
					                  <div class="col-md-4">
					                  </div>
					                  <div class="col-md-8">
					                    <div class="share text-right">
					                     	<p>
					                     		<a href="<?=base_url('konsultasi/filter/'.str_replace(' ', '_', $question['namaMataPelajaran']).'/all') ?>"><i class="fa fa-tags text-theme-color-2"></i> <?=$question['namaMataPelajaran'] ?></a> | 
					                     		<a href="<?=base_url('konsultasi/filter/'.str_replace(' ', '_', $question['namaMataPelajaran']).'/'.str_replace(' ', '_', $question['judulBab'])) ?>">
												<i class="fa fa-puzzle-piece text-theme-color-2"></i> <?=$question['judulBab'] ?></a> |
												<span><i class="fa fa-pencil text-theme-color-2"></i> <?=$question['jumlah'] ?></span> |
												<?php if (!empty($question['namaGuru'])): ?>
													<span><i class="fa fa-search"></i> <?=$question['namaGuru'] ?></a>
												<?php else: ?>
													<span>Tanpa Mentor</span>
												<?php endif ?>
											</p>
					                    </div>
					                  </div>
					                </div>
				                  </div>

				                </div>
				                <div class="clearfix"></div>
				             </div>

      					</div>
      				<?php endforeach ?>
      			<?php else: ?>
					<h3>Tidak Ada Pertanyaan</h3>
      			<?php endif; ?>

      		<!-- pagination -->
			<hr>
			<br>
			<div>

				<div class="page-pagination clear-fix" style="width:100%;">
					<center><?php echo $links; ?></center>	
				</div>
				<b>Jumlah Pertanyaan :<?=$jumlah_postingan ?></b>
			</div>
			<!-- / pagination -->
			
      		</div>
      	</div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
	function showmodal(){
		$('#myModal').modal('show');
	}
</script>
<script type="text/javascript">
	$("#search1").on('keyup', function (e) {
		if (e.keyCode == 13) {
			keyword = $('#search1').val().replace(/ /g,"-");		;
			
			url_ajax = base_url+"konsultasi/tamp_search";
	    
		   var global_properties = {
		      keyword: keyword
		   };

		   $.ajax({
		      type: "POST",
		      dataType: "JSON",
		      url: url_ajax,
		      data: global_properties,
		      success: function(data){
		        document.location = base_url+"konsultasi/pertanyaan_mentor_search";
		      },error:function(data){
		        sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
		      }

		    });
		}
	});

	 	$('.cari-btn').click(function(){
 		var mapel= $('#mapelSelect').find(":selected").text().replace(/ /g,"_");
 		var bab= $('#babSelect').find(":selected").text().replace(/ /g,"_");

 		console.log(bab);
 		if (mapel == 'Pilih_Mata_Pelajaran') {
 			sweetAlert("Oops...", "Silahkan Pilih Pelajaran Atau Bab Terlebih Dahulu", "error");
 		}else{
 			if (bab=='Bab_Pelajaran') {
 				document.location = base_url+"konsultasi/filter_mentor/"+mapel+"/all";
 			}else if(bab!='Bab_Pelajaran'){
 				document.location = base_url+"konsultasi/filter_mentor/"+mapel+"/"+bab;
 			}
 		}
 	});

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