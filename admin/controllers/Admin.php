<?php
class Admin extends MX_Controller {

    function get_hak_akses(){
        return $this->session->userdata('HAKAKSES');
    }
    public function __construct() {
        parent::__construct();
        $this->load->model('video/mvideos');
        $this->load->model('matapelajaran/mmatapelajaran');
        $this->load->model('banksoal/mbanksoal');
        $this->load->model('Templating/mtemplating');
        $this->load->model('madmin');
        $this->load->library('parser');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
    }

    public function get_avatar_ajax(){
        $avatar = base_url()."assets/image/photo/admin/".$this->madmin->get_avatar_admin();
        echo "<img src=".$avatar." class='img-circle' alt='' />";
    }


    public function index() {
        $data['judul_halaman'] = "Dashboard Admin";

        $data['files'] = array(
            APPPATH . 'modules/admin/views/v-container.php',
        );

        $hakAkses = $this->session->userdata['HAKAKSES'];

        if ($hakAkses == 'admin') {
            // jika admin
            $this->parser->parse('v-index-admin', $data);
        } elseif ($hakAkses == 'guru') {
            // jika guru
            redirect(site_url('guru/dashboard/'));
        } elseif ($hakAkses == 'siswa') {
            redirect(site_url('welcome'));
        } else {
            // jika siswa redirect ke homepage
            redirect(site_url('login'));
        }

    }
    public function get_list_mapel(){
        $list = $this->mmatapelajaran->get_ajax_daftarMapel();
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['aliasMataPelajaran'];
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'hapus(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }
    function ajax_edit_mapel($id){
        $data = $this->mmatapelajaran->ajax_get_edit_mapel($id);
        echo json_encode($data);
    }
    function daftarvideo() {
        $data['videos'] = $this->mvideos->get_all_videos_admin();
        $this->load->view('templating/t-header');
        $this->load->view('v-left-bar-admin');
        $this->load->view('v-daftar-video', $data);
    }


    function loadcontainer() {
        return $this->load->view('v-container');
    }



    function daftarmatapelajaran() {
        $data['judul_halaman'] = "Daftar Mata Pelajaran";
        $data['files'] = array(
            APPPATH . 'modules/admin/views/v-daftar-mapel.php',
        );
        $data['mapels'] = $this->mmatapelajaran->daftarMapel();

        $hakAkses = $this->session->userdata['HAKAKSES'];
        if ($hakAkses == 'admin') {
        // jika admin
            $this->parser->parse('v-index-admin', $data);
        } elseif ($hakAkses == 'guru') {
        // jika guru
          $this->parser->parse('templating/index-b-guru', $data);
            // redirect(site_url('guru/dashboard/'));
      } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke siswa
        redirect(site_url('welcome'));
    } else {
            //jika belum login
        redirect(site_url('login'));
    }

}


function tambahMP() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('namaMP', 'Harap Isi Nama Mata Pelajaran', 'required');
    $this->form_validation->set_rules('aliasMP', 'Harap Isi Alias', 'required');
    if($this->form_validation->run() == TRUE){
    $data['namaMataPelajaran'] = htmlspecialchars($this->input->post('namaMP'));
    $data['aliasMataPelajaran'] = htmlspecialchars($this->input->post('aliasMP'));
    $this->mmatapelajaran->tambahMP($data);
    echo json_encode(array("status" => TRUE));
}
}



function hapusMP($id) {
    $this->mmatapelajaran->hapusMP($id);
    echo json_encode(array("status" => TRUE));
}



function rubahMP() {
    $id = $this->input->post('idMP');
    $data = array(
    'namaMataPelajaran' => $this->input->post('namaMP1'),
    'aliasMataPelajaran' => $this->input->post('aliasMP1'),
    );
    $this->mmatapelajaran->rubahMP($id, $data);
    echo json_encode(array('status' => TRUE));
}



