<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passinggradefront extends MX_Controller {

	public function __construct() {
       parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('Mpassingfront');
        $this->load->library( 'parser' );

        // $this->load->model('login/Loginmodel');
        // $this->load->model('workout1/Mworkout1');
        $this->load->helper(array('form', 'url', 'file', 'html'));
        $this->load->library('form_validation');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        
    }

	public function index() {
		$this->load->model('Mpassing');
	}

    //passing grade untuk universitas 
    function passinggrade_univ(){
         $data = array(
            'judul_halaman' => 'Sibejoo - Passinggrade',
            'judul_header' =>'Universitas',
            'judul_header2' =>'Universitas'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade.php',
            // APPPATH.'modules/welcome/views/v-tampil-tes.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );
        $wil = $this->session->userdata['id_wil'];
        $data['data']   = $this->Mpassingfront->getpassingwilayah($wil);
        // $data['data']   = $this->Mpassingfront->getpassingwilayah(1);


        $this->parser->parse('templating/r-index', $data);
    }
    function passinggrade_univ_wil(){
         $data = array(
            'judul_halaman' => 'Sibejoo - Passinggrade',
            'judul_header' =>'Universitas',
            'judul_header2' =>'Universitas'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade.php',
            // APPPATH.'modules/welcome/views/v-tampil-tes.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );
        $wil = $this->session->userdata['id_wil'];
        $data['data']   = $this->Mpassingfront->getpassingwilayah($wil);


        $this->parser->parse('templating/r-index', $data);
    }


    function passinggrade_prodi(){
        $univ = $this->session->userdata['nama_univ'];
        $data = array(
            'judul_halaman' => 'Sibejoo - Passing grade',
            'judul_header' =>$univ,
            'judul_header2' =>'Program Studi'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade-prodi.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );
        $u = urldecode($univ);
        $data['data']   = $this->Mpassingfront->getpassinguniv($u);
        // var_dump($data['data']);


        $this->parser->parse('templating/r-index', $data);

    }

    public function tampunguniv(){
        $id = $this->input->post('univ');
        $this->session->set_userdata('nama_univ', $id);
        echo json_encode($id);

    }

    public function cariuniv(){
        $data = array(
            'judul_halaman' => 'Sibejoo - Passinggrade',
            'judul_header' =>'Universitas',
            'judul_header2' =>'Universitas'
            );
        $kunciCari=htmlspecialchars($this->input->get('keycari'));
        $wil = $this->session->userdata['id_wil'];

        $data['data']=$this->Mpassingfront->get_cariuniv($wil,$kunciCari);
    
        $data['files'] = array(

            APPPATH . 'modules/homepage/views/r-header-login.php',

            APPPATH . 'modules/passinggradefront/views/r-passinggrade.php',

            APPPATH.'modules/testimoni/views/r-footer.php',

            );

        $this->parser->parse('templating/r-index', $data);

    }


    public function cariprodi(){

        $univ = $this->session->userdata['nama_univ'];
        $data = array(
            'judul_halaman' => 'Sibejoo - Passing grade',
            'judul_header' =>$univ,
            'judul_header2' =>'Program Studi'
            );
        $kunciCari=htmlspecialchars($this->input->get('keycari'));

        $data['data']=$this->Mpassingfront->get_cariprodi($univ,$kunciCari);
    
        $data['files'] = array(

            APPPATH . 'modules/homepage/views/r-header-login.php',

            APPPATH . 'modules/passinggradefront/views/r-passinggrade-prodi.php',

            APPPATH.'modules/testimoni/views/r-footer.php',
        );

        $this->parser->parse('templating/r-index', $data);

    }



    public function ubahprofilesiswa($jur,$univ) {
            $u = str_replace('%20',' ',$univ);
            $j = str_replace('%20',' ',$jur);

            $data_post = array(
                'univ' => $u,
                'jurusan' => $j,
                );
            

            $this->session->set_flashdata('msg','<div class="alert alert-warning">

                        <span class="semibold">Universitas dan Jurusan berhasil diubah</span>

                    </div>');

            $this->Mpassingfront->update_siswa($data_post);
            redirect(site_url('passinggradefront/passinggrade_prodi'));
        }

        function pilwilayah(){
        $wilayah = $this->input->post('wilayah');
        $this->session->set_userdata('id_wil', $wilayah);
        echo json_encode($wilayah);

    }


    // fungsi untuk menampilkan berdasarkan universitas
    public function univ_wilayah($wil)
    {
        $data['w'] = 1;
        $data['data']   = $this->Mpassingfront->getpassingwilayah(1);
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        $data['log']  = $this->Loginmodel->getlogact();
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-prodi', $data);
        $this->load->view('template/siswa2/v-footer');
        
    }
	public function tambah_passing()
	{
		//set validation rules
        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_rules('wilayah', 'wilayah', 'trim|required');
        $this->form_validation->set_rules('universitas', 'universitas', 'trim|required');
        $this->form_validation->set_rules('prodi', 'program studi', 'trim|required');
        $this->form_validation->set_rules('passinggrade', 'passing grade', 'trim|required');
        

        //validate form input
        if ($this->form_validation->run()==FALSE ) {
            //hak akses jika admin
        	if ($this->session->userdata('id_admin')) {
         
            $this->load->view('admin/layout/header');
            $this->load->view('add_passing');
            $this->load->view('admin/layout/footer');
        }
          //hak akses jika guru
        	elseif ($this->session->userdata('id_guru')) {
         
            $this->load->view('guru/layout/header');
            $this->load->view('add_passing');
            $this->load->view('guru/layout/footer');
        }
        } else {

            //insert the user registration details into database
            $data = array(
                'kode' => $this->input->post('kode'),
                'wilayah' => $this->input->post('wilayah'),
                'universitas' => $this->input->post('universitas'),
                'prodi' => $this->input->post('prodi'),
                'passinggrade' => $this->input->post('passinggrade')
            );
            
            // insert form data into database
            if ($this->Mpassing->insert_passing($data))
            {
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully </div>');
                    redirect('passinggrade/t_pass');
            
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('passinggrade/t_pass');
            }
        }
	}

	
	public function t_pass()
	{  //hak akses jika admin


        $data['judul_halaman'] = "Dashboard Admin";
        $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/add_passing.php',
            
            );
         $this->parser->parse('admin/v-index-admin', $data);
	}

    //ubah passing grade
    public function edit_pass($id) {
        
        
        if ($this->input->post('update')) 
        {
            $this->Mpassing->update_passing();
            
            if ($this->db->affected_rows())
            {
                //bila sukses akan menampilkan pesan 
                 $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Updated </div>');
                redirect('Passinggrade/daftar_pass');
            }
            else
            {
                //bila gagal akan menampilkan pesan
                 $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Failed </div>');
                redirect('Passinggrade/daftar_pass');
            }
        }
        else
        {    
            $data['editdata'] = $this->Mpassing->get_edit_passing($id);
            $data['judul_halaman'] = "Dashboard Admin";
            $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/edit_passing.php',
            );
         
        
        }
        $this->parser->parse('admin/v-index-admin', $data);
    }

    //TAMPIL PASSING GRADE BANKEND
    public function daftar_pass()
    {
        //hak akses bila admin
        // if ($this->session->userdata('id_admin')) {
        $data['data']   = $this->Mpassing->getpassing();
        $data['judul_halaman'] = "Dashboard Admin";

        $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/daftar_passing.php',
            
            );
         $this->parser->parse('admin/v-index-admin', $data);
        
        // $this->load->view('admin/layout/header');
        // $this->load->view('daftar_passing', $data);
        // $this->load->view('admin/layout/footer');
    // }
    //     //hak akses bila guru
    //     elseif ($this->session->userdata('id_guru')) {
        // $data['data']   = $this->Mpassing->getpassing();
        // $this->load->view('guru/layout/header');
        // $this->load->view('daftar_passing', $data);
        // $this->load->view('guru/layout/footer');
    // }

    }

    //MEGHAPUS PASSING GRADE BACKEND
    public function delete_pass($id) {
        $this->Mpassing->delete_passing($id);

        if ($this->db->affected_rows()) 
        {
            //bila sukses akan menampilkan pesan
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Deleted </div>');
            redirect('passinggrade/daftar_pass');    
        }
        else
        {
            //bila gagal akan menampilkan pesan 
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Failed </div>');
            redirect('passinggrade/daftar_pass');
        }

    }

    // tampilan awal passing grade FRONTEND
    public function pass_grade()
    {
        $this->load->view('template/header');
        $this->load->view('workout1/v-header');
        $this->load->view('v-front');
    }

    // fungsi untuk menampilkan berdasarkan universitas
    public function univ()
    { 
        //hak akses jika siswa
        if ($this->session->userdata('id_siswa')) {
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['data']   = $this->Mpassing->getpassing();
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        
        $this->load->view('template/siswa2/v-header',$data);
        $this->load->view('baru/v-univ',$data);
        $this->load->view('template/siswa2/v-footer');
    }
    //hak akses jika bukan siswa
    else{
        redirect('Login');
    }
    
    }

     //fungsi untuk memilih prodi
    public function pilih_prodi()
    {
        if ($this->session->userdata('id_siswa')) {
            $sis = $this->session->userdata('id_siswa');
            $data['siswa']  = $this->Loginmodel->get_siswa($sis);
            $data['data']   = $this->Mpassing->tampil_prodi();
            $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
            $data['log']  = $this->Loginmodel->getlogact();
            $data['dataa']= $this->Mpassing->tampilphoto(); 
            $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
            $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;

            $this->load->view('template/siswa2/v-header',$data);
            $this->load->view('baru/v-pilih-programstudi',$data);
            $this->load->view('template/siswa2/v-footer');   
            }
        else{
            redirect('Login');
        }     
    }

    // fungsi untuk menampilkan  prodi berdasarkan pilihan 
    public function prodi($prodi)
    {   //hak akses jika siswa
        if ($this->session->userdata('id_siswa')) {
        $prodii = urldecode($prodi);
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['data']   = $this->Mpassing->getprodi($prodii);
        $data['prodi'] = $prodii;
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();
      
        $this->load->view('template/siswa2/v-header',$data);
        $this->load->view('baru/v-programstudi',$data);
        $this->load->view('template/siswa2/v-footer'); 
        }
        //hak akses jika bukan siswa diarahkan ke login
    else{
        redirect('Login');
    } 
        
    }
    // fungsi untuk menampilkan passing grade 
    public function passing()
    {
        if ($this->session->userdata('id_siswa')) {
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['data']   = $this->Mpassing->getpassing();
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();

        $this->load->view('template/siswa2/v-header',$data);
        $this->load->view('baru/v-passing');
        $this->load->view('template/siswa2/v-footer'); 
        }
    else{
        redirect('Login');
    }     
        
    }
    // fungsi untuk menampilkan hasil dari passing grade yang dipilih 
    public function hasilpassing($no)
    {
        if ($this->session->userdata('id_siswa')) {
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        if ($no == 1 ) {
            $a = 21;
            $b = 25;
        }elseif ($no == 2 ) {
           $a = 26;
           $b = 30;
        }elseif ($no == 3 ) {
           $a = 31;
           $b = 35;
        }elseif ($no == 4 ) {
           $a = 36;
           $b = 40;
        }elseif ($no == 5 ) {
           $a = 41;
           $b = 45;
        }elseif ($no == 6 ) {
           $a = 46;
           $b = 50;
        }elseif ($no == 7 ) {
           $a = 51;
           $b = 55;
        }elseif ($no == 8 ) {
           $a = 56;
           $b = 60;
        }elseif ($no == 9 ) {
           $a = 61;
           $b = 65;
        }elseif ($no == 10 ) {
           $a = 66;
           $b = 70;
        }elseif ($no == 11) {
           $a = 71;
           $b = 75;
        }elseif ($no == 12 ) {
           $a = 76;
           $b = 80;
        }elseif ($no == 13) {
           $a = 81;
           $b = 85;
        }elseif ($no == 14) {
           $a = 86;
           $b = 90;
        }elseif ($no == 15) {
           $a = 91;
           $b = 95;
        }elseif ($no == 16) {
           $a = 96;
           $b = 100;
        }
        $data['data']  = $this->Mpassing->hasil_passing($a,$b);
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();
        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-hasilpassing',$data);
        $this->load->view('template/siswa2/v-footer');  
         }
    else{
        redirect('Login');
    }     
        
    }

    // fungsi untuk ketika siswa memilih universitas dan prodi untuk profile mereka
    public function set_prodi_univ($univ)
    {

        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $u = urldecode($univ);
        $data['data']   = $this->Mpassing->getpassinguniv($u);
        $data['univ'] = $u;
        $data['dataa']= $this->Mpassing->tampilphoto(); 
         // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();
        $sis = $this->session->userdata('id_siswa');
        // get data siswa
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;

        
        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-set-prodi',$data);
        $this->load->view('template/siswa2/v-footer'); 

    }


    //fungsi untuk mencari program studi dengan tidak ditampilkan datanya
    public function cari()
    {  
        if ($this->session->userdata('id_siswa')) {
        $kunciCari=htmlspecialchars($this->input->get('keycari'));
        $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        $data['data']=$this->Mpassing->get_topik_byprodi($kunciCari);
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();

        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-search');
        $this->load->view('template/siswa2/v-footer'); 
        // END step line
            }
    else{
        redirect('Login');
    }  
    }
        
    //fungsi ketika pencarian dijalankan 
    public function cari2()
    {  
        if ($this->session->userdata('id_siswa')) {
        $kunciCari=htmlspecialchars($this->input->get('keycari'));
         $sis = $this->session->userdata('id_siswa');
        $data['siswa']  = $this->Loginmodel->get_siswa($sis);
        $data['dataa']= $this->Mpassing->tampilphoto(); 
        $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
        // get data nilai tertinggi
        $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
        // get data log activity
        $data['log']  = $this->Loginmodel->getlogact();
        
        
         $data['data']=$this->Mpassing->get_topik_byprodi($kunciCari);
         if ($kunciCari == '') {
        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-search', $data);
        $this->load->view('template/siswa2/v-footer'); 
         }
         else{
        $this->load->view('template/siswa2/v-header', $data);
        $this->load->view('baru/v-search-prodi', $data);
        $this->load->view('template/siswa2/v-footer'); 
    }
        // END step line
            }
    else{
        redirect('Login');
    }  
    }

    // FUNGSI VIEW WILAYAH
    public function wilayah()
    {
        $wil = $this->input->post('wilayah');
            if (!isset($wil)) {
                $data['w'] = 1;
                $data['data']   = $this->Mpassing->getpassingwilayah(1);
                $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
                $data['log']  = $this->Loginmodel->getlogact();
                $sis = $this->session->userdata('id_siswa');
                $data['siswa']  = $this->Loginmodel->get_siswa($sis);
                $data['dataa']= $this->Mpassing->tampilphoto(); 
                $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
                $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
                
                $this->load->view('template/siswa2/v-header', $data);
                $this->load->view('baru/v-prodi', $data);
                $this->load->view('template/siswa2/v-footer');
            } else {
                
                $data['w'] = $wil;
                $data['data']   = $this->Mpassing->getpassingwilayah($wil);
                $data['nilai'] = $this->Mworkout1->nilai_tertinggi();
                $data['log']  = $this->Loginmodel->getlogact();
                $sis = $this->session->userdata('id_siswa');
                $data['siswa']  = $this->Loginmodel->get_siswa($sis);
                $data['dataa']= $this->Mpassing->tampilphoto(); 
                $data['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
                $data['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;
                
                $this->load->view('template/siswa2/v-header', $data);
                $this->load->view('baru/v-prodi', $data);
                $this->load->view('template/siswa2/v-footer');
            }
    }
    



}