<div id="page-content" class="header-clear">
    <div id="page-content-scroll"><!--Enables this element to be scrolled --> 
<div class="decoration decoration-margins"></div>        
        <div class="content"> 
        <?php $ke=0; ?>
        <?php $universitas; ?>
        <?php foreach ($data as $univ) : ?>
            <?php $universitas=$univ['universitas']; ?>
            <?php if ($ke==0): ?>
            <!-- Header Info -->
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item dropdown-toggle bg-red-dark"><i class="fa ion-ios-home-outline"></i><em><?=$univ['universitas']?></em><i class="ion-android-add"></i></a>
                <div class="dropdown-content bg-red-light">
            <!-- /Header Info -->
                <?php $ke=1; ?>
            <?php elseif($universitas!=$olduniversitas): ?>
             <!-- Footer info -->
                </div>
            </div>
            <!-- Footer Info -->
            <!-- Header Info -->
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item dropdown-toggle bg-red-dark"><i class="fa ion-ios-home-outline"></i><em><?=$univ['universitas']?></em><i class="ion-android-add"></i></a>
                <div class="dropdown-content bg-red-light">
            <!-- /Header Info -->
            <?php endif ?>
            <form action="" method="post">
            <!-- Body Info -->
                    <a href="" class="dropdown-item"><i class="ion-ios-book-outline"></i><em><?=$univ['prodi']?>p<?=$univ['passinggrade']?>%</em><a href="<?=base_url()?>index.php/siswa/update_siswa/<?=$univ['prodi']?>/<?=$univ['universitas']?>" class="button button-round button-teal">Set Jurusan</a></a>

            <!-- /Body info -->

            
                            </form>
           <?php $olduniversitas=$universitas; ?>
           <?php endforeach ?>
            <!-- Footer info -->
                </div>
            </div>
            <!-- Footer Info -->                             
        </div> 
</div>
</div>
   