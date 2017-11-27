<?php 

/**

* 

*/

class Error extends MX_Controller

{

	

	function __construct()

	{

		parent::__construct(); 

	}



	function index(){

		$this->output->set_status_header('404'); 

        $data['content'] = 'error_404'; // View name 

		echo "string";

	}

	function forbidden()
 	{    //untuk daftar artikel
        $data['judul_halaman'] = "Forbidden Access";
        $data['files'] = array(
            APPPATH . 'modules/error/views/error-back.php',
        );
	        
        $this->parser->parse('admin/v-index-admin', $data);  
    }

}

 ?>