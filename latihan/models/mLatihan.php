<?php
class Mlatihan extends CI_Model
{
	//random buat subbab
	public function get_random_for_latihan( $param ) {

		$this->db->where( 'b.id_subbab', $param['id_subab'] );
		$this->db->where('b.status','1');
		$this->db->where('b.publish','1');
		$this->db->where( 'b.kesulitan', $param['kesulitan'] );
		$this->db->order_by( 'rand()' );
		$this->db->limit( $param['jumlah_soal'] );
		$this->db->select( '*' );
		$this->db->from( 'tb_banksoal b' );
		$this->db->join('tb_piljawaban p', 'b.id_soal=p.id_soal');
		$this->db->group_by('b.id_soal');
		$query = $this->db->get();
		return $query->result_array();
	}

	//random buat bab
	public function get_random_for_latihan_bab( $param ) {
		$this->db->where( 'bab.id', $param['id_bab'] );
		$this->db->where('b.status','1');
		$this->db->where('b.publish','1');
		$this->db->where( 'b.kesulitan', $param['kesulitan'] );
		$this->db->order_by( 'rand()' );
		$this->db->limit( $param['jumlah_soal'] );
		$this->db->select( '*' );
		$this->db->from( 'tb_banksoal b' );
		$this->db->join('tb_subbab sub',
			'b.id_subbab = sub.id');
		$this->db->join('tb_bab bab',
			'bab.id = sub.babID');
		$this->db->join('tb_piljawaban p', 'b.id_soal=p.id_soal');
		$this->db->group_by('b.id_soal');


		$query = $this->db->get();
		return $query->result_array();
	}






	public function get_piljawaban( $data ) {
		$this->db->order_by( 'rand()' );
		$n='1';
		foreach ( $data as $row ) {
			$id_soal=$row['id_soal'];
			if ( $n=='1' ) {
				$this->db->where( 'id_soal', $id_soal );
			} else {
				$this->db->or_where( 'id_soal', $id_soal );
			}
			$n++;
		}
		$this->db->select( '*' );
		$this->db->from( 'tb_piljawaban' );
		$query = $this->db->get();
		return $query->result_array();

	}



	public function ajax_add_paket_soal() {
		$data = array(
			'nm_paket' => $this->input->post( 'nama_paket' ) ,
			'jumlah_soal' => $this->input->post( 'jumlah_soal' ),
			'deskripsi' =>$this->input->post( 'deskripsi' ),
			'durasi' =>$this->input->post( 'durasi' )
		);
		$this->MPaketsoal->insertpaketsoal( $data );
	}



	public function insert( $data ) {
		$this->db->insert( 'tb_latihan', $data );
	}

	public function get_latihan_by_uuid($uuid){
		$this->db->where( 'uuid_latihan', $uuid );		
		$this->db->select('id_latihan');
		$this->db->from( 'tb_latihan' );
		$query = $this->db->get();
		return $query->result_array();
	}



	public function insert_tb_mm_sol_lat( $data ) {
		$this->db->insert( 'tb_mm_sol_lat', $data );

	}

	 //get daftar latihan by created by

	public function get_report($createdby){
		$this->db->select('*');
		$this->db->from('tb_latihan latihan');
		$this->db->join('tb_report-latihan report',
			'latihan.id_latihan=report.id_latihan');
		$this->db->where('create_by', $createdby);
		$this->db->order_by('tgl_pengerjaan', 'desc');
		$query = $this->db->get();
		return $query->result_array();

	}



	public function get_latihan($createdby){
		$this->db->select('*');
		$this->db->from('tb_latihan latihan');
		$this->db->where('create_by', $createdby);
		$this->db->where('status_pengerjaan', '1');

		$query = $this->db->get();
		return $query->result_array();

	}



