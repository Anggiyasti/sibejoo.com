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
        // $this->load->library('sessionchecker');
        // $this->sessionchecker->checkloggedin();
        // if ($this->session->userdata('HAKAKSES')=='ortu') {
        //     # langusung masuk
        // }else{
        // $this->sessionchecker->cek_token();
        // }

    }

    public function ajax_get_paket($id_tryout) {
        $data = $this->Mtryit_tryout->get_paket_by_id_to($id_tryout);

        $output = array('data' => $data);
        echo json_encode($output);
    }

    //# fungsi indeks, mampilin to yang dikasih hak akses.
    public function index() {
        // $this->session->unset_userdata('id_tryout');
        $data = array(
            'judul_halaman' => 'Sibejoo - Try Out',
            'judul_header' => 'DAFTAR TRY OUT',
            'judul_tingkat' => '',
            );

        $konten = 'modules/tryit_tryout/views/r-daftar-totryit.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-login.php',
            APPPATH . $konten,
            APPPATH . 'modules/testimoni/views/r-footer.php',
            
            );
  
        $data['tryout'] = $this->Mtryit_tryout->get_tryout_akses();
        $this->parser->parse('templating/r-index', $data);
    }

    public function create_seassoin_idto($id_to) {
        $this->session->set_userdata('id_tryout', $id_to);
        redirect("Tryit_tryout/daftarpaket");
    }

    public function daftarpaket() {
        $id_to = $this->session->userdata('id_tryout');
        $datas['id_tryout'] = $id_to;
        // $datas['id_pengguna'] = $this->session->userdata('id');
        

        $data['nama_to'] = $this->Mtryit_tryout->get_tryout_by_id($id_to)[0]['nm_tryout'];
        $data_to = $this->Mtryit_tryout->get_tryout_by_id($id_to)[0];
        
        $date = new DateTime(date("Y-m-d H:i:s"));
        
        // concat tanggal mlai dan tanggai akhir
        $mulai = date("Y-m-d H:i:s ", strtotime($data_to['tgl_mulai']." ".$data_to['wkt_mulai']));
        $akhir = date("Y-m-d H:i:s ", strtotime($data_to['tgl_berhenti']." ".$data_to['wkt_berakhir']));

        //buat date
        $date_mulai =  new DateTime($mulai);
        $date_berhenti =  new DateTime($akhir);


        // kalo tanggal mulainya lebih dari hari ini dan kurang dari sama dengan tanggal berhenti
        if (($date>= $date_mulai) && ($date <= $date_berhenti)) {
            //TO BISA DI AKSES
            $status_to = 'doing';
        }else{
            //TO TIDAK BISA DI AKSES
            if ($date>=$date_berhenti) {
                // SELESAI
                $status_to = 'done';             
            }else{
                // BELUM DIMULAI
                $status_to = 'yet';             
            }
        }

        if (isset($id_to)) {
            $data = array(
                'judul_halaman' => 'Sibejoo - Daftar Paket',
                'judul_header' => 'TRY OUT : ' . $data['nama_to'],
                'judul_tingkat' => '',
                'nama_to' => $data_to['nm_tryout'],
                );

            // FILES
            $konten = 'modules/Tryit_tryout/views/r-daftarpaket-totryit.php';
            $data['files'] = array(
                APPPATH . 'modules/homepage/views/r-header-login.php',
                APPPATH . $konten,
                APPPATH . 'modules/testimoni/views/r-footer.php',
                );
            // DAFTAR PAKET
            // $data['paket_dikerjakan'] = $this->Mtryit_tryout->get_paket_reported($datas);
            $data['paket'] = $this->Mtryit_tryout->get_paket_undo($datas);
            $data['status_to'] = $status_to;
             // ini buat pesan ortu
            // $id_pengguna= $this->session->userdata['id'];
            // $data['datLapor'] = $this->Ortuback_model->get_daftar_pesan($id_pengguna);
            // $data['count_pesan'] = $this->Ortuback_model->get_count($id_pengguna);


            $this->parser->parse('templating/r-index', $data);
            //unset session
            $this->session->unset_userdata('id_paketpembahasan');
            $this->session->unset_userdata('id_tryoutpembahasan');
            $this->session->unset_userdata('id_mm-tryoutpaketpembahasan');
        } else {
            //kalo gak ada session
            redirect('tryout');
        }
        // var_dump($data['paket_dikerjakan']);*/
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

        // insert ke log tryout
        // $insert = array("siswa_id" => $this->msiswa->get_siswaid(),
        //     "mm_tryout_paket_id" => $this->session->userdata('id_mm-tryoutpaket'),
        //     );

        // $this->Mtryout->insert_log_tryout($insert);
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

            $id_paket = $this->Mtryit_tryout->datapaket($id)[0]->id_paket; 
            $random = $this->Mtryit_tryout->dataPaketRandom($id_paket)[0]->random; 

            $data['paket'] = $this->Mtryit_tryout->durasipaket($id_paket); 

            $this->load->view('templating/t-headerto'); 
            if ($random == 0) { 
                $query = $this->load->Mtryit_tryout->get_soalnorandom($id_paket); 
            }else{ 
                $query = $this->load->Mtryit_tryout->get_soal($id_paket); 
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
        if (!empty($this->session->userdata['id_mm-tryoutpaketpembahasan'])) {
            $id = $this->session->userdata['id_mm-tryoutpaketpembahasan'];
            $data = ['id_mm'=>$id, 'id_pengguna'=>$this->session->userdata('id')];
            $data['rekap_jawaban'] = json_decode($this->Mtryit_tryout->get_report_paket_by_mmid($data)->rekap_hasil_koreksi);
            $data['topaket'] = $this->Mtryit_tryout->datatopaket($id);
            $jumlah_soal = count($data['rekap_jawaban']);

            $id_paket = $this->Mtryit_tryout->datapaket($id)[0]->id_paket;

            $this->load->view('templating/t-headerto');
            $query = $this->load->Mtryit_tryout->get_pembahasan($id_paket);
            $data['soal'] = $query['soal'];
            $data['pil'] = $query['pil'];
                
            $data['score'] = $this->Mtryit_tryout->get_info_score($id);

            for ($i=0; $i <$jumlah_soal ; $i++) { 
                $rekap_id = $data['rekap_jawaban'][$i]->id_soal;
                $soal_id = $data['soal'][$i]['soalid'];

                if ($rekap_id == $soal_id) {
                    $data['soal'][$i]['status_koreksi'] = $data['rekap_jawaban'][$i]->status_koreksi;
                }
            }


            $this->load->view('v-pembahasanto.php', $data);
            $this->load->view('footerpembahasan', $data);
        } else {
            $this->errorTest();
        }
    }

    public function pembahasan(){

        $this->load->view('templating/t-headerto');
        $query = $this->load->Mtryit_tryout->get_pembahasan(94);
        $data['soal'] = $query['soal'];
        $data['pil'] = $query['pil'];

        $this->load->view('v-pembahasanto.php', $data);
        $this->load->view('footerpembahasan', $data);
    // } else {
    //     $this->errorTest();
    // }
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

            // $hasil['id_pengguna'] = $this->session->userdata['id'];
            // $hasil['siswaID'] = $this->msiswa->get_siswaid();
            $hasil['id_mm-tryout-paket'] = $this->session->userdata['id_mm-tryoutpaket'];
            ;
            $hasil['jmlh_kosong'] = $kosong;
            $hasil['jmlh_benar'] = $benar;
            $hasil['jmlh_salah'] = $salah;
            $hasil['total_nilai'] = $benar;
            $hasil['poin'] = $benar;
            $hasil['status_pengerjaan'] = 1;
            $hasil['rekap_hasil_koreksi'] = $json_rekap_hasil_koreksi;

            // $result = $this->load->Mtryit_tryout->inputreport($hasil);
            $this->session->unset_userdata('id_mm-tryoutpaket');

            // update tb log tryout
            // $waktu = new DateTime("now");
            // $data['update'] = ['waktu_selesai'=>date($waktu->format("Y-m-d H:i:s")),
            // 'status_pengerjaan'=>1];
            // $data['where'] = ['siswa_id'=>$hasil['siswaID'],
            // 'mm_tryout_paket_id'=>$hasil['id_mm-tryout-paket']];
            // $this->Mtryit_tryout->update_log_tryout($data);
            // update tb log tryout
            
            // redirect(base_url('index.php/tryit_tryout'));
            echo json_encode($hasil);
        }else{
            var_dump($hasil);
            // $this->laporanQuiz($hasil);
            // redirect(base_url('index.php/tryit_tryout'));
        }
    }

        //menampilkan laporan hasil quiz
