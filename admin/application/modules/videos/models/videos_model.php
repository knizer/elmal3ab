<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function add_new($video_type, $user_id, $title, $author_name, $img, $link, $publish)
    {
		$published_by_id = ($publish == 1) ? $user_id : 0;
		$published_at = ($publish == 1) ? date("Y-m-d H:i:s") : NULL;
        $db = $this->load->database('default', TRUE);
        $db->insert('videos',  array('video_type'=>$video_type, 'user_id'=>$user_id, 'title'=>$title,
                                     'author'=>$author_name, 'image'=>$img, 'link'=>$link, 'published'=>$publish,
                                     'published_by_id'=>$published_by_id, 'published_at'=>$published_at));
        return $db->insert_id();
    }


	public function edit($video_type, $user_id, $title, $author_name, $img, $link, $publish, $published_here, $unpublished_here, $id)
    {
		$published_by_id = ($published_here == 1) ? $last_modified_by_id : NULL;
		$published_at = ($published_here == 1) ? date("Y-m-d H:i:s") : NULL;
    	$this->db->where('id',$id);
		if ($published_here == 1)
		{
			$this->db->update('videos', array('video_type'=>$video_type, 'user_id'=>$user_id, 'title'=>$title,
                                              'author'=>$author_name, 'image'=>$img, 'link'=>$link, 'published'=>$publish,
                                              'published_by_id'=>$published_by_id, 'published_at'=>$published_at));
		}
		elseif ($unpublished_here == 1)
		{
			$this->db->update('videos', array('video_type'=>$video_type, 'user_id'=>$user_id, 'title'=>$title,
                                              'author'=>$author_name, 'image'=>$img, 'link'=>$link, 'published'=>$publish,
                                              'published_by_id'=>0, 'published_at'=>''));
		}
		else
		{
			$this->db->update('videos', array('video_type'=>$video_type, 'user_id'=>$user_id, 'title'=>$title,
                                              'author'=>$author_name, 'image'=>$img, 'link'=>$link, 'published'=>$publish,
                                              'published_by_id'=>$published_by_id, 'published_at'=>$published_at));
		}
	}


    public function delete_video($id)
    {
        $sql = "DELETE FROM `videos` WHERE `id` = ?";
		$this->db->query($sql, array($id));
	}


	public function retrieveCustomDatabyID($table, $id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row_array();
    }


	public function countData($published,$table, $search_query)
	{
		$this->db->where('published',$published);
		$this->db->like('title',$search_query);
		return $this->db->count_all_results($table);
    }


    public function retrieveDataPaging($start,$limit, $search_query)
	{
		$query =$this->db->query("SELECT * FROM `videos` where title like '%".$search_query."%' order by id desc limit ".$start.",".$limit." ");
		return $query->result();
    }


	public function get_videos_list($start, $limit)
	{
		$query =$this->db->query("SELECT * FROM `videos` order by id desc limit ".$start.",".$limit);
		return $query->result_array();
    }


	public function search_videos($columnn, $query, $current_page, $per_page)
	{
		$query =$this->db->query("SELECT * FROM `videos` where ".$columnn." like '%".$query."%' order by id desc limit ".$current_page.",".$per_page);
		return $query->result_array();
    }


	public function count_search_data($query)
	{
		$this->db->like('title', $query);
		return $this->db->count_all_results('videos');
    }

	public function count_data()
	{
		return $this->db->count_all_results('videos');
    }

    public function update_image_used_flag($image_token, $token_value, $action)
    {
        /* Updates the images "used" flag depending on the $action parameter, TRUE adds one, FALSE subtracts 1 */
        if ($action)
            $sql = "UPDATE `images` SET `times_used` = `times_used` + 1 WHERE `$image_token` = ?";
        elseif ( ! $action)
            $sql = "UPDATE `images` SET `times_used` = `times_used` - 1 WHERE `$image_token` = ?";

        $query = $this->db->query($sql, array($token_value));
    }

}


/* End of file paper_model.php */
/* Location: ./application/modules/paper_version/models/paper_model.php */
