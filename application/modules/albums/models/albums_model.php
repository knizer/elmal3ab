<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_albums($offset, $limit)
    {
        $sql = "SELECT * FROM `albums` WHERE `published` = 1
                ORDER BY `created_at` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));
        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }
}

/* End of file login_model.php */
/* Location: ./application/modules/home/models/login_model.php */
