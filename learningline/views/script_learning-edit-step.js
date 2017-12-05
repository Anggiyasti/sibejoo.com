<script>
var value;




$(document).ready(function(){
	stepID = "<?=$this->uri->segment(3);?>";
	relasi = $('input[name=relasi]').val();
	value = $('input[name=jenis_step]').val();
	topikID = $('input[name=topikID]').val();
	var tabel;
	var tabel2;

	if (value==1) {
		$('select[name=select_jenis]').html("<option value='1'>Video</option>"+"<option value='2'>Materi</option>"+"<option value='3'>Latihan</option>");
	}else if(value==2){
		$('select[name=select_jenis]').html("<option value='2'>Materi</option>"+"<option value='3'>Latihan</option>"+"<option value='1'>Video</option>");
	}else{
		$('select[name=select_jenis]').html("<option value='3'>Latihan</option>"+"<option value='2'>Materi</option>"+"<option value='1'>Video</option>");

	}
	if (value==1) {
		load_video();
	}else if(value==2){
		load_materi();
		// $('.jenis').html("<h4 class='text-center animation animating pulse'>Materi</h4>");
	}else if(value==3){
		load_soal();
		// $('.jenis').html("<h4 class='text-center animation animating pulse'>Latihan</h4>");		
	}else{
		$('.jenis').html("<h4 class='text-center animation animating pulse'>Error</h4>");
	}
})
$('select[name=select_jenis]').change(function(){
	value = $('select[name=select_jenis]').val();
	if (value==1) {
		load_video();
	}else if(value==2){
		load_materi();
	}else if(value==3){
		load_soal();	
	}else{
		$('.jenis').html("<h4 class='text-center animation animating pulse'>Silahkan pilih jenis</h4>");
	}
});




function update(data){
	var url = base_url+"learningline/ajax_update_learning_step/";

	if (data.urutan=="" || data.namastep=="" || data.select_jenist) {
		swal('Silahkan lengkapi data');
	}else{
		$.ajax({
			data:data,
			datatType:"text",
			url:url,
			type:"POST",
			success:function(){
				swal('step berhasil Diperbaharui');
				// $('.form-line')[0].reset();
				swal({
					title: "step berhasil Diperbaharui!",
					text: "edit lagi atau selesai?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Selesai",
					cancelButtonText: "Edit",
					closeOnConfirm: false,
					// closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						// swal("selesai", "Anda akan dialihkan ke daftar step", "success");
						window.location.href = base_url+"learningline/step/"+topikID;
					} else {
						swal("Tambah Data", "silahkan ambahkan data");
						$('.jenis').html("<h4 class='text-center animation animating pulse'>Pilih Jenis Terlebih Dahulu</h4>");	
					}
				});

			},
			error:function(){
				sweetAlert('Data gagal disimpan','error');
			}
		});
	}
}
$('.update_step').click(function(){
	var form = {
		urutan:$('input[name=urutan]').val(),
		namastep:$('input[name=namastep]').val(),
		select_jenis:$('select[name=select_jenis]').val(),
	};
	var data;
	if (value==1) {
		data = {
			videoID:$('input[name=video]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			id:$('input[name=id]').val()
		};
		update(data);
	}else if(value==2){
		data = {
			materiID:$('input[name=materi]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			id:$('input[name=id]').val()
		};
		update(data);
	}else if(value==3){
		data = {
			latihanID:$('input[name=]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			id:$('input[name=id]').val(),
			jumlah_soal_mudah:$('input[name=mudah]').val(),
			jumlah_soal_sedang:$('input[name=sedang]').val(),
			jumlah_soal_sulit:$('input[name=sulit]').val(),
			jumlah_benar:$('input[name=jumlahBenar]').val()
		};
		update(data);
	}else{
		swal('Silahkan Pilih Jenis Step!');
	}


});
//biar inputin number aja
$('input[name=urutan]').keyup(function () {
	if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	}
});

//# ketika tombol di klik
function detail(id){
	var kelas ='.detail-'+id;
	var data = $(kelas).data('id');
	var links;
	var url = base_url+"assets/file_materi/"+data.url_file;

	$('h3.semibold').html(data.judulMateri);
		// links = '<?=base_url();?>assets/video/' + data.namaFile;
		if (data.isiMateri == null || data.isiMateri == '') {
			$('#isicontent').html("<embed src="+url+" type='application/pdf' height='500px' width='100%''>");
	//jika data url file
}else{
	$('#isicontent').html(data.isiMateri); 

}

$('.detail_materi').modal('show');


}
//##

// load video pada saat dipilih jenis video
function load_video(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Video</h4>");
	$('.jenis').append(
		'<div class="container-fluid">'+
    	'<div class="row">'+
        '<div class="col-md-12">'+
        '<div class="panel panel-default">'+
        '<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Topik Line</</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id video</th>'+
		'<th>Judul Sub Bab</th>'+

		'<th>Judul Video</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+

		'</div>');

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_video_edit/"+babID+"/"+value+"/"+relasi;

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});

}
// load video pada saat dipilih jenis video

