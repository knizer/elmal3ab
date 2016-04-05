<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stadiums_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function add_stadiums_item($user_id, $title, $description, $address, $phone, $workhours_from, $workhours_to,
                                      $ground_type, $hour_price, $image, $main_album, $video_link, $published)
    {
        $published_by_id = ($published == 1) ? $user_id : 0;
		$published_at = ($published == 1) ? date("Y-m-d H:i:s") : NULL;
        $sql = "INSERT INTO `stadiums` (`user_id`, `title`, `description`, `address`, `phone`, `workhours_from`, `workhours_to`,
                                        `ground_type`, `hour_price`, `image`, `main_album`, `video_link`, `published`, `published_by_id`, `published_at`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, array($user_id, $title, $description, $address, $phone, $workhours_from, $workhours_to,
                                     $ground_type, $hour_price, $image, $main_album, $video_link, $published, $published_by_id,
                                     $published_at));
    }

	public function update_stadiums_item($title, $description, $address, $phone, $workhours_from, $workhours_to,
                                         $ground_type, $hour_price, $image, $main_album, $video_link, $published, $published_here,
                                         $unpublished_here, $id)
    {
		if ($published_here)
		{
			$sql = "UPDATE `stadiums` SET `title` = ?, `description` = ?, `address` = ?, `phone` = ?, `workhours_from` = ?, `workhours_to` = ?,
            `ground_type` = ?, `hour_price` = ?, `image` = ?, `main_album` = ?, `video_link` = ?, `published` = 1, `published_at` = NOW() WHERE `id` = ?";
			$this->db->query($sql, array($title, $description, $address, $phone, $workhours_from, $workhours_to,
                                         $ground_type, $hour_price, $image, $main_album, $video_link, $id));
		}
		elseif ($unpublished_here)
		{
            $sql = "UPDATE `stadiums` SET `title` = ?, `description` = ?, `address` = ?, `phone` = ?, `workhours_from` = ?, `workhours_to` = ?,
            `ground_type` = ?, `hour_price` = ?, `image` = ?, `main_album` = ?, `video_link` = ?, `published` = 0, `published_at` = ? WHERE `id` = ?";
			$this->db->query($sql, array($title, $description, $address, $phone, $workhours_from, $workhours_to,
                                         $ground_type, $hour_price, $image, $main_album, $video_link,NULL, $id));
		}
		else
		{
            $sql = "UPDATE `stadiums` SET `title` = ?, `description` = ?, `address` = ?, `phone` = ?, `workhours_from` = ?, `workhours_to` = ?,
            `ground_type` = ?, `hour_price` = ?, `image` = ?, `main_album` = ?, `video_link` = ? WHERE `id` = ?";
			$this->db->query($sql, array($title, $description, $address, $phone, $workhours_from, $workhours_to,
                                         $ground_type, $hour_price, $image, $main_album, $video_link, $id));
		}
    }

	public function get_stadiums($offset, $limit)
    {
        $sql = "SELECT * FROM `stadiums` ORDER BY `created_date` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($offset, $limit));
        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }


	public function retrieveCustomDatabyID($table, $id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row_array();
    }

	public function search_stadiums($query, $offset, $limit)
    {
        $sql = "SELECT * FROM `stadiums` WHERE `title` LIKE CONCAT('%', ?, '%') ORDER BY `created_date` DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($query, $offset, $limit));
        return ($query->num_rows() >= 1) ? $query->result_array() : FALSE;
    }

}
