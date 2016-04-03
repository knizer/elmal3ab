<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {
		$data = array();
        $data['title'] = "الملعب";

        $latest_stadiums = $this->home_model->get_latest("stadiums", "created_date", "3");
        if ($latest_stadiums) $data['latest_stadiums'] = $latest_stadiums;

        $featured_albums = $this->home_model->get_featured_albums();
        if ($featured_albums) $data['featured_albums'] = $featured_albums;

        $this->load->view('home_page_view', $data);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
