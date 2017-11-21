<?php 
/**
* 
*/
class Materi extends MX_Controller
{
	private $upload_path = "./assets/file_materi";
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mmateri');
		$this->load->library('parser');
		$this->load->library('sessionchecker');
		$this->sessionchecker->checkloggedin();
	}

	// Menampilkan form materi
	public function form_materi()
	{
		$data['files'] = array(
			APPPATH . 'modules/materi/views/v-form-materi.php',
		);
		$data['judul_halaman'] = "Form Input Materi";
		$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
		if ($this->session->userdata('HAKAKSES')=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		}else if($this->session->userdata('HAKAKSES')=='guru'){
			$this->parser->parse('templating/index-b-guru', $data);
		}else{
			redirect('welcome');
		}
	}

	// fungsi upload materi
	public function uploadMateri()
	{
		$post=$this->input->post();
		$config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
        $config['max_size'] = 10000;

        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["filemateri"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'filemateri';
        $this->upload->initialize($config);
        $file_foto=$post['filemateri'];

		$penggunaID = $this->session->userdata['id'];
		$UUID = uniqid();
		$opupload =$post['opupload'];


		if ($opupload =="text") {
			$data['judulMateri']=$post['judul'];
        	$data['isiMateri']=$post['editor1'];
            $data['subBabID']=$post['subBabID'];
            $data['penggunaID']=$penggunaID;
        	$data['publish']=$post['stpublish'];
            $data['UUID']=$UUID;
			$this->Mmateri->in_materi($data);
		}
		else{
			$this->upload->do_upload($foto);
			$file_data = $this->upload->data();
			$file_name = $file_data['file_name'];
			$data['judulMateri']=$post['judul'];
            $data['subBabID']=$post['subBabID'];
            $data['penggunaID']=$penggunaID;
        	$data['publish']=$post['stpublish'];
            $data['UUID']=$UUID;
            $data['url_file']=$file_name;
			$this->Mmateri->in_materi($data);
		
		}
		
		$info="Materi Berhasil disimpan";
        echo json_encode($info); 
	}


	    //function upload gambar soal
	public function up_file_materi($UUID) {
    $config['upload_path'] = './assets/file_materi/';
    $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
    $config['max_size'] = 10000;

    $this->load->library('upload', $config);
    $gambar = "gambarSoal";
    $this->upload->do_upload($gambar);
    $file_data = $this->upload->data();
    $file_name = $file_data['file_name'];
    $data['uuid']=$UUID;
    $data['datamateri']=  array(
        'url_file' => $file_name);

        // print_r($data);
    $this->Mmateri->up_file($data);
	}

	// tampil list materi
	public function list_all_materi ()
	{
		$data['files'] = array(
			APPPATH . 'modules/materi/views/v-all-materi.php',
		);
		$data['judul_halaman'] = "Materi";
		$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
		if ($this->session->userdata('HAKAKSES')=='admin') {
			$this->parser->parse('admin/v-index-admin', $data);
		}else if($this->session->userdata('HAKAKSES')=='guru'){
			$this->parser->parse('templating/index-b-guru', $data);
		}else{
			redirect('welcome');
		}
	}
	// get ajax list materi
	public function ajax_get_all_materi()
	{
		$materi= $this->load->Mmateri->get_all_materi();
		$data = array();
        //var_dump($list);
        //mengambil nilai list
		$baseurl = base_url();
		$no='1';
		foreach ( $materi as $list_materi ) {
			$n='1';

			$row = array();
			if ($list_materi['publish']=='1') {
				$publish='Publish';
			}else{
				$publish='Tidak Publish';
			}
			$row[] = $no;
			$row[] = $list_materi['judulMateri'];
			$row[] =$list_materi['aliasTingkat'];
			$row[] =$list_materi['mapel'];
			$row[] =$list_materi['judulBab'];
			$row[] =$list_materi['judulSubBab'];
			$row[] =$list_materi['tgl'];
			$row[] =  $publish;
			$row[] = '  <a class="btn btn-sm btn-primary btn-outline detail-'.$list_materi['materiID'].'"  title="Lihat"
			data-id='."'".json_encode($list_materi)."'".'
			onclick="detail('."'".$list_materi['materiID']."'".')"
			>
			<i class=" ico-eye "></i>
			</a> 
			<a class="btn btn-sm btn-warning" href="materi/form_update_materi/'.$list_materi['UUID'].'"  title="Ubah Video"
		)"
		>
		<i class="ico-file5"></i>
		</a> 
		<a class="btn btn-sm btn-danger"  
		title="Hapus" onclick="drop_materi('."'".$list_materi['UUID']."'".')">
		<i class="ico-remove"></i></a> 
		';



		$data[] = $row;
		$n++;
		$no++;

	}

	$output = array(
		"data"=>$data,
	);
	echo json_encode( $output );
}

