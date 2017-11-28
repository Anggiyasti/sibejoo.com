<!-- START row -->
<div class="row">
  <div class="col-md-12">
    <!-- START Panel -->
    <div class="panel panel-default">
      <!-- panel heading/header -->
      <div class="panel-heading" style=" background-image: url('<?=base_url()?>assets/image/pattern/maze-black.png');color:#F2ECEC;background-color: #7BCADB">
        <h3 class="panel-title"><i class="ico-file4 mr5"></i> Form Soal</h3>
      </div>
      <!--/ panel heading/header -->
      <!-- START Form Wizard data-parsley-group="order" data-parsley-required-->         
      <form class="form-horizontal form-bordered" action="" id="wizard">
        <!-- Wizard Container 1 -->
        <div class="wizard-title">Atribut</div>
        <div class="wizard-container">
          <div class="form-group">
            <!-- penjelasan -->
            <div class="col-md-12">
              <h5 class="semibold text-primary nm">Atribut Soal.</h5>
              <p class="text-muted nm">Atribut soal Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</p>
              <p class="text-muted nm" >*Jika tingkat kesulitan tidak diisi maka secara default mudah.</p>
              <p class="text-danger nm">*Untuk penulisan <b>kode soal</b> silahkan ditentukan sendiri tetapi harus <b>unik</b> dan <b>memiliki arti tersendiri</b> agar mempermudah pengelompokan data dan pencarian soal!</p>
            </div>
          </div>
          <div  class="form-group">
            <label class="col-sm-2 control-label">Tingkat</label>
            <div class="col-sm-4">
              <select class="form-control" name="tingkat" id="tingkat" data-parsley-group="order" data-parsley-required>
                <option value="">--Tingkat--</option>
              </select>
            </div>
            <label class="col-sm-2 control-label">Mata Pelajaran</label>
            <div class="col-sm-4">
              <select class="form-control" name="mataPelajaran" id="pelajaran" >
               <option value="">--Matapelajaran--</option>
             </select>
           </div>
         </div>

         <div class="form-group">
          <label class="col-sm-1 control-label">Bab</label>
          <div class="col-sm-4">
            <select class="form-control" name="bab" id="bab" >
              <option value="">--Bab--</option>
            </select>
          </div>
          <label class="col-sm-2 control-label">Subab</label>
          <div class="col-sm-4">
            <select class="form-control" name="subBabID" id="subbab" >
              <option value="">--Subbab--</option>
            </select>
            <span class="text-danger"><?php echo form_error('subBab'); ?></span>
          </div>
        </div>
        <!-- END Drop Down depeden -->

        <div class="form-group">
          <label class="control-label col-sm-1 pl0 ml0" >Kode Soal</label>
          <div class="col-sm-10">
            <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>" >
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2 ">Kesulitan</label>
          <div class="col-sm-8">
            <select name="kesulitan" class="form-control">
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
            <p class="text-muted nm">Pada soal bisa menambahkan file gambar dan file audio sesuai kebutuhan dan untuk penulisan <b><u>simbol matematika</u></b> silahkan menggunkan <b><u>latex</u></b>. <a>Klik disini untuk panduan penulisan latex!</a></p>
            <p class="text-danger nm">*Untuk file audio harus berupa <b>".mp3"</b> dan ukuran maksimal <b>50mb</b>!</p>
            <p class="text-danger nm">*Untuk file gambar soal harus berupa <b>".jpg", ".jpeg", ".bmp", ".gif", ".png"</b> dan ukuran maksimal <b>500kb</b>!</p>
            <p class="text-danger nm">*Untuk posisi gambar soal akan selalu ada diatas soal maka silahkan sesuaikan soal dengan posisi gambar soal!</p>
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
        <!-- Soal -->
        <div class="form-group">
          <label class="control-label col-sm-2">Soal</label>
          <div class="col-sm-10">
            <textarea class="" name="soal" id="editor-soal" cols="60" rows="10"></textarea>
          </div>
        </div>
        <!--/soal-->
      </div>
      <!--/ Wizard Container 2 -->

      <!-- Wizard Container 3 -->
      <div class="wizard-title">Pilihan Jawaban</div>
      <div class="wizard-container">
         <div class="form-group">
          <div class="col-md-12">
            <h5 class="semibold text-primary nm">Pilihan Jawaban.</h5>
            <p class="text-muted nm">Pada pilihan jawaban kita bisa memilih jumlah pilihan 4 atau 5 pilihan jawaban. Dan untuk tipe pilihan jawaban bisa memilih tipe text, gambar, atau text dan gambar </p>
            <p class="text-danger mb0">*Untuk file gambar soal harus berupa <b>".jpg", ".jpeg", ".bmp", ".png"</b> dan ukuran maksimal <b>500kb</b>!</p>
            <p class="text-muted text-danger nm">*Jika pilihan jawaban ingin ditampilkan <b>random</b>, silahkan <b>ceklish kotak random</b> dibawah step ini!</p>
          </div>
        </div>
       <!-- setting pilihan -->
       <div class="form-group">
        <label class="control-label col-sm-2">Jumlah Pilihan</label>
        <div class="col-sm-8">
          <div class="btn-group" data-toggle="buttons" >
            <label class="btn btn-teal btn-outline " id="empatpil">
              <input type="radio" name="opjumlah" value="4" autocomplete="off" > 4 Pilihan
            </label>
            <label class="btn btn-teal btn-outline active" id="limapil">
              <input type="radio" name="opjumlah"  value="5" autocomplete="off" checked="true"> 5 Pilihan
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2">Jenis Pilihan</label>
        <div class="col-sm-8">
          <div class="btn-group" data-toggle="buttons" >
            <label class="btn btn-teal btn-outline active " id="text">
              <input type="radio" name="op-jawaban"  value="text" autocomplete="off" checked="true"> Text
            </label>
            <label class="btn btn-teal btn-outline" id="gambar">
              <input type="radio" name="op-jawaban"  value="gambar" autocomplete="off"> Gambar
            </label>
            <label class="btn btn-teal btn-outline" id="text-gambar">
              <input type="radio" name="op-jawaban"  value="text_gambar" autocomplete="off"> Text & Gambar
            </label>
          </div>
        </div>
      </div>
      <!-- /setting pilihan -->
      <!-- pilihan jawaban -->
      <!-- Start input jawaban A -->
      <div class="form-group">
        <label class="control-label col-md-2" >
         Pilihan A
        </label>
        <div class="col-md-10 pl0"  >
          <!-- input gambar pilihan A -->
          <div class="col-sm-12 pt0 mb10 pilgambar" >
            <!-- preview gambar soal pilihan A -->
            <div class="col-sm-12 pl0 mb10 info-img-1" hidden="true">
              <img id="previewA" style="max-width: 497px; max-height: 381px;  " class="rounded" src="" alt="" width="" />
            </div>
            <!-- /preview gambar soal pilihan A -->                                     
            <!-- info file gambar soal pilihan A {nama file,ukuran, dan type file} -->
            <div class="col-sm-12 pl0 mb5 info-img-1" hidden="true">
                <p class="text-primary nm">Name: <span id="filenameA">-</span> |
               Size: <span id="filesizeA">-</span>Kb | Type: <span id="filetypeA">-</span></p> 
            </div>
            <!-- /info file gambar soal pilihan A-->
            <!-- button upload file gambar soal pilihan A  -->
            <div class="col-sm-12 ml0 pl0 pt0 mt0" id="btn-up-1">
              <label for="fileA" class="btn btn-sm btn-default">
                Pilih Gambar
              </label>
              <input style="display:none;" type="file" id="fileA" name="gambar1" onchange="ValidateSingleInput(this);"/>
            </div>
            <!-- /button upload file gambar soal pilihan A  -->
              <!-- button upload file gambar soal pilihan A  -->
            <div class="col-sm-12 ml0 pl0 pt0 mt0" id="btn-re-1" hidden="true">
             <span class="btn btn-danger" onclick="remove_img(1);">Remove Gambar</span>
            </div>
            <!-- /button upload file gambar soal pilihan A  -->
          </div>
          <!-- /input gambar pilihan A -->
          <!-- Start input text A -->
          <div class="col-sm-12 piltext mt0">
            <textarea name="a" class="form-control" id="editor-1"></textarea>
          </div>
          <!-- END input text A --> 
        </div>
      </div>
      <!-- END input jawaban A -->
      <!-- Start input jawaban B -->
      <div class="form-group">
        <label class="control-label col-sm-2">
          Pilihan B
        </label>
        <!-- Start input text B -->
        <div class="col-sm-8 piltext">
          <textarea name="b" class="form-control" id="editor-2"></textarea>
        </div>
        <!-- END input text B -->
        <!-- input gambar pilihan B -->
        <div class="col-sm-8 pilgambar" hidden="true">
          <!-- preview gambar soal pilihan B -->
          <div class="col-sm-12">
            <img id="previewB" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
          </div>
           <!-- /preview gambar soal pilihan B -->                                     
          <!-- info file gambar soal pilihan B {nama file,ukuran, dan type file} -->
          <div class="col-sm-12">
            <div class="col-md-5 left"> 
              <h6>Name: <span id="filenameB"></span></h6> 
            </div> 
            <div class="col-md-4 left"> 
              <h6>Size: <span id="filesizeB"></span>Kb</h6> 
            </div> 
            <div class="col-md-3 bottom"> 
              <h6>Type: <span id="filetypeB"></span></h6> 
            </div>
          </div>
           <!-- /info file gambar soal pilihan B-->
           <!-- button upload file gambar soal pilihan B  -->
          <div class="col-sm-12">
            <label for="fileB" class="btn btn-sm btn-default">
              Pilih Gambar
            </label>
            <input style="display:none;" type="file" id="fileB" name="gambar2" onchange="ValidateSingleInput(this);"/>
          </div>
           <!-- /button upload file gambar soal pilihan B  -->
        </div>
        <!-- /input gambar pilihan B -->
      </div>
      <!-- END input jawaban B -->
      <!-- Start input jawaban C -->
      <div class="form-group">
        <label class="control-label col-sm-2">
          Pilihan C
        </label>
        <!-- Start input text C -->
        <div class="col-sm-8 piltext">
          <textarea name="c" class="form-control" id="editor-3"></textarea>
        </div>
        <!-- END input text C -->
        <!-- input gambar pilihan C -->
        <div class="col-sm-8 pilgambar" hidden="true">
          <!-- preview gambar soal pilihan C -->
          <div class="col-sm-12">
            <img id="previewC" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
          </div>
          <!-- /preview gambar soal pilihan C -->                                     
          <!-- info file gambar soal pilihan C {nama file,ukuran, dan type file} -->
          <div class="col-sm-12">
            <div class="col-md-5 left"> 
              <h6>Name: <span id="filenameC"></span></h6> 
            </div> 
            <div class="col-md-4 left"> 
              <h6>Size: <span id="filesizeC"></span>Kb</h6> 
            </div> 
            <div class="col-md-3 bottom"> 
              <h6>Type: <span id="filetypeC"></span></h6> 
            </div>
          </div>
          <!-- /info file gambar soal pilihan C-->
          <!-- button upload file gambar soal pilihan C  -->
          <div class="col-sm-12">
            <label for="fileC" class="btn btn-sm btn-default">
              Pilih Gambar
            </label>
            <input style="display:none;" type="file" id="fileC" name="gambar3" onchange="ValidateSingleInput(this);"/>
          </div>
          <!-- /button upload file gambar soal pilihan C  -->
        </div>
        <!-- /input gambar pilihan C -->
      </div>
      <!-- END input jawaban C -->     
      <!-- Start input jawaban D -->
      <div class="form-group">
        <label class="control-label col-sm-2">
          Pilihan D
        </label>
        <!-- Start input text D -->
        <div class="col-sm-8 piltext">
          <textarea name="d" class="form-control" id="editor-4"></textarea>
        </div>
        <!-- END input text D -->
        <!-- input gambar pilihan D -->
        <div class="col-sm-8 pilgambar" hidden="true">
          <!-- preview gambar soal pilihan D -->
          <div class="col-sm-12">
            <img id="previewD" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
          </div>
          <!-- /preview gambar soal pilihan D -->                                     
          <!-- info file gambar soal pilihan D {nama file,ukuran, dan type file} -->
          <div class="col-sm-12">
            <div class="col-md-5 left"> 
              <h6>Name: <span id="filenameD"></span></h6> 
            </div> 
            <div class="col-md-4 left"> 
              <h6>Size: <span id="filesizeD"></span>Kb</h6> 
            </div> 
            <div class="col-md-3 bottom"> 
              <h6>Type: <span id="filetypeD"></span></h6> 
            </div>
          </div>
          <!-- /info file gambar soal pilihan D-->
          <!-- button upload file gambar soal pilihan D  -->
          <div class="col-sm-12">
            <label for="fileD" class="btn btn-sm btn-default">
              Pilih Gambar
            </label>
            <input style="display:none;" type="file" id="fileD" name="gambar4" onchange="ValidateSingleInput(this);"/>
          </div>
          <!-- /button upload file gambar soal pilihan D  -->
        </div>
        <!-- /input gambar pilihan D -->
      </div>
      <!-- END input jawaban D -->
       <!-- Start input jawaban E -->
      <div class="form-group" id="pilihan">
        <label class="control-label col-sm-2">
          Pilihan E
        </label>
        <!-- Start input text E -->
        <div class="col-sm-8 piltext">
          <textarea name="e" class="form-control" id="editor-5"></textarea>
        </div>
        <!-- END input text E -->
        <!-- input gambar pilihan E -->
        <div class="col-sm-8 pilgambar" hidden="true">
          <!-- preview gambar soal pilihan E -->
          <div class="col-sm-12">
            <img id="previewE" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" width="" />
          </div>
          <!-- /preview gambar soal pilihan E -->                                     
          <!-- info file gambar soal pilihan E {nama file,ukuran, dan type file} -->
          <div class="col-sm-12">
            <div class="col-md-5 left"> 
              <h6>Name: <span id="filenameE"></span></h6> 
            </div> 
            <div class="col-md-4 left"> 
              <h6>Size: <span id="filesizeE"></span>Kb</h6> 
            </div> 
            <div class="col-md-3 bottom"> 
              <h6>Type: <span id="filetypeE"></span></h6> 
            </div>
          </div>
           <!-- /info file gambar soal pilihan E-->
           <!-- button upload file gambar soal pilihan E  -->
          <div class="col-sm-12">
            <label for="fileE" class="btn btn-sm btn-default">
              Pilih Gambar
            </label>
            <input style="display:none;" type="file" id="fileE" name="gambar5" onchange="ValidateSingleInput(this);"/>
          </div>
           <!-- /button upload file gambar soal pilihan E  -->
        </div>
        <!-- /input gambar pilihan E -->
      </div>
      <!-- END input jawaban E -->
      <!-- /pilihan jawaban -->
      <!-- setting pilihan benar -->
      <div class="form-group">
        <label class="control-label col-sm-2">Jawaban Benar</label>
        <div class="col-sm-8">
          <select name="jawaban" class="form-control">
            <option value="">--Silahkan Pilih Jawaban Benar--</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E" id="pilihanop">E</option>
          </select>
        </div>
      </div>
      <!-- /setting pilihan benar -->
      <!-- setting rendom pilihan jawaban-->
      <div class="form-group mt0 pt5 mb0 pb5" style="background-color: #FFFFFF;" >
        <div class="col-sm-6 col-sm-offset-4">
          <div class="checkbox custom-checkbox" style="color: #C60000">  
            <input type="checkbox" name="random" id="idrand" value="1">  
            <label class="text-danger" for="idrand"><b>&nbsp;&nbsp;Random pilihan jawaban?</b></label>   
          </div>
        </div>
      </div>
      <!-- /setting rendom pilihan jawaban  -->
    </div>
    <!--/ Wizard Container 3 -->
    <!-- Wizard Container 4 -->
    <div class="wizard-title">Pembahasan</div>
    <div class="wizard-container">
       <div class="form-group">
        <div class="col-md-12">
          <h5 class="semibold text-primary nm">Pembahasan Soal.</h5>
          <p class="text-muted nm">Dalam pembahasan soal terdiri dari dua media pembahasan yaitu pembahasan berupa text atau video.</p>
          <p class="text text-danger">*Jika belum ada pembahasan soal,silahkan lewati step ini!</p>
        </div>
      </div>
      <!-- Start Pilihan Pembahasan  -->
      <div class="form-group">
        <label class="control-label col-sm-2">Media Pembahasan</label>
        <div class="col-sm-8">
          <div class="btn-group" data-toggle="buttons" >
            <!-- button untuk memilih pembahasan berupa text -->
            <label class="btn btn-teal btn-outline active " id="m-tex">
              <input type="radio" name="opmedia" value="text"  autocomplete="off" checked="true"> Text
            </label>
            <!-- button untuk memilih pembahasan berupa video -->
            <label class="btn btn-teal btn-outline" id="m-vido">
              <input type="radio" name="opmedia" value="video" autocomplete="off"> Video
            </label>
          </div>
        </div>
      </div>
      <!-- End Pilihan Pembahasan-->
      <!-- Start Upload Gambar Pembahasan -->
      <div class="form-group text-pembahasan">
        <label class="control-label col-sm-2">Gambar Pembahasan</label>
        <div class="col-sm-8 ">
          <!-- Preview gambar pembahasan -->
          <div class="col-sm-12">
            <img id="previewPembahasan" style="max-width: 497px; max-height: 381px;  " class="img" src="" alt="" />
          </div>
          <!-- /Preview gambar pembahasan -->
          <!--  Info file gambar pembahasan -->
          <div class="col-sm-12">
            <div class="col-md-5 left"> 
              <h6>Name: <span id="filenamePembahasan"></span></h6> 
            </div> 
            <div class="col-md-4 left"> 
              <h6>Size: <span id="filesizePembahasan"></span>Kb</h6> 
            </div> 
            <div class="col-md-3 bottom"> 
              <h6>Type: <span id="filetypePembahasan"></span></h6> 
            </div>
          </div>
          <!--  /Info file gambar pembahasan -->
          <!-- Button upload gambar pembahasan -->
          <div class="col-sm-12">
            <label for="filePembahasan" class="btn btn-sm btn-default">
              Pilih Gambar
            </label>
            <input style="display:none;" type="file" id="filePembahasan" name="gambarPembahasan" onchange="ValidateSingleInput(this);"/>
            <label class="btn btn-sm btn-danger"  onclick="restImgPembahasan()">Reset</label>
          </div>
          <!-- /Button upload gambar pembahasan -->
        </div>
      </div>
      <!-- End Upload Gambar Pembahsan -->
      <!-- Start Editor Pembahasan -->
      <div  class="form-group text-pembahasan">
          <label class="control-label col-sm-2">Pembahasan</label>
          <div class="col-sm-10">
            <textarea  name="editor-pembahasan" class="form-control"></textarea>
          </div>
      </div>
      <!-- End Editor Pembahasan -->
    </div>
    <!-- /Wizard Container 4 -->
    <!-- Wizard Container 5 -->
    <div class="wizard-title">Priview Soal</div>
    <div class="wizard-container">
      <div class="form-group">
        <div class="col-md-12">
          <h5 class="semibold text-primary nm">Priview Soal.</h5>
          <p class="text-muted nm">Ini adalah priview soal yag akan di tampilkan ke siswa. Untuk urutan pilihan jawaban akan menyesuaikan dengan status rendom atau tidak.</p><p class="text text-danger">*Jika <b>soal belum siap</b> digunakan mohon untuk <b>tidak di publish</b> dengan cara tidak mencentang kotak publish dibawah step ini!</p>
        </div>
      </div>
      <!--  background-image: url("paper.gif") -->
      <div class="form-group panel panel-teal mt0 pt0 mb0 pb0">
        <div class="panel-heading" style="background-color: #CACBCB" id="prev-header">
        <!-- here info kode soal & sumber soal -->
        </div>
        <div class="panel-body" style="background-color: #EDEDED">
          <div class="text-center" id="prev-soal-img" hidden="true">
            <img src="" class="rounded mx-auto d-block" style="max-width: 300px; max-height: 300px;" id="previewSoal2">
            <hr>
          </div>
          <div id="prev-soal"></div>
          <ol type="A">
            <li id="prev-pil-a"><p>asdasd</p><img src="<?=base_url('assets/image/soal/test.jpg')?>" class="img-thumbnail mb5" style="max-width: 100px; max-height: 100px;" hidden="true"></li>
            <li id="prev-pil-b"><p>asdasd</p><img src="<?=base_url('assets/image/soal/test.jpg')?>" class="img-thumbnail mb5" style="max-width: 100px; max-height: 100px;" hidden="true"></li>
            <li id="prev-pil-c"><p>asdasd</p><img src="<?=base_url('assets/image/soal/test.jpg')?>" class="img-thumbnail mb5" style="max-width: 100px; max-height: 100px;" hidden="true"></li>
            <li id="prev-pil-d"><p>asdasd</p><img src="<?=base_url('assets/image/soal/test.jpg')?>" class="img-thumbnail mb5" style="max-width: 100px; max-height: 100px;" hidden="true"></li>
            <li id="prev-pil-e"><p>asdasd</p><img src="<?=base_url('assets/image/soal/test.jpg')?>" class="img-thumbnail mb5" style="max-width: 100px; max-height: 100px;" hidden="true"></li>
          </ol>
          <hr>
          <p id="prev-jawab">Jawaban yang benar adalah nininini+2*3</p>
        </div>
        <div class="panel-footer pb0 mb0" style="background-color: #CACBCB; border: 0.1px solid #82CAAB" id="prev-attr">
          <!-- here info atribut soal -->
        </div>
      </div>
      <!-- setting rendom pilihan jawaban dan publish soal -->
      <div class="form-group mt0 pt5 mb0 pb5" style="background-color: #FFFFFF;" > 
        <div class="col-sm-6 col-sm-offset-5">
          <div class="checkbox custom-checkbox">  
            <input type="checkbox" name="publish" id="gift" value="1">  
            <label class="text-muted text-danger nm" for="gift"><b>&nbsp;&nbsp;Publish Soal?</b></label>   
          </div>
        </div>
      </div>
      <!-- /setting rendom pilihan jawaban dan publish soal -->
    </div>
    <!-- Wizard Container 5 -->
  </form>
  <!--/ END Form Wizard --> 
