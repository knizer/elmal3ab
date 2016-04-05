<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stadiums extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->deny->deny_if_logged_out();
		$this->load->model("stadiums_model");
    }


	public function index()
	{
		$data = array();
		$current_page = (int) $this->uri->segment(2);
		$per_page = 20;
		$stadiums_count = $this->common_model->get_table_rows_count("stadiums");
		$config["base_url"] = ROOT . "stadiums/";
		$config['uri_segment'] = 2;
		$config["total_rows"] = $stadiums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$stadiums = $this->stadiums_model->get_stadiums($current_page, $per_page);
		if ($stadiums)
		{
			$data["stadiums"] = $stadiums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(ROOT . "stadiums/search/$query");
		}

		$this->load->view("manage_stadiums_view", $data);
	}


    public function search($query = "")
	{
		if (empty($query)) redirect(ROOT . "stadiums");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 20;
		$stadiums_count = $this->common_model->get_search_rows_count("stadiums", "title", $query);

		$config["base_url"] = ROOT . "stadiums/search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $stadiums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$stadiums = $this->stadiums_model->search_stadiums($query, $current_page, $per_page);
		if ($stadiums)
		{
			$data["stadiums"] = $stadiums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(ROOT . "stadiums/search/$query");
		}

		$this->load->view("manage_stadiums_view", $data);
	}

	public function add()
	{
        $authorized = $this->common_model->authorized_to_view_page("stadiums");
        if ($authorized)
        {
    		$data = array();
    		if (isset($_POST["submit_btn"]))
    		{
                $user_id = $this->session->userdata("id");
    			$title = htmlspecialchars(trim($_POST["title"]));
    			$description = htmlspecialchars(trim($_POST["description"]));
    			$address = htmlspecialchars(trim($_POST["address"]));
    			$phone = htmlspecialchars(trim($_POST["phone"]));
    			$workhours_from = htmlspecialchars(trim($_POST["workhours_from_time"] . ':' . $_POST["workhours_from"]));
    			$workhours_to = htmlspecialchars(trim($_POST["workhours_to_time"] . ':' . $_POST["workhours_to"]));
    			$ground_type = trim(htmlspecialchars($_POST["ground_type"]));
    			$hour_price = trim(htmlspecialchars($_POST["hour_price"]));
    			$image = trim(htmlspecialchars($_POST["main_img"]));
                $video_link = trim(htmlspecialchars($_POST["main_video"]));
                $published = (isset($_POST["publish"])) ? '1' : '0';

                if (empty($video_link))
                {
                    $video_link = '0';
                }
                else
                {
                    if (substr($_POST["video_link"], 0, 4) === "http")
                    $link = str_replace(array("http://youtu.be/","http://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
                    if (substr($_POST["video_link"], 0, 5) === "https")
                    $link = str_replace(array("https://youtu.be/","https://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
                }
    			if (empty($image))
    			{
    				$data["status"] = "<p class='error-msg'>You didn't upload an image file</p>";
    			}
                else
                {
					$this->stadiums_model->add_stadiums_item($user_id, $title, $description, $address, $phone, $workhours_from, $workhours_to,
                                                             $ground_type, $hour_price, $image, $video_link, $published);
					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "stadiums");
    			}
    		}

    		$this->load->view("add_stadiums_item_view", $data);
    	}
    }


	public function edit($id = "")
    {
		$stadiums_item = $this->common_model->get_subject_with_token("stadiums", "id", $id);
		if (empty($id) OR ! $stadiums_item) show_404();
		$data["stadiums_item"] = $stadiums_item;

		if (isset($_POST["submit_btn"]))
		{
			$success = FALSE;
            $user_id = $this->session->userdata("id");
            $title = htmlspecialchars(trim($_POST["title"]));
            $description = htmlspecialchars(trim($_POST["description"]));
            $address = htmlspecialchars(trim($_POST["address"]));
            $phone = htmlspecialchars(trim($_POST["phone"]));
            $workhours_from = htmlspecialchars(trim($_POST["workhours_from_time"] . ':' . $_POST["workhours_from"]));
            $workhours_to = htmlspecialchars(trim($_POST["workhours_to_time"] . ':' . $_POST["workhours_to"]));
            $ground_type = trim(htmlspecialchars($_POST["ground_type"]));
            $hour_price = trim(htmlspecialchars($_POST["hour_price"]));
            $image = trim(htmlspecialchars($_POST["main_img"]));
            $video_link = trim(htmlspecialchars($_POST["main_video"]));
            $published = (isset($_POST["publish"])) ? '1' : '0';
			$published_here = ($stadiums_item["published"] == 0 && $published == 1) ? TRUE : FALSE;
			$unpublished_here = ($stadiums_item["published"] == 1 && $published == 0) ? TRUE : FALSE;
            if (empty($video_link))
            {
                $video_link = '0';
            }
            else
            {
                if (substr($_POST["video_link"], 0, 4) === "http")
                $link = str_replace(array("http://youtu.be/","http://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
                if (substr($_POST["video_link"], 0, 5) === "https")
                $link = str_replace(array("https://youtu.be/","https://dai.ly/"), '', trim(htmlspecialchars($_POST["video_link"])));
            }

			if (empty($title) OR empty($address))
			{
				$data["status"] = "<p class='error-msg'>You didn't fill all required fields</p>";
			}
			else
			{
				$success = TRUE;

				if ($success)
				{
					$this->stadiums_model->update_stadiums_item($title, $description, $address, $phone, $workhours_from, $workhours_to,
                                                                $ground_type, $hour_price, $image, $video_link, $published, $published_here,
                                                                $unpublished_here, $id);
					$this->session->set_flashdata("status", "تمت العملية بنجاح");
					redirect(ROOT . "stadiums");
				}
			}
		}

		$this->load->view("edit_stadiums_item_view", $data);
	}


	public function delete($id = "")
    {
		$news_item = $this->common_model->get_subject_with_token("stadiums", "id", $id);
		if (empty($id) OR ! $news_item) show_404();

		// Delete from database
		$this->common_model->delete_subject("stadiums", "id", $id);

		$this->session->set_flashdata("status", "تمت العملية بنجاح");
		redirect(ROOT . "stadiums");
	}

    function view($id)
    {
        $authorized = $this->common_model->authorized_to_view_page("stadiums");
        if ($authorized)
        {
            $stadium = $this->stadiums_model->retrieveCustomDatabyID('stadiums',$id);
            $data['stadium'] = $stadium;
            $this->load->view("stadium_view", $data);
        }
    }

}
