<?php
class Mmodulonline extends CI_Model {
    # Start Function untuk form soal#	

 public function insert_modul($dataSoal) {
  $this->db->insert('tb_modul', $dataSoal);
 }


 public function get_info_modul($tingkatID)
 {
  $this->db->select('tkt.id as id_tingkat ,aliasTingkat,tp.id as id_mp,tp.keterangan as mp');
  $this->db->from('tb_tingkat tkt' );
  $this->db->join('tb_tingkat-pelajaran tp','tp.tingkatID=tkt.id');
  $this->db->where('tp.id',$tingkatID);
  $query = $this->db->get();
  return $query->result_array()[0];
 }


    // get soal per matapelajaran
 public function get_soal_mp($idMp) {
  $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish');
  $this->db->from('tb_modul as mdl');
  $this->db->where('mdl.status','1');
  $this->db->where('mdl.id_tingkatpelajaran', $idMp);

  $query = $this->db->get();
  return $query->result_array();

 }
      // get soal per tingkat
 public function get_soal_tkt($tingkatID) {
  $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish');
  $this->db->from('tb_modul as mdl');
  $this->db->join('tb_tingkat-pelajaran tp','tp.id = mdl.id_tingkatpelajaran');
  $this->db->where('mdl.status','1');
  $this->db->where('tp.tingkatID', $tingkatID);

  $query = $this->db->get();
  return $query->result_array();

 }
 public function ch_soal($data) {
  $this->db->set($data['dataSoal']);
  $this->db->where('uuid', $data['uuid']);
  $this->db->update('tb_modul');
 }

 public function get_onesoal($uuid) {
  $this->db->where('uuid', $uuid);
  $this->db->select('*')->from('tb_modul');
  $query = $this->db->get();
  return $query->result_array();
 }


    //get old gambar soal

 public function get_oldgambar_soal($UUID)
 {
  $this->db->where('uuid', $UUID);
  $this->db->select('id,url_file')->from('tb_modul');
  $query = $this->db->get();
  return $query->result_array();
 }


 public function del_banksoal($data) {
  $this->db->where('id', $data);
  $this->db->set('status', '0');
  $this->db->update('tb_modul');
 }

    # END Function untuk form delete bank soal#

    //
 public function get_all_moduls()
 {
  $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran, mdl.statusAksesFile');
  $this->db->from('tb_modul as mdl');
  $this->db->where('mdl.status','1');
  if ($this->session->userdata('member')==0) {
   $this->db->where('mdl.statusAksesFile',0);
  }
  $query = $this->db->get();
  return $query->result_array();
 }

