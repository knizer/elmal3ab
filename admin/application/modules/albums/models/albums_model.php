<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function create_album($title, $photographer, $main_image, $created_by, $published)
    {
		$published_by = ($published == 1) ? $created_by : NULL;
		$published_at = ($published == 1) ? date("Y-m-d H:i:s") : NULL;

        $sql = "INSERT INTO `albums` (`title`, `photographer`, `main_image`, `created_by`, `published`, `published_by`, `published_at`)
				VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, array($title, $photographer, $main_image, $created_by, $published, $published_by, $published_at));

        return $this->db->insert_id();
    }


	public function update_album($title, $photographer, $main_image, $published, $published_here, $unpublished_here, $id)
    {
		if ($published_here == 1)
		{
			$published_by = $this->session->userdata("name");

			$sql = "UPDATE `albums` SET `title` = ?, `photographer` = ?, `main_image` = ?, `published` = ?, `published_by` = ?, `published_at` = NOW()
					WHERE `id` = ?";
			$query = $this->db->query($sql, array($title, $photographer, $main_image, $published, $published_by, $id));
		}
		elseif ($unpublished_here == 1)
		{
			$sql = "UPDATE `albums` SET `title` = ?, `photographer` = ?, `main_image` = ?, `published` = ?, `published_by` = ?, `published_at` = ?
					WHERE `id` = ?";
			$query = $this->db->query($sql, array($title, $photographer, $main_image, $published, NULL, NULL, $id));
		}
		else
		{
			$sql = "UPDATE `albums` SET `title` = ?, `photographer` = ?, `main_image` = ?, `published` = ?
					WHERE `id` = ?";
			$query = $this->db->query($sql, array($title, $photographer, $main_image, $published, $id));
		}
    }


	public function get_albums($offset, $limit)
    {
        $sql = "SELECT * FROM `albums` ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));

        if ($query->num_rows() >= 1)
        {
            $result = $query->result_array();

            // Changing the array to make some values human-readable
            foreach ($result as &$row)
            {
                $row["created_at"] = human_timing($row["created_at"]);
            }

            return $result;
        }
        else
        {
            return FALSE;
        }
    }


	public function search_albums($token_type, $token_value, $offset, $limit)
    {
        $sql = "SELECT * FROM `albums` WHERE `$token_type` LIKE CONCAT('%', ?, '%') ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($token_value, $offset, $limit));

        if ($query->num_rows() >= 1)
        {
            $result = $query->result_array();

            // Changing the array to make some values human-readable
            foreach ($result as &$row)
            {
                $row["created_at"] = human_timing($row["created_at"]);
            }

            return $result;
        }
        else
        {
            return FALSE;
        }
    }


	public function get_album_details($id)
	{
		$sql = "SELECT * FROM `albums` WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		if ($query->num_rows() >= 1)
		{
			$row = $query->row_array();
            $row["created_at"] = human_timing($row["created_at"]);
			if ( ! is_null($row["published_at"])) $row["published_at"] = human_timing($row["published_at"]);

			return $row;
		}
		else
		{
			return FALSE;
		}
	}


	public function image_already_assigned_to_album($image_id, $album_id)
	{
		$sql = "SELECT * FROM `album_images` WHERE `image_id` = ? AND `album_id` = ?";
		$query = $this->db->query($sql, array($image_id, $album_id));

		if ($query->num_rows() >= 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function assign_image_to_album($image_id, $image_name, $album_id)
	{
		$sql = "INSERT INTO `album_images` (`image_id`, `image_name`, `album_id`) VALUES (?, ?, ?)";
		$query = $this->db->query($sql, array($image_id, $image_name, $album_id));
	}


	public function remove_image_from_album($image_id, $album_id)
	{
		$sql = "DELETE FROM `album_images` WHERE `image_id` = ? AND `album_id` = ?";
		$query = $this->db->query($sql, array($image_id, $album_id));
	}

}


/* End of file albums_model.php */
/* Location: ./application/modules/albums/models/albums_model.php */
