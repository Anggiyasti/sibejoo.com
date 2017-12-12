<!-- START Template Main -->
<section id="main" role="main">

    <!-- Start Modal konfirmasi hapus -->
    <div class="modal fade" id="konfirmasiDlt" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">

        <div class="swal swal-danger ">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="semibold">Anda Yakin Menghapus DATA INI?</h4>
            <p class="mb10">Silahkan cek kembali, jika anda yakin silahkan klik tombol di bawah ini untuk melanjutkan proses hapus data.</p>
            <button type="button" class="btn btn-danger btn-right" onclick="konfirmasiHapus()">hapus Data</button>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- START Template Container -->
<div class="container-fluid">

    <!-- START row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-teal">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Semua Modul</h3>
                    <!-- Start menu tambah soal -->
                    <div class="panel-toolbar text-right">
                        <?php $hakAkses=$this->session->userdata['HAKAKSES']; 
                        if ($hakAkses == 'admin'): ?>
                        <?php else: ?>
                        <a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/modulonline/formmodul" title="Tambah Data" ><i class="ico-plus"></i></a>
                        <?php endif ?>
                    </div>
                    <!-- END menu tambah soal -->
                </div>
                <table class="table table-striped table-bordered" id="tb_all_moduls" style="font-size: 13px" width="100%">
                    <thead>
                        <?php $hakAkses=$this->session->userdata['HAKAKSES']; 
                        if ($hakAkses == 'admin'): ?>
                         <tr>
                            <th>ID</th>
                            <th>Judul Modul</th>
                            <th>Deksripsi</th>
                            <!-- <th>Create By</th> -->
                            <th>Publish</th>
                            <th>Download</th>
                            
                                <!-- <th></th>
                                <th></th>
                                <th></th>
                                <th></th> -->
                            </tr>
                        <?php else: ?>
                            
                        
                        <tr>
                            <th>ID</th>
                            <th>Judul Modul</th>
                            <th>Deksripsi</th>
                            <!-- <th>Create By</th> -->
                            <th>Publish</th>
                            <th>Download</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                                <!-- <th></th>
                                <th></th>
                                <th></th>
                                <th></th> -->
                            </tr>
                            <?php endif ?>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!--/ END row -->

    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/javascript/app.min.js')?>"></script>
<script type="text/javascript">

    var tb_all_moduls;
    $(document).ready(function() {
        tb_all_moduls = $('#tb_all_moduls').DataTable({ 
         "ajax": {
            "url": base_url+"index.php/modulonline/ajax_listAllModul/",
            "type": "POST"
        },
        "processing": true,
    });
        $(function () {
          $('[data-toggle="popover"]').popover()
      });

    });

    function drop_modul(id) {
        url = base_url+"index.php/modulonline/delete_modul";   
        swal({
            title: "Yakin akan hapus Artikel?",
            text: "Anda tidak dapat membatalkan ini.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya,Tetap hapus!",
            closeOnConfirm: false
        },
        function(){ 
        var datas = {id:id};            
               $.ajax({
                   url :url,
                   type: "POST",
                   dataType: "TEXT",
                   data :datas,
                   success: function(data,respone)
                   {  
                    swal("Terhapus!","Modul Berhasil Dihapus","success");
                    reload_tblist();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal('Error deleting data');
                        }
                    });
                });
       }

       function reload_tblist(){
          tb_all_moduls.ajax.reload(null,false); 
      }

    // tampil modal kofirmasi hapus
    function konfirmasiHapus (id_soal) {
        $('#konfirmasiDlt').modal('show');
    }

    // Fungsi untuk detail soal
    function detail_modul(id_soal) {
        var kelas ='.detail-'+id_soal;
        var data = $(kelas).data('id');
        var jawaban=$('#jawaban-'+id_soal).val();
        $('h3.semibold').html(data.judul_soal);

        $('p#dsoal').html(data.soal);
        $('p#djawaban').html(jawaban);
        $('#mdetail_modul').modal('show');
    }

 
</script>