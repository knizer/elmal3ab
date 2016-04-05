<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    // for any variable average
    private function average($avr_array)
    {
        if($avr_array)
        {
            $rate = array();
            foreach($avr_array as $value)
            {
                foreach($value as $key => $number)
                {
                    (!isset($res[$key])) ? $res[$key] = $number : $res[$key] += $number;
                }
            }
            $average =  round($res['rate'] / count($avr_array));
            return "$average";
        }
        else
        {
            return "0";
        }
    }

    public function index()
    {
		$data = array();
        $data['title'] = "الملعب";

        $latest_stadiums = $this->home_model->get_latest("stadiums", "created_date", "3");
        if ($latest_stadiums) $data['latest_stadiums'] = $latest_stadiums;

        $featured_albums = $this->home_model->get_featured_albums();
        if ($featured_albums) $data['featured_albums'] = $featured_albums;

        $stadiums_high_rate = $this->home_model->get_stadiums_high_rates();
        if ($stadiums_high_rate) $data['stadiums_high_rate'] = $stadiums_high_rate;

        $this->load->view('home_page_view', $data);
    }

    public function login()
    {
        $this->load->library('facebook');
        $user = $this->facebook->getUser();

        if ($user)
        {
            $user_profile = $this->facebook->api('/me');
            $this->session->set_userdata('logged_in', TRUE);
            $this->session->set_userdata('user_id', $user_profile['id']);
            $this->session->set_userdata('user_name', $user_profile['name']);
            redirect(SITE_URL);
        }
        else
        {
            $login_url = $this->facebook->getLoginUrl(array(
                'redirect_uri' => SITE_URL . 'login',
                'scope' => array("email")
            ));
            redirect($login_url);
            $this->facebook->destroySession();
        }
    }

    public function logout()
    {
        $this->load->library('facebook');
        $this->facebook->destroySession();
        $this->session->sess_destroy();
        redirect(SITE_URL);
    }

}


/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
