<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
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

        return $result == 1;
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

        $sql = "SELECT * FROM `$table` WHERE `$token_type` LIKE CONCAT('%', ?, '%')";
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
        /* Returns count of all rows in a table. Returns a number. */

        $sql = "SELECT COUNT(`id`) AS `count` FROM `$table`";
        $query = $this->db->query($sql);
        $count = $query->row_array();
        return $count["count"];
    }


    public function get_search_rows_count($table, $search_clause, $search_value)
    {
        /* Returns count of all rows in a table that match a search clause. Returns a number. */

        $sql = "SELECT COUNT(`id`) AS `count` FROM `$table` WHERE `$search_clause` LIKE CONCAT('%', ?, '%')";
        $query = $this->db->query($sql, array($search_value));
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


    public function get_user_unseen_message_count($user_id)
    {
        /* Gets count of unseen user messages. */

		$sql = "SELECT COUNT(`id`) AS `count` FROM `messages` WHERE `receiver_id` = ? AND `seen` = 0 AND `hide_from_receiver` = 0";
        $query = $this->db->query($sql, array($user_id));

        $row = $query->row_array();
        return $row["count"];
    }


    public function get_user_news_this_week_count($user_id, $published_flag)
	{
		$sql = "SELECT COUNT(`id`) AS `count` FROM `news` WHERE `created_by_id` = ? AND `published` = ? AND `created_at` <= NOW() AND `created_at` >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $query = $this->db->query($sql, array($user_id, $published_flag));
        $count = $query->row_array();
        return $count["count"];
	}


    public function authorized_to_view_page($page_session_variable)
    {
        /* This method gets called on every method of every controller with permissions enabled, and either returns FALSE
         * and shows a permission denied page or else returns TRUE to allow controllers' methods execution to carry on. */

		if ($this->session->userdata($page_session_variable) == 0)
		{
			$this->load->view("permission_denied_view");
			return FALSE;
		}

        return TRUE;
    }


    public function user_authorized_to_view_page($allowed_users)
    {
        /* This method does the same functionality as the previous one but while passed an array of authorized users */

        $user_id = $this->session->userdata("id");
		if ( ! in_array($user_id, $allowed_users))
		{
			$this->load->view("permission_denied_view");
			return FALSE;
		}

        return TRUE;
    }

}


/* End of file common_model.php */
/* Location: ./application/models/common_model.php */
