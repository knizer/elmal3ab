<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    // public function get_all($table, $A_OR_Z, $limit)
    // {
    //     $sql = "SELECT * FROM `$table` ORDER BY `id` $A_OR_Z LIMIT $limit";
    //     $query = $this->db->query($sql);
    //
    //     return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    // }

    // public function login($username, $password)
    // {
    //     $password = md5($password);
    //     $sql = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
    //     $query = $this->db->query($sql, array($username, $password));
    //
    //     return ($query->num_rows() >= 1) ? $query->row_array() : FALSE;
    // }

}

// for rows
// return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;

// for row
// return ($query->num_rows() >= 1) ? $query->row_array() : FALSE;

/* End of file login_model.php */
/* Location: ./application/modules/home/models/login_model.php */
