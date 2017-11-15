<div class="page-content grid-row">

 <main>

  <div class="modal fade " tabindex="-1" role="dialog" id="myModal">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Pilih Bab Yang Akan Kamu Tanyakan</h4>
    </div>
    <div class="modal-body">

      <form class="form-group" id="formlatihan" method="post" onsubmit="return false;">
       <div class="alert alert-dismissable alert-danger" id="info" hidden="true" >
        <button type="button" class="close" onclick="hideme()" >×</button>
        <strong>Terjadi Kesalahan</strong> <br>Silahkan Lengkapi Data.
      </div>

      <p class="has-success">
        <label>Matapelajaran</label>
        <select class="form-control" name="mapel" id="mapelSelect">
         <option value=0>-Pilih Matapelajaran-</option>
         <?php foreach ($mapel as $mapel_item): ?>
          <option value=<?=$mapel_item['tingpelID'] ?>><?=$mapel_item['napel'] ?></option>  
        <?php endforeach ?>
      </select>
    </p>

    <p class="has-success">
      <label>Bab</label>
      <select class="form-control" name="tingkat" id="babSelect"  ><option value=0>-Pilih Bab-</option></select>
    </p>


    <div class="modal-footer bg-color-3">
      <button type="button" class="cws-button bt-color-1 border-radius alt small" data-dismiss="modal">Batal</button>
      <!-- <button type="button" class="cws-button bt-color-2 border-radius alt small buat-btn">Buat Pertanyaan</button> -->
    </div>

  </form>     
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>



</main>
<br>

<hr class="divider-color">

</div>

<script type="text/javascript">
  $.ajax({
    type: "POST",
    url: base_url+"konsultasi/get_tingkat_for_konsultasi",
    dataType: 'JSON',
    success: function(data){
      load_matapelajaran(data.tingkatID);
    }

  });


  $('#mapelSelect').change(function () {
    var idMapel = $(this).val();
    load_bab(idMapel);
  });

  $('#mapel_select_guru').change(function () {
    var mapel_id = $(this).val();
    load_bab_mapelid(mapel_id);
  });

  $('#babSelect').change(function () {
    load_mentor();
    get_mentor_siswa();
  });



// fungsi untuk ngeload matapelajaran
function load_matapelajaran(tingkatID){
  $.ajax({
    type: "POST",
    dataType: "json",
    data: tingkatID.tingkat_id,
    url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/" + tingkatID,
    success: function (data) {
      $('#mapelSelect').html('<option value="">Semua Mata Pelajaran</option>');
      $.each(data, function (i, data) {
        $('#mapelSelect').append("<option value='" + data.id + "'>" + data.keterangan + "</option>");
      });
      $('#babSelect').find('option').remove();
     $('#babSelect').append('<option value=0>Bab Pelajaran</option>');
    }
  });
}
// fungsi untuk ngeload matapelajaran




    //fungsi untuk ngeload bab berdasarkan tingkat-pelajaran id
    function load_bab(tingPelId) {
     $('#babSelect').find('option').remove();
     $('#babSelect').append('<option value=0>Bab Pelajaran</option>');
     var babID;
     $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>index.php/matapelajaran/get_bab_by_tingpel_id/" + tingPelId,
      success: function (data) {
       $.each(data, function (i, data) {
        $('#babSelect').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
       });
       load_mentor();   
       get_mentor_siswa();   
     }
    });
   }



   function mulai() {
     $('.buat-btn').text('proses...');
     window.location = base_url+"konsultasi/bertanya";
 }

function load_bab_mapelid(mapel_id){
     $('#bab_select_guru').find('option').remove();
     $('#bab_select_guru').append('<option value=0>Bab Pelajaran</option>');
     $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>index.php/matapelajaran/get_bab_by_mapel_id/" + mapel_id,
      success: function (data) {
       $.each(data, function (i, data) {
        $('#bab_select_guru').append("<option value='" + data.id + "'>" + data.judulBab + "</option>");
      });
     }
   });
}


 function hideme(){
   $('#info').hide();
 }
 $('.buat-btn').click(function () {
   mulai();
 });

 //fungsi untuk ngeload mentor berdasarkan bab id
    function load_mentor() {
      babID=$('#babSelect').find(":selected").val();
      $('#mentorSelect').find('option').remove();
      $('#mentorSelect').append('<option value=NULL>- Pilih Mentor -</option>');
       $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>index.php/konsultasi/get_mentor_by_bab/" + babID,
        success: function (data) {
         $.each(data, function (i, data) {
          $('#mentorSelect').append("<option value='" + data.guruID + "'>" + data.namaDepan + " " + data.namaBelakang  + "</option>");
         });
       }
      });
   }

   // get mentor siswa ini belum selesai
  function get_mentor_siswa() {
    babID=$('#babSelect').find(":selected").val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>index.php/konsultasi/get_mentor_for_siswa/" + babID,
      success: function (data) {
        hasil = JSON.parse(data);
        // cek dulu typenya boolean atau bukan?
        if (typeof hasil === 'boolean') {
          // kalo ada mentornya
          if (hasil==true) {
            $('.mentor').hide();
          // kalo gaada mentornya
          } else {
            $('.mentor').show();
          }
        } 
      }
    });
  }


</script>