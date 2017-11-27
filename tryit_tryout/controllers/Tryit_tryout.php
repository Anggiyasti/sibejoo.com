<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tryit_tryout extends MX_Controller {

    public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
        
        $this->load->library('parser');
        $this->load->model('Mtryit_tryout');
        $this->load->model('siswa/msiswa');


        $this->load->model('tesonline/Mtesonline');
        $this->load->model( 'ortuback/Ortuback_model' );
        parent::__construct();
        

    }

    public function ajax_get_paket($id_tryout) {
        $data = $this->Mtryit_tryout->get_paket_by_id_to($id_tryout);

        $output = array('data' => $data);
        echo json_encode($output);
    }

    //# fungsi indeks, mampilin to yang dikasih hak akses.
    public function index() {
        // $this->session->unset_userdata('id_tryout');
        $id_to = $this->session->userdata('id_tryout');
        $datas['id_tryout'] = $id_to;
      

        $datas['id_paket'] = $this->session->userdata('id_paket');

        $data = array(
            'judul_halaman' => 'Sibejoo - Info Pengerjaan',
            'judul_header' => 'Info Pengerjaan Try Out',
            );

        $konten = 'modules/tryit_tryout/views/r-info-pengerjaan.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-detail.php',
            APPPATH . $konten,
            APPPATH . 'modules/templating/views/r-footer.php',
            );
        $idpaket = $this->Mtryit_tryout->Get_Paket_For_Tryit()['idpaket'];
        $data['paket'] = $this->Mtryit_tryout->get_paket_for_info($idpaket);
        $this->parser->parse('templating/r-index', $data);
    }

    

//# fungsi indeks
    function buatto() {
        $data = array("id_paket" => $this->input->post('id_paket'),
            "id_tryout" => $this->input->post('id_tryout'),
            "id_mm-tryoutpaket" => $this->input->post('id_mm_tryoutpaket'),
            );
        // set user data
        $this->session->set_userdata('id_paket', $data['id_paket']);
        $this->session->set_userdata('id_tryout', $data['id_tryout']);
        $this->session->set_userdata('id_mm-tryoutpaket', $data['id_mm-tryoutpaket']);

    }

    function buatpembahasan() {
        $data = array("id_paket" => $this->input->post('id_paket'),
            "id_tryout" => $this->input->post('id_tryout'),
            "id_mm-tryoutpaket" => $this->input->post('id_mm_tryoutpaket'),
            );
        $this->session->set_userdata('id_paketpembahasan', $data['id_paket']);
        $this->session->set_userdata('id_tryoutpembahasan', $data['id_tryout']);
        $this->session->set_userdata('id_mm-tryoutpaketpembahasan', $data['id_mm-tryoutpaket']);
    }


    function test2() {
        if (!empty($this->session->userdata['id_mm-tryoutpaket'])) {
            $id = $this->session->userdata['id_mm-tryoutpaket'];
            $data['topaket'] = $this->Mtryit_tryout->datatopaket($id);

            $id_paket = $this->Mtryit_tryout->datapaket($id)[0]->id_paket;

            $data['paket'] = $this->Mtryit_tryout->durasipaket($id_paket);

            $this->load->view('templating/t-headerto');
            $query = $this->load->Mtryit_tryout->get_soal($id_paket);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];

            $this->load->view('v-test-mathjax.php', $data);
        } else {
            $this->errorTest();
        }
    }