</div>
<!-- Editor -->
<!-- /Editor -->
<!--/ END Panel -->
</div>

</div>
<!--/ END row -->
<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>  
<script type="text/javascript">

  var status_editor;
  var text_tingkat="-";
  var text_mapel="-";
  var text_bab="-";
  var text_subbab="-";
  var text_kesulitan="Mudah";
  var text_judul="-";
  var text_sumber="-";
  var soal;

  $(document).ready(function () {
    // set hide btn remove plihan jawaban
    // $("#btn-re-1").hide();
    event_this_page();
  });
function load_tingkat(){
        var tingkat_id = {"tingkat_id": $('#tingkat').val()};
      var idTingkat;
      $.ajax({
        type: "POST",
        dataType: "json",
        data: tingkat_id,
        url: "<?= base_url() ?>index.php/videoback/getTingkat",
        success: function (data) {
          $('#tingkat').html('<option value="">-- Pilih Tingkat  --</option>');
          $.each(data, function (i, data) {
            $('#tingkat').append("<option value='" + data.id + "'>" + data.aliasTingkat + "</option>");
            return idTingkat = data.id;
          });

        }
      });
}
  // set tingkat
  function event_this_page() {
    jQuery(document).ready(function () {
      CKEDITOR.replace('editor-1');
      CKEDITOR.replace('editor-2');
      CKEDITOR.replace('editor-3');
      CKEDITOR.replace('editor-4');
      CKEDITOR.replace('editor-5');
      load_tingkat();
      CKEDITOR.replace( 'editor-soal' );
      // CKEDITOR.replace( 'editor-pembahasan' );
      // CKEDITOR.replace('editor_piljawab');

      //jika ada perubahan pada dropdown tingkat maka 
      // dropdown pelajaran akan menyesuaikan dengan data tingkat
      $('#tingkat').change(function () {
        tingkat_id = {"tingkat_id": $('#tingkat').val()};
        load_pelajaran($('#tingkat').val());
      });
       //jika ada perubahan pada dropdown pelajaran maka 
         // dropdown bab akan menyesuaikan dengan data pelajaran
         $('#pelajaran').change(function () {
          pelajaran_id = {"pelajaran_id": $('#pelajaran').val()};
          load_bab($('#pelajaran').val());
        });
       //jika ada perubahan bab dropdown tingkat maka 
      // dropdown subbab akan menyesuaikan dengan data bab
      $('#bab').change(function () {
        load_sub_bab($('#bab').val());
      });
      // event untuk updt prev soal
      $('#subbab').change(function () {
        //get name option select tingkat kemudian simpan di var text_tingkat
        text_tingkat=$('#tingkat option:selected').text();
        //get mapel option select tingkat kemudian simpan di var text_mapel
        text_mapel=$('#pelajaran option:selected').text();
        //get name option select bab kemudian simpan di var text_bab
        text_bab=$('#bab option:selected').text();
        //get name option select subbab kemudian simpan di var text_subbab
        text_subbab=$('#subbab option:selected').text();
        // set tingkat preview soal
        // prev_attr();
      });
      // jika ada perubahan pada data kesulitan maka data kesulitan pada priview soal akan menyesuaikan
      $("select[name=kesulitan]").change(function(){
        text_kesulitan=$("select[name=kesulitan] option:selected").text();
        prev_attr();
      });
      // jika ada perubahan pada data kode soal maka data kode soal pada priview soal akan menyesuaikan
      $("input[name=judul]").change(function(){
        text_judul=$("input[name=judul]").val();
        prev_attr();
      });
      // jika ada perubahan pada data sumber soal maka data sumber soal pada priview soal akan menyesuaikan
      $("input[name=sumber]").change(function(){
        text_sumber=$("input[name=sumber]").val();
        prev_attr();
      });
      // event untuk gambar soal
      // Start event preview gambar Soal
      $('#fileSoal').on('change',function () {
        var file = this.files[0];
        var reader = new FileReader();
        var size=Math.round(file.size/1024);
        // start pengecekan ukuran file
        if (size>=500) {
          $('#e_size_img').modal('show');
        }else{
          $('#prev-soal-img').removeClass("hide");
          reader.onload = viewerSoal.load;
          reader.readAsDataURL(file);
          viewerSoal.setProperties(file);
        }
      });
      var viewerSoal = {
        load : function(e){
        //untuk di form soal
        $('#previewSoal').attr('src', e.target.result);
        //untuk preview soal
        $('#previewSoal2').attr('src', e.target.result);
        },
        setProperties : function(file){
          $('#filenameSoal').text(file.name);
          $('#filetypeSoal').text(file.type);
          $('#filesizeSoal').text(Math.round(file.size/1024));
        },
      }
      // /event untuk gambar soal

      // Strat  event untuk jumlah pilihan
      // jika btn empat pilihan di klik maka form pilihan jawaban e akan disembunyikan 
      $("#empatpil").click(function(){   
        $("#pilihan").hide();
        $("#pilihanop").hide();
      });
       // jika btn empat pilihan di klik maka form pilihan jawaban e akan ditampilkan
      $("#limapil").click(function(){
        $("#pilihan").show();
        $("#pilihanop").show();
      });
      // END  event untuk jumlah pilihan
      // Strat  event untuk pilihan jenis input  
      $("#text").click(function(){
        $(".piltext").show(1000);
        $(".pilgambar").hide(1000);
        //disable btn editor pilihan jawaban
        $(".btn-pilihan").attr("disabled",false); 
        //hide preview pilihan text
        $("#pp_img").hide(1000);
        $("#pp_text").show(1000);
      });
      $("#gambar").click(function(){
        $(".pilgambar").show(1000);
        $(".piltext").hide(1000);  
        //disable btn editor pilihan jawaban 
        $(".btn-pilihan").attr("disabled",true);
        $("#pp_text").hide(1000);
        $("#pp_img").show(1000);
      });
      $("#text-gambar").click(function(){
        $(".pilgambar").show(1000);
        $(".piltext").show(1000);  
        $("#pp_text").show(1000);
        $("#pp_img").show(1000);
      });
      //END  event untuk pilihan jenis input  
      // Start event preview gambar pilihan A
            $('#fileA').on('change',function () {
              var file = this.files[0];
              var reader = new FileReader();
              var size=Math.round(file.size/1024);
                 // start pengecekan ukuran file
                 if (size>=500) {
                  $('#e_size_img').modal('show');
                }else{
                  $('.info-img-1').show(1000);
                  $('#btn-re-1').show(500);
                  $('#btn-up-1').hide(250);
                  reader.onload = viewerA.load;
                  reader.readAsDataURL(file);
                  viewerA.setProperties(file);
                }
                
              });

            var viewerA = {
              load : function(e){
                //untuk di form soal
                $('#previewA').attr('src', e.target.result);
                //untuk di preview soal
                $('#previewA2').attr('src', e.target.result);
              },
              setProperties : function(file){
                $('#filenameA').text(file.name);
                $('#filetypeA').text(file.type);
                $('#filesizeA').text(Math.round(file.size/1024));
              },
            }
            // End event preview gambar pilihan A
    });
  }

    //set option pelajaran
    function load_pelajaran(tingkatID) {
      $.ajax({
        type: "POST",
        dataType: "json",
        data: tingkatID.tingkat_id,
        url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
        success: function (data) {
          $('#pelajaran').html('<option value="">-- Pilih Mata Pelajaran  --</option>');
          $.each(data, function (i, data) {
            $('#pelajaran').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
          });
        }
      });
    }
  //buat load bab
  function load_bab(mapelID) {
    $.ajax({
      type: "POST",
      dataType: "json",
      data: mapelID.mapel_id,
      url: "<?php echo base_url() ?>index.php/videoback/getBab/" + mapelID,
      success: function (data) {
        $('#bab').html('<option value="">-- Pilih Bab Pelajaran  --</option>');
        $.each(data, function (i, data) {
          $('#bab').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
        });
      },
    });
  }

  //load sub bab
  function load_sub_bab(babID) {
    $.ajax({
      type: "POST",
      dataType: "json",
      data: babID.bab_id,
      url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,
      success: function (data) {
        $('#subbab').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');             
        $.each(data, function (i, data) {
          $('#subbab').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");
        });
      },
    });
  }

  function editor_piljawab(data){
    var editor_piljawab = "editor_"+data;
    console.log(editor_piljawab);
    CKEDITOR.replace("editor_a");
  }
  // set info atribut soal pada preview soal
  function prev_attr(){
    var atr_info="<p>Tingkat : "+text_tingkat+" | Matapelajaran : "+text_mapel+" | Bab : "+text_bab+" | Subab: "+text_subbab+"| Kesulitan: "+text_kesulitan+"</p>";
    var header_soal="<h4 class='panel-title' style='color: #575858'>Kode Soal : "+text_judul+" | Sumber: "+text_sumber+" </h4>";
    $("#prev-attr").empty();
    // set att soal
    $("#prev-attr").append(atr_info);
    $("#prev-header").empty();
    // set sumber dan kode soal
    $("#prev-header").append(header_soal);
  }

  function remove_img(dat) {
     $('.info-img-1').hide(1000);
    $('#btn-re-1').hide(1000);
        $('#btn-up-1').show(1000);
    $("input[name=gambar1]").val(null);
    $("#previewA").attr('src', '');
        $('#filenameA').text("-");
    $('#filetypeA').text("-");
    $('#filesizeA').text("-");
  }

</script>
<!-- validasi input -->
<script type="text/javascript">
  // validasi upload gambar 
function ValidateSingleInput(oInput) {
  var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;
        }
      }

      if (!blnValid) {
       $('#warningupload').modal('show');

                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                // oInput.value = "";
                return false;
              }
            }
          }
          return true;
        }
</script>