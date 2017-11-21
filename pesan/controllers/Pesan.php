<?php

/**
 *
 */
class Pesan extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mpesan');
        $this->load->helper('session');
        $this->load->library('parser');
        $this->load->library('sessionchecker');
        //cek login
        $this->sessionchecker->checkloggedin();
    }

    public function index() {
        $data['judul_halaman'] = "Pengelolaan Pesan";
        $data['files'] = array(
            APPPATH . 'modules/pesan/views/v-daftar-pesan.php',
        );

        $this->parser->parse('admin/v-index-admin', $data);
    }

    public function ajax_daftar_pesan() {
        $list = $this->Mpesan->tampil_pesan();

        $data = array();
        $no = 0;
        //mengambil nilai list
        $baseurl = base_url();
        foreach ($list as $list_pesan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_pesan['name'];
            $row[] = $list_pesan['phone'];
            $row[] = $list_pesan['alamat'];
            $row[] = $list_pesan['pesan'];
            $row[] = $list_pesan['tgl_pesan'];
            $row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropPesan(' . "" . $list_pesan['id_pesan'] . ')"><i class="ico-remove"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function deletePesan() {
        $idpesan = $this->input->post('id_pesan');
        $this->Mpesan->hapus_pesan($idpesan);
    }

    //GET HAK AKSES
    function gethakakses(){
        return $this->session->userdata('HAKAKSES');
    }
    //GET HAK AKSES


    // FUNGSI UNTUK VIEW PESAN ORTU DAN SISWA
    public function messages($UUID="")
    {
        $id = $this->session->userdata('id'); 
        // kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');
            // update status read menjadi 1
            $this->Mpesan->update_read($UUID);  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME'); 
            // update status read menjadi 1
            $this->Mpesan->update_read_siswa($UUID);
 
        } 
        $namadepan = $this->Mpesan->namasiswa($id_pengguna)['namaDepan'];
        $namabelakang = $this->Mpesan->namasiswa($id_pengguna)['namaBelakang'];
            
        $data['judul_halaman'] = "Laporan $namadepan $namabelakang";

        $hakAkses = $this->session->userdata['HAKAKSES'];
        $data = array(
        'judul_halaman' => 'Sibejoo - Daftar Pesan',
        'judul_header' => 'History Pesan',
        'judul_tingkat' => '',
        );

        $data['files'] = array(
            APPPATH.'modules/homepage/views/r-header-login.php',
            APPPATH . 'modules/pesan/views/r-daftar-report.php'      
        );
        
        $data['datLapor'] = $this->Mpesan->get_daftar_pesan($id);
        $data['count_pesan'] = $this->Mpesan->get_count($id);

        $this->hakakses = $this->gethakakses();
        if ($this->hakakses=='ortu') {
            $this->parser->parse('templating/r-index', $data);
        }elseif ($this->hakakses=='siswa'){
            $this->parser->parse('templating/r-index', $data);      
        }else {
            echo "forbidden access";   
        }
    }

    //laporan ortu ajax
    public function report_ajax($jenis="all"){

        $datas = ['jenis'=>$jenis];
        // kodisi jika login sebagai ortu, maka id pengguna yang digunakan berbeda dengan siswa
        if ($this->session->userdata('HAKAKSES')=='ortu') {
            $id_pengguna = $this->session->userdata('NAMAORTU');  
        }else{
            $id_pengguna = $this->session->userdata('USERNAME');  
        } 
        $all_report = $this->Mpesan->get_report_all($datas,$id_pengguna);
        
        $data = array();
        $n=1;
        foreach ( $all_report as $item ) {
        
            $row = array();
            $row[] = $n;
            $row[] = $item ['jenis'];
            $row[] = $item ['isi'];
            $row[] = $item ['tgl'];

            $data[] = $row;
            $n++;
        }

        $output = array(
            "data"=>$data,
            );

        echo json_encode( $output );
    }


}

?>
