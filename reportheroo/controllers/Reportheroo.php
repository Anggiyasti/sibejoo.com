<?php 
class Reportheroo extends MX_Controller
{
    private $upload_path = "./assets/image/reportheroo";

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->murl = 'assets/adminre/';
        $this->load->model('Mreportheroo');
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
            echo "forbidden access";            
        }
    }

    function index()
 	{    //untuk daftar report heroo
        $data['judul_halaman'] = "Dashboard Admin";
        
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_daftar_reportheroo.php',
        );
        $report = $this->Mreportheroo->get_report_heroo();
        $data['data']= $report;  
        $this->loadparser($data);
    }

    // fungsi view report heroo masuk ke update
    public function update_report_heroo($id){
        $data['judul_halaman'] = "Dashboard Admin";
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_update_reportheroo.php',
        );
        $data['RH'] = $this->Mreportheroo->get_reportH($id);
        $this->loadparser($data);
    }  

    function tambah_heroo()
    {
        $data['judul_halaman'] = "Report Heroo";
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_tambah_reportheroo.php',
        );
        $this->loadparser($data);
        
    }

    // ajax list report heroo
    public function ajax_list_heroo() {
        $data=array();
        // code u/pagination
        $list = $this->Mreportheroo->get_report_heroo();

        $no=1;
        //cacah data 
        foreach ( $list as $item ) {
            $foto=$item['gambar'];
            $nama = $item['judul_art_katagori'];
            if ($foto!=' ') {
                $filefoto=base_url().'assets/image/reportheroo/'.$foto;
            } else {
                $filefoto=$this->generateavatar->generate_first_letter_avtar_url($judul_artikel);;
            }
            $kat= $item ['kategori'];
            if ($kat ==1) {
                $isikat = 'Past Project';
            }
            elseif ($kat ==2) {
                $isikat = 'Now Project';    
            }
            elseif ($kat ==3) {
                $isikat = 'Soon Project';    
            }

            $isiart = $item ['isi_art_kategori'];
            $row = array();
            $row[] = $no;
            $row[] = $item ['judul_art_katagori'];
            $row[] = $isikat;
            $row[] = substr($isiart, 0, 50);
            $row[] = '<div class="media-object"><img src="'.$filefoto.'" alt="" class="img"></div>';
            $row[] = '
            <a class="btn btn-sm btn-primary"  title="Edit" onclick="edit_reportH('."'".$item['id_art']."'".')">
            <i class="ico-pencil"></i></a>
            <a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_reportH('."'".$item['id_art']."'".')">
            <i class="ico-remove"></i></a>';
            
            $data[] = $row;
            $no++;
        }

        $output = array(
            "data"=>$data,
        );
        echo json_encode( $output );
    }

    //ajax add Report Heroo
    function ajax_add_ReportH(){
        $post=$this->input->post();
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
            $data['judul_art_katagori']=$post['jdlreport'];
            $data['isi_art_kategori']=$post['editor1'];
            $data['kategori']=$post['kategori'];
            $this->Mreportheroo->in_upload_reportH($data);
            $info="Data Report Heroo disimpan";
        }else {
            $file_data = $this->upload->data();
                //get nama file yg di upload
            $file_name = $file_data['file_name'];
            $data['judul_art_katagori']=$post['jdlreport'];
            $data['isi_art_kategori']=$post['editor1'];
            $data['kategori']=$post['kategori'];
            $data['gambar']=$file_name;
            $this->Mreportheroo->in_upload_reportH($data);
            $info="Data Report Heroo Berhasil disimpan dan foto berhasil di-upload ";
        }
        echo json_encode($info);     
    }

    //ajax update report heroo
    function ajax_update_reportH(){
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
            $data['judul_art_katagori']=$post['jdlreport'];
            $data['isi_art_kategori']=$post['editor1'];
            $data['kategori']=$post['kategori'];
            $this->Mreportheroo->edit_upload_reportH($data,$id);
            $info="Data Report Heroo Berhasil diubah";
        }else {
            $file_data = $this->upload->data();
                //get nama file yg di upload
            $file_name = $file_data['file_name'];
            $data['judul_art_katagori']=$post['jdlreport'];
            $data['isi_art_kategori']=$post['editor1'];
            $data['kategori']=$post['kategori'];
            $data['gambar']=$file_name;
            $this->Mreportheroo->edit_upload_reportH($data,$id);
            $info="Data Report Heroo Berhasil diubah dan foto berhasil di-upload ";
        }
            //
        echo json_encode($info);
    }

    // ajax drop report heroo
    function drop_report_heroo(){
        if ($this->input->post()) {
            $post = $this->input->post();
            $id=$post['id'];
            $this->del_img_heroo($id);
            $this->Mreportheroo->delete_report_heroo($id);
        }
    }

    // delete image
    public function del_img_heroo($id)
    {
        // get image report heroo
        $gambar=$this->Mreportheroo->get_onephoto($id);
        //cek  jika tidak hasil null
        if ($gambar != '' && $gambar!=' ') {
            unlink(FCPATH . "./assets/image/reportheroo/" . $gambar);
        }
    }

    public function getkategori() {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mreportheroo->get_kategori() ) ) ;
    }

}
?>