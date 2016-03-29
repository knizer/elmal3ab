<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        
    }
    
    
    public function index()
    {
		$data = array();
		
		$this->load->view("");
    }
	
}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */