<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Token_model extends CI_Model{

	function get_token2($data,$status){
		$this->db->order_by('tb_token.id');

		if ($data!="all") {
			$this->db->where('masaAktif',$data);
		}
		if ($status==1) {
			$this->db->where('siswaID is not null');
			$this->db->join('tb_siswa', 'tb_token.siswaID = tb_siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_siswa.penggunaID');
		}else{
			$this->db->where('siswaID is null');
			$this->db->join('tb_siswa', 'tb_token.siswaID = tb_siswa.id', 'left outer');
			$this->db->join('tb_pengguna', 'tb_pengguna.id = tb_siswa.penggunaID','left outer');

		}
		$this->db->select( '*,tb_token.id as tokenid,tb_token.status as tokenStatus' )->from( 'tb_token' ); 

		$query = $this->db->get(); 
		return $query->result(); 
	}

	function insert_token($data){
		$this->db->insert( 'tb_token', $data );		
	}

	function get_jumlah_token_stok($param=""){
		$this->db->select( 'id' )->from( 'tb_token' ); 
		$this->db->where('siswaID is NULL');
		if ($param==365 || $param==1095) {
			$this->db->where('masaAktif',$param);
		}
		$query = $this->db->get(); 
		return $query->num_rows(); 
	}

	//get mahasiswa yang belum memiliki voucher
	function get_siswa_unvoucher2(){
		$query = "SELECT s.`id`, s.`namaDepan`,s.`namaBelakang`,c.`namaCabang`,p.`namaPengguna` FROM tb_siswa s 
		LEFT JOIN `tb_cabang` c
		ON s.`cabangID` = c.id
		JOIN `tb_pengguna` p ON
		p.`id` = s.`penggunaID`
		WHERE s.id NOT IN
		(
		SELECT t.`siswaID` FROM `tb_token` t
		JOIN tb_siswa s ON s.`id` = t.`siswaID`
		) AND s.`status`=1";

		$result = $this->db->query($query);
		return $result->result_array();
	}

	// get token kosong yang mau di set ke mahasiswa
	function token_kosong($data){
		$this->db->select( 'id' )->from( 'tb_token' );
		$this->db->where('masaAktif',$data['jenis_token']);
		$this->db->where('siswaID',NULL);
		$this->db->limit($data['jumlah_token']);
		$this->db->order_by('id','desc');
		$query = $this->db->get(); 
		return $query->result();  	
	}
		// update token untuk mahasiswa
	function set_token_to_mahasiswa($param){
		$sekarang = date('Y-m-d h:m:s');
		$this->db->where('id', $param['id_token']);
		$this->db->set('siswaID', $param['siswaID']);
		$this->db->update('tb_token');
	}

		// get token untuk diset ke mahasiswa
	function get_token_to_set($data){
		$this->db->select('donasi.id as id_donasi')->from( 'tb_token token' );
		$this->db->join('tb_donasi donasi','token.id_donasi = donasi.id');
		$this->db->where('penggunaID',$data['penggunaID']);
		$this->db->where('nomorToken',$data['kode_token']);
		$query = $this->db->get(); 
		return $query->result();  	
	}

		//update token untuk siswa
	function set_token_single($data){
		$this->db->where('nomorToken', $data['kode_token']);
		$this->db->where('id_donasi', $data['id_donasi']);
		$this->db->set('tanggal_diaktifkan', date('Y-m-d h:m:s'));
		$this->db->set('status', 1);

		$this->db->update('tb_token');
	}

		//drop token
	function drop_token($data){
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_token');
	}

	function update_token($data){
		$this->db->where('id', $data['id']);
		$this->db->set('tanggal_diaktifkan', date('Y-m-d h:m:s'));
		$this->db->set('status', 1);
		$this->db->update('tb_token');
	}
	//jumlah semua token dengan status 1
	function jumlah_data_token($masaAktif,$status){
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		if ($status==1) {
				$this->db->where('token.id_donasi is not null');
			$this->db->join('tb_donasi donasi', 'token.id_donasi = donasi.id', 'left outer');
		}else{
			$this->db->where('token.id_donasi is null');
		}
		return $this->db->get('tb_token token')->num_rows();
	}

    // data paginataion all token
	function data_token($number,$offset,$masaAktif,$status){
		$this->db->select('*,token.id_donasi,masaAktif,nomorToken,token.id as tokenid,token.status as tokenStatus,token.tanggal_diaktifkan');

		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		if ($status==1) {
			$this->db->where('token.id_donasi is not null');
			$this->db->join('tb_donasi donasi', 'token.id_donasi = donasi.id', 'left outer');
			// $this->db->join('tb_pengguna', 'tb_pengguna.id = donasi.penggunaID');
			// $this->db->join('tb_siswa siswa','siswa.penggunaID=tb_pengguna.id');
		}else{
			// echo "string";
			$this->db->where('token.id_donasi is null');
			// $this->db->join('tb_donasi donasi', 'token.id_donasi = donasi.id');
			// $this->db->join('tb_pengguna', 'tb_pengguna.id = donasi.penggunaID');
			// $this->db->join('tb_siswa siswa','siswa.penggunaID=tb_pengguna.id');

		}

		$this->db->order_by('token.id');
		return $query = $this->db->get('tb_token token',$number,$offset)->result();       
	}

	  // data hasil cari paginataion all token
	function data_cari_pengguna_token($number,$offset,$masaAktif,$status,$keySearch){
		$this->db->select('*');
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		$this->db->like('tokenid',$keySearch);
		$this->db->or_like('namaDepan',$keySearch);
		$this->db->or_like('namaBelakang',$keySearch);
		$this->db->or_like('nama_lengkap',$keySearch);
		$this->db->or_like('nomorToken',$keySearch);
		$this->db->or_like('namaPengguna',$keySearch);
		return $query = $this->db->get('view_pengguna_token',$number,$offset)->result();      
	}
	
	function data_cari_token($number,$offset,$masaAktif,$status,$keySearch){
		$this->db->select('*');
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		$this->db->like('tokenid',$keySearch);
		$this->db->or_like('nomorToken',$keySearch);
		return $query = $this->db->get('view_token_belum_digunakan',$number,$offset)->result();      
	}
	public function sum_cari_pengguna_token($masaAktif,$status,$keySearch)
	{
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		$this->db->like('tokenid',$keySearch);
		$this->db->or_like('namaDepan',$keySearch);
		$this->db->or_like('namaBelakang',$keySearch);
		$this->db->or_like('nama_lengkap',$keySearch);
		$this->db->or_like('nomorToken',$keySearch);
		$this->db->or_like('namaPengguna',$keySearch);
		return $this->db->get('view_pengguna_token')->num_rows();
	}

	public function sum_cari_data_token($masaAktif,$status,$keySearch)
	{
		$this->db->select('*');
		if ($masaAktif!="all") {
			$this->db->where('masaAktif',$masaAktif);
		}
		$this->db->like('tokenid',$keySearch);
		$this->db->or_like('nomorToken',$keySearch);
		return $this->db->get('view_token_belum_digunakan')->num_rows();
	}
	//get mahasiswa yang belum memiliki voucher
	function get_siswa_unvoucher($number,$offset,$keySearchSiswa){
		$this->db->select('*');
		if ($keySearchSiswa!='' && $keySearchSiswa!=' ') {
			$this->db->like('namaDepan',$keySearchSiswa);
			$this->db->or_like('namaBelakang',$keySearchSiswa);
			$this->db->or_like('nama_lengkap',$keySearchSiswa);
			$this->db->or_like('namaPengguna',$keySearchSiswa);
		}
		return $query = $this->db->get('view_siswa_unvoucher',$number,$offset)->result_array(); 
	}
	function jumlah_siswa_unvoucher(){
		return $this->db->get('view_siswa_unvoucher')->num_rows();
	}
	function jumlah_cari_siswa_unvoucher($keySearchSiswa){
		$this->db->like('namaDepan',$keySearchSiswa);
		$this->db->or_like('namaBelakang',$keySearchSiswa);
		$this->db->or_like('nama_lengkap',$keySearchSiswa);
		$this->db->or_like('namaPengguna',$keySearchSiswa);
		return $this->db->get('view_siswa_unvoucher')->num_rows();
	}

	public function info_token()
	{
		$id_pengguna = $this->session->userdata('id');
		$this->db->select('token.*');
		$this->db->from('tb_token token');
		// $this->db->join('tb_siswa siswa', 'token.siswaID=siswa.id');
		$this->db->join('tb_donasi donasi','token.id_donasi=donasi.id');
		$this->db->where('donasi.penggunaID', $id_pengguna);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
   		return $query->result()[0];
		} else {
		   return null;
		}

	}

	public function info_saldo($id_pengguna)
	{
		$this->db->select("*");
		$this->db->from("view_saldo");
		$this->db->where("penggunaID", $id_pengguna);
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
		
	}





}
?>