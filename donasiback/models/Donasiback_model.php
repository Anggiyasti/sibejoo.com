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
}
?>