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

    //GET HAK AKSES
    function gethakakses(){
        return $this->session->userdata('HAKAKSES');
    }
    //GET HAK AKSES

    // LOAD PARSER SESUAI HAK AKSES
    public function loadparser($data){
        $this->hakakses = $this->gethakakses();
        if ($this->hakakses=='admin') {
            $this->parser->parse('admin/v-index-admin', $data);
        }else{
            // $this->load->view('errors/error-back');      
            redirect('login');        
        }
    }

 	function index()
 	{    //untuk daftar artikel
        $data['judul_halaman'] = "Artikel";
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_daftar_artikel.php',
        );
        $list_artikel = $this->m_artikel->getDaftarslide();
        $data['data']= $list_artikel;  
        
        $this->loadparser($data);   
    }

    // fungsi view artikel masuk ke update
    public function update_artikel($id){
        $data['judul_halaman'] = "Update Artikel";
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_update_artikel.php',
            );
        $data['artikel'] = $this->m_artikel->get_artikel($id);
        $this->loadparser($data);        
    }  

    // FUNGSI VIEW FORM ARTIKEL
    function tambahartikel()
    {
        $data['judul_halaman'] = "Tambah Artikel";
        $data['files'] = array(
            APPPATH . 'modules/artikel/views/v_tambah_artikel.php',
            );
        $this->loadparser($data);
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
            <a class="btn btn-sm btn-primary btn-outline detail-'.$item['id_artikel'].'"  title="Lihat"
            data-id='."'".json_encode($item)."'".'
            onclick="detail('."'".$item['id_artikel']."'".')"
            >
            <i class=" ico-eye "></i> </a>
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
        //get nama file yg di upload
        $data['judul_artikel']=$post['jdlartikel'];
        $data['isi_artikel']=$post['editor1'];
        $foto = $post['foto'];
        $img = $post['img'];

        // dicek dulu insert sama gambarnya atau gak?
        if ($foto== "") {
            $this->m_artikel->in_upload_artikel($data);
            $info="Data Artikel Berhasil disimpan";                
        }else {
            list($type, $img) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);
            $imageName = time().'.png';
            
            file_put_contents('./assets/image/artikel/'.$imageName, $img);
            $data['gambar']=$imageName;
            $this->m_artikel->in_upload_artikel($data);
            $info="Data Artikel Berhasil disimpan dan foto berhasil di-upload ";
        }
        echo json_encode($info);     
    }

    //ajax update team
    function ajax_update_artikel(){
        $post=$this->input->post();
        $id = $post['id'];
        $data['judul_artikel']=$post['jdlartikel'];
        $data['isi_artikel']=$post['editor1'];
        $foto = $post['foto'];
        $img=$post['img'];

        if ($foto=="") {
            $this->m_artikel->edit_upload_artikel($data,$id);
            $info="Data Team Berhasil diubah";
        }else {
            $onephoto = $this->m_artikel->get_onephoto($id);
            if ($onephoto != '' && $onephoto!=' ') {
                unlink(FCPATH . "./assets/image/artikel/" . $onephoto);
                $imageName=$onephoto;
            } else {
                $imageName = time().'.png';
            }
            //konfigurasi upload
            list($type, $img) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);
            file_put_contents('./assets/image/artikel/'.$imageName, $img);
            $data['gambar']=$imageName;
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
            $id_artikel=$post['id'];
            $this->del_img_artikel($id_artikel);
            $this->m_artikel->delete_artikel($id_artikel);
        }
    }

    // delete image
    public function del_img_artikel($id_artikel)
    {
        // get image artikel
        $gambar=$this->m_artikel->get_onephoto($id_artikel);
        //cek  jika tidak hasil null
        if ($gambar != '' && $gambar!=' ') {
            unlink(FCPATH . "./assets/image/artikel/" . $gambar);
        }
    }

    // hapus gambar artikel
    public function hapus_gambar()
    {
        if ($this->input->post()) {
            $post = $this->input->post();
            $id=$post['id'];
            $data['gambar']="";
            $this->del_img_artikel($id);
            $this->m_artikel->edit_upload_artikel($data,$id);
            echo json_encode("Berhasil");
        }
    }
 }
 ?>
