<section style="background: #666666;padding: 0">
    <div class="container">
      <div class="col-md-10 col-md-offset-1 text-center">
        <div class="inline-block pb-60 pl-60 pr-60 pt-40" data-bg-color="rgba(255,255,255, 0.8)" style="background: rgba(255, 255, 255, 0.8) !important;">
          <h1 class="text-uppercase text-theme-colored font-raleway font-weight-800 mb-0 mt-0 font-48">Hi, <span class="text-theme-color-2"><?=$this->session->userdata('USERNAME') ?> !</span></h1>
          <p class="font-16 text-black font-raleway letter-spacing-1 mb-20">{pesan}</p>
          <?php if ($this->session->userdata('sisa_token')>0): ?>
              <input type="text" name="kode_token" class="form-control" style="width: 100%;margin-bottom: 10px" placeholder="Masukan Kode Token" disabled="">
          <?php else: ?> 
            <input type="text" name="kode_token" class="form-control" style="width: 100%;margin-bottom: 10px" placeholder="Masukan Kode Token">
        <?php endif ?>
        <a class="btn btn-colored btn-theme-colored isi_button" href="#">Isi</a> 
    </div>
</div>
</div>
</section>

<script type="">
    $('.isi_button').click(function(){
        kode_token = $('input[name=kode_token]').val();
        url = base_url+"token/isi_token";
        $.ajax({
            type:'POST',
            data:{kode_token:kode_token},
            url:base_url+"token/isi_token",
            dataType:"TEXT",
            success:function(data){
                console.log(data);
                if (data=="1") {     
                    swal('Yeah','Token Berhasil di aktifkan, silahkan menikmati layanan kami !','success');
                    window.location = base_url+"welcome";
                }else{
                    swal('Oops','Kode Token Salah','error');
                }
            },error:function(){
                swal('Ooops','Gagal terhubung ke server','error');
            }
        });
    })
</script>