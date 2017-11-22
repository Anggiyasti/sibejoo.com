<?php 
 class artikel extends MX_Controller
 {
    private $upload_path = "./assets/image/artikel";

 	 function __construct()
  {
    parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('m_artikel');
        $this->load->helper(array('form', 'url', 'file', 'html'));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('sessionchecker');
        $this->load->library('parser');


  }

 	function index($index_artikel)
 	{    //untuk daftar artikel
        $data['judul_halaman'] = "Artikel";
        if ($index_artikel == 1) {

            $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_daftar_artikel.php',
            );
            $slidefront = $this->m_artikel->getDaftarslide();
            $data['data']= $slidefront;  
        }
        //untuk daftar report heroo
        else{
            $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_daftar_reportheroo.php',
            );
            $slidefront = $this->m_artikel->getDaftarreport_heroo();
            $data['data']= $slidefront;  

        }
         $this->parser->parse('admin/v-index-admin', $data);

    }




    // fungsi view artikel masuk ke update
    public function update_artikel($id){
        $data['judul_halaman'] = "Artikel";
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_update_artikel.php',
            );
         $data['artikel'] = $this->m_artikel->get_gambarartikel($id)[0];
        $this->parser->parse('admin/v-index-admin', $data);
        
        
    }  

    // fungsi view report heroo masuk ke update
    public function view_report_heroo($id){
        $data['artikel'] = $this->m_artikel->get_gambarreport_heroo($id);
        $data['judul_halaman'] = "Dashboard Admin";
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_update_reportheroo.php',
            );
        $this->parser->parse('admin/v-index-admin', $data);
        
        
    }  


    // FUNGSI update report heroo
    public function gambar_report_heroo($id) {

        $config['upload_path'] = './assets/image/artikel';
        $config['allowed_types'] = 'jpeg|gif|jpg|png|mkv';
        $config['max_size'] = 2000;
        $config['max_width'] = 700;
        $config['max_height'] = 467;
        $this->load->library('upload', $config);
        // PENGECEKAN KETIKA UPDATE APAKAH ADA FOTO ATAU TIDAK
        if (!$this->upload->do_upload('photo')) {
            $this->m_artikel->gambar_report1_heroo($id);            
        } else {
            $file_data = $this->upload->data();
            $photo = $file_data['file_name'];
            $this->m_artikel->gambar_report_heroo($id,$photo);
        }
    }

    // FUNGSI VIEW FORM ARTIKEL
    function tambahartikel()
    {
    $data['judul_halaman'] = "Artikel";
    $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_tambah_artikel.php',
            );
        
        $this->parser->parse('admin/v-index-admin', $data);
       
    }


    function tambahHeroo()
    {
    $data['judul_halaman'] = "Dashboard Admin";
    
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_tambah_reportheroo.php',
            );

        $this->parser->parse('admin/v-index-admin', $data);
       
    }



    

    // ajax list Artikel
    public function ajaxListArtikel() {
        $data=array();
        // code u/pagination
        $list = $this->m_artikel->getDaftarslide();

        $no=1;
        //cacah data 
        foreach ( $list as $item ) {
            $foto=$item['gambar'];
            $nama = $item['judul_artikel'];
            if ($foto!=' ') {
                $filefoto=base_url().'assets/image/artikel/'.$foto;
            } else {
                $filefoto=$this->generateavatar->generate_first_letter_avtar_url($judul_artikel);;
            }
            // $c = $item['isi_artikel']; echo substr($c, 0, 100)
            $isiart = $item ['isi_artikel'];
            $row = array();
            $row[] = $no;
            $row[] = $item ['judul_artikel'];
            $row[] = substr($isiart, 0, 50);
            $row[] = '<div class="media-object"><img src="'.$filefoto.'" alt="" class="img"></div>';
            $row[] = '
            <a class="btn btn-sm btn-primary"  title="Edit" onclick="edit_artikel('."'".$item['id_artikel']."'".')">
            <i class="ico-pencil"></i></a>
            
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_artikel('."'".$item['id_artikel']."'".')">
            <i class="ico-remove"></i></a>';
        
            
            $data[] = $row;
            $no++;
        }

        $output = array(
            "data"=>$data,
            );
        echo json_encode( $output );
    }

    //ajax add Artikel
    function ajax_add_artikel(){
        $post=$this->input->post();
        var_dump($post);

        //konfigurasi upload
        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config['max_size'] = 1000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        
        //random name
        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["foto"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'foto';
        $this->upload->initialize($config);
        $file_foto=$post['foto'];
            if (!$this->upload->do_upload($foto)) {
                //jika tidak uplop file atau gagal upload file foto
                $data['judul_artikel']=$post['jdlartikel'];
                $data['isi_artikel']=$post['editor1'];
                $this->m_artikel->in_upload_artikel($data);
                $info="Data Artikel Berhasil disimpan";
           }else {
                $file_data = $this->upload->data();
                //get nama file yg di upload
                $file_name = $file_data['file_name'];
                $data['judul_artikel']=$post['jdlartikel'];
                $data['isi_artikel']=$post['editor1'];
                $data['gambar']=$file_name;
                $this->m_artikel->in_upload_artikel($data);
                $info="Data Artikel Berhasil disimpan dan foto berhasil di-upload ";
           }
        echo json_encode($info);     
    }

    //ajax update team
    function ajax_update_artikel(){
        $post=$this->input->post();
        $id = $post['id'];
        //konfigurasi upload
        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
        $config['max_size'] = 1000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        
        //random name
        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["foto"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'foto';
        $this->upload->initialize($config);
        $file_foto=$post['foto'];
            if (!$this->upload->do_upload($foto)) {
                //jika tidak uplop file atau gagal upload file foto
                $data['judul_artikel']=$post['jdlartikel'];
                $data['isi_artikel']=$post['editor1'];
                $this->m_artikel->edit_upload_artikel($data,$id);
                $info="Data Team Berhasil diubah";
           }else {
                $file_data = $this->upload->data();
                //get nama file yg di upload
                $file_name = $file_data['file_name'];
                $data['judul_artikel']=$post['jdlartikel'];
                $data['isi_artikel']=$post['editor1'];
                $data['gambar']=$file_name;
                $this->m_artikel->edit_upload_artikel($data,$id);
                $info="Data Team Berhasil diubah dan foto berhasil di-upload ";
           }
            //
        echo json_encode($info);
    }

    // ajax drop team
    function drop_artikel(){
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->m_artikel->delete_artikel($post);
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

    public function getkategori() {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->m_artikel->scartikel() ) ) ;
}

 }
 ?>
