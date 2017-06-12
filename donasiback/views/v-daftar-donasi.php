
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
      <table class="daftartoken table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
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
           <?php $status = ['','Idle','Konfirm','Diterima']; ?>
           <?php $donasi = ['','Heroo','Angel']; ?>

          <?php foreach ($donasi_items as $item): ?>
            <td>-</td>
            <td><?=$item->namaPengguna ?></td>
            <td><?=$donasi[$item->donasi] ?></td>
            <td><?=$item->tgl_create ?></td>
            <td>
              <?php $index = $item->donasi ?>
              <?=$status[$index] ?>
            </td>
            <td></td>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>