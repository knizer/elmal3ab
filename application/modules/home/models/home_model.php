<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_featured_albums()
    {
        $sql = "SELECT * FROM `albums` INNER JOIN `featured_albums` on albums.id = featured_albums.album_id ORDER BY `album_id` DESC LIMIT 6";
        $query = $this->db->query($sql);

        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }

}

// for rows
// return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;

// for row
// return ($query->num_rows() >= 1) ? $query->row_array() : FALSE;

/* End of file login_model.php */
/* Location: ./application/modules/home/models/login_model.php */
