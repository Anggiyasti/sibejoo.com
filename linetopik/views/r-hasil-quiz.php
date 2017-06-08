<link rel="stylesheet" href="<?= base_url('assets/css/custom-time-line.css') ?>"/>
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1 class="text-center text-white">{judul_header2}</h1>
              
            </div>
          </div>
        </div>
      </div>      
    </section>
<section>
      <div class="container" >
        <div class="row">
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Search box</h5>
                <div class="search-form">
                  <form method="get" class="search-form" action="<?=base_url()?>index.php/linetopik/cariTopik"  accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="input-group">
                      <input type="search" class="form-control search-input" placeholder="Search"  name="keycari" title="Search for:" id="caritopik">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /Pencarian -->
        <h2><a href="<?=base_url('index.php/linetopik/timeLine/').$topikUUID?>"><?=$namaTopik; ?></a></h2> 
        <hr class="divider-big">
        <!-- Start Time Line -->
        <ul class="media-list media-list-feed grid-col-3" >
            <?php 
            $i=0;
            foreach ($datline as $key ):           
                ?>
            <li  class="media">
               <div class="media-object pull-left ">
                <i href="<?=$key['link'];?>"  class="<?=$key['icon']?> " id="ico-<?=$i;?>"></i>
            </div>
            <div class="media-body">
                <!-- Untuk menampung staus step disable or enable -->
                <input type="text" id="status-<?=$i;?>" value="<?=$key["status"];?>" hidden="true">
                <!--  // Untuk menampung staus step disable or enable  -->
                <a href="<?=$key['link'];?>" class="media-heading"  id="font-<?=$i;?>" style="padding-left:20px;"><?=$key['namaStep']?></a>
            </div>
        </li>       
        <?php 
        $i ++;
        endforeach ?>
    </ul>
    <!-- menampung nilai panjang array -->
    <input id="n" type="text"  value="<?=$i;?>" hidden="true">
    <!-- END Tieme line  -->
            </div>
          </div>
       

      <div class="col-md-9 blog-pull-right">
            
              <article class="post clearfix mb-0">
              
                <div class="entry-content" >
                  <div class="entry-meta media no-bg no-border mt-15 pb-20">
                  <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                      <ul>
                        <li class="font-12 text-white font-weight-600" >Logo Quiz</li>
                      </ul>
                    </div>
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip ">
                        <h5 class="entry-title text-uppercase pt-0 mt-0 ">Hasil Quiz</h5>
                      </div>
                    </div>
                    
                  </div>
                 <table  class="table table-striped">
                            <tbody>
                                <tr class="">
                                    <th>Syarat Lulus</th>
                                    <td>Benar <?=$data['syarat'];?> dari <?=$data['jumlahsoal'];?> soal</td>
                                </tr>

                                <tr class="cart-subtotal">
                                    <th>Jumlah Benar  </th>
                                    <td><span class="amount"> <?=$data['jumlahBenar'];?></span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>Jumlah Salah </th>
                                    <td>    
                                        <?=$data['jumlahSalah'];?>      
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Jumlah Kosong </th>
                                    <td><span class="amount"><?=$data['jumlahKosong'];?></span></td>
                                </tr> 
                                <tr class="order-total">
                                    <th>Hasil </th>
                                    <td><span class="amount"> <?=$data['hasil'];?></span></td>
                                </tr>           
                            </tbody>
                        </table>
                     
                      <div class="tags">
                      <p class="mb-0"> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><span><?=$tingkat;?>|</span></a> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><?=$mapel;?>|</a> 
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><?=$bab;?>|</a>
                      <a href="#"><i class="fa fa-tags text-theme-color-2"></i><?=$namaTopik;?></a>  
                      </p>
                    </div>

                </div>
              

              </article>
              <hr>
                    
                
              <div class="tagline p-0 pt-20 mt-5">
                <div class="row">
                  <div class="col-md-8">
                    
                  </div>
                  
                </div>
              </div>              
            </div>
          </div>
    </section>

<script type="text/javascript">
    $(document).ready(function() { 
        var n = $("#n").val();
        // console.log(n);
        // $("#ico-0").css("background","black");
        for (i = 0; i < n; i++) {
            var status = $("#status-"+i).val();

            if (status=="disable") {
               $("#ico-"+i).css("background","#b0b0b0");
               $("#font-"+i).css("color","#b0b0b0");
           } 
           
       }
   });
</script>
<!-- JQ untuk autocomplate search topik -->
<script type="text/javascript">

  $(document).ready(function() { 
    var site = "<?php echo site_url();?>";
    $( "#caritopik" ).autocomplete({
        source:  site+"/linetopik/autocompleteTopik",
        select: function (event, ui) {
                window.location = ui.item.url;
                }
    });

});
</script>

