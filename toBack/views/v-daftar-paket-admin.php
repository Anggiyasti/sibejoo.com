<div class="row">
  <div class="col-md-12 kirim_token">
    <div class="panel panel-teal">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Paket TO   </h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-12">
           <div class="col-sm-3">
             <!-- kalo gada yang di filter -->
             <?php if (!empty($post)): ?>
             
               <input name="filter_to" type="hidden" value="<?=$post['to']  ?>">
               <input name="filter_paket" type="hidden" value="<?=$post['paket']  ?>">
             <?php endif ?>
           
          </div>

          <div class="col-sm-3">
           <select class="form-control" id="select_to">
            <option value="all">Semua Tryout</option>   
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-3">
         <select class="form-control col-sm-6" id="select_paket">
          <option value="all">Semua paket</option>
          </select>
          <!-- <button class="btn btn-sm btn-inverse " onclick="pdf()">PDF</button> -->
        </div>
           <div class="col-sm-3 mt5 ml0 pl0 pr0">
          <!-- dropdown laporan -->
        <div class="btn-group" style="margin-bottom:5px;">
          <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">Download Report<span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="javascript:void(0);" onclick="pdf_rto()"">PDF Report TO </a></li>
            <li><a href="javascript:void(0);" onclick="pdf()">PDF Report Paket </a></li>
            <!-- <li class="divider"></li> -->
            <!-- <li><a href="javascript:void(0);"  onclick="excel()">Excel Report TO </a></li> -->
          </ul>
        </div>
        <!-- /dropdown laporan -->
        </div>
      </div>
   
    </div>

  </div>

  <div class="panel-body">
    <div class="col-md-12" >
      <!-- recor per page tabel pengguna token -->
      <div class="col-md-2 mb2 mt10 pl0">
        <select  class="form-control" name="records_per_page" >
          <!-- <option value="10" selected="true">records per page</option> -->
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50" selected="true">50</option>
          <option value="100">100</option>
          <option value="200">200</option>
        </select>
      </div>
      <!-- /recor per page tabel pengguna token -->
      <!-- div pencarian  -->
      <div class="col-md-10 mb10 mt10 pr0">
        <div class="input-group">
           <span class="input-group-addon btn" id="cariDat"><i class="ico-search"></i></span>
           <input class="form-control" type="text" name="cariDat" placeholder="Cari Data">
        </div>
      </div>
      <!-- div pencarian -->
      </div>
    <table class="daftarpaket table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
        
           <th>No</th>
          <th>Nis CBT</th>
          <th>Nama SIswa</th>
           <th>Nama Paket</th>
          <th>Jumlah Soal</th>
          <th>Benar</th>
          <th>Salah</th>
          <th>Kosong</th>
          <th>Nilai</th>
          <th>Waktu Mengerjakan</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody id="record_daftar_paket">

      </tbody>

    </table>
    <!-- div pagination daftar token -->
    <div class="col-md-12">
      <ul class="pagination pagination-paket">

      </ul>
    </div>
    <!-- div pagination daftar token -->
  </div>

</div>
</div>   
</div>

<script type="text/javascript">
  var tb_paket;
  var mySelect
  var url;
  var dataPaket;
  var records_per_page=50;
  var page=0;
  var pagination_paket;
  var pageVal=0;
  var pageSelek=0;
  var meridian=4;
  var prev=1;
  var next=2;
  var tryout="all";
  var paket="all";
  var keySearch='';
  // next page
function nextPage() {
  selectPagePaket(next);
}
// prev page
function prevPage() {
  selectPagePaket(prev);
}
  $(document).ready(function(){
    set_tb_paket();
    function set_tb_paket() { 
      url=base_url+"toback/laporanto";
      dataPaket={records_per_page:records_per_page,page:pageSelek,tryout:tryout,paket:paket,keySearch:keySearch};
      $.ajax({
        url:url,
        data:dataPaket,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
          tb_paket = JSON.parse(Data);
          $('#record_daftar_paket').append(tb_paket);
          // console.log(Data);
        },
        error:function(){
        },
      });

      
    }
    
    function set_pagination_tb_paket() {
      url=base_url+"toback/pagination_daftar_paket";
      dataPaket={records_per_page:records_per_page,page:pageSelek,tryout:tryout,paket:paket,keySearch:keySearch};
      $.ajax({
        url:url,
        data:dataPaket,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
       $('.pagination-paket').empty();
          pagination_paket = JSON.parse(Data);
          $('.pagination-paket').append(pagination_paket);
        },
        error:function(){

        },
      });
    }
    

      // even untuk jumlah record per halaman
    $("[name=records_per_page]").change(function(){
      records_per_page =$('[name=records_per_page]').val();
           selectPagePaket();
        set_pagination_tb_paket();
    });

    // TO KETIKA DI CHANGE
  $('#select_to').change(function(){
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
    selectPagePaket();
    set_pagination_tb_paket();
    load_paket(tryout);
  });

  // TO KETIKA DI CHANGE
  $('#select_paket').change(function(){
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
    selectPagePaket();
    set_pagination_tb_paket();
  });

  $('#cariDat').click(function(e){
      //get value dari input name cariDat
      keySearch=$('[name=cariDat]').val();
      selectPagePaket();
      set_pagination_tb_paket();
      //
    });
});
function selectPagePaket(pageVal='0') {
  $('#record_daftar_paket').empty();
  page=pageVal;
  pageSelek=page*records_per_page;
  url=base_url+"toback/laporanto";
  dataPaket={records_per_page:records_per_page,page:pageSelek,tryout:tryout,paket:paket,keySearch:keySearch};
  $.ajax({
    url:url,
    data:dataPaket,
    dataType:"text",
    type:"post",
    success:function(Data)
    {
      tb_paket = JSON.parse(Data);
      $('#record_daftar_paket').append(tb_paket);
    },
    error:function(){
      // sweetAlert("Oops...", e, "error");
    },
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

//ketika paket di change
function load_paket(id_to){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>toback/get_paket/"+id_to,
  success: function(data){
   $('#select_paket').html('<option value="all">-- Pilih Paket  --</option>');
   $.each(data, function(i, data){
    $('#select_paket').append("<option value='"+data.id_paket+"'>"+data.nm_paket+"</option>");
  });
 }
});
}



// laporan pdf per paket
function pdf() {
  /// TOMBOL PDF KETIKA DI KLIK
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();
  if ( tryout != "all" && paket != "all") {
    url = base_url+"toback/laporanPDF/"+tryout+"/"+paket;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih tryout dan paket!","error");
  }
}

//laporan pdf per to
function pdf_rto() {
  tryout = $('#select_to').val();
  if (tryout != "all") {
    url = base_url+"toback/laporan_to_PDF/"+tryout;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih  tryout!","error");
  }
}

function excel() {
  /// TOMBOL PDF KETIKA DI KLIK
  tryout = $('#select_to').val();
  paket = $('#select_paket').val();
  if (tryout != "all" && paket != "all") {
    url = base_url+"toback/laporan_paket_excel/"+tryout+"/"+paket;
    window.open(url, '_blank');
  }else{
    sweetAlert("Oops...", "Silahkan pilih tryout dan paket!","error");
  }
}

function drop_report(datas){
  url = base_url+"toback/drop_report";

  swal({
    title: "Yakin akan hapus report?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    $.ajax({
      dataType:"text",
      data:{id_report:datas},
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Data report berhasil dihapus.", "success");
        dataTablePaket.ajax.reload(null,false);
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }
    });
  });
}
</script>