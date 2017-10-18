
        <!--/ END Template Sidebar (Left) -->

        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">

                <!-- START row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START panel -->
                        <div class="panel panel-teal">
                            <!-- panel heading/header -->

                            <div class="panel-heading">
                                <h3 class="panel-title">Form Passing Grade</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                            <?php echo $this->session->flashdata('msg'); ?>
                                <!-- <form class="form-horizontal form-bordered" method="post"> -->
                            
                                   
                                    <div class="form-group">
                                        <label class="col-md-12">Kode</label>
                                        <div class="col-md-12">
                                            <input class="form-control" name="kode" type="text" value="<?php echo set_value('kode'); ?>" />
                                            <span class="text-danger"><?php echo form_error('kode'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Wilayah</label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="wilayah">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Universitas</label>
                                        <div class="col-md-12">
                                            <input type="text" name="universitas" class="form-control" value="<?php echo set_value('universitas'); ?>" >
                                            <span class="text-danger"><?php echo form_error('universitas'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Program studi</label>
                                        <div class="col-md-12">
                                            <input type="text" name="prodi" class="form-control" >
                                            <span class="text-danger"><?php echo form_error('prodi'); ?></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Passing Grade</label>
                                        <div class="col-md-12">
                                            <input type="number" name="passinggrade" class="form-control" step="0.01" >
                                            <span class="text-danger"><?php echo form_error('passinggrade'); ?></span>
                                            </div>
                                    </div>
                                    
                                    
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary" onclick="save()">Simpan</button>
                                            </div>
                                        </div> 
                                    </div>
                                <!-- </form> -->
                            </div>
                            <!-- panel body -->
                        </div>
                        <!--/ END form panel -->
                    </div>
                </div>



                <!--/ END row -->

                <!-- START row -->
                
                <!--/ END row -->

                <!-- START row -->
                
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->

        </section>
        <!--/ END Template Main -->

        <!-- START Template Sidebar (right) -->
        
        <!--/ END Template Sidebar (right) -->

<script>


function save(){
        var datas = {
            kode : $('input[name=kode]').val(),
            wilayah : $('select[name=wilayah]').val(),
            universitas:$('input[name=universitas]').val(),
            prodi:$('input[name=prodi]').val(),
            passinggrade:$('input[name=passinggrade]').val(),
        }
        if (datas.kode == "" || datas.passinggrade == "") {
            swal('Tidak boleh kosong');
        }else{
            url = base_url+"passinggrade/add_passinggrade";
            // do_upload
            $.ajax({
                url:url,
                data:datas,
                dataType:"TEXT",
                type:"POST",
                success:function(){
            swal({
                    title: "passinggrade berhasil ditambahkan!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Selesai",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
            function(isConfirm){
                    if (isConfirm) {
                        window.location.href = base_url+"passinggrade/daftar_pass";
                    } 
                    else {
                        swal("Tambah Data dibatalkan");
                    }
                });
            },      error:function(){
                    
                }
            });

            
        }
    }

</script>
