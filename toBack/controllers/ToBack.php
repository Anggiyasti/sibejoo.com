<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
/*  <!-- NEATED BY OPIK SUTISNA PUTRA --> */
class Toback extends MX_Controller{
	public function __construct() {
		$this->load->library( 'parser' );
		$this->load->model('Mtoback');
		$this->load->model('komenback/mkomen');
		$this->load->model( 'paketsoal/mpaketsoal' );
		$this->load->model('siswa/msiswa');
		$this->load->model('templating/mtemplating');
        $this->load->model('konsultasi/mkonsultasi');

		parent::__construct();
		$this->load->library('sessionchecker');
		$this->sessionchecker->checkloggedin();
	}

	#START Function buat TO#
	public function buatTo()
	{
		$nmpaket=htmlspecialchars($this->input->post('nmpaket'));
		$tglMulai=htmlspecialchars($this->input->post('tglmulai'));
		$tglAkhir=htmlspecialchars($this->input->post('tglakhir'));
		$publish=htmlspecialchars($this->input->post('publish'));
			$status=htmlspecialchars($this->input->post('free'));
		$UUID = uniqid();
		$wktMulai=htmlspecialchars($this->input->post('wktmulai'));
		$wktAkhir=htmlspecialchars($this->input->post('wktakhir'));
		$penggunaID = $this->session->userdata['id'];
		$dat_To=array(
			'nm_tryout'=>$nmpaket,
			'tgl_mulai'=>$tglMulai,	
			'tgl_berhenti'=>$tglAkhir,	
			'wkt_mulai'=>$wktMulai,	
			'wkt_berakhir'=>$wktAkhir,	
			'publish'=>$publish,
			'penggunaID'=>$penggunaID,
			'UUID' =>$UUID,
			'status'=>$status
			);

		$this->Mtoback->insert_to($dat_To);
		redirect(site_url('toback/addPaketTo/'.$UUID));
	}
	#END Function buat TO#

