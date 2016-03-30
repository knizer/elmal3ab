<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('albums_model');
    }

    public function index()
    {
		$data = array();
        $data['title'] = "ألبومات الصور";

        $this->load->view('albums_view', $data);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
