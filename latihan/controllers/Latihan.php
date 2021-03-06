<?php
class Latihan extends MX_Controller {



    function __construct() {
        parent::__construct();
        $this->load->model('mlatihan');
        $this->load->library('parser');
        $this->load->model('video/mvideos');
        $this->load->model('matapelajaran/Mmatapelajaran');
        $this->load->model('tryout/mtryout');

    }

    function get_status_login(){
        $log_in = $this->session->userdata('loggedin');
        return $log_in;        
    }

    function get_hak_akses(){
        $hak_akses = $this->session->userdata('HAKAKSES');        
        return $hak_akses;        
    }



    public function tambah_latihan_ajax() {
        //uuid untuk soal
        $uuid_latihan = uniqid();
        $idsub = $_POST['subab'];
        $jumlah_soal = $_POST['jumlahsoal'];
        $kesulitan = $_POST['kesulitan'];

        $data = array(
            'judul_halaman' => 'Latihan - Neon',
            'judul_header' => 'Latihan'

        );

        //get nama mata pelajaran untuk nama paket
        $nama_matapelajaran = $this->mvideos->get_pelajaran_for_paket($idsub)[0]->aliasMataPelajaran;
        //get nama sub bab untuk digabungkan jadi Nama Matapelajaran - Nama Subab
        $nama_subab = $this->Mmatapelajaran->sc_sub_by_subid($idsub)[0]['judulSubBab'];

        $data['post'] = array(
            "jumlahSoal" => $jumlah_soal,
            "tingkatKesulitan" => $kesulitan,
            "nm_latihan" => $nama_matapelajaran . "-" . $nama_subab,
            "create_by" => $this->session->userdata['USERNAME'],
            "uuid_latihan" => $uuid_latihan,
        );

        $param = array(
            "id_subab" => $idsub,
            "jumlah_soal" => $jumlah_soal,
            "kesulitan" => $kesulitan
        );

        // get soal randoom
        $data['soal_random'] = $this->mlatihan->get_random_for_latihan($param);
        
        // hitug jumlah soal random
        $jumlah_random = count($data['soal_random']);
        if ($data['soal_random']==array() || $jumlah_random<$jumlah_soal) {
            // decode the JSON data
            // set second parameter boolean TRUE for associative array output.
            echo json_decode("0");
        } else {
            // kalo ada soalnya baru diinsert
            // insert ke latihan
            $this->mlatihan->insert($data['post']);
            $id_latihan = $this->mlatihan->get_latihan_by_uuid($uuid_latihan)[0]['id_latihan'];
            $this->session->set_userdata('id_latihan', $id_latihan);
            // insert ke mm sollat
            //ngecacah terus dimasukin ke relasi
            foreach ($data['soal_random'] as $row) {
                $data['mm_sol'] = array(
                    "id_latihan" => $id_latihan,
                    "id_soal" => $row['id_soal']
                );
                $this->mlatihan->insert_tb_mm_sol_lat($data['mm_sol']);
            };
            echo json_encode($data['soal_random']);
        }
    }

    public function tambah_latihan_ajax_bab() {
        //uuid untuk soal
        $uuid_latihan = uniqid();
        $bab = $_POST['bab'];

        $jumlah_soal = $_POST['jumlahsoal'];
        $kesulitan = $_POST['kesulitan'];

        //get nama mata pelajaran untuk nama paket
        $nama_matapelajaran = $this->mlatihan->get_nama_bab($bab)[0]['judulBab'];

        $data['post'] = array(
            "jumlahSoal" => $jumlah_soal,
            "tingkatKesulitan" => $kesulitan,
            "nm_latihan" => "Latihan - ".$nama_matapelajaran,
            "create_by" => $this->session->userdata['USERNAME'],
            "uuid_latihan" => $uuid_latihan,
        );

        $param = array(
            "id_bab" => $bab,
            "jumlah_soal" => $jumlah_soal,
            "kesulitan" => $kesulitan
        );

        // get soal randoom
        $data['soal_random'] = $this->mlatihan->get_random_for_latihan_bab($param);
        // hitug jumlah soal random
        $jumlah_random = count($data['soal_random']);
        if ($data['soal_random']==array() || $jumlah_random<$jumlah_soal) {
            // decode the JSON data
            // set second parameter boolean TRUE for associative array output.
            echo json_decode("0");
        } else {
            // kalo ada soalnya baru diinsert
            // insert ke latihan
            $this->mlatihan->insert($data['post']);
            $id_latihan = $this->mlatihan->get_latihan_by_uuid($uuid_latihan)[0]['id_latihan'];
            $this->session->set_userdata('id_latihan', $id_latihan);
            // insert ke mm sollat
            //ngecacah terus dimasukin ke relasi
            foreach ($data['soal_random'] as $row) {
                $data['mm_sol'] = array(
                    "id_latihan" => $id_latihan,
                    "id_soal" => $row['id_soal']
                );
                $this->mlatihan->insert_tb_mm_sol_lat($data['mm_sol']);
            };
            echo json_encode($data['soal_random']);
        }

    }