// ================ mulai test lama ======================
    public function mulaitest() { 
        if (!empty($this->session->userdata['id_mm-tryoutpaket'])) { 
            $id = $this->session->userdata['id_mm-tryoutpaket']; 
            $data['topaket'] = $this->Mtryit_tryout->datatopaket($id); 
            $idpaket = $this->Mtryit_tryout->Get_Paket_For_Tryit()['idpaket'];
            // $id_paket = $this->Mtryit_tryout->datapaket($id)[0]->id_paket; 
            $random = $this->Mtryit_tryout->dataPaketRandom($idpaket)[0]->random; 

            $data['paket'] = $this->Mtryit_tryout->durasipaket($idpaket); 

            $this->load->view('templating/t-headerto'); 
            if ($random == 0) { 
                $query = $this->load->Mtryit_tryout->get_soalnorandom($idpaket); 
            }else{ 
                $query = $this->load->Mtryit_tryout->get_soal($idpaket); 
            } 
            $data['soal'] = $query['soal']; 
            $data['pil'] = $query['pil']; 

            $this->load->view('vHalamanTo-bu.php', $data); 
            $this->load->view('t-footerto', $data); 
        } else { 
            $this->errorTest(); 
        } 
    }
    public function mulaipembahasan() {

            $data['rekap_jawaban'] =  $this->session->userdata['koreksi'];
            $data['topaket'] = $this->Mtryit_tryout->datatopaket();
            $jumlah_soal = count($data['rekap_jawaban']);

            $this->load->view('templating/t-headerto');
            $idpaket = $this->Mtryit_tryout->Get_Paket_For_Tryit()['idpaket'];
            $query = $this->load->Mtryit_tryout->get_pembahasan($idpaket);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];
            $benar =$this->session->userdata['jmlh_benar'];
            $data['jmlh_benar'] = $benar;
            $data['jmlh_salah'] = $this->session->userdata['jmlh_salah'];
            $data['jmlh_kosong'] = $this->session->userdata['jmlh_kosong'];
            $data['score'] = $benar/ $jumlah_soal * 100;

            for ($i=0; $i <$jumlah_soal ; $i++) { 
                $rekap_id = $data['rekap_jawaban'][$i]['id_soal'];
                
                $soal_id = $data['soal'][$i]['soalid'];

                if ($rekap_id == $soal_id) {
                    $data['soal'][$i]['status_koreksi'] = $data['rekap_jawaban'][$i]['status_koreksi'];
                }
            }


            $this->load->view('v-pembahasanto.php', $data);
            $this->load->view('footerpembahasan', $data);
       
    }

    public function pembahasan(){

        $this->load->view('templating/t-headerto');
        $query = $this->load->Mtryit_tryout->get_pembahasan(94);
        $data['soal'] = $query['soal'];
        $data['pil'] = $query['pil'];

        $this->load->view('v-pembahasanto.php', $data);
        $this->load->view('footerpembahasan', $data);
    
    }


    public function errorTest() {
        $this->load->view('templating/t-headerto');
        $this->load->view('v-error-test.php');
    }

    public function cekJawaban() {        
       if ($this->input->post()) {
            $data = $this->input->post('pil');

            $id = $this->session->userdata['id_mm-tryoutpaket'];
            $id_paket = $this->Mtryit_tryout->datapaket($id)[0]->id_paket;

            $result = $this->Mtryit_tryout->jawabansoal($id_paket);

            $benar = 0;
            $salah = 0;
            $kosong = 0;
            $koreksi = array();
            $idSalah = array();
            $status = false;
            $rekap_hasil_koreksi = [];

            //untuk cek hawaban
            for ($i = 0; $i < sizeOf($result); $i++) {
                $id = $result[$i]['soalid'];
                if (!isset($data[$id])) {
                    // untuk jawaban kosong
                    $kosong++;
                    $koreksi[] = $result[$i]['soalid'];
                    $idSalah[] = $i;
                    $status = 3;
                } else if ($data[$id][0] == $result[$i]['jawaban']) {
                    // untuk jawaban benar
                    $benar++;
                    $status = 1;
                } else {
                    // untuk jawaban salah
                    $salah++;
                    $koreksi[] = $result[$i]['soalid'];
                    $idSalah[] = $i;
                    $status = 2;
                }

                $tempt['id_soal'] = $id;
                $tempt['status_koreksi'] = $status;
                $rekap_hasil_koreksi[] = $tempt;
            }

            $json_rekap_hasil_koreksi = json_encode($rekap_hasil_koreksi);       

            
            $hasil['id_mm-tryout-paket'] = $this->session->userdata['id_mm-tryoutpaket'];
            ;
            $hasil['jmlh_kosong'] = $kosong;
            $hasil['jmlh_benar'] = $benar;
            $hasil['jmlh_salah'] = $salah;
            $hasil['total_nilai'] = $benar;
            $hasil['poin'] = $benar;
            $hasil['status_pengerjaan'] = 1;
            $hasil['rekap_hasil_koreksi'] = $json_rekap_hasil_koreksi;

            $this->session->set_userdata('jmlh_benar',$benar);
            $this->session->set_userdata('jmlh_salah',$salah);
            $this->session->set_userdata('jmlh_kosong',$kosong);
            $this->session->set_userdata('koreksi',$rekap_hasil_koreksi);
            $this->session->unset_userdata('id_mm-tryoutpaket');
            
            // mengirim data             
        }else{
             redirect(base_url('index.php/tryit_tryout'));
            
        }
    }

    //end fungsi ilham

    public function pembahasanto() {
        if (!empty($this->session->userdata['id_pembahasan'])) {
            $id = $this->session->userdata['id_pembahasan'];
            $this->load->view('templating/t-headersoal');

            $query = $this->load->mtesonline->get_soal($id);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];

            $this->load->view('vPembahasan.php', $data);
            $this->load->view('footerpembahasan.php');
        } else {
            $this->errorTest();
        }
    }

    public function report_to(){
        $list = $this->Mtryit_tryout->get_laporan_to();
        $array = [];
        foreach ($list as $item ) {

            $tempt = ['name'=>$item['nm_tryout'],'y'=> (int)number_format($item['nilai'],1),'drilldown'=>$item['nm_tryout']];
            $array[] = $tempt;
        }
      echo json_encode($array);

    }

    // fungsi tampung idpaket
    public function tamp_paket($id_paket)
    {
        $this->session->set_userdata('id_paket', $id_paket);
        redirect(base_url('tryit_tryout/info_pengerjaan'));
    }

    
}
?>