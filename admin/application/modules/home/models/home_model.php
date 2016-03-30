<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
    
	public function __construct()
    {
        parent::__construct();
    }
    
    
    public function login($username, $password)
    {
        $sql = "SELECT * FROM `users_details` WHERE `username` = ?";
        $query = $this->db->query($sql, array($username));
		
		if ($query->num_rows() >= 1)
		{
			$row = $query->row_array();
			$stored_hash = $row["password"];
			
			if (password_verify($password, $stored_hash))
			{
				return $row;
			}
			else
			{
				return FALSE;
			}
		}
        else
        {
            return FALSE;
        }
    }
    
	
	public function update_user_password($new_password, $user_id)
    {
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		
        $sql = "UPDATE `users_details` SET `password` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, array($new_password, $user_id));
    }
    
    
    public function update_user_picture($new_picture, $user_id)
    {
        $sql = "UPDATE `users_details` SET `picture` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, array($new_picture, $user_id));
    }
	
}


/* End of file login_model.php */
/* Location: ./application/modules/home/models/login_model.php */