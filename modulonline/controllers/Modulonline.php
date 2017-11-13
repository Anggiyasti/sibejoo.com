<?php
class Modulonline extends MX_Controller {

    private $upload_path = "./assets/modul";
    function __construct() {
        parent::__construct();
        $this->load->model('Mmodulonline');
        $this->load->library('Ajax_pagination');
        $this->perPage = 6;
        $this->load->model('komenback/mkomen');
        $this->load->model('templating/Mtemplating');
        $this->load->model( 'matapelajaran/mmatapelajaran' );
        $this->load->model( 'tingkat/MTingkat' );
        $this->load->library('parser');
        $this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();

    }

    public function index(){
        $this->allmodul();
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRows($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }

    function ajaxPaginationDataSD(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRowssd($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationDataSD';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRowssd($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }


    function ajaxPaginationDataSMP(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRowssmp($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationDataSMP';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRowssmp($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }

    function ajaxPaginationDataSMA(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRowssma($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationDataSMA';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRowssma($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }

    function ajaxPaginationDataSMAIPA(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRowssmaipa($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationDataSMAIPA';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRowssmaipa($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }


    function ajaxPaginationDataSMAIPS(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Mmodulonline->getRowssmaips($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/modulonline/ajaxPaginationDataSMAIPS';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Mmodulonline->getRowssmaips($conditions);
        
        //load the view
        $this->load->view('modulonline/ajax-pagination-data', $data, false);
    }



    ## START FUNCTION UNTUK HALAMAN ALL SOAL##
    //function untuk menampilkan halaman all soal
    public function daftar_modul(){
        $data['judul_halaman'] = "Sibejoo - Modul Online";
        $data['files'] = array(
            APPPATH . 'modules/modulonline/views/v-edu-all.php',
            );
        #START cek hakakses#
        $hakAkses=$this->session->userdata['HAKAKSES'];
        if ($hakAkses=='admin') {
            $this->parser->parse('admin/v-index-admin', $data);
        } elseif( $hakAkses=='admin_cabang' ){
          $this->parser->parse('admincabang/v-index-admincabang', $data);
      } elseif($hakAkses=='guru'){
          // jika guru
          // notification
          $data['datKomen']=$this->datKomen();
          $id_guru = $this->session->userdata['id_guru'];
          // get jumlah komen yg belum di baca
          $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
          //
          $this->parser->parse('templating/index-b-guru', $data);            
      }else{
            // jika siswa redirect ke welcome
        redirect(site_url('welcome'));
    }
        #END Cek USer#
}

    // function untuk mengambil data soal
function ajax_listAllSoal() {
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if($hakAkses=='admin'){
     $modul = $this->Mmodulonline->get_all_moduls();
    }elseif($hakAkses=='guru'){
    //tampil modul by guru//
    $create_by = $this->session->userdata['id'];
    $modul = $this->Mmodulonline->modul_guruid($create_by);
    }else{
        redirect(site_url('welcome'));
    }

    $data = array();
    $no = 1;

    $baseurl = base_url();
    foreach ($modul as $modul_list ) {
        $id=$modul_list['id'];
        $judul=$modul_list['judul'];
        $deskripsi=$modul_list['deskripsi'];
            // $url=$list_soal['url_file'];
        $publish=$modul_list['publish'];
        $ckPublish="";

            //mnentukan checked publish
        if ($publish =='1') {
            $ckPublish="checked";
        } 

        $row = array();
        $row[] = $no;
        $row[] = $modul_list['judul'];
        $row[] = $modul_list['deskripsi'];
        $row[] ='
        <span class="checkbox custom-checkbox custom-checkbox-inverse">
            <input type="checkbox" name="ckRand"'.$ckPublish.' value="1">
            <label for="ckRand" >&nbsp;&nbsp;</label>
        </span>';
        $row[] = '<a href="'.base_url("assets/modul/".$modul_list['url_file']).'" class="btn btn-sm btn-primary" target="_blank">
        <i class="ico-download"></i>
    </a>';

    $row[] = '
    <form action="'.base_url().'index.php/modulonline/form_update" method="get">
        <input type="text" name="uuid" value="'.$modul_list['uuid'].'"  hidden="true">
        <input type="text" name="id_tingkatmapel" value="'.$modul_list['id_tingkatpelajaran'].'" hidden="true">
        <button type="submit" title="edit" class="btn btn-sm btn-warning"><i class="ico-file5"></i></button>

    </form>';

    $row[]=' 
    <a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_modul('."'".$modul_list['id']."'".')"><i class="ico-remove"></i></a>';

    $data[] = $row;
    $no++;

}

$output = array(

    "data"=>$data,
    );

echo json_encode( $output );
} 


public function formmodul() {

    $data['judul_halaman'] = "Modul Online";
    $data['files'] = array(
        APPPATH . 'modules/modulonline/views/v-form-edudrive.php',
        );
         #START cek hakakses#
    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
            // jika admin
        $this->parser->parse('admin/v-index-admin', $data);
    } elseif( $hakAkses=='admin_cabang' ){
      $this->parser->parse('admincabang/v-index-admincabang', $data);
  } elseif($hakAkses=='guru'){
            //get data komen yg belum di baca
    $data['datKomen']=$this->datKomen();
            ##count komen
            //get id guru
    $id_guru = $this->session->userdata['id_guru'];
            // get jumlah komen yg belum di baca
    $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
            ## count komen
            // jika guru
    $this->parser->parse('templating/index-b-guru', $data);
}else{
          // jika siswa redirect ke welcome
  redirect(site_url('welcome'));
}
                #END Cek USer#
}

//fungsi untuk upload modul edu drive
public function uploadmodul() {
        //load library n helper
    $post=$this->input->post();
    $config['upload_path'] = $this->upload_path;
    $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
    $config['max_size'] = 10000;

    $configLogo['encrypt_name'] = TRUE;
    $new_name = time()."-".$_FILES["gambarSoal"]['name'];
    $config['file_name'] = $new_name;
    $this->load->library('upload', $config);
    $foto = 'gambarSoal';
    $this->upload->initialize($config);
    $file_foto=$post['gambarSoal'];
    $UUID = uniqid();

    $create_by = $this->session->userdata['id'];

        $this->upload->do_upload($foto);
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        $data['judul']=$post['judul'];
        $data['deskripsi']=$post['deskripsi'];
        $data['create_by']=$create_by;
        $data['publish']=$post['publish'];
        $data['UUID']=$UUID;
        $data['id_tingkatpelajaran']=$post['mapel'];
        $data['url_file']=$file_name;

    $this->Mmodulonline->insert_modul($data);
    
    $info="Edu Drive Berhasil disimpan";
    echo json_encode($info); 
}

    //function upload gambar soal
public function up_img_soal($UUID) {
    $config['upload_path'] = './assets/modul/';
    $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
    $config['max_size'] = 10000;

    $this->load->library('upload', $config);
    $gambar = "gambarSoal";
    $this->upload->do_upload($gambar);
    $file_data = $this->upload->data();
    $file_name = $file_data['file_name'];
    $data['uuid']=$UUID;
    $data['dataSoal']=  array(
        'url_file' => $file_name);

        // print_r($data);
    $this->Mmodulonline->ch_soal($data);
}


public function ch_img_soal($UUID) {
    $config['upload_path'] = './assets/modul/';
    $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
    $config['max_size'] = 10000;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768;
    $this->load->library('upload', $config);
    $gambar = "gambarSoal";
    $oldgambar = $this->Mmodulonline->get_oldgambar_soal($UUID);
    if ($this->upload->do_upload($gambar)) {
     foreach ($oldgambar as $rows) {
        unlink(FCPATH . "./assets/modul/" . $rows['url_file']);
    }
    $file_data = $this->upload->data();
    $file_name = $file_data['file_name'];
    $data['uuid']=$UUID;
    $data['dataSoal']=  array(
      'url_file' => $file_name);
    $this->Mmodulonline->ch_soal($data);
}
        // $this->Mbanksoal->insert_gambar($datagambar);
}

    #ENDFunction untuk form upload soal#
    #START Function untuk form update bank soal #

public function form_update() {
    $tingkatmapel =htmlspecialchars($this->input->get('id_tingkatmapel'));
    $data['id_tingkatpelajaran'] = $tingkatmapel;
    $data['infosoal']=$this->Mmodulonline->get_info_modul($tingkatmapel);
    $uuid = htmlspecialchars($this->input->get('uuid'));
    $data['banksoal'] = $this->Mmodulonline->get_onesoal($uuid)[0];

    $data['judul_halaman'] = "Modul Online";
    $data['files'] = array(
        APPPATH . 'modules/modulonline/views/v-update-edudrive.php',
        );

    $hakAkses=$this->session->userdata['HAKAKSES'];
    if ($hakAkses=='admin') {
            // jika admin
        if ($data['id_tingkatpelajaran'] == null || $UUID == null) {
            redirect(site_url('admin'));
        } else {
            $this->parser->parse('admin/v-index-admin', $data);
        }
    } elseif( $hakAkses=='admin_cabang' ){

      if ($data['id_tingkatpelajaran'] == null || $UUID == null) {
        redirect(site_url('admincabang'));
    } else {
       $this->parser->parse('admincabang/v-index-admincabang', $data);
   }
} elseif($hakAkses=='guru'){
            // jika guru
    if ($data['id_tingkatpelajaran'] == null || $uuid == null) {
        redirect(site_url('guru/dashboard/'));
    } else {
              // notification
      $data['datKomen']=$this->datKomen();
      $id_guru = $this->session->userdata['id_guru'];
              // get jumlah komen yg belum di baca
      $data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);
              //
      $this->parser->parse('templating/index-b-guru', $data);
  }

}else{
    redirect(site_url('welcome'));
}
}

//fungsi untuk update modul edu drive
public function update_modul() {

    $post=$this->input->post();
    $UUID = $post['UUID'];
    $onefile = $this->Mmodulonline->get_onefile($UUID)[0]['url_file'];

        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
        $config['max_size'] = 10000;

        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["gambarSoal"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'gambarSoal';
        $this->upload->initialize($config);
        $file_foto=$post['gambarSoal'];


        $this->upload->do_upload($foto);
        if ($onefile!='' && $onefile!=' ') {
                   unlink(FCPATH . "./assets/modul/" . $onefile);
          }
        $file_data = $this->upload->data();
        $file_name = $file_data['file_name'];
        //data yang akan di update
        $data['judul']=$post['judul'];
        $data['deskripsi']=$post['deskripsi'];
        $data['publish']=$post['publish'];
        $data['id_tingkatpelajaran']=$post['mapel'];
        //jika file diupdate dan tidak
        if ($file_foto != NULL) {
            $data['url_file']=$file_name;
        }
        //model untuk update data
    $this->Mmodulonline->ch_edudrive($data,$UUID);
    $info="Edu Drive Berhasil diubah";
    echo json_encode($info); 
}

public function delete_modul() {
    $post= $this->input->post();
    $this->Mmodulonline->del_banksoal($post);
}
    // fungsi untuk memfilter video yang akan di tampilkan
public function filtermodul()
{
    $tingkatID = $this->input->post('tingkat');
    $mpID = $this->input->post('mataPelajaran');
        // $bab=$this->input->post('bab');
        // $subbab=$this->input->post('subbab');
    if ($mpID != null) {
        $this->soalMp($mpID);
    } else if ($tingkatID != null) {
        $this->soalTingkat($tingkatID);
    } else {
       $this->allsoal();
            // $this->listsoal($subbab);
   }    
}


public function allmodul() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['downloads'] = $this->Mmodulonline->get_modulteratas();
    $data['member'] = $this->session->userdata('member');

    //total rows count
    $totalRec = count($this->Mmodulonline->getRows());

    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/allmodul/ajaxPaginationData';
    $config['total_rows']  = $totalRec;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);

    //get the posts data
    $data['posts'] = $this->Mmodulonline->getRows(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );

}

public function modulsd() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive Sekolah Dasar',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );
    $data['member'] = $this->session->userdata('member');
    $data['modul'] = $this->Mmodulonline->modulsd();
    $data['downloads'] = $this->Mmodulonline->get_modulteratas();

    //total rows count
    $totalRec = $this->Mmodulonline->getRowssd();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/modulsd/ajaxPaginationData';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    
    //get the posts data
    $data['posts'] = $this->Mmodulonline->getRowssd(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );
}

public function modulsmp() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive SMP',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Mmodulonline->modulsmp();
    $data['member'] = $this->session->userdata('member');
    $data['downloads'] = $this->Mmodulonline->get_modulteratas();
    //total rows count
    $totalRec = $this->Mmodulonline->getRowssmp();

    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/modulsmp/ajaxPaginationData';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    //get the posts data
    $data['posts'] = $this->Mmodulonline->getRowssmp(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );
}

public function modulsma() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive SMA',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );
    $data['modul'] = $this->Mmodulonline->modulsma();
    $data['downloads'] = $this->Mmodulonline->get_modulteratas();
    $data['member'] = $this->session->userdata('member');

    //total rows count
    $totalRec = $this->Mmodulonline->getRowssma();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/modulsma/ajaxPaginationData';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
        //get the posts data
    $data['posts'] = $this->Mmodulonline->getRowssma(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );
}

public function modulsmaipa() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive SMA IPA',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Mmodulonline->modulsmaipa();
    $data['downloads'] = $this->Mmodulonline->get_modulteratas();
    $data['member'] = $this->session->userdata('member');


    //total rows count
    $totalRec = $this->Mmodulonline->getRowssmaipa();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
        //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/modulsmaipa/ajaxPaginationData';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);

        //get the posts data
    $data['posts'] = $this->Mmodulonline->getRowssmaipa(array('limit'=>$this->perPage));

    $this->parser->parse( 'templating/r-index', $data );

}

public function modulsmaips() {
    $data = array(
        'judul_halaman' => 'Sibejoo - Edu Drive SMA IPS',
        'judul_header' =>'Welcome',
        'judul_header2' =>'Modul Belajar'
        );

    $data['files'] = array( 
        APPPATH.'modules/homepage/views/r-header-login.php',
        APPPATH.'modules/modulonline/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Mmodulonline->modulsmaips();
    $data['downloads'] = $this->Mmodulonline->get_modulteratas();
    $data['member'] = $this->session->userdata('member');
    

        // $data = array();

        //total rows count
    $totalRec = $this->Mmodulonline->getRowssmaips();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/modulonline/modulsmaips/ajaxPaginationData';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    $data['posts'] = $this->Mmodulonline->getRowssmaips(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );

}



public function tambahdownload($idmodul) {
    $download = $this->Mmodulonline->ambilnilai($idmodul);
    $temp= $download['download']+1;       
    $this->Mmodulonline->tambahdownload($idmodul,$temp);
}

    // get data komen not read
public function datKomen()
{
    $hakAkses = $this->session->userdata['HAKAKSES'];
    if ($hakAkses == 'admin') {
        $listKomen = $this->mkomen->get_all_komen();
    }else{
      $id_guru = $this->session->userdata['id_guru'];
      $listKomen = $this->mkomen->get_komen_by_profesi_notread($id_guru);
  }

  return $listKomen;
}

}

?>