<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Videos_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function add_new($title, $soc_title, $author_name, $date, $link, $breif, $content, $coverage, $tags, $related_videos, $linked_with_article,
							$sections, $user_id, $publish, $img, $video_type)
    {
		$published_by_id = ($publish == 1) ? $user_id : 0;
		$published_at = ($publish == 1) ? date("Y-m-d H:i:s") : NULL;
        $db = $this->load->database('default', TRUE);
        $db->insert('videos',  array('title'=>$title, 'social_title'=>$soc_title, 'author'=>$author_name, 'date'=>$date, 'link'=>$link,
									 'breif'=>$breif, 'description'=>$content, 'coverage_id'=>$coverage, 'tags'=>$tags,
									 'related_videos_ids'=>$related_videos, 'article_id'=>$linked_with_article, 'section_ids'=>$sections,
									 'user_id'=>$user_id, 'published'=>$publish, 'image'=>$img, 'video_type'=>$video_type,
									 'published_by_id'=>$published_by_id, 'published_at'=>$published_at));
        return $db->insert_id();
    }


	public function edit($id, $title, $soc_title, $author_name, $date, $link, $breif, $content, $coverage, $tags, $related_videos, $linked_with_article,
						 $sections, $user_id, $publish, $img, $video_type, $published_here, $unpublished_here, $last_modified_by_id)
    {
		$published_by_id = ($published_here == 1) ? $last_modified_by_id : NULL;
		$published_at = ($published_here == 1) ? date("Y-m-d H:i:s") : NULL;
    	$this->db->where('id',$id);
		if ($published_here == 1)
		{
			$this->db->update('videos', array('title'=>$title, 'social_title'=>$soc_title, 'author'=>$author_name, 'date'=>$date, 'link'=>$link,
											  'breif'=>$breif, 'description'=>$content, 'coverage_id'=>$coverage, 'tags'=>$tags,
											  'related_videos_ids'=>$related_videos, 'article_id'=>$linked_with_article, 'section_ids'=>$sections,
											  'user_id'=>$user_id, 'published'=>$publish, 'image'=>$img, 'video_type'=>$video_type,
											  'published_by_id'=>$published_by_id, 'published_at'=>$published_at, 'last_modified_by_id'=>$last_modified_by_id,
											  'last_modified_at'=>date("Y-m-d H:i:s")));
		}
		elseif ($unpublished_here == 1)
		{
			$this->db->update('videos', array('title'=>$title, 'social_title' => $soc_title, 'author'=>$author_name, 'date'=>$date, 'link'=>$link,
											  'breif'=>$breif, 'description'=>$content, 'coverage_id'=>$coverage, 'tags'=>$tags,
											  'related_videos_ids'=>$related_videos, 'article_id'=>$linked_with_article, 'section_ids'=>$sections,
											  'user_id'=>$user_id, 'published'=>$publish, 'image'=>$img, 'video_type'=>$video_type, 'published_by_id'=>0,
											  'published_at'=>'', 'last_modified_by_id'=>$last_modified_by_id, 'last_modified_at'=>date("Y-m-d H:i:s")));
		}
		else
		{
			$this->db->update('videos', array('title'=>$title, 'social_title' => $soc_title, 'author'=>$author_name, 'date'=>$date, 'link'=>$link,
											  'breif'=>$breif, 'description'=>$content, 'coverage_id'=>$coverage, 'tags'=>$tags,
											  'related_videos_ids'=>$related_videos, 'article_id'=>$linked_with_article, 'section_ids'=>$sections,
											  'user_id'=>$user_id, 'published'=>$publish, 'image'=>$img, 'video_type'=>$video_type,
											  'last_modified_by_id'=>$last_modified_by_id, 'last_modified_at'=>date("Y-m-d H:i:s")));
		}
	}


    public function delete_video($id)
    {
    	$this->db->where('id',$id);
        $this->db->update('videos',  array('deleted' => 1));
	}


	public function retrieveCustomDatabyID($table, $id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->result();
    }


	public function countData($published,$table, $search_query)
	{
		$this->db->where('published',$published);
		$this->db->like('title',$search_query);
		$this->db->where('deleted',0);
		return $this->db->count_all_results($table);
    }


    public function retrieveDataPaging($start,$limit,$status, $search_query)
	{
		$query =$this->db->query("SELECT * FROM `videos` where published=".$status." and deleted=0 and title like '%".$search_query."%' order by id desc limit ".$start.",".$limit." ");
		return $query->result();
    }


	public function get_videos_list($start, $limit)
	{
		$query =$this->db->query("SELECT * FROM `videos` where deleted=0 order by id desc limit ".$start.",".$limit);
		return $query->result_array();
    }


	public function search_videos($columnn, $query, $current_page, $per_page)
	{
		$query =$this->db->query("SELECT * FROM `videos` where ".$columnn." like '%".$query."%' and deleted=0 order by id desc limit ".$current_page.",".$per_page);
		return $query->result_array();
    }


	public function count_search_data($query)
	{
		$this->db->like('title', $query);
		$this->db->where('deleted',0);
		return $this->db->count_all_results('videos');
    }

	public function count_data()
	{
		$this->db->where('deleted',0);
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
