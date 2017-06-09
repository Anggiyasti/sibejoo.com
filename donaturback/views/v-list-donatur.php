<section id="main" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- panel tabel donatur -->
				<div class="panel panel-teal">
					<div class="panel-heading">
						<h3 class="panel-title">Zero configuration</h3>
					</div>
					<div class="panel-body">
							<div class="col-md-12" >
								<!-- recor per page tabel pengguna token -->
								<div class="col-md-2 mb2 mt10 pl0">
									<select  class="form-control" name="records_per_page_donatur" >
										<option value="10" selected="true">10</option>
										<option value="1">1</option>
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
								<th>No</th>
								<th>Nama</th>
								<th>Nama Pengguna</th>
								<th>email</th>
								<th>Jenis Member</th>
								<th>Aksi</th>
							</thead>
							<tbody id="record_daftar_donatur">

							</tbody>
						</table>
					</div>
				</div>
				<!-- /panel tabel donatur				 -->
			</div>
		</div>
	</div>	
</section>

<script type="text/javascript">

	$(document).ready(function () {
		function set_tb_donatur(){

			var url = base_url+"donaturback/ajax_donatur";
			$.ajax({
				url:url,
				// data:datas,
				dataType:"TEXt",
				type:"POST",
				success:function(Data){
					var ob_data=JSON.parse(Data);
					console.log(ob_data);
					$("#record_daftar_donatur").append(ob_data);
				},
				error:function(){

				}
			});
		}
		set_tb_donatur();
	});

	
</script>