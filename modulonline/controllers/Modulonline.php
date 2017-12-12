<?php
class Modulonline extends MX_Controller {

    private $upload_path = "./assets/modul";
    function __construct() {
        parent::__construct();
        $this->load->model('Mmodulonline');
        $this->load->library('Ajax_pagination');
        $this->perPage = 6;
        $this->load->model('komenback/mkomen');
        $this->load->model('templating/Mtemplating');
        $this->load->model( 'matapelajaran/mmatapelajaran' );
        $this->load->model( 'tingkat/MTingkat' );
        $this->load->library('parser');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();

    }

    public function index(){
        $this->allmodul();
    }


    ## START FUNCTION UNTUK HALAMAN ALL SOAL##
    //function untuk menampilkan halaman all soal
    public function daftar_modul(){
        $data['judul_halaman'] = "Sibejoo - Modul Online";
        $data['files'] = array(
            APPPATH . 'modules/modulonline/views/v-edu-all.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            $this->parser->parse('admin/v-index-admin', $data);
        }
        elseif( $hakAkses=='admin_cabang' ){
            $this->parser->parse('admincabang/v-index-admincabang', $data);
        }
        elseif($hakAkses=='guru'){
          // jika guru
          // notification
          $data['datKomen']=$this->datKomen();
          $id_guru = $this->session->userdata['id_guru'];
          // get jumlah komen yg belum di baca
          $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
          $this->parser->parse('templating/index-b-guru', $data);            
      }
        else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
    }
        #END Cek USer#
}

    // ajax untuk menampilkan semua modul
    function ajax_listAllModul() {
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        //pengecekan ketika admin dan guru yang masuk
        if($hakAkses=='admin'){
            $modul = $this->Mmodulonline->get_all_moduls();
            $data = array();
            $no = 1;
            $baseurl = base_url();
        //cacah data untuk ditampilakan
        foreach ($modul as $modul_list ) {
            $id=$modul_list['id'];
            $judul=$modul_list['judul'];
            $deskripsi=$modul_list['deskripsi'];
            $publish=$modul_list['publish'];
            $ckPublish="";

            //menentukan checked publish
            if ($publish =='1') {
                $ckPublish="checked";
            } 

            $row = array();
            $row[] = $no;
            $row[] = $modul_list['judul'];
            $row[] = $modul_list['deskripsi'];
            $row[] ='
            <span class="checkbox custom-checkbox custom-checkbox-inverse">
                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                <label for="ckRand" >&nbsp;&nbsp;</label>
            </span>';
            $row[] = '<a href="'.base_url("assets/modul/".$modul_list['url_file']).'" class="btn btn-sm btn-primary"    target="_blank">
            <i class="ico-download"></i>
            </a>';

           
        $data[] = $row;
        $no++;

}
        }
        elseif($hakAkses=='guru'){
            //tampil modul by guru//
            $create_by = $this->session->userdata['id'];
            $modul = $this->Mmodulonline->modul_guruid($create_by);
            $data = array();
            $no = 1;
            $baseurl = base_url();
        //cacah data untuk ditampilakan
        foreach ($modul as $modul_list ) {
            $id=$modul_list['id'];
            $judul=$modul_list['judul'];
            $deskripsi=$modul_list['deskripsi'];
            $publish=$modul_list['publish'];
            $ckPublish="";

            //menentukan checked publish
            if ($publish =='1') {
                $ckPublish="checked";
            } 

            $row = array();
            $row[] = $no;
            $row[] = $modul_list['judul'];
            $row[] = $modul_list['deskripsi'];
            $row[] ='
            <span class="checkbox custom-checkbox custom-checkbox-inverse">
                <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
                <label for="ckRand" >&nbsp;&nbsp;</label>
            </span>';
            $row[] = '<a href="'.base_url("assets/modul/".$modul_list['url_file']).'" class="btn btn-sm btn-primary"    target="_blank">
            <i class="ico-download"></i>
            </a>';

            $row[] = '
            <form action="'.base_url().'index.php/modulonline/form_update" method="get">
            <input type="text" name="uuid" value="'.$modul_list['uuid'].'"  hidden="true">
            <input type="text" name="id_tingkatmapel" value="'.$modul_list['id_tingkatpelajaran'].'" hidden="true">
            <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>
            </form>';

            $row[]=' 
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_modul('."'".$modul_list['id']."'".')"><i class="ico-remove"></i></a>';
        $data[] = $row;
        $no++;

}
        }else{
            redirect(site_url('welcome'));
        }
            
        $output = array(

            "data"=>$data,
            );

        echo json_encode( $output );
} 

//view tambah modul
public function formmodul() {

    $data['judul_halaman'] = "Modul Online";
    $data['files'] = array(
        APPPATH . 'modules/modulonline/views/v-form-edudrive.php',
        );
         #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
            // jika admin
        $this->parser->parse('admin/v-index-admin', $data);
    } elseif( $hakAkses=='admin_cabang' ){
      $this->parser->parse('admincabang/v-index-admincabang', $data);
  } elseif($hakAkses=='guru'){
            //get data komen yg belum di baca
    $data['datKomen']=$this->datKomen();
            ##count komen
            //get id guru
    $id_guru = $this->session->userdata['id_guru'];
            // get jumlah komen yg belum di baca
    $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
            ## count komen
            // jika guru
    $this->parser->parse('templating/index-b-guru', $data);
}else{
          // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}
                #END Cek USer#
}

