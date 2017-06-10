<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teamback extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper('session');
		$this->load->library('pagination');
		$this->load->library('sessionchecker');
        $this->sessionchecker->checkloggedin();
		$this->hakakses = $this->gethakakses();

	}

	public function index()
	{
	}

}
?>