	#START Function add pakket to Try Out#
	// menampilkan halaman add to
	public function addPaketTo($UUID=''){	
		if ($UUID!=null) {
			$this->cek_PaketTo($UUID);
		} else {
			$data['files'] = array(
				APPPATH . 'modules/templating/views/v-data-notfound.php',
				);

			$data['judul_halaman'] = "Bundle Paket";
			#START cek hakakses#
			$hakAkses=$this->session->userdata['HAKAKSES'];

			if ($hakAkses =='admin') {
	    // jika admin
				if ($babID == null) {
					redirect(site_url('admin'));
				} else {
					$this->parser->parse('admin/v-index-admin', $data);
				}
			}  else if($hakAkses=='guru'){
				if ($babID == null) {
					redirect(site_url('guru/dashboard/'));
				} else {
					// notification
					$data['datKomen']=$this->datKomen();
					$id_guru = $this->session->userdata['id_guru'];
     // get jumlah komen yg belum di baca
					$data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);

					$this->parser->parse('templating/index-b-guru', $data);
				}
			}else{
	   // jika siswa redirect ke welcome
				redirect(site_url('welcome'));
			}
	 #END Cek USer#
		}
	}

	public function cek_PaketTo($UUID){
		$data['tryout'] = $this->mpaketsoal->get_id_by_UUID($UUID);
		if (!$data['tryout']==array()) {		
			$id_to = $data['tryout']['id_tryout'];
			$data['id_to']=$data['tryout']['id_tryout'];
			$data['nm_to']=$data['tryout']['nm_tryout'];
			$data['siswa'] = $this->msiswa->get_siswa_blm_ikutan_to($id_to);
			$data['files'] = array(
				APPPATH . 'modules/toback/views/v-bundlepaket.php',
				);
			$data['judul_halaman'] = "Bundle Paket";
		} else {
			$data['files'] = array(
				APPPATH . 'modules/templating/views/v-data-notfound.php',
				);
			$data['judul_halaman'] = "Bundle Paket";
		}
		 #START cek hakakses#
		$hakAkses=$this->session->userdata['HAKAKSES'];
		if ($hakAkses =='admin') {
   // jika admin 
			$data['files'] = array(
				APPPATH . 'modules/toback/views/v-bundlepaket-admin_backup.php',
				);
			$this->parser->parse('admin/v-index-admin', $data);
		}  elseif($hakAkses=='guru'){
   // jika guru

   // notification
			$data['datKomen']=$this->datKomen();
			$id_guru = $this->session->userdata['id_guru'];
   // get jumlah komen yg belum di baca
			$data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);

			$this->parser->parse('templating/index-b-guru', $data);
		}else{
  // jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
  #END Cek USer#
	}

	//add paket ke TO
	public function addPaketToTO(){
		$id_paket=$this->input->post('idpaket');
		$id_tryout=$this->input->post('id_to');
		
		//testing
		$dat_paket=array();
		foreach ($id_paket as $key) {
			$dat_paket[] = array(
				'id_tryout'=>$id_tryout,
				'id_paket'=>$key);			
		}
		$this->Mtoback->insert_addPaket($dat_paket);
	}

	// add hak akses to siswa 
	public function addsiswaToTO(){
		$id_siswa=$this->input->post('idsiswa');
		$id_tryout=$this->input->post('id_to');

		//menampung array id siswa
		$dat_siswa=array();
		foreach ($id_siswa as $key) {
			$dat_siswa[] = array(
				'id_tryout'=>$id_tryout,
				'id_siswa'=>$key);			
		}
		//add siswa ke paket 
		$this->Mtoback->insert_addSiswa($dat_siswa);
	}


	//menampikan paket yg sudah di add
	function ajax_listpaket_by_To($idTO) {
		$list = $this->load->Mtoback->paket_by_toID($idTO);
		$data = array();
		$no=0;
		$baseurl = base_url();
		foreach ( $list as $list_paket ) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list_paket['nm_paket'];
			$row[] = $list_paket['deskripsi'];
			$row[] = '
			<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropPaket('."'".$list_paket['idKey']."'".')"><i class="ico-remove"></i></a>';
			$data[] = $row;
		}

		$output = array(
			"data"=>$data,
			);
		echo json_encode( $output );

	}

	//list siswa yg mengikuti to
	function ajax_listsiswa_by_To($idTO) {
		$list = $this->load->Mtoback->siswa_by_totID($idTO);
		$data = array();

		$baseurl = base_url();
		$no=1;
		foreach ( $list as $list_siswa ) {
			// $no++;
			$row = array();
			$row[] = $no;
			$row[] = $list_siswa ['namaPengguna'];
			$row[] = $list_siswa ['namaDepan'].' '.$list_siswa ['namaBelakang'];
			$row[] = $list_siswa['aliasTingkat'];
			$row[] = '<a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa('."'".$list_siswa['idKey']."'".')"><i class="ico-remove"></i></a>';

			$data[] = $row;
			$no++;
		}

		$output = array(
			"data"=>$data,
			);

		echo json_encode( $output );
	}

	#END Function add pakket to Try Out#


	#START Function di halaman daftar TO#
	//menampilkan halaman list TO
	public function listTO(){
		$data['files'] = array(
			APPPATH . 'modules/toback/views/v-list-to.php',
		);
		$data['judul_halaman'] = "List Try Out";
		$hakAkses=$this->session->userdata['HAKAKSES'];
		if ($hakAkses=='admin') {
 		 	// jika admin
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif($hakAkses=='guru'){
			
			$data['konsultasi'] = $this->mkonsultasi->get_pertanyaan_blm_direspon();
 		 	// jika guru
  		// notification
			$data['datKomen']=$this->datKomen();
			$id_guru = $this->session->userdata['id_guru'];
  		// get jumlah komen yg belum di baca
			$data['count_komen']=$this->mkomen->get_count_komen_guru($id_guru);

			$this->load->view('templating/index-b-guru', $data);  
		} else{
   		// jika siswa redirect ke welcome
			redirect(site_url('welcome'));
		}
	}

	// menampilkan list to
	public function ajax_listsTO(){
		$list =$this->Mtoback->get_To();
		$data = array();

		$baseurl = base_url();
		$hakAkses=$this->session->userdata['HAKAKSES'];
		$sesPenggunaID = $this->session->userdata['id'];
		$no=0;
		foreach ( $list as $list_to ) {
			$no++;
			$sts_publish=$list_to['publish'];
			$sts_to=$list_to['status'];
			if ($sts_publish=='1') {
				$publish='Publish';
			} else {
				$publish='Tidak Publish';
			}
			if ($sts_to=='1') {
				$status='Member';
			} else {
				$status='Free';
			}
			$penggunaID = $list_to ['penggunaID'];
			
			$row = array();
			$row[] = $no;
			$row[] = $list_to ['nm_tryout'];
			$row[] = $list_to['namaPengguna'];
			$row[] = $list_to['tgl_mulai'];
			$row[] = $list_to['wkt_mulai'];
			$row[] = $list_to['tgl_berhenti'];
			$row[] = $list_to['wkt_berakhir'];
			$row[] = $publish;
			$row[] = $status;
			if ($penggunaID==$sesPenggunaID || $hakAkses=='admin' ) {
				$row[] = '
				<a class="btn btn-sm btn-primary"  title="Ubah" onclick="edit_TO('."'".$list_to['id_tryout']."'".')">
					<i class="ico-file5"></i></a> <a class="btn btn-sm btn-success"  title="ADD PAKET to TO" href='."addPaketTo/".$list_to['UUID'].' >
					<i class="ico-file-plus2"></i></a> <a class="btn btn-sm btn-primary"  title="Daftar Peserta TO" onclick="show_peserta('."'".$list_to['UUID']."'".')"> <i class="ico-user"></i></a> <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropTO('."'".$list_to['id_tryout']."'".')">
					<i class="ico-remove"></i></a>';
				} else {
					$row[] ='<a class="btn btn-sm btn-primary"  title="Daftar Peserta TO" onclick="show_peserta('."'".$list_to['UUID']."'".')">
					<i class="ico-user"></i></a>';
				}
				$data[] = $row;
			}

			$output = array("data"=>$data);
			echo json_encode( $output );
		}

		public function dropTO($id_tryout){
			$this->Mtoback->drop_TO($id_tryout);
		}

		public function ajax_edit( $id_tryout) {
			$data = $this->Mtoback->get_TO_by_id( $id_tryout );
			echo json_encode( $data );
		}

#END Function di halaman daftar TO#

// Drop paketb to TO
		public function dropPaketTo($idKey){
			$this->Mtoback->drop_paket_toTO($idKey);
		}

	// Drop siswa to to
		public function dropSiswaTo($idKey){
			$this->Mtoback->drop_siswa_toTO($idKey);
		}


		public function editTryout(){
			$data['id_tryout']=htmlspecialchars($this->input->post('id_tryout'));
			$nm_tryout=htmlspecialchars($this->input->post('nama_tryout'));
			$tglMulai=htmlspecialchars($this->input->post('tgl_mulai'));
			$tglAkhir=htmlspecialchars($this->input->post('tgl_berhenti'));
			$publish=htmlspecialchars($this->input->post('publish'));
			$free=htmlspecialchars($this->input->post('free_edit'));
			if ($free==1) {
				$status=0;
			} else {
				$status=1;
			}
			

			$wktMulai=htmlspecialchars($this->input->post('wkt_mulai'));
			$wktAkhir=htmlspecialchars($this->input->post('wkt_akhir'));

			$data['tryout']=array(
				'nm_tryout'=>$nm_tryout,
				'tgl_mulai'=>$tglMulai,
				'tgl_berhenti'=>$tglAkhir,
				'wkt_mulai'=>$wktMulai,
				'wkt_berakhir'=>$wktAkhir,
				'publish'=>$publish,
				'status'=>$status
				);

			$this->Mtoback->ch_To($data);
		}

	#####OPIK#########################################

		public function reportto($uuid){
			$data['tryout'] = $this->Mtoback->get_to_byuuid($uuid);

			if (!$data['tryout']==array()) {
				$id_to  = $data['tryout'][0]['id_tryout'];
				$data['daftar_peserta'] =$this->Mtoback->get_report_peserta_to($id_to);
				$data['files'] = array(
					APPPATH . 'modules/toback/views/v-list-peserta.php',
					);
				$data['judul_halaman'] = "Laporan Untuk TO : ".$data['tryout'][0]['nm_tryout'];
			} else {
				$data['files'] = array(
					APPPATH . 'modules/templating/views/v-data-notfound.php',
					);
				$data['judul_halaman'] = "Daftar Peserta";
				$this->load->view('templating/v-data-notfound');
			}
			$hakAkses=$this->session->userdata['HAKAKSES'];

			if ($hakAkses=='admin') {
		// jika admin
				$this->parser->parse('admin/v-index-admin', $data);
			} elseif($hakAkses=='guru'){
			 // jika guru
				$this->load->view('templating/index-b-guru', $data);  
			}else{
			// jika siswa redirect ke welcome
				redirect(site_url('welcome'));
			}
		}

		##menampilkan paket yang belum ada di TO.
		function ajax_list_all_paket($id_to){
			$list = $this->mpaketsoal->get_paket_unregistered($id_to);
			$data = array();
			$baseurl = base_url();
			$n = 1;
			foreach ( $list as $list_paket ) {
				$row = array();
				$row[] = "<input type='checkbox' value=".$list_paket['id_paket']." id=".$list_paket['nm_paket'].$list_paket['id_paket']." name=".$list_paket['nm_paket'].$n.">";
				$row[] = $n;
				$row[] = $list_paket['nm_paket'];
				$row[] = $list_paket['deskripsi'];
				$row[] = "<a onclick="."lihatsoal(".$list_paket['id_paket'].")"." class='btn btn-primary'>Lihat</a>";
				$data[] = $row;
				$n++;
			}

			$output = array(
				"data"=>$data,
				);
			echo json_encode( $output );
		}
	###menampilkan paket yang belum ada di TO.

	##menampilkan siswa yang belum ikutan TO.
		function ajax_list_siswa_belum_to($id){
			$list = $this->msiswa->get_siswa_blm_ikutan_to($id);
			$data = array();
			$no=0;
			$baseurl = base_url();
			foreach ( $list as $list_siswa ) {
				$no++;
				$row = array();
				$row[] = "<input type='checkbox' value=".$list_siswa['id']." >";
				$row[] = $no;
				$row[] = $list_siswa ['namaPengguna'];
				$row[] = $list_siswa ['namaDepan']." ".$list_siswa['namaBelakang'];

				$row[] = $list_siswa['aliasTingkat'];
			// $row[] = '
			// <a class="btn btn-sm btn-danger"  title="Hapus" onclick="dropSiswa('."'".$list_siswa['id']."'".')"><i class="ico-remove"></i></a>';
				$data[] = $row;
			}

			$output = array(
				"data"=>$data,
				);
			echo json_encode( $output );
		}

	###menampilkan siswa yang belum ikutan TO.
	// menampilkan list Pkaet by to for Report
		public function reportPaketSiswa()
		{
			$data['id_to']=htmlspecialchars($this->input->get('id_to'));
			$penggunaID=htmlspecialchars($this->input->get('id_pengguna'));
			$data['idPengguna']=$penggunaID;
			$data['siswa']=$this->Mtoback->get_nama_siswa($penggunaID)[0];
			$data['reportPaket']=$this->Mtoback->get_report_paket($data);
			$data['files'] = array(
				APPPATH . 'modules/toback/views/v-report-paket-siswa.php',
				);
			$data['judul_halaman'] = "Report Siswa Perpaket";
			$this->load->view('templating/index-b-guru', $data);
		}
					//menampilkan report paket 
		public function reportpaket($idpaket)
		{
			$data['report']=$this->Mtoback->get_all_report_paket($idpaket);

			$data['files'] = array(
				APPPATH . 'modules/paketsoal/views/v-report-paket.php',
				);
			$data['judul_halaman'] = "Report Siswa Perpaket";
			$this->load->view('templating/index-b-guru', $data);
		}

		public function detailpaketsiswa(){
			$idto = $this->uri->segment(3);
			$idpengguna =  $this->uri->segment(4);
            // $idto = $this->uri->segmen(3);
			$data['reportpaket'] = $this->msiswa->get_reportpaket_to($idpengguna,$idto);
			$data['ratarata'] = $this->msiswa->ratarata_to($idpengguna,$idto);

			$data['judul_halaman'] = "Report Siswa";
			$data['files'] = array(
				APPPATH . 'modules/siswa/views/v-report-paket.php',
				);

			$hakAkses=$this->session->userdata['HAKAKSES'];

			if ($hakAkses=='admin') {
		// jika admin
				$this->parser->parse('admin/v-index-admin', $data);
			} elseif($hakAkses=='guru'){
			 // jika guru
				$this->load->view('templating/index-b-guru', $data);  
			}else{
			// jika siswa redirect ke welcome
				redirect(site_url('welcome'));
			}
		}


	# insert paket dari webservice
		public function inserpaket(){
			try {
				if ($this->input->post()) {
					$post = $this->input->post();
					echo json_encode($post);
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
	#
	// get data komen not read
		public function datKomen()
		{
			$hakAkses = $this->session->userdata['HAKAKSES'];
			if ($hakAkses == 'admin') {
				$listKomen = $this->mkomen->get_all_komen();
			}else{
				$id_guru = $this->session->userdata['id_guru'];
				$listKomen = $this->mkomen->get_komen_by_profesi_notread($id_guru);
			}

			return $listKomen;
		}

	##menampilkan siswa yang belum ikutan to buat pagination
		function ajax_pagination_siswa_nonto($id){
			$tb_siswa = null;
			$this->load->database();

			$post = $this->input->post();						
			$post['id_to'] =$id;
						// semua data.
			$list = $this->msiswa->get_siswa_blm_ikutan_to_pagination($post);

			$data = array();
			$no=$post['page_select']+1;
			$baseurl = base_url();
			$tb_siswa = null;

			if(!empty($list)){

				foreach ( $list as $list_siswa ) {
					$tb_siswa .= '<tr>
					<td>'."<input type='checkbox' value=".$list_siswa['id']." >".'</td>
					<td>'.$no.'</td>
					<td>'.$list_siswa ['namaPengguna'].'</td>
					<td>'.$list_siswa ['namaDepan']." ".$list_siswa['namaBelakang'].'</td>
					<td>'.$list_siswa ['aliasTingkat'].'</td>
				</tr>';

				$no++;
			}
		}else{
			$tb_siswa = '<tr><td colspan="6"><h5 class="text-info text-center">Tidak Ada Data</h5></td></tr>';
		}


		echo json_encode( $tb_siswa );
					// echo json_encode( $post );

	}
## PAGINATION SISWA YANG BELUM MELAKUKAN TRYOUT

## fungsi paginatioin
	function pagination_siswa($id){
		$post = $this->input->post();						
		$post['id_to'] =$id;

		$jumlah_data = $this->msiswa->get_siswa_blm_ikutan_to_pagination_number($post);

		$pagination = '<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
		<span aria-hidden="true">&laquo;</span>
	</a></li>';
	$pagePagination=1;

	$sumPagination=($jumlah_data/$post['records_per_page']);
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
## fungsi paginatioin
#############################################################################
// ============DIBAWAH FUNGSI-FUNGSI===LAPORAN HASIL TRYOUT==================
#############################################################################
public function laporanto($tryout="all",$paket="all",$records_per_page=10,$page=0){
		//data post
		$records_per_page=$this->input->post('records_per_page');
		$page=$this->input->post('page');
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		//data post

		# get to
		$data['to'] = $this->Mtoback->get_To();


		if ($keySearch != '' && $keySearch !=' ' ) {
			$datas = ['tryout'=>$tryout,'paket'=>$paket];
			$all_report = $this->Mtoback->cari_report_paket($datas,$records_per_page,$page,$keySearch);
		} else {
			$datas = ['tryout'=>$tryout,'paket'=>$paket];
			$all_report = $this->Mtoback->get_report_paket_view($datas,$records_per_page,$page);
		}
		

		$data = array();
		$tb_paket=null;
		$no=$page+1;
		foreach ( $all_report as $item ) {
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
			$nama=$item ['namaDepan']." ".$item ['namaBelakang'];
			$nilai=0;
			// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				// cek jenis penilaian
	            if ($item ['jenis_penilaian']=='SBMPTN') {
	                $nilai= (($sumBenar * 4) + ($sumSalah * (-1)) + ($sumKosong * 0)) * 100 / ($jumlahSoal * 4);
	            } else {
	                $nilai=$sumBenar/$jumlahSoal*100;
	            }
			}
			$tb_paket.=	'<tr>
							<td>'.$no.'</td>	
							<td>'.$item ['namaPengguna'].'</td>
							<td>'.$item ['nm_paket'].'</td>
							<td>'.$item ['jenis_penilaian'].'</td>
							<td>'.$nama.'</td>
							<td>'.$jumlahSoal.'</td>							
							<td>'.$sumBenar.'</td>
							<td>'.$sumSalah.'</td>
							<td>'.$sumKosong.'</td>
							<td>'.number_format($nilai,2).'</td>
							<td>'.$item['tgl_pengerjaan'].'</td>
						</tr>';

						$no++;
		}

	
		echo json_encode( $tb_paket );
	}
	public function pagination_daftar_paket($tryout="all",$paket="all",$records_per_page=100,$page=0,$keySearch='')
	{
		//data post
		// $records_per_page=$this->input->post('records_per_page');
		// $page=$this->input->post('page');
		//data post
		
		# get to
		$data['to'] = $this->Mtoback->get_To();
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		$datas = ['tryout'=>$tryout,'paket'=>$paket];
		if ($keySearch != '' && $keySearch !=' ' ) {
			$datas = ['tryout'=>$tryout,'paket'=>$paket];
			$jumlah_data = $this->Mtoback->jumlah_cari_report_paket($datas,$keySearch);
		} else {
			$datas = ['tryout'=>$tryout,'paket'=>$paket];
			$jumlah_data = $this->Mtoback->jumlah_report_paket($datas);
		}
		

		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';

    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);

    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		    	 	$pagination.='<li ><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		    	 	$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPagePaket('.$i.')" >'.$pagePagination.'</a></li>';
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

    	 if ($pagePagination<3) {
    	 		$pagination='';
    	 }
    	 

		echo json_encode($pagination);
	}
// laporan TRYOUT 
	public function laporanpaket(){
		// kalo ada yang di post dari modal filter.
		if ($this->input->post()) {
			$data['post'] = $this->input->post();
		} 

		$data['judul_halaman'] = "Laporan Paket TO";
		$data['files'] = array(
			APPPATH . 'modules/toback/views/v-daftar-paket.php',
			);
		# get to
		$data['to'] = $this->Mtoback->get_To();
		$hakAkses = $this->session->userdata['HAKAKSES'];
		if ($hakAkses == 'admin') {
			
			$data['files'] = array(
				APPPATH . 'modules/toback/views/v-daftar-paket-admin.php',
				);
			$this->parser->parse('admin/v-index-admin', $data);
		} elseif ($hakAkses == 'guru') {
			redirect(site_url('guru/dashboard/'));
		} elseif ($hakAkses == 'siswa') {
			redirect(site_url('welcome'));
		} else {
			redirect(site_url('login'));
		}
	}

// LAPORAN PDF TRYOUT PER-PKAET
		public function laporanPDF($tryout="all",$paket="all")
	{
		$this->load->library('Pdf');
		$datas = ['tryout'=>$tryout,'paket'=>$paket];
		$all_report = $this->Mtoback->get_report_paket_pdf($datas);		
		$data['all_report'] = array();
		$no=0;
		$sumNilai=0;
		$maxNilai=0;
		$minNilai=100;
		foreach ( $all_report as $item ) {
			$no++;
			$sumBenar=$item ['jmlh_benar'];
			$sumSalah=$item ['jmlh_salah'];
			$sumKosong=$item ['jmlh_kosong'];
			//hitung jumlah soal
			$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
						// cek jika pembagi 0
			if ($jumlahSoal != 0) {
				//hitung nilai
				// cek jenis penilaian
	            if ($item ['jenis_penilaian']=='SBMPTN') {
	                $nilai= (($sumBenar * 4) + ($sumSalah * (-1)) + ($sumKosong * 0)) * 100 / ($jumlahSoal * 4);
	            } else {
	                $nilai=$sumBenar/$jumlahSoal*100;
	            }
			}
			
			$paket=$item ['nm_paket'];
			$data['all_report'][]=array(
				'no'=>$no,
				'jumlah_soal'=>$jumlahSoal,
				'nama'=>$item ['namaDepan']." ".$item ['namaBelakang'],
				'jmlh_benar'=>$item ['jmlh_benar'],
				'jmlh_salah'=>$item ['jmlh_salah'],
				'jmlh_kosong'=>$item ['jmlh_kosong'],
				'jumlah_soal'=>$jumlahSoal,
				'nilai'=>number_format($nilai,2),
				'tgl_pengerjaan'=>$item ['tgl_pengerjaan']
				);
			//sum Nilai
			$sumNilai += $nilai;

			//set Max nilai
			if ($maxNilai<$nilai) {
				$maxNilai=$nilai;
			}
			//set Min nilai
			if($minNilai>$nilai){
				$minNilai=$nilai;
			}

		}
		//hitung rata2 nilai
		$avg=$sumNilai/$no;
		//format rata2 max 2 digit di belakang koma
		$formattedAvg = number_format($avg,2);
		$data['avg']=$formattedAvg;
		$data['jumlahSiswa']=$no;
		$data['maxNilai']=number_format($maxNilai,2);
		$data['minNilai']=number_format($minNilai,2);
		$data['paket'] = $paket;
		if ( $tryout !="all" && $paket !="all") {
			$this->parser->parse('v-laporanPDF-paket.php',$data);
		}else{
			redirect(site_url('toback/laporanpaket'));
		}
		
	}
	// laporan pdf per to
public function laporan_to_PDF($tryout="all")
{
	$this->load->library('Pdf');
	$datas = ['tryout'=>$tryout,'paket'=>"all"];
	$all_report = $this->Mtoback->get_report_to_pdf($datas);	

	$data['dat_paket'] = $this->Mtoback->get_count_paket($datas);
$count_paket=count($data['dat_paket']);
	// set_index paket
	for ($i=0; $i <$count_paket ; $i++) { 
		$data['dat_paket'][$i]["index_paket"]=$i+1;
	}
	$data['all_report'] = array();
	$no=0;
	$index=-1;
	//
	
	$tamp_noIndukNeutron='tamp';
	$max_avg=0;
	$sum_nilai_to=0;
	foreach ( $all_report as $item ) {
		$sumBenar=$item ['jmlh_benar'];
		$sumSalah=$item ['jmlh_salah'];
		$sumKosong=$item ['jmlh_kosong'];
		$nama=$item ['namaDepan']." ".$item ['namaBelakang'];
		$nama_paket=$item['nm_paket'];
		$noIndukNeutron=$item['nisn'];
		$nm_tryout=$item ['nm_tryout'];
			//hitung jumlah soal
		$jumlahSoal=$sumBenar+$sumSalah+$sumKosong;
		// cek jika pembagi 0
		if ($jumlahSoal != 0) {
				//hitung nilai
			$nilai=$sumBenar/$jumlahSoal*100;
		}
		if ($tamp_noIndukNeutron != $noIndukNeutron) {
			// data siswa
			//jumlah nilai siswa
			$sum_nilai=0;
			// $index_tamp=1;
			$index++;
			$no++;
			$ini=0;

			$tamp_noIndukNeutron = $noIndukNeutron;
		}
		if($tamp_noIndukNeutron == $noIndukNeutron){
			$ini++;
				// pengulangan untuk nilai paket
				// data nilai paket siswa
				$data['all_report'][$index]['no']=$ini;
				$data['all_report'][$index]['no_cbt']=$noIndukNeutron;
				$data['all_report'][$index]['nama']=$nama;
				// $data['all_report'][$index]['nm_paket']="sssss";
				
				$id_paket=$item["id_paket"];
				for ($i=0; $i < $count_paket ; $i++) { 
					$tamp_paket=$data['dat_paket'][$i]["id_paket"];
					if ($tamp_paket==$id_paket) {
						// $index_tamp=$data['dat_paket'][$i]["index_paket"];
						$index_tamp=$i+1;
						$nilai_paket="nilai_".$index_tamp;
					}
				}
			
				$data['all_report'][$index][$nilai_paket]=number_format($nilai,2);
				//jumlah nilai siswa
				$sum_nilai+=number_format($nilai,2);
				//jumlah nilai keseluruhan siswa
				$sum_nilai_to+=number_format($nilai,2);
				$avg=number_format(($sum_nilai/$count_paket),2);
				$data['all_report'][$index]['avg']=$avg;
				// filter siswa nilai rata tertinggi
				if ($max_avg <= $avg) {
					$max_avg=$avg;
					$data["no_cbt_max"]=$noIndukNeutron;
					$data["nama_max"]=$nama;
					$data["avg_max"]=$avg;

				}
				$index_tamp++;
		}
		
	}
	$data['sum_siswa']=$no;
	$avg_to=$sum_nilai_to/($count_paket*$no);
	$data['avg_to']=number_format($avg_to,2);
	$data['nm_tryout']=$nm_tryout;

	if ($tryout !="all") {
		$this->parser->parse('v-laporan_to.php',$data);
	}else{
			redirect(site_url('toback/laporanpaket'));
	}

}

	function drop_report(){
		if ($this->input->post()) {
			$data = $this->input->post();
			$this->Mtoback->delete_report($data);
		}
	}

	    // function get paket UNTUK FILTER REPORT PAKET
	public function get_paket( $to_id ) {
		$data = $this->output
		->set_content_type( "application/json" )
		->set_output( json_encode( $this->Mtoback->get_paket( $to_id ) ) );
	}
// =================================================================

}
?>
