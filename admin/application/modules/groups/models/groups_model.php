<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function insert_group($name, $stadiums, $images_albums, $videos, $users_groups)
    {
        $sql = "INSERT INTO `groups` (`name`, `stadiums`, `images_albums`, `videos`, `users_groups`)
                VALUES (?, ?, ?, ?, ?)";

        $query = $this->db->query($sql, array($name, $stadiums, $images_albums, $videos, $users_groups));
        return $this->db->insert_id();
    }


    private function update_permissions_of_users_in_group($stadiums, $images_albums, $videos, $users_groups, $group_id)
    {
        $sql = "UPDATE `users_permissions` SET `stadiums` = ?, `images_albums` = ?, `videos` = ?, `users_groups` = ?
        WHERE `group_id` = ?";

        $query = $this->db->query($sql, array($stadiums, $images_albums, $videos, $users_groups, $group_id));
    }


    public function update_group($name, $stadiums, $images_albums, $videos, $users_groups, $group_id)
    {
        $sql = "UPDATE `groups` SET `name` = ?, `stadiums` = ?, `images_albums` = ?, `videos` = ?, `users_groups` = ?
        WHERE `id` = ?";

        $query = $this->db->query($sql, array($name, $stadiums, $images_albums, $videos, $users_groups, $group_id));

        // Also update permissions of all users with given group
        $this->update_permissions_of_users_in_group($stadiums, $images_albums, $videos, $users_groups, $group_id);
    }


    public function get_groups($offset, $limit)
    {
        $sql = "SELECT * FROM `groups` ORDER BY `id` DESC LIMIT ?, ?";
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


	public function search_groups($token_type, $token_value, $offset, $limit)
    {
        $sql = "SELECT * FROM `groups` WHERE `$token_type` LIKE CONCAT('%', ?, '%') ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($token_value, $offset, $limit));

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


/* End of file groups_model.php */
/* Location: ./application/modules/groups/models/groups_model.php */
