

<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="font-28 text-black">{judul_header2}</h3>
    </div>
</div>

<style type="text/css">
    /*.col-md-2{
        margin: 20px;
        padding: 0;
    }*/


    .row{position: relative;}
    .post-list{ 
        margin-bottom:20px;
    }
    div.list-item {
        border-bottom: 4px solid #7ad03a;
        margin: 25px 15px 2px;
        padding: 20px 12px;
        /*background-color:#F1F1F1;*/
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        min-height: 150px;
        /*width: 29%;*/
        float: left;
    }
    div.list-item p {
        margin: .5em 0;
        padding: 2px;
        font-size: 13px;
        line-height: 1.5;
    }
    .list-item a {
        text-decoration: none;
        padding-bottom: 2px;
        color: #0074a2;
        -webkit-transition-property: border,background,color;
        transition-property: border,background,color;-webkit-transition-duration: .05s;
        transition-duration: .05s;
        -webkit-transition-timing-function: ease-in-out;
        transition-timing-function: ease-in-out;
    }
    .list-item a:hover{text-decoration:underline;}
    .list-item h3{font-size:25px; font-weight:bold;text-align: left;}

    /* search & filter */
    .post-search-panel input[type="text"]{
        width: 220px;
        height: 28px;
        color: #333;
        font-size: 16px;
    }
    .post-search-panel select{
        height: 34px;
        color: #333;
        font-size: 16px;
    }

    /* Pagination */
    div.pagination {
        font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:2px;
        margin: 20px 10px;
        float: right;
    }

    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: black;
        text-decoration: none; /* no underline */
        color: #fff;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: grey;
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

    .clear{
        clear: both;
    }

</style>
<script>
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/edudrive/ajaxPaginationDataSMA/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#postList').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
</script>
<section>

     <div id="page-meta" class="group">

    <div class="woocommerce-result-count">
     <div class="col-md-6"></div>
    <div class="col-md-6"> </div>



 </div>
</div>
      <div class="container">
        <div class="row">
          
          <div id="postList">

          <div class="col-md-9 blog-pull-right" >


             <div class="row">
              <?php if(!empty($posts)): foreach($posts as $post): ?>
                      <?php $status_akses = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : 'enabled' ; ?>
                      <?php $url_download =  'href="'.base_url("assets/modul/".$post['url_file']).'"' ?>
                      <?php $url = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : $url_download; ?>
                      <?php $onclick =  ($post['statusAksesFile']==1 && $member==0) ? 'onclick="go_token()"' : 'onclick="Approved('.$post['id'].')"';  ?>
                <div class="col-sm-6 col-md-4">
                  <div class="service-block bg-white">
                      
                    <div class="thumb text-center"> <img alt="featured project" src="<?=base_url('assets/image/acrobat.png') ?>" width="170px">
                    </div>
                    <div class="content text-left flip p-25 pt-0" style="height: 250px;">
                      <h4 class="border-bottom-theme-color-2-2px mb-10 text-center"><?= $post['judul']?></h4>
                      <p ><?= $post['deskripsi']?></p> 
                     
                    </div>
                    <div class="content text-left flip p-25 pt-0 text-center" >
                      
                       <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" title="Download"  <?=$status_akses ?> <?=$url ?> target="_blank" style="padding:8" <?=$onclick ?>>Download</a>
                    </div>
                    
                  </div>
                </div>
                <?php endforeach; else: ?>
                      
                    
                <div class="col-sm-6 col-md-4">
                  <div class="service-block bg-white">
                      
                    <p>Post(s) not available.</p>
                    
                  </div>
                </div>
                <?php endif; ?>
                
                
             </div>
             <?php echo $this->ajax_pagination->create_links(); ?>
          </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              
              <div class="widget" style="margin-top: 30px;">
                <h5 class="widget-title line-bottom" >SEARCH</h5>
                <div class="search-form">
                  <form>
                    <input type="text" id="keywords" placeholder="Masukan judul file yang dicari" onkeyup="searchFilter()" class="form-control"/>
                  </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">KATEGORI</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                    <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/edudrive/modulsd') ?>">Sekolah Dasar<span> (SD) </span></a></li>
                    <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/edudrive/modulsmp') ?>">Sekolah Menengah Pertama<span> (SMP) </span></a></li>
                    <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/edudrive/modulsma') ?>">Sekolah Menengah Atas <span> (SMA) </span></a></li>
                    <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/edudrive/modulsmaipa') ?>">Sekolah Menengah Atas - IPA</a></li>
                    <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/edudrive/modulsmaips') ?>">Sekolah Menengah Atas - IPS</a></li>
                  </ul>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title line-bottom">DOWNLOAD TERATAS</h5>
                <div class="latest-posts" >
                  <?php foreach($downloads as $post){ ?>
                  <?php $status_akses = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : 'enabled' ; ?>
                  <?php $url_download =  'href="'.base_url("assets/modul/".$post['url_file']).'"' ?>
                  <?php $url = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : $url_download; ?>
                  <?php $onclick =  ($post['statusAksesFile']==1 && $member==0) ? 'onclick="go_token()"' : 'onclick="Approved('.$post['id'].')"';  ?>
                  <article class="post media-post clearfix pb-0 mb-10">
                    <div class="post-right" >
                      <a title="Download" <?=$url ?> class="cws-button icon-left alt <?=$status_akses ?>" <?=$onclick ?> <?=$url ?> target="_blank" style="padding:8;"> <i class="fa fa-download btn <?=$status_akses ?>"></i></a>
                      <?=$post['judul'] ?>
                    </div>
                  </article>
                   <?php }; ?>
                </div>
              </div>
            
            </div>
          </div>
        </div>
        
      </div>
    </section>
<hr class="divider-color">

<script>
    function Approved(butId){
        $.ajax({
          method: "POST",
          url: base_url+"index.php/modulonline/tambahdownload/"+butId,
          data: { rowid: butId },
          dataType:"text",
          success:function(data){
              // alert(data);
          },
          error:function (data){
              // alert("failed");
          }
      });
    }
    function go_token(){
  swal('Oops','Maaf anda harus menjadi member untuk mengunduh file ini','warning');
}
</script>

