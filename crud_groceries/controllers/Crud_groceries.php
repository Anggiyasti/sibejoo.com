<?php 
	/**
	* 
	*/
	class Crud_groceries extends MX_Controller{
		
		function ajax_add_upload($data){
			$post=$data['post'];
 		//konfigurasi upload
			$config['upload_path'] = $data['folder_path'];
			$config['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
			$config['max_size'] = 100;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
        //random name
			$config['encrypt_name'] = TRUE;
			$new_name = $data['new_name'];
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$logo = $data['file_identity'];
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($logo)) {
	   			//jika tidak uplop file atau gagal upload file logo
				$insert_without_picture = $data['insert_data'];
				return $insert_without_picture;
			}else {
				$file_data = $this->upload->data();
	   			//get nama file yg di upload
				$file_name = $file_data['file_name'];
				$data['insert_data'][$data['picture_field']] = $file_name; 
				return $data['insert_data'];
			}
		}
	}
	?>