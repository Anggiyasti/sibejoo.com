<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>"><!-- konten --><div class="row">    <div class="col-md-12">        <div class="panel panel-default">            <div class="panel-heading">                <h5 class="panel-title">Daftar Mata Pelajaran</h5>                <!-- Trigger the modal with a button -->                <button title="Tambah Data" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:-30px;" ><i class="ico-plus"></i></button>                <br>                <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->            </div>            <table class = "table table-bordered" id="zero_configuration" style="font-size: 13px">                <thead>                    <tr>                        <th class="text-center">NO</th>                        <th>Nama Mata Pelajaran</th>                        <th>Alias</th>                        <th class="text-center">Aksi</th>                    </tr>                </thead>                <tbody>                </tbody>            </table>        </div>    </div></div><!-- Modal --><div id="myModal" class="modal fade" role="dialog">    <div class="modal-dialog">        <!-- Modal content-->        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Tambah Data Mata Pelajaran</h4>            </div>            <form id = "myForm" method="post">                <div class="modal-body">                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-notebook"></i></span>                        <input name="namaMP" type="text" class="form-control" placeholder="Nama Mata Pelajaran" required> <br>                    </div>                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>                        <input name="aliasMP" type="text" class="form-control"  placeholder="Alias" required> <br>                    </div>                </div>                <div class="modal-footer">                    <button type="button" onclick = "simpan()" class="btn btn-primary">Simpan</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>                </div>            </form>        </div>    </div></div><div id="modalRubah" class="modal fade" role="dialog">    <div class="modal-dialog">        <!-- Modal content-->        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Rubah Data Mata Pelajaran</h4>            </div>            <form id = "form_ubah">                <div class="modal-body rubah">                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-notebook"></i></span>                        <input name="namaMP1" id="namaMP" type="text" class="form-control" placeholder="Nama Mata Pelajaran" required> <br>                    </div>                    <div class="form-group input-group">                        <span class="input-group-addon"><i class="ico-file-upload"></i></span>                        <input name="aliasMP1" id="aliasMP" type="text" class="form-control"  placeholder="Alias" required> <br>                    </div>                    <div class="form-group input-group">                        <input type="text" hidden="true" name="idMP" id="idMP" value=""/>                    </div>                </div>                <div class="modal-footer">                    <button type="button" onclick = "edit()" class="btn btn-primary">Simpan</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>                </div>            </form>        </div>    </div></div><div id="modalHapus" class="modal fade" role="dialog">    <div class="modal-dialog">         Modal content        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4 class="modal-title">Hapus Data </h4>            </div>            <form id = "form_hapus">                <div class="modal-body">                    <div class="form-group input-group">                        <span><h4 class="text-center">Yakin akan menghapus data mata pelajaran</h4></span>                          <input type="text" hidden="true" name="idMP" id="idMP" value=""/>                    </div>                </div>                <div class="modal-footer">                    <button type="button"  class="btn btn-primary" onclick = "hapus()">Yakin</button>                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>                </div>            </form>        </div>    </div></div><script type="text/javascript">var table;var url = base_url + "index.php/admin/get_list_mapel";var id = "#zero_configuration";    $(document).ready(function(){        table = $(id).DataTable({            "ajax": {            "url": url,            "type": "POST"        },        "emptyTable": "Tidak Ada Data Pesan",        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",        });    });    function ajax_edit(id){        $.ajax({            url:base_url + "index.php/admin/ajax_edit_mapel/"+id,            type:"GET",            dataType:"JSON",            success:function(data){                $('#modalRubah').modal('show');                $('input[name="idMP"]').val(data.id);                $('input[name="namaMP1"]').val(data.namaMataPelajaran);                $('input[name="aliasMP1"]').val(data.aliasMataPelajaran);            }        });    }    function simpan(){        var nameMP = $('input[name="namaMP"]').val();        var aliasMP =  $('input[name="aliasMP"]').val();        pola_inputan=new RegExp(/^[a-z A-Z 0-9 \_\-]+$/);        if(nameMP == ""){            swal("Silakan lengkapi data");        }else if(aliasMP == ""){            swal("Silakan lengkapi data");        }else{            if (!pola_inputan.test(nameMP) || !pola_inputan.test(aliasMP)){                swal ('Oops','Mata Pelajaran hanya boleh Huruf,Angka, karakter _ , karakter -','warning');            } else {                $.ajax({                    url:"<?= base_url('index.php/admin/tambahMP') ?>",                    data:$("#myForm").serialize(),                    type:"POST",                    dataType:"JSON",                    success:function(){                    table.ajax.reload();                    $('#myModal').modal('hide');                    $('input[name="namaMP"]').val("");                    $('input[name="aliasMP"]').val("");                    swal("Berhasil ditambahkan");                    },                    error:function(){                        alert("error");                    }                });            }        }    }        function edit(){        mp = $('input[name="namaMP1"]').val();        alias = $('input[name="aliasMP1"]').val();        pola_inputan=new RegExp(/^[a-z A-Z 0-9 \_\-]+$/);        if (!pola_inputan.test(mp) || !pola_inputan.test(alias)){                swal ('Oops','Mata Pelajaran hanya boleh Huruf,Angka, karakter _ , karakter -','warning');        } else {            console.log($("#form_ubah").serialize());            $.ajax({                url:"<?= base_url('index.php/admin/rubahMP') ?>",                data:$("#form_ubah").serialize(),                type:"POST",                dataType:"JSON",                success:function(data){                table.ajax.reload();                $('#modalRubah').modal('hide');                swal("Berhasil diperbaharui");                },                error:function(){                    alert("error");                }            });        }    }    function hapus(id){               swal({            title: "Anda Akan Menghapus Mata Pelajaran Ini?",            type: "warning",            showCancelButton: true,            confirmButtonColor: "#DD6B55",            confirmButtonText: "Ya, Hapus",            cancelButtonText: "Tidak, batalan",            closeOnConfirm: false,            closeOnCancel: false    },function(isConfirm){        if(isConfirm){            $.ajax({            url:"<?= base_url('index.php/admin/hapusMP') ?>/"+id,            data:$("#form_hapus").serialize(),            type:"POST",            dataType:"JSON",            success:function(){            swal("Berhasil dihapus");            table.ajax.reload();                   },            error:function(){                alert("error");            }        });        }else{            swal("gagal dihapus");        }        }        )    }</script>