    //get hasil latihan
	public function get_report_latihan($idlatihan){
		$this->db->select("*");
		$this->db->from('tb_report-latihan');
		$this->db->where('id_latihan',$idlatihan);
		$query = $this->db->get();
		return $query->result_array();

	}
	//get nama latihan by bab
	public function get_nama_bab($babid){
		$this->db->select('judulBab');
		$this->db->from('tb_bab');
		$this->db->where('id',$babid);
		$query = $this->db->get();
		return $query->result_array();
	}
	//random buat bab
	public function get_soal_bybabid($param){
		$this->db->where( 'bab.id', $param );
		$this->db->from( 'tb_banksoal b' );
		$this->db->join('tb_subbab sub',
			'b.id_subbab = sub.id');
		$this->db->join('tb_bab bab',
			'bab.id = sub.babID');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_soal_bybab( $param ) {
		
		$query = "SELECT bank.id_soal,bank.judul_soal,bank.soal,
		bank.jawaban,bank.kesulitan,bank.id_subbab,
		bank.`id_tingkat-pelajaran`,bank.sumber,
		bank.create_by,bank.random,bank.publish,bank.UUID,bank.status,
		bank.gambar_soal,bank.audio,bank.pembahasan,
		bank.gambar_pembahasan,bank.video_pembahasan,
		bank.status_pembahasan,bank.link
		FROM (SELECT * FROM tb_bab b WHERE b.`id` = ".$param['bab_id'].") bab
		JOIN `tb_subbab` s ON s.`babID` = bab.id
		JOIN `tb_banksoal` bank ON bank.`id_subbab` = s.`id`
		WHERE bank.`id_soal` NOT IN (
			SELECT id_soal FROM `tb_mm_sol_lat` WHERE `id_latihan` = (SELECT`latihanID` FROM tb_line_step WHERE `id` = ".$param['step_id']."))";
			$result = $this->db->query($query);
			return $result->result_array(); 
		}

		function get_soal_by_id_latihan($id_latihan){
			$this->db->select('*');
			$this->db->from('tb_mm_sol_lat as sollat');
			$this->db->join('tb_banksoal as soal', 'sollat.id_soal = soal.id_soal');
			$this->db->where('sollat.id_latihan', $id_latihan);
			$query = $this->db->get();
			return $query->result_array();
		}

		function repot_latihan_filter($id){
			$username = $this->db->escape_str($this->session->userdata('USERNAME'));
			if($id==""){
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
				$query = "SELECT hasil.id_latihan,hasil.nm_latihan,skore FROM 
				(SELECT * FROM `tb_latihan` l
				WHERE l.`create_by` = '".$username."') hasil
				JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
				JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
				JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
				JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
				JOIN `tb_bab` bab ON bab.`id` = s.`babID`
				GROUP BY hasil.`id_latihan`
				";
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
			}else{

		## TANPA FILTER BAB, TAMPILIN SEMUA ##
				$query = "SELECT hasil.id_latihan,hasil.nm_latihan,skore FROM 
				(SELECT * FROM `tb_latihan` l
				WHERE l.`create_by` = '".$username."') hasil
				JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
				JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
				JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
				JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
				JOIN `tb_bab` bab ON bab.`id` = s.`babID`
				WHERE bab.`id` = '".$id."'
				GROUP BY hasil.`id_latihan`
				";
		## TANPA FILTER BAB, TAMPILIN SEMUA ##
			}

			$result = $this->db->query($query);
			return $result->result_array();   
		}

	// get bab yang pernah dia latihan.
		function get_bab_latihan(){
			$username = $this->db->escape_str($this->session->userdata('USERNAME'));
		## TANPA ORDER ##
			$query = "SELECT bab.`id`,bab.`judulBab` FROM 
			(SELECT * FROM `tb_latihan` l
			WHERE l.`create_by`= '".$username."') hasil
			JOIN `tb_report-latihan` rp ON rp.`id_latihan` = hasil.id_latihan
			JOIN `tb_mm_sol_lat` mm ON mm.`id_latihan` = hasil.id_latihan
			JOIN `tb_banksoal` b ON b.`id_soal` = mm.`id_soal`
			JOIN `tb_subbab` s ON s.`id` = b.`id_subbab`
			JOIN `tb_bab` bab ON bab.`id` = s.`babID`
			GROUP BY bab.id";
		## ORDER BAB ##	


			$result = $this->db->query($query);
			return $result->result_array();   

		}


		function get_id_latihan_by_step($step_id){
			$this->db->select('latihanID');
			$this->db->from('tb_line_step');
			$this->db->where('id', $step_id);


			$result = $this->db->get();
			if ($result->result_array()==array()) {
				return false;
			} else {
				return $result->result_array();
			}
		}

		function insert_batch_soal_to_latihan($data){
        	$this->db->insert_batch('tb_mm_sol_lat', $data);
		}
        
        function batch_remove_soal_from_latihan($id_mm_solat){
        	$this->db->where_in('id', $id_mm_solat);
			$this->db->delete('tb_mm_sol_lat');
        }

	}
	?>