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
          
       


            
              <article class="post clearfix mb-0" >
              
                <div class="entry-content" >
                  <div class="entry-meta media no-bg no-border mt-15 pb-20">
                  
                    <div class="media-body pl-15">
                      <div class="event-content pull-left flip ">
                        <h5 class="entry-title text-uppercase pt-0 mt-0 ">Hasil Quiz</h5>
                      </div>
                    </div>
                    
                  </div>
                  
                 <table  class="table">
                            <tbody>

                                <tr class="cart-subtotal">
                                    <th>Jumlah Benar  </th>
                                     <td><span class="amount"> <?=$benar;?></span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>Jumlah Salah </th>
                                    <td> <span class="amount">   
                                        <?=$salah;?>  </span>    
                                    </td> 
                                </tr>
                                <tr class="order-total">
                                    <th>Jumlah Kosong </th>
                                    <td><span class="amount"> <?=$kosong;?></span></td>
                                </tr> 
                                <tr class="order-total">
                                    <th>Hasil </th>
                                    <td><span class="amount"><?=(int)$score;?></span></td>
                                </tr>           
                            </tbody>
                        </table>  
                     
                      <div class="tags">
                      <p class="mb-0"> 
                      <!-- <i class="fa fa-tags text-theme-color-4 ml10"><b><?=$tingkat;?></b> |</i>
                        <i class="fa fa-tags text-theme-color-4 ml10"><b><?=$mapel;?></b> |</i>
                        <i class="fa fa-tags text-theme-color-4 ml10"><b><?=$bab;?></b> |</i>
                        <i class="fa fa-tags text-theme-color-4 ml10"><b><?=$namaTopik;?></b></i> -->
                      </p>
                    </div>

                </div>
              

              </article>

              <a href="<?=base_url('tryit_tryout/mulaipembahasan')?>" class="btn btn-block bg-theme-colored text-white" >Lihat Pembahasan</a>
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

  function getvideo(uuid) {
      // uuid =$('input[name=uuid]').val();
      // console.log(uuid);
        url_ajax = base_url+"linetopik/tampunguuid";

        var global_properties = {
          uuid: uuid
        };

        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: url_ajax,
          data: global_properties,
          success: function(data){
            window.location.href = base_url + "linetopik/step_video";  
          },error:function(data){
            sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
          }

        });
    }

    function getmateri(uuid) {
        url_ajax = base_url+"linetopik/tampunguuid";

        var global_properties = {
          uuid: uuid
        };

        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: url_ajax,
          data: global_properties,
          success: function(data){
            window.location.href = base_url + "linetopik/step_materi";  
          },error:function(data){
            sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
          }

        });
    }
</script>

