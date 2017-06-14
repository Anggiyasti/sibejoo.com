<?php 
class Donasiback extends CI_Controller{
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->model('donasiback_model');

		$this->load->library('parser');
		$this->load->helper('string');
		$this->hakakses = $this->gethakakses();

	}
	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Donasi Member",
			);
		$data['donasi_items'] = $this->donasiback_model->get_donasi();
		$data['files'] = array(
			APPPATH . 'modules/donasiback/views/v-daftar-donasi.php',
			);
		$this->loadparser($data);
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

	function get_konfirmasi_by_id_donasi(){
		if ($this->input->post()) {
			$id_donasi = $this->input->post('id_donasi');
			$data['donasi']=$this->donasiback_model->get_konfirmasi_by_id_donasi($id_donasi);
			echo json_encode($data['donasi'][0]);
		}
		
	}

	function konfirmasi_donasi(){
		if ($this->input->post()) {
			$id_donasi = $this->input->post('id_donasi');
			$this->donasiback_model->konfirmasi_donasi($id_donasi);
			echo json_encode("Konfrimasi donasi sukses!");

		}
	}



}
?>