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
      <div class="row multi-row-clearfix">

        <div class="col-md-12">
            <h2 class="text-center">Silahkan pilih tingkat untuk melakukan latihan online!</h2>
        </div>

        <div class="col-md-12">
            <div class="products">
            <?php $no=[1,4,5] ;$namaFile=""?>
            <?php $i=0; ?>
            <?php foreach ($tingkat as $tingkatitem): ?>
                <?php $namaFile = strtolower(str_replace(" ", "-", $tingkatitem['aliasTingkat'])) ?>
                <?php $no[$i] ?>
                
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-30">
                      <div class="product">
                        <div class="product-thumb"> 
                          <img alt="<?=base_url('assets/back/img/illustrasi/') ?><?=$namaFile ?>.png" src="<?=base_url('assets/back/img/illustrasi/') ?><?=$namaFile ?>.png" class="img-responsive img-fullwidth">
                          <div class="overlay">
                            <?php $id = $tingkatitem['id'] ?>
                            <div class="btn-add-to-cart-wrapper">
                              
                            </div>
                            <div class="btn-product-view-details">
                              <a onclick="show_mapel(<?=$id?>)" class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700">Lihat Mata Pelajaran</a>
                            </div>
                          </div>
                        </div>
                        <div class="product-details text-center">
                          <h5 class="product-title"><?=$tingkatitem['namaTingkat'] ?></h5>
                        </div>
                      </div>
                    </div>

                
                <?php $i = $i+1; ?>
            <?php endforeach ?>
            </div>                  
        </div>

      </div>
    </div>
  </div>    
</section>
            
<script type="text/javascript">
    function show_mapel(id) {
        window.location.href = base_url+"index.php/tesonline/pilihmapel/"+id;
    }
    
</script>