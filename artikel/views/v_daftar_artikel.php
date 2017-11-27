<!-- Start Script Matjax -->
<script type="text/x-mathjax-config">
 MathJax.Hub.Config({
 showProcessingMessages: false,
 tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
});
</script>
<script type="text/javascript" src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>"></script>
<style type="text/css">
  body .modal-artikel .modal-dialog {
    /* new custom width */
    width: 60%; /* desired relative width */
    /* place center */
    margin-left:auto;
    margin-right:auto;
  }
</style>
<!-- Start Modal Detail Artikel-->
  <div class="modal fade modal-artikel" id="mdetailartikel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="semibold mt0 text-accent text-center"></h3>
        </div>
        <div class="modal-body">
          <p id="isi-artikel">
            
          </p>
          <div id="gambar">
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Modal Detail Artikel -->

<!-- START Template Main -->
<section id="main" role="main">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Daftar Artikel </h3>
          <div class="panel-toolbar text-right">
            <a class="btn btn-inverse btn-outline add-team" title="Tambah Team" href="<?=base_url('index.php/artikel/tambahartikel')?>" ><i class="ico-plus"></i></a>
          </div>
        </div>
        <div class="panel-body">      
          <div class="col-md-12">
            <table class="daftarartikel table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Artikel</th>
                  <th>Isi Artikel</th>
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
var dataTableArtikel;
$(document).ready(function() {
  dataTableArtikel = $('.daftarartikel').DataTable({
    "drawCallback": function (settings) {
      MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
    },
    "ajax": {
      "url": base_url+"artikel/ajaxListArtikel",
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

function edit_artikel(id) {
    window.location.href = base_url + "artikel/update_artikel/"+id;
}

function drop_artikel(id){
  url = base_url+"artikel/drop_artikel";
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
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Artikel berhasil dihapus.", "success");
        reload();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }

    });
  });
}

function reload() {
    dataTableArtikel.ajax.reload(null,false);
}

//# ketika tombol di klik detail
function detail(id){
  var kelas ='.detail-'+id;
  var data = $(kelas).data('id');
  var gambar = base_url+'assets/image/artikel/'+data.gambar;

  $('h3.semibold').html(data.judul_artikel);
  $('#isi-artikel').html(data.isi_artikel);     
  if (gambar!="") {
    $('#gambar').html('<img src="' + gambar + '">');  
  }
  MathJax.Hub.Queue(["Typeset",MathJax.Hub,"mdetailartikel"]);
  $('#mdetailartikel').modal('show');
  
  
}
//##
    
</script>