<!-- Modal -->
<div id="modal_konfirmasi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title">Daftar Token 

       </h3>


       <div class="panel-toolbar text-right">
         <div class="col-sm-12 text-right">
           <span><b>Filter: </b></span>
           <input name="status_token" value="1" type="radio" class="mt10" title="Free"> <i class="ico-user mr10"></i>  
           <input name="status_token" value="0" type="radio" title="Angel"> <i class="ico-user7 mr10"></i>   
           <input name="status_token" value="0" type="radio" title="Heroo"> <i class="ico-user8 "></i>
         </div>
       </div>
     </div>
     <div class="panel-body">
      <table class="daftar_donasi table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>
            <th>no</th>
            <th>Nama Donatur</th>
            <th>Jenis Donasi</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th width="15%">Aksi</th>

          </tr>
        </thead>

        <tbody>
         <?php $status = ['','Idle','Wait to Konfirm','Diterima','Kirim Token']; ?>
         <?php $donasi = ['','Heroo','Angel']; ?>
         <?php $no = 1; ?>

         <?php foreach ($donasi_items as $item): ?>
          <td><?=$no ?></td>
          <td><?=$item->namaPengguna ?></td>
          <td><?=$donasi[$item->donasi] ?></td>
          <td><?=$item->tgl_create ?></td>
          <td>
            <?php $index = $item->status_donasi ?>
            <?=$status[$index] ?>
          </td>
          <td>
            <?php if ($item->status_donasi==1): ?>
              <button type="button" class="btn btn-default mb5" disabled="true"><i class="ico-cart-remove2"></i> Belum Transfer</button>
            <?php elseif($item->status_donasi==2): ?>
              <button  onclick="info(<?=$item->donasi_id ?>)" type="button" class="btn btn-info mb5" ><i class="ico-file"></i> Info</button>
            <?php elseif($item->status_donasi==3): ?>
              <button  onclick="set_token(<?=$item->donasi_id ?>)" type="button" class="btn btn-primary mb5" ><i class="ico-barcode3"></i> Set Token</button>
            <?php else: ?>
              <button   onclick="kirim_token(<?=$item->donasi_id ?>)" type="button" class="btn btn-primary mb5" ><i class="ico-mail-send"></i> Kirim Token</button>
            <?php endif ?>
          </td>
          <?php $no++; ?>

        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
    $('.daftar_donasi').DataTable();
  });

  function info(id_donasi){
    $.post(base_url+"donasiback/get_konfirmasi_by_id_donasi", {id_donasi:id_donasi}, function(data, textStatus) {
      $('#modal_konfirmasi').modal('show');
      $('#modal_konfirmasi .modal-title').html("Konfirmasi donasi atas nama "+data.namaPengguna);
      $('#modal_konfirmasi .modal-body').html("");
      $('#modal_konfirmasi .modal-body').append("<p>Nama Rekening Pengirim : "+data.nama_rek_pengirim +"<p>");
      $('#modal_konfirmasi .modal-body').append("<p>Nama Bank Pengirim : "+data.bank_pengirim +"<p>");
      $('#modal_konfirmasi .modal-body').append("<p>Nama Bank Penerima : "+data.nama_rek_pengirim +"<p>");
      $('#modal_konfirmasi .modal-body').append("<p>Bukti Transfer <br>: <img  class='text-center' src="+base_url+"/assets/image/konfirmasi_donasi/"+data.bukti_transfer+" width='50%' /><p>");
      $('#modal_konfirmasi .modal-footer').html( "<button type='button' class='btn btn-info' onclick='konfirm("+data.id_donasi+")'>Konfirm</button>"+
        " <button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
    }, "json");
  }


  function konfirm(id_donasi){
    $.post(base_url+"donasiback/konfirmasi_donasi", {id_donasi:id_donasi}, function(data, textStatus) {
      swal('yeah!',data,'success');
      $('#modal_konfirmasi').modal('hide');
    }, "json");
  }

  function set_token(data){
    id_donasi = data;

    $.post(base_url+"donasiback/set_siswa_donasi", {id:id_donasi}, function(data, textStatus) {
      if (data.status==1) {
        swal('Berhasil dikirim',data.message,'success')
      }else{
        swal('Gagal Mengirim',data.message,'warning');
      }
    }, "json");
  }

  function kirim_token(data){
    console.log(data);
  }

</script>