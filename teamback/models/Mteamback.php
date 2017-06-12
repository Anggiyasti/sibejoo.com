<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mteamback extends CI_Model{
	// get all team
	public function data_all_team()
	{
		$this->db->select('*');
		$this->db->from( 'tb_team');
		$query = $this->db->get(); 
		return $query->result_array();
	}

	// =========## create team ##==============
	public function insert_team( $data ) {
		$this->db->insert( 'tb_team', $data );
	}

	// get team by id
	function get_team_byid($id) {
        $this->db->select('*');
        $this->db->from('tb_team');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // update team
    public function update_team($data,$id) {
        $this->db->where('id', $id);
        $this->db->update('tb_team', $data); 
    }

    //drop team
	function drop_team($data){
		$this->db->where('id', $data['id']);
		$this->db->delete('tb_team');
	}

	public function in_upload_team($data){
		// $this->db->insert('tb_team', $data['data_upload_team']);
		$this->db->insert('tb_team', $data);
	}

	// update foto team
    public function edit_upload_team($data,$id) {
        $this->db->where('id', $id);
        $this->db->update('tb_team', $data);
        
    }
}
?>