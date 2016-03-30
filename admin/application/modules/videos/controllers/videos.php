<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class videos extends MX_Controller {

    public function __construct()
	{
        parent::__construct();
		error_reporting(0);
		$this->deny->deny_if_logged_out();

        $this->load->model("videos_model");
    }


    public function index()
	{
		redirect(ROOT . "videos/unpublished");
    }


    public function unpublished()
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			if (!is_numeric($this->uri->segment(3)))
			{
				$search_query = trim(strip_tags(urldecode($this->uri->segment(3))));
				$config['uri_segment'] = $start = (int) $this->uri->segment(4);
				$config['uri_segment'] = 4;
			}
			else
			{
				$search_query = "";
				$start = (int) $this->uri->segment(3);
				$config['uri_segment'] = 3;
			}

			if($start == '') $start = 0;
			$videos = $this->videos_model->retrieveDataPaging($start, 10, 0, $search_query);

			$data['count'] = $this->videos_model->countData(0,'videos', $search_query);
			if($search_query != '')
				$config['base_url'] = ROOT . "videos/unpublished/".$search_query;
			else
				$config['base_url'] = ROOT . "videos/unpublished/";

			$config['total_rows'] = $data['count'];
			$config['per_page'] = 10;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);
			$this->pagination->initialize($config);

			$data['paging'] = $this->pagination->create_links();
			foreach ($videos as $video)
			{
				$sections_str='';
				$secArr=explode(',',$video->section_ids);
				foreach($secArr as $sec_id)
				{
					$sec_id=str_replace(array('[',']'),'',$sec_id);
					$section=$this->videos_model->retrieveCustomDatabyID('sections',$sec_id);
					$sections_str.=$section[0]->name.",";
				}
				$date1 = new DateTime($video->published_at);
				$date2 = new DateTime(date("Y-m-d H:i:s"));

				$diff = $date2->diff($date1);

				$hours = $diff->h;
				$hours = $hours + ($diff->days*24);

				if($hours<24 && ($hours!=''))
					$video->published_at = human_timing($video->published_at);

				$video->section_name=$sections_str;
				$videos_[]=$video;
			}
			$data['videos'] = @$videos_;
			$this->load->view("manage_unpublished_videos", $data);
		}
    }


	public function published()
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			if (!is_numeric($this->uri->segment(3)))
			{
				$search_query = trim(strip_tags(urldecode($this->uri->segment(3))));
				 $config['uri_segment'] = $start = (int) $this->uri->segment(4);
				 $config['uri_segment'] = 4;

			}
			else
			{
				$search_query = "";
				$start = (int) $this->uri->segment(3);
				$config['uri_segment'] = 3;
			}

			if($start == '') $start = 0;

			$videos=$this->videos_model->retrieveDataPaging($start,10,1, $search_query);

			$data['count'] = $this->videos_model->countData(1,'videos', $search_query);
			$data['unpublished_count'] = $this->videos_model->countData(0,'videos', '');
			if($search_query != '')
				$config['base_url'] = ROOT . "videos/published/".$search_query;
			else
				$config['base_url'] = ROOT . "videos/published/";
			$config['total_rows'] = $data['count'];
			$config['per_page'] = 10;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);
			$this->pagination->initialize($config);

			$data['paging'] = $this->pagination->create_links();

			foreach($videos as $video)
			{
				$sections_str='';
				$secArr=explode(',',$video->section_ids);
				foreach($secArr as $sec_id)
				{
					$sec_id=str_replace(array('[',']'),'',$sec_id);
					$section=$this->videos_model->retrieveCustomDatabyID('sections',$sec_id);
					$sections_str.=$section[0]->name.",";
				}
				$date1 = new DateTime($video->published_at);
				$date2 = new DateTime(date("Y-m-d H:i:s"));

				$diff = $date2->diff($date1);

				$hours = $diff->h;
				$hours = $hours + ($diff->days*24);
				if($hours<24 && ($hours!=''))
					$video->published_at = human_timing($video->published_at);
				$video->section_name=$sections_str;
				$videos_[]=$video;
			}

			$data['videos'] = @$videos_;

			$this->load->view("manage_published_videos", $data);
		}
	}


	public function list_videos()
	{
		$data = array();

		$current_page = (int) $this->uri->segment(3);
		$per_page = 20;
		$videos_count = $this->videos_model->count_data();

		$config["base_url"] = ROOT . "videos/list_videos/";
		$config['uri_segment'] = 3;
		$config["total_rows"] = $videos_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$videos = $this->videos_model->get_videos_list($current_page, $per_page);
		if ($videos)
		{
			$data["videos"] = $videos;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(ROOT . "videos/videos_search/$query");
		}

		$this->load->view("list_videos_view", $data);
	}


	public function videos_search($query = "")
	{
		if (empty($query)) redirect(ROOT . "videos/list_videos");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 20;
		$videos_count = $this->videos_model->count_search_data($query);

		$config["base_url"] = ROOT . "videos/videos_search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $videos_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$videos = $this->videos_model->search_videos("title", $query, $current_page, $per_page);
		if ($videos)
		{
			$data["videos"] = $videos;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(ROOT . "videos/videos_search/$query");
		}

		$this->load->view("list_videos_view", $data);
	}


    public function add()
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			$data = array();
			$coverages = $this->common_model->get_all_from_table("news_coverages", array("order_by" => "id", "direction" => "DESC"));
			if ($coverages)
			{
				$data["coverages"] = $coverages;
			}

			$sections = $this->common_model->get_all_from_table("sections", array("order_by" => "id", "direction" => "DESC"));
			if ($sections)
			{
				$data["sections"] = $sections;
			}

			if (isset($_POST["submit"]))
			{
				$data['image'] = $image = trim(htmlspecialchars($_POST["video_img"]));
				$data['title'] = $title = trim(htmlspecialchars($_POST["video_title"]));
				$data['soc_title'] = $soc_title = trim(htmlspecialchars($_POST["social_title"]));
				$data['author_name'] = $author_name = trim(htmlspecialchars($_POST["video_author"]));
				$data['date'] = $date = trim(htmlspecialchars($_POST["video_date"]));
				$data['video_type'] = $video_type = $_POST['video_type'];
				if (substr($_POST["video_link"], 0, 4) === "http")
					$link = str_replace(array("http://youtu.be/","http://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
				if (substr($_POST["video_link"], 0, 5) === "https")
					$link = str_replace(array("https://youtu.be/","https://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
				$data['link'] = @$link;
				$data['breif'] = $breif = trim(htmlspecialchars($_POST["breif"]));
				$data['content'] = $content = " ";
				$data['coverage'] = $coverage = (empty($_POST["coverage_id"])) ? NULL : $_POST["coverage_id"];
				$data['tags'] = $tags = " ";
				$data['related_videos'] = " ";
				$data['article_id'] = " ";
				if(isset($_POST["section"]))
				{
					foreach($_POST["section"] as $sec)
					{
						$sec ='['.$sec.']';
						$sections_[] = $sec;
					}
				}
				if(isset($sections))
				$data['sections_'] = @$sections=implode(',',$sections_);
				$data['user_id'] = $created_by_id = $this->session->userdata("id");
				$data['publish'] = $publish = (isset($_POST["publish"])) ? 1 : 0;
				$data["status"] = "";

				if (empty($_POST["section"]))
				{
					$data["status"] = "<p class='error-msg'>من فضلك قم بإضافة الأقسام! </p>";
				}
				else
				{
					$insert_id = $this->videos_model->add_new($title, $soc_title, $author_name, $date, $link, $breif, $content, $coverage, $tags, $related_videos,
															  $linked_with_article, $sections, $created_by_id, $publish, $image, $video_type);

					// If image was chosen, update its 'used' flag by adding one
					if ( ! empty($image)) $this->videos_model->update_image_used_flag("name", $image, TRUE);

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					if ($publish == 1)
					{
						redirect(ROOT . "videos/published");
					}
					else
					{
						redirect(ROOT . "videos/unpublished");
					}
				}
			}

			$this->load->view("add_vedio_view",$data);
		}
    }


	function view($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			$video = $this->videos_model->retrieveCustomDatabyID('videos',$id);
			$data['video'] = $video[0];
			$this->load->view("video_view", $data);
		}
	}


	public function edit($id = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			$video = $this->videos_model->retrieveCustomDatabyID("videos", $id);
			$video = $video[0];
			if (empty($id) OR ! $video) show_404();

			$data['image'] = $video->image;
			$data['title'] = $video->title;
			$data['soc_title'] = $video->social_title;
			$data['author_name'] = $video->author;
			$data['date'] = $video->date;
			$data['video_type'] = $video->video_type;
			$data['link'] = $video->link;
			$data['breif'] = $video->breif;;
			$data['content'] = $video->description;
			$data['coverage_id'] = $video->coverage_id;
			$data['tags'] = $video->tags;
			$data['related_ids'] = $video->related_videos_ids;
			$data['article_id'] = $video->article_id;
			$data['publish'] = $video->published;
			$secs = explode(',', $video->section_ids);

			foreach($secs as $sec)
			{
				$sec = '['.$sec.']';
				$sections_[] = $sec;
			}

			$data['sections_'] = implode(',', $sections_);
			$coverages = $this->common_model->get_all_from_table("news_coverages", array("order_by" => "id", "direction" => "DESC"));
			if ($coverages) $data["coverages"] = $coverages;

			$sections = $this->common_model->get_all_from_table("sections", array("order_by" => "id", "direction" => "DESC"));
			if ($sections) $data["sections"] = $sections;

			if (isset($_POST["submit"]))
			{
				$data['image'] = $image = trim(htmlspecialchars($_POST["video_img"]));
				$data['title'] = $title = trim(htmlspecialchars($_POST["video_title"]));
				$data['soc_title'] = $soc_title = trim(htmlspecialchars($_POST["social_title"]));
				$data['author_name'] = $author_name = trim(htmlspecialchars($_POST["video_author"]));
				$data['date'] = $date = trim(htmlspecialchars($_POST["video_date"]));
				$data['video_type'] = $video_type = trim(htmlspecialchars($_POST["video_link"]));

				$data['link'] = $link = $_POST["video_link"];
				$data['breif'] = $breif = trim(htmlspecialchars($_POST["breif"]));
				$data['content'] = $content = " ";
				$data['coverage'] = $coverage = (empty($_POST["coverage_id"])) ? NULL : $_POST["coverage_id"];
				$data['tags'] = $tags = " ";
				$data['related_videos'] = $related_videos = " ";
				$data['article_id'] = $linked_with_article = " ";

				foreach($_POST["section"] as $sec)
				{
					$sec = '['.$sec.']';
					$sections2[] = $sec;
				}

				$data['sections_'] = $sections = implode(',',$sections2);
				$data['user_id'] = $created_by_id = $this->session->userdata("id");
				$data['publish'] = $publish = (isset($_POST["publish"])) ? 1 : 0;
				$published_here = ($video->published == 0 && $publish == 1) ? 1 : 0;
				$unpublished_here = ($video->published == 1 && $publish == 0) ? 1 : 0;

				$data["status"] = "";

//				if (empty($related_videos))
//				{
//					$data["status"]= "<p class='error-msg'>من فضلك قم بإضافة فيديوهات متعلقة!</p>";
//				}
				if (empty($_POST["section"]))
				{
					$data["status"] = "<p class='error-msg'>من فضلك قم بإضافة الأقسام!</p>";
				}
				else
				{
					$this->videos_model->edit($id, $title, $soc_title, $author_name, $date, $link, $breif, $content, $coverage, $tags,$related_videos,
					$linked_with_article, $sections, $created_by_id, $publish, $image, $video_type, $published_here,$unpublished_here, $this->session->userdata("id"));

					// Update old and/or new image's 'used' flags appropriately
					if (empty($video->image) && ! empty($image))
					{
						$this->videos_model->update_image_used_flag("name", $image, TRUE);
					}
					elseif ( ! empty($video->image) && empty($image))
					{
						$this->videos_model->update_image_used_flag("name", $video->image, FALSE);
					}
					elseif ( ! empty($video->image) && ! empty($image))
					{
						if ($video->image != $image)
						{
							$this->videos_model->update_image_used_flag("name", $video->image, FALSE);
							$this->videos_model->update_image_used_flag("name", $image, TRUE);
						}
					}

					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					if ($publish == 1)
					{
						redirect(ROOT . "videos/published");
					}
					else
					{
						redirect(ROOT . "videos/unpublished");
					}
				}
			}

			$this->load->view("edit_vedio_view",$data);
		}
    }


	public function delete($id)
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			$video = $this->common_model->get_subject_with_token("videos", "id", $id);
			if (empty($id) OR ! $video) show_404();

			$this->videos_model->delete_video($id);

			$this->session->set_flashdata("status", "تمت العملية بنجاح");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

}


/* End of file videos.php */
/* Location: ./application/modules/videos/controllers/videos.php */
