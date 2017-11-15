<style type="text/css">
  /* Pagination */
div.pagination {
  font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
  padding:2px;
  margin: 20px 10px;
  float: right;
  color: white;
}

div.pagination a {
  margin: 2px;
  padding: 0.5em 0.64em 0.43em 0.64em;
  background-color: #FD1C5B;
  text-decoration: none; /* no underline */
  color: #fff;
}
div.pagination a:hover, div.pagination a:active {
  padding: 0.5em 0.64em 0.43em 0.64em;
  margin: 2px;
  background-color: #FD1C5B;
  color: #fff;
}
div.pagination span.current {
    padding: 0.5em 0.64em 0.43em 0.64em;
    margin: 2px;
    background-color: #f6efcc;
    color: #6d643c;
  }
div.pagination span.disabled {
    display:none;
  }
.pagination ul li{display: inline-block;}
.pagination ul li a.active{opacity: .5;}

/* loading */
.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
.loading .content {
    position: absolute;
    transform: translateY(-50%);
     -webkit-transform: translateY(-50%);
     -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}
</style>
<!-- semua -->
    <?php if ($my_questions): ?>
     <?php foreach ($my_questions as $question): ?>
      <div class="blog-post">
      	<hr class="divider-color">

      	<div class="author-details media-post">
				           <a href="#" class="post-thumb mb-0 pull-left flip pr-20"><img class="img-thumbnail" alt="" src="<?=$question['photo'] ?>" data-at2x="<?=$question['photo'] ?>" style="width: 100px;height: 100px;"></a>
				           <div class="post-right">
                    <ul class="list-inline font-12 mb-5">
                      <li class="pr-0"><h5 class="post-title mt-0 mb-0"><a href="#" class="font-18"><?=$question['namaDepan']." ".$question['namaBelakang'] ?></a></h5></li>
                      <li class="pl-30 pull-right"><a onclick="single_konsul(<?=$question['pertanyaanID'] ?>)" class="btn btn-default" style="color: #53cf92;"><b>JAWAB</b></a></li>
                    </ul>
                    <div class="comment-date">(<?=$question['date_created'] ?>)</div>
				             <div class="col-md-10">
				              <a onclick="single_konsul(<?=$question['pertanyaanID'] ?>)">
					             <blockquote class="gray pt-20 pb-20">
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
						                  <a onclick="filter()" ><i class="fa fa-tags text-theme-color-2"></i> <?=$question['keterangan'] ?>
                                <input type="text" name="tamp_tingpel" value="<?=$question['tingpel']?>" hidden="true">
                              </a> | 
						                  <a onclick="filter()">
    								            <i class="fa fa-puzzle-piece text-theme-color-2"></i> <?=$question['judulBab'] ?>
                                <input type="text" name="tamp_bab" value="<?=$question['babID']?>" hidden="true"></a> |
    								            <span><i class="fa fa-pencil text-theme-color-2"></i> <?=$question['jumlah'] ?></span> |
    								            <?php if (!empty($question['namaGuru'])): ?>
    									           <span><i class="fa fa-search"></i> <?=$question['namaGuru'] ?></span>
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
      </div>
     <?php endforeach ?>
    <?php else: ?>
		<h3 class="text-center">Tidak Ada Pertanyaan</h3>
    <?php endif; ?>
    <div class="clear"></div>
  <?php echo $this->ajax_pagination->create_links(); ?>