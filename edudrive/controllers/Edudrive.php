<?php
class Edudrive extends MX_Controller {

    private $upload_path = "./assets/modul";
    function __construct() {
        parent::__construct();
        $this->load->model('Medudrive');
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
        $totalRec = count($this->Medudrive->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRows($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        $totalRec = count($this->Medudrive->getRowssd($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationDataSD';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRowssd($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        $totalRec = count($this->Medudrive->getRowssmp($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationDataSMP';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRowssmp($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        $totalRec = count($this->Medudrive->getRowssma($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationDataSMA';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRowssma($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        $totalRec = count($this->Medudrive->getRowssmaipa($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationDataSMAIPA';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRowssmaipa($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        $totalRec = count($this->Medudrive->getRowssmaips($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'index.php/edudrive/ajaxPaginationDataSMAIPS';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->Medudrive->getRowssmaips($conditions);
        
        //load the view
        $this->load->view('edudrive/ajax-pagination-data', $data, false);
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
        APPPATH.'modules/edudrive/views/v-edudrive.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['downloads'] = $this->Medudrive->get_modulteratas();
    $data['member'] = $this->session->userdata('member');

    //total rows count
    $totalRec = count($this->Medudrive->getRows());

    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/allmodul/ajaxPaginationData';
    $config['total_rows']  = $totalRec;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);

    //get the posts data
    $data['posts'] = $this->Medudrive->getRows(array('limit'=>$this->perPage));
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
        APPPATH.'modules/edudrive/views/v-edusd.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );
    $data['member'] = $this->session->userdata('member');
    $data['modul'] = $this->Medudrive->modulsd();
    $data['downloads'] = $this->Medudrive->get_modulteratas();

    //total rows count
    $totalRec = $this->Medudrive->getRowssd();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/modulsd/ajaxPaginationDataSD';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    
    //get the posts data
    $data['posts'] = $this->Medudrive->getRowssd(array('limit'=>$this->perPage));
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
        APPPATH.'modules/edudrive/views/v-edusmp.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Medudrive->modulsmp();
    $data['member'] = $this->session->userdata('member');
    $data['downloads'] = $this->Medudrive->get_modulteratas();
    //total rows count
    $totalRec = $this->Medudrive->getRowssmp();

    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/modulsmp/ajaxPaginationDataSMP';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    //get the posts data
    $data['posts'] = $this->Medudrive->getRowssmp(array('limit'=>$this->perPage));
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
        APPPATH.'modules/edudrive/views/v-edusma.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );
    $data['modul'] = $this->Medudrive->modulsma();
    $data['downloads'] = $this->Medudrive->get_modulteratas();
    $data['member'] = $this->session->userdata('member');

    //total rows count
    $totalRec = $this->Medudrive->getRowssma();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/modulsma/ajaxPaginationDataSMA';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
        //get the posts data
    $data['posts'] = $this->Medudrive->getRowssma(array('limit'=>$this->perPage));
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
        APPPATH.'modules/edudrive/views/v-edusmaipa.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Medudrive->modulsmaipa();
    $data['downloads'] = $this->Medudrive->get_modulteratas();
    $data['member'] = $this->session->userdata('member');


    //total rows count
    $totalRec = $this->Medudrive->getRowssmaipa();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
        //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/modulsmaipa/ajaxPaginationDataSMAIPA';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);

        //get the posts data
    $data['posts'] = $this->Medudrive->getRowssmaipa(array('limit'=>$this->perPage));

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
        APPPATH.'modules/edudrive/views/v-edusmaips.php',
        APPPATH.'modules/testimoni/views/r-footer.php',
        );

    $data['modul'] = $this->Medudrive->modulsmaips();
    $data['downloads'] = $this->Medudrive->get_modulteratas();
    $data['member'] = $this->session->userdata('member');
    

        // $data = array();

        //total rows count
    $totalRec = $this->Medudrive->getRowssmaips();
    if (!$totalRec) {
        $jumlah_row = 0;
        # code...
    }else{
        $jumlah_row = count($totalRec);
    }
    //pagination configuration
    $config['target']      = '#postList';
    $config['base_url']    = base_url().'index.php/edudrive/modulsmaips/ajaxPaginationDataSMAIPS';
    $config['total_rows']  = $jumlah_row;
    $config['per_page']    = $this->perPage;
    $config['link_func']   = 'searchFilter';
    $this->ajax_pagination->initialize($config);
    $data['posts'] = $this->Medudrive->getRowssmaips(array('limit'=>$this->perPage));
    $this->parser->parse( 'templating/r-index', $data );

}



public function tambahdownload($idmodul) {
    $download = $this->Medudrive->ambilnilai($idmodul);
    $temp= $download['download']+1;       
    $this->Medudrive->tambahdownload($idmodul,$temp);
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