function daftartingkatpelajaran() {
    $data['judul_halaman'] = "Tingkat Mata Pelajaran";

    $data['files'] = array(
        APPPATH . 'modules/admin/views/v-daftar-tingkat.php',
    );



    $data['mapels'] = $this->mmatapelajaran->daftarMapel();
    $data['mapelsd'] = $this->madmin->daftarMapelbyTingkat($tingkatID='1');
    $data['mapelsmp'] = $this->madmin->daftarMapelbyTingkat($tingkatI='2');
    $data['mapelsma'] = $this->madmin->daftarMapelbyTingkat($tingkatI='3');
    $data['mapelsmaipa'] = $this->madmin->daftarMapelbyTingkat($tingkatI='4');
    $data['mapelsmaips'] = $this->madmin->daftarMapelbyTingkat($tingkatI='5');

    $hakAkses = $this->session->userdata['HAKAKSES'];


    if ($hakAkses == 'admin') {
        // jika admin
        $this->parser->parse('v-index-admin', $data);
    } elseif ($hakAkses == 'guru') {
      $this->parser->parse('templating/index-b-guru', $data);
      $this->parser->parse('templating/index-b-guru', $data);

  } elseif ($hakAkses == 'siswa') {
            // jika siswa redirect ke welcome
   redirect(site_url('welcome'));
} else {
   redirect(site_url('login'));
}
}
 public function daftar_sd(){
        $list = $this->madmin->daftarMapelbyTingkat($tingkatID='1');
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['keterangan'];
            $row[] = '<td><a href="'.$base_url.'index.php/admin/daftarbab/' . $list_item["namaMataPelajaran"] . '/' . $list_item["id"].'" class="btn btn-default">Lihat</a></td>';
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit_tingkat(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'ajax_hapus_tingkat(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }
 public function daftar_smp(){
        $list = $this->madmin->daftarMapelbyTingkat($tingkatID='2');
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['keterangan'];
            $row[] = '<td><a href="'.$base_url.'index.php/admin/daftarbab/' . $list_item["namaMataPelajaran"] . '/' . $list_item["id"].'" class="btn btn-default">Lihat</a></td>';
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit_tingkat(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'ajax_hapus_tingkat(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }
public function daftar_sma(){
        $list = $this->madmin->daftarMapelbyTingkat($tingkatID='3');
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['keterangan'];
            $row[] = '<td><a href="'.$base_url.'index.php/admin/daftarbab/' . $list_item["namaMataPelajaran"] . '/' . $list_item["id"].'" class="btn btn-default">Lihat</a></td>';
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit_tingkat(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'ajax_hapus_tingkat(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }
public function daftar_smaipa(){
        $list = $this->madmin->daftarMapelbyTingkat($tingkatID='4');
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['keterangan'];
            $row[] = '<td><a href="'.$base_url.'index.php/admin/daftarbab/' . $list_item["namaMataPelajaran"] . '/' . $list_item["id"].'" class="btn btn-default">Lihat</a></td>';
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit_tingkat(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'ajax_hapus_tingkat(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }
public function daftar_smaips(){
        $list = $this->madmin->daftarMapelbyTingkat($tingkatID='5');
        $data = array();
        $base_url = base_url();
        foreach ($list as $list_item){
            $row = array();
            $row[] = $list_item['id'];
            $row[] = $list_item['namaMataPelajaran'];
            $row[] = $list_item['keterangan'];
            $row[] = '<td><a href="'.$base_url.'index.php/admin/daftarbab/' . $list_item["namaMataPelajaran"] . '/' . $list_item["id"].'" class="btn btn-default">Lihat</a></td>';
            $row[] =   "<button type='button' id='rubahBtn' class='btn btn-default' onclick = 'ajax_edit_tingkat(".$list_item['id'].")'><i class='ico-file5'></i></button>


                                <button type='button' id='hapusBtn' class='btn btn-default' 
                                onclick = 'ajax_hapus_tingkat(".$list_item['id'].")'><i class='ico-remove'></i></button>";


            $data[] = $row;
        }
        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );

    }


function tambahtingkatMP() {
    $data['tingkatID'] = htmlspecialchars($this->input->post('idTingkatMP'));
    $data['mataPelajaranID'] = htmlspecialchars($this->input->post('idMP'));
    $data['keterangan'] = htmlspecialchars($this->input->post('keterangan'));


    $this->mmatapelajaran->tambahtingkatMP($data);
    echo json_encode(array('status' => TRUE));
}



function hapustingkatMP($id) {
    $this->mmatapelajaran->hapustingkatMP($id);
      echo json_encode(array('status' => TRUE));
}
function get_edit_tingkat($id){
    $data = $this->madmin->editMapelbyTingkat($id);
    echo json_encode($data);
}


function edittingkatMP() {
    $id = $this->input->post('id1');
    $data = array(
    'keterangan' => $this->input->post('keterangan1'),
    'tingkatID' => $this->input->post('idTingkatMP1'),
    'mataPelajaranID' => $this->input->post('idMP1'),
    // 'mataPelajaranID' => $this->input->post('idMP'),
    // 'mataPelajaranID' =>$this->input->post('idMP'),
    // 'mataPelajaranID' => $this->input->post('idMP'),
    );

    $this->mmatapelajaran->rubahtingkatMP($id, $data);
    echo json_encode("berhasil");
}



function daftarbab() {
    $data['judul_halaman'] = "BAB Mata Pelajaran";
    $data['files'] = array(
        APPPATH . 'modules/admin/views/v-bab.php',
    );

    $id = $this->uri->segment(4);
    $data['babs'] = $this->mmatapelajaran->daftarBab($id);
    $data['kt'] = null;
    $temp_keterangan = $this->mmatapelajaran->get_keterangan($id);

    if ($temp_keterangan!=array()) {
        $data['kt'] = $temp_keterangan[0]['keterangan'];
    }
    $data['file'] = 'v-bab.php';
    if ($this->session->userdata('HAKAKSES')=='admin') {
        $this->parser->parse('v-index-admin', $data);
    }else if($this->session->userdata('HAKAKSES')=='guru'){
      $this->parser->parse('templating/index-b-guru', $data);
  }else{
    redirect('welcome');
}
}



function tambahbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));
    $data['judulBab'] = htmlspecialchars($this->input->post('judulBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('deskbab'));
    $data['statusAksesKonsultasi']=htmlspecialchars($this->input->post('statusAksesKonsultasi'));
    $data['statusAksesLearningLine']=htmlspecialchars($this->input->post('statusAksesLearningLine'));
    $data['statusAksesLatihan']=htmlspecialchars($this->input->post('statusAksesLatihan'));
    $this->mmatapelajaran->tambahbabMP($data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}



function rubahbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $id = htmlspecialchars($this->input->post('idrubah'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));
    $data['judulBab'] = htmlspecialchars($this->input->post('judulBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('deskbab'));



    $this->mmatapelajaran->rubahbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}



function hapusbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $id = htmlspecialchars($this->input->post('id'));
    $data['tingkatPelajaranID'] = htmlspecialchars($this->input->post('idtmp'));

    $this->mmatapelajaran->hapusbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarbab/' . $nmmp . '/' . $data['tingkatPelajaranID']));
}

function daftarsubbab() {
    $data['judul_halaman'] = "SUB BAB Mata Pelajaran";

    $data['files'] = array(
        APPPATH . 'modules/admin/views/v-subbab.php',
    );

    $id = $this->uri->segment(5);
    $data['babs'] = $this->mmatapelajaran->daftarsubBab($id);

    if ($this->session->userdata('HAKAKSES')=='admin') {
        $this->parser->parse('v-index-admin', $data);
    }else if($this->session->userdata('HAKAKSES')=='guru'){
      $this->parser->parse('templating/index-b-guru', $data);
  }else{
    redirect('welcome');
}

}

function tambahsubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $data['judulsubBab'] = htmlspecialchars($this->input->post('judulsubBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('desksubbab'));

    $this->mmatapelajaran->tambahsubbabMP($data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}



function rubahsubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $id = htmlspecialchars($this->input->post('idsubBab'));

    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $data['judulsubBab'] = htmlspecialchars($this->input->post('judulsubBab'));
    $data['keterangan'] = htmlspecialchars($this->input->post('desksubBab'));

    $this->mmatapelajaran->rubahsubbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}



function hapussubbabMP() {
    $nmmp = htmlspecialchars($this->input->post('nmmp'));
    $jdlbab = htmlspecialchars($this->input->post('jdlbab'));
    $id = htmlspecialchars($this->input->post('idsubBab'));

    $data['babID'] = htmlspecialchars($this->input->post('idbab'));
    $this->mmatapelajaran->hapussubbabMP($id, $data);
    redirect(base_url('index.php/admin/daftarsubbab/' . $nmmp . '/' . $jdlbab . '/' . $data['babID']));
}

}

?>