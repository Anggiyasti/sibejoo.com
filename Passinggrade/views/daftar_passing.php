
        <!--/ END Template Sidebar (Left) -->

        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
               
                <!-- Page Header -->

                <!-- START row -->

                <!-- Page Header -->
                
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
 <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="checkbox custom-checkbox pull-left">  
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Daftar Guru</h3>
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
                            <!--/ panel toolbar wrapper -->

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
                                <table class="table table-bordered" id="column-filtering" style="font-size: 13px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Wilayah</th>
                                            <th>Universitas</th>
                                            <th>Program Studi</th>
                                            <th>Passing Grade</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                     $no = 1;
                                     foreach ($data as $ps):?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?=$ps['kode'];?></td>
                                            <td><?=$ps['wilayah'];?></td>
                                            <td><?=$ps['universitas'];?></td>
                                            <td><?=$ps['prodi'];?></td>  
                                            <td><?=$ps['passinggrade'];?></td>                   
                 
                                            <td class="text-center">
                                                <!-- button toolbar -->
                                                <div class="toolbar">
                                                    <div class="btn-group">
                                            
                                    <a href="<?=base_url()?>index.php/Passinggrade/edit_pass/<?=$ps['id_passing']?>" class="btn btn-outline btn-info">Edit</a> 
                                    <a class="btn btn-outline btn-info" href="#delete" data-toggle="modal" data-target="#delete<?php echo $ps['id_passing'];?>">Hapus</a>
                                                               
                                                                <!-- Modal hapus-->
                            <div class="modal fade" id="delete<?php echo $ps['id_passing']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <a href="<?=base_url()?>index.php/Passinggrade/delete_pass/<?=$ps['id_passing']?>" class="btn btn-default" >Yes</a>
                                            <a href="#"class="btn btn-default" data-dismiss="modal">No</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            </div>
                                                    </div>

                                                </div>
                                                <!--/ button toolbar -->
                                            </td>
                                        </tr>
                                        <?php 
                                        $no++;
                                        endforeach; ?>                    
                    </tbody>
                    <tfoot>
                                    <tr>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="No"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Kode"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Wilayah"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Universitas"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Program Studi"></th>
                                        <th><input type="search" class="form-control" name="search_engine" placeholder="Passing Grade"></th>
                                        <th><input type="search" class="form-control" name="search_engine"  disabled/></th>
                                    </tr>
                                </tfoot>
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
        

    