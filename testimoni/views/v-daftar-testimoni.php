<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">

<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Daftar Testimoni</h4>
                    <!-- Trigger the modal with a button -->
                    <br>
                    <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->
                </div>

                <table class="daftartestimoni table table-striped display responsive nowrap" style="font-size: 13px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim</th>
                            <th>Testimoni</th>
                            <th>Tgl Testimoni</th>
                            <th class="text-center">Publish</th>
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

    function updatea(id_testi) {
        
        var url = base_url+"testimoni/publishtestimoni/" + id_testi;
        swal({
            title: "Yakin akan publih testimoni pada tampilan utama?",
            text: "Anda tidak dapat membatalkan ini.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
              dataType:"text",
              data: "id_testi=" + id_testi,
              type:"POST",
              url:url,
              success:function(){
                swal("Berhasil", "Testimoni dipublish pada tampilan utama", "success");
                reload_tblist();
              },
              error:function(){
                sweetAlert("Oops...", "Gagal!", "error");
              }

            });
        });
    }


    function droptea(id_testi) {
        var nilai = $("input:checkbox.drop").val();
        var url = base_url+"testimoni/disabletestimoni/" + id_testi;
        swal({
            title: "Yakin akan menghilangkan testimoni dari tampilan utama?",
            text: "Anda tidak dapat membatalkan ini.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
              dataType:"text",
              data: "id_testi=" + id_testi,
              type:"POST",
              url:url,
              success:function(){
                swal("!", "Testimoni dihilangkan dari tampilan utama", "success");
                reload_tblist();
              },
              error:function(){
                sweetAlert("Oops...", "Gagal!", "error");
              }

            });
        });
    }


    var tb_testimoni;
    $(document).ready(function () {
        tb_testimoni = $('.daftartestimoni').DataTable({
            "ajax": {
                "url": base_url + "testimoni/ajax_daftar_testimoni",
                "type": "POST"
            },
            "emptyTable": "Tidak Ada Data Pesan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
        });
    });

    function dropTestimoni(id_testi) {

        url = base_url+"index.php/testimoni/deleteTesti/" + id_testi;
        swal({
            title: "Yakin akan hapus testimoni?",
            text: "Anda tidak dapat membatalkan ini.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya,Tetap hapus!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
              dataType:"text",
              data: "id_testi=" + id_testi,
              type:"POST",
              url:url,
              success:function(){
                swal("Terhapus!", "Testimoni berhasil dihapus.", "success");
                reload_tblist();
              },
              error:function(){
                sweetAlert("Oops...", "Data gagal terhapus!", "error");
              }

            });
        });
    }

    function reload_tblist() {
        tb_testimoni.ajax.reload(null, false);
    }

</script>