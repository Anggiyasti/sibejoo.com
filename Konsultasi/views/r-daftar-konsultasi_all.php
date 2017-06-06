<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

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
									<option selected value="<?=base_url('konsultasi/pertanyaan_all')?>">Semua Pertanyaan</option>
									<option value="<?=base_url('konsultasi/pertanyaan_grade')?>">Pertanyaan Setingkat</option>
									<option value="<?=base_url('konsultasi/pertanyaan_mento')?>r">Pertanyaan Sementor</option>
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
		                    	<a href="<?=base_url('konsultasi/pertanyaan_all') ?>" class="btn btn-default buat-btn"><i class="fa fa-times"></i> Reset</a>
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

      		</div>
      	</div>
      </div>
    </div>
  </div>
</section>