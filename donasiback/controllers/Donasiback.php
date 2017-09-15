<?php 
class Donasiback extends CI_Controller{
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->model('donasiback_model');
		$this->load->model('laporanortu/laporanortu_model');

		$this->load->library('parser');
		$this->load->helper('string');
		$this->hakakses = $this->gethakakses();

	}
	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Donasi Member",
			);
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
				echo json_encode(array('status'=>1,'message'=>"Berhasil menset token"));
			}
		}
	}

	function kirim_token_to_siswa(){
		if ($this->input->post()) {
			$id_donasi = $this->input->post('id');
			// get data info untuk dikirim ke pengguna
			$info_to_send_token = $this->donasiback_model->get_info_for_send_token($id_donasi)[0];
			$data_insert_laporan_ortu = ['id_ortu'=>$info_to_send_token->ortu_id,
			'jenis'=>"TOKEN DONASI",
			'UUID'=>uniqid(),
			'isi'=>'Halo, '.$info_to_send_token->namaDepan." ".$info_to_send_token->namaBelakang.'! dibawah ini adalah token anda <br> <span class="text-info">'.$info_to_send_token->nomor_token.'</span> dengan masa aktif '.$info_to_send_token->masa_aktif.' Hari. Simpan nomor token anda untuk kebutuhan kemudian hari. Terimakasih!'
			];

			$this->laporanortu_model->insert_laporan($data_insert_laporan_ortu);
			echo json_encode(array('status'=>1,'message'=>"Token berhasil dikirim ke ".$info_to_send_token->namaDepan." ".$info_to_send_token->namaBelakang));
		}
	}

	function ajax_datatatable_donasi(){
		$data['donasi_items'] = $this->donasiback_model->get_donasi();

		$status = ['','Idle','Wait to Konfirm','Diterima','Kirim Token'];
		$donasi = ['','Heroo','Angel'];
		$list = [];
		$no = 1;

		foreach ( $data['donasi_items'] as $item ) {
			$no++;
			$index = $item->status_donasi;

			$row = array();			
			$row[] = $no;
			$row[] = $item->namaPengguna;
			$row[] = $donasi[$item->donasi];
			$row[] = $item->tgl_create;
			$row[] = $index = $item->status_donasi." ".$status[$index];
			if ($item->status_donasi==1){
				$button = '<button type="button" class="btn btn-default mb5" disabled="true"><i class="ico-cart-remove2"></i> Belum Transfer</button>';
			}elseif($item->status_donasi==2){
				$button = '<button  onclick="info('.$item->donasi_id.')" type="button" class="btn btn-info mb5" ><i class="ico-file"></i> Info</button>';
			}elseif($item->status_donasi==3){
				$button = '<button  onclick="set_token('.$item->donasi_id.')" type="button" class="btn btn-primary mb5" ><i class="ico-barcode3"></i> Set Token</button>';
			}else{
				$button = '<button   onclick="kirim_token('.$item->donasi_id.')" type="button" class="btn btn-primary mb5" ><i class="ico-mail-send"></i> Kirim Token</button>';
			}
			$row[] = $button;
			$list[] = $row;
		}

		$output = array(
			"data"=>$list,
			);

		echo json_encode( $output );        

	}



}
?>