<style type="text/css">
  .disabled {
    opacity: .4;
  }
</style>

<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://www.ludodigitalstories.it/wp-content/uploads/2016/01/timeline.png">
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
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-3">
        <div class="sidebar sidebar-left mt-sm-30">
          <div class="widget">
            <?php  $n=0;$oldMpalel='';?>
            <?php foreach ($datMapel as $key): ?>
              <?php $member = $this->session->userdata('member') ?>
              <?php $status_akses = ($key['statusAksesLearningLine']==0 && $member==0) ? 'disabled' : 'enabled' ; ?>
              <?php $mapel=$key['mapel'] ?>

              <?php if ($n==0): ?>
                <?php $n=1; ?>
                <h5 class="widget-title line-bottom"><?=$mapel?></h5>
              <?php elseif($oldMpalel != $mapel) : ?>
                <h5 class="widget-title line-bottom"><?=$mapel?></h5>
              <?php endif ?>
              <div class="categories">
                <ul class="list list-border angle-double-right">
                  <li><a id="bab_id" onclick="getlearning(<?=$key['babID']?>)" class="<?=$status_akses ?>" href="javascript:void(0);"><?=$key['judulBab']?></a></li>
                </ul>
              </div>
              <?php $oldMpalel=$mapel; ?>
            <?php endforeach ?>

          </div>


        </div>
      </div>
    </div>
    <?php if ($datMapel==array()): ?>
      <h4 class="text-center" style="color:#f27c66;">Maaf,Pada Tingkat ini belum tersedia learning line!</h4>
    <?php endif ?>



    <script type="text/javascript">
      function getlearning(judulBab) {
        status_learning_member = $('.categories ul li a').hasClass("disabled");
        
        if(status_learning_member) {
          sweetAlert("Sayang sekali", "Anda harus menjadi member terlebih dahulu untuk mengakses bab tersebut", "warning")
          window.open(base_url+"donasi", '_blank')
        } else {
          url_ajax = base_url+"linetopik/tampungid_bab";

          var global_properties = {
            judulBab: judulBab
          };

          $.ajax({
            type: "POST",
            dataType: "JSON",
            url: url_ajax,
            data: global_properties,
            success: function(data){
              window.location.href = base_url + "linetopik/learningline";  
            },error:function(data){
              sweetAlert("Oops...", "wah, gagal menghubungkan!", "error");
            }

          });
        }
      }
    </script>