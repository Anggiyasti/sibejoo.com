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
        $data['judul_halaman'] = "Report Heroo";
        
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_daftar_reportheroo.php',
        );
        $report = $this->Mreportheroo->get_report_heroo();
        $data['data']= $report;  
        $this->loadparser($data);
    }

    // view tambah report heroo
    function tambah_heroo()
    {
        $data['judul_halaman'] = "Tambah Report Heroo";
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_tambah_reportheroo.php',
        );
        $this->loadparser($data);
        
    }

    // fungsi view report heroo masuk ke update
    public function update_report_heroo($id){
        $data['judul_halaman'] = "Update Report Heroo";
        $data['files'] = array(
            APPPATH . 'modules/Reportheroo/views/v_update_reportheroo.php',
        );
        $data['RH'] = $this->Mreportheroo->get_report_by_id($id);
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
                $filefoto=$this->generateavatar->generate_first_letter_avtar_url($nama);;
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
            <a class="btn btn-sm btn-primary btn-outline detail-'.$item['id_art'].'"  title="Lihat" 
            data-id='."'".json_encode($item)."'".' onclick="detail('."'".$item['id_art']."'".')">
            <i class="ico-eye"></i></a>
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
    function ajax_add_report(){
        $post=$this->input->post();
        //konfigurasi upload
        $data['judul_art_katagori']=$post['jdlreport'];
        $data['isi_art_kategori']=$post['editor1'];
        $data['kategori']=$post['kategori'];
        $img = $post['img'];
        $foto = $post['foto'];

        if ($foto=="") {
            $this->Mreportheroo->in_upload_report($data);
            $info="Data Report Heroo disimpan";
        }else {
            list($type, $img) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);
            $imageName = time().'.png';
        
            file_put_contents('./assets/image/reportheroo/'.$imageName, $img);
            $data['gambar']=$imageName;
            $this->Mreportheroo->in_upload_report($data);
            $info="Data Report Heroo Berhasil disimpan dan foto berhasil di-upload ";
        }
        echo json_encode($info);     
    }

    //ajax update report heroo
    function ajax_update_report(){
        $post=$this->input->post();
        //konfigurasi upload
        $id = $post['id'];
        $data['judul_art_katagori']=$post['jdlreport'];
        $data['isi_art_kategori']=$post['editor1'];
        $data['kategori']=$post['kategori'];
        $img = $post['img'];
        $foto = $post['foto'];

        if ($foto=="") {
            $this->Mreportheroo->edit_upload_report($data,$id);
            $info="Data Report Heroo Berhasil diubah";
        }else {
            $onephoto = $this->Mreportheroo->get_onephoto($id);
            if ($onephoto != '' && $onephoto!=' ') {
                unlink(FCPATH . "./assets/image/reportheroo/" . $onephoto);
                $imageName=$onephoto;
            } else {
                $imageName = time().'.png';
            }
            //konfigurasi upload
            list($type, $img) = explode(';', $img);
            list(, $img)      = explode(',', $img);
            $img = base64_decode($img);
            file_put_contents('./assets/image/reportheroo/'.$imageName, $img);
            $data['gambar']=$imageName;
            $this->Mreportheroo->edit_upload_report($data,$id);
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

    // get kategori report heroo
    public function getkategori() {
        $data = $this->output
        ->set_content_type( "application/json" )
        ->set_output( json_encode( $this->Mreportheroo->get_kategori() ) ) ;
    }

    // hapus gambar report heroo
    public function hapus_foto()
    {
        if ($this->input->post()) {
            $post = $this->input->post();
            $id=$post['id'];
            $data['gambar']="";
            $this->del_img_heroo($id);
            $this->Mreportheroo->update_foto_heroo($data,$id);
            echo json_encode("Berhasil");
        }
    }

}
?>