    public function tambah_latihan_ajax_bab_step() {
        // uuid untuk soal
        $uuid_latihan = uniqid();
        $bab = $this->input->post('bab');
        $idsoal = $this->input->post('id_soal');



        //get nama mata pelajaran untuk nama paket
        $nama_matapelajaran = $this->mlatihan->get_nama_bab($bab)[0]['judulBab'];
        //get nama sub bab untuk digabungkan jadi Nama Matapelajaran - Nama Subab

        $data['post'] = array(
            // "jumlahSoal" => $jumlah_soal,
            // "tingkatKesulitan" => $kesulitan,
            "nm_latihan" => "Latihan - ".$nama_matapelajaran,
            "create_by" => $this->session->userdata['USERNAME'],
            "uuid_latihan" => $uuid_latihan,
            // "id_subbab" => $idsub
        );


        // insert ke soal
        $this->mlatihan->insert($data['post']);
        $id_latihan = $this->mlatihan->get_latihan_by_uuid($uuid_latihan)[0]['id_latihan'];
        $this->session->set_userdata('id_latihan', $id_latihan);
        // get soal randoom
        // $data['soal_random'] = $this->mlatihan->get_random_for_latihan_bab($param);
        // $data['mm_sol']=array();
        //ngecacah teru dimasukin ke relasi
        foreach ($idsoal as $row) {
            $data['mm_sol'] = array(
                "id_latihan" => $id_latihan,
                "id_soal" => $row
            );
            // var_dump($data['mm_sol']);

            $this->mlatihan->insert_tb_mm_sol_lat($data['mm_sol']);
        };

    }

    function edit_soal_at_latihan(){
        if ($this->input->post()) {
            $post = $this->input->post();
        // $post = ['id_soal'=>['560'],'step'=>695];
        // select dulu latihan idnya
            $latihanID =$this->mlatihan->get_id_latihan_by_step($post['step']);
            if ($latihanID) {
            // ada
                $arr_batch_data = [];
                foreach ($post['id_soal'] as $value) {
                    $arr_batch_data[] = ['id_soal'=>$value,'id_latihan'=>$latihanID[0]['latihanID']];
                }
                $this->mlatihan->insert_batch_soal_to_latihan($arr_batch_data);
                echo json_encode(['message'=>"Berhasil Menambahkan"]);
            }else{
            // tidak ada
            //kalo engga, bikin latihan update ke step id_latihan
            }
        }else{
            echo "Forbiden Area";
        }
    }
    function drop_soal_from_latihan(){
        if ($this->input->post()) {
            $id_mm_solat = $this->input->post('id_mm_sol_lat');
            //delete batch
            $this->mlatihan->batch_remove_soal_from_latihan($id_mm_solat);
            echo json_encode(['message'=>"Berhasil Menghapus"]);
            echo "Forbiden Area";
        }else{
        }
    }
    public function formlatihan() {
        $data = array(
            'judul_halaman' => 'Netjoo - Welcome',
            'judul_header' => 'Welcome'
        );

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/v-header-login.php',
            APPPATH . 'modules/templating/views/t-f-pagetitle.php',
            APPPATH . 'modules/homepage/views/v-footer.php',
        );

        $this->parser->parse('templating/index', $data);
    }



    public function create_session_id_latihan($id_latihan){
        $this->session->set_userdata('id_latihan',$id_latihan);
        redirect('/tesonline/mulaitest', 'refresh');
    }

    public function create_session_id_pembahasan($id_pembahasan){
        $this->session->set_userdata('id_pembahasan',$id_pembahasan);
        redirect('/tesonline/pembahasanlatihan', 'refresh');
    }

    ## fungsi get repot katihan
    public function get_repot_latihan_to_grafik($id=""){
        if ($this->get_status_login()){
            $datas = $this->mlatihan->repot_latihan_filter($id);
            $array = [];

            foreach ($datas as $key) {
                $array[] = [$key['nm_latihan'], (int)$key['skore']];
            }
            echo json_encode($array);
        }else{
            redirect('login');
        }

    }

    public function get_bab_to_option($id=""){
        if ($this->get_status_login()){
            $datas = $this->mlatihan->get_bab_latihan($id);
            echo json_encode($datas);
        }else{
            redirect('login');
        }
    }


}
?>