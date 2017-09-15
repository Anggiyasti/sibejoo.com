
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

        

<div class="animated fadeinup delay-1">
          <div class="project-info">
            <h2 class="uppercase"></h2>
            <br>

            <?php if ($data == array()): ?>
            <h4>Tidak ada Passing Grade.</h4>
            <?php else: ?>
            <?php foreach ($data as $p): ?>
            <div>
            <p><span>Universitas :</span>  <?= $p['universitas'] ?></p>
            <p><span>Program Studi : </span> <?= $p['prodi'] ?></p>
            <p><span>Passing Grade : </span><?= $p['passinggrade'] ?>%</p>
            <br>
            <br>    
            </div>
            <?php 
            endforeach ?>
             <?php endif ?>
            
</div>

         
          
        </div> 
                </div> 




