
<div class="row">
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Daftar Guru 

     </h3>


     <div class="panel-toolbar text-right">
       <div class="col-sm-4">
       </div>
       <div class="col-sm-4">
      	</div>
      <a href="<?=base_url()?>index.php/register/registerGuru" class="btn btn-inverse btn-outline" title="Tambah Guru" ><i class="ico-plus"></i></a>
    </div>
  </div>
  <div class="panel-body">
    <!-- div seting record dan pencarian   -->
    <div class="col-md-12" >
      <!-- div setting record -->
      <div class="col-md-2 mb2 mt10 pl0">
        <div  class="form-group">
          <select  class="form-control" name="records_per_page">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
      <!-- /div setting record -->
      <!-- div pencarian  -->
      <div class="col-md-10 mb10 mt10 pr0">
        <div class="input-group">
         <span class="input-group-addon btn" id="cariGuru"><i class="ico-search"></i></span>
         <input class="form-control" type="text" name="cariGuru" placeholder="Cari Data">
       </div>
     </div>
     <!-- div pencarian -->
   </div>
   <!-- div seting record dan pencarian -->
   <!-- div tabel daftar token -->
   <div class="col-md-12">
    <table class="table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Nama</th>
          <th>Mengajar</th>
          <th>Email</th>
          <th>Tanggal Terdaftar</th>
          <th width="15%">Aksi</th>
        </tr>
        <tbody id="record_guru">

        </tbody>
      </table>
    </div>
    <!-- /div tabel daftar token -->
    <!-- div pagination daftar token -->
    <div class="col-md-12">
      <ul class="pagination pagination-guru">

      </ul>
    </div>
    <!-- div pagination daftar token -->
  </div>
</div>
</div>

<!-- Modal form ubah email -->
<div class="modal fade" id="modal-chEmail">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title">Ubah Email</h4>

			</div>
			<!-- /Modal Header -->
			<div class="modal-body">
				<input class="form-control hidden" type="text" name="penggunaID" value="" >
				<input class="form-control" type="email" name="email" value="">
			</div>
			<!-- Modal Body -->

			<!-- /Modal Body -->

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button class="btn btn-success" onclick="updateEmail()">Simpan Perubahan</button>
			</div>
			<!-- /Modal Footer -->
		</div>
	</div><
</div>
<!-- /Modal form ubah email -->
<!-- Modal form ubah data guru -->
<div class="modal fade" id="modal-chguru">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetUlangMapel()">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title">Detail Data Guru</h4>

			</div>
			<!-- /Modal Header -->
			<div class="modal-body">
				<form class="form-bordered" id="formUpdateGuru" action="javascript:void(0)">
				 <div class="form-group">
				 	<input type="text" name="guruID" value="" class="form-control col-md-6 hidden"  >
					<label>Nama Depan</label>
					<input type="text" name="namaDepan" value="" class="form-control col-md-6"/> 
				</div>
				 <div class="form-group">
					<label>Nama Belakang</label>
					<input type="text" name="namaBelakang" value="" class="form-control col-md-6" />
				</div>
				<div class="form-group">
					<label>Mengajar</label>
					<input class="hidden" type="text" name="sumMapel" value="0" >
					<select class="form-control selectMapel"  name="mataPelajaran" id="mataPelajaran" required>
					</select>
				</div>
				<div class="form-group" id="listGuruMapel">
					<a class="btn btn-sm btn-danger" id="resetMapel">Reset</a>
				</div>
				 <div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" value="" class="form-control col-md-6" />
				</div>
				
				 <div class="form-group">
					<label>No Kontak</label>
					<input type="text" name="nokontak" value="" class="form-control col-md-6" />
				</div>
				
				 <div class="form-group">
					<label>Biografi</label>

					<textarea type="text" name="biografi" value="" class="form-control col-md-6" ></textarea>
				</div>
				<hr>
				<button type="submit" class="btn btn-success" >Simpan Perubahan</button>
				</form>
			
			</div>
			<!-- Modal Body -->

			<!-- /Modal Body -->

			<!-- Modal Footer onclick="updateDatGuru()" -->
			
			<!-- /Modal Footer -->
		</div>
	</div>
</div>
<!-- /Modal form ubah data guru -->

