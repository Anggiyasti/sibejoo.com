<script>
var babID = <?=$this->uri->segment(3);?>;
var url = base_url + "learningline/ajax_get_list_topik/"+babID;

$(document).ready(function(){
		dataTableLearning = $('.daftartopik ').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"bDestroy": true,

	});
})

/*## -----------------------------Drop Learning-------------------------------##*/
function drop_topik(idtopik){
	url = base_url+"learningline/drop_topik";
	swal({
		title: "Yakin akan hapus Topik?",
		text: "Jika anda menghapus topik, step juga akan terhapus",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var datas = {id:idtopik};
		$.ajax({
			dataType:"text",
			data:datas,
			type:"POST",
			url:url,
			success:function(){
				swal("Terhapus!", "Topik berhasil dihapus.", "success");
				dataTableLearning.ajax.reload(null,false);
			},
			error:function(){
				sweetAlert("Oops...", "Data gagal terhapus!", "error");
			}

		});
	});
}
/*## -----------------------------Drop Learning-------------------------------##*/

//detail topik
function detail_topik(data){

	$('.detail_learning').modal('show');
	button = "<a href="+base_url+"learningline/formstep/"+data+" class='btn btn-inverse btn-outline'  aria-label='Close' title='Step Baru'><span aria-hidden='true'><i class='ico-plus'></i></span></a>";
	judul = " <h4 class='modal-title' style='display: inline'>Daftar Step Yang Harus Dikerjakan</h4>";
	$('.detail_learning .modal-header').html(button+""+judul);

	var url = base_url+"learningline/ajax_list_get_step/"+data;
	console.log(url);
	dataTableLearning = $('.daftarsteptable').DataTable({
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"emptyTable": "Tidak Ada Data Pesan",
		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
		"bDestroy": true,

	});

}
//update data
function updatestatus(id,status){
	var url;
	if (status==1) {
		url = base_url+"learningline/updatepasive/"+id;
	}else{
		url = base_url+"learningline/updateaktiv/"+id;		
	}

	swal({
		title: "Anda Akan Merubah status learning?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya, update",
		cancelButtonText: "Tidak, batalan",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			$.ajax({
				url:url,
				dataType:"TEXT",
				type:'POST',
				success:function(){
					swal("Berhasil diupdate!", "status learning diaktifkan.", "success");
					tabel.ajax.reload(null,false);
				},
				error:function(){
					swal('gagal');
				}}
				);
		} else {
			swal("Dibatalkan", "Data batal diperbaharui", "error");
			tabel.ajax.reload(null,false);
		}
	});
}
function drop_step(idstep){
	url = base_url+"learningline/drop_step";
	swal({
		title: "Yakin akan hapus Step?",
		text: "Jika anda menghapus Step",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ya,Tetap hapus!",
		closeOnConfirm: false
	},
	function(){
		var datas = {id:idstep};
		$.ajax({
			dataType:"text",
			data:datas,
			type:"POST",
			url:url,
			success:function(){
				swal("Terhapus!", "Step berhasil dihapus.", "success");
				location.reload();
			},
			error:function(){
				sweetAlert("Oops...", "Data gagal terhapus!", "error");
			dataTableLearning.ajax.reload(null,false);

			}

		});
	});
}
</script>