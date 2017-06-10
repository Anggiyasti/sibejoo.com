<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teamback extends MX_Controller {

	//put your code here
  private $upload_path = "./assets/image/team";

	function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper('session');
		$this->load->library('pagination');
		$this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
		$this->hakakses = $this->gethakakses();
		$this->load->model('Mteamback');

	}

	//GET HAK AKSES
	function gethakakses(){
		return $this->session->userdata('HAKAKSES');
	}
	//GET HAK AKSES

	// LOAD PARSER SESUAI HAK AKSES
	public function loadparser($data){
		$this->hakakses = $this->gethakakses();
		if ($this->hakakses=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		}else{
			echo "forbidden access";    		
		}
	}

	public function index()
	{
		$data = array(
			'judul_halaman' => 'Dashboard '.$this->hakakses." - Daftar Team",
		);

		$data['files'] = array(
			APPPATH . 'modules/teamback/views/v-daftar-team.php',
			);
		$this->loadparser($data);
	}

	public function ajaxListTeam() {
    	$data=array();
      	// code u/pagination
     	$list = $this->Mteamback->data_all_team();

      	$no=1;
      	//cacah data 
      	foreach ( $list as $item ) {
			$row = array();
			$row[] = $no;
			$row[] = $item ['id'];
			$row[] = $item ['nama'];
			$row[] = $item ['posisi'];
			$row[] = $item ['keterangan'];
			$row[] = '
			<a class="btn btn-sm btn-primary"  title="Edit" onclick="edit_team('."'".$item['id']."'".')">
			<i class="ico-file5"></i></a>
			
			<a class="btn btn-sm btn-danger"  title="Hapus" onclick="drop_team('."'".$item['id']."'".')">
			<i class="ico-remove"></i></a>';
		
			
			$data[] = $row;
			$no++;
		}

		$output = array(
			"data"=>$data,
			);
      	echo json_encode( $output );
    }

    public function form_addteam()
    {
    	$data['judul_halaman'] = "Pengelolaan Data Team";
        $data['files'] = array(
            APPPATH . 'modules/teamback/views/v-form-team.php',
            // APPPATH . 'modules/teamback/views/v-backup.php',
            );

        $this->parser->parse('admin/v-index-admin', $data);
    }

    //ajax add team
	function ajax_add_team(){
	  $nama = $this->input->post( 'nama' ) ;
	  $posisi = $this->input->post( 'posisi' );
	  $keterangan = $this->input->post( 'keterangan' );

		$data = array(
		    'nama' => $nama,
		    'posisi' => $posisi,
		    'keterangan' =>$keterangan
	    );
			// insert team
	 	$data = $this->Mteamback->insert_team( $data );
		
	 
	}

	public function update_team($id)
	{
		 $data['judul_halaman'] = "Ubah Data Team";
         $data['files'] = array(
            APPPATH . 'modules/teamback/views/v-update-team.php',
            );
         $data['team'] = $this->Mteamback->get_team_byid($id)[0];
         $this->loadparser($data);
	}

	//ajax update team
	function ajax_update_team(){
		$id = $this->input->post('id') ;
	  	$nama = $this->input->post('nama') ;
	  	$posisi = $this->input->post('posisi');
	  	$keterangan = $this->input->post('keterangan');

	   	$data = array(
		    'nama' => $nama,
		    'posisi' => $posisi,
		    'keterangan' =>$keterangan
	    );
	 
	    // update team
	 	$data = $this->Mteamback->update_team($data, $id);

	 	echo json_encode($data);
	}

	// ajax drop team
	function drop_team(){
		if ($this->input->post()) {
			$post = $this->input->post();
			$this->Mteamback->drop_team($post);
		}
	}

	public function do_upload(){
	  if ( ! empty($_FILES)) 
	  {
	    $config["upload_path"]   = $this->upload_path;
	    $config["allowed_types"] = "gif|jpg|png";
	    // get file name
	    //random name
	    $new_name = time()."-".$_FILES['file']['name'];
	    $config['file_name'] = $new_name;
	    // get
	    $this->load->library('upload', $config);

	    $nama = $this->input->post( 'nama' ) ;
	  	$posisi = $this->input->post( 'posisi' );
	  	$keterangan = $this->input->post( 'keterangan' );


	    if ( ! $this->upload->do_upload("file")) {
	      echo "failed to upload file(s)";
	    }else{
	      $file_data = $this->upload->data();
	      $data['data_upload_team']=  array(
	        'foto' => $new_name,
	        'nama' => $this->input->post('nama'),
	        'posisi' => $this->input->post('posisi'),
	        'keterangan' => $this->input->post('keterangan')
	        );
	      $this->Mteamback->in_upload_team($data);
	    }
	  } else {
	  	echo "file kosong";
	  }
	}

	public function do_upload_edit(){
	  if ( ! empty($_FILES)) 
	  {
	    $config["upload_path"]   = $this->upload_path;
	    $config["allowed_types"] = "gif|jpg|png";

	    // get file name
	    //random name
	    $new_name = time()."-".$_FILES['file']['name'];
	    $config['file_name'] = $new_name;
	    // get
	    $this->load->library('upload', $config);

	    if ( ! $this->upload->do_upload("file")) {
	      echo "failed to upload file(s)";
	    }else{
	      $file_data = $this->upload->data();
	      $data['data_upload_team']=  array(
	        'foto' => $new_name
	        );
	      $id = $this->input->post('id');
	      // edit foto
	      $this->Mteamback->edit_upload_team($data,$id);
	      echo "Berhasil di upload";
	    }
	  } else {
	  	echo "file kosong";
	  }
	}

	public function simpan_donatur_co($value='')
 	{
 		$post=$this->input->post();
 		//konfigurasi upload
	  $configLogo['upload_path'] = $this->upload_path;
	  $configLogo['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
	  $configLogo['max_size'] = 100;
	  $configLogo['max_width'] = 1024;
	  $configLogo['max_height'] = 768;
        //random name
	  $configLogo['encrypt_name'] = TRUE;
	  $new_name = time().$_FILES["logo"]['name'];
	  $configLogo['file_name'] = $new_name;
	  $this->load->library('upload', $configLogo);
	  $logo = 'logo';
	  $this->upload->initialize($configLogo);
	  $file_logo=$post['logo'];
	   if (!$this->upload->do_upload($logo)) {
	   		//jika tidak uplop file atau gagal upload file logo
	   		$data['nama']=$post['nama'];
 			// $data['posisi']=$post['posisi'];
 			$this->Mteamback->in_upload_team($data);
 			$info="Data berhasil disimpan dengan file logo kosong";
	   }else {
	   		$file_data = $this->upload->data();
	   		//get nama file yg di upload
      		$file_name = $file_data['file_name'];
 			$data['nama']=$post['nama'];
 			$data['posisi']=$post['posisi'];
 			$data['foto']=$file_name;
 			$this->Mteamback->in_upload_team($data);
 			$info="Data berhasil disimpan dan logo berhasil di-upload ";
	   }
 		//

 		echo json_encode($info);
 	}

}
?>