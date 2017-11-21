<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://theromantic.com/wp-content/uploads/2015/08/Message-in-a-bottle-christmas-present.jpg">
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

      		<div class="col-md-4">
      			<h3>Daftar Pesan</h3>
	      		<select class="form-control" name="jenis">
	              <option value="all">Semua Jenis</option>
	              <option value="INFO">Info</option>
	              <option value="PROMO">Promo</option>
	              <option value="TOKEN">Token</option>
	            </select>
	        </div>
	        <div class="col-md-12">
		        <table class=" table daftarreport nowrap" style="font-size: 13px">
		        	<thead>
				      <tr>
				        <th>No</th>
				        <th>Jenis</th>
				        <th>Pesan</th>
                <th>Tanggal</th>
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
  dataTableReport = $('.daftarreport').DataTable({
    "ajax": {
      "url": base_url+"pesan/report_ajax",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
    "bLengthChange": false,
    "oLanguage": {"sLengthMenu": "\_MENU_"}
  });


});


// JENIS KETIKA DI CHANGE
$('select[name=jenis]').change(function(){

  jenis = $('select[name=jenis]').val();
  console.log(jenis);

  url = base_url+"pesan/report_ajax/"+jenis;

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
