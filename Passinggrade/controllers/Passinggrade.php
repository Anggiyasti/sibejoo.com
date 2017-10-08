<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passinggrade extends MX_Controller {

	public function __construct() {
       parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('Mpassing');
        $this->load->library( 'parser' );
        // $this->load->model('login/Loginmodel');
        // $this->load->model('workout1/Mworkout1');
        $this->load->helper(array('form', 'url', 'file', 'html'));
        $this->load->library('form_validation');
    }

	public function index() {
		$this->load->model('Mpassing');
	}

    //form tambah passing grade
    public function t_pass()
    {  
        $data['judul_halaman'] = "Dashboard Admin";
        $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/add_passing.php',
            
            );
         $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
        // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                 // jika guru
             redirect(site_url('guru/dashboard/'));       
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
    }

    public function add_passinggrade(){
        $post=$this->input->post();
            $data['kode']=$post['kode'];
            $data['wilayah']=$post['wilayah'];
            $data['universitas']=$post['universitas'];
            $data['prodi']=$post['prodi'];
            $data['passinggrade']=$post['passinggrade'];
            $this->Mpassing->insert_passing($data);
            $info="Data Team Berhasil disimpan dan foto berhasil di-upload ";
           
        echo json_encode($info);    
    }

    // fungsi untuk menampilkan berdasarkan universitas
    public function univ_wilayah($wil)
    {
        $data['w'] = 1;
        $data['data']   = $this->Mpassing->getpassingwilayah(1);
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
         $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
        // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                 // jika guru
             redirect(site_url('guru/dashboard/'));       
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }

    }

    

   public function ajax_get_all_passing()
    {
        $passing= $this->load->Mpassing->getpassing();
        $data = array();
        //var_dump($list);
        //mengambil nilai list
        $baseurl = base_url();
        $no='1';
        foreach ( $passing as $list_passing ) {
            $n='1';
            
            $row = array();
            
            $row[] = $no;
            $row[] =$list_passing['kode'];
            $row[] =$list_passing['wilayah'];
            $row[] =$list_passing['universitas'];
            $row[] =$list_passing['prodi'];
            $row[] =$list_passing['passinggrade'];
            $row[] = '<a class="btn btn-sm btn-warning" href="form_update_passing/'.$list_passing['id_passing'].'"  title="Ubah Video"
              )"
              >
              <i class="ico-file5"></i>
              </a> 
              <a class="btn btn-sm btn-danger"  
              title="Hapus" onclick="drop_passing('."'".$list_passing['id_passing']."'".')">
              <i class="ico-remove"></i></a> 
               ';
          
         

          $data[] = $row;
          $n++;
          $no++;

        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }


    // menampilkan  form update materi
    public function form_update_passing($id_passing)
    {
        $data['editdata']=$this->Mpassing->get_edit_passing($id_passing);
        $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/edit_passing.php',
            );
        $data['judul_halaman'] = "Form Update Materi";
        
       $hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
        if ($hakAkses=='admin') {
        // jika admin
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif($hakAkses=='guru'){
                 // jika guru
             redirect(site_url('guru/dashboard/'));       
        }else{
            // jika siswa redirect ke welcome
            redirect(site_url('welcome'));
        }
    }


    // update passing grade
    public function up_passinggrade(){
        $data['id_passing'] = $this->input->post('id_passing');
        $kode=htmlspecialchars($this->input->post('kode'));
        $wilayah = htmlspecialchars($this->input->post('wilayah'));
        $universitas = $this->input->post('universitas');
        $prodi= htmlspecialchars($this->input->post('prodi'));
        $passinggrade = htmlspecialchars($this->input->post('passinggrade'));
        $data['datpas']=array(
                        'kode'=>$kode,
                        'wilayah'=>$wilayah,
                        'universitas'=>$universitas,
                        'prodi'=>$prodi,
                        'passinggrade'=>$passinggrade);

        
        $this->Mpassing->up_passing($data);
        redirect(site_url('passinggrade/daftar_pass'));
    }

    // menghapus passing grade
    public function del_passing($id)
    {
        $this->Mpassing->delete_passing($id);
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