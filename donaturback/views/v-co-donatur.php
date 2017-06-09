<section id="main" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<!-- panel form donatur -->
				<form class="panel panel-teal " action="javascript:void(0)" id="form_donatur">
					<div class="panel-heading">
						<h3 class="panel-title">Form Donatur </h3>
					</div>
					<div class="panel-body">
						<div class="form-group note-msg-donatur hide">
							<div class="col-sm-12">
                  <div class="note note-warning mb15">Harap diise semua!!</div>
              </div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" name="nama">
								<input type="text" name="id" hidden="true">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Perusahaan</label>
							<div class="col-sm-8">
								<input class="form-control" type="text" name="namaPerusahaan">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Foto</label>
							<div class="col-sm-8">
								<input class="form-control" type="file" name="namaPerusahaan">
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-success" id="simpan">Simpan</button>
						<button class="btn btn-danger" id="reset_form">Reset</button>
					</div>
				</form>
				<!-- /panel form donatur -->
			</div>
			<div class="col-md-12">
				<!-- panel tabel donatur -->
				<div class="panel panel-teal">
					<div class="panel-heading">
						<h3 class="panel-title">List Donatur </h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12" >
							<!-- recor per page tabel pengguna token -->
							<div class="col-md-2 mb2 mt10 pl0">
								<select  class="form-control" name="records_per_page_donatur" >
									<option value="10" selected="true">10</option>
									<option value="25">25</option>
									<option value="50" >50</option>
									<option value="100">100</option>
									<option value="200">200</option>
								</select>
							</div>
							<!-- /recor per page tabel pengguna token -->
							<!-- div pencarian  -->
							<div class="col-md-10 mb10 mt10 pr0">
								<div class="input-group">
									<span class="input-group-addon btn" id="cariDonatur"><i class="ico-search"></i></span>
									<input class="form-control" type="text" name="cariDonatur" placeholder="Cari Data">
								</div>
							</div>
							<!-- div pencarian -->
						</div>
						<table class="table table-striped ">
							<thead>
								<th width="3%">No</th>
								<th width="5%">Logo</th>
								<th>Nama</th>
								<th>Perusahaan</th>
								<th>Aksi</th>
							</thead>
							<tbody id="record_daftar_donatur_co">

							</tbody>
						</table>
							<!-- div pagination daftar donatur co -->
							<div class="col-md-12">
								<ul class="pagination pagination-donatur-co">

								</ul>
							</div>
							<!-- div pagination daftar donatur co -->
					</div>
				</div>
				<!-- /panel tabel donatur -->
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
		var dataTableToken;
	  var meridian=4;
	  var prev=1;
	  var next=2;
	  var records_per_page=10;
	  var page=0;
	  var pageVal;
	  var keySearch='';
	  var pageSelek=0;
	  var datas ;
	$(document).ready(function () {
		//even btn id simpan
		//cek form input
		$('#simpan').click(function(){
			var nama = $('[name=nama]').val();
			var namaPerusahaan = $('[name=namaPerusahaan]').val();
			//cek jika nama dan perusahaan kosong atau  ' '
			if (nama!='' && nama!=' ' && namaPerusahaan!='' && namaPerusahaan!=' ') {
				form_aksi_donatur();
			}else{
				$('.note-msg-donatur').removeClass('hide');
			}
		});

		// even reset form
		// set empty input form
		// set btn Simpan
		$('#reset_form').change(function(){
				$("#form_donatur")[0].reset();
				$('#simpan').html('Simpan');
		});
		// even jumlah records_per_page_donatur
		$('[name=records_per_page_donatur]').change(function(){
			records_per_page=$('[name=records_per_page_donatur]').val();
			// console.log(records_per_page);
			set_donatur_co();
		});
		//even  cari donator
		// $('[name=]').
		$('#cariDonatur').click(function(){
			keySearch= $('[name=cariDonatur]').val();
			console.log(keySearch);
			set_donatur_co();
		});

		//set data tabel set donatur saat halaman pertama kali  di buka
		set_donatur_co();
		set_pagination_donatur_co();
	});
	//menjalankan fungsi simpan data donatur dan ubah data donatur
	function form_aksi_donatur() {
			var metode =	$('#simpan').html();
			var nama = $('[name=nama]').val();
			var id;
			var namaPerusahaan = $('[name=namaPerusahaan]').val();
			var datas;
			var url;
			// Cek button simpan atau ubah data
			if (metode=='Simpan') {
				datas = {nama:nama ,namaPerusahaan:namaPerusahaan};
				url=base_url+"donaturback/simpan_donatur_co";
			} else {
				id = $('[name=id]').val();
				datas = {nama:nama ,namaPerusahaan:namaPerusahaan,id:id};
				url=base_url+"donaturback/ubah_donatur_co";
			}
			$.ajax({
				url:url,
				data:datas,
				dataType:"TEXT",
				type:"POST",
				success:function(Data){
					//memanggil fungsi set_donatur_co untuk mengupdate data tabel
					set_donatur_co();
					//merubah kembali btn uabah ke btn simpan data
					$('#simpan').html('Simpan');
				},
				error:function(){
					//code error
				}
			});
	}

	// set data donatur ke tb
	function set_donatur_co(){
			var url=base_url+"donaturback/ajax_donatur_co";
			var datas = {records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
			$.ajax({
				url:url,
				data:datas,
				dataType:"TEXT",
				type:"POST",
				success:function(Data){
					// parse data jason donatur ke objek
					var ob_data=JSON.parse(Data);
					// kosongkan body tabel donatur dgn id  record_daftar_donatur_co
					$("#record_daftar_donatur_co").empty(ob_data);
					//set data tabel donatur ke body tabel dgn id  record_daftar_donatur_co
					$("#record_daftar_donatur_co").append(ob_data);
					$("#form_donatur")[0].reset();
				},
				error:function(){
						//code error
				}
			});
		}

	//set pagination 
	function set_pagination_donatur_co(){
		var url=base_url+"donaturback/ajax_pagination_donatur_co";
			var datas = {records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
			$.ajax({
				url:url,
				data:datas,
				dataType:"TEXT",
				type:"POST",
				success:function(Data){
					// parse data jason donatur ke objek
					var ob_data=JSON.parse(Data);
					// kosongkan pagination donatur dgn id  record_daftar_donatur_co
					$(".pagination-donatur-co").empty(ob_data);
					//set data tabel donatur ke body tabel dgn id  record_daftar_donatur_co
					$(".pagination-donatur-co").append(ob_data);
				},
				error:function(){
						//code error
				}
			});
	}
	//Hapus donatur perusahaan
	function hapus(id){
		swal({
			title: "Yakin akan mengahpus donatur ini ?",
			text: "Anda tidak dapat membatalkan ini.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya,Tetap hapus!",
			closeOnConfirm: false
		},
		function(){
			var url=base_url+"donaturback/hapus_donatur_co";
			$.ajax({
				url:url,
				data:{id:id},
				type:"post",
				dataType:"text",
				success:function(Data){
					sweetAlert(":.(","Data berhasil dihapus!","success");
					//memanggil fungsi set_donatur_co untuk mengupdate data tabel
					set_donatur_co();
				},
				error:function(){
					  sweetAlert("Oops...", "Data gagal terhapus!", "error");
				}
			});
		});
	}
	//set data donatur ke form yg akan di perbaharui
	function edit(id){
	//ubah btn Simpan menejadi btn perbaharui / update data
	$('#simpan').html('Perbaharui');
  var detail = '.detail-'+id;
  var datas = $(detail).data('id');
  //set data ke form input
		$('[name=nama]').val(datas.nama);
		$('[name=id]').val(datas.id);
		$('[name=namaPerusahaan]').val(datas.namaPerusahaan);
	}


	function selectPage(pageVal='0'){
	
		page=pageVal;
		pageSelek=page*records_per_page;
		set_donatur_co();
		// datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
		// $.ajax({
		// 	url:url,
		// 	data:datas,
		// 	dataType:"text",
		// 	type:"post",
		// 	success:function(Data)
		// 	{
  //       	// set emty tabel 
  //       	$('#record_daftar_admin').empty();
  //       	tb_admincabang = JSON.parse(Data);
  //         //set tabel
  //         $('#record_daftar_admin').append(tb_admincabang);
  //       },
  //       error:function(){

  //       },
  //     });	

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
</script>