//fungsi untuk upload modul edu drive
public function uploadmodul() {
    //load library n helper
    $post=$this->input->post();
    $config['upload_path'] = $this->upload_path;
    $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
    $config['max_size'] = 10000;

    $configLogo['encrypt_name'] = TRUE;
    $new_name = time()."-".$_FILES["gambarSoal"]['name'];
    $config['file_name'] = $new_name;
    $this->load->library('upload', $config);
    $foto = 'gambarSoal';
    $this->upload->initialize($config);
    $file_foto=$post['gambarSoal'];
    $UUID = uniqid();

    $create_by = $this->session->userdata['id'];
    //untuk upload data beserta gambar
        $this->upload->do_upload($foto);
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        $data['judul']=$post['judul'];
        $data['deskripsi']=$post['deskripsi'];
        $data['create_by']=$create_by;
        $data['publish']=$post['publish'];
        $data['UUID']=$UUID;
        $data['id_tingkatpelajaran']=$post['mapel'];
        $data['url_file']=$file_name;
        //menyimpan data ke database
    $this->Mmodulonline->insert_modul($data);
    
    $info="Edu Drive Berhasil disimpan";
    echo json_encode($info); 
}

//untuk ke form update
public function form_update() {
    $tingkatmapel =htmlspecialchars($this->input->get('id_tingkatmapel'));
    $data['id_tingkatpelajaran'] = $tingkatmapel;
    $data['infosoal']=$this->Mmodulonline->get_info_modul($tingkatmapel);
    $uuid = htmlspecialchars($this->input->get('uuid'));
    $data['banksoal'] = $this->Mmodulonline->get_onesoal($uuid)[0];

    $data['judul_halaman'] = "Modul Online";
    $data['files'] = array(
        APPPATH . 'modules/modulonline/views/v-update-edudrive.php',
        );

    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
            // jika admin
        if ($data['id_tingkatpelajaran'] == null || $UUID == null) {
            redirect(site_url('admin'));
        } else {
            $this->parser->parse('admin/v-index-admin', $data);
        }
    } elseif( $hakAkses=='admin_cabang' ){

      if ($data['id_tingkatpelajaran'] == null || $UUID == null) {
        redirect(site_url('admincabang'));
    } else {
       $this->parser->parse('admincabang/v-index-admincabang', $data);
   }
} elseif($hakAkses=='guru'){
            // jika guru
    if ($data['id_tingkatpelajaran'] == null || $uuid == null) {
        redirect(site_url('guru/dashboard/'));
    } else {
              // notification
      $data['datKomen']=$this->datKomen();
      $id_guru = $this->session->userdata['id_guru'];
              // get jumlah komen yg belum di baca
      $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
              //
      $this->parser->parse('templating/index-b-guru', $data);
  }

}else{
    redirect(site_url('welcome'));
}
}

//fungsi untuk update modul edu drive
public function update_modul() {

    $post=$this->input->post();
    $UUID = $post['UUID'];
    //ambil data
    $onefile = $this->Mmodulonline->get_onefile($UUID)[0]['url_file'];

        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
        $config['max_size'] = 10000;
        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["gambarSoal"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'gambarSoal';
        $this->upload->initialize($config);
        $file_foto=$post['gambarSoal'];

        $this->upload->do_upload($foto);
        if ($onefile!='' && $onefile!=' ') {
                   unlink(FCPATH . "./assets/modul/" . $onefile);
          }
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        //data yang di update
        $data['judul']=$post['judul'];
        $data['deskripsi']=$post['deskripsi'];
        $data['publish']=$post['publish'];
        $data['id_tingkatpelajaran']=$post['mapel'];
        //jika file diupdate dan tidak
        if ($file_foto != NULL) {
            $data['url_file']=$file_name;
        }
        //menyimpan data yang diupdate
    $this->Mmodulonline->up_modul($data,$UUID);
    $info="Edu Drive Berhasil diubah";
    echo json_encode($info); 
}

//ajax for delete
public function delete_modul() {

    if ($this->input->post()) {
        $post = $this->input->post();
        $id = $post['id'];
        $this->del_file_modul($id);
        $this->Mmodulonline->del_modul($post);
    }
}

//function untuk delete file modul berdasarkan id
public function del_file_modul($id)
    {
        // get data team by id
        $onefile_modul = $this->Mmodulonline->get_onefile_modul($id);
        //cek  jika hasil null
        if ($onefile_modul != false) {
            //cek name file img team
            $file_modul=$onefile_modul[0]['url_file'];
            if ($file_modul != '' && $file_modul != ' ') {
                // jika file tidak null atau kosong maka hapus file
                 unlink(FCPATH . "./assets/modul/" . $file_modul);
            }
        }
    }

// fungsi untuk memfilter video yang akan di tampilkan
public function filtermodul()
{
    $tingkatID = $this->input->post('tingkat');
    $mpID = $this->input->post('mataPelajaran');

    if ($mpID != null) {
        $this->soalMp($mpID);
    } else if ($tingkatID != null) {
        $this->soalTingkat($tingkatID);
    } else {
       $this->allsoal();
            // $this->listsoal($subbab);
   }    
}


public function tambahdownload($idmodul) {
    $download = $this->Mmodulonline->ambilnilai($idmodul);
    $temp= $download['download']+1;       
    $this->Mmodulonline->tambahdownload($idmodul,$temp);
}

    // get data komen not read
public function datKomen()
{
    $hakAkses = $this->session->userdata['HAKAKSES'];
    if ($hakAkses == 'admin') {
        $listKomen = $this->mkomen->get_all_komen();
    }else{
      $id_guru = $this->session->userdata['id_guru'];
      $listKomen = $this->mkomen->get_komen_by_profesi_notread($id_guru);
  }

  return $listKomen;
}


}

?>