<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->deny->deny_if_logged_out();

		$this->load->model("albums_model");
    }


	public function index()
	{
		$data = array();

		$current_page = (int) $this->uri->segment(2);
		$per_page = 20;
		$albums_count = $this->common_model->get_table_rows_count("albums");

		$config["base_url"] = site_url() . "albums/";
		$config['uri_segment'] = 2;
		$config["total_rows"] = $albums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$albums = $this->albums_model->get_albums($current_page, $per_page);
		if ($albums)
		{
			$data["albums"] = $albums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "albums/search/$query");
		}

		$this->load->view("manage_albums_view", $data);
	}


	public function search($query = "")
	{
		if (empty($query)) redirect(site_url() . "albums");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 20;
		$albums_count = $this->common_model->get_search_rows_count("albums", "title", $query);

		$config["base_url"] = site_url() . "albums/search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $albums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$albums = $this->albums_model->search_albums("title", $query, $current_page, $per_page);
		if ($albums)
		{
			$data["albums"] = $albums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "albums/search/$query");
		}

		$this->load->view("manage_albums_view", $data);
	}


	public function list_albums()
	{
		$data = array();

		$current_page = (int) $this->uri->segment(3);
		$per_page = 20;
		$albums_count = $this->common_model->get_table_rows_count("albums");

		$config["base_url"] = site_url() . "albums/list_albums/";
		$config['uri_segment'] = 3;
		$config["total_rows"] = $albums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$albums = $this->albums_model->get_albums($current_page, $per_page);
		if ($albums)
		{
			$data["albums"] = $albums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "albums/albums_search/$query");
		}

		$this->load->view("list_albums_view", $data);
	}


	public function albums_search($query = "")
	{
		if (empty($query)) redirect(site_url() . "albums/list_albums");
		$query = urldecode($query);

		$data = array();

		$current_page = (int) $this->uri->segment(4);
		$per_page = 20;
		$albums_count = $this->common_model->get_search_rows_count("albums", "title", $query);

		$config["base_url"] = site_url() . "albums/albums_search/$query";
		$config['uri_segment'] = 4;
		$config["total_rows"] = $albums_count;
		$config["per_page"] = $per_page;
		$this->pagination->initialize($config);

		$albums = $this->albums_model->search_albums("title", $query, $current_page, $per_page);
		if ($albums)
		{
			$data["albums"] = $albums;
			$data["pagination"] = $this->pagination->create_links();
		}

		if (isset($_POST["submit"]))
		{
			$query = htmlspecialchars(trim($_POST["search"]));
			redirect(site_url() . "albums/albums_search/$query");
		}

		$this->load->view("list_albums_view", $data);
	}


	public function add()
	{
		/* This function is currently only accessed via ajax */

		$sections = $this->albums_model->get_all_active_sections();
		if ($sections) $data["sections"] = $sections;

		if (isset($_POST["token"]))
		{
			$title = htmlspecialchars(trim($_POST["title"]));
			$description = htmlspecialchars(trim($_POST["description"]));
			$section_id = (empty($_POST["section_id"])) ? NULL : $_POST["section_id"];
			$photographer = (empty($_POST["photographer"])) ? NULL : htmlspecialchars(trim($_POST["photographer"]));
			$main_image = $_POST["main_image"];
			$publish = $_POST["publish"];
			$created_by = $this->session->userdata("name");
			$assigned_images = json_decode($_POST["assigned_images"], TRUE);

			$insert_id = $this->albums_model->create_album($title, $description, $section_id, $photographer, $main_image, $created_by, $publish);

			foreach ($assigned_images as $image)
			{
				$this->albums_model->assign_image_to_album($image["id"], $image["name"], $insert_id);
			}

			$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "إضافة ألبوم", "album", $insert_id, $title);
		}
		else
		{
			echo $this->load->view("ajax_add_album_view", $data, TRUE);
		}
	}


	public function view($id, $ajax_version = "")
    {
		$album = $this->albums_model->get_album_details($id);
		if (empty($id) OR ! $album) show_404();

		$data["album"] = $album;
		$album_images = $this->common_model->get_all_subjects_with_token("album_images", "album_id", $id);
		if ($album_images) $data["album_images"] = $album_images;

		if (empty($ajax_version))
		{
			$this->load->view("view_album_view", $data);
		}
		else
		{
			$this->load->view("view_album_ajax_view", $data);
		}
	}


	public function edit($id = "")
    {
		$album = $this->common_model->get_subject_with_token("albums", "id", $id);
		if (empty($id) OR ! $album) show_404();

		$data["album"] = $album;

		$sections = $this->albums_model->get_all_active_sections();
		if ($sections) $data["sections"] = $sections;

		$initial_album_images = $this->common_model->get_all_subjects_with_token("album_images", "album_id", $id);
		if ($initial_album_images)
		{
			$data["album_images"] = $initial_album_images;

			foreach ($initial_album_images as $image)
			{
				$initial_album_images_ids_array[] = $image["image_id"];
			}
		}
		else
		{
			$data["album_images"] = array();
			$initial_album_images_ids_array = array();
		}

		if (isset($_POST["submit"]))
		{
			$title = htmlspecialchars(trim($_POST["title"]));
			$description = htmlspecialchars(trim($_POST["description"]));
			$section_id = (empty($_POST["section_id"])) ? NULL : $_POST["section_id"];
			$photographer = (empty($_POST["photographer"])) ? NULL : htmlspecialchars(trim($_POST["photographer"]));
			$main_image = $_POST["main_image"];
			$published = (isset($_POST["published"])) ? 1 : 0;
			$published_here = ($album["published"] == 0 && $published == 1) ? 1 : 0;
			$unpublished_here = ($album["published"] == 1 && $published == 0) ? 1 : 0;
			$album_images = $_POST["album_images"];

			if (empty($title) OR empty($description) OR empty($section_id))
			{
				$data["status"] = "<p class='error-msg'>يجب إدخال جميع البيانات</p>";
			}
			elseif ($album["title"] != $title && $this->common_model->subject_exists("albums", "title", $title))
			{
				$data["status"] = "<p class='error-msg'>هذا العنوان موجود بالفعل</p>";
			}
			else
			{
				// Log action then update
				$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "تعديل ألبوم", "album", $id, $title);
				$this->albums_model->update_album($title, $description, $section_id, $photographer, $main_image, $published, $published_here, $unpublished_here, $id);

				$album_images_arr = explode(",", $album_images);
				foreach ($album_images_arr as $image)
				{
					$image_already_assigned_to_album = $this->albums_model->image_already_assigned_to_album($image, $id);
					if ( ! $image_already_assigned_to_album)
					{
						$img_name = $this->common_model->get_info_by_token("images", "name", "id", $image);
						$this->albums_model->assign_image_to_album($image, $img_name, $id);
					}
				}

				$removed_images = array();
				foreach ($initial_album_images_ids_array as $image)
				{
					if ( ! in_array($image, $album_images_arr))
					{
						$removed_images[] = $image;
					}
				}

				foreach ($removed_images as $image)
				{
					$this->albums_model->remove_image_from_album($image, $id);
				}

				$this->session->set_flashdata("status", "تمت العملية بنجاح");
				redirect(site_url() . "albums");
			}
		}

		$this->load->view("edit_album_view", $data);
	}


	public function delete($id = "")
    {
		$authorized = $this->common_model->authorized_to_view_page("delete_album");
		if ($authorized)
		{
			$album = $this->common_model->get_subject_with_token("albums", "id", $id);
			if (empty($id) OR ! $album) show_404();;

			// Log action before deleting
			$deleted_album_title = $album["title"];
			$this->common_model->log_action($this->session->userdata("id"), $this->session->userdata("username"), "مسح ألبوم", "album", $id, $deleted_album_title);
			$this->common_model->delete_subject("albums", "id", $id);

			// Also delete all image associations with this album
			$album_images = $this->common_model->get_all_subjects_with_token("album_images", "album_id", $id);
			if ($album_images)
			{
				foreach ($album_images as $image)
				{
					$this->albums_model->remove_image_from_album($image["image_id"], $id);
				}
			}

			$this->session->set_flashdata("status", "تمت العملية بنجاح");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	/* This function is only accessed via ajax via a POST request, never directly by the user */
	public function check_title_exists()
	{
		if (isset($_POST["token"]) && $_POST["token"] == "ajax_request")
		{
			$title = $_POST["title"];
			echo ($this->common_model->subject_exists("albums", "title", $title)) ? 1 : 0;
		}
	}

	// public function get_user_news_count($user_id)
	// {
	// 	$sql = "SELECT count(`id`) as 'count' FROM `news` WHERE `created_by_id` = ? AND `created_at` >= '2016-01-01' AND `created_at` <= '2016-01-15'";
	// 	$query = $this->db->query($sql, array($user_id));
	// 	return ($query->num_rows() >= 1) ? $query->row_array()['count'] : FALSE;
	// }
	//
	// public function test()
	// {
	// 	header('Content-Type: text/html; charset=utf-8');
	// 	$sql = "SELECT `id`, `name` FROM `users_details` WHERE `group_id` = 3";
	// 	$query = $this->db->query($sql);
	// 	$users = $query->result_array();
	//
	// 	$news_counter = 0;
	// 	foreach ($users as $user)
	// 	{
	// 		$news_counter += $this->get_user_news_count($user['id']);
	// 	}
	// 	echo $news_counter;
	// }

}


/* End of file albums.php */
/* Location: ./application/modules/albums/controllers/albums.php */
