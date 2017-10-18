<?php
//============================================================+
// File name   : v-list-siswa.php
// Begin       : 2017-05-02
// Last Update : 2017-10-17
//
// Description : List pagination siswa ajax
//               Untuk menggantikan v-daftar-siswa yg berupa datatable
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               Mrs Liliput
//               neonjogja.com

//============================================================+

/**
 * @author MrBebek
 * @since  2017-05-02
 */

 ?>
<div class="row">
<div class="col-md-12">
  <div class="panel panel-teal">
    <div class="panel-heading">
     <h3 class="panel-title">Daftar Siswa 
     </h3>

     <div class="panel-toolbar text-right">
      <a class="btn btn-inverse btn-outline" href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Siswa" ><i class="ico-plus"></i></a>
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
         <span class="input-group-addon btn" id="cariSiswa"><i class="ico-search"></i></span>
         <input class="form-control" type="text" name="cariSiswa" placeholder="Cari Data">
       </div>
     </div>
     <!-- div pencarian -->
   </div>
   <!-- div seting record dan pencarian -->
   <!-- div tabel daftar siswa -->
   <div class="col-md-12">
    <table class="table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>no</th>
          <th>Nama Lengkap</th>
          <th>Nama Pengguna</th>
          <th>Sekolah</th>
          <th>Email</th>
          <th>Report Siswa</th>
          <th>Aksi</th>
        </tr>
        <tbody id="record_siswa">

        </tbody>
      </table>
    </div>
    <!-- /div tabel daftar siswa -->
    <!-- div pagination daftar siswa -->
    <div class="col-md-12">
      <ul class="pagination pagination-siswa">

      </ul>
    </div>
    <!-- div pagination daftar siswa -->
  </div>
</div>
</div>

</div>
<!-- TABEL SISWA -->
<script type="text/javascript">
  var dataTableSiswa;
  var meridian=4;
  var prev=1;
  var next=2;
  var records_per_page=10;
  var page=0;
  var pageVal;
  var keySearch='';
  var url;
  var tb_siswa;
  var pageSelek=0;
  var datas ;
  $(document).ready(function(){
    //set tb_siswa
    function set_tb_siswa() {
      datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
      $('#record_siswa').empty();
      
      url=base_url+"siswa/ajax_list_siswa";
      $.ajax({
        url:url,
        data:datas,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
          tb_siswa = JSON.parse(Data);
          $('#record_siswa').append(tb_siswa);
        },
        error:function(e,jqXHR, textStatus, errorThrown)
        {
         sweetAlert("Oops...", e, "error");
       }
     });

    }

    set_tb_siswa();

    paginationSiswa();

    $('#cariSiswa').click(function(e){
      //get value dari input name cariSiswa
      keySearch=$('[name=cariSiswa]').val();
      selectPage(pageVal='0');
      paginationSiswa();
      //
    });

    // even untuk jumlah record per halaman
    $("[name=records_per_page]").change(function(){
      records_per_page =$('[name=records_per_page]').val();
      selectPage(0);
      paginationSiswa();
    });

  });
    
    //set pagination
    function paginationSiswa() {
      $.ajax({
        url:base_url+"siswa/pagination_siswa/",
        data:{records_per_page:records_per_page,keySearch:keySearch},
        type:"POST",
        dataType:"TEXT",
        success:function(data){
          $('.pagination-siswa').empty();
          $('.pagination-siswa').append(JSON.parse(data));
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
  $('#record_siswa').empty();
  datas ={records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
  url=base_url+"siswa/ajax_list_siswa";
  $.ajax({
    url:url,
    data:datas,
    dataType:"text",
    type:"post",
    success:function(Data)
    {
      tb_siswa = JSON.parse(Data);
      $('#record_siswa').append(tb_siswa);
    },
    error:function(e,jqXHR, textStatus, errorThrown)
    {
         // sweetAlert("Oops...", e, "error");
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

  var page=base_url+"siswa/listSiswa/"+$("input[name=page]").val();

    function dropSiswa(id,namaPengguna){
    swal({
      title: "Yakin akan menghapus "+namaPengguna+"?",
      text: "Anda tidak dapat membatalkan ini.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya,Tetap hapus!",
      closeOnConfirm: false
    },
    function(){
      var url = base_url+"siswa/del_pengguna_siswa";
      $.ajax({
        url:url,
        data:{id:id},
        dataType:"text",
        type:"post",
        success:function(){
            swal("Terhapus!", "Siswa berhasil dihapus.", "success");
            selectPage(page);
            paginationSiswa();
          
        },
        error:function(){
            sweetAlert("Oops...", "Data gagal terhapus!", "error");
        } 
      });
    });
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
</script>