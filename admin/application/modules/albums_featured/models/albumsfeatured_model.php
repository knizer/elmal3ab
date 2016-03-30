<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albumsfeatured_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
       
    }
    
	
	private function copy_to_news_history($news_item_id, $title, $content, $modified_by_id, $created_here,
										  $published_here, $unpublished_here, $time_spent_editing)
	{
		/* This function is only accessed from inside the class */
		$sql = "INSERT INTO `news_history` (`news_item_id`, `title`, `content`, `modified_by_id`,
				`modified_at`, `created_here`, `published_here`, `unpublished_here`, `time_spent_editing`)
                VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?)";
        $query = $this->db->query($sql, array($news_item_id, $title, $content, $modified_by_id, $created_here,
											  $published_here, $unpublished_here, $time_spent_editing));
	}
	
        public function retrieveData($offset, $perpage){
		$this->db->where('published', 1);
                $this->db->order_by('published_at', 'desc');
        $query = $this->db->get('albums', $perpage, $offset);
        return $query->result();
    }
	
	  public function retrieveDataSearch($query, $offset, $perpage){
		$this->db->where('published', 1);
                $this->db->order_by('published_at', 'desc');
		$this->db->like('title', $query);
        $query = $this->db->get('albums', $perpage, $offset);
        return $query->result();
    }
    
     public function countData($query=''){
		$this->db->like('title', $query);
		$this->db->where('published', 1);
                $this->db->order_by('published_at', 'desc');
     return $this->db->count_all_results('albums');
        
    }
	
	public function countDataTv($table){
     
     return $this->db->count_all_results($table);
        
    }
    
      public function retrieveListData($table)
    {
             $query =$this->db->query("SELECT * FROM `albums`,featured_albums WHERE albums.id=featured_albums.album_id order by albums.published_at desc");
            return $query->result();
            
    }
	
	public function retrieveListTv($list_id)
    {
             $query =$this->db->query("SELECT * FROM `videos`,featured_news WHERE videos.id=featured_news.article_id and featured_news.sec_id=".$list_id);
            return $query->result();
            
    }
    
     public function retrieveDataPaging($start,$limit){
          //$this->db->where('id',$id);
      //$query=$this->db->get($table, $limit,$start);
     
       $query =$this->db->query("SELECT * FROM `news` WHERE `id` NOT IN (SELECT `article_id` FROM `featured_news` ) and published=1 and is_deleted=0 order by id desc limit ".$start.",".$limit);
        return $query->result();
    }
	
	 public function retrieveDataPagingTv($start,$limit){
          //$this->db->where('id',$id);
      //$query=$this->db->get($table, $limit,$start);
     
       $query =$this->db->query("SELECT * FROM `videos` where published=1 and deleted=0  order by id desc limit ".$start.",".$limit);
        return $query->result();
    }
    
      public function countDataSearch($table,$query){
     
       $this->db->where('`id` NOT IN (SELECT `article_id` FROM `featured_news`) and published=1 and is_deleted=0  '.$query);
     return $this->db->count_all_results($table);
        
    }
	
	 public function countDataSearchTv($table,$query){
     
       $query = $this->db->query('select * from videos where published=1 and deleted=0  '.$query);
     return $query->num_rows();
        
    }
    
     public function retrieveSubsections($sec_id)
    { 
         
         $this->db->where('section_id',$sec_id);
   
            $query=$this->db->get('subsections');
             
            return $query->result();
            
    }
    
    public function retrieveDataSearchPaging($query,$start,$limit){
          //$this->db->where('id',$id);
      //$query=$this->db->get($table, $limit,$start);
     
       $query =$this->db->query("SELECT * FROM `news` WHERE `id` NOT IN (SELECT `article_id` FROM `featured_news`)  and published=1 and is_deleted=0   ".$query."  order by id desc  limit ".$start.",".$limit);
      
        return $query->result();
    }
	
	 public function retrieveDataSearchPagingTv($query,$start,$limit){
          //$this->db->where('id',$id);
      //$query=$this->db->get($table, $limit,$start);
     
       $query =$this->db->query("SELECT * FROM `videos` WHERE  published=1 and deleted=0  ".$query." order by id desc limit ".$start.",".$limit);
       
        return $query->result();
    }
    
    public function retrieveCustomDatabyID($table,$id)
    {
            $this->db->where('id',$id);
            $query=$this->db->get($table);
            return $query->result();
            
    }
    
      public function delOldData()
    {
             $query =$this->db->query("DELETE FROM featured_albums");
         
            
    }
    
      
        function addFeaturedToLost($album_id)

    {
             $db = $this->load->database('default', TRUE);
             $db->insert('featured_albums',  array('album_id'=>$album_id));
            return $db->insert_id();
    }
    
    
}


/* End of file featured_model.php */
/* Location: ./application/modules/featured_news/models/featured_model.php */