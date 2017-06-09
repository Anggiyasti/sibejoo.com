<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('guru/mguru');
        $this->load->model('siswa/msiswa');
        $this->load->model('matapelajaran/mmatapelajaran');
        $this->load->model('video/mvideos');
        $this->load->model('Mhomepage');
        
    }

    public function index() {
        $datas['jumlahGuru'] = $this->mguru->get_teachers_number();
        $datas['jumlahMapel'] = $this->mmatapelajaran->get_courses_number();
        $datas['jumlahSiswa'] = $this->msiswa->get_siswa_numbers();
        $datas['jumlahVideo'] = $this->mvideos->get_numbers_all_video();




        $data = array(
        'judul_halaman' => 'Neon Homepage',
        'jumlah_guru' => $datas['jumlahGuru'],
        'jumlah_siswa' => $datas['jumlahSiswa'],
        'jumlah_mapel' => $datas['jumlahMapel'],
        'jumlah_video'=> $datas['jumlahVideo']


        );
        $data['file'] = 'r-container.php';
        $data['teachers'] = $this->mguru->get_guru_random();
        $data['last_video'] = $this->mvideos->get_last_video();
        $data['testimoni'] = $this->Mhomepage->gettestimoni();
        $data['artikel'] = $this->Mhomepage->get_artikel();

        $this->parser->parse('r-index-homepage', $data);
        // echo "string";
    }
    
    function addpesan() {
        $data['name'] = htmlspecialchars($this->input->post('namalengkap'));
        $data['phone'] = htmlspecialchars($this->input->post('telepon'));
        $data['alamat'] = htmlspecialchars($this->input->post('email'));
        $data['pesan'] = htmlspecialchars($this->input->post('pesan'));
        $this->Mhomepage->insert_pesan($data);
    }

     function addsubs() {

        $data['email'] = htmlspecialchars($this->input->post('emailsubs'));

        if ($this->Mhomepage->mail_exists($data['email'] == true)) {
               $this->Mhomepage->insert_subs($data);
               $this->session->set_flashdata('subs', '1');
                // return Json(    
                //     // status = "success"
                //     subs = "done";
                // );
               // t TRUE;
        }else{
             $this->session->set_flashdata('subs', '2');
             // return Json({
             //        // status = "success"
             //        subs = "fail"
             // });
             // echo FALSE;
        }
    }

    // tampung id 
    public function ambilid()
    {   
            $id = $this->input->post('id_artikel');
            $this->session->set_userdata('id_artikel', $id);
            echo json_encode($id);
        
    }
    // menampilkan detail artikel
    public function detail_artikel()
    {
        $id_artikel = $this->session->userdata['id_artikel']; 
        $data = array(
            'judul_halaman' => 'Sibejoo - Artikel',
             'judul_header2' =>'Detail Artikel'
        );


        $data['detartikel'] = $this->Mhomepage->get_artikel_detail($id_artikel);
        $data['listart'] = $this->Mhomepage->list_artikel();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . 'modules/homepage/views/r-detail-artikel.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index', $data);
    }



    
}