 function getRows($params = array()){
  $this->db->select('*');
  $this->db->from('tb_modul mdl');
  $this->db->where('mdl.status',1);

  if ($this->session->userdata('member')==0) {
   $this->db->where('mdl.statusAksesFile',0);
  }

        //filter data by searched keywords
  if(!empty($params['search']['keywords'])){
   $this->db->like('judul',$params['search']['keywords']);
  }

        //sort data by ascending or desceding order
  if(!empty($params['search']['sortBy'])){
   switch ($params['search']['sortBy']) {
    case 'date_created':
    $this->db->order_by($params['search']['sortBy'],'desc');
    break;
    case 'asc':
    $this->db->order_by('judul','asc');
    break;
    case 'desc':
    $this->db->order_by('judul','desc');
    break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records
              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }
             
             public function tambahdownload($id,$temp){
              $this->db->set('download',$temp);
              $this->db->where('id', $id);
              $this->db->update('tb_modul');
             }

             public function ambilnilai($id)
             {
              $this->db->select('download');
              $this->db->from('tb_modul');
              $this->db->where('id',$id);
              $query = $this->db->get();
              return $query->result_array()[0];
             }

             public function get_modulteratas(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,mdl.download');
              $this->db->from('tb_modul as mdl');
              $this->db->where('mdl.status','1');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $this->db->order_by('download desc'); 
              $this->db->limit(2);
              $query = $this->db->get();
              return $query->result_array();
             }

             public function modulsd(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','1');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $query = $this->db->get();
              return $query->result_array();
             }

             public function modulsmp(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','2');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $query = $this->db->get();
              return $query->result_array();
             }

             public function modulsma(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','3');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $query = $this->db->get();
              return $query->result_array();
             }

             public function modulsmaipa(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','4');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $query = $this->db->get();
              return $query->result_array();
             }


             public function modulsmaips(){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','5');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              $query = $this->db->get();
              return $query->result_array();
             }


             function getRowssd($params = array()){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','1');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              
        //filter data by searched keywords
              if(!empty($params['search']['keywords'])){
               $this->db->like('judul',$params['search']['keywords']);
               $this->db->where('mdl.status','1');
               $this->db->where('tp.tingkatID','1');
              }

        //sort data by ascending or desceding order
              if(!empty($params['search']['sortBy'])){
               switch ($params['search']['sortBy']) {
                case 'date_created':
                $this->db->order_by($params['search']['sortBy'],'desc');
                break;
                case 'asc':
                $this->db->order_by('mdl.judul','asc');
                break;
                case 'desc':
                $this->db->order_by('mdl.judul','desc');
                break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('mdl.id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records

              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }

             function getRowssmp($params = array()){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','2');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile','0');
              }
              
        //filter data by searched keywords
              if(!empty($params['search']['keywords'])){
               $this->db->like('judul',$params['search']['keywords']);
               $this->db->where('mdl.status','1');
               $this->db->where('tp.tingkatID','2');

              }

        //sort data by ascending or desceding order
              if(!empty($params['search']['sortBy'])){
               switch ($params['search']['sortBy']) {
                case 'date_created':
                $this->db->order_by($params['search']['sortBy'],'desc');
                break;
                case 'asc':
                $this->db->order_by('mdl.judul','asc');
                break;
                case 'desc':
                $this->db->order_by('mdl.judul','desc');
                break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('mdl.id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records

              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }

             function getRowssma($params = array()){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','3');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              
        //filter data by searched keywords
              if(!empty($params['search']['keywords'])){
               $this->db->like('judul',$params['search']['keywords']);
               $this->db->where('mdl.status','1');
               $this->db->where('tp.tingkatID','3');
              }

        //sort data by ascending or desceding order
              if(!empty($params['search']['sortBy'])){
               switch ($params['search']['sortBy']) {
                case 'date_created':
                $this->db->order_by($params['search']['sortBy'],'desc');
                break;
                case 'asc':
                $this->db->order_by('mdl.judul','asc');
                break;
                case 'desc':
                $this->db->order_by('mdl.judul','desc');
                break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('mdl.id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records

              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }

             function getRowssmaipa($params = array()){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','4');

              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
              
        //filter data by searched keywords
              if(!empty($params['search']['keywords'])){
               $this->db->like('judul',$params['search']['keywords']);
               $this->db->where('mdl.status','1');
               $this->db->where('tp.tingkatID','4');
              }

        //sort data by ascending or desceding order
              if(!empty($params['search']['sortBy'])){
               switch ($params['search']['sortBy']) {
                case 'date_created':
                $this->db->order_by($params['search']['sortBy'],'desc');
                break;
                case 'asc':
                $this->db->order_by('mdl.judul','asc');
                break;
                case 'desc':
                $this->db->order_by('mdl.judul','desc');
                break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('mdl.id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records

              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }

             function getRowssmaips($params = array()){
              $this->db->select('mdl.id, mdl.judul, mdl.deskripsi, mdl.url_file, mdl.publish,mdl.uuid,mdl.id_tingkatpelajaran,tp.id');
              $this->db->from('tb_modul as mdl');
              $this->db->join('tb_tingkat-pelajaran as tp','tp.id = mdl.id_tingkatpelajaran');
              $this->db->where('mdl.status','1');
              $this->db->where('tp.tingkatID','5');
              if ($this->session->userdata('member')==0) {
               $this->db->where('mdl.statusAksesFile',0);
              }
        //filter data by searched keywords
              if(!empty($params['search']['keywords'])){
               $this->db->like('judul',$params['search']['keywords']);
               $this->db->where('mdl.status','1');
               $this->db->where('tp.tingkatID','5');
              }

        //sort data by ascending or desceding order
              if(!empty($params['search']['sortBy'])){
               switch ($params['search']['sortBy']) {
                case 'date_created':
                $this->db->order_by($params['search']['sortBy'],'desc');
                break;
                case 'asc':
                $this->db->order_by('mdl.judul','asc');
                break;
                case 'desc':
                $this->db->order_by('mdl.judul','desc');
                break;
                echo $output; // The output should be: 0.7
               }
              }else{
               $this->db->order_by('mdl.id','desc');
              }

        //set start and limit
              if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit'],$params['start']);
              }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
               $this->db->limit($params['limit']);
              }
        //get records

              $query = $this->db->get();
        //return fetched data
              return ($query->num_rows() > 0)?$query->result_array():FALSE;
             }


            }

            ?>