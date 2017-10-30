<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passinggradefront extends MX_Controller {

	public function __construct() {
       parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('Mpassingfront');
        $this->load->library( 'parser' );
        $this->load->model('passinggrade/Mpassing');
        $this->load->helper(array('form', 'url', 'file', 'html'));
        $this->load->library('form_validation');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        
    }

    //passing grade untuk universitas 
    function passinggrade_univ(){
         $data = array(
            'judul_halaman' => 'Sibejoo - Passing Grade',
            'judul_header' =>'Universitas',
            'judul_header2' =>'Universitas'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );
        $wil = $this->session->userdata['id_wil'];
        $data['data']   = $this->Mpassingfront->getpassingwilayah($wil);


        $this->parser->parse('templating/r-index', $data);
    }

    // fungsi passing grade by wilayah
    function passinggrade_univ_wil(){
         $data = array(
            'judul_halaman' => 'Sibejoo - Passinggrade',
            'judul_header' =>'Universitas',
            'judul_header2' =>'Universitas'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );
        $wil = $this->session->userdata['id_wil'];
        $data['data']   = $this->Mpassingfront->getpassingwilayah($wil);

        $this->parser->parse('templating/r-index', $data);
    }

    // passing grade by prodi
    function passinggrade_prodi(){
        $univ = $this->session->userdata['nama_univ'];
        $data = array(
            'judul_halaman' => 'Sibejoo - Passing Grade',
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

        $this->parser->parse('templating/r-index', $data);
    }

    public function tampunguniv(){
        $id = $this->input->post('univ');
        $this->session->set_userdata('nama_univ', $id);
        echo json_encode($id);

    }

    // cari univ
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

    // cari prodi
    public function cariprodi(){
        $univ = $this->session->userdata['nama_univ'];
        $data = array(
            'judul_halaman' => 'Sibejoo - Passing Grade',
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

    // fungsi pilih wilayah
    public function pilwilayah(){
        $wilayah = $this->input->post('wilayah');
        $this->session->set_userdata('id_wil', $wilayah);
        echo json_encode($wilayah);

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
        $data['data']   = $this->Mpassing->getpassing();
        $data['judul_halaman'] = "Dashboard Admin";

        $data['files'] = array(
            APPPATH . 'modules/passinggrade/views/daftar_passing.php',
            );
         $this->parser->parse('admin/v-index-admin', $data);
    }
    
    // set user data passing grade
    public function passgrade()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $this->session->set_userdata('awal', $awal);
        $this->session->set_userdata('akhir', $akhir);
        echo json_encode($awal);
    }

    // FUNGSI VIEW FILTER BY GRADE
    public function grade()
    {
        $awal = $this->session->userdata('awal');
        $akhir = $this->session->userdata('akhir');
        $data = array(
            'judul_halaman' => 'Sibejoo - Passing Grade',
            'judul_header' =>'Passing Grade',
            'judul_header2' =>'Passing Grade'
            );
        
        $data['files'] = array( 
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH.'modules/passinggradefront/views/r-passinggrade-prodi.php',
            APPPATH.'modules/testimoni/views/r-footer.php',
            );

        $data['data']   = $this->Mpassingfront->filter_grade($awal,$akhir);

        $this->parser->parse('templating/r-index', $data);
    }
}
?>