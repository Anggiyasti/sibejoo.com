<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends MX_Controller {
	private $hakakses;

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('token_model');
		$this->load->model('siswa/msiswa');
		$this->load->library('sessionchecker');
		$this->load->library('pagination');
		$this->sessionchecker->checkloggedin();
		$this->load->helper('string');
		$this->load->model('tryout/Mtryout');
		// $this->hakakses = $this->gethakakse1s();
	}

	public function index(){
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Token",
			);

		$data['files'] = array(
			APPPATH . 'modules/token/views/v-daftar-token2.php',
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

	function add_token(){
		// kalo ada yang post
		$jumlah_token = $this->input->post('jumlah_token');
		$masa_aktif = $this->input->post('masa_aktif');
		if ($jumlah_token) {
			if ($jumlah_token==1) {
				$kode_voucher = strtoupper(uniqid());
				$data = array("nomorToken"=>$kode_voucher,
					"masaAktif"=>$this->input->post('masa_aktif'));
				$this->token_model->insert_token($data);
			}else{
				for ($i=0; $i < $jumlah_token   ; $i++) { 
					$kode_voucher = strtoupper(uniqid());
					$data = array("nomorToken"=>$kode_voucher,
						"masaAktif"=>$masa_aktif);
					$this->token_model->insert_token($data);

				}
			}
		}
	}

	function set_token_to_mahasiswa(){
		if ($this->input->post()) {
			$post = $this->input->post();
			// select dulu token yang kosong
			$param_token = array("jenis_token"=>$post['masa_aktif'],
				"jumlah_token"=>$post['jumlah_mahasiswa']);
			$token_kosong = $this->token_model->token_kosong($param_token);
			$i = 0;
			foreach ($token_kosong as $value) {
			//masukan ke array, ambil id tokenya update sama id mahasiswa
				$token_update = array("id_token"=>$value->id,
					"siswaID"=>$post['id'][$i]);
				$i++;
			// update token
				$this->token_model->set_token_to_mahasiswa($token_update);
			}

		}
	}
	//rawan error
	function isi_token(){
		if ($this->input->post()) {
			$post =$this->input->post();
			$penggunaID = $this->session->userdata['id'];
			$data = array("kode_token" => $post['kode_token'],
				"penggunaID"=>$penggunaID);
			$hasil_token = $this->token_model->get_token_to_set($data);

			if($hasil_token){
				//kalo tokenya ada.
				$data['id_donasi']=$hasil_token[0]->id_donasi;

				$this->token_model->set_token_single($data);
				$report_ajax = 1;
				$tamp_saldo=$this->token_model->info_saldo($penggunaID);
				// cek tamp_saldo jika null
				if ($tamp_saldo != null) {
					// jika tidak null ambil data sisa_aktif token
					$sisa_aktif=$tamp_saldo[0]->sisa_aktif;
					$this->session->set_userdata('sisa_token',$sisa_aktif);
				}
				 
				$this->session->set_userdata('token','Aktif');
				echo json_encode($report_ajax);
			}else{
				//kalo tokenya enggak ada.
				$report_ajax = 0;
				echo json_encode($report_ajax);
			}
		}
	}

	function ajax_get_stock(){
		$jumlah_semua_stok = $this->token_model->get_jumlah_token_stok();
		$jumlah_365_stok = $this->token_model->get_jumlah_token_stok(365);
		$jumlah_1095_stok = $this->token_model->get_jumlah_token_stok(1095);

		$data = array(
			'jumlah_semua_stok' => $jumlah_semua_stok,
			'jumlah_365_stok'  => $jumlah_365_stok,
			'jumlah_1095_stok' => $jumlah_1095_stok
			);

		echo json_encode($data);


	}

	function settoken(){
		$token = $this->session->userdata('token');
		 $id_pengguna = $this->session->userdata('id');
		$info_item = $this->token_model->info_saldo($id_pengguna);

		if ($token=='Aktif' && $info_item != null) {
			$date1 = new DateTime($info_item[0]->tgl_kadaluarsa);
			// $date_diaktifkan = $date1->format('d-M-Y'); date_format($date, 'Y-m-d H:i:s');
			$date_kadaluarsa = date_format($date1,'d-M-Y H:i:s');
			$pesan = "<span>Anda masih memiliki token,</span><br> sisa token ".$info_item[0]->sisa_aktif." Hari.<br> 
						<span>Aktif hingga tanggal ".$date_kadaluarsa.".</span><br> Tambah token ?";
		}else{
			if ($token=='non-aktif') {
				$pesan = "<span>Maaf Token belum aktif,</span><br> silahkan aktifkan dengan cara memasukan nomor token yang sudah dikirim admin";
			}elseif ($token=='Habis') {
				$pesan = "<span>Maaf Token anda sudah habis,</span><br> silahkan isi terlebih dahulu token anda";
			}elseif ($token=='non-aktif') {
			}else{
				$pesan = "<span>Maaf anda tidak memiliki Token,</span><br> silahkan lakukan permintaan pada admin untuk mengirim token";
			}
		}

		
		$data = array(
			'judul_halaman' => 'Sibejoo - Halaman Token',
			'judul_header' =>'Welcome',
			'judul_header2' =>'Video Belajar',
			'pesan'=>$pesan
			);


		$data['files'] = array( 
			APPPATH.'modules/homepage/views/r-header-login.php',
			APPPATH.'modules/token/views/v-set-token.php',
			);
		

		$this->parser->parse( 'templating/r-index', $data );
	}


	function drop_token(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$this->token_model->drop_token($post);
		}
	}

	function aktifkan_token(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$this->token_model->update_token($post);
		}
	}


	public function daftarToken()
	{
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Token",
			);

		$data['files'] = array(
			APPPATH . 'modules/token/views/v-daftar-token2.php',
			);
		$this->loadparser($data);
	}

	public function ajaxLisToken()
	{
		$tb_token=null;
      // code u/pagination
		$this->load->database();

		$masaAktif=$this->input->post("masaAktif");
		$status=$this->input->post("status");
		$jumlah_data_per_page=$this->input->post("records_per_page");
		$page=$this->input->post("pageSelek");
		$keySearch=$this->input->post("keySearch");

		if ($keySearch != '' && $keySearch !=' ' ) {
			if ($status==1) {
				$list = $this->token_model->data_cari_pengguna_token($jumlah_data_per_page,$page,$masaAktif,$status,$keySearch);
			} else {
				$list = $this->token_model->data_cari_token($jumlah_data_per_page,$page,$masaAktif,$status,$keySearch);
			}

		}else{

			$list = $this->token_model->data_token($jumlah_data_per_page,$page,$masaAktif,$status);
		}

		$no=$page+1;
      //cacah data 
		foreach ( $list as $token_item ) {
			// $siswaID=$token_item->siswaID;
			// if ($siswaID!=''&&$siswaID!=' '&&$siswaID!=null) {
			// 	$nama=$token_item->namaDepan." ".$token_item->namaBelakang;
			// 	$namaPengguna=$token_item->namaPengguna;
			// }else{
			// 	$nama="belum digunakan";
			// 	$namaPengguna="-";
			// }
			$id_donasi=$token_item->id_donasi;
			if ($id_donasi!='' && $id_donasi!=' ') {
				$status_token="Sudah Digunakan";
			} else {
				$status_token="Belum Digunakan";
			}
			
      		// tentukan jenis membernya dulu
			if ($token_item->masaAktif==365) {
				$type = 'Heroo Member';
			} else if($token_item->masaAktif==1095) {
				$type = 'Angel Member';
			} else {
				$type = '-';
			}
			$tb_token.='
			<tr>
				<td>'.$no.'</td>
				<td>'.$token_item->nomorToken.'</td>
				<td>'.$token_item->masaAktif.'</td>
				<td>'.$type.'</td>
				<td>'.$status_token.'</td>
				<td><a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_token('."'".$token_item->tokenid."'".')"><i class="ico-remove"></i></a></td>
			</tr>
			';
			$no++;
		}
		echo json_encode( $tb_token );
	}
    //page adalah variabel untuk menampung jumlah record yg akan di tampilkan pada satu halaman
	public function paginationToken()
	{
		$masaAktif=$this->input->post('masaAktif');
		$status=$this->input->post('status');
		$records_per_page=$this->input->post('records_per_page');
		$keySearch=$this->input->post('keySearch');
		if ($keySearch != '' && $keySearch !=' ') {
			if ($status==1) {
				$jumlah_data =$this->token_model->sum_cari_pengguna_token($masaAktif,$status,$keySearch);
			} else {
				$jumlah_data =$this->token_model->sum_cari_data_token($masaAktif,$status,$keySearch);
			}
		}else{
			$jumlah_data = $this->token_model->jumlah_data_token($masaAktif,$status); 
		}
		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
		<span aria-hidden="true">&laquo;</span>
	</a></li>';
	$pagePagination=1;

	$sumPagination=($jumlah_data/$records_per_page);
	for ($i=0; $i < $sumPagination; $i++) { 
		if ($pagePagination<=7) {
			$pagination.='<li ><a href="javascript:void(0)" onclick="selectPage('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
		}else{
			$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPage('.$i.')" >'.$pagePagination.'</a></li>';
		}

		$pagePagination++;
	}
	if ($pagePagination>7) {
		$pagination.='<li class="" id="page-next">
		<a href="javascript:void(0)" onclick="nextPage()" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a>
	</li>';
}
    	 // cek jika halaman pagination hanya satu set pagination menjadi null
if ($sumPagination<=1) {
	$pagination='';
}

echo json_encode ($pagination);
}

