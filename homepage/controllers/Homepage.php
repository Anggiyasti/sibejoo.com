<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('guru/mguru');
        $this->load->model('teamback/mteamback');
        $this->load->model('donaturback/donaturback_model');

        $this->load->model('siswa/msiswa');
        $this->load->model('matapelajaran/mmatapelajaran');
        $this->load->model('video/mvideos');
        $this->load->model('Mhomepage');
        $this->load->library("pagination");
        $this->load->library('generateavatar');
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
        $data['teams'] = $this->mteamback->data_all_team();
        $data['donaturs'] = $this->donaturback_model->get_all_donatur();
        
        $data['last_video'] = $this->mvideos->get_last_video();
        $data['testimoni'] = $this->Mhomepage->gettestimoni();
        $data['artikel'] = $this->Mhomepage->get_artikel();
        $data['report_heroo'] = $this->Mhomepage->get_report_heroo();

        $this->parser->parse('r-index-homepage', $data);
    }
    
    function allArtikel(){
        $data = array(
            'judul_halaman' => 'Sibejoo - Artikel',
            'judul_header2' =>'Semua Artikel'
        );
        $config = array();
        $config["base_url"] = base_url() . "homepage/allArtikel/";
        $config["uri_segment"] = 3;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config["total_rows"] = $this->Mhomepage->get_artikel_number();
        $config["per_page"] = 2;

        // Start Customizing the “Digit” Link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // end  Customizing the “Digit” Link
        
        // Start Customizing the “Current Page” Link
        $config['cur_tag_open'] = '<li><a><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        // END Customizing the “Current Page” Link

        // Start Customizing the “Previous” Link
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
         // END Customizing the “Previous” Link

        // Start Customizing the “Next” Link
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
         // END Customizing the “Next” Link

        // Start Customizing the first_link Link
        $config['first_link'] = '<span aria-hidden="true">&larr; First</span>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
         // END Customizing the first_link Link

        // Start Customizing the last_link Link
        $config['last_link'] = '<span aria-hidden="true">Last &rarr;</span>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
         // END Customizing the last_link Link

        $this->pagination->initialize($config);
        ##KONFIGURASI UNTUUK PAGINATION

        $data['jumlah_postingan'] = $config['total_rows'];
        $data["links"] = $this->pagination->create_links();
        $data['allartikel'] = $this->Mhomepage->get_artikel_pag($config["per_page"], $page);
        $data['listart'] = $this->Mhomepage->list_artikel();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-detail.php',
            APPPATH . 'modules/homepage/views/r-all-artikel.php',
        );
        $this->parser->parse('templating/r-index-login', $data);
    }

    function allrReportHeroo(){
        $data = array(
            'judul_halaman' => 'Sibejoo - Report Heroo',
            'judul_header2' =>'All Report Heroo'
        );

        $config = array();
        $config["base_url"] = base_url() . "homepage/allrReportHeroo/";
        // $config["uri_segment"] = 3;
        $page = $this->uri->segment(3);
        $config["total_rows"] = $this->Mhomepage->get_report_heroo_number();
        $config["per_page"] = 5;

        // Start Customizing the “Digit” Link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // end  Customizing the “Digit” Link
        
        // Start Customizing the “Current Page” Link
        $config['cur_tag_open'] = '<li><a><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        // END Customizing the “Current Page” Link

        // Start Customizing the “Previous” Link
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
         // END Customizing the “Previous” Link

        // Start Customizing the “Next” Link
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
         // END Customizing the “Next” Link

        // Start Customizing the first_link Link
        $config['first_link'] = '<span aria-hidden="true">&larr; First</span>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
         // END Customizing the first_link Link

        // Start Customizing the last_link Link
        $config['last_link'] = '<span aria-hidden="true">Last &rarr;</span>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
         // END Customizing the last_link Link

        $this->pagination->initialize($config);
                ##KONFIGURASI UNTUUK PAGINATION

        $data['jumlah_postingan'] = $config['total_rows'];
        $data["links"] = $this->pagination->create_links();

        $data['allreportheroo'] = $this->Mhomepage->get_report_heroo_peg($config["per_page"], $page);
        $data['listheroo'] = $this->Mhomepage->list_heroo();
        $data['files'] = array(
            // APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . 'modules/homepage/views/r-header-detail.php',

            APPPATH . 'modules/homepage/views/r-all-heroo.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index-login', $data);

    }

    function addpesan() {
        $data['name'] = htmlspecialchars($this->input->post('namalengkap'));
        $data['phone'] = htmlspecialchars($this->input->post('telepon'));
        $data['alamat'] = htmlspecialchars($this->input->post('email'));
        $data['pesan'] = htmlspecialchars($this->input->post('pesan'));
        $this->Mhomepage->insert_pesan($data);
    }

    function addsubs(){
        // $data['email'] = htmlspecialchars($this->input->post('emailsubs'));
        $email = htmlspecialchars($this->input->post('email'));
        $status_email = $this->Mhomepage->mail_exists($email);
        if (!$status_email) {
            $data = ['email'=>$email,'status'=>1];
            $this->Mhomepage->insert_subs($data);
            echo json_encode(['message'=>"Berhasil berlangganan!",'status'=>$status_email]);
        }else{
            echo json_encode(['message'=>"Email sudah berlangganan",'status'=>$status_email]);            
        }
    }

    // tampung id 
    public function ambilid()
    {   
        $id = $this->input->post('id_artikel');
        $this->session->set_userdata('id_artikel', $id);
        echo json_encode($id);

    }

        public function create_id_report_session()
    {   
        $id = $this->input->post('id_report');
        $this->session->set_userdata('id_report', $id);
        echo json_encode($id);

    }

     // tampung id 
    public function ambilidheroo()
    {   
        $id = $this->input->post('id_report');
        $this->session->set_userdata('id_report', $id);
        echo json_encode($id);

    }
    // menampilkan detail artikel
    public function detail_artikel()
    {
        if (isset($this->session->userdata['id_artikel'])) {
            $id_artikel = $this->session->userdata['id_artikel'];
        }else{
            redirect('homepage');
        }

        $data = array(
            'judul_halaman' => 'Sibejoo - Detail Artikel',
            'judul_header2' =>'Detail Artikel'
        );

        $data['detartikel'] = $this->Mhomepage->get_artikel_detail($id_artikel);
        $data['listart'] = $this->Mhomepage->list_artikel();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-detail.php',
            APPPATH . 'modules/homepage/views/r-detail-artikel.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index', $data);
    }

    // menampilkan detail artikel
    public function detail_report()
    {
        if (isset($this->session->userdata['id_report'])) {
            $id_report = $this->session->userdata['id_report'];             
        }else{
            redirect('homepage');
        }

        $data = array(
            'judul_halaman' => 'Sibejoo - Report Detail',
            'judul_header2' =>'Detail Report Heroo'
        );


        $data['detheroo'] = $this->Mhomepage->get_heroo_detail($id_report);
        $data['listheroo'] = $this->Mhomepage->list_heroo();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-detail.php',
            APPPATH . 'modules/homepage/views/r-heroo-detail.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index', $data);
    }




}
