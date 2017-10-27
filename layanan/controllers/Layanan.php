<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends MX_Controller {

	public function __construct() {
        
        $this->load->library('parser');
    }

	// fungsi untuk detail layanan try out
    public function tryout()
    {
        $data = array(
            'judul_halaman' => 'Sibejoo - Try Out',
            'judul_header' => 'Layanan Try Out',
            );

        $konten = 'modules/layanan/views/r-layanan-to.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header-detail.php',
            APPPATH . $konten,
            APPPATH . 'modules/templating/views/r-footer.php',
            );

        $this->parser->parse('templating/r-index-login', $data);
    }

    // fungsi untuk detail layanan video
    public function video()
    {
        $data = array(
            'judul_halaman' => 'Sibejoo | Video',
            'judul_header' => 'Layanan Video',
            );

        $konten = 'modules/layanan/views/r-layanan-video.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . $konten,
            APPPATH . 'modules/homepage/views/r-footer.php',
            );

        $this->parser->parse('r-index-layanan', $data);
    }

    // fungsi untuk detail layanan video
    public function edudrive()
    {
        $data = array(
            'judul_halaman' => 'Edu Drive | Sibejoo Heroo',
            'judul_header' => 'Layanan Edu Drive',
            );

        $konten = 'modules/layanan/views/r-layanan-edudrive.php';

        $data['files'] = array(
            APPPATH . 'modules/homepage/views/r-header.php',
            APPPATH . $konten,
            APPPATH . 'modules/homepage/views/r-footer.php',
            );

        $this->parser->parse('r-index-layanan', $data);
    }
}

?>