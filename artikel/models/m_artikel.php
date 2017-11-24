<?php 

/**
* 
*/
class m_artikel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

    // get daftar artikel
	public function getDaftarslide(){
    	$this->db->distinct();
		$this->db->select('*');
        $this->db->from('tb_artikel');
		$tampil=$this->db->get();
		return $tampil->result_array();
    }

    // insert artikel
    public function in_upload_artikel($data){
        $this->db->insert('tb_artikel', $data);
    }

    // update artikel
    public function edit_upload_artikel($data,$id) {
        $this->db->where('id_artikel', $id);
        $this->db->update('tb_artikel', $data);
        
    }

      // DELETE artikel
    public function delete_artikel($id_artikel) {
        $this->db->where('id_artikel', $id_artikel);
        $this->db->delete('tb_artikel');
    }

    public function get_artikel($id)
    {
        $this->db->select('*');
        $this->db->from('tb_artikel');
        $this->db->where('id_artikel',$id); 
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    public function get_onephoto($id)
    {
      $this->db->select('gambar');
      $this->db->from('tb_artikel');
      $this->db->where('id_artikel',$id);
      $query = $this->db->get();
      return $query->result_array()[0]['gambar'];
    }
}

 ?>