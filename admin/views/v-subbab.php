<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>"><!-- konten --><div class="row">    <div class="col-md-12">        <div class="panel panel-default">            <div class="panel-heading">                <h5 class="panel-title">Daftar Sub Bab Mata Pelajaran</h5>                <!-- Trigger the modal with a button -->                <button title="Tambah Data" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:-30px;" ><i class="ico-plus"></i></button>                <a href="<?= base_url('index.php/admin/daftarbab/') . $this->uri->segment(3) . '/' . $this->session->userdata['id_mp']; ?>" class="btn btn-default pull-right" style="margin-top:-30px;">Kembali</a>                <br>            </div>            <table class="table table-striped" id="zero-configuration" style="font-size: 13px">                <thead>                    <tr>                        <th class="text-center">ID</th>                        <th>Judul Sub BAB</th>                        <th>Deskripsi Sub BAB</th>                        <th class="text-center">Aksi</th>                    </tr>                </thead>                <tbody><!--                     <?php foreach ($babs as $bab): ?>                        <tr>                            <td class="text-center"><?= $bab->id ?></td>                            <td><?= $bab->judulSubBab ?></td>                            <td><?= $bab->sbket ?></td>                            <td class="text-center">                                <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $bab->id ?>" data-judul="<?= $bab->judulSubBab ?>" data-ket="<?= $bab->keterangan ?>" title="Rubah Data"><i class="ico-file5"></i></button>                                <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $bab->id ?>" data-nama="<?= $bab->judulSubBab ?>" title="Hapus Data"><i class="ico-remove"></i></button>                            </td>                                          </tr>                    <?php endforeach ?> -->                </tbody>            </table>        </div>    </div></div><!-- Modal --><div id="myModal" class="modal fade" role="dialog">    <div class="modal-dialog">        <!-- Modal content-->        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Tambah Data Sub BAB Mata Pelajaran</h4>            </div>            <form id = "form_tambahsb" action="<?= base_url('index.php/admin/tambahsubbabMP') ?>" method="post">                <div class="modal-body">                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-notebook"></i></span>                        <input name="idbab" value="<?= $this->uri->segment(5); ?>" type="hidden">                        <input name="jdlbab" value="<?= $this->uri->segment(4); ?>" type="hidden">                        <input name="nmmp" value="<?= $this->uri->segment(3); ?>" type="hidden">                        <input name="judulsubBab" type="text" class="form-control" placeholder="Judul Sub BAB" required> <br>                    </div>                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>                        <textarea class="form-control" id="desksubbab" name="desksubbab" value="" placeholder="deskripsi sub bab"></textarea>                    </div>                </div>                <div class="modal-footer">                    <button type="button" onclick = "simpan_subbab()" class="btn btn-primary">Simpan</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>                </div>            </form>        </div>    </div></div><div id="modalRubah" class="modal fade" role="dialog">    <div class="modal-dialog">        <!-- Modal content-->        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Rubah Data BAB Pelajaran</h4>            </div>            <form id = "form_rubahsb">                <div class="modal-body rubah">                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-notebook"></i></span>                        <input id='idsubBab' name="idsubBab" type="hidden">                        <input id="judulsubBab" name="judulsubBab" type="text" class="form-control" placeholder="Judul BAB" required> <br>                    </div>                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>                        <textarea id="desksubBab" class="form-control" name="desksubBab" placeholder="deskripsi sub bab" required>                        </textarea>                    </div>                </div>                <div class="modal-footer">                    <button type="button" onclick = "edit_sb()" class="btn btn-primary">Simpan</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>                </div>            </form>        </div>    </div></div><div id="modalHapus" class="modal fade" role="dialog">    <div class="modal-dialog">        Modal content        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Hapus Data Bab Pelajaran </h4>            </div>            <form id = "form_hapus" method="post">                <div class="modal-body">                    <div class="form-group input-group">                        <span><h4 class="text-center">Yakin akan menghapus data mata pelajaran</h4></span>                          <input name="idbab" value="<?= $this->uri->segment(5); ?>" type="hidden">                        <input name="jdlbab" value="<?= $this->uri->segment(4); ?>" type="hidden">                        <input name="nmmp" value="<?= $this->uri->segment(3); ?>" type="hidden">                        <input id='idsubBab' name="idsubBab" type="hidden">                    </div>                </div>                <div class="modal-footer">                    <button type="button" onclick = "hapus()" class="btn btn-primary">Ya</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>                </div>            </form>        </div>    </div></div><script type="text/javascript">var table;var jsubbab = $('input[name="judulsubBab"]');var dsubbab = $('textarea[name="desksubbab"]');var id_sub_bab = "<?=$this->uri->segment(5);?>";$(document).ready(function(){    table = $("#zero-configuration").DataTable({        "ajax" : {            "url" : "<?=base_url();?>index.php/admin/ajax_get_subbab/"+id_sub_bab,            "type" : "POST",        },        "emptyTable": "Tidak Ada Data Pesan",        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",        "bDestroy": true,    });});function simpan_subbab(){    if(jsubbab.val() == ""){        swal("Lengkapilah data");    }else if(dsubbab.val() == ""){        swal("Lengkapilah data");    }else{         $.ajax({        url : "<?= base_url('index.php/admin/tambahsubbabMP') ?>",        type : "POST",        dataType : "JSON",        data : $("#form_tambahsb").serialize(),        success:function(){            jsubbab.val("");            dsubbab.val("");            swal("Sub bab berhasil ditambahkan");            $("#myModal").modal('hide');            table.ajax.reload();        },        error:function(){            alert("error");        }    });    }}function rubah_subbab(id){    $('#modalRubah').modal("show");    $.ajax({        url:"<?= base_url('index.php/admin/get_edit_sb/') ?>"+id,        type: "GET",        dataType:"JSON",        success:function(data){            jsubbab.val(data.judulSubBab);            $('textarea[name="desksubBab"]').val(data.sbket);            $('input[name="idsubBab"]').val(data.subID);        }    })}//     $(document).on("click", "#rubahBtn", function () {//         var id = $(this).data('id');//         var judul = $(this).data('judul');//         var ket = $(this).data('ket');//         $(".rubah #idsubBab").val(id);//         $(".rubah #judulsubBab").val(judul);//         document.getElementById("desksubBab").value = ket;// //        document.getElementById("deskbab").value = ket;// //        $(".rubah #desk").val(ket);//         // As pointed out in comments, //         // it is superfluous to have to manually call the modal.//         $('#modalRubah').modal('show');//     });    $(document).on("click", "#hapusBtn", function () {        var Id = $(this).data('id');        $(".modal-body #idsubBab").val(Id);        // As pointed out in comments,         // it is superfluous to have to manually call the modal.        $('#modalHapus').modal('show');    });    function edit_sb(){        $.ajax({        url:"<?= base_url('index.php/admin/rubahsubbabMP')?>",        data:$("#form_rubahsb").serialize(),        dataType:"JSON",        type:"POST",        success:function(){        },        error:function(){           table.ajax.reload();            jsubbab.val("");            dsubbab.val("");            swal("Sub bab berhasil diperbaharui");            $("#modalRubah").modal('hide');        }        });    }    function hapus(){     $.ajax({        url:"<?= base_url('index.php/admin/hapussubbabMP') ?>",        data:$("#form_hapus").serialize(),        dataType:"JSON",        type:"POST",        success:function(){            table.ajax.reload();            swal("Sub bab berhasil dihapus");            $("#modalHapus").modal('hide');        },        error:function(){           alert("error");        }        });    }</script>