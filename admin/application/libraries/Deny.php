<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deny {

    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }

    private function logged_in()
    {
        return $this->CI->session->userdata("logged_in");
    }

    public function deny_if_logged_in()
    {
        if ($this->logged_in() === TRUE) redirect(ROOT);
    }

    public function deny_if_logged_out()
    {
        if ($this->logged_in() === FALSE)
        {
            redirect(ROOT . "login");
        }

        if (strpos($_SERVER['REQUEST_URI'], "change_password") === FALSE && strpos($_SERVER['REQUEST_URI'], "logout") === FALSE)
        {
            $user_id = $this->CI->session->userdata("id");
            $user_password_hash = $this->CI->common_model->get_info_by_token("users_details", "password", "id", $user_id);

            if (password_verify("123456", $user_password_hash))
            {
                redirect(ROOT . "change_password");
            }
        }
    }

}


/* End of file Deny.php */
/* Location: ./application/libraries/Deny.php */