public function kirimtoken()
{
	$data = array(
		'judul_halaman' => 'Dashboard '.$this->hakakses." - Kirim Token",
		);

	$data['files'] = array(
		APPPATH . 'modules/token/views/v-kirim-token.php',
		);
		// var_dump($data['dataToken']);
	$this->loadparser($data);
}

public function ajax_data_siswa(){
  	//   	$jumlah_data_per_page = 10;
  	// $page = 0;

	$jumlah_data_per_page = $this->input->post('records_per_page_siswa');
	$page = $this->input->post('pageSelekSiswa');
	$keySearchSiswa = $this->input->post('keySearchSiswa');
	$list = $this->token_model->get_siswa_unvoucher($jumlah_data_per_page,$page,$keySearchSiswa);
	$data = array();
	$n=1;
	$no=$page+1;
	$tb_siswa=null;
		//mengambil nilai list
	$baseurl = base_url();
	foreach ( $list as $list_siswa ) {
		$tb_siswa.='
		<tr>
			<td><span class="checkbox custom-checkbox custom-checkbox-inverse">
				<input type="checkbox" name='.'token'.$n.' id='.'soal'.$list_siswa["id"].' value='.$list_siswa["id"].'>
				<label for='.'soal'.$list_siswa["id"].'>&nbsp;&nbsp;</label></span>
			</td>
			<td>'.$no.'</td>
			<td>'.$list_siswa["namaDepan"].' '.$list_siswa["namaBelakang"].'</td>

			<td>'. $list_siswa["namaPengguna"].'</td>
		</tr>
		';
		$n++;
		$no++;
	}
	echo json_encode( $tb_siswa );

}
public function paginationSiswa()
{	

	$jumlah_data_per_page=$this->input->post("records_per_page_siswa");
	$keySearch=$this->input->post("keySearchSiswa");
	if ($keySearch!='' && $keySearch!=' ') {
		$jumlah_data = $this->token_model->jumlah_cari_siswa_unvoucher($keySearch); 
	} else {
		$jumlah_data = $this->token_model->jumlah_siswa_unvoucher(); 
	}

	
	$pagination='<li class="hide" id="page-prev-siswa"><a href="javascript:void(0)" onclick="prevPageSiswa()" aria-label="Previous">
	<span aria-hidden="true">&laquo;</span>
</a></li>';
$pagePagination=1;

$sumPagination=($jumlah_data/$jumlah_data_per_page);

for ($i=0; $i < $sumPagination; $i++) { 
	if ($pagePagination<=7) {
		$pagination.='<li ><a href="javascript:void(0)" onclick="selectPageSiswa('.$i.')" id="pageSiswa-'.$pagePagination.'">'.$pagePagination.'</a></li>';
	}else{
		$pagination.='<li class="hide" id="pageSiswa-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPageSiswa('.$i.')" >'.$pagePagination.'</a></li>';
	}

	$pagePagination++;
}
if ($pagePagination>7) {
	$pagination.='<li class="" id="page-next-siswa">
	<a href="javascript:void(0)" onclick="nextPageSiswa()" aria-label="Next">
		<span aria-hidden="true">&raquo;</span>
	</a>
</li>';
}
    	     	 // cek jika halaman pagination hanya satu set pagination menjadi null
if ($sumPagination<=1) {
	$pagination='';
    	 		# code...
}
echo json_encode ($pagination);
}
function ajax_rekap_penggunaan_token($masaAktif="all", $status="1",$jumlah_data_per_page="10",$page="0"){

	$tb_token=null;
      // code u/pagination
	$this->load->database();

	$masaAktif=$this->input->post("masaAktif");
	$status=1;
	$jumlah_data_per_page=$this->input->post("records_per_page");
	$page=$this->input->post("pageSelek");
	$keySearch=$this->input->post("keySearch");

	if ($keySearch != '' && $keySearch !=' ' ) {
		if ($status==1) {
			$list = $this->token_model->data_cari_pengguna_token($jumlah_data_per_page,$page,$masaAktif,$status,$keySearch);
		} else {
			$list = $this->token_model->data_cari_token($jumlah_data_per_page,$page,$masaAktif,$status,$keySearch);
		}

	}else{
		$list = $this->token_model->data_token($jumlah_data_per_page,$page,$masaAktif,$status);
	}
	$no=$page+1;
      //cacah data 
	foreach ( $list as $token_item ) {
		$date1 = new DateTime($token_item->tanggal_diaktifkan);
		$date_diaktifkan = $date1->format('d-M-Y');
		$date_kadaluarsa =  date("d-M-Y", strtotime($date_diaktifkan)+ (24*3600*$token_item->masaAktif));
		$date1 = new DateTime(date("d-M-Y"));
		$date2 = new DateTime($date_kadaluarsa);
		$sisa_aktif = $date2->diff($date1);
		$siswaID=$token_item->siswaID;
		$aktif = $token_item->masaAktif;
		if ($siswaID!=''&&$siswaID!=' '&&$siswaID!=null) {
			$nama=$token_item->namaDepan." ".$token_item->namaBelakang;
			$namaPengguna=$token_item->namaPengguna;
		}else{
			$nama="belum digunakan";
			$namaPengguna="-";
		}
      	//cek aktif
		if ($token_item->tokenStatus==1) {
			$tokenStatus="Aktif";
		}else{
			$tokenStatus="non-aktif";
		}
      	// tentukan jenis membernya dulu
		if ($token_item->masaAktif==365) {
			$type = 'Heroo Member';
			$masa_aktif = '1 Tahun';
		} else {
			$type = 'Angel Member';
			$masa_aktif = '3 Tahun';
		} 
	    // hitung sisa aktif 
		if ($date1 > $date2) {
			$sisa_aktif = '0';
		} else {
			$sisa_aktif =$date2->diff($date1)->days;
		}

		if ($tokenStatus=="Aktif") {
			$tb_token.='
			<tr>
				<td>'.$no.'</td>
				<td>'.$nama.'</td>
				<td>'.$namaPengguna.'</td>
				<td>'.$type.'</td>
				<td>'.$token_item->nomorToken.'</td>
				<td>'.$masa_aktif.'</td>
				<td>'.$date_diaktifkan.'</td>
				<td>'.$date_kadaluarsa.'</td>
				<td>'.$sisa_aktif.' Hari</td>
				<td>'.$tokenStatus.'</td>
				<td><a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_token('."'".$token_item->tokenid."'".')"><i class="ico-remove"></i></a></td>
			</tr>
			';	
		} else { 
			$tb_token.='
			<tr>
				<td>'.$no.'</td>
				<td>'.$nama.'</td>
				<td>'.$namaPengguna.'</td>
				<td>'.$type.'</td>
				<td>'.$token_item->nomorToken.'</td>
				<td>'.$masa_aktif.'</td>
				<td>'.$date_diaktifkan.'</td>
				<td>'.$date_kadaluarsa.'</td>
				<td>'.$sisa_aktif.' Hari</td>
				<td>'.$tokenStatus.'</td>
				<td><a class="btn btn-sm btn-danger"  title="Delete" onclick="drop_token('."'".$token_item->tokenid."'".')"><i class="ico-remove"></i></a>'.' <a class="btn btn-sm btn-info"  title="Aktifkan" onclick="update_token('."'".$token_item->tokenid."'".')"><i class="ico-file-check"></i></a></td>
			</tr>
			';
		}
		$no++;
	}

	echo json_encode( $tb_token );

}

}
?>