</div>
<!-- TABEL TOKEN -->
<script type="text/javascript">
  var $list_passing;
  var dataTableGUru;
  var meridian=4;
  var prev=1;
  var next=2;
  var records_per_page=10;
  var page=0;
  var pageVal;
  var keySearch='';
  var url;
  var tb_guru;
  var pageSelek=0;
  var datas ;
  $(document).ready(function(){

  	var i =0;

    $('#mataPelajaran').change(function () {
      i ++;
      var idMapel =$('#mataPelajaran').val();
      var mapel =$('#mataPelajaran option:selected').text();
      $("#listGuruMapel").append('<span class="note note-success mb15 mr15 mt15 pickMapel" id="mapelke-'+i+'"> <i class="ico-remove" onClick="removeMapel('+i+','+idMapel+')"></i> '+mapel+' </span> <input type="text" name="mapelIDke-'+i+'" value="'+idMapel+'" hidden="true" id="mapelIDke-'+i+'">');
      $('[name=sumMapel]').val(i);
      //remove mapel dari dropdown
      $("#id-"+idMapel).addClass("hidden");
      $('#resetMapel').removeClass('hidden');
    }); 
    $( "#resetMapel" ).click(function() {
      i=0;
      $('.op').removeClass("hidden");  
      $('[name=sumMapel]').val(i);
      $('.pickMapel').remove();
      $('#resetMapel').addClass('hidden');
      $("#mataPelajaran").removeClass("hidden");
    }); 

    $("#formUpdateGuru").submit(function(e) { 
    		var url = base_url+"index.php/guru/update_guru_jsonDat/";
    		var formUp=$("#formUpdateGuru");
    		 $.ajax({
	      dataType:"text",
	      data:formUp.serialize(),
	      type:"POST",
	      url:url,
	      success:function(data){
	      	swal("Data Guru berhasil diperbaharui!","--","success");
          selectPage(page);
          paginationGuru();
          $('#modal-chguru').modal('hide');
          $("#formUpdateGuru")[0].reset();
          resetUlangMapel();

	      },
	      error:function(){
	        sweetAlert("Oops...", "Email gagal diperbaharui!", "error");
	      }

	    });
    }); 


  //set tb_guru
  function set_tb_guru() {
    datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
    $('#record_guru').empty();
    
    url=base_url+"guru/ajaxlistguru";
    $.ajax({
      url:url,
      data:datas,
      dataType:"text",
      type:"post",
      success:function(Data)
      {
        tb_token = JSON.parse(Data);
        $('#record_guru').append(tb_token);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
       sweetAlert("Oops...", e, "error");
     }
   });

  }
  set_tb_guru();
  // even untuk jumlah record per halaman
  $("[name=records_per_page]").change(function(){
    records_per_page =$('[name=records_per_page]').val();
    selectPage(0);
    paginationGuru();
  });
 

  paginationGuru();

  $('#cariGuru').click(function(e){
      //get value dari input name cariToken
      keySearch=$('[name=cariGuru]').val();
      selectPage(pageVal='0');
      paginationGuru();
      //
    });

});
    //set pagination
    function paginationGuru() {
      $.ajax({
        url:base_url+"guru/pagination_guru/",
        data:{records_per_page:records_per_page,keySearch:keySearch},
        type:"POST",
        dataType:"TEXT",
        success:function(data){
          $('.pagination-guru').empty();
          $('.pagination-guru').append(JSON.parse(data));
        },error:function(){
        // swal('Gagal pagination');
      }
    });
    }
// next page
function nextPage() {
  selectPage(next);
}
// prev page
function prevPage() {
  selectPage(prev);
}
function selectPage(pageVal='0') {
  page=pageVal;
  pageSelek=page*records_per_page;
  // 
  $('#record_guru').empty();
  datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
  url=base_url+"guru/ajaxlistguru";
  $.ajax({
    url:url,
    data:datas,
    dataType:"text",
    type:"post",
    success:function(Data)
    {
      tb_token = JSON.parse(Data);
      $('#record_guru').append(tb_token);
    },
    error:function(e,jqXHR, textStatus, errorThrown)
    {
       }
     });
  //meridian adalah nilai tengah padination
  $('#page-'+meridian).removeClass('active');
  var newMeridian=page+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
    $("#page-prev").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prev=1;
    next=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#page-'+idPaginationhide;
      showPagination='#page-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridian){
    $("#page-prev").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridian;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridian-3;
        console.log("ini"+next);
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#page-'+idPaginationhide;
          showPagination='#page-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
          idPaginationshow--;
          idPaginationhide++;
        }
      }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridian+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#page-'+idPaginationhide;
      showPagination='#page-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  } 
  prev=newMeridian-2;
  next=newMeridian;
  meridian=newMeridian;
  $('#page-'+meridian).addClass('active');
}


