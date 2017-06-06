<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center text-white">{judul_header}</h1>
    </div>
  </div>
</div>
</div>      
</section>
<!-- TITLE -->

<section>
  <div class="container">
    <div class="section-content">
      <div class="row">

      		<div class="col-md-6">
      			<h3>Daftar Pesan</h3>
	      		<select class="form-control" name="jenis">
	              <option value="all">Semua Jenis</option>
	              <option value="nilai">Nilai</option>
	              <option value="absen">Absen</option>
	              <option value="umum">Umum</option>
	            </select>
	        </div>
	        <div class="col-md-12">
		        <table class=" table daftarreport nowrap" style="font-size: 13px">
		        	<thead>
				      <tr>
				        <th>No</th>
				        <th>Jenis</th>
				        <th>Pesan</th>
				      </tr>
				    </thead>
				    <tbody>
				    	
				    </tbody>
		        </table>
			</div>

      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
var dataTableReport;
$(document).ready(function(){
  var mySelect = $('select[name=cabang]').val();
  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": base_url+"ortuback/report_ajax",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });


});


// JENIS KETIKA DI CHANGE
$('select[name=jenis]').change(function(){

  jenis = $('select[name=jenis]').val();

  url = base_url+"ortuback/report_ajax/"+jenis;

  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": url,
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});

function reload(){
  dataTableReport.ajax.reload(null,false); 
}

</script>
