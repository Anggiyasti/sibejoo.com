<!-- START Template Main  -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- START row -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
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
                <div class="form-horizontal panel panel-default login-form">
                    <input type="text" name="id" value="<?= $team['id'] ?>" hidden>
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Team</h3>
                        <a href="<?= base_url('index.php/teamback')?>" class="btn btn-default btn-sm pull-right"style="margin-top:-33px;" >Kembali</a>
                    </div>               
                    <div class="panel-body">
                        <br>
                        <div class="">
                            <p class="text-center">IDENTITAS TEAM</p>
                        </div>
                        <div class="clear-both"></div>
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="true" value="<?= $team['nama'] ?>">
                                <span class="text-danger"> <?php echo form_error('nama'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" class="form-control" placeholder="Posisi" name="posisi" value="<?= $team['posisi'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('posisi'); ?></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-md-offset-1">
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="<?= $team['keterangan'] ?>" data-parsley-required required>
                                <span class="text-danger"> <?php echo form_error('keterangan'); ?></span> 
                            </div>
                        </div>
                         <!-- form upload gambar -->
                        <form action="<?=base_url('teamback/do_upload_edit') ?>" method="post" enctype="multipart/form-data" id="form-gambar">
                            <input type="text" name="id" value="<?= $team['id'] ?>" hidden>
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
                            <a onclick="update()" class="btn btn-primary">Simpan</a>
                        </div>
                    </div>
                </div>
                <!--/ Form horizontal layout bordered -->
            </div>
        </div>
        <!--/ END row -->
    </div>
</section>
 <!-- END Template Main -->
 <script src="http://malsup.github.com/jquery.form.js"></script>
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
    function update(){
        var datas = {
            id : $('input[name=id]').val(),
            nama : $('input[name=nama]').val(),
            posisi : $('input[name=posisi]').val(),
            keterangan:$('input[name=keterangan]').val()
        }

        console.log(datas);
        if (datas.nama == "" || datas.posisi == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"teamback/ajax_update_team/";
            $.ajax({
                url : url,
                type: "POST",
                data: datas,
                dataType: "TEXT",
                success: function(data)
                {
                swal('Update berhasil...');
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