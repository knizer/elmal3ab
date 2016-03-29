<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function log_action($user_id, $username, $action_description, $subject_type, $subject_id, $subject_info_1 = "", $subject_info_2 = "")
    {
        /* Used throughout the application to log different actions.
         * $subject_info_1 and $subject_info_2 are optional varchar fields and their values depend on the action being logged. */
        
        $sql = "INSERT INTO `logs` (`user_id`, `username`, `action_description`, `subject_type`, `subject_id`, `subject_info_1`, `subject_info_2`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, array($user_id, $username, $action_description, $subject_type, $subject_id, $subject_info_1, $subject_info_2));
    }
    
    
    public function get_info_by_token($table, $info, $token_type, $token_value)
    {
        /* This is a highly abstracted function that can return a specific piece of
         * info ($info) from a specific table given a token to identify
         * the subject with ($token_type and $token_value).
         * Returns a string. */
        
        $sql = "SELECT `$info` FROM `$table` WHERE `$token_type` = ?";
        $query = $this->db->query($sql, array($token_value));
        
        if ($query->num_rows() >= 1)
        {
            $row = $query->row_array();
            return $row[$info];
        }
        else
        {
            return FALSE;
        }
    }
    
    
    public function subject_exists($table, $token_type, $token_value)
    {
        /* Checks if a subject exists given a token type and value to identify it with.
         * Subject can be from any table.
         * Returns TRUE or FALSE. */
        
        $sql = "SELECT EXISTS(SELECT 1 FROM `$table` WHERE `$token_type` = ?)";
        $query = $this->db->query($sql, array($token_value));
        
        $row = $query->row_array();
        $keys = array_keys($row);
        $key = $keys[0];
        $result = $row[$key];
        
        if ($result == 1)
        {
            return TRUE;
        }
        elseif ($result == 0)
        {
            return FALSE;
        }
    }
    
    
    public function get_subject_with_token($table, $token_type, $token_value)
    {
        /* Returns a subject's info given a token type and value to identify it with.
         * Subject can be from any table.
         * Returns a single row (not a multi-dimensional array) */
        
        $sql = "SELECT * FROM `$table` WHERE `$token_type` = ?";
        $query = $this->db->query($sql, array($token_value));
        
        if ($query->num_rows() >= 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }
    
    
    public function get_all_subjects_with_token($table, $token_type, $token_value)
    {
        /* Returns all subjects' info given a token type and value to identify them with.
         * Subjects can be from any table.
         * Returns a multi-dimensional array */
        
        $sql = "SELECT * FROM `$table` WHERE `$token_type` = ?";
        $query = $this->db->query($sql, array($token_value));
        
        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
    
    
    public function search($table, $token_type, $token_value)
    {
        /* Returns all subjects' info LIKE a value given a token type and value.
         * Subjects can be from any table.
         * Returns a multi-dimensional array */
    }
    
    
    public function get_all_from_table($table, $options = array())
    {
        /* Returns all rows from any table.
         * Can be passed an array of options to limit or order the data.
         * Returns a multi-dimensional array. */
        
        $sql = "SELECT * FROM `$table`";
        
        if (array_key_exists("order_by", $options) && ! array_key_exists("limit", $options))
        {
            $order_by = $options["order_by"];
            $direction = $options["direction"];
            $sql = "SELECT * FROM `$table` ORDER BY `$order_by` $direction";
        }
        elseif ( ! array_key_exists("order_by", $options) && array_key_exists("limit", $options))
        {
            $limit = $options["limit"];
            $sql = "SELECT * FROM `$table` LIMIT $limit";
        }
        elseif (array_key_exists("order_by", $options) && array_key_exists("limit", $options))
        {
            $order_by = $options["order_by"];
            $direction = $options["direction"];
            $limit = $options["limit"];
            $sql = "SELECT * FROM `$table` ORDER BY `$order_by` $direction LIMIT $limit";
        }
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
    
    
    public function get_table_rows_count($table)
    {
        /* Returns count of all rows in a table, a number. */
        
        $sql = "SELECT COUNT(`id`) AS `count` FROM `$table`";
        $query = $this->db->query($sql);
        $count = $query->row_array();
        return $count["count"];
    }
    
    
    public function get_table_max_id($table)
    {
        /* Returns the last id in a table, a number. */
        
        $sql = "SELECT MAX(id) AS `max_id` FROM `$table`";
        $query = $this->db->query($sql);
        
        $row = $query->row_array();
        return $row["max_id"];
    }
    
    
    public function delete_subject($table, $token_type, $token_value)
    {
        /* Deletes a subject's info given a token type and value to identify it with.
         * Subject can be from any table */
        
        $sql = "DELETE FROM `$table` WHERE `$token_type` = ?";
        $query = $this->db->query($sql, array($token_value));
    }
    
    
    public function insert_keyword($keyword, $original_id)
    {
        /* Inserts a keyword and an original id in the keywords table after fetching them from youm7.com. */
        
        $sql = "INSERT INTO `news_keywords` (`keyword`, `original_id`) VALUES (?, ?)";
        $query = $this->db->query($sql, array($keyword, $original_id));
    }
    
}


/* End of file common_model.php */
/* Location: ./application/models/common_model.php */