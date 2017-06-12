<?php 



/**
 * 
 */
 class Donasi extends MX_Controller
 {

 	 function __construct()
  {
    parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('m_donasi');
        $this->load->helper(array('form', 'url', 'file', 'html'));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
        $this->load->library('parser');
        date_default_timezone_set('Asia/Jakarta');


  }

 	function index()
 	{    //untuk daftar artikel
        $data = array(
            'judul_halaman' => 'Sibejoo - Welcome',
            'judul_header' => 'Mata Pelajaran',
             'judul_header2' =>'Donasi'
        );


            $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-login.php',
            APPPATH . 'modules/donasi/views/r-tambah-donasi.php',
            );

        $data['status'] = $this->load->m_donasi->get_id_donasi()[0]['status'];
           
        $this->parser->parse( 'templating/r-index', $data );

    }

    // fungsi donasi
    public function tambah_donasi()
    {
            //insert the user registration details into database
            $data = array(
                'donasi' => $this->input->post('donasi'),
                'penggunaID' => $this->session->userdata('id'),
                'status' => '1'
            );
            
            $this->m_donasi->insert_donasi($data);
            
            $id = $this->m_donasi->get_id_donasi()[0]['id'];
            $this->session->set_userdata('id_donasi', $id);
            echo json_encode($id);

            

    }


  

    // FUNGSI VIEW FORM ARTIKEL
    function tambahartikel($index_artikel)
    {
    $data['judul_halaman'] = "Dashboard Admin";
        
    if ($index_artikel == 1) {
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_tambah_artikel.php',
            );
    }else{
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_tambah_reportheroo.php',
            );

    }
        $this->parser->parse('admin/v-index-admin', $data);
       
    }

    // FUNGSI INSERT ARTIKEL
    public function insertKonfirmasi(){
        $status ="";
        $msg ="";
        $filename="bukti";
        $id_pengguna =$this->session->userdata('id');
        if ($status != "error") {
            $config['upload_path']= './assets/image/konfirmasi_donasi';
            $config['allowed_types'] = 'jpeg|gif|jpg|png|mkv';
            $config['max_size'] = 2000;
            $config['max_width'] = 700;
            $config['max_height'] = 467;

            $this->load->library('upload',$config);
            // PENGECEKAN UPLOAD ARTIKEL
            if (!$this->upload->do_upload($filename))  {
                $status = 'error';
                $msg = $this->upload->display_errors('','');
            } else {
                
                $data= $this->upload->data();
                $file_id = $this->m_donasi->insert_konfirmasi_donasi($_POST['namapengirim'],
                                                            $_POST['bankpengirim'],
                                                            $_POST['bankpenerima'],
                                                            $data['file_name'],
                                                            $_POST['tglpengirim'],
                                                            $this->session->userdata('id'),
                                                            $this->session->userdata['id_donasi']);



                if ($file_id) {
                    $id_donasi=$this->session->userdata['id_donasi'];
                    $this->m_donasi->set_status($id_donasi);
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil</div>');
                    redirect('donasi');
                    
                }
                else{
                    unlink($data['full_path']);
                        $status = "error";
                        $msg = "Please Try Again";
                
            }
            }
            @unlink($_FILES[$filename]);
        }
    }


    // FUNGSI HAPUS ARTIKEL
    public function hapus_artikel($id_artikel) {
      $this->m_artikel->delete_artikel($id_artikel);
        // PENGECCEKAN JIKA BERHASIL DIHAPUS ATAU TIDAK
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('info', '<div class="alert alert-success text-center">Berhasil Dihapus</div>');
            redirect('artikel/index/1'); 
        } else {
            $this->session->set_flashdata('pesan2', '<div class="alert alert-danger text-center">Gagal Dihapus!</div>');
            redirect('artikel/index/1');
        }
    }

    // FUNGSI HAPUS ARTIKEL
    public function hapus_report_heroo($id_art) {
      $this->m_artikel->delete_report_heroo($id_art);
        // PENGECCEKAN JIKA BERHASIL DIHAPUS ATAU TIDAK
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('info', '<div class="alert alert-success text-center">Berhasil Dihapus</div>');
            redirect('artikel/index/2'); 
        } else {
            $this->session->set_flashdata('pesan2', '<div class="alert alert-danger text-center">Gagal Dihapus!</div>');
            redirect('artikel/index/2');
        }
    }
    
    // coba pagination news
    public function news()
    {
        // code u/pagination
       $this->load->database();
        $jumlah_data = $this->m_artikel->jumlah_data();
       
        $config['base_url'] = base_url().'index.php/artikel/news/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;

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
        
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);     
        $list = $this->m_artikel->data_news($config['per_page'],$from);

        $this->tampnews($list);

    }

     //tampung list semua soal u/ ke view
    public function tampnews($list)
    {
        // ekstrak data db ke new array
        $data['datnews']=array();
        foreach ( $list as $list_news ) {
            $id_art=$list_news['id_artikel'];
            $judul=$list_news['judul_artikel'];
            $isi=$list_news['isi_artikel'];

            $data['datnews'][]=array(
                'id_artikel'=>$id_art,
                'judul_artikel' => $judul,
                'isi_artikel' => $isi
            );
        }
        
        $sis = $this->session->userdata('id_siswa');
        $dataa['siswa']  = $this->Loginmodel->get_siswa($sis);
        // get data nilai tertinggi
        $dataa['nilai'] = $this->Mworkout1->nilai_tertinggi();
        $dataa['log']  = $this->Loginmodel->getlogact();
        $dataa['jur']  = $this->Loginmodel->get_siswa($sis)[0]->jurusan_pelajaran;
        $dataa['status']  = $this->Loginmodel->get_siswa($sis)[0]->status_path;

        // pengecekan hak akses
            $this->load->view('template/siswa2/v-header',$dataa);
            $this->load->view('v-news',$data);
            $this->load->view('template/siswa2/v-footer');
        
    }

    public function getdonasi() {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->m_donasi->scdonasi() ) ) ;
}

 }
 ?>