function get_materi_by_user(){
	$materi= $this->load->Mmateri->get_materi_by_user();
	$data = array();
        //var_dump($list);
        //mengambil nilai list
	$baseurl = base_url();
	$no='1';
	foreach ( $materi as $list_materi ) {
		$n='1';

		$row = array();
		if ($list_materi['publish']=='1') {
			$publish='Publish';
		}else{
			$publish='Tidak Publish';
		}
		$row[] = $no;
		$row[] = $list_materi['judulMateri'];
		$row[] =$list_materi['aliasTingkat'];
		$row[] =$list_materi['mapel'];
		$row[] =$list_materi['judulBab'];
		$row[] =$list_materi['judulSubBab'];
		$row[] =$list_materi['tgl'];
		$row[] =  $publish;
		$row[] = '  <a class="btn btn-sm btn-primary btn-outline detail-'.$list_materi['materiID'].'"  title="Lihat"
		data-id='."'".json_encode($list_materi)."'".'
		onclick="detail('."'".$list_materi['materiID']."'".')"
		>
		<i class=" ico-eye "></i>
		</a> 
		<a class="btn btn-sm btn-warning" href="materi/form_update_materi/'.$list_materi['UUID'].'"  title="Ubah Video"
	)"
	>
	<i class="ico-file5"></i>
	</a> 
	<a class="btn btn-sm btn-danger"  
	title="Hapus" onclick="drop_materi('."'".$list_materi['UUID']."'".')">
	<i class="ico-remove"></i></a> 
	';



	$data[] = $row;
	$n++;
	$no++;

}

$output = array(
	"data"=>$data,
);
echo json_encode( $output );
}
	// menampilkan  form update materi
public function form_update_materi($UUID)
{
	$data['singleMateri']=$this->Mmateri->get_single_materi($UUID);
	$subBabID = $data['singleMateri'] ['subBabID'];
	$data['infomateri']=$this->Mmateri->get_tingkat_info($subBabID);
	$data['files'] = array(
		APPPATH . 'modules/materi/views/v-update-materi.php',
	);
	$data['judul_halaman'] = "Form Update Materi";
	$hakAkses=$this->session->userdata['HAKAKSES'];
                // cek hakakses 
	if ($this->session->userdata('HAKAKSES')=='admin') {
		$this->parser->parse('admin/v-index-admin', $data);
	}else if($this->session->userdata('HAKAKSES')=='guru'){
		$this->parser->parse('templating/index-b-guru', $data);
	}else{
		redirect('welcome');
	}
}

// fungsi update materi
public function updateMateri()
{	
	$post=$this->input->post();
	$UUID = $post['UUID'];
	$opupload =$post['opupload'];
	$onefile_materi = $this->Mmateri->get_onefile_materi($UUID)[0]['url_file'];

		$config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = 'doc|docx|ppt|pptx|pdf';
        $config['max_size'] = 10000;

        $configLogo['encrypt_name'] = TRUE;
        $new_name = time()."-".$_FILES["gambarSoal"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $foto = 'gambarSoal';
        $this->upload->initialize($config);
        $file_foto=$post['gambarSoal'];

		$penggunaID = $this->session->userdata['id'];
		
		if ($opupload =="text") {
			$data['judulMateri']=$post['judul'];
        	$data['isiMateri']=$post['editor1'];
            $data['subBabID']=$post['subBabID'];
            $data['penggunaID']=$penggunaID;
        	$data['publish']=$post['stpublish'];
            $data['UUID']=$UUID;
            $data['url_file']='';
            echo json_encode("upload materi"); 
			$this->Mmateri->ch_materi($data,$UUID);
		}
		else{
			$this->upload->do_upload($foto);
			if ($onefile_materi!='' && $onefile_materi!=' ') {
                   unlink(FCPATH . "./assets/file_materi/" . $onefile_materi);
          }
			$file_data = $this->upload->data();
			$file_name = $file_data['file_name'];
			$data['judulMateri']=$post['judul'];
			$data['isiMateri']='';
            $data['subBabID']=$post['subBabID'];
            $data['penggunaID']=$penggunaID;
        	$data['publish']=$post['stpublish'];
            $data['UUID']=$UUID;
            //fungsi jika file di ubah atau tidak 
            if ($file_foto != Null) {
            	$data['url_file']=$file_name;
            }else{

            }
			$this->Mmateri->ch_materi($data,$UUID);
			 echo json_encode($data); 
		}
		
		$info="Materi Berhasil dirubah";
        echo json_encode($info); 

}

public function del_materi()
{
	if ($this->input->post()) {
		$post = $this->input->post();
		$UUID = $post['UUID'];
		$this->del_file_materi($UUID);
		$this->Mmateri->drop_materi($post);
	}
}

public function del_file_materi($UUID)
	{
		// get data team by id
		$onefile_materi = $this->Mmateri->get_onefile_materi($UUID);
		//cek  jika hasil null
		if ($onefile_materi != false) {
			//cek name file img team
			$file_materi=$onefile_materi[0]['url_file'];
			if ($file_materi != '' && $file_materi != ' ') {
				// jika file tidak null atau kosong maka hapus file
				 unlink(FCPATH . "./assets/file_materi/" . $file_materi);
			}
		}
	}


}
?>