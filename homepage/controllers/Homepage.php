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
        // $data['teachers'] = $this->mguru->get_guru_random();
        $data['teachers'] = $this->mguru->get_guru_random();
        
        $data['last_video'] = $this->mvideos->get_last_video();
        $data['testimoni'] = $this->Mhomepage->gettestimoni();
        $data['artikel'] = $this->Mhomepage->get_artikel();
        $data['report_heroo'] = $this->Mhomepage->get_report_heroo();

        $this->parser->parse('r-index-homepage', $data);
        // echo "string";
    }
    
    function allArtikel(){
        $data = array(
            'judul_halaman' => 'Sibejoo - Artikel',
             'judul_header2' =>'All Artikel'
        );
        $config = array();
            $config["base_url"] = base_url() . "homepage/allArtikel/";
            $config["uri_segment"] = 3;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $config["total_rows"] = $this->Mhomepage->get_artikel_number();
            $config["per_page"] = 2;

            # konfig link
                $config['cur_tag_open'] = "<a style='background:#800000;color:white'>";
                $config['cur_tag_close'] = '</a>';
                $config['first_link'] = "<span title='Page Awal'> << </span>"; 
                $config['last_link'] = "<span title='Page Akhir'> >> </span>";

                # konfig link

                $this->pagination->initialize($config);
                ##KONFIGURASI UNTUUK PAGINATION

        $data['jumlah_postingan'] = $config['total_rows'];
        $data["links"] = $this->pagination->create_links();
        $data['allartikel'] = $this->Mhomepage->get_artikel_pag($config["per_page"], $page);
        $data['listart'] = $this->Mhomepage->list_artikel();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . 'modules/homepage/views/r-all-artikel.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index-login', $data);

    }

    function allrReportHeroo(){
        $data = array(
            'judul_halaman' => 'Sibejoo - Heroo',
             'judul_header2' =>'All Report Heroo'
        );

        $config = array();
            $config["base_url"] = base_url() . "homepage/allrReportHeroo/";
            $config["uri_segment"] = 3;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $config["total_rows"] = $this->Mhomepage->get_report_heroo_number();
            $config["per_page"] = 5;

            # konfig link
                $config['cur_tag_open'] = "<a style='background:#800000;color:white'>";
                $config['cur_tag_close'] = '</a>';
                $config['first_link'] = "<span title='Page Awal'> << </span>"; 
                $config['last_link'] = "<span title='Page Akhir'> >> </span>";

                # konfig link

                $this->pagination->initialize($config);
                ##KONFIGURASI UNTUUK PAGINATION

        $data['jumlah_postingan'] = $config['total_rows'];
        $data["links"] = $this->pagination->create_links();

        $data['allreportheroo'] = $this->Mhomepage->get_report_heroo_peg($config["per_page"], $page);
        $data['listheroo'] = $this->Mhomepage->list_heroo();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
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

    // menampilkan detail artikel
    public function detail_report()
    {
        $id_report = $this->session->userdata['id_report']; 
        $data = array(
            'judul_halaman' => 'Sibejoo - Artikel',
             'judul_header2' =>'Detail Rpeort Heroo'
        );


        $data['detheroo'] = $this->Mhomepage->get_heroo_detail($id_report);
        $data['listheroo'] = $this->Mhomepage->list_heroo();
        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . 'modules/homepage/views/r-heroo-detail.php',
            // APPPATH . 'modules/homepage/views/v-footer.php',
        );
        $this->parser->parse('templating/r-index', $data);
    }



    
}
