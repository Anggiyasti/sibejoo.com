<?php 
class Donasiback_model extends CI_model{

	function get_donasi(){
		$this->db->select( '*,donasi.status as status_donasi,donasi.id as donasi_id' )->from( '(SELECT * FROM tb_donasi d) as donasi' );
		$this->db->join('tb_pengguna p', 'p.id=donasi.`penggunaID`');

		$query = $this->db->get(); 
		return $query->result(); 
	}
	
	function get_konfirmasi_by_id_donasi($id_donasi){
		$this->db->select('*')->from('tb_konfirmasi_donasi k')->join('tb_pengguna p','p.id=k.penggunaID')->where('id_donasi',$id_donasi);

		$query = $this->db->get(); 
		return $query->result(); 
	}


	function konfirmasi_donasi($id_donasi){
		$this->db->where('id',$id_donasi);
		$this->db->set('status', 3);
		$this->db->update('tb_donasi');
	}

	function get_id_siswa($id_donasi){
		$this->db->select( 's.id AS id_siswa, d.`donasi`')->from('tb_siswa s');
		$this->db->join('tb_pengguna p ','s.penggunaID = p.id');
		$this->db->join('tb_donasi d ','d.penggunaID = p.id');

		$this->db->where('p.id = (SELECT penggunaID FROM tb_donasi WHERE id ='.$id_donasi.')');
		$query = $this->db->get(); 
		return $query->result(); 
	}

	function select_token($jenis_donasi){
		$this->db->select('id as token_id')->from('tb_token');
		if ($jenis_donasi==1) {
			# HEROO
			$this->db->where('masaAktif=365');
		}else{
			# ANGLE
			$this->db->where('masaAktif=1095');
		}
		$this->db->where('siswaID is null');
		$query = $this->db->get(); 
		return $query->result(); 
	}

	function update_status_token($data){
		// ====================UPDATE DONASI=============//
		$this->db->where('id',$data['id_donasi']);
		$this->db->set('status', 4);
		$this->db->update('tb_donasi');
		// ====================UPDATE TOKEN=============//

		$date = date("Y-m-d H:i:s"); 
		$this->db->where('id',$data['id_token']);
		$this->db->set('siswaID', $data['id_siswa']);
		$this->db->set('status', 0);
		$this->db->update('tb_token');
	}
	function get_info_for_send_token($id_donasi){
		$this->db->select( 's.id siswa_id, 
			s.namaDepan,
			s.namaBelakang,
			o.id ortu_id, 
			t.`nomorToken` AS nomor_token, 
			t.`masaAktif` masa_aktif')->from('(SELECT * FROM tb_donasi WHERE id ='.$id_donasi.') donasi');
		$this->db->join('tb_pengguna p','p.id = donasi.penggunaID');
		$this->db->join('tb_siswa s','s.penggunaID = p.id');
		$this->db->join('tb_orang_tua o','o.siswaID = s.id');
		$this->db->join('tb_token t','t.siswaID = s.id');

		$query = $this->db->get(); 
		return $query->result(); 


	}

}
?>