<style type="text/css">
  blockquote {
    background: #f9f9f9;
    /*margin: 1.5em 10px;*/
    padding: 0.5em 10px;
    quotes: "\201C""\201D""\2018""\2019";
    /*border: 1px solid black;*/
    border-right: 10px solid #ccc;
    margin-left: 80px;

  }
  blockquote:before {
    color: #ccc;
    content: open-quote;f
    font-size: 4em;
    line-height: 0.1em;
    margin-right: 10px;
    vertical-align: -0.4em;
  }
  blockquote p {
    display: inline;
  }

  .section {
    padding: 50px 0
  }
  .section:not(:last-child) {
    border-bottom: 1px solid #e5e5e5
  }
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
  .btn {
   /* background-color: #54b9cb;
    line-height: 53px;
    padding: 0 18px 0 0;
    display: inline-block;
    text-decoration: none;
    color: #fff;
    border-radius: 4px;
    transition: all .25s ease-in-out;
    font-size: 18px*/
  }
  .btn:hover {
    background-color: #4CA8B9
  }
  .btn.has-icon::before {
    margin-right: 18px;
    padding: 0 18px;
    border-right: 1px solid #4daabb;
    line-height: 53px
  }
</style>
<hr class="divider-color" />
<div class="row">
  <!-- Start Div container -->
  <div class="container">
    <!-- Start div macy-container -->
    <div id="macy-container">
      <?php $i=0;   $cekjudulsubbab=null;?>
      <?php foreach ($video_by_bab as $bab_video_items) {
        $subbab=$bab_video_items['judulSubBab'];

        if ($cekjudulsubbab != $subbab) { 
          if($i=='1'){
              // END div demo
            ?></div> <?php
          } ?>
          <!-- Start div demo -->
          <div class="demo">
            <strong><?=$subbab ?></strong><br>
            <span><a href="<?=base_url('video/seevideo/')?><?=$bab_video_items['videoID']?>#ini" title="Room" >
             <?=$bab_video_items['judulVideo'];?>           
           </a></span><br>
           <?php }else{ ?>

           <span><a href="<?=base_url('video/seevideo/')?><?=$bab_video_items['videoID']?>#ini" title="Room" >
             <?=$bab_video_items['judulVideo'];?>           
           </a></span><br>

           <?php } ?>
           <?php   $cekjudulsubbab=$subbab;
           $i='1'; ?>
           <?php } ?>
         </div>
         <!-- END DIV DEMO -->
       </div>
       <!-- END div macy-container -->
       <!-- END Div container -->
     </div>

     <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">{nama_sub}  <a title="" href="{sub_id}"><i class="glyphicon glyphicon-calendar"></i></a></h5>

                <ul class="list list-divider list-border">
                 <?php foreach ($videobysub as $videobysub_item): ?>
                   <li ><i class="fa fa-play mr-10 text-black-light"></i><a href="<?= base_url('index.php/video/seevideo/') ?><?= $videobysub_item->id ?>#ini"><?= $videobysub_item->judulVideo ?></a></li>
                 <?php endforeach ?>
               </ul>
             </div>
           </div>
         </div>


         <div class="col-md-8">
          <div class="blog-posts single-post">
            <article class="post clearfix mb-0">
              <div class="entry-header">
                <div class="post-thumb thumb"> 
                  <iframe width="760" height="430" src="{file}"></iframe>

                </div>

              </div>

              <div class="entry-content">
                <div class="entry-meta media no-bg no-border mt-15 pb-20">
                  <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                    <ul>
                      <li class="font-16 text-white font-weight-600">28</li>
                      <li class="font-12 text-white text-uppercase">Feb</li>
                    </ul>
                  </div>
                  <div class="media-body pl-15">
                    <div class="event-content pull-left flip">
                      <h3 class="entry-title text-white text-uppercase pt-0 mt-0"><a href="blog-single-right-sidebar.html">{judul_video}</a></h3>
                      <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> (<?=count($comments) ?>) Comments</span>                       
                    </div>
                  </div>
                </div>
                <p class="mb-15">{deskripsi}</p><br><br>
              </div>
            </article>

            <div class="author-details media-post mt-10">
              <a href="#" class="post-thumb mb-0 pull-left flip pr-20"><img class="img-thumbnail" alt="" src="{photo}"></a>
              <div class="post-right">
                <h5 class="post-title mt-0 mb-0"><a href="#" class="font-18">{nama_penulis}</a></h5>
                <p><i>{biografi}</i></p>
                <hr>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="comments-area">
              <h5 class="comments-title">Comments</h5>
              <ul class="comment-list">

               <?php foreach ($comments as $comment): ?>   
                <li>
                  <div class="media comment-author"> <a class="media-left" href="#"><img class="media-object img-thumbnail" src="http://placehold.it/75x75" alt=""></a>
                    <div class="media-body">
                      <h5 class="media-heading comment-heading"><?=$comment->namaPengguna ?> says:</h5>
                      <div class="comment-date">23/06/2014</div>
                      <p><?=$comment->isiKomen ?></p>
                    </div>
                  </li><br>
                <?php endforeach ?>

              </ul>
            </div>

            <div class="comment-box">
              <div class="row">
                <div class="col-sm-12">
                  <h5>Leave a Comment</h5>
                  <div class="row">
                    <section class="clear-fix">
                      <form class="login-form" action ="" id="formkomen" method = "post">
                        <div id="info">
                          <div class="sukses text-info text-center hide">
                            <span>Komen anda telah terkirim, tunggu moderisasi dari guru yang bersangkutan</span>
                          </div>
                          <div class="gagal text-danger text-center hide">
                            <span>Gagal memberikan komen !</span>
                          </div> 
                          <div class="lengkapi text-danger text-center hide">
                            <span>Tolong isi komentar</span>
                          </div>
                        </div>

                      </form>
                    </section>

                    <form role="form" id="comment-form">
                      <div class="col-sm-12 pt-0 pb-0">
                        <div class="form-group">
                          <input type="text" class="form-control" required="" name="contact_name" id="contact_name" placeholder="<?=$this->session->userdata('USERNAME') ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea id="isiKomen" name="isiKomen"  class="form-control" placeholder="Enter Message" rows="7"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" href="#" class="btn btn-default btn-theme-colored btn-sm">Kirim</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </section>

      <!-- sound notification -->
      <audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
      <!-- /sound notification -->
      <script src="http://macyjs.com/assets/js/macy.min.js"></script>
      <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
      <script>
        $(document).ready(function () {
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

          $("#comment-form").submit(function (e) {
            e.preventDefault();
            var isiKomen = $("#isiKomen").val();
            var videoID = <?= $this->uri->segment(3) ?>;
            if (isiKomen=="") {
              $('#info .lengkapi').removeClass('hide');
              $('#info .sukses').addClass('hide');
              $('#info .gagal').addClass('hide');
            }else{
             $.ajax({
              type: "POST",
              url: '<?php echo base_url() ?>index.php/video/addkomen',
              data: {isiKomen: isiKomen, videoID: videoID},
              dataType: "json",
              cache : false,
              success: function (data)
              {
              $('#info .sukses').addClass('show');

                if(data.success == true){

                  var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                  socket.emit('new_count_komen', { 
                    new_count_komen: data.new_count_komen
                  });

                  socket.emit('new_komen', { 
                   isiKomen: data.isiKomen,
                   videoID: data.videoID,
                   userID: data.userID,
                   UUID: data.UUID,
                   namaPengguna:data.namaPengguna,
                   date_created:data.date_created,
                   videoID:data.videoID,
                   photo:data.photo,
                   mapelID:data.mapelID
                 });

                } else if(data.success == false){
                  console.log("gagal");
                }
                    // IO
                  },
                  error: function ()
                  {
                    $('#info .lengkapi').removeClass('hide');
                    $('#info .sukses').addClass('hide');
                    $('#info .gagal').removeClass('hide');
                  }
                }); 
           }

         });
        });

      </script>
      <script type="text/javascript">
        var socket = io.connect( 'http://'+window.location.hostname+':3000' );

          // socket.on( 'new_count_komen', function( data ) {
          //   console.log(data);
          //     $( "#new_count_komen" ).html( data.new_count_komen+'<i class="ico-bell"></i>');
          //     $('#notif_audio')[0].play();

          // });

          // socket.on( 'update_count_komen', function( data ) {

          //     $( "#new_count_komen" ).html( data.update_count_komen );

          // });
          socket.on( 'new_komen', function( data ) {
            var videoID=$("[name=videoID]").val();
            var penggunaID = '<?=$this->session->userdata['id'];?>';
            var old_count_komen = parseInt($('[name=count_komen]').val());
            new_count_komen = old_count_komen + 1;
            if (penggunaID!=data.userID && videoID==data.videoID) {

             $( "#new_count_komen" ).html('Komenta <span>'+new_count_komen+'<span>');  
             $('#notif_audio')[0].play();
             $('[name=count_komen]').val(new_count_komen);
             $( "#comment-tbody" ).append('<li class="comment"><div class="comment_container clear" style="margin-right: 100px"><img src="http://placehold.it/70x70" data-at2x="http://placehold.it/70x70" alt="" class="avatar"><div class="comment-text"><p class="meta"><strong>'+data.namaPengguna+'</strong><time datetime="<?=$comment->date_created ?>"> : '+data.date_created+'</time></p><div class="description"><p>'+data.isiKomen+'</p></div></div></div></li>');
           }else if(videoID==data.videoID){
            $( "#new_count_komen" ).html('Komenta <span>'+new_count_komen+'<span>'); 
            $('[name=count_komen]').val(new_count_komen);
            $( "#comment-tbody" ).append('<li class="comment"><div class="comment_container clear" style="margin-right: 100px"><img src="http://placehold.it/70x70" data-at2x="http://placehold.it/70x70" alt="" class="avatar"><div class="comment-text"><p class="meta"><strong>'+data.namaPengguna+'</strong><time datetime="<?=$comment->date_created ?>"> : '+data.date_created+'</time></p><div class="description"><p>'+data.isiKomen+'</p></div></div></div></li>');
          }


        });


      </script>