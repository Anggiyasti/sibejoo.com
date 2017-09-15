<!-- Page Content -->
      <div id="content" class="page">

        <!-- Toolbar -->
        <div id="toolbar" class="primary-color">
          <div class="open-left" id="open-left" data-activates="slide-out-left">
            <i class="ion-android-menu"></i>
          </div>
          <span class="title">Passing Grade</span>
          <div class="open-right" id="open-right" data-activates="slide-out">
            <i class="ion-android-person"></i>
          </div>
        </div>
        
        <!-- Article Content -->
        <div class="animated fadeinup delay-1">
          <div class="page-content">
            <!-- With Left Icon -->
          <h4 class="p-20">Mata Pelajaran</h4>
          <form action="<?= base_url() ?>index.php/workout1/next" method="post">
          <ul class="faq collapsible animated fadeinright delay-3" data-collapsible="accordion">
          <?php $ke=0; ?>

            <?php $universitas; ?>
            <?php foreach ($data as $univ) : ?>
                <?php $universitas=$univ['universitas']; 
                                                ?>
                <?php if ($ke==0): ?>
            <!-- Header Info -->
            <li>
              <div class="collapsible-header"><i class="ion-android-options"></i><?=$univ['universitas']?></div>
              <div class="collapsible-body"></div>
            <!-- /Header Info -->
            <?php $ke=1; ?>
            <?php elseif($universitas!=$olduniversitas): ?>
            <!-- Footer info -->
            </li>
            <!-- Footer Info -->
            <!-- Header Info -->            
            <li>
              <div class="collapsible-header"><i class="ion-android-cloud"></i><?=$univ['universitas']?></div>
               <!-- /Header Info -->
              <?php endif ?>
              <!-- Body Info -->
              
                <div class="collapsible-body"><p></i><?=$univ['prodi']?>&nbsp&nbsp|&nbsp&nbsp<?=$univ['passinggrade']?>%<a href="<?=base_url()?>index.php/siswa/update_siswa/<?=$univ['prodi']?>/<?=$univ['universitas']?>" class="waves-effect waves-light btn primary-color" style="margin-left: 15px;">Set Prodi</a></p></div>
              
              <!-- /Body info -->
              <?php $olduniversitas=$universitas; ?>
           <?php endforeach ?>
              <!-- Footer info -->

            </li>
             <!-- Footer Info --> 
          </ul>          
          </form>
          </div>
        </div> 
      
         
      </div> <!-- End of Page Content -->