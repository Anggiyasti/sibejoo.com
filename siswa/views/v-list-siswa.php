<?php
//============================================================+
// File name   : v-list-siswa.php
// Begin       : 2017-05-02
// Last Update : -
//
// Description : List pagination siswa
//               Untuk menggantikan v-daftar-siswa yg berupa datatable
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               neonjogja.com

//============================================================+

/**
 * @author MrBebek
 * @since  2017-05-02
 */

 ?>


 <!-- <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>"> -->
<section id="main" role="main">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Daftar Siswa</h3>
                  <!-- Start menu tambah siswa -->
                  <div class="panel-toolbar text-right">
                  <a class="btn btn-inverse btn-outline" href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Data" ><i class="ico-plus"></i></a>
                  </div>
                  <!-- END menu tambah siswa -->
                </div>

         <!-- Funsi cari -->
            <div class="panel-body">
                <form action="<?=base_url()?>index.php/siswa/cariSiswa" method="get">
                <div class="input-group mb10">
                        <input id="carisoal" type="text" name="keyword" class="form-control " placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn  btn-success" type="submit" >Cari</button>
                        </span>
                    </div>
                </form>
                <input type="text" name="page" value="<?=$this->uri->segment('3')?>" hidden="true">
                <table class="daftarsiswa table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
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
                    </thead>

                    <tbody>
                    <?php 
                     $no = $this->uri->segment('3') + 1;
                    foreach ($siswa as $key): ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$key["nama"];?></td>
                        <td><?=$key["namaPengguna"];?></td>
                        <td><?=$key["namaSekolah"];?></td>
                        <td><?=$key["eMail"];?></td>
                        <td><?=$key["report"];?></td>
                        <td><?=$key["aksi"];?></td>
                        </tr>
                    <?php 
                    $no++;
                    endforeach ?>

                    </tbody>
                </table>

        </div>
        <div class="panel-footer">
       
           <ul class="pagination mt0 mb0 col-sm-6">
              <?php 

              echo $this->pagination->create_links();

              ?>

            </ul>
                        <div class="text-right col-sm-6"><a href="javascript:void(0);"><?=$jumlahSiswa?> terdaftar</a></div>
      </div>
            </div>
        </div>
    </div>
</section>
<!-- on keypres cari soal -->


<script type="text/javascript">

  $(document).ready(function() { 
    var site = "<?php echo site_url();?>";
    $( "#carisoal" ).autocomplete({
        source:  site+"/siswa/autocompleteSiswa",
        select: function (event, ui) {
            source:  site+"/siswa/autocompleteSiswa",
                window.location = ui.item.url;
                }
    });

});
</script>
<script type="text/javascript">
    var page=base_url+"siswa/listSiswa/"+$("input[name=page]").val();

    function dropSiswa(idsiswa, idpengguna) {
        if (confirm('Apakah Anda yakin akan menghapus data ini? ')) {
            // ajax delete data to database
            $.ajax({
                url: base_url + "index.php/siswa/deleteSiswa/" + idsiswa + "/" + idpengguna,
                data: "idsiswa=" + idsiswa + "&idpengguna=" + idpengguna,
                type: "POST",
                dataType: "TEXT",
                success: function (data, respone)
                {
                     window.location.href =page;
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                    console.log(errorThrown);
                }
            });
        }
    }

    function reload_tblist() {
        tb_siswa.ajax.reload(null, false);
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
      var url = base_url+"ortuback/del_pengguna_ortu";
      $.ajax({
        url:url,
        data:{id:id},
        dataType:"text",
        type:"post",
        success:function(){
          sweetAlert("Data berhasil di hapus","","success");
          swal({
          title: "Data berhasil di hapus",
          type: "success",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = base_url+"siswa/listsiswa";
          } 
        });
        },
        error:function(){

        }
      });
    });
  }

</script>
