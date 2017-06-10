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
							<div class="col-sm-8 mb10">
								<input class="form-control" type="text" name="nama">
								<input type="text" name="id" hidden="true">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Perusahaan</label>
							<div class="col-sm-8 mb10">
								<input class="form-control" type="text" name="namaPerusahaan">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Logo</label>
							<div class="col-sm-8">
								<label for="filelogo" class="btn btn-sm btn-default filelogo">
									Pilih Logo
								</label>
								<input style="display:none;" type="file" id="filelogo" name="logo" onchange="cek_fileLogo(this,z='');"/>
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

			<div class="col-sm-6">
				<div class="panel panel-teal">
      	<div class="panel-heading">
      		<h3 class="panel-title">Preview Logo</h3>
      	</div>  
      	<div class="panel-body pb0 pt0 pl0 pr0">
      		<!-- START Statistic Widget -->
      		<div class="table-layout animation delay animating fadeInDown  prv_logo mb0">
      			<div class="col-xs-4 panel bgcolor-info text-center">
      				<img id="prevfile" class="img-tumbnail logo" src="<?=base_url()?>assets\image\avatar\default.png" width="50%"  >
      			</div>
      	<!-- 		<div class="col-xs-8 panel">
      				<div class="panel-body ">
      		<h6>Name: <span id="namefile"></span></h6> 
      		<h6>Size: <span id="sizefile"></span>Kb</h6>
      			<h6>Type: <span id="typefile"></span></h6>  
      				</div>
      			</div> -->
      		</div>
      		<!--/ END Statistic Widget -->
      	</div>
      	<div class="panel-footer pb0 pt0 pl0 pr0">
      		<!-- <div class="row" style="margin:1%;">  -->
      			<div class="col-md-5 left"> 
      				<h6>Name: <span id="namefile"></span></h6> 
      			</div> 
      			<div class="col-md-4 left"> 
      				<h6>Size: <span id="sizefile"></span>Kb</h6> 
      			</div> 
      			<div class="col-md-3 bottom"> 
      				<h6>Type: <span id="typefile"></span></h6> 
      			</div>
      		<!-- </div> -->
      	</div>
      	</div>                      
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
								<th>Tanggal Donasi</th>
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

<!-- Start Modal salah upload gambar -->
<div class="modal fade" id="warningupload" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek type extension gambar! </h3>
        <h5 class="text-center">Type yang bisa di upload hanya ".jpg", ".jpeg", ".bmp", ".gif", ".png"</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Start Modal salah upload size img -->
<div class="modal fade" id="e_size_img" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text-center text-danger">Peringatan</h2>
      </div>
      <div class="modal-body">
        <h3 class="text-center">Silahkan cek file size Logo!</h3>
        <h5 class="text-center">File size logo maksimal 100kb</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<!-- /Script ajax upload -->
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
		$('#reset_form').click(function(){
				$("#form_donatur")[0].reset();
				$('#simpan').html('Simpan');
				var logo=base_url+'assets/image/avatar/default.png';
				$('#prevfile').attr('src', logo);
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
			var namaPerusahaan = $('[name=namaPerusahaan]').val();
			var logo = $('[name=logo]').val();
			//id fileinput
			var elementId = "filelogo";
			var id;
			var datas;
			var url;
			// Cek button simpan atau ubah data
			if (metode=='Simpan') {
				datas = {nama:nama ,namaPerusahaan:namaPerusahaan,logo:logo};
				url=base_url+"donaturback/simpan_donatur_co";
			} else {
				id = $('[name=id]').val();
				var detail = '.detail-'+id;
  			var datas = $(detail).data('id');
  			var old_logo=datas.logo;
				datas = {nama:nama ,namaPerusahaan:namaPerusahaan,id:id,logo:logo,old_logo:old_logo};
				url=base_url+"donaturback/ubah_donatur_co";
			}
			$.ajaxFileUpload({
				url:url,
				data:datas,
				dataType:"TEXT",
				type:"POST",
				fileElementId :elementId,
				success:function(Data){
					//memanggil fungsi set_donatur_co untuk mengupdate data tabel
					set_donatur_co();
					//merubah kembali btn uabah ke btn simpan data
					$('#simpan').html('Simpan');
					//reset preview ogo
					var logo=base_url+'assets/image/avatar/default.png';
					$('#prevfile').attr('src', logo);
					sweetAlert("Info",Data,"success")
				},
				error:function(){
					
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
		var filelogo=datas.logo;
		if (filelogo!=''&&filelogo!=' ') {
			var logo=base_url+'assets/image/donatur/logo_perusahaan/'+filelogo;
		}else{
			var logo=base_url+'assets/image/avatar/default.png';
		}
		$('#prevfile').attr('src', logo);
		console.log(logo);
	}


	function selectPage(pageVal='0'){
		page=pageVal;
		pageSelek=page*records_per_page;
		set_donatur_co();
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

 // show preview Logo
 //cek file input
  function cek_fileLogo(oInput,z='') {
  	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
  	if (oInput.type == "file") {
  		var sFileName = oInput.value;
  		if (sFileName.length > 0) {
  			var blnValid = false;
  			for (var j = 0; j < _validFileExtensions.length; j++) {
  				var sCurExtension = _validFileExtensions[j];
  				if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
  					blnValid = true;
  					break;
  				}
  			}

  			if (!blnValid) {
  				$('#warningupload').modal('show');
                return false;
        }else{
        	preview_fileLogo(oInput,z='');
        }
      }
    }
          return true;
  }

  function preview_fileLogo(oInput,z='') {
  	var viewer = {
  		load : function(e){
  			$('#prevfile'+z).attr('src', e.target.result);
  		},
  		setProperties : function(file){
  			$('#namefile'+z).text(file.name);
  			$('#typefile'+z).text(file.type);
  			$('#sizefile'+z).text(Math.round(file.size/1024));
  		},
  	}
  	var file = oInput.files[0];
  	var reader = new FileReader();
  	var size=Math.round(file.size/1024);
      // start pengecekan ukuran file
      if (size>=100) {
        $('#e_size_img').modal('show');
      }else{
      	$(".prv_logo"+z).show();
      	reader.onload = viewer.load;
      	reader.readAsDataURL(file);
      	viewer.setProperties(file);
      }
  }
  //hapus logo
  function drop_logo(id){
  	var detail = '.detail-'+id;
  	var datas = $(detail).data('id');
  	var old_logo = datas.logo;
  	var url =base_url+"donaturback/hapus_logo";

  	swal({
  		title: "Yakin akan mengahpus logo ini ?",
  		text: "Anda tidak dapat membatalkan ini.",
  		type: "warning",
  		showCancelButton: true,
  		confirmButtonColor: "#DD6B55",
  		confirmButtonText: "Ya,Tetap hapus!",
  		closeOnConfirm: false
  	},
  	function(){

  		$.ajax({
  			url:url,
  			data:{id:id,old_logo:old_logo},
  			dataType:"text",
  			type:"post",
  			success:function(){
  				sweetAlert(":(","Logo berhasil dihapus!","success");
  				set_donatur_co();
  			},
  			error:function(){

  			}
  		});
  	});

  

  }
</script>