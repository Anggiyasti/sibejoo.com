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


	function set_siswa_donasi(){
		if ($this->input->post()) {
			$id_donasi = $this->input->post('id');
		// SELECT SISWA YANG SUDAH KONFIRM
			$id_siswa_jenis_donasi = $this->donasiback_model->get_id_siswa($id_donasi)[0];
		// SELECT TOKEN YANG SESUAI DAN MASIH KOSONG
			$token_id = $this->donasiback_model->select_token($id_siswa_jenis_donasi->donasi);
			if ($token_id==array()) {
				echo json_encode(array('status'=>0,'message'=>"Maaf sisa token kosong"));
			}else{
				$update = ['id_donasi'=>$id_donasi,'id_token'=>$token_id[0]->token_id,'id_siswa'=>$id_siswa_jenis_donasi->id_siswa];
			// UPDATE TOKEN
				$this->donasiback_model->update_status_token($update);			
				echo json_encode(array('status'=>1,'message'=>"Berhasil mengirim token"));
			}
		}
	}

	function kirim_token_to_siswa(){
		// if ($this->input->post()) {
			// $id_donasi = $this->input->post('id');
			$id_donasi = 2;
			$info_to_send_token = $this->donasiback_model->get_info_for_send_token($id_donasi)[0];
			print_r($info_to_send_token);

		// }
	}



}
?>