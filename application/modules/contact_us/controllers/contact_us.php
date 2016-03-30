<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$data = array();
        $data['title'] = "اتصل بنا";

        $this->load->view('contact_us_view', $data);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
