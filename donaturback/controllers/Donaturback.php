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
 		$data['nama']=$post['nama'];
 		$data['namaPerusahaan']=$post['namaPerusahaan'];
 		$this->Donaturback_model->in_donatur_co($data);
 		echo json_encode($data);
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
 			$tb_donatur .='<tr>
 										<td>'.$no.'</td>
 										<td><div class="media-object"><img src="'.base_url().'assets/image/avatar/avatar3.jpg" alt="" class="img-circle"></div></td>
 										<td>'.$value->nama.'</td>
 										<td>'.$value->namaPerusahaan.'</td>	
 										<td>
 										<button class="btn btn-warning detail-'.$value->id.' " data-id='."'".json_encode($value)."'".' onclick="edit('.$value->id.')"><i class="ico-edit"></i></button>
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
 		$post=$this->input->post();
 		$id=$post['id'];
 		$data['nama']=$post['nama'];
 		$data['namaPerusahaan']=$post['namaPerusahaan'];
 		$this->Donaturback_model->ch_donatur_co($data,$id);
 	}
 } ?>