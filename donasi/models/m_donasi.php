<?php 

/**
* 
*/
class M_donasi extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


    // insert siswa ke db
    public function insert_donasi($data)
    {
        return $this->db->insert('tb_donasi', $data);
    }

    // ambil status donasi yang sudah dilakukan    
    public function get_id_donasi(){
        $id_pengguna = $this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('tb_donasi');
        $this->db->where('penggunaID',$id_pengguna);
         $this->db->where('status !=',4);
        $this->db->order_by("id","DESC");
        $query = $this->db->get();
        // var_dump($query);
        if ($query->result_array()==array()) {
          return false;
      } else {
          return $query->result_array()[0];
      }

  }

    // get daftar artikel
  public function getDaftarslide(){
   $this->db->distinct();
   $this->db->select()->from('tb_artikel');
   $tampil=$this->db->get();
   return $tampil->result_array();
}

    // get daftar artikel
public function getDaftarreport_heroo(){
    $this->db->distinct();
    $this->db->select('*');
    $this->db->from('tb_report_heroo art');
    $this->db->join('tb_kategori kat', '`kat`.`id_kategori` = `art`.`kategori`');
    $tampil=$this->db->get();
    return $tampil->result_array();
}

    // get gambar artikel
public function get_gambarartikel($id)

{

		// $id_siswa=$this->session->userdata['email'] ;	

  $this->db->select('*');

  $this->db->from('tb_artikel');

  $this->db->where('id_artikel',$id); 

  $query = $this->db->get();

  return $query->result_array();

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
function insert_konfirmasi_donasi($data){
    // insert konfirmasi donasi
    $this->db->insert('tb_konfirmasi_donasi',$data);
    
    // update status @donasi
    $this->db->where('id',$data['id_donasi']);
    $this->db->set('status', 2);
    $this->db->update('tb_donasi');
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


     // DELETE MATA PELAJARAN
public function set_status($id) {
    $this->db->where('id',$id);
    $this->db->set('status', 2);
    $this->db->update('tb_donasi');
}

      // DELETE MATA PELAJARAN
public function delete_artikel($id_artikel) {
    $this->db->where('id_artikel', $id_artikel);
    $this->db->delete('tb_artikel');
}

      // DELETE MATA PELAJARAN
public function delete_report_heroo($id_artikel) {
    $this->db->where('id_art', $id_artikel);
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

public function scartikel()
{
    $this->db->select('id_kategori,nama_kategori');
    $this->db->from('tb_kategori');
                // $this->db->where('status',1);
    $query = $this->db->get();
    return $query->result_array();
}

public function scdonasi()
{
  $this->db->select('*');
  $this->db->from('tb_jenis_donasi');
  // $this->db->where('status',1);
  $query = $this->db->get();
  return $query->result_array();
}

public function del_donasi($id_donasi)
{
   $this->db->where('id',$id_donasi);
   $this->db->delete("tb_donasi");
}

// cek konfirmasi donasi
public function cek_kon_donasi($id_donasi)
{
  $this->db->select('id_konfirm');
  $this->db->from('tb_konfirmasi_donasi');
  $this->db->where('id_donasi',$id_donasi);
  $query=$this->db->get();
  return $query->num_rows();

}

}

?>