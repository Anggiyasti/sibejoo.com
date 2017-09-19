


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
            <h2 class="uppercase">Prodi <?=$prodi?></h2>
            <br>

            <?php foreach ($data as $univ) : ?>
            <div>
            <span class="large" ><?=$univ['universitas']?> | <?=$univ['prodi']?>  | <?=$univ['passinggrade']?>%</span>
            </div>
            <?php endforeach ?> 
            
</div>

         
          
        </div> 
                </div> 




