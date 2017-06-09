<?php 
/**
 * 
 */
 class Donaturback_model extends CI_Model
 {
 	
 	public function get_donatur($value='')
 	{
 		$this->db->select('*');
 		$this->db->from('tb_test');
 		$query=$this->db->get();
 		return $query->result();
 	}
 	public function in_donatur_co($data)
 	{
 		$this->db->insert('tb_donatur_co',$data);
 	}
 	public function get_donatur_co($records_per_page,$pageSelek,$keySearch)
 	{
 		$this->db->select('*');
 		$this->db->where('status',1);
 		$this->db->order_by('id','desc');
 		if ($keySearch!='' && $keySearch!=' ') {
 			$this->db->like('nama',$keySearch);
 		$this->db->or_like('namaPerusahaan',$keySearch);
 		}
 		$query=$this->db->get('tb_donatur_co',$records_per_page,$pageSelek);
 		return $query->result();
 	}
 	public function sum_donatur_co($keySearch)
 	{
 		$this->db->select('*');
 		$this->db->from('tb_donatur_co');
 		$this->db->where('status',1);
 		$this->db->order_by('id','desc');
 		if ($keySearch!='' && $keySearch!=' ') {
 			$this->db->like('nama',$keySearch);
 		$this->db->or_like('namaPerusahaan',$keySearch);
 		}
 		$query=$this->db->get();
 		return $query->num_rows();
 	}
 	public function ch_status_donatur_co($id)
 	{	
 		$this->db->where('id',$id);
 		$this->db->set('status',0);
 		$this->db->update('tb_donatur_co');
 	}
 	public function ch_donatur_co($data,$id)
 	{
 		$this->db->where('id',$id);
 		$this->db->update('tb_donatur_co',$data);
 	}
 } ?>