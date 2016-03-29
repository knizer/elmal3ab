<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	public function __construct()
    {
        parent::__construct();

    }


    public function index()
    {
		$data = array();
        $data['title'] = "الملعب";
        $this->load->view('home_page_view', $data);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