// load video pada saat dipilih jenis video
function load_materi(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Materi</h4>");
	$('.jenis').append(
		'<div class="container-fluid">'+
    	'<div class="row">'+
        '<div class="col-md-12">'+
        '<div class="panel panel-default">'+
        '<div class="panel-heading">'+
		'<h3 class="panel-title">Tabel Materi</</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarvideo table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th>Id Materi</th>'+
		'<th>Judul Materi</th>'+
		'<th>Isi Materi</th>'+
		'<th width="10%">pilih</th>'+
		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+

		'</div>');
	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/ajax_get_materi_edit/"+babID+"/"+relasi;

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
}
// load video pada saat dipilih jenis video
$(".video_checkbox").change(function(){
	alert(',asdu');
});

// the selector will match all input controls of type :checkbox
// and attach a click event handler 
/*$("input['name=video']").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  alert('nasyj');
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});*/
function reset(){
	$('input[name=namastep]').val("");
	$('input[name=urutan]').val("");
}
function load_soal(){


	$('.jenis').html("<h4 class='text-center animation animating pulse'>Keterangan Soal</h4>");
	$('.jenis').append('<div  class="form-group">'+
		'<label class="col-sm-3 control-label">Minimal Jumlah Benar</label>'+
		'<div class="col-sm-8">'+
		'<input type="number" value = "{jumlah_benar}" placeholder="Jumlah Soal Benar" class="form-control nomor" name="jumlahBenar">'+
		'</div>'+
		'</div>');

	$('.jenis').append('<div  class="form-group">'+
		'<label class="col-sm-3 control-label">Pemilihan Soal</label>'+
		'<div class="col-sm-2">'+
		'<input type="number" value = "{jumlah_soal_mudah}" placeholder="Jumlah Soal Mudah" class="form-control nomor" name="mudah">'+
		'</div>'+

		'<div class="col-sm-2">'+
		'<input type="number" value = "{jumlah_soal_sedang}" placeholder="Jumlah Soal Sedang" class="form-control nomor" name="sedang">'+
		'</div>'+

		'<div class="col-sm-2">'+
		'<input type="number" value = "{jumlah_soal_sulit}"  placeholder="Jumlah Soal Sulit" class="form-control nomor" name="sulit">'+
		'</div>'+
		'</div>');

	$('.jenis').append(
		'<div class="container-fluid">'+
    	'<div class="row">'+
        '<div class="col-md-12">'+
        '<div class="panel panel-default">'+
        '<div class="panel-heading">'+
		'<h3 class="panel-title"><center>Soal Belum Ditambahkan</center></</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body" >'+
		'<table class="daftarsoal_belum table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th></th>'+
		'<th>Judul Soal</th>'+
		'<th>Sumber</th>'+
		'<th>Soal</th>'+
		'<th>Kesulitan</th>'+
		'<th width="5%">Aksi</th>'+

		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'<div class="panel-footer">'+
		'<div class="form-group no-border">'+
		'<label class="col-sm-1 control-label"></label>'+
		'<div class="col-sm-9">'+
		'<a onclick="tambahkan_soal()" class="btn btn-primary tambahkan">Tambahkan</a>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'
		);

	$('.jenis').append(
		'<div class="container-fluid">'+
    	'<div class="row">'+
        '<div class="col-md-12">'+
        '<div class="panel panel-default">'+
        '<div class="panel-heading">'+
		'<h3 class="panel-title"><center>Soal Sudah Ditambahkan</center></</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarsoal table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th></th>'+
		'<th>Judul Soal</th>'+
		'<th>Sumber</th>'+
		'<th>Soal</th>'+
		'<th>Kesulitan</th>'+
		'<th width="5%">Aksi</th>'+

		'</tr>'+
		'</thead>'+

		'<tbody>'+

		'</tbody>'+
		'</table>'+
		'<div class="panel-footer">'+
		'<div class="form-group no-border">'+
		'<label class="col-sm-1 control-label"></label>'+
		'<div class="col-sm-9">'+
		'<a onclick="drop_soal()" class="btn btn-danger hapus_soal">Hapus</a>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'+
		'</div>'
		);

	// var url = base_url+"learningline/ajax_get_video/"+<?=$this->uri->segment(3)?>+"";
	babID = $('input[name=babID]').val();	
	var url = base_url+"learningline/get_soal_on_latihan/"+stepID;
	var url2 = base_url+"learningline/ajax_get_soal_edit/"+babID+"/"+stepID;

	tabel2 = $('.daftarsoal_belum').DataTable({
		"drawCallback": function( settings ) {
        MathJax.Hub.Queue(["Typeset",MathJax.Hub]); 
    },
		"ajax": {
			"url": url2,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"pageLength": 5,
	}); 

	tabel = $('.daftarsoal').DataTable({
		"drawCallback": function( settings ) {
        MathJax.Hub.Queue(["Typeset",MathJax.Hub]); 
    },
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"pageLength": 5,
	});


}

// FUNGSI MELIHAT VIDEO
function play(data){
	kelas = '.video-'+data;
	meta = $(kelas).data('todo');
	$('.detail_video').modal('show');
	judul = " <h4 class='modal-title' style='display: inline'>Preview Video "+meta.judulVideo;
	if (meta.namaFile==null) {
		video = '<iframe width="100%" height="400"'+
		'src="'+meta.link+'">'+
		'</iframe>';
		$('.detail_video .modal-body').html(video);
	}else{
		file = base_url+"assets/video/"+meta.namaFile;
		video = '<video width="100%" height="400" controls>'+
		'<source src="'+file+'" type="video/mp4">'+
		'<source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.'+
		'</video>';
		$('.detail_video .modal-body').html(video);
	}
	$('.detail_video .modal-header').html(judul);
}

// dESTROY KETIKA MODAL DICLOSE
$('.detail_video').on('hide.bs.modal', function(e) {    
	var $if = $(e.delegateTarget).find('iframe');
	var src = $if.attr("src");
	$if.attr("src", '/empty.html');
	$if.attr("src", src);
});

function detail_soal(data){
	// console.log(data);
	kelas = '.soal-'+data;
	meta = $(kelas).data('todo');
	$('.mdetailsoal').modal('show');
	$('.mdetailsoal h3.semibold').html(meta.judul_soal);

	$('.mdetailsoal p#dsoal').html(meta.soal);
	$('.mdetailsoal p#djawaban').html(meta.jawaban);
	 MathJax.Hub.Queue(["Typeset",MathJax.Hub,"mdetailsoal"]); 
}

function tambahkan_soal(){
	latSession = "";
	var idsoal = [];

	$('.daftarsoal_belum  :checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	var idsoal = [];
	babID = $('input[name=babID]').val();
	$('.daftarsoal_belum  :checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	
	data = {
		bab:babID,id_soal:idsoal,
		step:stepID
	};

	if (idsoal.length > 0) {
		var url = base_url+"index.php/latihan/edit_soal_at_latihan";
		$.ajax({
			url : url,
			type: "POST",
			dataType:'JSON',
			data: data,
			success: function(data)
			{   
				swal('Yeah','Berhasil menambahkan soal','success');
				tabel.ajax.reload();
				tabel2.ajax.reload();
			},
			error: function (data)
			{
				swal('Oops','Error adding / update data','error');
			}
		});
	} else {
		swal('Oops','Berhasil menambahkan soal','error');

	}
}

function drop_soal(){
	latSession = "";
	var id_mm_sol_lat = [];

	$('.daftarsoal  :checkbox:checked').each(function(i){
		id_mm_sol_lat[i] = $(this).val();
	}); 
	var id_mm_sol_lat = [];
	$('.daftarsoal  :checkbox:checked').each(function(i){
		id_mm_sol_lat[i] = $(this).val();
	}); 
	datas = {id_mm_sol_lat:id_mm_sol_lat};
	if (id_mm_sol_lat.length > 0) {
		var url = base_url+"index.php/latihan/drop_soal_from_latihan";
		$.ajax({
			url : url,
			type: "POST",
			dataType:'text',
			data: datas,
			success: function(data)
			{
				swal('Yeah','Berhasil menghapus soal','success');
				tabel.ajax.reload();
				tabel2.ajax.reload();
			},
			error: function (data)
			{
				swal('Oops','Error adding / update data','error');
			}
		});
	} else {
		swal('Oops','Silahkan Pilih Soal Yang Akan Dihapus','error');
	}


}

</script>

