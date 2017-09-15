
        <!--/ END Template Sidebar (Left) -->

        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">GURU</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="javascript:void(0);">Form Guru</a></li>
                                <li class="active">Elements</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START panel -->
                        <div class="panel panel-default">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Guru</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                            <?php echo $this->session->flashdata('msg'); ?>
                                <form class="form-horizontal form-bordered" action="<?=base_url()?>index.php/Passinggrade/edit_pass" method="post">
                                    
                                   <div class="form-group">
                                        <label class="col-sm-2">ID Passing</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" name="id_passing" type="text" value="<?php echo $editdata->id_passing; ?>" disabled/>
                                            <span class="text-danger"><?php echo form_error('id_passing'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Kode</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" name="kode" placeholder="Kode" type="text" value="<?php echo $editdata->kode; ?>" />
                                            <span class="text-danger"><?php echo form_error('kode'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Wilayah</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="wilayah" class="form-control" value="<?php echo $editdata->wilayah; ?>" >
                                            <span class="text-danger"><?php echo form_error('wilayah'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Universitas</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="universitas" class="form-control" value="<?php echo $editdata->universitas; ?>" >
                                            <span class="text-danger"><?php echo form_error('universitas'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Program Studi</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="prodi" class="form-control" value="<?php echo $editdata->prodi; ?>" >
                                            <span class="text-danger"><?php echo form_error('prodi'); ?></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Passing Grade</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="passinggrade" class="form-control" value="<?php echo $editdata->passinggrade; ?>" >
                                            <span class="text-danger"><?php echo form_error('passinggrade'); ?></span>
                                            </div>
                                    </div>
                                    
                                    
                                    <div class="panel-footer">
                                        <div class="form-group no-border">
                                            <!-- <label class="col-sm-3 control-label">Button</label> -->
                                            <div class="col-sm-9">
                                            <input type="hidden" name="id_passing" value="<?php echo $editdata->id_passing;?>">
                                            <input type="submit" class="btn" name="update"  value="Update" class="btn btn-primary">
                                            </div>
                                        </div> 
                                    </div>
                                </form>
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
        

<script>

CKEDITOR.replace( 'editor1' );

</script>
