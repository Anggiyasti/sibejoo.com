<?php 
/**
 * 
 */
class Mmateri extends CI_Model
{

  public function in_materi($data)
  {
     $this->db->insert('tb_line_materi',$data);
 }

    // get data materi unutuk halaman list materi
 public function get_all_materi()
 {
    $this->db->select('m.id as materiID,judulMateri,isiMateri,publish,m.date_created as tgl,judulSubBab,judulBab, tp.keterangan as mapel,aliasTingkat,UUID,url_file');
    $this->db->from('tb_line_materi m');
    $this->db->join('tb_subbab sub','m.subBabID=sub.id');
    $this->db->join('tb_bab bab','sub.babID=bab.id');
    $this->db->join('tb_tingkat-pelajaran tp','bab.tingkatPelajaranID=tp.id');
    $this->db->join('tb_tingkat tkt','tp.tingkatID=tkt.id');
    $this->db->where('m.status','1');
    $this->db->order_by('m.id','desc');
    $query = $this->db->get();
    return $query->result_array();
}

        // get data materi unutuk halaman list materi
public function get_materi_by_user()
{
    $this->db->select('m.id as materiID,judulMateri,isiMateri,publish,m.date_created as tgl,judulSubBab,judulBab, tp.keterangan as mapel,aliasTingkat,UUID,url_file');
    $this->db->from('tb_line_materi m');
    $this->db->join('tb_subbab sub','m.subBabID=sub.id');
    $this->db->join('tb_bab bab','sub.babID=bab.id');
    $this->db->join('tb_tingkat-pelajaran tp','bab.tingkatPelajaranID=tp.id');
    $this->db->join('tb_tingkat tkt','tp.tingkatID=tkt.id');
    $this->db->where('m.status','1');
    $this->db->where('m.penggunaID',$this->session->userdata('id'));
    $this->db->order_by('m.id','desc');
        $query = $this->db->get();
        return $query->result_array();
    }


 	// get materi berdasarkan UUID
    public function get_single_materi($UUID)
    {
        $this->db->select('id,UUID,judulMateri,isiMateri,publish,subBabID,url_file');
        $this->db->from('tb_line_materi');
        $this->db->where('UUID',$UUID);
        $query= $this->db->get();
        return $query->result_array()[0];
    }

    // get materi berdasarkan UUID
    public function get_single_materi_byid($id)
    {
        $this->db->select('id,judulMateri,isiMateri,publish,subBabID');
        $this->db->from('tb_line_materi');
        $this->db->where('id',$id);
        $query= $this->db->get();
        return $query->result();
    }


    public function ch_materi($data,$UUID)
    {
     $this->db->where('UUID',$UUID);
     $this->db->update('tb_line_materi',$data);
    }

 public function drop_materi($UUID)
 {
  $this->db->where('UUID', $UUID['UUID']);
  $this->db->set('status', '0');
  $this->db->update('tb_line_materi');
}

 	// get info tingkat materi
public function get_tingkat_info($subBabID)
{
    $this->db->select('tkt.id as id_tingkat ,aliasTingkat,tp.id as id_mp,tp.keterangan as mp,bab.id as id_bab, judulBab, subbab.id as id_subbab ,judulSubBab,');
    $this->db->from('tb_tingkat tkt' );
    $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
    $this->db->join('tb_bab bab','bab.tingkatPelajaranID=tp.id');
    $this->db->join('tb_subbab subbab','subbab.babID = bab.id');
    $this->db->where('subbab.id',$subBabID);
    $query = $this->db->get();
    return $query->result_array()[0];
}

public function up_file($data) {
  $this->db->set($data['datamateri']);
  $this->db->where('uuid', $data['uuid']);
  $this->db->update('tb_line_materi');
}

public function get_onefile_materi($UUID)
    {
      $this->db->select('url_file');
      $this->db->from('tb_line_materi');
      $this->db->where('UUID',$UUID);
      $query = $this->db->get();
      return $query->result_array();
    }

} ?>