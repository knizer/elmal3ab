<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    private function insert_user_permissions($user_id, $group_id, $stadiums, $images_albums, $videos, $users_groups)
    {
        $sql = "INSERT INTO `users_permissions` (`user_id`, `group_id`, `stadiums`, `images_albums`, `videos`, `users_groups`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $query = $this->db->query($sql, array($user_id, $group_id, $stadiums, $images_albums, $videos, $users_groups));
    }


    public function insert_user($name, $group_id, $picture, $username, $password, $mobile, $email)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users_details` (`name`, `group_id`, `picture`, `username`, `password`, `mobile`, `email`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $query = $this->db->query($sql, array($name, $group_id, $picture, $username, $password, $mobile, $email));
        $insert_id = $this->db->insert_id();

        // Get user group's permissions and copy them for user
        $group = $this->common_model->get_subject_with_token("groups", "id", $group_id);
        if ($group)
        {
            extract($group);
            $this->insert_user_permissions($insert_id, $group_id, $stadiums, $images_albums, $videos, $users_groups);
        }

        return $insert_id;
    }


    public function update_user_info($name, $group_id, $mobile, $email, $user_id)
    {
        $sql = "UPDATE `users_details` SET `name` = ?, `group_id` = ?, `mobile` = ?, `email` = ?
                WHERE `id` = ?";
        $query = $this->db->query($sql, array($name, $group_id, $mobile, $email, $user_id));
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


    public function update_user_permissions($stadiums, $images_albums, $videos, $users_groups, $user_id)
    {
        $sql = "UPDATE `users_permissions` SET `stadiums` = ?, `images_albums` = ?, `videos` = ?, `users_groups` = ?
        WHERE `user_id` = ?";

        $query = $this->db->query($sql, array($stadiums, $images_albums, $videos, $users_groups, $user_id));
    }

    private function update_user_group($group_id, $user_id)
    {
        $sql = "UPDATE `users_permissions` SET `group_id` = ? WHERE `user_id` = ?";
        $query = $this->db->query($sql, array($group_id, $user_id));
    }

    public function update_user_group_and_permissions($group_id, $user_id)
    {
        $this->update_user_group($group_id, $user_id);

        // Get user group's permissions and copy them for user
        $group = $this->common_model->get_subject_with_token("groups", "id", $group_id);
        if ($group)
        {
            extract($group);
            $this->update_user_permissions($stadiums, $images_albums, $videos, $users_groups, $user_id);
        }
    }


    public function get_user_details($id)
    {
        $sql = "SELECT * FROM `users_details` WHERE `id` = ?";
        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() >= 1)
        {
            $row = $query->row_array();
            $row["group_name"] = $this->common_model->get_info_by_token("groups", "name", "id", $row["group_id"]);

            return $row;
        }
        else
        {
            return FALSE;
        }
    }


    public function get_users($offset, $limit)
    {
        $sql = "SELECT * FROM `users_details` ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));

        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }


    public function get_search_rows_count($query)
    {
        $sql = "SELECT COUNT(`id`) AS `count` FROM `users_details` WHERE `username` LIKE '%$query%' OR `name` LIKE '%$query%'";
        $query = $this->db->query($sql);
        $count = $query->row_array();
        return $count["count"];
    }


	public function search_users($token_value, $offset, $limit)
    {
        $sql = "SELECT * FROM `users_details` WHERE `username` LIKE '%$token_value%' OR `name` LIKE '%$token_value%' ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));

        if ($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

}


/* End of file users_model.php */
/* Location: ./application/modules/users/models/users_model.php */
