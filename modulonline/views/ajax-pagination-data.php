<?php $member = $this->session->userdata('member') ?>

<ul class="products">
  <?php if(!empty($posts)): foreach($posts as $post): ?>
<?php $status_akses = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : 'enabled' ; ?>
      <?php $url_download =  'href="'.base_url("assets/modul/".$post['url_file']).'"' ?>
      <?php $url = ($post['statusAksesFile']==1 && $member==0) ? 'disabled' : $url_download; ?>
      <?php $onclick =  ($post['statusAksesFile']==1 && $member==0) ? 'onclick="go_token()"' : 'onclick="Approved('.$post['id'].')"';  ?>

    <li class="col-sm-6">
      <div class="list-item">
        <div class="center">
         <i class="fa fa-file-pdf-o fa-5x"></i>
       </div>
       <div class="product-name">
        <a href="#"><?= $post['judul']?></a>
      </div>
      <div class="product-description">
        <div class="short-description">
          <p><?= $post['deskripsi']?></p>
        </div>
      </div>
     <a title="Download" <?=$status_akses ?> <?=$url ?> class="cws-button icon-left alt" target="_blank" style="padding:8" <?=$onclick ?>> <i class="fa fa-download <?=$status_akses ?>"></i></a>    </div>
  </li>
<?php endforeach; else: ?>
  <p>Post(s) not available.</p>
<?php endif; ?>
</ul> 
<div class="clear"></div>
<?php echo $this->ajax_pagination->create_links(); ?>

