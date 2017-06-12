<?php 
class Donasiback_model extends CI_model{

	function get_donasi(){
		$this->db->select( '*' )->from( '(SELECT * FROM tb_donasi d) as donasi' );
			$this->db->join('tb_pengguna p', 'p.id=donasi.`penggunaID`');

		$query = $this->db->get(); 
		return $query->result(); 
	}
	

}
?>