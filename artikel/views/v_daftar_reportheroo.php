        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- START row -->
                <div class="row">
                <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="checkbox custom-checkbox pull-left">  
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Daftar Artikel Kategori</h3>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>  

<div class="row">
    <div class="col-lg-12">
        <!-- /.panel-default -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="col-md-4">       
                    </div>
                    <!-- form search -->                
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group input-group">
                            
                        </div>
                    </div>
                    <div class="table-responsive panel-collapse pull out">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <?php echo $this->session->flashdata('info'); ?>
                    <?php echo $this->session->flashdata('pesan2'); ?>
                                <table class="table table-bordered" id="zero-configuration" style="font-size: 13px">

                                    <thead>
                                        <tr>
                                            <!-- <th width="5%"></th> -->
                                            <th>ID REPORT </th>
                                            <th>JUDUL REPORT</th>
                                            <th>KATEGORI</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach ($data as $ds):?>
                                        <tr>
                                            <td><?=$ds['id_art'];?></td>
                                          <td><?=$ds['judul_art_katagori'];?></td>
                                          <td><?=$ds['nama_kategori'];?></td>
                                           
                                            <td class="text-center">
                                                <!-- button toolbar -->
                                                <div class="toolbar">
                                                    <div class="btn-group">
                                            
                                    <a href="<?=base_url()?>index.php/artikel/view_report_heroo/<?=$ds['id_art']?>" class="btn btn-outline btn-info">Ubah</a> 
                                    <a class="btn btn-outline btn-info" href="#deleteartikel" data-toggle="modal" data-target="#deleteartikel<?php echo $ds['id_art']?>">Hapus</a>

                                     <div class="modal fade" id="deleteartikel<?php echo $ds['id_art']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                        </div>
                                            <div class="modal-body">
                                                Are you sure?
                                            </div>
                                        <div class="modal-footer">
                                            <a href="<?=base_url()?>index.php/artikel/hapus_report_heroo/<?=$ds['id_art']?>" class="btn btn-default" >Yes</a>
                                            <a href="#"class="btn btn-default" data-dismiss="modal">No</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>                  
                                </div>
                                <!--/ button toolbar -->
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>                  
                    </tbody>
                    </table>
                                                </div>

                </div>
                <!-- /.table-hover -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
                <!--/ END row -->

              

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->

        </section>
        <!--/ END Template Main -->

        <!-- START Template Sidebar (right) -->
       

    