function resetSandi(penggunaID='',namaPengguna='') {
		 url = base_url + "index.php/guru/resetPassword/";
		 var data;
	  swal({
	    title: "Yakin akan me-reset katasandi "+namaPengguna+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap me-reset katasandi!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							namaPengguna:namaPengguna};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){

	        swal("kata sandi baru : [namaPengguna]+[tgl sekarang] !", "Katasandi Baru = "+data, "success");
	      },
	      error:function(){
	        sweetAlert("Oops...", "Ktasandi gagal di reset!", "error");
	      }

	    });
	  });
	}

	function modalChEmail(penggunaID='',email='') {
		$('#modal-chEmail').modal('show');
		$('[name=email]').val(email);
		$('[name=penggunaID]').val(penggunaID);
	}

	function updateEmail() {
		var newEmail=$('[name=email]').val();
		var penggunaID=$('[name=penggunaID]').val();

		url = base_url + "index.php/guru/updateEmail/";
		 var data;
	  swal({
	    title: "Yakin akan mngubah Email "+penggunaID+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap menyimpan perubahan Email!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							email:newEmail};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	      	var ret= JSON.parse(data);
	      	if (ret=="FALSE") {
	      		sweetAlert("Oops...", "Email anda sudah terpakai!", "error");

	      	} else {
	      		swal("Email berhasil diperbaharui !", "Email Baru = "+data, "success");
            selectPage(page);
            paginationGuru();
            $('#modal-chEmail').modal('hide');

	      	}
	        
	      },
	      error:function(){
	        sweetAlert("Oops...", "Email gagal diperbaharui!", "error");
	      }

	    });
	  });
	}
	
	function detail(n) {
		$("#modal-chguru").modal('show');
		var id = "#data-"+n;
		var datas = $(id).data('todo');
		var guruID = datas.guruID;
		$('[name=guruID]').val(guruID);
		$('[name=namaDepan]').val(datas.namaDepan);
		$('[name=namaBelakang]').val(datas.namaBelakang);
		$('[name=alamat]').val(datas.alamat);
		$('[name=nokontak]').val(datas.noKontak);
		$('[name=biografi]').val(datas.biografi);

		// get all mapel
		var url1=base_url+"index.php/guru/get_allMapel/";
		// 
		$.ajax({
			dataType:'text',
			data:{guruID:guruID},
			type:"POST",
			url:url1,
			success:function (data) {
				var obData =JSON.parse(data);
		
				if (obData!="FALSE") {
					$(".selectMapel").append(obData);
				} else {
					console.log(obData);
				}
			},
			error:function(){
				swal("Oops..","ada Kesalahan uu!","error");
			}
		});
		// get mapel guru
		var url2 = base_url+"index.php/guru/get_mapelGuru/";
		$.ajax({
			dataType:'text',
			data:{guruID:guruID},
			type:"POST",
			url:url2,
			success:function(data){
				var ob2Data=JSON.parse(data);
				
				// listGuruMapel
				if (ob2Data !="FALSE") {
					$("#listGuruMapel").append(ob2Data);
					$('#resetMapel').removeClass('hidden');
					$("#mataPelajaran").addClass("hidden");
				}else{
					$("#listGuruMapel").append("<h4 class='pickMapel' style='color:red;'>Belum Memilih Mapel</h4>");
					$('#resetMapel').addClass('hidden');
					$("#mataPelajaran").removeClass("hidden");

				}

			},
			error:function(){
				swal("Oops..","ada Kesalahan!","error");
			}
		});
	}

	function updateDatGuru() {
		var guruID = $('[name=guruID]').val();
		var namaDepan = $('[name=namaDepan]').val();
		var namaBelakang = $('[name=namaBelakang]').val();
		var alamat = $('[name=alamat]').val();
		var nokontak = $('[name=nokontak]').val();
		var biografi = $('[name=biografi]').val();
		url = base_url + "index.php/guru/updateDatGuru/";
		var datas = {	guruID:guruID,
									namaDepan:namaDepan,
	    						namaBelakang:namaBelakang,
	    						alamat:alamat,
	    						nokontak:nokontak,
	    						biografi:biografi
	    						};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	        swal("Data Guru berhasil diperbaharui!","--","success");
	        selectPage(page);
          paginationGuru();

	      },
	      error:function(){
	        sweetAlert("Oops...", "Data Guru gagal diperbaharui!", "error");
	      }
	    });
	}

	function del_guru(n) {
		var id = "#data-"+n;
		var datGuru = $(id).data('todo');
		var penggunaID = datGuru.penggunaID;
		var namaPengguna = datGuru.namaPengguna;
		var guruID	=	datGuru.guruID;
		url = base_url + "index.php/guru/drop_teacher/";

		 swal({
	    title: "Yakin akan menghapus data "+namaPengguna+"?",
	    text: "Anda tidak dapat membatalkan ini.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap Hapus!",
	    closeOnConfirm: false
	  },
	  function(){
	    var datas = {penggunaID:penggunaID,
	    							guruID:guruID};
	    $.ajax({
	      dataType:"text",
	      data:datas,
	      type:"POST",
	      url:url,
	      success:function(data){
	      	swal("Data Guru "+namaPengguna+" Behasil Dihapus !", "", "success");
	      	selectPage(page);
          paginationGuru();
	      },
	      error:function(){
	        sweetAlert("Oops...", "Data Guru "+namaPengguna+" Gagal Dihapus!", "error");
	      }

	    });
	  });

	}

	function resetUlangMapel() {
		$('.pickMapel').remove();
		$('.op').remove();
	}



</script>