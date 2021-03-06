<script >


$('.lihat_step').click(function(){
	$('.daftar_step').modal('show');
	var url = base_url+"learningline/ajax_list_get_step/"+<?=$this->uri->segment(3)?>;
	tabel = $('.daftarsteptable').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		destroy: true,
		searching: false,
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
})
var value;
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


$('.simpan_step').click(function(){
	var form = {
		urutan:$('input[name=urutan]').val(),
		namastep:$('input[name=namastep]').val(),
		select_jenis:$('select[name=select_jenis]').val(),
		jumlah_benar:$('input[name=jumlahBenar]').val(),
		jumlah_soal_sedang:$('input[name=sedang]').val(),
		jumlah_soal_mudah:$('input[name=mudah]').val(),
		jumlah_soal_sulit:$('input[name=sulit]').val(),
		status_depedensi:$('input[name=dependensi]').val()
	};
	var url = base_url+"learningline/ajax_insert_line_step/";
	var data;
	var status_inputsoal = 'true';
	if (value==1) {

		data = {
			videoID:$('input[name=video]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			topikID:<?=$this->uri->segment(3)?>,
			status_depedensi:form.status_depedensi

		};
	}else if(value==2){

		data = {
			materiID:$('input[name=materi]:checked').val(),
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			topikID:<?=$this->uri->segment(3)?>,
			status_depedensi:form.status_depedensi

		};
	}else if(value==3){
		status_inputsoal = tambahkan_soal();
		
		data = {
			latihanID:"ada",
			urutan:form.urutan,
			namastep:form.namastep,
			select_jenis:form.select_jenis,
			topikID:<?=$this->uri->segment(3)?>,
			jumlah_benar:form.jumlah_benar,
			jumlah_soal_sedang:form.jumlah_soal_sedang,
			jumlah_soal_mudah:form.jumlah_soal_mudah,
			jumlah_soal_sulit:form.jumlah_soal_sulit,
			status_depedensi:form.status_depedensi

		};
	}else{
	}

	if (data.urutan=="" || data.namastep=="" || data.select_jenis=="") {
		swal('Silahkan lengkapi data');
	}else{
		if (status_inputsoal=='true') {
			$.ajax({
				data:data,
				datatType:"text",
				url:url,
				type:"POST",
				success:function(){
					swal('Step berhasil ditambahkan');
					$('.form-line')[0].reset();
					swal({
						title: "Step berhasil ditambahkan!",
						text: "Tambahkan baru, atau selesai?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Selesai",
						cancelButtonText: "Tambah",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
						// swal("selesai", "Anda akan dialihkan ke daftar step", "success");
						window.location.href = base_url+"learningline/step/"+data.topikID;
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
		}else{;
			swal('Oops','silahkan pilih soal terlebih dahulu','error');
		}

	}
});

//biar inputin number aja
$('.nomor').keyup(function () {
	var increased = parseInt(this.value);
    if(isNaN(increased) || increased <= 0) {
    		this.value = this.value.replace(/[^1-9\.]/g, '');
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
		'<h3 class="panel-title">Tabel Video</h3> '+
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
	var url = base_url+"learningline/ajax_get_video/"+babID;

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
		'<h3 class="panel-title">Tabel Materi</h3> '+
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
	var url = base_url+"learningline/ajax_get_materi/"+babID;

	tabel = $('.daftarvideo').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
	});
}

function load_soal(){
	var tabel;
	$('.jenis').html("<h4 class='text-center animation animating pulse'>Daftar Soal</h4>");
	$('.jenis').append('<div  class="form-group">'+
		'<label class="col-sm-3 control-label">Minimal Jumlah Benar</label>'+
		'<div class="col-sm-8">'+
		'<input type="number" placeholder="Jumlah Soal Benar" class="form-control nomor" name="jumlahBenar">'+
		'</div>'+
		'</div>');

	$('.jenis').append('<div  class="form-group">'+
		'<label class="col-sm-3 control-label">Pemilihan Soal</label>'+
		'<div class="col-sm-2">'+
		'<input type="number" placeholder="Jumlah Soal Mudah" class="form-control nomor" name="mudah">'+
		'</div>'+

		'<div class="col-sm-2">'+
		'<input type="number" placeholder="Jumlah Soal Sedang" class="form-control nomor" name="sedang">'+
		'</div>'+

		'<div class="col-sm-2">'+
		'<input type="number" placeholder="Jumlah Soal Sulit" class="form-control nomor" name="sulit">'+
		'</div>'+
		'</div>');

	$('.jenis').append(
		'<div class="container-fluid">'+
    	'<div class="row">'+
        '<div class="col-md-12">'+
        '<div class="panel panel-default">'+
        '<div class="panel-heading">'+
		'<h3 class="panel-title"><center>Tabel Soal</center></</h3> '+
		'<div class="panel-toolbar text-right">'+
		'</div>'+

		'</div>'+
		'<div class="panel-body">'+
		'<table class="daftarsoal table table-striped display responsive nowrap" style="font-size: 13px" width=100%>'+
		'<thead>'+
		'<tr>'+
		'<th></th>'+
		'<th>Judul Soal</th>'+
		'<th width="15%">Sumber</th>'+
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
		// '<a onclick="tambahkan_soal()" class="btn btn-primary tambahkan">Tambahkan</a>'+
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
	var url = base_url+"learningline/ajax_get_soal_byid/"+babID;
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

	//get soal yang telah ditambahkan 
	id_step = $('input[name=id]').val();	
	var url = base_url+"learningline/ajax_get_soal_tambah/"+id_step;

	tabel = $('#tblist').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"pageLength": 5,
	});
}


function tambahkan_soal(){
	latSession = "";
	var idsoal = [];

	$(':checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	var idsoal = [];
	babID = $('input[name=babID]').val();
	$(':checkbox:checked').each(function(i){
		idsoal[i] = $(this).val();
	}); 
	
	data = {
		bab:babID,id_soal:idsoal
	};
	if (idsoal.length > 0) {
		status = true;
		var url = base_url+"index.php/latihan/tambah_latihan_ajax_bab_step";
		$.ajax({
			url : url,
			type: "POST",
			dataType:'TEXT',
			data: data,
			success: function()
			{   
				status = true;
				// swal('Berhasil menambahkan soal');
				// tabel.ajax.reload();

			},
			error: function ()
			{
				// swal('Error adding / update data');
			}
		});
	} else {
		// swal('Silahkan Pilih Soal!');
		status = false;
	}

	return status;
}
// load video pada saat dipilih jenis video



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
	kelas = '.soal-'+data;
	meta = $(kelas).data('todo');
	$('.mdetailsoal').modal('show');
	$('.mdetailsoal h3.semibold').html(meta.judul_soal);

	$('.mdetailsoal p#dsoal').html(meta.soal);
	$('.mdetailsoal p#djawaban').html(meta.jawaban);
	MathJax.Hub.Queue(["Typeset",MathJax.Hub,"mdetailsoal"]); 
}

function reset(){
	$('input[name=namastep]').val("");
	$('input[name=urutan]').val("");
	$('select[name=select_jenis]').val(0);
}
</script>
