
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
                            <form class="form-horizontal form-bordered" action="<?=base_url()?>index.php/Passinggrade/up_passinggrade" method="post">
                            <!-- panel body -->
                            <div class="panel-body">
                            <?php echo $this->session->flashdata('msg'); ?>
                                    
                                   <div class="form-group" hidden="true">
                                        <label class="col-sm-2">ID Passing</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" name="id_passing" type="text" value="<?=$editdata['id_passing']; ?>" disabled/>
                                            <span class="text-danger"><?php echo form_error('id_passing'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Kode</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" name="kode" placeholder="Kode" type="text" value="<?=$editdata['kode']; ?>" />
                                            <span class="text-danger"><?php echo form_error('kode'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Wilayah</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="wilayah" value="<?=$editdata['wilayah']; ?>" id='tampwilayah' hidden="true">
                                            <select class="form-control" name="wilayah">
                                                <option value="1" id="satu">1</option>
                                                <option value="2" id="dua">2</option>
                                                <option value="3" id="tiga">3</option>
                                                <option value="4" id="empat">4</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('wilayah'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Universitas</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="universitas" class="form-control" value="<?=$editdata['universitas']; ?>" >
                                            <span class="text-danger"><?php echo form_error('universitas'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Program Studi</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="prodi" class="form-control" value="<?=$editdata['prodi']; ?>" >
                                            <span class="text-danger"><?php echo form_error('prodi'); ?></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2">Passing Grade</label>
                                        <div class="col-sm-5">
                                            <input type="number" name="passinggrade" class="form-control" value="<?=$editdata['passinggrade']; ?>" step="0.01">
                                            <span class="text-danger"><?php echo form_error('passinggrade'); ?></span>
                                            </div>
                                    </div>
                                    
                            </div>
                            <!-- panel body -->
                            <div class="panel-footer">
                                <div class="form-group no-border">
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_passing" value="<?=$editdata['id_passing'];?>">
                                        <input type="submit" value="Update" class="btn btn-primary">
                                    </div>
                                </div> 
                            </div>
                            </form>
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

// set option wilayah ################
var tw =$('#tampwilayah').val();
if (tw == '1') {
    $('#satu').attr('selected','selected');
} else if (tw == '2') {
    $('#dua').attr('selected','selected');
} else if (tw == '3') {
    $('#tiga').attr('selected','selected');
} else {
    $('#empat').attr('selected','selected');
}

</script>
