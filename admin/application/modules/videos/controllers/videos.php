<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class videos extends MX_Controller {

    public function __construct()
	{
        parent::__construct();
		// error_reporting(0);
		$this->deny->deny_if_logged_out();

        $this->load->model("videos_model");
    }


    public function index()
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

            $videos=$this->videos_model->retrieveDataPaging($start,10, $search_query);

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
                $date1 = new DateTime($video->published_at);
                $date2 = new DateTime(date("Y-m-d H:i:s"));

                $diff = $date2->diff($date1);

                $hours = $diff->h;
                $hours = $hours + ($diff->days*24);
                if($hours<24 && ($hours!=''))
                    $video->published_at = human_timing($video->published_at);
                $videos_[]=$video;
            }

            $data['videos'] = @$videos_;

            $this->load->view("manage_videos", $data);
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

			if (isset($_POST["submit"]))
			{
                $video_type = $_POST['video_type'];
                $user_id = $this->session->userdata("id");
                $title = trim(htmlspecialchars($_POST["video_title"]));
                $author_name = trim(htmlspecialchars($_POST["video_author"]));
				$image = trim(htmlspecialchars($_POST["video_img"]));
                $publish = (isset($_POST["publish"])) ? 1 : 0;
                $link = $_POST["video_link"];
				if (substr($_POST["video_link"], 0, 4) === "http")
					$link = str_replace(array("http://youtu.be/","http://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
				if (substr($_POST["video_link"], 0, 5) === "https")
					$link = str_replace(array("https://youtu.be/","https://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
                $insert_id = $this->videos_model->add_new($video_type, $user_id, $title, $author_name, $image, $link, $publish);

                // If image was chosen, update its 'used' flag by adding one
                if ( ! empty($image)) $this->videos_model->update_image_used_flag("name", $image, TRUE);

                $this->session->set_flashdata("status", "تمت العملية بنجاح");
                if ($publish == 1)
                {
                    redirect(ROOT . "videos");
                }
                else
                {
                    redirect(ROOT . "videos");
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
			$data['video'] = $video;
			$this->load->view("video_view", $data);
		}
	}


	public function edit($id = "")
	{
		$authorized = $this->common_model->authorized_to_view_page("videos");
		if ($authorized)
		{
			$video = $this->videos_model->retrieveCustomDatabyID("videos", $id);
			if (empty($id) OR ! $video) show_404();
            $data['video'] = $video;
			if (isset($_POST["submit"]))
			{
                $video_type = trim(htmlspecialchars($_POST["video_link"]));
                $user_id = $this->session->userdata("id");
                $title = trim(htmlspecialchars($_POST["video_title"]));
                $author_name = trim(htmlspecialchars($_POST["video_author"]));
				$image = trim(htmlspecialchars($_POST["video_img"]));
                $link = $_POST["video_link"];
                $publish = (isset($_POST["publish"])) ? 1 : 0;
                $published_here = ($video->published == 0 && $publish == 1) ? 1 : 0;
                $unpublished_here = ($video->published == 1 && $publish == 0) ? 1 : 0;

                $this->videos_model->edit($video_type, $user_id, $title, $author_name, $image, $link, $publish, $published_here, $unpublished_here, $id);

                $this->session->set_flashdata("status", "تمت العملية بنجاح");
                if ($publish == 1)
                {
                    redirect(ROOT . "videos");
                }
                else
                {
                    redirect(ROOT . "videos");
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
