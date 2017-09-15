<?php 



/**
 * 
 */
 class Mpassing extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	public function insert_passing($data)
		{
			return $this->db->insert('tb_passing_grade', $data);
		}
	// tampil passing grade
    public function getpassing() {
        $this->db->distinct();
		$this->db->select()->from('tb_passing_grade');
		$this->db->where('status', '1');
		$this->db->group_by('universitas');
		$tampil=$this->db->get();
		return $tampil->result_array();
    }
    // update passing
    public function update_passing() {
		$a  =  $this->input->post('id_passing');
		$b  =  $this->input->post('kode');
		$c  =  $this->input->post('wilayah');
		$d  =  $this->input->post('universitas');
		$e  =  $this->input->post('prodi');
		$f  =  $this->input->post('passinggrade');

		$arr = array(
				'id_passing' => $a,
				'kode' => $b,
				'wilayah'=> $c,
				'universitas' => $d,
				'prodi' => $e,
				'passinggrade' => $f
			);
		$this->db->where('id_passing', $a);
		return $this->db->update('tb_passing_grade', $arr);
	}

	// fungsi delete passing
	public function delete_passing($id_passing) {
		$this->db->where('id_passing', $id_passing);
        $this->db->set('status', '0');
        $this->db->update('tb_passing_grade');
	}

 	// tampil passing grade berdasarkan prodi
    public function getprodi($prodi) {
        $this->db->distinct();
		$this->db->select('*');
		$this->db->from('tb_passing_grade');
		$this->db->like('prodi', $prodi);
		$this->db->where('status', '1');
		$tampil=$this->db->get();
		return $tampil->result_array();
    }

    // tampil passing prodi
    public function tampil_prodi() {
        $this->db->distinct();
		$this->db->select('prodi');
		$this->db->from('tb_passing_grade');
		$this->db->where('status', '1');
		$tampil=$this->db->get();
		return $tampil->result_array();
    }

    // model hasil dari passing grade yang dipilih oleh siswa
    public function hasil_passing($awal,$akhir) {
		$query = "SELECT * FROM `tb_passing_grade` WHERE (passinggrade BETWEEN '$awal' AND '$akhir')";
    
        $result = $this->db->query($query);
        return $result->result_array();
    }

    // tampil prodi berdasarkan univ
    public function getpassinguniv($univ) {
        $this->db->distinct();
		$this->db->select()->from('tb_passing_grade');
		$this->db->where('status', '1');
		$this->db->where('universitas', $univ);
		// $this->db->group_by('universitas', $univ);
		$tampil=$this->db->get();
		return $tampil->result_array();
    }

// get topik untuk side bar by namatopik
    public function get_topik_byprodi($kunciCari)
    {
        $this->db->select('*');
        $this->db->from('tb_passing_grade');
        $this->db->like('prodi',$kunciCari);
        $query=$this->db->get();
        return $query->result_array();
    }

    //model untuk menampilkan foto untuk slide
    public function tampilphoto() {
        $this->db->distinct();
        $this->db->select('id,gambar');
        $this->db->from('tb_gambar_front');
        $this->db->where('id', '4');
        $tampil=$this->db->get();
        return $tampil->result_array();
    }

     // tampil passing grade
    public function getpassingwilayah($wil) {
        $this->db->distinct();
		$this->db->select()->from('tb_passing_grade');
		$this->db->where('status', '1');
		$this->db->where('wilayah', $wil);
		$this->db->group_by('universitas');
		$tampil=$this->db->get();
		return $tampil->result_array();
    }

 } ?>