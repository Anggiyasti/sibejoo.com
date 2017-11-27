<?php 

/**
* 
*/
class Mreportheroo extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

    // get daftar report heroo
    public function get_report_heroo(){
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('tb_report_heroo');
        $tampil=$this->db->get();
        return $tampil->result_array();
    }

    // get report heroo by id
    public function get_report_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('tb_report_heroo rh');
        $this->db->join('tb_kategori kat', '`kat`.`id_kategori` = `rh`.`kategori`');
		$this->db->where('id_art',$id); 
		$query = $this->db->get();
		return $query->result_array()[0];
	}

    // insert report heroo
    public function in_upload_report($data){
        $this->db->insert('tb_report_heroo', $data);
    }

    // update report heroo
    public function edit_upload_report($data,$id) {
        $this->db->where('id_art', $id);
        $this->db->update('tb_report_heroo', $data);
        
    }

    // DELETE REPORT HEROO
    public function delete_report_heroo($id_report) {
        $this->db->where('id_art', $id_report);
        $this->db->delete('tb_report_heroo');
    }

    // get kategori
    public function get_kategori()
    {
        $this->db->select('id_kategori,nama_kategori');
        $this->db->from('tb_kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_onephoto($id)
    {
      $this->db->select('gambar');
      $this->db->from('tb_report_heroo');
      $this->db->where('id_art',$id);
      $query = $this->db->get();
      return $query->result_array()[0]['gambar'];
    }

}

 ?>