<section class="" id="main" role="main"">
    <div class="container-fluid">
        <!-- Start row -->
        <div class="row">
            
            <div class="col-md-12">
                <!-- Start Panel -->
                <div class="panel panel-teal" >
                <!-- Start Pnel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">List Passing Grade</h3>
                    <!-- Start menu tambah materi -->
                        <div class="panel-toolbar text-right">
                            <a class="btn btn-inverse btn-outline" href="<?= base_url(); ?>index.php/passinggrade/t_pass" title="Tambah Data" ><i class="ico-plus"></i></a>
                        </div>
                         <!-- END menu tambah materi -->

                </div>
                <!-- End Panel Heading -->
                <!-- Start Panel Body -->
                <div class="panel-body">
                    <table class="enur table table-striped" id="zero-configuration"  style="font-size: 12px" width="100%">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Wilayah</th>
                            <th>Universitas</th>
                            <th>Program Studi</th>
                            <th>Passing Grade</th>
                            <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- END Panel Body -->
                </div>
            </div>
        </div>
    </div>
</section>
        <!--/ END Template Main -->

        <!-- START Template Sidebar (right) -->
        

<script type="text/javascript">
    
    var $list_passing;
    $(document).ready(function() {
        //#get list by id guru
        $list_passing = $('#zero-configuration').DataTable({ 
            "processing": true,
            "ajax": {
                "url": base_url+"index.php/Passinggrade/ajax_get_all_passing",
                "type": "POST"
            },
        });
        //##

    });


    function drop_passing(id_passing){
        url = base_url+"passinggrade/del_passing/"+id_passing;
        swal({
            title: "Yakin akan hapus passing grade?",
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
              type:"POST",
              url:url,
              success:function(){
                swal("Terhapus!", "Passing grade berhasil dihapus.", "success");
                reload_tblist();
              },
              error:function(){
                sweetAlert("Oops...", "Data gagal terhapus!", "error");
              }

            });
        });

    }

    //fungsi reload table
function reload_tblist(){
    $list_passing.ajax.reload(null,false);
}
</script>