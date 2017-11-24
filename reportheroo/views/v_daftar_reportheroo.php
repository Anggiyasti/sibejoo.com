<!-- START Template Main -->
<section id="main" role="main">            
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Report Heroo 
                </h3>
                <div class="panel-toolbar text-right">
                  <a href="<?=base_url('index.php/Reportheroo/tambah_heroo') ?>" class="btn btn-inverse btn-outline add-team" title="Tambah Report Heroo"><i class="ico-plus"></i></a>
                </div>
            </div>
            <div class="panel-body">
               <div class="col-md-12">
                <table class="daftarartikel table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Report Heroo</th>
                      <th>Isi Report Heroo</th>
                      <th>Kategori</th>
                      <th>Gambar</th>
                      <th width="15%">Aksi</th>
                    </tr>
                    <tbody>

                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--/ END Template Main -->
       
<script type="text/javascript">
  var dataTableReportHeroo;
    $(document).ready(function() {
        dataTableReportHeroo = $('.daftarartikel').DataTable({
              "ajax": {
                "url": base_url+"Reportheroo/ajax_list_heroo",
                "type": "POST"
              },
              "emptyTable": "Tidak Ada Data Pesan",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "bDestroy": true,
            });
    });

// onclick adda team action
$('.add-team').click(function(){
  window.location.href = base_url + "teamback/form_addteam";
});

function edit_reportH(id) {
    window.location.href = base_url + "Reportheroo/update_report_heroo/"+id;
}

function drop_reportH(id){
  url = base_url+"Reportheroo/drop_report_heroo";
  swal({
    title: "Yakin akan hapus report heroo?",
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
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Report heroo berhasil dihapus.", "success");
        reload();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }
    });
  });
}

function reload() {
    dataTableReportHeroo.ajax.reload(null,false);
}
    
</script>