public function laporanQuiz($datArr)
{
  $data = array(

    'judul_halaman' => 'Sibejoo - Hasil Latihan',

    'judul_header' => 'Step Quiz',
    'judul_header2' =>'Step Quiz'

  );



      // END step line data

$data['files'] = array(

  APPPATH . 'modules/homepage/views/r-header-login.php',

  APPPATH . 'modules/tryit_tryout/views/r-hasil-to.php',

            // APPPATH . 'modules/homepage/views/v-footer.php',

);


$this->parser->parse('templating/r-index', $data);
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

    // fungsi in fo pengerjaan try out
    public function info_pengerjaan()
    {
        $id_to = $this->session->userdata('id_tryout');
        $datas['id_tryout'] = $id_to;
        // $datas['id_pengguna'] = $this->session->userdata('id');
        // if ($this->session->userdata('HAKAKSES')=='ortu') {
        //     //untuk mengambil id siswa jika ortu yang login 
        //     $datas['id_siswa'] = $this->Mtryout->get_id_siswa_by_ortu();

        // }else{
        //     $datas['id_siswa'] = $this->msiswa->get_siswaid();
        // }

        $datas['id_paket'] = $this->session->userdata('id_paket');

        $data = array(
            'judul_halaman' => 'Sibejoo - Info Pengerjaan',
            'judul_header' => 'Info Pengerjaan Try Out',
            );

        $konten = 'modules/tryit_tryout/views/r-info-pengerjaan.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-login.php',
            APPPATH . $konten,
            APPPATH . 'modules/templating/views/r-footer.php',
            );
        $data['paket'] = $this->Mtryit_tryout->get_paket_for_info($datas);
        $this->parser->parse('templating/r-index', $data);
    }
}
?>