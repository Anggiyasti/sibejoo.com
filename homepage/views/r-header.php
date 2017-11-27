<!-- Header -->
<header id="header" class="header">
  <div class="header-top bg-theme-color-2 sm-text-center p-0">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="widget no-border m-0">
            <ul class="list-inline font-13 sm-text-center mt-5">
              <li>
                <a class="text-white" href="telp:(022)87805676"><i class="fa fa-phone"></i> (022)87805676</a>
              </li>
              <li>
                <a href="mailto:contact@sibejoo.com" class="text-white" href="#"><i class="fa fa-envelope-o"></i> info@sibejoo.com</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
            <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
              <li><a href="https://www.facebook.com/Sibejoo-239504716124473"><i class="fa fa-facebook text-white"></i></a></li>
              <li><a href="https://twitter.com/sibejoo"><i class="fa fa-twitter text-white"></i></a></li>
              <li><a href="https://www.instagram.com/sibejoo"><i class="fa fa-instagram text-white"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-middle p-0 bg-lightest xs-text-center">
    <div class="container pt-0 pb-0">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-5">
          <div class="widget no-border m-0">
            <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="<?=base_url()?>" onclick=""><img src="http://sibejoo.com/img/logo-sibejoo.png" alt=""></a>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-gray text-uppercase">Hubungi Kami Sekarang!</a>
                <h5 class="font-14 m-0"> +(022) 87805676</h5>
              </li>
            </ul>
          </div>
        </div>  
        <div class="col-xs-12 col-sm-4 col-md-3">
          <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-gray text-uppercase">Kita Buka</a>
                <h5 class="font-13 text-black m-0"> Senin-Sabtu 8:00-16:00</h5>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-nav">
    <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
      <div class="container">
        <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
          <ul class="menuzord-menu">
            <li class="">
              <a class="home" href="<?=base_url()?>">Beranda</a>
            </li>
            <li>
              <a href="#about">Tentang Kami</a>              
            </li>


            <li>
              <a class="team" href="#team">Tim</a>
            </li>

            <li>
              <a class="testimonials" href="#testimonials">Testimoni</a>
            </li>
            <li><a href="javascript:void(0)">Layanan</a>
              <div class="megamenu none" style="right: 0px; display: block;">
                <div class="megamenu-row">
                  <div class="col3">
                    <ul class="list-unstyled list-dashed">
                      <li><a href="<?=base_url("/layanan/tryout") ?>" target="_blank"><img src="<?=base_url('assets/image/menu/tryout.png') ?>"></a></li>
                      <li class="text-center"><b>Latihan UN, Lathian SBMPTN atau TryOut yang lain secara online.</b></li>
                    </ul>
                  </div>
                  <div class="col3">
                    <ul class="list-unstyled list-dashed">
                      <li><a href="<?=base_url("/layanan/learningline") ?>" target="_blank"><img src="<?=base_url('assets/image/menu/learningline.png') ?>"></a></li>
                      <li class="text-center"><b>Memahami materi pelajaran jadi lebih mudah dengan mengikuti misi belajar bersama Master Teacher.</b></li>
                    </ul>
                  </div>
                  <div class="col3">
                    <ul class="list-unstyled list-dashed">
                      <li><a href="<?=base_url("/layanan/edudrive") ?>" target="_blank"><img src="<?=base_url('assets/image/menu/edudrive.png') ?>"></a></li>
                      <li class="text-center"><b>Kumpulan modul-modul yang mampu nemenin belajar, biar lebih paham!.</b></li>
                    </ul>
                  </div>
                  <div class="col3">
                    <ul class="list-unstyled list-dashed">
                      <li><a href="<?=base_url("/layanan/video") ?>" target="_blank"><img src="<?=base_url('assets/image/menu/video.png') ?>"></a></li>
                      <li class="text-center"><b>Video Belajar yang lengkap, asyik dan mudah dipahami.</b></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            
            <li>
              <a href="<?=base_url('index.php/register')?>">Daftar</a>
            </li>
          </ul>
          <ul class="pull-right flip hidden-sm hidden-xs">
            <li>
              <!-- Modal: Book Now Starts -->
              <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15" href="<?=base_url('index.php/login')?>">Masuk</a>
              <!-- Modal: Book Now End -->
            </li>
          </ul>
          <div id="top-search-bar" class="collapse">
            <div class="container">
              <form role="search" action="#" class="search_form_top" method="get">
                <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                <span class="search-close"><i class="fa fa-search"></i></span>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>