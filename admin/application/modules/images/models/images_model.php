<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function upload_image($name, $uploaded_by, $session_id)
    {
        $sql = "INSERT INTO `images` (`name`, `uploaded_by`, `session_id`) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($name, $uploaded_by, $session_id));

        return $this->db->insert_id();
    }


	public function update_image_info($description, $watermarked, $id)
    {
        $sql = "UPDATE `images` SET `description` = ?, `watermarked` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, array($description, $watermarked, $id));
    }


	public function mark_image_as_used($id)
	{
		$sql = "UPDATE `images` SET `used` = 1 WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));
	}


	public function update_watermarked_flag($id, $value)
	{
		$sql = "UPDATE `images` SET `watermarked` = ? WHERE `id` = ?";
		$query = $this->db->query($sql, array($value, $id));
	}


    public function get_images($offset, $limit)
    {
        $sql = "SELECT * FROM `images` where description <> '' ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));

        if ($query->num_rows() >= 1)
        {
            $result = $query->result_array();

            // Changing the array to make some values human-readable
            foreach ($result as &$row)
            {
                $row["uploaded_at"] = human_timing($row["uploaded_at"]);
            }

            return $result;
        }
        else
        {
            return FALSE;
        }
    }


	public function get_image_details($id)
	{
		$sql = "SELECT * FROM `images` WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		if ($query->num_rows() >= 1)
		{
			$row = $query->row_array();

            // Changing the array to make some values human-readable
			$row["uploaded_at"] = human_timing($row["uploaded_at"]);

            return $row;
		}
		else
		{
			return FALSE;
		}
	}


	public function search_images($token_type, $token_value, $offset, $limit)
    {
        $sql = "SELECT * FROM `images` WHERE `$token_type` LIKE CONCAT('%', ?, '%') and description <> '' ORDER BY `id` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($token_value, $offset, $limit));

        if ($query->num_rows() >= 1)
        {
            $result = $query->result_array();

            // Changing the array to make some values human-readable
            foreach ($result as &$row)
            {
                $row["uploaded_at"] = human_timing($row["uploaded_at"]);
            }

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

}


/* End of file images_model.php */
/* Location: ./application/modules/images/models/images_model.php */
