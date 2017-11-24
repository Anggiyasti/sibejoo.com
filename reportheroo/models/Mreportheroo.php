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

    // get gambar artikel
    public function get_reportH($id)
	{
		$this->db->select('*');
		$this->db->from('tb_report_heroo rh');
        $this->db->join('tb_kategori kat', '`kat`.`id_kategori` = `rh`.`kategori`');
		$this->db->where('id_art',$id); 
		$query = $this->db->get();
		return $query->result_array()[0];
	}

    // get gambar artikel
    public function get_gambarreport_heroo($id)

    {

        // $id_siswa=$this->session->userdata['email'] ;    

        $this->db->select('*');

        $this->db->from('tb_report_heroo art');
        $this->db->join('tb_kategori kat','kat.id_kategori = art.kategori');

        $this->db->where('id_art',$id); 

        $query = $this->db->get();

        return $query->result_array();

    }

    // update artikel dan gambar
	public function gambar_artikel($id, $photo) {

		$a  =  $this->input->post('judul_artikel');
		$b  =  $this->input->post('editor1');

        $data = array(
            'gambar' => $photo,
            'judul_artikel' => $a,
            'isi_artikel' => $b

        );
        $this->db->where('id_artikel', $id);
        $this->db->update('tb_artikel', $data);
        // var_dump($data);
        redirect(site_url('artikel/index/1'));
    }

    // update artikel tanpa gambar
    public function gambar_artikel1($id) {

        $a  =  $this->input->post('judul_artikel');
        $b  =  $this->input->post('editor1');

        $data = array(  
            'judul_artikel' => $a,
            'isi_artikel' => $b

        );
        $this->db->where('id_artikel', $id);
        $this->db->update('tb_artikel', $data);
        redirect(site_url('artikel/index/1'));
    }


    // update artikel dan gambar
    public function gambar_report_heroo($id, $photo) {

        $a  =  $this->input->post('judul_artikel');
        $b  =  $this->input->post('editor1');
        $c  =  $this->input->post('kategori');

        $data = array(
            'gambar' => $photo,
            'judul_art_katagori' => $a,
            'isi_art_kategori' => $b,
            'kategori' => $c

        );
        $this->db->where('id_art', $id);
        $this->db->update('tb_report_heroo', $data);
        // var_dump($data);
        redirect(site_url('artikel/index/2'));
    }

    // update artikel tanpa gambar
    public function gambar_report1_heroo($id) {

        $a  =  $this->input->post('judul_artikel');
        $b  =  $this->input->post('editor1');
        $c  =  $this->input->post('kategori');

        $data = array(  
            'judul_art_katagori' => $a,
            'isi_art_kategori' => $b,
            'kategori' => $c

        );
        $this->db->where('id_art', $id);
        $this->db->update('tb_report_heroo', $data);
        redirect(site_url('artikel/index/2'));
    }

    // insert artikel
    function insert_artikel($judul_artikel,$isi_artikel,$filename){
        $data = array(
                        'judul_artikel'  =>     $judul_artikel,
                        'isi_artikel' => $isi_artikel,
                        'gambar' =>      $filename
                        );
        $this->db->insert('tb_artikel',$data);
        return $data;

    }

    // insert artikel
    function insert_report_heroo($judul_artikel,$isi_artikel,$kategori,$filename){
        $data = array(
                        'judul_art_katagori'  =>     $judul_artikel,
                        'isi_art_kategori' => $isi_artikel,
                        'kategori' => $kategori,
                        'gambar' =>      $filename
                        );
        $this->db->insert('tb_report_heroo',$data);
        return $data;

    }



    public function in_upload_reportH($data){
        // $this->db->insert('tb_team', $data['data_upload_team']);
        $this->db->insert('tb_report_heroo', $data);
    }

    public function edit_upload_reportH($data,$id) {
        $this->db->where('id_art', $id);
        $this->db->update('tb_report_heroo', $data);
        
    }

      // DELETE REPORT HEROO
    public function delete_report_heroo($id_report) {
        $this->db->where('id_art', $id_report);
        $this->db->delete('tb_report_heroo');
    }

    // data pagination news
    function data_news($number,$offset){
        $this->db->select('*');
        return $query = $this->db->get('tb_artikel',$number,$offset)->result_array();       
    }

    // GET DATA BANK SOAL YANG PUBLISHNYA 1
    function jumlah_data(){
        return $this->db->get('tb_artikel')->num_rows();
    }

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