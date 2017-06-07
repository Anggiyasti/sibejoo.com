<style type="text/css">

  #macy-container::before {
    content: "";
    display: table;
    clear: both
  }
  #macy-container {
    margin-top: 22px
  }
  #macy-container::after {
    content: "";
    display: table;
    clear: both
  }
  .demo {
    margin-bottom: 24px;
    border-radius: 4px;
    overflow: hidden;
    border: 1px solid #eee;
    padding:5px;
  }
  .demo-image {
    width: 100%;
    display: block;
    height: auto
  }
  .feature-list {
    margin-bottom: 0;
    margin-left: 0;
    width: 100%;
    list-style: none
  }
  .feature-list li {
    display: inline-block;
    width: 25%;
    text-align: center
  }
  .feature-list li::before {
    color: inherit;
    content: "•";
    color: #54b9cb;
    margin-right: 7px
  }
</style>

<form>
  <input type="hidden" name="tingkat" value="{alias_tingkat}">
  <input type="hidden" name="pelajaran" value="{alias_pelajaran}">
</form>

<div class="row">
  <div class="container">
    <div class="col-md-6">
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios5" checked="true" value="option2">
          Video Berdasarkan Sub
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2" name="bysub"  onclick="direct()">
          Semua Video

        </label>
      </div>

    </div>
  </div>
</div>

<section class="row">
  <!-- Start Div container -->
  <div class="container">
    <!-- Start div macy-container -->
    <div id="macy-container">
      <?php $i=0;   $cekjudulbab=null;?>
      <?php foreach ($bab_video as $bab_video_items) {
        $judulbab=$bab_video_items->judulBab;
        $subbab=$bab_video_items->judulSubBab;

        if ($cekjudulbab != $judulbab) { 
          if($i=='1'){
              // END div demo
            ?></div> <?php
          } ?>
          <!-- Start div demo -->
          <div class="demo">
            <strong><?=$judulbab ?></strong><br>
            <span><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>#ini"><?php echo $subbab ;?></a></span><br>
            <?php }else{ ?>
            <span><a href="<?=base_url('video/videosub/')?><?=$bab_video_items->subbabID?>#ini"><?php echo $subbab ;?></a></span><br>
            <?php } ?>
            <?php   $cekjudulbab=$judulbab;
            $i='1'; ?>
            <?php } ?>
          </div>
          <!-- END DIV DEMO -->
        </div>
        <!-- END div macy-container -->
      </div>
      <!-- END Div container -->
    </section>
    <!-- ucapan selamat datang -->

  </div>


  <hr class="divider-big">
  <script src="http://macyjs.com/assets/js/macy.min.js"></script>
  <script type="text/javascript">
    function direct(){
      var tingkat = $("input[name='tingkat']").val();
      var aliasMapel = $("input[name='pelajaran']").val();
      window.location = base_url+"video/daftarallvideo/"+<?=$this->uri->segment(3) ?>;
    }


    $(document).ready(function(){
      Macy.init({
        container: '#macy-container',
        trueOrder: false,
        waitForImages: false,
        margin: 24,
        columns: 3,
        breakAt: {
          1200: 5,
          940: 3,
          520: 2,
          400: 1
        }
      });
    });

  </script>