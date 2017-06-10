<!-- START Template Main  -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- START row -->
        <div class="row">
            <div class="col-md-7">
                <?php if ($this->session->flashdata('notif') != '') {
                    ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span><?php echo $this->session->flashdata('notif'); ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="semibold">Note :</span>&nbsp;&nbsp;Pastikan data form di isi dengan benar.
                    </div>
                <?php }; ?>
                <!-- Form horizontal layout bordered -->
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tambah Data Team</h3>
                        <a href="<?= base_url('index.php/teamback')?>" class="btn btn-default btn-sm pull-right"style="margin-top:-33px;" >Kembali</a>
                    </div>               
                    <div class="panel-body">
                        <br>
                        <div class="">
                            <p class="text-center">IDENTITAS TEAM</p>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Nama</label>
                            <div class="col-sm-8 mb10">
                                <input class="form-control" type="text" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Posisi</label>
                            <div class="col-sm-8 mb10">
                                <input class="form-control" type="text" name="posisi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Keterangan</label>
                            <div class="col-sm-8 mb10">
                                <input class="form-control" type="text" name="keterangan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Foto</label>
                            <div class="col-sm-8">
                                <label for="filelogo" class="btn btn-sm btn-default filelogo">
                                    Pilih Logo
                                </label>
                                <input style="display:none;" type="file" id="filelogo" name="logo" onchange="preview_fileLogo(this,z='');"/>
                            </div>
                        </div>
                        <!-- form upload gambar -->
                        <form action="<?=base_url('teamback/do_upload') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
                            <div class="form-group">
                                <div class="col-sm-10 col-md-offset-1">
                                    Upload Gambar : 
                                    <input type="file" class="cws-button bt-color-3 alt smalls post" name="file" style="display: inline"> 
                                    <a onclick="submit_upload()" style="border: 2px solid #18bb7c; padding: 2px;display: inline" title="Upload">Upload</a> 
                                    <div id="output" style="display: inline">
                                    </div>
                                    <input type="submit" class="fa fa-cloud-upload submit-upload" style="margin-top: 3px;display: none" value="Upload">
                                </div>
                            </div>
                        
                        </form>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <a onclick="save()" class="btn btn-primary">Simpan</a>
                        </div>
                    </div>

                <!-- </form> --></div>
                <!--/ Form horizontal layout bordered -->
            </div>

            <div class="col-sm-5">
                <div class="panel panel-teal">
                <div class="panel-heading">
                    <h3 class="panel-title">Priview Logo</h3>
                </div>  
                <div class="panel-body pb0 pt0 pl0 pr0">
                    <!-- START Statistic Widget -->
                    <div class="table-layout animation delay animating fadeInDown  prv_logo mb0">
                        <div class="col-xs-4 panel bgcolor-info text-center">
                            <img id="prevfile" class="img-tumbnail logo" src="<?=base_url()?>assets\image\avatar\default.png" width="50%"  >
                        </div>
                    </div>
                    <!--/ END Statistic Widget -->
                </div>
                <div class="panel-footer pb0 pt0 pl0 pr0">
                    <!-- <div class="row" style="margin:1%;">  -->
                        <div class="col-md-5 left"> 
                            <h6>Name: <span id="namefile"></span></h6> 
                        </div> 
                        <div class="col-md-4 left"> 
                            <h6>Size: <span id="sizefile"></span>Kb</h6> 
                        </div> 
                        <div class="col-md-3 bottom"> 
                            <h6>Type: <span id="typefile"></span></h6> 
                        </div>
                    <!-- </div> -->
                </div>
                </div>                      
            </div>

        </div>
        <!--/ END row -->
    </div>
</section>
<script src="http://malsup.github.com/jquery.form.js"></script>
 <!-- END Template Main -->
 <script type="text/javascript">
    function submit_upload(){

        $('.submit-upload').click();
    }
    jQuery(document).ready(function() { 
        jQuery('#form-gambar').on('submit', function(e) {
            console.log('masuk');
            e.preventDefault();
            jQuery('#submit-button').attr('disabled', ''); 
            jQuery("#output").html('<div style="padding:10px"><img src="<?php echo base_url('assets/image/loading/spinner11.gif'); ?>" alt="Please Wait"/> <span>Mengunggah...</span></div>');
            jQuery(this).ajaxSubmit({
                target: '#output',
                success:  sukses 
            });
        });
    }); 

    function sukses()  { 
        jQuery('#form-upload').resetForm();
        jQuery('#submit-button').removeAttr('disabled');

    } 

    function insert(){
        nama_file = $('.insert').data('nama');
        url = base_url+"assets/image/konsultasi/"+nama_file;

        CKEDITOR.instances.isi.insertHtml('<img src='+url+' ' + CKEDITOR.instances.isi.getSelection().getNative()+'>');

    }

    
    // masukin text ke posisi tertentu
    jQuery.fn.extend({
        insertAtCaret: function(myValue){
            return this.each(function(i) {
                if (document.selection) {
                    this.focus();
                    sel = document.selection.createRange();
                    sel.text = myValue;
                    this.focus();
                }
                else if (this.selectionStart || this.selectionStart == '0') {
                    var startPos = this.selectionStart;
                    var endPos = this.selectionEnd;
                    var scrollTop = this.scrollTop;
                    this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                    this.focus();
                    this.selectionStart = startPos + myValue.length;
                    this.selectionEnd = startPos + myValue.length;
                    this.scrollTop = scrollTop;
                } else {
                    this.value += myValue;
                    this.focus();
                }
            })
        }
    });
    // masukin text ke posisi tertentu

    function save(){
        var datas = {
            nama : $('input[name=nama]').val(),
            posisi : $('input[name=posisi]').val(),
            keterangan:$('input[name=keterangan]').val()
        }

        if (datas.nama == "" || datas.posisi == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"teamback/ajax_add_team/";
            $.ajax({
                url : url,
                type: "POST",
                data: datas,
                dataType: "TEXT",
                success: function(data)
                {
                swal('Posting berhasil...');
                window.location = base_url+"teamback";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Error adding / update data');
            }
        });

            
        }
    }

 </script>
 <script src="http://macyjs.com/assets/js/macy.min.js"></script>