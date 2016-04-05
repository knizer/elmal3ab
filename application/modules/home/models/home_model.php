<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_latest($table, $orderd_by, $limit)
    {
        $sql = "SELECT * FROM `$table` ORDER BY `$orderd_by` DESC LIMIT $limit";
        $query = $this->db->query($sql, array($table, $orderd_by, $limit));

        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }

    public function get_featured_albums()
    {
        $sql = "SELECT * FROM `albums` INNER JOIN `featured_albums` on albums.id = featured_albums.album_id ORDER BY `album_id` DESC LIMIT 6";
        $query = $this->db->query($sql);

        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }

    public function get_stadiums_high_rates()
    {
        $sql = "SELECT stadiums.id,stadiums.title, stadiums.description, stadiums.image, avg(stadiums_rate.rate) as avg FROM `stadiums`
        	   INNER JOIN `stadiums_rate` ON `stadiums`.id=`stadiums_rate`.stadium_id group by stadiums_rate.stadium_id order by avg DESC LIMIT 3";

        $query = $this->db->query($sql);

        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }

}


/* End of file login_model.php */
/* Location: ./application/modules/home/models/login_model.php */
