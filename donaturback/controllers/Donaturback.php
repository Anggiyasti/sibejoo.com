<?php 
//============================================================+
// File name   : DonaturBack.php
// Begin       : -
// Last Update : -2018-06-08
//
// Description : ini gemes
//               
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               sibejo.com

//============================================================+

/**
 * @author MrBebek
 * @since  2018-06-08
 */
 class Donaturback extends MX_Controller
 {
 	
 	function __construct()
 	{
 		$this->load->model('Donaturback_model');
 		$this->load->library('parser');
 		$this->load->library('generateavatar');
 	}

 	public function index($value='')
 	{

 		$data['judul_halaman'] = "List Donatur";
		$data['files'] = array(
			APPPATH . 'modules/donaturback/views/v-list-donatur.php',
			);
		
 		// $hakAkses = $this->session->userdata['HAKAKSES'];
		// if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		// } else {
			// redirect(site_url('login'));
		// }

 	}

 	public function ajax_donatur($value='')
 	{
 		$arrDat=$this->Donaturback_model->get_donatur();
 		$tb_donatur = null;
 		$no=1;
 		foreach ($arrDat as $value) {
 			$tb_donatur .='<tr>
 										<td>'.$no.'</td>
 										<td>'.$value->nama.'</td>
 										<td>'.$value->nama_pengguna.'</td>
 												<td></td>
 										<td>'.$value->jenis_member.'</td>
 										<td>
 										<button class="btn btn-warning"><i class="ico-file"></i></button>
 										<button class="btn btn-danger" ><i class="ico-file"></i></button>
 										</td>
 										</tr>';
 			$no++;
 		}
 		echo json_encode($tb_donatur);
 	}

 	public function co_donatur()
 	{
 		$data['judul_halaman'] = "List Donatur";
		$data['files'] = array(
			APPPATH . 'modules/donaturback/views/v-co-donatur.php',
			);	
 		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		} else {
			redirect(site_url('login'));
		}
 	}

 	public function simpan_donatur_co($value='')
 	{
 		$post=$this->input->post();
 		//konfigurasi upload
	  $configLogo['upload_path'] = './assets/image/donatur/logo_perusahaan/';
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
 			$data['namaPerusahaan']=$post['namaPerusahaan'];
 			$this->Donaturback_model->in_donatur_co($data);
 			$info="Data berhasil disimpan dengan file logo kosong";
	   }else {
	   	$file_data = $this->upload->data();
	   	//get nama file yg di upload
      $file_name = $file_data['file_name'];
 			$data['nama']=$post['nama'];
 			$data['namaPerusahaan']=$post['namaPerusahaan'];
 			$data['logo']=$file_name;
 			$this->Donaturback_model->in_donatur_co($data);
 			$info="Data berhasil disimpan dan logo berhasil di-upload ";
	   }
 		//
 		echo json_encode($info);
 	}


	public function ajax_donatur_co($records_per_page=10,$pageSelek=0)
 	{
 		$post=$this->input->post();
 		$records_per_page=$post['records_per_page'];
 		$pageSelek=$post['pageSelek'];
 		$keySearch=$post['keySearch'];
 		$arrDat=$this->Donaturback_model->get_donatur_co($records_per_page,$pageSelek,$keySearch);
 		$tb_donatur = null;
 		$no=$pageSelek+1;
 		foreach ($arrDat as $value) {
 			$fileLogo=$value->logo;
 			$namaPerusahaan=$value->namaPerusahaan;
 			if ($fileLogo!=' '&&$fileLogo!='') {
 				$logo=base_url().'assets/image/donatur/logo_perusahaan/'.$fileLogo;
 			} else {
 				$logo=$this->generateavatar->generate_first_letter_avtar_url($namaPerusahaan);;
 			}
 			
 			$tb_donatur .='
 										<tr>
 										<td>'.$no.'</td>
 										<td><div class="media-object"><img src="'.$logo.'" alt="" class="img-rounded"></div></td>
 										<td>'.$value->nama.'</td>
 										<td>'.$namaPerusahaan.'</td>	
 										<td>'.$value->date.'</td>	
 										<td>
 										<button class="btn btn-warning detail-'.$value->id.' " data-id='."'".json_encode($value)."'".' onclick="edit('.$value->id.')"><i class="ico-edit"></i></button>
 										<button class="btn btn-danger" onclick="drop_logo('.$value->id.')" ><i class="ico-picture"></i></button>
 										<button class="btn btn-danger" onclick="hapus('.$value->id.')" ><i class="ico-trash"></i></button>
 										</td>
 										</tr>';
 			$no++;
 		}
 		echo json_encode($tb_donatur);
 	}

 	public function ajax_pagination_donatur_co($keySearch='',$records_per_page=10)
 	{
 		$jumlah_data=$this->Donaturback_model->sum_donatur_co($keySearch);

 		 		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';
    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);
    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		$pagination.='<li ><a href="javascript:void(0)" onclick="selectPage('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPage('.$i.')" >'.$pagePagination.'</a></li>';
    	 	}

    	 	$pagePagination++;
    	 }
    	 if ($pagePagination>7) {
    	 	  $pagination.='<li class="" id="page-next">
		      								<a href="javascript:void(0)" onclick="nextPage()" aria-label="Next">
		        								<span aria-hidden="true">&raquo;</span>
		      								</a>
		    								</li>';
    	 }
    	 // cek jika halaman pagination hanya satu set pagination menjadi null
    	 if ($sumPagination<=1) {
    	 		$pagination='';
    	 }
 		echo json_encode($pagination);
 	}

 	public function hapus_donatur_co($value='')
 	{
 		$id=$this->input->post('id');
 		$this->Donaturback_model->ch_status_donatur_co($id);
 		echo json_encode("Yeyyeyey");
 	}
 	public function ubah_donatur_co($value='')
 	{
 		//tampung semua post di variabel post
 		$post=$this->input->post();
 		$old_logo=$post['old_logo'];
 		//konfigurasi upload
	  $configLogo['upload_path'] = './assets/image/donatur/logo_perusahaan/';
	  $configLogo['allowed_types'] = 'jpeg|gif|jpg|png|bmp';
	  $configLogo['max_size'] = 100;
	  $configLogo['max_width'] = 1024;
	  $configLogo['max_height'] = 768;
    //random name file logo
	  $configLogo['encrypt_name'] = TRUE;
	  $new_name = time().$_FILES["logo"]['name'];
	  $configLogo['file_name'] = $new_name;
	  $this->load->library('upload', $configLogo);
	  $logo = 'logo';
	  $this->upload->initialize($configLogo);
	  $file_logo=$post['logo'];
	  //pengecekan upload jika berhasil di upload
	  // maka '$this->upload->do_upload($logo)' akan eretrun true
 		if (!$this->upload->do_upload($logo)) {
 			//jika tidak berhasil upload file atau tidak ada 
 			//perubahan logo maka hanya nama dan nmPerusahaan yg akan di rubah
 			$id=$post['id'];
 			$data['nama']=$post['nama'];
 			$data['namaPerusahaan']=$post['namaPerusahaan'];
 			$this->Donaturback_model->ch_donatur_co($data,$id);
 				$info="Data berhasil dirubah";
 		} else if($old_logo==' ' || $old_logo=='') {
 			//jika sebelumnya tidak ada logo maka langsung di insert ke tb
 			$file_data = $this->upload->data();
	   	//get nama file yg di upload
      $file_name = $file_data['file_name'];
      $id=$post['id'];
 			$data['nama']=$post['nama'];
 			$data['namaPerusahaan']=$post['namaPerusahaan'];
 			$data['logo']=$file_name;
 			$this->Donaturback_model->ch_donatur_co($data,$id);
 			$info="Data berhasil dirubah";
 		}else{
 			//jika sebelumnya sudah ada logo maka logo akan di drop dari folder logo_perusahaan
 			unlink(FCPATH . "./assets/image/donatur/logo_perusahaan/" . $old_logo);
			$file_data = $this->upload->data();
	   	//get nama file yg di upload
      $file_name = $file_data['file_name'];
      $id=$post['id'];
 			$data['nama']=$post['nama'];
 			$data['namaPerusahaan']=$post['namaPerusahaan'];
 			$data['logo']=$file_name;
 			$this->Donaturback_model->ch_donatur_co($data,$id);
 			$info="Data berhasil dirubah";
 		}
 		
 		echo json_encode($info);
 	}

 	public function hapus_logo($value='')
 	{
 		$post=$this->input->post();
 		$old_logo=$post["old_logo"];
 		$id=$post["id"];
 		unlink(FCPATH . "./assets/image/donatur/logo_perusahaan/" . $old_logo);
 		$data['logo']='';
 		$this->Donaturback_model->ch_donatur_co($data,$id);

 	}
 } ?>