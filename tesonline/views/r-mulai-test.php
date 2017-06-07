<div class="modal fade " tabindex="-1" role="dialog" id="myModal">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>

      </div>

      <div class="modal-body">

        <div id="chartContainer" style="height: 400px; width: 100%;">

        </div>

        <div class="modal-footer bg-color-3">



        </div>

      </form>



    </div>

  </div><!-- /.modal-content -->

</div><!-- /.modal-dialog -->

</div>

<div class="modal fade " tabindex="-1" role="dialog" id="myModal2">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title">Modal title</h4>

      </div>

      <div class="modal-body">





      </div>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div>

<!-- TITLE -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 99px;">
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

        <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
          <?php if ($this->session->userdata['HAKAKSES']=='ortu'): ?>
            <h3>Daftar Report</h3>
            <?php if ($report == array()): ?>
              <h4>Tidak ada Report Latihan.</h4>
            <?php else: ?>
              <table class="table 2" style="font-size: 13px">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nama Latihan</th>
                    <th>Tingkat Kesulitan</th>
                    <th>Tanggal Dibuat</th>
                    <th width="2%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($report as $reportitem): ?>
                    <tr>
                      <td><?= $reportitem['id_latihan'] ?></td>
                      <td><?= $reportitem['nm_latihan'] ?></td>
                      <td><?= $reportitem['tingkatKesulitan'] ?></td>
                      <td><?= $reportitem['tgl_pengerjaan'] ?></td>
                      <td>
                        <a class="btn btn-primary modal-on<?= $reportitem['id_latihan'] ?>" 
                          title="Lihat score" 
                          onclick="lihat_grafik(<?= $reportitem['id_latihan'] ?>)" 
                          data-todo='<?= json_encode($reportitem) ?>'>
                          <i class="glyphicon glyphicon-list-alt"></i>
                        </a>
                        <a class="btn btn-primary modal-on<?= $reportitem['id_latihan'] ?>" 
                          title="Lihat pembahasan" 
                          onclick="mulai_pembahasan(<?= $reportitem['id_latihan'] ?>)">
                          <i class="glyphicon glyphicon-book"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            <?php endif; ?>
          <?php else: ?>
            <h3>Daftar Latihan <a href="<?=base_url()?>index.php/tesonline" class="btn btn-gray btn-theme-colored hvr-icon-float-away">Buat Latihan&nbsp&nbsp</a></h3>

            <?php if ($latihan == array()): ?>
              <h4>Tidak ada latihan.</h4>
            <?php else: ?>
             <table class="table" style="font-size: 13px" id="zero-configuration">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama Latihan</th>
                  <th>Tingkat Kesulitan</th>
                  <th>Status Pengerjaan</th>
                  <th>Jumlah Soal</th>
                  <th>Tanggal Dibuat</th>
                  <th width="2%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($latihan as $latihanitem): ?>
                  <tr>
                    <td><?= $latihanitem['id_latihan'] ?></td>
                    <td><?= $latihanitem['nm_latihan'] ?></td>
                    <td><?= $latihanitem['tingkatKesulitan'] ?></td>
                    <td><?= $latihanitem['status_pengerjaan'] ?></td>
                    <td><?= $latihanitem['jumlahSoal'] ?></td>
                    <td><?= $latihanitem['date_created'] ?></td>
                    <td>
                      <a class="btn btn-dark btn-theme-colored btn-sm detail-<?= $latihanitem['id_latihan'] ?>" 
                        title="Kerjakan" 
                        onclick="mulai_test(<?= $latihanitem['id_latihan'] ?>)">
                        <i class="glyphicon glyphicon-pencil"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 pb-sm-20 mb10">
        <h3>Daftar Report</h3>
        <?php if ($report == array()): ?>
          <h4>Tidak ada Report Latihan.</h4>
        <?php else: ?>
          <table class="table 2" style="font-size: 13px">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama Latihan</th>
                <th>Tingkat Kesulitan</th>
                <th>Tanggal Dibuat</th>
                <th width="2%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($report as $reportitem): ?>
                <tr>
                  <td><?= $reportitem['id_latihan'] ?></td>
                  <td><?= $reportitem['nm_latihan'] ?></td>
                  <td><?= $reportitem['tingkatKesulitan'] ?></td>
                  <td><?= $reportitem['tgl_pengerjaan'] ?></td>
                  <td>
                    <a class="btn btn-dark btn-theme-colored btn-sm modal-on<?= $reportitem['id_latihan'] ?>" 
                      title="Lihat score" 
                      onclick="lihat_grafik(<?= $reportitem['id_latihan'] ?>)" 
                      data-todo='<?= json_encode($reportitem) ?>'>
                      <i class="glyphicon glyphicon-list-alt"></i>
                    </a>
                    <a class="btn btn-dark btn-theme-colored btn-sm modal-on<?= $reportitem['id_latihan'] ?>" 
                      title="Lihat pembahasan" 
                      onclick="mulai_pembahasan(<?= $reportitem['id_latihan'] ?>)">
                      <i class="glyphicon glyphicon-book"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
      
    </div>
  </div>
</div>
</section>

<script type="text/javascript">

  function load_grafik(data) {
    var report = {
      durasi: 0,
      level: 0,
      poin: 0,
      konstanta: 0,
      score: 0};



                    //report.durasi = 10;
                    report.jumlah_soal = parseInt(data.jumlahSoal);
                    report.level = parseInt(data.tingkatKesulitan);
                    report.poin = parseInt(data.jmlh_benar);
                    //report.konstanta =  report.durasi * report.jumlah_soal;
                    report.score = data.jmlh_benar;
                    var chart = new CanvasJS.Chart("chartContainer", {
                      title: {
                        text: "nama latihan : " + data.nm_latihan + " - Score : " + report.score

                      },
                      animationEnabled: true,
                      theme: "theme1",
                      data: [
                      {
                        type: "doughnut",
                        indexLabelFontFamily: "Garamond",
                        indexLabelFontSize: 20,
                        startAngle: 0,
                        indexLabelFontColor: "dimgrey",
                        indexLabelLineColor: "darkgrey",
                        toolTipContent: "Jumlah : {y} ",
                        dataPoints: [
                        {y: data.jmlh_benar, indexLabel: "Poin {y}"},
                        {y: data.jmlh_salah, indexLabel: "Salah {y}"},
                        {y: data.jmlh_kosong, indexLabel: "Kosong {y}"}

                        ]

                      }

                      ]

                    });

                    chart.render();

                  }



                  function lihat_grafik(id) {
                    var kelas = ".modal-on" + id;
                    var data = $(kelas).data('todo');
                    $('.modal-title').text('Grafik Latihan ');
                    $('#myModal').modal('show');
                    load_grafik(data);
                  }



                  function show_report() {
                    $('#myModal2').modal('show');
                    $('#myModal2 modal-title').text('Report Latihan');
                  }



                  function mulai_test(id_latihan) {
                    window.location.href = base_url + "index.php/latihan/create_session_id_latihan/" + id_latihan;

                  }

                  function mulai_pembahasan(id_pembahasan) {
                    window.location.href = base_url + "index.php/latihan/create_session_id_pembahasan/" + id_pembahasan;

                  }


                  $(document).ready(function () {
                    $('.table').DataTable();
                    $('.table 2').DataTable();
                  })



                </script>

                <script src="<?= base_url('assets/back/plugins/canvasjs.min.js') ?>"></script>


                