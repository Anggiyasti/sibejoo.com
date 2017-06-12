<div class="row">
	<div class="col-md-12">
  		<div class="panel panel-default">
    		<div class="panel-heading">
     			<h3 class="panel-title">Daftar Team 
    			</h3>
			    <div class="panel-toolbar text-right">
			       	<a class="btn btn-inverse btn-outline add-team" title="Tambah Team" ><i class="ico-plus"></i></a>
			    </div>
  			</div>

  			<div class="panel-body">
  				<!-- div seting record dan pencarian   -->
			    <!-- <div class="col-md-12" > -->
			      <!-- div setting record -->
			      <!-- <div class="col-md-2 mb2 mt10 pl0">
			        <div  class="form-group">
			          <select  class="form-control" name="records_per_page">
			            <option value="10">10</option>
			            <option value="25">25</option>
			            <option value="50">50</option>
			            <option value="100">100</option>
			          </select>
			        </div>
			      </div> -->
			      <!-- /div setting record -->
			      <!-- div pencarian  -->
			      <!-- <div class="col-md-10 mb10 mt10 pr0">
			        <div class="input-group">
			         <span class="input-group-addon btn" id="cariToken"><i class="ico-search"></i></span>
			         <input class="form-control" type="text" name="cariToken" placeholder="Cari Data">
			       </div>
			     </div> -->
			     <!-- div pencarian -->
			   	<!-- </div> -->
			   <!-- div seting record dan pencarian -->

			   <!-- div tabel daftar token -->
			   <div class="col-md-12">
			    <table class="daftarteam table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
			      <thead>
			        <tr>
			          <th>No</th>
			          <th>Nama</th>
			          <th>Posisi</th>
			          <th>Keterangan</th>
			          <th>Foto</th>
			          <th width="15%">Aksi</th>
			        </tr>
			        <tbody>

			        </tbody>
			      </table>
			    </div>
			    <!-- /div tabel daftar token -->

			    <!-- div pagination daftar token -->
			    <div class="col-md-12">
			      <ul class="pagination pagination-token">

			      </ul>
			    </div>
			    <!-- div pagination daftar token -->
  			</div>

  		</div>
	</div>
</div>

<script type="text/javascript">
  var dataTableTeam;
  	$(document).ready(function() {

		dataTableTeam = $('.daftarteam').DataTable({
              "ajax": {
                "url": base_url+"teamback/ajaxListTeam",
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

function edit_team(id) {
	window.location.href = base_url + "teamback/update_team/"+id;
}

function drop_team(id){
  url = base_url+"teamback/drop_team";
  swal({
    title: "Yakin akan hapus Team?",
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
        swal("Terhapus!", "Team berhasil dihapus.", "success");
        reload();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }

    });
  });
}

function reload() {
	dataTableTeam.ajax.reload(null,false);
}
 	
</script>