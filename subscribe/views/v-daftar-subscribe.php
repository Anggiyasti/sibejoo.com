<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">
<script type="text/javascript" src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>

<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Daftar Subscribe</h4>
                    <!-- Trigger the modal with a button -->
                    <!--<a href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Data" type="button" class="btn btn-default pull-right" style="margin-top:-30px;" ><i class="ico-plus"></i></a>-->
                    <br>
                    <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
                </div>

                <table class="daftarsubs table table-striped display responsive nowrap" style="font-size: 13px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var tb_subs;
    $(document).ready(function () {
        tb_subs = $('.daftarsubs').DataTable({
            "ajax": {
                "url": base_url + "subscribe/ajax_daftar_subs",
                "type": "POST"
            },
            "emptyTable": "Tidak Ada Data Subscribe",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
        });
    });

    function dropSubs(id_subs,email) {
        swal({
          title: "Yakin akan menghapus "+email+"?",
          text: "Anda tidak dapat membatalkan ini.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya,Tetap hapus!",
          closeOnConfirm: false
        },
        function(){
          var url = base_url+"subscribe/deletesubs/"+ id_subs;
          $.ajax({
            url:url,
            data:{id_subs:id_subs},
            dataType:"text",
            type:"post",
            success:function(){
                swal("Terhapus!", "Subscriber berhasil dihapus.", "success");
                reload_tblist();
              
            },
            error:function(){
                sweetAlert("Oops...", "Data gagal terhapus!", "error");
            } 
          });
        });
    }
        
    function reload_tblist() {
        tb_subs.ajax.reload(null, false);
    }

</script>