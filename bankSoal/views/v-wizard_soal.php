<div class="row">
  <div class="col-md-12">

    <!-- START row -->
    <div class="row">
      <div class="col-md-12">
        <!-- START Panel -->
        <div class="panel panel-default">
          <!-- panel heading/header -->
          <div class="panel-heading">
            <h3 class="panel-title"><i class="ico-tshirt mr5"></i> Form Soal</h3>
          </div>
          <!--/ panel heading/header -->
          <!-- START Form Wizard data-parsley-group="order" data-parsley-required-->         
          <form class="form-horizontal form-bordered" action="" id="wizard-validate">
            <!-- Wizard Container 1 -->
            <div class="wizard-title">Atribut</div>
            <div class="wizard-container">
              <div class="form-group">
                <!-- penjelasan -->
                <div class="col-md-12">
                  <h5 class="semibold text-primary nm">Atribut Soal.</h5>
                  <p class="text-muted nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
              <div  class="form-group">
                <label class="col-sm-1 control-label">Tingkat</label>
                <div class="col-sm-4">
                  <select class="form-control" name="tingkat" id="tingkat" >
                    <option value="">Please choose</option>
                    <option value="1">Small</option>
                    <option value="2">Medium</option>
                    <option value="3">Large</option>
                    <option value="4">X-Large</option>
                  </select>
                </div>
                <label class="col-sm-2 control-label">Mata Pelajaran</label>
                <div class="col-sm-4">
                  <select class="form-control" name="mataPelajaran" id="pelajaran" >
                   <option value="">Please choose</option>
                   <option value="1">Small</option>
                   <option value="2">Medium</option>
                   <option value="3">Large</option>
                   <option value="4">X-Large</option>
                 </select>
               </div>
             </div>

             <div class="form-group">
              <label class="col-sm-1 control-label">Bab</label>
              <div class="col-sm-4">
                <select class="form-control" name="bab" id="bab" >
                    <option value="">Please choose</option>
                   <option value="1">Small</option>
                   <option value="2">Medium</option>
                   <option value="3">Large</option>
                   <option value="4">X-Large</option>
                </select>
              </div>
              <label class="col-sm-2 control-label">Subab</label>
              <div class="col-sm-4">
                <select class="form-control" name="subBabID" id="subbab" >
                    <option value="">Please choose</option>
                   <option value="1">Small</option>
                   <option value="2">Medium</option>
                   <option value="3">Large</option>
                   <option value="4">X-Large</option>
                </select>
                <span class="text-danger"><?php echo form_error('subBab'); ?></span>
              </div>
            </div>
            <!-- END Drop Down depeden -->

            <div class="form-group">
              <label class="control-label col-sm-2">Kode Soal</label>
              <div class="col-sm-8">
                <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2 ">Kesulitan</label>
              <div class="col-sm-8">
                <select name="kesulitan" class="form-control">
                  <option value="">--Silahkan Pilih Tingkat Kesulitan--</option>
                  <option value="0">Mudah</option>
                  <option value="1">Sedang</option>
                  <option value="2">Sulit</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Sumber</label>
              <div class="col-sm-8">
                <input type="text" name="sumber" class="form-control" id="sumberp" >
              </div>
            </div>
          </div>
          <!--/ Wizard Container 1 -->

          <!-- Wizard Container 2  data-parsley-group="information" data-parsley-required-->
          <div class="wizard-title">Soal</div>
          <div class="wizard-container">
            <div class="form-group">
              <div class="col-md-12">
                <h5 class="semibold text-primary nm">Soal.</h5>
                <p class="text-muted nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <!-- upload audio -->
            <div class="form-group">
              <label class="control-label col-sm-2">Audio</label>
              <div class="col-sm-8">
                <div class="col-sm-12 hidden-audio " hidden="true"> 
                  <div class="col-md-5 left"> 
                    <h6>Name: <span id="filenameAudio"></span></h6> 
                  </div> 
                  <div class="col-md-4 left"> 
                    <h6>Size: <span id="filesizeAudio"></span>Kb</h6> 
                  </div> 
                  <div class="col-md-3 bottom"> 
                    <h6>Type: <span id="filetypeAudio"></span></h6> 
                  </div>
                </div>
                <div class="col-sm-12 hidden-audio" hidden="true">
                  <audio class="col-sm-12" id="previewAudio" src="" type="audio/mpeg" controls >
                  </audio>
                </div>
                <div class="col-sm-6 mt10">
                  <label for="fileAudio" class="btn btn-sm btn-default">
                    Pilih Audio
                  </label>
                  <input  id="fileAudio" style="display:none;" type="file" name="listening" onchange="ValidateAudioInput(this);">
                  <label class="btn btn-sm btn-danger"  onclick="restAudioSoal()">Reset</label>
                </div>
              </div>
            </div>
            <!-- /upload Audio -->
            <!-- upload img soal  -->
            <div class="form-group">
              <label class="control-label col-sm-2">Gambar Soal</label>
              <div class="col-sm-8 " >
                <div class="col-sm-12">
                  <img id="previewSoal" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />
                </div>    
                <div class="col-sm-12">
                  <div class="col-md-5 left"> 
                    <h6>Name: <span id="filenameSoal"></span></h6> 
                  </div> 
                  <div class="col-md-4 left"> 
                    <h6>Size: <span id="filesizeSoal"></span>Kb</h6> 
                  </div> 
                  <div class="col-md-3 bottom"> 
                    <h6>Type: <span id="filetypeSoal"></span></h6> 
                  </div>
                </div>
                <div class="col-sm-6">
                  <label for="fileSoal" class="btn btn-sm btn-default">
                    Pilih Gambar
                  </label>
                  <input style="display:none;" type="file" id="fileSoal" name="gambarSoal" onchange="ValidateSingleInput(this);"/>
                  <label class="btn btn-sm btn-danger"  onclick="restImgSoal()">Reset</label>
                </div>
              </div>
            </div>
            <!-- /upload img soal -->

    
          </div>
          <!--/ Wizard Container 2 -->

          <!-- Wizard Container 3 -->
          <div class="wizard-title">Payment</div>
          <div class="wizard-container">
            <div class="form-group">
              <div class="col-md-12">
                <h5 class="semibold text-primary nm">Proceed to payment</h5>
                <p class="text-muted nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Card number <span class="text-danger">*</span></label>
              <div class="col-sm-5">
                <input type="text" name="card-number" class="form-control" data-parsley-group="payment" data-parsley-required data-mask="9999-9999-9999-9999">
              </div>
              <div class="col-sm-5">
                <input type="text" name="security-code" class="form-control" placeholder="Security code" data-parsley-group="payment" data-parsley-required data-parsley-maxlength="3" data-parsley-type="integer">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Name on card <span class="text-danger">*</span></label>
              <div class="col-sm-5">
                <input type="text" name="card-holder" class="form-control" data-parsley-group="payment" data-parsley-required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Expiration <span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-4">
                    <select name="month" class="form-control" data-parsley-group="payment" data-parsley-required>
                      <option value="">Month</option>
                      <option value="1">January</option>
                      <option value="2">February</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <select name="year" class="form-control" data-parsley-group="payment" data-parsley-required>
                      <option value="">Year</option>
                      <option value="1">2014</option>
                      <option value="2">2015</option>
                      <option value="3">2016</option>
                      <option value="4">2017</option>
                      <option value="5">2018</option>
                      <option value="6">2019</option>
                      <option value="7">2020</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Wizard Container 3 -->

          <!-- Wizard Container 4 -->
          <div class="wizard-title">Checkout</div>
          <div class="wizard-container">
            <div class="form-group">
              <div class="col-md-12">
                <h5 class="semibold text-primary nm">Checkout</h5>
                <p class="text-muted nm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Term Of Services</label>
              <div class="col-md-10">
                <span class="checkbox custom-checkbox">
                  <input type="checkbox" name="checkbox-tos" id="checkbox-tos">
                  <label for="checkbox-tos">&nbsp;&nbsp;I agree with this site <a href="javascript:void(0);">Term Of Services</a></label>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Notes</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="5" placeholder="Add some notes!"></textarea>
              </div>
            </div>
          </div>
          <!-- Wizard Container 4 -->
        </form>
        <!--/ END Form Wizard --> 
      </div>
      <!--/ END Panel -->
    </div>
  </div>
  <!--/ END row -->
  <hr><!-- Horizontal rule -->
</div>
</div>