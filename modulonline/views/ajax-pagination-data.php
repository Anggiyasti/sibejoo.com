<?php $member = $this->session->userdata('member') ?>



<!-- <div id="postList"> -->
          <div class="col-md-9 blog-pull-right">
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
                    <div class="content text-left flip p-25 pt-0" style="height: 200px;">
                      <h4 class="border-bottom-theme-color-2-2px mb-10 text-center"><?= $post['judul']?></h4>
                      <p ><?= $post['deskripsi']?></p> 
                     
                    </div>
                    <div class="content text-left flip p-25 pt-0 text-center" >
                      
                       <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" title="Download"  <?=$status_akses ?> <?=$url ?> target="_blank" style="padding:8" <?=$onclick ?>>view details</a>
                    </div>
                    
                  </div>
                </div>
                <?php endforeach; else: ?>
                      <p>Post(s) not available.</p>
                    <?php endif; ?>
                
             </div>
             <?php echo $this->ajax_pagination->create_links(); ?>
          </div>
          <!-- </div> -->