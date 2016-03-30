<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stadiums extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('stadiums_model');
    }

    public function index()
    {
		$data = array();
        $data['title'] = "ملاعب";

        $this->load->view('stadiums_view', $data);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
