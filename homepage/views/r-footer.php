<!-- Footer -->
  <footer class="footer divider layer-overlay overlay-dark-9 text-white" data-bg-img="http://archxpressions.com/archxpressions_wp/wp-content/themes/sheyes/images/footerbackground.jpg">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <img class="mt-5 mb-20" alt="" src="http://sibejoo.com/img/logo-sibejoo.png">
            <p>PT VORTEX BUANA EDUMEDIA</p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"></i> <a class="text-white" href="#">022-0662395</a> </li><br>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"></i> <a class="text-white" href="#">contact@sibejoo.com</a> </li> <br>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-white" href="https://sibejoo.com/">https://sibejoo.com/</a> </li>
              <li class="m-0 pl-10 pr-10"><i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-white" href="#" >Line: @wuf2783p (Sibejoo)</a></li>
              <li class="m-0 pl-10 pr-10"><i class="fa fa-globe text-theme-color-2 mr-5"></i> <a class="text-white" href="#" >Komplek Taman Mutiara Blok C1 No 11 Cibabat, Cimahi.</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h4 class="widget-title line-bottom-theme-colored-2">Jam Kerja</h4>
            <div class="opening-hours">
              <ul class="list-border">
                <li class="clearfix"> <span> Senin - Jum'at :  </span>
                  <div class="value pull-right"> 8.00 am - 16.00 pm </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="widget dark">
            <h4 class="widget-title">Useful Links</h4>
            <ul class="list angle-double-right list-border">
              <li><a href="page-about-style1.html">About Us</a></li>
              <li><a href="page-course-list.html">Layanan</a></li>
              <li><a href="page-pricing-style1.html">Price List</a></li>
              <li><a href="page-gallery-3col.html">Gallery</a></li>
              <li><a href="shop-category.html">Shop</a></li>              
            </ul>
          </div>
        </div>
      </div>
      <div class="row mt-30">
        <div class="col-md-2">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Hubungi kami</h5>
            <div>
             022-0662395 <br>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Terhubung dengan kami</h5>
            <ul class="styled-icons icon-bordered icon-sm">
              <li><a href="https://www.facebook.com/Sibejoo-239504716124473"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/sibejoo"><i class="fa fa-twitter"></i></a></li>
              <li><a href="https://www.youtube.com/user/sibejoo"><i class="fa fa-youtube"></i></a></li>
              <li><a href="https://www.instagram.com/sibejoo/"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-md-offset-2">
          <div class="widget dark">
            <h5 class="widget-title mb-10">Berlangganan</h5>
            <!-- Mailchimp Subscription Form Starts Here -->
            <form id="mailchimp-subscription-form-footer" class="newsletter-form">
              <div class="input-group">
                <input type="email" value="" name="EMAIL" placeholder="Email Anda" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer">
                <span class="input-group-btn">
                  <button data-height="45px" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14" type="submit">Berlangganan</button>
                </span>
              </div>
            </form>
            <!-- Mailchimp Subscription Form Validation-->
            <script type="text/javascript">
              $('#mailchimp-subscription-form-footer').ajaxChimp({
                  callback: mailChimpCallBack,
                  url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
              });

              function mailChimpCallBack(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#mailchimp-subscription-form-footer'),
                      $response = '';
                  $mailchimpform.children(".alert").remove();
                  if (resp.result === 'success') {
                      $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  } else if (resp.result === 'error') {
                      $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                  }
                  $mailchimpform.prepend($response);
              }
            </script>
            <!-- Mailchimp Subscription Form Ends Here -->
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright &copy;2017 Sibejoo. All Rights Reserved</p>
          </div>
          <div class="col-md-6 text-right">
            <div class="widget no-border m-0">

          </div>
        </div>
      </div>
    </div>
  </footer>