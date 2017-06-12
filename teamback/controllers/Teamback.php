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
		$this->load->library('generateavatar');

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

	// ajax list team
	public function ajaxListTeam() {
    	$data=array();
      	// code u/pagination
     	$list = $this->Mteamback->data_all_team();

      	$no=1;
      	//cacah data 
      	foreach ( $list as $item ) {
      		$foto=$item['foto'];
      		$nama = $item['nama'];
 			if ($foto!=' ') {
 				$filefoto=base_url().'assets/image/team/'.$foto;
 			} else {
 				$filefoto=$this->generateavatar->generate_first_letter_avtar_url($nama);;
 			}
			$row = array();
			$row[] = $no;
			$row[] = $item ['nama'];
			$row[] = $item ['posisi'];
			$row[] = $item ['keterangan'];
			$row[] = '<div class="media-object"><img src="'.$filefoto.'" alt="" class="img"></div>';
			$row[] = '
			<a class="btn btn-sm btn-primary"  title="Edit" onclick="edit_team('."'".$item['id']."'".')">
			<i class="ico-pencil"></i></a>
			
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

    // view add team
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
	 	$post=$this->input->post();
 		//konfigurasi upload
		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size'] = 100;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
	    
	    //random name
		$configLogo['encrypt_name'] = TRUE;
		$new_name = time()."-".$_FILES["foto"]['name'];
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$foto = 'foto';
		$this->upload->initialize($config);
		$file_foto=$post['foto'];
			if (!$this->upload->do_upload($foto)) {
		   		//jika tidak uplop file atau gagal upload file foto
		   		$data['nama']=$post['nama'];
		   		$data['posisi']=$post['posisi'];
		   		$data['keterangan']=$post['keterangan'];
	 			$this->Mteamback->in_upload_team($data);
	 			$info="Data Team Berhasil disimpan";
		   }else {
			   	$file_data = $this->upload->data();
		   		//get nama file yg di upload
	      		$file_name = $file_data['file_name'];
	 			$data['nama']=$post['nama'];
	 			$data['posisi']=$post['posisi'];
	 			$data['keterangan']=$post['keterangan'];
	 			$data['foto']=$file_name;
	 			$this->Mteamback->in_upload_team($data);
	 			$info="Data Team Berhasil disimpan dan foto berhasil di-upload ";
		   }
	 		//
 		echo json_encode($info);
		
	 
	}

	// view update form
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
		$post=$this->input->post();
		$id = $post['id'];
 		//konfigurasi upload
		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
		$config['max_size'] = 100;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
	    
	    //random name
		$configLogo['encrypt_name'] = TRUE;
		$new_name = time()."-".$_FILES["foto"]['name'];
		$config['file_name'] = $new_name;
		$this->load->library('upload', $config);
		$foto = 'foto';
		$this->upload->initialize($config);
		$file_foto=$post['foto'];
			if (!$this->upload->do_upload($foto)) {
		   		//jika tidak uplop file atau gagal upload file foto
		   		$data['nama']=$post['nama'];
		   		$data['posisi']=$post['posisi'];
		   		$data['keterangan']=$post['keterangan'];
	 			$this->Mteamback->edit_upload_team($data,$id);
	 			$info="Data Team Berhasil diubah";
		   }else {
			   	$file_data = $this->upload->data();
		   		//get nama file yg di upload
	      		$file_name = $file_data['file_name'];
	 			$data['nama']=$post['nama'];
	 			$data['posisi']=$post['posisi'];
	 			$data['keterangan']=$post['keterangan'];
	 			$data['foto']=$file_name;
	 			$this->Mteamback->edit_upload_team($data,$id);
	 			$info="Data Team Berhasil diubah dan foto berhasil di-upload ";
		   }
	 		//
 		echo json_encode($info);
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

}
?>