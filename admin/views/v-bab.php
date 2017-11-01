<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>"><!-- konten --><!-- tes --><div class="row"> <div class="col-md-12">  <div class="panel panel-default">   <div class="panel-heading">    <h5 class="panel-title">Daftar Bab Mata Pelajaran</h5>    <!-- Trigger the modal with a button -->    <button title="Tambah Data" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:-30px;" ><i class="ico-plus"></i></button>    <a href="<?= base_url('index.php/admin/daftartingkatpelajaran') ?>" class="btn btn-default pull-right" style="margin-top:-30px;">Kembali</a>    <br>   </div>   <table class="table table-striped" id="zero" style="font-size: 13px">    <thead>     <tr>        <th class="text-center">NO</th>      <th>Judul BAB</th>      <th>Deskripsi BAB</th>      <th style="min-width: 100px;">Sub Bab</th>      <th>Konsultasi</th>      <th>Latihan</th>      <th>Learning Line</th>      <th class="text-center" style="min-width: 100px;">Aksi</th>     </tr>    </thead>    <tbody><!--      <?php foreach ($babs as $bab): ?>      <tr>       <td class="text-center"><?= $bab->idbab  ?></td>       <td><?= $bab->judulBab ?></td>       <td><?= $bab->babket ?></td>       <td><a href="<?= base_url('index.php/admin/daftarsubbab/' . $this->uri->segment(3) . '/' . $bab->judulBab . '/' . $bab->idbab); ?>" class="btn btn-default">Lihat</a></td>       <td><?=($bab->statusAksesKonsultasi == 1 ? "Member Only" : "Free") ?></td>       <td><?=($bab->statusAksesLatihan == 1 ? "Member Only" : "Free") ?></td>       <td><?=($bab->statusAksesLearningLine == 1 ? "Member Only" : "Free") ?></td>       <td class="text-center">        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $bab->idbab ?>" data-judul="<?= $bab->judulBab ?>" data-ket="<?= $bab->keterangan ?>" title="Rubah Data"><i class="ico-file5"></i></button>        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $bab->idbab ?>" data-nama="<?= $bab->judulBab ?>" title="Hapus Data"><i class="ico-remove"></i></button>       </td>      </tr>     <?php endforeach ?> -->    </tbody>   </table>  </div> </div></div><!-- Modal --><div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog">  <!-- Modal content-->  <div class="modal-content">   <div class="modal-header">    <button type="button" class="close" data-dismiss="modal">&times;</button>    <h4 class="modal-title">Tambah Data BAB Mata Pelajaran</h4>   </div>   <form id = "tambah_bab" method="post">    <div class="modal-body">     <div class="form-group input-group">      <span class="input-group-addon"><i class="ico-notebook"></i></span>      <input name="idtmp" value="<?= $this->uri->segment(4); ?>" type="hidden">      <input name="nmmp" value="<?= $this->uri->segment(3); ?>" type="hidden">      <input name="judulBab" type="text" class="form-control" placeholder="Judul BAB" required> <br>     </div>     <div class="form-group input-group">      <span class="input-group-addon"><i class="ico-file-upload"></i></span>      <textarea class="form-control" name="deskbab" placeholder = "Deskripsi Bab" value=""></textarea>     </div>     <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Latihan</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesLatihan">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesLatihan">Member       </label>      </div>     </div>     <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Learning Line</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesLearningLine">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesLearningLine">Member       </label>      </div>     </div>     <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Konsultasi</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesKonsultasi">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesKonsultasi">Member       </label>      </div>     </div>          <hr>    </div>    <div class="modal-footer">     <button type="button" onclick = "simpan_bab()" class="btn btn-primary">Simpan</button>     <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>    </div>   </form>  </div> </div></div><div id="modalRubah" class="modal fade" role="dialog"> <div class="modal-dialog">  <!-- Modal content-->  <div class="modal-content">   <div class="modal-header">    <button type="button" class="close" data-dismiss="modal">&times;</button>    <h4 class="modal-title">Rubah Data BAB Pelajaran</h4>   </div>   <form id = "rubah_bab" action="<?= base_url('index.php/admin/rubahbabMP') ?>" method="post">    <div class="modal-body rubah">     <div class="form-group input-group">      <span class="input-group-addon"><i class="ico-notebook"></i></span>      <input name="idtmp" value="<?= $this->uri->segment(4); ?>" type="hidden">      <input name="nmmp" value="<?= $this->uri->segment(3); ?>" type="hidden">      <input id='idrubah' name="idrubah" type="hidden">      <input id="judulBab" name="judulBab" type="text" class="form-control" placeholder="Judul BAB" required> <br>     </div>     <div class="form-group input-group">      <span class="input-group-addon"><i class="ico-file-upload"></i></span>      <textarea id="desk" class="form-control" name="deskbab" required>      </textarea>     </div>       <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Latihan</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesLatihan">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesLatihan">Member       </label>      </div>     </div>     <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Learning Line</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesLearningLine">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesLearningLine">Member       </label>      </div>     </div>     <hr>     <div class="form-group input-group">      <label class="col-sm-6 control-label">Status Akses Konsultasi</label>      <div class="col-sm-5">       <label class="radio-inline">        <input type="radio" value="0" name="statusAksesKonsultasi">Free       </label>       <label class="radio-inline">        <input type="radio" value="1" name="statusAksesKonsultasi">Member       </label>      </div>     </div>          <hr>    </div>    <div class="modal-footer">     <button type="button" onclick = "edit_bab()" class="btn btn-primary">Simpan</button>     <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>    </div>   </form>  </div> </div></div><div id="modalHapus" class="modal fade" role="dialog"> <div class="modal-dialog">  Modal content  <div class="modal-content">   <div class="modal-header">    <button  type="button" class="close" data-dismiss="modal">&times;</button>    <h4 class="modal-title">Hapus Data Bab Pelajaran </h4>   </div>   <form id = "form_hapus" action="<?= base_url('index.php/admin/hapusbabMP') ?>" method="post">    <div class="modal-body">     <div class="form-group input-group">      <span><h4 class="text-center">Apakah anda akan menghapus bab?</h4></span>        <input type="text" hidden="true" name="id" id="idMP" value=""/>      <input name="idtmp" value="<?= $this->uri->segment(4); ?>" type="hidden">      <input name="nmmp" value="<?= $this->uri->segment(3); ?>" type="hidden">     </div>    </div>    <div class="modal-footer">     <button type="button" onclick = "hapus_bab()" class="btn btn-primary">Ya</button>     <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>    </div>   </form>  </div> </div></div><script type="text/javascript">var idmapel = $('input[name="idtmp"]');var namaMapel = $('input[name="nmmp"]');var jbab = $('input[name="judulBab"]');var deskrip = $('textarea[name="deskbab"]');var table;var id_bab = "<?=$this->uri->segment(4);?>";var judul_bab = "<?=$this->uri->segment(3);?>";var url = "<?=base_url();?>index.php/admin/ajax_get_bab/"+id_bab;$(document).ready(function(){table = $("#zero").DataTable({  "ajax" : {    "url" : url,    "type" : "POST"  },    "emptyTable": "Tidak Ada Data Pesan",    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",    "bDestroy": true,});table.order([3,"desc"]);})function simpan_bab(){  if(jbab.val() == ""){    swal("Silahkan Lengkapi");  }else if(deskrip.val() == ""){    swal("Silahkan Lengkapi");  }else{    $.ajax({    url : "<?= base_url('index.php/admin/tambahbabMP') ?>",    type : "POST",    dataType : "JSON",    data : $("#tambah_bab").serialize(),    success:function(){      jbab.val("");      deskrip.val("");      $("#myModal").modal('hide');      table.ajax.reload();      swal("Berhasil ditambahkan");    },    error:function(){      alert("error");    }  })  }} // $(document).on("click", "#rubahBtn", function () { //  var id = $(this).data('id'); //  var judul = $(this).data('judul'); //  var ket = $(this).data('ket'); //  $(".rubah #idrubah").val(id); //  $(".rubah #judulBab").val(judul); //  document.getElementById("desk").value = ket; //        // As pointed out in comments,  //        // it is superfluous to have to manually call the modal. //        $('#modalRubah').modal('show'); //       }); $(document).on("click", "#hapusBtn", function () {  var Id = $(this).data('id');  $(".modal-body #idMP").val(Id);        // As pointed out in comments,         // it is superfluous to have to manually call the modal.        $('#modalHapus').modal('show');       });      function rubah_bab(id){        $("#modalRubah").modal("show");        $.ajax({          url : "<?= base_url('index.php/admin/getbabMP/') ?>"+id,          type: "GET",          dataType : "JSON",          success:function(list){            jbab.val(list.judulBab);            deskrip.val(list.babket);            $('input[name="idrubah"]').val(list.idbab);            $('input[name="statusAksesLatihan]').val(list.statusAksesLatihan);            $('input[name="statusAksesKonsultasi]').val(list.statusAksesKonsultasi);            $('input[name="statusAksesLearningLine]').val(list.statusAksesLearningLine);          }        })      }      function edit_bab(){        $.ajax({          url:"<?= base_url('index.php/admin/rubahbabMP') ?>",          data:$("#rubah_bab").serialize(),          type:"POST",          dataType:"JSON",          success:function(){            table.ajax.reload();            $("#modalRubah").modal("hide");            jbab.val("");            deskrip.val("");            swal("Berhasil diperbaharui");          },        });      }      function hapus_bab(){         $.ajax({          url:"<?= base_url('index.php/admin/hapusbabMP') ?>",          data:$("#form_hapus").serialize(),          type:"POST",          dataType:"JSON",          success:function(){            table.ajax.reload();            $("#modalHapus").modal("hide");            swal("Berhasil dihapus");          },          error:function(){            alert("error");          }        });;      }      </script>